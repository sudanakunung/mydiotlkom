<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProfileMember extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->session->has_userdata('memberLogin')) {
			redirect('login','refresh');
		}

		$this->load->helper('html');
		$this->load->model('M_Users', 'user');
	}

	public function index()
	{
		$user = $this->user->getUser($this->session->userdata('userId'));
		
		$count_followers = $this->user->countFollowers($this->session->userdata('userId'));

		$count_following = $this->user->countFollowing($this->session->userdata('userId'));

		$get_followers = $this->user->getFollowers($this->session->userdata('userId'));

		$get_following = $this->user->getFollowing($this->session->userdata('userId'));

		$navbar_back = true;
		$title = 'Back';
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('profile_member', compact('user','count_followers','count_following','get_followers','get_following'));
		$this->load->view('footer');
	}

	public function unfollow(){
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete('follow_friends');
	}

	public function edit_profile()
	{
		$user = $this->user->getUser($this->session->userdata('userId'));

		$navbar_back = true;
		$title = 'Edit Profile';
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('edit_profile', compact('user'));
		$this->load->view('footer');
	}

	public function update()
	{
		$user = $this->user->updateProfile($this->session->userdata('userId'));

		redirect('profile', 'refresh');//no valid uri segment
	}
}