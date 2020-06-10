<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->has_userdata('memberLogin')) {
			redirect('login','refresh');
		}
		
		$this->load->helper('html');
		$this->load->helper('date');
		$this->load->model('M_Notification', 'notification');
	}

	public function index()
	{
		
		$userNotif = $this->notification->getUserNotif($this->session->userdata('userId'));

		$show_menu = true;
		$custom_title = true;
		$title = 'Notification';
		$this->load->view('header', compact('show_menu','custom_title','title'));
		$this->load->view('notification', compact('userNotif'));
		$this->load->view('footer');
	}
}