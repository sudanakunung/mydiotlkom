<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	
	public function __construct()

	{
		parent::__construct();
		
		// if ($this->session->has_userdata('memberLogin')) {
		// 	redirect('/','refresh');
		// }

		$this->load->helper('html');
		$this->load->helper('string');
		$this->load->model('M_Users', 'users');

		$this->load->library('curl');
		$this->client = new \GuzzleHttp\Client(['verify' => false, 'http_errors' => false]);
		$this->url_api = 'https://dev.mydiosing.com/mydio'; // untuk dev, besok dicomment
	}

	public function index()
	{	
		if ($this->session->has_userdata('memberLogin')) {
			redirect('/');
		}

		// $this->output->cache(60);
		
		$hide_navbar = true;
		$this->load->view('header', compact('hide_navbar'));
		$this->load->view('register/register');
		$this->load->view('footer');
	}

	public function store()
	{
		// $checkEmail = $this->users->cekEmail();

		// if(!$checkEmail){

		// 	$this->users->store();
			
		// 	$return = [
		// 		'status' => 200,
		// 		'message' => 'Successfully registered, please login to continue'
		// 	];

		// } else {

		// 	$return = [
		// 		'status' => 403,
		// 		'message' => 'The email you entered is already registered, please login to continue.'
		// 	];
		// }

		// header('Content-Type: application/json');
		// echo json_encode($return);

		$param = [
			'email' => $this->input->post('email', true),
			'name' => $this->input->post('name', true),
			'hash' => $this->input->post('password'),
			'deviceId' => random_string('alnum', 24),
			'gender' => $this->input->post('sex', true),
			'relationship' => $this->input->post('status', true),
			'birthdate' => $this->input->post('birthday', true),
			'location' => $this->input->post('address', true),
			'agent' => 'web'
		];

		// $data = $this->curl->simple_post('https://mydiosing.com:8843/mydio/Login', $param);
		$data = $this->curl->simple_post(''.$this->url_api.'/Signup', $param);

		$respones = json_decode($data, true);

		if(!empty($respones) || $respones <> null){
			// $this->sent_verification_email($this->input->post('name', true), $this->input->post('email', true), $respones['id'], $respones['$respones']);
			
			redirect('register/success?email='.$this->input->post('email', true).'&name='.$this->input->post('name', true));
		} else {
			echo '
			<script type="text/javascript">
                alert("Registration failed, please try again");
            </script>';
		}
	}

	public function resend_email()
	{
		$email = $this->input->post('email');
		$name = $this->input->post('name');

		$param = [
			'email' => $email
		];

		// $data = $this->curl->simple_post('https://mydiosing.com:8843/mydio/Login', $param);
		$data = $this->curl->simple_get(''.$this->url_api.'/Verify?'.http_build_query($param));

		$respones = json_decode($data, true);

		if(!empty($respones)){			
			$return = [
				'status' => 200,
				'message' => 'The email was successfully sent, please check the inbox in your email.'
			];
		} else {
			$return = [
				'status' => 403,
				'message' => 'The email failed to send, please click here to resend the verification email.'
			];
		}

		header('Content-Type: application/json');
		echo json_encode($return);
	}

	public function success()
	{
		$email = $this->input->get('email');
		$name = $this->input->get('name');

		$hide_navbar = true;
		$this->load->view('header', compact('hide_navbar'));
		$this->load->view('register/success', compact('email', 'name'));
		$this->load->view('footer');
	}

	public function verify()
	{
		$id = $this->input->get('id');
		$token = $this->input->get('token');

		$param_verify = [
			'id' => $id
		];

		// $data = $this->curl->simple_post('https://mydiosing.com:8843/mydio/Login', $param);
		$data = $this->curl->simple_get(''.$this->url_api.'/Verify?'.http_build_query($param));
		
		$param_signup_dua = [
			'continue' => 1,
			'id' => $id,
			'token' => $token
		];

		// $data = $this->curl->simple_post('https://mydiosing.com:8843/mydio/Login', $param);
		$data_signup_dua = $this->curl->simple_get(''.$this->url_api.'/Signup?'.http_build_query($param));

		$respones = json_decode($data_signup_dua, true);

		if(!empty($respones)){
			$sukses = true;
			$message = "Congratulations you have verified your account.";
		} else {
			$sukses = false;
			$message = "Your account failed to be verified, please resend the verification email.";
		}

		$hide_navbar = true;
		$this->load->view('header', compact('hide_navbar'));
		$this->load->view('register/verify', compact('sukses', 'message'));
		$this->load->view('footer');
	}
}