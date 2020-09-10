<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Queue extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('html');
		$this->load->helper('string');

		$this->load->library('curl');
		$this->client = new \GuzzleHttp\Client(['verify' => false, 'http_errors' => false]);
		$this->url_api = 'https://dev.mydiosing.com/mydio';
	}

	public function index()
	{
		$navbar_back = true;
		$title = 'Back';
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('queue_list');
        $showScrollTop = true;
        $showQueueList = true;
		$this->load->view('footer', compact('showScrollTop','showQueueList'));
	}
}