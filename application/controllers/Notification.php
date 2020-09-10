<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// if (!$this->session->has_userdata('memberLogin')) {
		// 	redirect('login?next_url=notification','refresh');
		// }
		
		$this->load->helper('html');
		$this->load->helper('date');
		$this->load->model('M_Notification', 'notification');

		$this->load->library('curl'); 
		$this->client = new \GuzzleHttp\Client(['verify' => false , 'http_errors' => false]);
		$this->url_api = 'https://dev.mydiosing.com/mydio'; // untuk dev, besok dicomment
	}

	public function index()
	{
		
		if (!$this->session->has_userdata('memberLogin')) {
			redirect('login?next_url=notification');
		}

		// $userNotif = $this->notification->getUserNotif($this->session->userdata('userId'));

		$reqTime = date('YmdHis');

		$params = [
			'offset' => 0,
			'limit' => 30,
			'sessionId' => $this->session->userdata('sessionId'),
			'reqTime' => $reqTime,
			'sig' => genSignature($reqTime, $this->session->userdata('salt'))
		];

		$api_notification = $this->curl->simple_get(''.$this->url_api.'/Notification?' . http_build_query($params));

		$userNotif = json_decode($api_notification, true);

		$show_menu = true;
		$custom_title = true;
		$title = 'Notification';
		$this->load->view('header', compact('show_menu','custom_title','title'));
		$this->load->view('notification', compact('userNotif'));
		$this->load->view('footer');
	}
}