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
	}

	public function index()
	{
		if (!$this->session->has_userdata('memberLogin')) {
			redirect('login','refresh');
		}
		
		$keyword = $this->input->get('keyword');

		$sql = "SELECT * FROM users WHERE (name LIKE ? OR email LIKE ?) AND id != ?"; 
		$users = $this->db->query($sql, array('%'.$keyword.'%', '%'.$keyword.'%', $this->session->userdata('userId')))->result();

		$navbar_back = true;
		$title = 'Back';
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('search_friends', compact('users','keyword'));
	}

	public function search_friend_suggest()
	{
		$keyword = $this->input->post('keyword');
		
		if ($this->session->has_userdata('memberLogin')) {
			$sql = "SELECT * FROM users WHERE (name LIKE ? OR email LIKE ?) AND id != ?"; 
			$users = $this->db->query($sql, array('%'.$keyword.'%', '%'.$keyword.'%', $this->session->userdata('userId')))->result();
		} else {
			$sql = "SELECT * FROM users WHERE name LIKE ? OR email LIKE ?"; 
			$users = $this->db->query($sql, array('%'.$keyword.'%', '%'.$keyword.'%'))->result();
		}
		
		$html = '<div class="row">';

		foreach ($users as $value){

			if($key > 0){
				$border = 'style="border-top: solid 1px #d8d8d8;"';
			} else {
				$border = '';
			}
			
			$html .= '
			<div class="artist-suggest col-12 py-3 border-top" key-word="'.addslashes(str_replace(' ', '+', $value->id)).'" return false;" '.$border.'>
				<span>'.addslashes($value->name).'</span>
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

		$sql = "SELECT * FROM users WHERE (name LIKE ? OR email LIKE ?) AND id != ?"; 
		$users = $this->db->query($sql, array('%'.$keyword.'%', '%'.$keyword.'%', $this->session->userdata('userId')))->result();

		$html = '
		<p>Search for user \''.$keyword.'\'</p>
		<div class="row">';

		foreach ($users as $value){

			$countFollowers = $this->db->get_where('follow_friends', ['following_user_id' => $value->id])->num_rows();

			$countFollowing = $this->db->get_where('follow_friends', ['user_id' => $value->id])->num_rows();

			if($value->image_profile <> null || !empty($value->image_profile)){
				$src_profile = base_url('uploads/profile/').$value->image_profile;
			} else {
				$src_profile = base_url('uploads/profile/default/default-profile.jpg');
			}
			
			$html .= '
			<div class="col-6 mb-3 friend" onClick="gotoProfile('.$value->id.'); return false">
				<div class="border p-1">
    				<p class="mb-1">
        				<img src="'.$src_profile.'" class="img-fluid mb-2">
        			</p>
    				<p class="mb-1 friend-name">
    					'.addslashes($value->name).'
    				</p>
    				<p class="mb-1 text-center friend-follow">
    					'.$countFollowers.' Follower | '.$countFollowing.' Following
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