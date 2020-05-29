<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Messenger extends CI_Model {

	public function getFriends($userID)
	{

		$this->db->where('user_id', $userID);
		$this->db->join('users', 'users.id = follow_friends.following_user_id');
		$data = $this->db->get('follow_friends')->result();

		return $data;
	}

	public function getChats($userID)
	{
		$this->db->where('sender_id', $userID);
		$this->db->or_where('receiver_id', $userID);
		// $this->db->join('users', 'users.id = chat_messages.receiver_id');
		$this->db->group_by('sender_id','receiver_id');
		$allchats = $this->db->get('chat_messages')->result();

		$data = array();
		foreach ($allchats as $vala) {
			$chats = array();

			if($vala->receiver_id == $this->session->userdata('userId')){
				continue;
			}

			if($vala->sender_id == $this->session->userdata('userId')){
				$userIdChats = $vala->receiver_id;
			} else {
				$userIdChats = $vala->sender_id;
			}

			$this->db->where('id', $userIdChats);
			$user = $this->db->get('users')->row();
			$chats['name'] = $user->name;
			$chats['image_profile'] = $user->image_profile;

			$chats['tampilkan'] = $tampil;
			
			$chats['id'] = $vala->id;
			$chats['receiver_id'] = $vala->receiver_id;
			// $chats['name'] = $vala->name;
			// $chats['image_profile'] = $vala->image_profile;
			// $chats['chat_messages_text'] = $vala->chat_messages_text;

			$this->db->where('sender_id', $vala->sender_id);
			$this->db->order_by('created_at', 'desc');
			$chat_messages_text = $this->db->get('chat_messages')->row();
			$chats['chat_messages_text'] = $chat_messages_text->chat_messages_text;

			$this->db->where('sender_id', $vala->id);
			$this->db->where('receiver_id', $this->session->userdata('userId'));
			$this->db->where('chat_messages_status', 'no');
			$count_unread_message = $this->db->get('chat_messages')->num_rows();

			$chats['count_unread_message'] = $count_unread_message;

			$data[] = (object)$chats;
		}

		return $data;
	}

	public function chat_history($user, $to_user)
	{

		// $this->db->where('sender_id', $user);
		// $this->db->group_by('DATE(created_at)'); 
		// $chat_bydate = $this->db->get('chat_messages')->result();

		$sql = "SELECT * FROM chat_messages WHERE (receiver_id = ? AND sender_id = ?) OR (receiver_id = ? AND sender_id = ?) GROUP BY DATE(created_at) ORDER BY created_at ASC";

		$chat_bydate = $this->db->query($sql, array($to_user, $user, $user, $to_user))->result();

		$data = array();
		foreach ($chat_bydate as $vala) {
			$date = DateTime::createFromFormat('Y-m-d H:i:s', $vala->created_at);

			$chat_datas = array();

			$chat_datas['date'] = $date->format('D, M d Y');

			$sql = "SELECT * FROM chat_messages WHERE DATE(created_at) = ? AND chat_messages_status = 'yes' AND ((receiver_id = ? AND sender_id = ?) OR (receiver_id = ? AND sender_id = ?)) ORDER BY created_at ASC";

			$datas = $this->db->query($sql, array($date->format('Y-m-d'), $to_user, $user, $user, $to_user))->result_array();

			$chats = array();
			foreach ($datas as $key => $valb) {
				$chats[] = $valb;
			}

			$chat_datas['chats'] = $chats;

			$data[] = $chat_datas;
		}

		return $data;
	}

	public function storechat($sender_id, $receiver_id, $chat_message)
	{
		$data = array(
	        'sender_id' => $sender_id,
	        'receiver_id' => $receiver_id,
	        'chat_messages_text' => $chat_message,
	        'created_at' => date('Y-m-d H:i:s')
		);

		$this->db->insert('chat_messages', $data);
		$insert_id = $this->db->insert_id();

		if($this->db->affected_rows() > 0){
		  	$return = [
				'status' => 200,
				'id' => $insert_id
			];
		} else {
			$return = [
				'status' => 403,
				'message' => 'An error occurred while saving data, please repeat again.'
			];
		}

		return $return;
	}

	public function storechatupload($sender_id, $receiver_id, $attachment){
		$data = array(
	        'sender_id' => $sender_id,
	        'receiver_id' => $receiver_id,
	        'attachment' => $attachment,
	        'created_at' => date('Y-m-d H:i:s')
		);

		$this->db->insert('chat_messages', $data);
		$insert_id = $this->db->insert_id();

		if($this->db->affected_rows() > 0){
		  	$return = [
				'status' => 200,
				'id' => $insert_id,
				'message' => '<img src="'.base_url().'uploads/chat/'.$attachment.'" class="img-fluid">'
			];
		} else {
			$return = [
				'status' => 403,
				'message' => 'An error occurred while saving data, please repeat again.'
			];
		}

		return $return;
	}

	public function notifmessages($receiver_id)
	{
		$this->db->where('receiver_id', $receiver_id);
		$this->db->where('chat_messages_status', 'no');
		$data = $this->db->get('chat_messages')->num_rows();

		$return = [
			'jumlah' => $data
		];

		return $return;
	}
}