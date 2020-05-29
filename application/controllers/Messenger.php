<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Messenger extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->has_userdata('memberLogin')) {
			redirect('login','refresh');
		}
		
		$this->load->helper('date');
		$this->load->helper('html');
		$this->load->helper('string');
		$this->load->model('M_Messenger', 'messenger');
	}

	public function index()
	{	
		$chats = $this->messenger->getChats($this->session->userdata('userId'));
		$friends = $this->messenger->getFriends($this->session->userdata('userId'));

		$navbar_back = true;
		$title = 'MYDIO Messenger';
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('messenger', compact('chats','friends'));
		$this->load->view('footer');
	}

	public function chat($receiver_id)
	{
		$this->db->set('chat_messages_status', 'yes');
		$this->db->where('receiver_id', $receiver_id);
		$this->db->update('chat_messages');

		$chat_history = $this->messenger->chat_history($this->session->userdata('userId'), $receiver_id);

		$this->db->where('id', $receiver_id);
		$user_receiver = $this->db->get('users')->row();

		if(!empty($user_receiver->image_profile)){
			$src_image = base_url().'uploads/profile/'.$user_receiver->image_profile;
		} else {
			$src_image = base_url().'assets/images/profile.png';
		}

		$navbar_back = true;
		$title_chat = '
		<span>
			<img src="'.$src_image.'" class="rounded-circle img-fluid mr-2" width="35" style="border: solid 2px #000;">
			'.$user_receiver->name.'
		</span>';

		$this->load->view('header', compact('navbar_back','title_chat'));
		$this->load->view('chat', compact('chat_history','receiver_id'));
		$this->load->view('footer');
	}

	public function storechat()
	{
		$sender_id = $this->session->userdata('userId');
		$receiver_id = $this->input->post('receiver_id');
		$chat_message = $this->input->post('chat_message');

		$storechat = $this->messenger->storechat($sender_id, $receiver_id, $chat_message);

		header('Content-Type: application/json');
    	echo json_encode($storechat);
	}

	public function uploadimage()
	{
		$config['upload_path']   = './uploads/chat/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['file_name']     = random_string('alnum', 12);
	    $config['overwrite']	 = true;
	    // $config['max_size']             = 1024; // 1MB
	    // $config['max_width']            = 1024;
	    // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('imgupload')) {

        	$sender_id = $this->session->userdata('userId');
			$receiver_id = $this->input->post('receiver_id');
			$attachment = $this->upload->data('file_name');

			$storechat = $this->messenger->storechatupload($sender_id, $receiver_id, $attachment);

            $return = $storechat;
        } else {
			$return = [
            	'status' => 403,
            	'message' => $this->upload->display_errors()
            ];
        }

        header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function notifmessages()
	{
		$receiver_id = $this->session->userdata('userId');

		$notifmessages = $this->messenger->notifmessages($receiver_id);

		header('Content-Type: application/json');
    	echo json_encode($notifmessages);
	}

	public function notifchats()
	{
		$sql = "SELECT sender_id, receiver_id, COUNT(IF(chat_messages_status = 'no', 1, NULL)) 'sum_not_read' FROM chat_messages WHERE receiver_id = ? GROUP BY sender_id";

		$query = $this->db->query($sql, array($this->session->userdata('userId')))->result();

		$data = array();
		foreach ($query as $val) {
			$a = array();

			$a['sender_id'] = $val->sender_id;
			$a['jumlah'] = $val->sum_not_read;

			$this->db->where('sender_id', $val->sender_id);
			$this->db->order_by('created_at', 'desc');
			$chat_messages_text = $this->db->get('chat_messages')->row();
			if($chat_messages_text->chat_messages_text <> null){
				$a['chat_messages_text'] = $chat_messages_text->chat_messages_text;
			} else {
				$a['chat_messages_text'] = '<i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;&nbsp;Image';
			}

			$this->db->where('id', $val->sender_id);
			$user_sender = $this->db->get('users')->row();
			if($user_sender->image_profile <> null){
				$src = base_url('uploads/profile/').$value->image_profile;
            } else {
                $src = base_url('assets/images/profile_active.png');
            }

			$a['src_image_profile'] = $src;
			$a['name'] = $user_sender->name;

			$data[] = $a;
		}

		header('Content-Type: application/json');
    	echo json_encode($data);
	}

	public function ceknewchat()
	{
		$sender_id = $this->session->userdata('userId');
		$receiver_id = $this->input->post('receiver_id');

		$this->db->where('sender_id', $receiver_id);
		$this->db->where('receiver_id', $sender_id);
		$this->db->where('chat_messages_status', 'no');
		$data = $this->db->get('chat_messages')->result();

		header('Content-Type: application/json');
    	echo json_encode($data);
	}

	public function updatereadnewchat()
	{
		$chat_messages_id = $this->input->post('chat_messages_id');

		$this->db->set('chat_messages_status', 'yes');
		$this->db->where('id', $chat_messages_id);
		$this->db->update('chat_messages');
	}
}