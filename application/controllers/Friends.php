<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Friends extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		/* if (!$this->session->has_userdata('memberLogin')) {
			redirect('login?next_url=friends','refresh');
		} */
		
		$this->load->helper('html');
		$this->load->helper('string');
		$this->load->model('M_Friends', 'friends');

		$this->load->library('curl');
		$this->client = new \GuzzleHttp\Client(['verify' => false]);
		$this->url_api = 'https://dev.mydiosing.com/mydio'; // untuk dev, besok dicomment
	}

	public function index()
	{	
		if (!$this->session->has_userdata('memberLogin')) {
			redirect('login?next_url=friends');
		}
		
		// $friendFeeds = $this->friends->getLogActivity($this->session->userdata('userId'));

		$res_myfriends = $this->client->request('GET', ''.$this->url_api.'/QueryRecording', [
			'query' => [
				'type' => 'myfriends',
				'id' => $this->session->userdata('userId'),
				'offset' => 0,
				'limit' => 30
			]
		]);

		$friendFeeds = json_decode($res_myfriends->getBody()->getContents(), TRUE);
		
		// $this->output->cache(60);
		
		$show_menu = true;
		$custom_title = true;
		$title = 'Friends';
		$this->load->view('header', compact('show_menu','custom_title','title'));
		$this->load->view('friends', compact('friendFeeds'));
		$this->load->view('footer');
	}

	public function profile($id)
	{
		// $user = $this->friends->getUser($id);
		// $count_followers = $this->friends->countFollowers($id);
		// $count_following = $this->friends->countFollowing($id);
		// $get_followers = $this->friends->getFollowers($id);
		// $get_following = $this->friends->getFollowing($id);
		// $count_follow_exist = $this->friends->countFollowExist($id, $this->session->userdata('userId'));

		$res_friend_profile = $this->client->request('GET', ''.$this->url_api.'/QueryUser', [
			'query' => [
				'type' => 'userId',
				'query' => $id
			]
		]);
		$user = json_decode($res_friend_profile->getBody()->getContents(), TRUE);
		$user = $user['array'][0];

		$res_recording = $this->client->request('GET', ''.$this->url_api.'/QueryRecording', [
			'query' => [
				'type' => 'userId',
				'id' => $id,
				'offset' => 0,
				'limit' => 50
			]
		]);
		$recording = json_decode($res_recording->getBody()->getContents(), TRUE);

		if ($this->session->has_userdata('memberLogin')) {

			$reqTime = date('YmdHis');

			$res_user_followers = $this->client->request('GET', ''.$this->url_api.'/Follower', [
				'query' => [
					'type' => 'follower',
					'otherId' => $id,
					'sessionId' => $this->session->userdata('sessionId'),
					'reqTime' => $reqTime,
					'sig' => genSignature($reqTime, $this->session->userdata('salt'))
				]
			]);

			$res_user_following = $this->client->request('GET', ''.$this->url_api.'/Follower', [
				'query' => [
					'type' => 'following',
					'otherId' => $id,
					'sessionId' => $this->session->userdata('sessionId'),
					'reqTime' => $reqTime,
					'sig' => genSignature($reqTime, $this->session->userdata('salt'))
				]
			]);

			$res_isfollowing = $this->client->request('GET', ''.$this->url_api.'/Follower', [
				'query' => [
					'type' => 'isfollowing',
					'otherId' => $id,
					'sessionId' => $this->session->userdata('sessionId'),
					'reqTime' => $reqTime,
					'sig' => genSignature($reqTime, $this->session->userdata('salt'))
				]
			]);

			$followers = json_decode($res_user_followers->getBody()->getContents(), TRUE);
			$following = json_decode($res_user_following->getBody()->getContents(), TRUE);
			$isfollowing = json_decode($res_isfollowing->getBody()->getContents(), TRUE);
			
		} else {

			$followers = '';
			$following = '';
			$isfollowing = '';

		}

		// $this->output->cache(60);

		$navbar_back = true;
		$title = $user['name'];
		$this->load->view('header', compact('navbar_back','title'));
		// $this->load->view('friend_profile', compact('user','count_followers','count_following','get_followers','get_following','count_follow_exist'));
		$this->load->view('friend_profile', compact('user','followers','following','isfollowing','recording'));
		$this->load->view('footer');
	}

	public function follow()
	{
		// $data = [
		// 	"friend_id" => $this->input->post('friend_id'),
		// 	"user_id" => $this->session->userdata('userId'),
		// ];
		
		// $this->friends->storeFollowFriend($data);

		$reqTime = date('YmdHis');

		$res_follow = $this->client->request('GET', ''.$this->url_api.'/Follower', [
			'query' => [
				'type' => 'follow',
				'otherId' => $this->input->post('friend_id'),
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);

		$follow = json_decode($res_follow->getBody()->getContents(), TRUE);

		if($follow['success'] == 1){
			$return = [
				"status" => 200,
				"message" => "Successfully followed",
				"status_follow" => 1
			];
		} else {
			$return = [
				"status" => 403,
				"message" => "Unsuccessfully followed, please try again"
			];
		}

		header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function unfollow()
	{
		// $data = [
		// 	"friend_id" => $this->input->post('friend_id'),
		// 	"user_id" => $this->session->userdata('userId'),
		// ];
		
		// $count_followers = $this->friends->deleteFollowFriend($data);

		$reqTime = date('YmdHis');

		$res_unfollow = $this->client->request('GET', ''.$this->url_api.'/Follower', [
			'query' => [
				'type' => 'unfollow',
				'otherId' => $this->input->post('friend_id'),
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);

		$unfollow = json_decode($res_unfollow->getBody()->getContents(), TRUE);

		if($unfollow['success'] == 1){
			$return = [
				"status" => 200,
				"message" => "Successfully unfollowed",
				"status_follow" => 0
			];
		} else {
			$return = [
				"status" => 403,
				"message" => "Unsuccessfully unfollowed, please try again"
			];
		}

		header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function store_feed_like(){
		
		// $store = $this->friends->storeLikeFeed();

		$reqTime = date('YmdHis');

		$params = [
			'type' => 'recording',
			'id' => $this->input->post('recordingID'),
			'sessionId' => $this->session->userdata('sessionId'),
			'reqTime' => $reqTime,
			'sig' => genSignature($reqTime, $this->session->userdata('salt'))
		];

		$api_like = $this->curl->simple_get(''.$this->url_api.'/Like?' . http_build_query($params));

		$like = json_decode($api_like, true);

		if(!empty($like)){
			if($like['countLike'] == -1){
				$status = 400;
				$message = "Unsuccessfully liked";
			} else {
				$status = 200;
				$message = "Successfully liked";
			}
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

	public function delete_feed_like(){
		
		// $delete = $this->friends->deleteLikeFeed();

		$reqTime = date('YmdHis');

		$params = [
			'type' => 'recording',
			'unlike' => 1,
			'id' => $this->input->post('recordingID'),
			'sessionId' => $this->session->userdata('sessionId'),
			'reqTime' => $reqTime,
			'sig' => genSignature($reqTime, $this->session->userdata('salt'))
		];

		$api_unlike = $this->curl->simple_get(''.$this->url_api.'/Like?' . http_build_query($params));

		$unlike = json_decode($api_unlike, true);

		if(!empty($unlike)){
			if($like['countLike'] == -1){
				$status = 400;
				$message = "Unsuccessfully unliked";
			} else {
				$status = 200;
				$message = "Successfully unliked";
			}
		} else {
			$status = 400;
			$message = "Unsuccessfully unliked";
		}

		$return = [
			"status" => $status,
			"message" => $message
		];

		header('Content-Type: application/json');
    	echo json_encode($return);
	}
}