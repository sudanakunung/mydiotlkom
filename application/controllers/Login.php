<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('html');
		$this->load->helper('string');
		$this->load->model('M_Users', 'users');

		$this->load->library('curl');
		$this->client = new \GuzzleHttp\Client(['verify' => false , 'http_errors' => false]);
		$this->url_api = 'https://dev.mydiosing.com/mydio'; // untuk dev, besok dicomment
	}

	public function index()
	{
		if ($this->session->has_userdata('memberLogin')) {
			redirect('/','refresh');
		}

		$next_url = $this->input->get('next_url');
		
		$this->load->library('google'); 
		$linkOuthGoogle = $this->google->createAuthUrl();

		// $this->output->cache(60);
		
		$hide_navbar = true;
		$this->load->view('header', compact('hide_navbar'));
		$this->load->view('login/index', compact('next_url','linkOuthGoogle'));
		$this->load->view('footer');
	}

	public function google()
	{

		$this->load->library('google'); 

		if(isset($_GET['code'])){

			// Otentikasi pengguna dengan google
			$data_backend = $this->curl->simple_get(''.$this->url_api.'/Login?using=google&authCode='.$_GET['code'].'');
			
			$respones = json_decode($data_backend, true);

			if(!empty($respones)){
				$data_session = [
					'memberLogin' => 1,
					'using' => 'google',
					'userId' => $respones['userId'],
					// 'userEmail' => $respones_goole['email'],
					'salt' => $respones['salt'],
					'sessionId' => $respones['sessionId']
				];

				$this->session->set_userdata($data_session);

				redirect('/');
			} else {
				$message = "Something went wrong please try again";

				redirect(base_url(), compact($message));
			}
		} else {
			$message = "Something went wrong please try again";

			redirect(base_url(), compact($message));
		}


		// $param = [
		// 	'id_token' => $this->input->post('idToken'),
		// ];

		// $data = $this->curl->simple_get('https://oauth2.googleapis.com/tokeninfo?'.http_build_query($param));

		// $respones = json_decode($data, true);

		// if($respones['errCode'] == 10060){
			
		// 	$return = [
		// 		'status' => 400,
		// 		'message' => $respones['error'],
		// 	];

		// } else {

		// 	$user = $this->db->get_where('users', ['email' => $respones['email']])->row_array();

		// 	if($user){

		// 		$data_update = [
		// 			'login_from' => 'google',
		// 			'accsess_token' => $this->input->post('idToken'),
		// 			'birthday' => $birthday,
		// 			'name' => $respones['name']
		// 		];

		// 		$this->db->where('email', $user['email']);
		// 		$this->db->update('users', $data_update);

		// 		$user_id = $user['id'];

		// 	} else {

		// 		$data = [
		// 			'email' => $respones['email'],
		// 			'login_from' => 'google',
		// 			'accsess_token' => $this->input->post('idToken'),
		// 			'name' => $respones['name']
		// 		];

		// 		$this->db->insert('users', $data);

		// 		$user_id = $this->db->insert_id();
		// 	}

		// 	$data_session = array(
		// 		'memberLogin' => 1,
		// 		'using' => 'google',
		// 		'userId' => $user_id,
		// 	);

		// 	$this->session->set_userdata($data_session);

		// 	$return = [
		// 		'status' => 200
		// 	];
		// }

		// header('Content-Type: application/json');
		// echo json_encode($return);
	}

	// public function email($string1 = 'kelompok2ims@gmail.com', $string2 = 'qwertyuiop')
	// {	
	// 	$a = hash('sha256', 'jake', true);

	// 	$b = array();
	// 	for ($i=0; $i < strlen($a); $i++) { 
	// 		$b[] = dechex($a[$i]);
	// 	}

	// 	var_dump ($b);
	// 	die();

	// 	$byteSig = array();
	// 	for($i = 0; $i < strlen($string1); $i++){
	// 	     $byteSig[] = ord($string1[$i]);
	// 	}

	// 	$byteSalt = array();
	// 	for($i = 0; $i < strlen($string2); $i++){
	// 	     $byteSalt[] = ord($string2[$i]);
	// 	}

	// 	$byteSig_lenght = strlen($string1);
	// 	$byteSalt_lenght = strlen($string2);

	// 	if ($byteSig_lenght == 0 || $byteSalt_lenght == 0){
	// 		return null;
	// 	}

	// 	if ($byteSig_lenght >= $byteSalt_lenght) {
	//     $sigLonger = true;
	//     $result = $byteSig;
	// } else {
	//     $sigLonger = false;
	//     $result = $byteSalt;
	// }

	// for ($i=0; $i < count($result) ; $i++) {
	// 	if ($sigLonger) {
	//         $b1 = $byteSig[$i];
	//         $b2 = $byteSalt[$i % $byteSalt_lenght];
	//     } else {
	//         $b1 = $byteSig[$i % $byteSig_lenght];
	//         $b2 = $byteSalt[$i];
	//     }

	//     $r = $b1 ^ $b2;

	//     $result[$i] = $r;
	// }

	// $hash = base64_encode(hash("SHA256", serialize($result), true));
	// }

	public function showloginemail()
	{
		// $this->output->cache(60);
		
		$hide_navbar = true;
		$this->load->view('header', compact('hide_navbar'));
		$this->load->view('login/email');
		$this->load->view('footer');
	}

	public function email()
	{	
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$next_url = $this->input->post('next_url');
		
		$param = [
			'email' => $email,
			'hash' => $password,
			'agent' => 'web'
		];

		$res = $this->client->request('GET', ''.$this->url_api.'/Login', ['query' => $param ]);

		$result = json_decode($res->getBody()->getContents(), TRUE);

		if($res->getStatusCode() == 200){
			
			$reqTime = date('YmdHis');

			$res_get_sig = $this->client->request('GET', ''.$this->url_api.'/QueryUser', [
				'query' => [
					'type' => 'me',
					'otherId' => $result['userId'],
					'sessionId' => $result['sessionId'],
					'reqTime' => $reqTime,
					'sig' => genSignature($reqTime, $result['salt'])
				]
			]);

			$result_sig = json_decode($res_get_sig->getBody()->getContents(), TRUE);

			if($res_get_sig->getStatusCode() == 200){

				$data_session = [
					'memberLogin' => 1,
					'using' => 'email',
					'userId' => $result['userId'],
					'userEmail' => $email,
					'salt' => $result['salt'],
					'sessionId' => $result['sessionId'],
				];

				$this->session->set_userdata($data_session);

				$return = [
					'status' => 200,
					'message' => ''
				];

			} else {
				$return = [
					'status' => $res_get_sig->getStatusCode(),
					'message' => $result_sig['error']
				];
			}

		} else {
			$return = [
				'status' => $res->getStatusCode(),
				'message' => $result['error']
			];
		}

		header('Content-Type: application/json');
		echo json_encode($return);

		// header('Content-Type: application/json');
		// echo json_encode($return);

		// $user = $this->db->get_where('users', ['email' => $email])->row_array();

		// //Cek jika user ada atau tidak
		// if($user){
		// 	//Cek jika user aktif atau tidak
		// 	if(password_verify($password, $user['password'])){
				
		// 		$data_session = [
		// 			'memberLogin' => 1,
		// 			'using' => 'email',
		// 			'userId' => $user['id'],
		// 			'userEmail' => $user['email']
		// 		];

		// 		$this->session->set_userdata($data_session);

		// 		$data_update = [
		// 			'login_from' => 'email'
		// 		];

		// 		$this->db->where('email', $user['email']);
		// 		$this->db->update('users', $data_update);

		// 		$return = [
		// 			'status' => 200,
		// 			'message' => ''
		// 		];	
		// 	}
		// 	else{
		// 		$return = [
		// 			'status' => 403,
		// 			'message' => 'Wrong password!.'
		// 		];
		// 	}
		// }
		// else{
		// 	$return = [
		// 		'status' => 403,
		// 		'message' => 'Email is not registered.'
		// 	];
		// }

		// header('Content-Type: application/json');
		// echo json_encode($return);
	}

	public function facebook()
	{
		$param = [
			'using' => 'fb',
			'token' => $this->input->post('accessToken', true),
			'deviceId' => random_string('alnum', 24)
		];

		// $data = $this->curl->simple_get('https://mydiosing.com:8843/mydio/Login?'.http_build_query($param));

		$data = $this->curl->simple_get(''.$this->url_api.'/Login?'.http_build_query($param));
		
		$respones = json_decode($data, true);

		if(!empty($respones)){
			$data_session = [
				'memberLogin' => 1,
				'using' => 'facebook',
				'userId' => $respones['userId'],
				// 'userEmail' => $email,
				'salt' => $respones['salt'],
				'sessionId' => $respones['sessionId'],
				'refArtistId' => $respones['refArtistId'],
			];

			$this->session->set_userdata($data_session);

			$return = [
				'status' => 200,
				'message' => ''
			];
		} else {
			$return = [
				'status' => 403,
				'message' => 'Sorry an error occurred while processing data, please try again'
			];
		}

		// $date = str_replace('/', '-', $this->input->post('birthday'));
		// $birthday = date('Y-m-d', strtotime($date));
		// $name = $this->input->post('first_name').' '.$this->input->post('last_name');

		// $user = $this->db->get_where('users', ['email' => $this->input->post('email')])->row_array();

		// if($user){

		// 	$data_update = [
		// 		'login_from' => 'fb',
		// 		'accsess_token' => $this->input->post('accessToken'),
		// 		'birthday' => $birthday,
		// 		'name' => $name
		// 	];

		// 	$this->db->where('email', $user['email']);
		// 	$this->db->update('users', $data_update);

		// 	$user_id = $user['id'];

		// } else {

		// 	$data = [
		// 		'email' => $this->input->post('email'),
		// 		'login_from' => 'fb',
		// 		'accsess_token' => $this->input->post('accessToken'),
		// 		'birthday' => $birthday,
		// 		'name' => $name
		// 	];

		// 	$this->db->insert('users', $data);

		// 	$user_id = $this->db->insert_id();
		// }

		// $data_session = array(
		// 	'memberLogin' => 1,
		// 	'using' => 'fb',
		// 	'userId' => $user_id,
		// );

		// $this->session->set_userdata($data_session);

		// $return = [
		// 	'status' => 200
		// ];

		header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function logout()
	{
		
		$reqTime = date('YmdHis');

		$param_user = [
			'out' => 1,
			'sessionId' => $this->session->userdata('sessionId'),
			'reqTime' => $reqTime,
			'sig' => genSignature($reqTime, $this->session->userdata('salt'))
		];

		$this->curl->simple_get(''.$this->url_api.'/Login?'.http_build_query($param));

		$this->load->library('google');
		$this->google->revokeToken();

		if($this->session->userdata('using') == 'fb'){ ?>
					
			<script type="text/javascript">
				FB.logout(function(response) {});
			</script>

		<?php
		}

		if($this->session->userdata('using') == 'google'){ ?>
			
			<script>
			  	var auth2 = gapi.auth2.getAuthInstance();
			    auth2.signOut().then(function () {
			      	console.log('User signed out.');
			    });
			</script>

		<?php
		}

		$this->session->unset_userdata('memberLogin');
		$this->session->unset_userdata('using');
		$this->session->unset_userdata('userId');
		$this->session->unset_userdata('userEmail');
		$this->session->unset_userdata('salt');
		$this->session->unset_userdata('sessionId');
		$this->session->unset_userdata('refArtistId');

		$this->session->sess_destroy();
        redirect(base_url());
    }
}