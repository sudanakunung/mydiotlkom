<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Users extends CI_Model {

	public function cekEmail()
	{
		return $this->db->get_where('users', ['email' => $this->input->post('email', true)])->row_array();
	}

	public function store()
	{
		$data = [
			'name' => $this->input->post('name', true),
			'email' => $this->input->post('email', true),
			'birthday' => $this->input->post('birthday', true),
			'sex' => $this->input->post('sex', true),
			'status' => $this->input->post('status', true),
			'address' => $this->input->post('address', true),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
		];

		$this->db->insert('users', $data);
	}

	public function getUser($userid)
	{
		return $this->db->get_where('users', ['id' => $userid])->row_array();
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

	public function updateProfile($userid)
	{
		$data = array(
	        'name' => $this->input->post('name', true),
	        'my_mood' => $this->input->post('my_mood', true),
	        'birthday' => $this->input->post('birthday', true),
	        'sex' => $this->input->post('sex', true),
	        'status' => $this->input->post('status', true),
		);

		$this->db->where('id', $userid);
		$this->db->update('users', $data);
	}

	public function logActivity($userid)
	{
		$data = [
			'log_activity' => $this->input->post('update mood', true),
			'description' => $this->input->post('my_mood', true),
			'user_id' => $userid,
			'created_at' => date('Y-m-d H:i:s')
		];

		$this->db->insert('user_log_activity', $data);
	}
}