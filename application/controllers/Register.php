<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	
	public function __construct()

	{
		parent::__construct();
		
		if ($this->session->has_userdata('memberLogin')) {
			redirect('/','refresh');
		}

		$this->load->helper('html');
		$this->load->model('M_Users', 'users');
	}

	public function index()
	{	
		$hide_navbar = true;

		$this->load->view('header', compact('hide_navbar'));
		$this->load->view('register');
		// $this->load->view('footer');
	}

	public function store()
	{
		$checkEmail = $this->users->cekEmail();

		if(!$checkEmail){

			$this->users->store();
			
			$return = [
				'status' => 200,
				'message' => 'Successfully registered, please login to continue'
			];

		} else {

			$return = [
				'status' => 403,
				'message' => 'The email you entered is already registered, please login to continue.'
			];
		}

		header('Content-Type: application/json');
    	echo json_encode($return);
	}
}