<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Friends extends CI_Model {

	public function getLogActivity($userID)
	{
		$this->db->where('user_id', $userID);
		$this->db->join('users', 'users.id = follow_friends.following_user_id');
		$data = $this->db->get('follow_friends')->result();
	}

	public function getUser($userID)
	{
		$this->db->where('id', $userID);
		return $this->db->get('users')->row_array();
	}

	public function countFollowers($userid)
	{
		return $this->db->get_where('follow_friends', ['following_user_id' => $userid])->num_rows();
	}

	public function countFollowing($userid)
	{
		return $this->db->get_where('follow_friends', ['user_id' => $userid])->num_rows();
	}

	public function getFollowers($userid)
	{
		$this->db->select('*, follow_friends.id AS ffID');
		$this->db->where('following_user_id', $userid);
		$this->db->join('users', 'users.id = follow_friends.user_id');
		return $this->db->get('follow_friends')->result();
	}

	public function getFollowing($userid)
	{
		$this->db->select('*, follow_friends.id AS ffID');
		$this->db->where('user_id', $userid);
		$this->db->join('users', 'users.id = follow_friends.following_user_id');
		return $this->db->get('follow_friends')->result();
	}

	public function countFollowExist($friendId, $userId)
	{
		$this->db->where('following_user_id', $friendId);
		$this->db->where('user_id', $userId);
		$return = $this->db->get('follow_friends')->num_rows();

		return $return;
	}
	
	public function storeFollowFriend($data)
	{
		$data = array(
	        'user_id' => $data['user_id'],
	        'following_user_id' => $data['friend_id'],
	        'cerated_at' => date('Y-m-d H:i:s')
		);

		$this->db->insert('follow_friends', $data);
	}

	public function deleteFollowFriend($data){

		$this->db->where('user_id', $data['user_id']);
		$this->db->where('following_user_id', $data['friend_id']);
		$this->db->delete('follow_friends');

	}
}