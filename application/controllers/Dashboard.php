<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	var $user = null;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
		if (!$this->session->has_userdata('user')) {
			redirect('admin-login','refresh');
		}
		$this->user = $this->session->userdata('user');
		$this->url = $this->uri->segment(1);
		$this->load->model('M_general', 'general');
	}

	public function index()
	{
		$data['admin'] = $this->user;
		$this->load->view('admin/index', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */ 