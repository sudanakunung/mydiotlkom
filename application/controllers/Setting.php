<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->has_userdata('memberLogin')) {
			redirect('login','refresh');
		}
		
		$this->load->helper('html');
		$this->load->helper('string');
	}

	public function index()
	{	
		$navbar_back = true;
		$title = 'Settings';
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('setting');
		$this->load->view('footer');
	}
}