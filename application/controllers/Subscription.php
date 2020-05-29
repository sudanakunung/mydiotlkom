<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subscription extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->has_userdata('memberLogin')) {
			redirect('login','refresh');
		}

		$this->load->library('curl');
		$this->load->helper('html');

		$data['PAYPAL_ID'] = 'sb-vjfv471595879@business.example.com';
		$data['PAYPAL_RETURN_URL'] = base_url('subscription/success');
		$data['PAYPAL_CANCEL_URL'] = base_url('subscription/cancel');
		$data['PAYPAL_NOTIFY_URL'] = base_url('subscription/paypal-ipn');
		$data['PAYPAL_URL'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		$data['PAYPAL_CURRENCY'] = 'USD';

		$this->dataPAYPAL = $data;
	}

	public function index()
	{
		// $data_currency = $this->curl->simple_get('https://free.currconv.com/api/v7/convert?q=IDR_USD&compact=ultra&apiKey=eb36563eed1785aae4a7'.http_build_query($param));
		
		// $res_currency = json_decode($data_currency, true);

		// $harga_subscribe = [
		// 	'1m' => round($res_currency['IDR_USD'] * 10000, 2),
		// 	'3m' => round($res_currency['IDR_USD'] * 26000, 2),
		// 	'1y' => round($res_currency['IDR_USD'] * 99000, 2),
		// ];

		$user = $this->db->get_where('users', ['id' => $this->session->userdata('userId')])->row_array();

		$data_subscribtion = $this->db->get_where('user_subscriptions', ['user_id' => $this->session->userdata('userId')])->row_array();

		if($data_subscribtion){
			if($data_subscribtion['valid_to'] > date('Y-m-d H:i:s')){
				$data_subs = $data_subscribtion;
			} else {
				$data_subs = '';
			}
		} else {
			$data_subs = '';
		}

		$harga_subscribe = [
			'1m' => round(10000, 2),
			'3m' => round(26000, 2),
			'1y' => round(99000, 2),
		];

		$data = $this->dataPAYPAL;
		$navbar_back = true;
		$title = 'Subscriptions';
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('subscription/subscription', compact('data','harga_subscribe','user','data_subs'));
		$this->load->view('footer');
	}

	public function success()
	{
		if(!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && $_GET['st'] == 'Completed'){ 
		    // Get transaction information from URL  
		    $item_number = $_GET['item_number'];   
		    $txn_id = $_GET['tx'];  
		    $payment_gross = $_GET['amt'];  
		    $currency_code = $_GET['cc'];  
		    $payment_status = $_GET['st']; 
		    $custom = $_GET['cm']; 
		     
		    // Check if transaction data exists with the same TXN ID.
		    $prevPaymentResult = $this->db->get_where('user_subscriptions', ['txn_id' => $txn_id])->num_rows();  
		     
		    if($prevPaymentResult->num_rows > 0){ 
		        // Get subscription info from database
		        $paymentData = $this->db->get_where('user_subscriptions', ['txn_id' => $txn_id])->row_array();
		    }
		} else {
			$paymentData = '';
		}

		$this->load->view('header');
		$this->load->view('subscription/success', compact('paymentData'));
		$this->load->view('footer');
	}

	public function cancel()
	{
		$hide_navbar = true;

		$this->load->view('header', compact('hide_navbar'));
		$this->load->view('subscription/cancel');
	}

	public function paypal_ipn()
	{
		/* 
		 * Read POST data 
		 * reading posted data directly from $_POST causes serialization 
		 * issues with array data in POST. 
		 * Reading raw POST data from input stream instead. 
		 */         
		$raw_post_data = file_get_contents('php://input'); 
		$raw_post_array = explode('&', $raw_post_data); 
		$myPost = array(); 
		foreach ($raw_post_array as $keyval) { 
		    $keyval = explode ('=', $keyval); 
		    if (count($keyval) == 2) 
		        $myPost[$keyval[0]] = urldecode($keyval[1]); 
		} 
		 
		// Read the post from PayPal system and add 'cmd' 
		$req = 'cmd=_notify-validate'; 
		if(function_exists('get_magic_quotes_gpc')) { 
		    $get_magic_quotes_exists = true; 
		} 
		foreach ($myPost as $key => $value) { 
		    if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
		        $value = urlencode(stripslashes($value)); 
		    } else { 
		        $value = urlencode($value); 
		    } 
		    $req .= "&$key=$value"; 
		} 
		 
		/* 
		 * Post IPN data back to PayPal to validate the IPN data is genuine 
		 * Without this step anyone can fake IPN data 
		 */ 
		$paypalURL = $this->dataPAYPAL['PAYPAL_URL']; 
		$ch = curl_init($paypalURL); 
		if ($ch == FALSE) { 
		    return FALSE; 
		} 
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); 
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req); 
		curl_setopt($ch, CURLOPT_SSLVERSION, 6); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1); 
		 
		// Set TCP timeout to 30 seconds 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name')); 
		$res = curl_exec($ch); 
		 
		/* 
		 * Inspect IPN validation result and act accordingly 
		 * Split response headers and payload, a better way for strcmp 
		 */  
		$tokens = explode("\r\n\r\n", trim($res)); 
		$res = trim(end($tokens)); 
		if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) { 
		     
		    // Retrieve transaction data from PayPal 
		    $paypalInfo = $_POST; 
		    $subscr_id = $paypalInfo['subscr_id']; 
		    $payer_email = $paypalInfo['payer_email']; 
		    $item_name = $paypalInfo['item_name']; 
		    $item_number = $paypalInfo['item_number']; 
		    $txn_id = !empty($paypalInfo['txn_id'])?$paypalInfo['txn_id']:''; 
		    $payment_gross =  !empty($paypalInfo['mc_gross'])?$paypalInfo['mc_gross']:0; 
		    $currency_code = $paypalInfo['mc_currency']; 
		    $subscr_period = !empty($paypalInfo['period3'])?$paypalInfo['period3']:floor($payment_gross/$itemPrice); 
		    $payment_status = !empty($paypalInfo['payment_status'])?$paypalInfo['payment_status']:''; 
		    $custom = $paypalInfo['custom']; 
		    $subscr_date = !empty($paypalInfo['subscr_date'])?$paypalInfo['subscr_date']:date("Y-m-d H:i:s"); 
		    $dt = new DateTime($subscr_date); 
		    $subscr_date = $dt->format("Y-m-d H:i:s"); 
		    $subscr_date_valid_to = date("Y-m-d H:i:s", strtotime(" + $subscr_period month", strtotime($subscr_date))); 
		     
		    if(!empty($txn_id)){ 
		        // Check if transaction data exists with the same TXN ID 
		        // $prevPayment = $db->query("SELECT id FROM user_subscriptions WHERE txn_id = '".$txn_id."'");

		        $prevPayment = $this->db->get_where('user_subscriptions', ['txn_id' => $txn_id])->num_rows();  
		         
		        if($prevPayment > 0){ 
		            exit(); 
		        }else{ 
		            // Insert transaction data into the database 
		            // $insert = $db->query("INSERT INTO user_subscriptions(user_id,validity,valid_from,valid_to,item_number,txn_id,payment_gross,currency_code,subscr_id,payment_status,payer_email) VALUES('".$custom."','".$subscr_period."','".$subscr_date."','".$subscr_date_valid_to."','".$item_number."','".$txn_id."','".$payment_gross."','".$currency_code."','".$subscr_id."','".$payment_status."','".$payer_email."')");

		            $data_subscription = [
						'user_id' => $custom,
						'validity' => $subscr_period,
						'valid_from' => $subscr_date,
						'valid_to' => $subscr_date_valid_to,
						'item_number' => $item_number,
						'txn_id' => $txn_id,
						'payment_gross' => $payment_gross,
						'currency_code' => $currency_code,
						'subscr_id' => $subscr_id,
						'payment_status' => $payment_status,
						'payer_email' => $payer_email
					];

					$this->db->insert('user_subscriptions', $data_subscription);

					$insert_id = $this->db->insert_id();
		             
		            // Update subscription id in the users table 

		            if($insert && !empty($custom)){ 
		            	$data_update = [
							'subscription_id' => $insert_id
						];
						$this->db->where('id', $custom);
						$this->db->update('users', $data_update);

		                // $subscription_id = $db->insert_id; 
		                // $update = $db->query("UPDATE users SET subscription_id = {$subscription_id} WHERE id = {$custom}"); 
		            } 
		        } 
		    } 
		} 
	}

}