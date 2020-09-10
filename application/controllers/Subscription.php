<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subscription extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		/* if (!$this->session->has_userdata('memberLogin')) {
			redirect('login?next_url=subscription','refresh');
		} */

		$this->load->library('curl');
		$this->load->helper('html');
		$this->client = new \GuzzleHttp\Client(['verify' => false , 'http_errors' => false]);
		$this->url_api = 'https://dev.mydiosing.com/mydio'; // untuk dev, besok dicomment
		
		// Paypal sandbox version
		$this->paypal_url = 'https://api.sandbox.paypal.com';
		$this->paypal_clientid = 'AbwuGIosFc3mNHDZ2EW-fDGDjoyUFYXlJ72k4zi4oUVEz66iA2vYvfG06VF5Z3uFNKRyhy1dgjl8wwjN';
		$this->paypal_clientsecret = 'EC28FjiflTsc1rvF15DCjTOjpku6PFYhxfCclgsWslrgHFfHvAMyA0ZCvd8rFYAjOVyNsRVnIdQOOtWN';

		// Paypal live version
		// $this->paypal_url = 'https://api.paypal.com';
		// $this->paypal_clientid = 'AbRcS6i5u0vouKp2VTeRpurJPgMs7ilxisrImVFMR9YZIpwZts6y7JVmLiuGjkv5yUDLrfrvj1ZwXHYI';
		// $this->paypal_clientsecret = 'EBW1ZgP_1ONYbjsKPxKOX5mKMgkTv38fy1-r91sy8bUq52Wqqkv3dRahO8agl6TSB6m09MJi4K66gKxP';
	}

	public function index()
	{
		if (!$this->session->has_userdata('memberLogin')) {
			redirect('login?next_url=subscription');
		}
		
		// $data_currency = $this->curl->simple_get('https://free.currconv.com/api/v7/convert?q=IDR_USD&compact=ultra&apiKey=eb36563eed1785aae4a7'.http_build_query($param));
		
		// $res_currency = json_decode($data_currency, true);

		// $harga_subscribe = [
		// 	'1m' => round($res_currency['IDR_USD'] * 10000, 2),
		// 	'3m' => round($res_currency['IDR_USD'] * 26000, 2),
		// 	'1y' => round($res_currency['IDR_USD'] * 99000, 2),
		// ];

		$reqTime = date('YmdHis');

		$apiCheckSubscribe = $this->client->request('GET', ''.$this->url_api.'/Subscription', [
			'query' => [
				'action' => 'info',
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);
		$subsStatus = json_decode($apiCheckSubscribe->getBody()->getContents(), TRUE);

		$res_user = $this->client->request('GET', ''.$this->url_api.'/QueryUser', [
			'query' => [
				'type' => 'me',
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);
		$user = json_decode($res_user->getBody()->getContents(), TRUE);

		$apiGetPaypalData = $this->client->request('GET', ''.$this->url_api.'/Subscription', [
			'query' => [
				'action' => 'infoPaypal',
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);
		$paypalData = json_decode($apiGetPaypalData->getBody()->getContents(), TRUE);
		$lastPaypalData = array_pop($paypalData);
		$detailPaypalData = json_decode($lastPaypalData['subscriptionDetails'], TRUE);

		//$lastPaypalData['subscriptionId']

		$apiListProductSubscribtion = $this->client->request('GET', ''.$this->url_api.'/Subscription', [
			'query' => [
				'action' => 'list'
			]
		]);
		$apiListSubs = json_decode($apiListProductSubscribtion->getBody(), TRUE);

		$listSubs = [];
		foreach ($apiListSubs as $value) {
			$array = [];

			$array['subscriptionId'] = $value['subscriptionId'];
			$array['subscription'] = $value['subscription'];
			$array['quotaReoccurringDays'] = $value['quotaReoccurringDays'];

			if($value['quotaReoccurringDays'] == 30){
				$array['icon'] = base_url('assets/images/subscription_monthly.jpg');
				$array['price'] = 1;
			} elseif ($value['quotaReoccurringDays'] == 90) {
				$array['icon'] = base_url('assets/images/subscription_3_month.jpg');
				$array['price'] = 2;
			} else {
				$array['icon'] = base_url('assets/images/subscription_yearly.jpg');
				$array['price'] = 7;
			}

			$listSubs[] = $array;
		}

		// $user = $this->db->get_where('users', ['id' => $this->session->userdata('userId')])->row_array();

		// $data_subscribtion = $this->db->get_where('user_subscriptions', ['user_id' => $this->session->userdata('userId')])->row_array();

		// if($data_subscribtion){
		// 	if($data_subscribtion['valid_to'] > date('Y-m-d H:i:s')){
		// 		$data_subs = $data_subscribtion;
		// 	} else {
		// 		$data_subs = '';
		// 	}
		// } else {
		// 	$data_subs = '';
		// }

		// $harga_subscribe = [
		// 	'1m' => 1,
		// 	'3m' => 2,
		// 	'1y' => 7,
		// ];

		// $data = $this->dataPAYPAL;
		
		// $this->output->cache(60);
		
		$navbar_back = true;
		$title = 'Subscriptions';
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('subscription/subscription', compact('listSubs','subsStatus','user','detailPaypalData'));
		// $this->load->view('subscription/subscription', compact('data','harga_subscribe','user','data_subs'));
		$this->load->view('footer');
	}

	public function success_callback()
	{
		$subscription_id = $this->input->get('subscription_id');

		redirect('subscription/success/'.$subscription_id.'', 'refresh');
	}

	public function saveUpdatePurchase($json_data)
	{
		$apiSaveSubscriptionMydiosing = $this->client->request('POST', ''.$this->url_api.'/PaymentPaypal?userId='.$this->session->userdata('userId').'&action=updatePurchase', [
	          	'body' => json_encode($json_data),
			    'headers' => [
			        'Content-Type' => 'application/json',
			    ]
	    ]);
	    
	    $reqTime = date('YmdHis');
		$apiCheckSubscribe = $this->client->request('GET', ''.$this->url_api.'/Subscription', [
			'query' => [
				'action' => 'info',
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);
		$subsStatus = json_decode($apiCheckSubscribe->getBody()->getContents(), TRUE);

		if($subsStatus[0]['subscription'] == "FREE"){
			return $this->saveUpdatePurchase($json_data);
		} else {
			return true;
		}
	}

	public function update_purchase()
	{
		
		$subscription_id = $this->input->post('subscription_id');


	    $apiGetToken = $this->client->request('POST', ''.$this->paypal_url.'/v1/oauth2/token', [
	          	'headers' => [
			        'Accept' => 'application/json',
			        'Accept-Language' => 'en_US'
			    ],
			    'auth' => [
			    	$this->paypal_clientid, $this->paypal_clientsecret
			    ],
			    'form_params' => [
			        'grant_type' => 'client_credentials'
			    ]
	      	]
		);
		$json = json_decode($apiGetToken->getBody()->getContents());

	    $apiSubscriptionPaypal = $this->client->request('GET', ''.$this->paypal_url.'/v1/billing/subscriptions/'.$subscription_id.'', [
	            'headers' => [
			        'Content-Type' => 'application/json',
			        'Authorization' => "Bearer ".$json->access_token.""
			    ],
	        ]
	    );
	    $subscriptionPaypal = json_decode($apiSubscriptionPaypal->getBody()->getContents(), TRUE);

	    $respone_save_purchase = $this->saveUpdatePurchase($subscriptionPaypal);

		if($respone_save_purchase){
	    	$return = [
				'message' => 'Your Subscription Payment has been Successful!'
			];

			header('Content-Type: application/json');
			echo json_encode($return);
	    }
	}

	public function success($subscription_id)
	{

		if (!$this->session->has_userdata('memberLogin')) {
			redirect('login?next_url=subscription');
		}

		if($subscription_id){
			
			$itemName = '';

			// $prevPayment = $this->db->get_where('user_subscriptions', ['txn_id' => $tx])->num_rows();
			
			// if($prevPayment > 0){
				
			// 	$paymentData = [
			// 		'status' => 'exist',
			// 		'message' => 'Your Subscription Payment has been Successful!'
			// 	];
				
			// 	$itemName = '';
				
			// } else {
				
			// 	if($this->input->get('item_number') == '1M'){
			// 		$valid_to = date('Y-m-d H:i:s', strtotime('+1 months'));
			// 		$itemName = '1 Month Membership Subscription';
			// 		$payment_gross = 1;
			// 	} 
			// 	else if($this->input->get('item_number') == '3M'){
			// 		$valid_to = date('Y-m-d H:i:s', strtotime('+3 months'));
			// 		$itemName = '3 Month Membership Subscription';
			// 		$payment_gross = 2;
			// 	} else {
			// 		$valid_to = date('Y-m-d H:i:s', strtotime('+1 years'));
			// 		$itemName = '1 Year Membership Subscription';
			// 		$payment_gross = 7;
			// 	}

			// 	$data_subscription = [
			// 		'user_id' => $this->session->userdata('userId'),
			// 		'validity' => 1,
			// 		'valid_from' => date('Y-m-d H:i:s'),
			// 		'valid_to' => $valid_to,
			// 		'item_number' => $this->input->get('item_number'),
			// 		'txn_id' => $tx,
			// 		'payment_gross' => $payment_gross,
			// 		'currency_code' => $this->input->get('cc'),
			// 		'subscr_id' => $this->input->get('sig'),
			// 		'payment_status' => $st,
			// 		'payer_email' => $this->session->userdata('userEmail')
			// 	];
				
			// 	$this->db->insert('user_subscriptions', $data_subscription);

			// 	$insert_id = $this->db->insert_id();

			// 	$data_update = [
			// 		'subscription_id' => $insert_id
			// 	];
			// 	$this->db->where('id', $this->session->userdata('userId'));
			// 	$this->db->update('users', $data_update);
				
			// 	$paymentData = $data_subscription;
			// }
		} else {			
			$itemName = '';
		}
		
		$show_menu = true;
		$custom_title = true;
		$title = '';
		$this->load->view('header', compact('show_menu','custom_title','title'));
		$this->load->view('subscription/success', compact('itemName','subscription_id'));
		$this->load->view('footer');
	}

	public function cancel()
	{
		$show_menu = true;
		$custom_title = true;
		$title = '';
		$this->load->view('header', compact('show_menu','custom_title','title'));
		$this->load->view('subscription/cancel');
		$this->load->view('footer');
	}

	public function creat_subscription()
	{
		$lama_paket = $this->input->post('lama_paket');
		$nama_paket = $this->input->post('nama_paket');

		if($lama_paket == '30'){
			$data_subscribe = [
				'fixed_price_value' => '1',
				'interval_unit' => 'MONTH',
				'interval_count' => 1,
				'total_cycles' => 12
			];
		}
		elseif ($lama_paket == '90') {
			$data_subscribe = [
				'fixed_price_value' => '2',
				'interval_unit' => 'MONTH',
				'interval_count' => 3,
				'total_cycles' => 4
			];
		} else {
			$data_subscribe = [
				'fixed_price_value' => '7',
				'interval_unit' => 'YEAR',
				'interval_count' => 1,
				'total_cycles' => 2
			];
		}


	    $apiGetToken = $this->client->request('POST', ''.$this->paypal_url.'/v1/oauth2/token', [
	          	'headers' => [
			        'Accept' => 'application/json',
			        'Accept-Language' => 'en_US'
			    ],
			    'auth' => [
			    	$this->paypal_clientid, $this->paypal_clientsecret
			    ],
			    'form_params' => [
			        'grant_type' => 'client_credentials'
			    ]
	      	]
		);

		$json = json_decode($apiGetToken->getBody()->getContents());

		$header_product = [
			"Content-Type" => "application/json",
			"Authorization" => "Bearer ".$json->access_token."",
			"PayPal-Request-Id" => "PRODUCT-".rand(9,99999999).""
		];
	    
	    $api_product = $this->client->request('POST', ''.$this->paypal_url.'/v1/catalogs/products', [
	          	'headers' => $header_product,
	          	'json' => array(
	          		"name" => "MYDIO Sing Vod Service",
					"description" => "MYDIO Sing Vod Service",
					"type" => "SERVICE",
					"category" => "DIGITAL_MEDIA_BOOKS_MOVIES_MUSIC",
					"home_url" => "https://app.mydiosing.com"
	          	),
	      	]
		);

		$response_product = json_decode($api_product->getBody()->getContents(), TRUE);

		$header_plan = [
			"Accept" => "application/json",
	    	"Authorization" => "Bearer ".$json->access_token."",
	    	"PayPal-Request-Id" => "PLAN-".rand(9,99999999).""
		];

		$api_plan = $this->client->request('POST', ''.$this->paypal_url.'/v1/billing/plans', [
	          	'headers' => $header_plan,
	          	'json' => array(
	              	'product_id' => $response_product['id'],
			        'name' => $nama_paket,
			        'billing_cycles' => array(
			        	array(
				        	'frequency' => array(
				        		'interval_unit' => $data_subscribe['interval_unit'],
		        				'interval_count' => $data_subscribe['interval_count']
				        	),
				        	'tenure_type' => 'REGULAR',
							'sequence' => 1,
							'total_cycles' => $data_subscribe['total_cycles'],
							'pricing_scheme' => array(
								'fixed_price' => array(
							  		'value' => $data_subscribe['fixed_price_value'],
							  		'currency_code' => 'USD'
								)
							)
						)
			        ),
			        'payment_preferences' => array(
			        	'auto_bill_outstanding' => true,
			        	'setup_fee' => array(
			        		'value' => 0,
			        		'currency_code' => 'USD'
			        	),
			        	'setup_fee_failure_action' => 'CONTINUE',
			        	'payment_failure_threshold' => 0
			        )
	          	),
	      	]
		);

		$response_plan = json_decode($api_plan->getBody()->getContents(), TRUE);

		$header_subscription = [
			'Content-Type' => 'application/json',
	    	'Authorization' => "Bearer ".$json->access_token."",
	    	'PayPal-Request-Id' => 'SUBSCRIPTION-'.rand(9,99999999).''
		];
	    
	    $api_subscription = $this->client->request('POST', ''.$this->paypal_url.'/v1/billing/subscriptions', [
	          	'headers' => $header_subscription,
	          	'json' => array(
	              	'plan_id' => $response_plan['id'],
			        'quantity' => 1,
			        'application_context' => array(
			        	'user_action' => 'SUBSCRIBE_NOW',
			        	'return_url' => 'https://app.mydiosing.com/subscription/success-callback',
			        	'cancel_url' => 'https://app.mydiosing.com/subscription/cancel'
			        ),
	          	),
	      	]
		);

		$response_subscription = json_decode($api_subscription->getBody()->getContents(), TRUE);

		if($api_subscription->getStatusCode() == 200 || $api_subscription->getStatusCode() == 201){
			$return = [
				'status' => 200,
				'redirect' => $response_subscription['links'][0]['href']
			];
		} else {
			$return = [
				'status' => $api_subscription->getStatusCode(),
				'message' => 'Something went wrong please try again'
			];
		}

		header('Content-Type: application/json');
		echo json_encode($return);
	}

	public function cancel_subscription_paypal()
	{
		$subscription_id = $this->input->post('subscription_id');
		$reason = $this->input->post('reason');

	    $apiGetToken = $this->client->request('POST', ''.$this->paypal_url.'/v1/oauth2/token', [
	          	'headers' => [
			        'Accept' => 'application/json',
			        'Accept-Language' => 'en_US'
			    ],
			    'auth' => [
			    	$this->paypal_clientid, $this->paypal_clientsecret
			    ],
			    'form_params' => [
			        'grant_type' => 'client_credentials'
			    ]
	      	]
		);

		$token = json_decode($apiGetToken->getBody()->getContents());

		$apiCancelSubsPaypal = $this->client->request('POST', ''.$this->paypal_url.'/v1/billing/subscriptions/'.$subscription_id.'/cancel', [
	          	'headers' => [
					'Content-Type' => 'application/json',
			    	'Authorization' => "Bearer ".$token->access_token.""
				],
	          	'json' => array(
	          		'reason' => $reason
	          	),
	      	]
		);

		$apiGetSubscriptionPaypal = $this->client->request('GET', ''.$this->paypal_url.'/v1/billing/subscriptions/'.$subscription_id.'', [
	            'headers' => [
			        'Content-Type' => 'application/json',
			        'Authorization' => "Bearer ".$token->access_token.""
			    ],
	        ]
	    );

	    $apiSaveSubscriptionMydiosing = $this->client->request('POST', ''.$this->url_api.'/PaymentPaypal?userId='.$this->session->userdata('userId').'&action=updatePurchase', [
	          	'body' => $apiGetSubscriptionPaypal->getBody(),
			    'headers' => [
			        'Content-Type' => 'application/json',
			    ]
	    ]);

		$return = [
			'status' => 200
		];

		header('Content-Type: application/json');
		echo json_encode($return);
	}

	public function check_subscribe_status()
	{
		
		$reqTime = date('YmdHis');

		$apiGetPaypalData = $this->client->request('GET', ''.$this->url_api.'/Subscription', [
			'query' => [
				'action' => 'infoPaypal',
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);
		$paypalData = json_decode($apiGetPaypalData->getBody()->getContents(), TRUE);
		$detailPaypalData = json_decode($paypalData[0]['subscriptionDetails'], TRUE);

		$dataBackendPaypal = [
			'subscription_id' => $paypalData[0]['subscriptionId'],
			'status' => $detailPaypalData['status']
		];

	    $apiGetToken = $this->client->request('POST', ''.$this->paypal_url.'/v1/oauth2/token', [
	          	'headers' => [
			        'Accept' => 'application/json',
			        'Accept-Language' => 'en_US'
			    ],
			    'auth' => [
			    	$this->paypal_clientid, $this->paypal_clientsecret
			    ],
			    'form_params' => [
			        'grant_type' => 'client_credentials'
			    ]
	      	]
		);
		$token = json_decode($apiGetToken->getBody()->getContents(), TRUE);

	    $apiSubscriptionPaypal = $this->client->request('GET', ''.$this->paypal_url.'/v1/billing/subscriptions/'.$dataBackendPaypal['subscription_id'].'', [
	            'headers' => [
			        'Content-Type' => 'application/json',
			        'Authorization' => "Bearer ".$token['access_token'].""
			    ],
	        ]
	    );
	    $subscriptionPaypal = json_decode($apiSubscriptionPaypal->getBody()->getContents(), TRUE);

	    if($dataBackendPaypal['status'] <> $subscriptionPaypal['status']){
	    	$apiSaveSubscriptionMydiosing = $this->client->request('POST', ''.$this->url_api.'/PaymentPaypal?userId='.$this->session->userdata('userId').'&action=updatePurchase', [
		          	'body' => $apiSubscriptionPaypal->getBody(),
				    'headers' => [
				        'Content-Type' => 'application/json',
				    ]
		    ]);
	    }
	}
}