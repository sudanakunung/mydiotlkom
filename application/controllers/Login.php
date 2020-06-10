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
		// $this->url_api = 'https://dev.mydiosing.com/mydio';
	}

	public function index()
	{
		
		if ($this->session->has_userdata('memberLogin')) {
			redirect('/','refresh');
		}

		$hide_navbar = true;

		$this->load->view('header', compact('hide_navbar'));
		$this->load->view('login/index');
		$this->load->view('footer');
	}

	// public function email($string1 = 'kelompok2ims@gmail.com', $string2 = 'qwertyuiop')
	// {	
	// 	$a = hash('sha256', 'jake', true);

	// 	var_dump (unpack("s*" , $a));
	// 	die();

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
 //            $sigLonger = true;
 //            $result = $byteSig;
 //        } else {
 //            $sigLonger = false;
 //            $result = $byteSalt;
 //        }

 //        for ($i=0; $i < count($result) ; $i++) {
 //        	if ($sigLonger) {
 //                $b1 = $byteSig[$i];
 //                $b2 = $byteSalt[$i % $byteSalt_lenght];
 //            } else {
 //                $b1 = $byteSig[$i % $byteSig_lenght];
 //                $b2 = $byteSalt[$i];
 //            }

 //            $r = $b1 ^ $b2;

 //            $result[$i] = $r;
 //        }

 //        $hash = base64_encode(hash("SHA256", serialize($result), true));

	// 	var_dump ($hash);
	// 	die();
	// }

	public function showloginemail()
	{
		$hide_navbar = true;

		$this->load->view('header', compact('hide_navbar'));
		$this->load->view('login/email');
		$this->load->view('footer');
	}

	public function email()
	{	
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('users', ['email' => $email])->row_array();

		//Cek jika user ada atau tidak
		if($user){
			//Cek jika user aktif atau tidak
			if(password_verify($password, $user['password'])){
				
				$data_session = [
					'memberLogin' => 1,
					'using' => 'email',
					'userId' => $user['id'],
				];

				$this->session->set_userdata($data_session);

				$data_update = [
					'login_from' => 'email'
				];

				$this->db->where('email', $user['email']);
				$this->db->update('users', $data_update);

				$return = [
					'status' => 200,
					'message' => ''
				];	
			}
			else{
				$return = [
					'status' => 403,
					'message' => 'Wrong password!.'
				];
			}
		}
		else{
			$return = [
				'status' => 403,
				'message' => 'Email is not registered.'
			];
		}

		header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function facebook()
	{
		// $param = [
		// 	'using' => 'fb',
		// 	'token' => $this->input->post('accessToken', true),
		// 	'deviceId' => random_string('alnum', 24)
		// ];

		// $data = $this->curl->simple_get('https://mydiosing.com:8843/mydio/Login?'.http_build_query($param));
		
		// $respones = json_decode($data, true);

		$date = str_replace('/', '-', $this->input->post('birthday'));
		$birthday = date('Y-m-d', strtotime($date));
		$name = $this->input->post('first_name').' '.$this->input->post('last_name');

		$user = $this->db->get_where('users', ['email' => $this->input->post('email')])->row_array();

		if($user){

			$data_update = [
				'login_from' => 'fb',
				'accsess_token' => $this->input->post('accessToken'),
				'birthday' => $birthday,
				'name' => $name
			];

			$this->db->where('email', $user['email']);
			$this->db->update('users', $data_update);

			$user_id = $user['id'];

		} else {

			$data = [
				'email' => $this->input->post('email'),
				'login_from' => 'fb',
				'accsess_token' => $this->input->post('accessToken'),
				'birthday' => $birthday,
				'name' => $name
			];

			$this->db->insert('users', $data);

			$user_id = $this->db->insert_id();
		}

		$data_session = array(
			'memberLogin' => 1,
			'using' => 'fb',
			'userId' => $user_id,
		);

		$this->session->set_userdata($data_session);

		$return = [
			'status' => 200
		];

		header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function google()
	{
		$param = [
			'id_token' => $this->input->post('idToken'),
		];

		$data = $this->curl->simple_get('https://oauth2.googleapis.com/tokeninfo?'.http_build_query($param));

		$respones = json_decode($data, true);

		if($respones['errCode'] == 10060){
			
			$return = [
				'status' => 400,
				'message' => $respones['error'],
			];

		} else {

			$user = $this->db->get_where('users', ['email' => $respones['email']])->row_array();

			if($user){

				$data_update = [
					'login_from' => 'google',
					'accsess_token' => $this->input->post('idToken'),
					'birthday' => $birthday,
					'name' => $respones['name']
				];

				$this->db->where('email', $user['email']);
				$this->db->update('users', $data_update);

				$user_id = $user['id'];

			} else {

				$data = [
					'email' => $respones['email'],
					'login_from' => 'google',
					'accsess_token' => $this->input->post('idToken'),
					'name' => $respones['name']
				];

				$this->db->insert('users', $data);

				$user_id = $this->db->insert_id();
			}

			$data_session = array(
				'memberLogin' => 1,
				'using' => 'google',
				'userId' => $user_id,
			);

			$this->session->set_userdata($data_session);

			$return = [
				'status' => 200
			];
		}

		header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function logout()
	{
		if($this->session->userdata('using') == 'fb'){ ?>
			
			<script type="text/javascript">
				FB.logout(function(response) {});
			</script>

		<?php
		}

		$this->session->unset_userdata('memberLogin');
		$this->session->unset_userdata('using');
		$this->session->unset_userdata('userId');

		$this->session->sess_destroy();
        redirect('/');
	}
}