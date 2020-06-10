<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Notification extends CI_Model {

	public function getUserNotif($userID)
	{
		$this->db->where('user_id', $userID);
		return $this->db->get('user_notifications')->result();
	}
}