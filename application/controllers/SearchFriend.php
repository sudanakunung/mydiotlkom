<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SearchFriend extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		// if (!$this->session->has_userdata('memberLogin')) {
			// redirect('login','refresh');
		// }
		
		$this->load->helper('html');
		$this->load->helper('string');

		$this->load->library('curl');
		$this->client = new \GuzzleHttp\Client(['verify' => false, 'http_errors' => false]);
		$this->url_api = 'https://dev.mydiosing.com/mydio'; // untuk dev, besok dicomment
	}

	public function index()
	{
		// if (!$this->session->has_userdata('memberLogin')) {
		// 	redirect('login','refresh');
		// }
		
		$keyword = $this->input->get('keyword');

		// if ($this->session->has_userdata('memberLogin')) {
		// 	$sql = "SELECT * FROM users WHERE (name LIKE ? OR email LIKE ?) AND id != ?"; 
		// 	$users = $this->db->query($sql, array('%'.$keyword.'%', '%'.$keyword.'%', $this->session->userdata('userId')))->result();
		// } else {
		// 	$sql = "SELECT * FROM users WHERE name LIKE ? OR email LIKE ?"; 
		// 	$users = $this->db->query($sql, array('%'.$keyword.'%', '%'.$keyword.'%'))->result();
		// }

		$res_Friend = $this->client->request('GET', ''.$this->url_api.'/QueryUser', [
			'query' => [
				'type' => 'name',
				'query' => $keyword,
				'offset' => 0,
				'limit' => 10
			]
		]);

		$users = json_decode($res_Friend->getBody()->getContents(), TRUE);

		$navbar_back = true;
		$title = 'Back';
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('search_friends', compact('users','keyword'));
	}

	public function load_more_friends()
	{
		$keyword = $this->input->get('keyword');

		$get_last_number = $this->input->get('last_items');
		if($get_last_number){
			$offset = $get_last_number;
		} else {
			$offset = 0;
		}

		$res_Friend = $this->client->request('GET', ''.$this->url_api.'/QueryUser', [
			'query' => [
				'type' => 'name',
				'query' => $keyword,
				'offset' => $offset,
				'limit' => 10
			]
		]);

		$users = json_decode($res_Friend->getBody()->getContents(), TRUE);

		$html = '';

		foreach ($users['array'] as $key => $value) {
			// $countFollowers = $this->db->get_where('follow_friends', ['following_user_id' => $value->id])->num_rows();

			// $countFollowing = $this->db->get_where('follow_friends', ['user_id' => $value->id])->num_rows();

			if(!empty($value['urlPP']) || $value['urlPP'] != null) {
				$src_profile = $value['urlPP'];
			} else {
				$src_profile = base_url('uploads/profile/default/default-profile.jpg');
			}
			
			$html .= '
			<div class="col-6 mb-3 friend" onClick="gotoProfile('.$value['userId'].'); return false">
				<div class="border p-1">
    				<p class="mb-1">
        				<img src="'.$src_profile.'" class="friend-profile-box mb-2">
        			</p>
    				<p class="mb-1 friend-name">
    					'.addslashes($value['name']).'
    				</p>
    				<p class="mb-1 text-center friend-follow">
    					'.$value['follower'].' Follower | '.$value['following'].' Following
    				</p>    
				</div>				
			</div>
			';
		}

		echo $html;
	}

	public function search_friend_suggest()
	{
		$keyword = $this->input->post('keyword');
		
		// if ($this->session->has_userdata('memberLogin')) {
		// 	$sql = "SELECT * FROM users WHERE (name LIKE ? OR email LIKE ?) AND id != ?"; 
		// 	$users = $this->db->query($sql, array('%'.$keyword.'%', '%'.$keyword.'%', $this->session->userdata('userId')))->result();
		// } else {
		// 	$sql = "SELECT * FROM users WHERE name LIKE ? OR email LIKE ?"; 
		// 	$users = $this->db->query($sql, array('%'.$keyword.'%', '%'.$keyword.'%'))->result();
		// }
		
		$res_FriendSuggest = $this->client->request('GET', ''.$this->url_api.'/QueryUser', [
			'query' => [
				'type' => 'lite',
				'query' => $keyword
			]
		]);

		$searchFriendSuggest = json_decode($res_FriendSuggest->getBody()->getContents(), TRUE);

		$html = '<div class="row">';

		foreach ($searchFriendSuggest['array'] as $value){

			if($key > 0){
				$border = 'style="border-top: solid 1px #d8d8d8;"';
			} else {
				$border = '';
			}
			
			$html .= '
			<div class="artist-suggest col-12 py-3 border-top" key-word="'.addslashes(str_replace(' ', '+', $value['userId'])).'" return false;" '.$border.'>
				<span>'.addslashes($value['name']).'</span>
			</div>
			';
        }
		
		$html .= '</div>';

        $return = [
        	'html' => $html,
        ];

        header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function search_friend()
	{
		$keyword = $this->input->post('keyword');

		// if ($this->session->has_userdata('memberLogin')) {
		// 	$sql = "SELECT * FROM users WHERE (name LIKE ? OR email LIKE ?) AND id != ?"; 
		// 	$users = $this->db->query($sql, array('%'.$keyword.'%', '%'.$keyword.'%', $this->session->userdata('userId')))->result();
		// } else {
		// 	$sql = "SELECT * FROM users WHERE name LIKE ? OR email LIKE ?"; 
		// 	$users = $this->db->query($sql, array('%'.$keyword.'%', '%'.$keyword.'%'))->result();
		// }

		$params = [
			'type' => 'name',
			'query' => $keyword,
			'offset' => 0,
			'limit' => 50
		];

		$apiSearchFriend = $this->curl->simple_get(''.$this->url_api.'/QueryUser?' . http_build_query($params));

		$searchFriend = json_decode($apiSearchFriend, true);

		$html = '
		<p>Search for user \''.$keyword.'\'</p>
		<div class="row">';

		foreach ($searchFriend['array'] as $value){

			// $countFollowers = $this->db->get_where('follow_friends', ['following_user_id' => $value->id])->num_rows();

			// $countFollowing = $this->db->get_where('follow_friends', ['user_id' => $value->id])->num_rows();

			// if($value->image_profile <> null || !empty($value->image_profile)){
			// 	$src_profile = base_url('uploads/profile/').$value->image_profile;
			// } else {
			// 	$src_profile = base_url('uploads/profile/default/default-profile.jpg');
			// }
			
			$html .= '
			<div class="col-6 mb-3 friend" onClick="gotoProfile('.$value['userId'].'); return false">
				<div class="border p-1">
    				<p class="mb-1">
        				<img src="'.$value['urlPP'].'" class="img-fluid mb-2">
        			</p>
    				<p class="mb-1 friend-name">
    					'.addslashes($value['name']).'
    				</p>
    				<p class="mb-1 text-center friend-follow">
    					'.$value['follower'].' Follower | '.$value['following'].' Following
    				</p>    
				</div>				
			</div>
			';
        }
		
		$html .= '</div>';

        $return = [
        	'html' => $html,
        ];

        header('Content-Type: application/json');
    	echo json_encode($return);
	}
}