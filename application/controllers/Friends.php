<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Friends extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// if (!$this->session->has_userdata('memberLogin')) {
		// 	redirect('login','refresh');
		// }
		
		$this->load->helper('html');
		$this->load->model('M_Friends', 'friends');
	}

	public function index()
	{	
		if (!$this->session->has_userdata('memberLogin')) {
			redirect('login','refresh');
		}
		
		$friendsActivity = $this->friends->getLogActivity($this->session->userdata('userId'));

		$show_menu = true;
		$custom_title = true;
		$title = 'Friends';
		$this->load->view('header', compact('show_menu','custom_title','title'));
		$this->load->view('friends');
		$this->load->view('footer');
	}

	public function profile($id)
	{
		$user = $this->friends->getUser($id);

		$count_followers = $this->friends->countFollowers($id);

		$count_following = $this->friends->countFollowing($id);

		$get_followers = $this->friends->getFollowers($id);

		$get_following = $this->friends->getFollowing($id);

		$count_follow_exist = $this->friends->countFollowExist($id, $this->session->userdata('userId'));

		$navbar_back = true;
		$title = $user['name'];
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('friend_profile', compact('user','count_followers','count_following','get_followers','get_following','count_follow_exist'));
		$this->load->view('footer');
	}

	public function follow()
	{
		$data = [
			"friend_id" => $this->input->post('friend_id'),
			"user_id" => $this->session->userdata('userId'),
		];
		
		$this->friends->storeFollowFriend($data);

		$return = [
			"status" => 200,
			"message" => "Successfully followed",
			"status_follow" => 1
		];

		header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function unfollow()
	{
		$data = [
			"friend_id" => $this->input->post('friend_id'),
			"user_id" => $this->session->userdata('userId'),
		];
		
		$count_followers = $this->friends->deleteFollowFriend($data);

		$return = [
			"status" => 200,
			"message" => "Successfully unfollowed",
			"status_follow" => 0
		];

		header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function store_feed_like(){
		
		$store = $this->friends->storeLikeFeed();

		if($store){
			$status = 200;
			$message = "Successfully liked";
		} else {
			$status = 400;
			$message = "Unsuccessfully liked";
		}

		$return = [
			"status" => $status,
			"message" => $message
		];

		header('Content-Type: application/json');
    	echo json_encode($return);
	}
}