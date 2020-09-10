<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProfileMember extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		/* if (!$this->session->has_userdata('memberLogin')) {
			redirect('login?next_url=profile','refresh');
		} */

		$this->load->helper('html');
		$this->load->helper('string');
		$this->load->model('M_Users', 'user');

		$this->load->library('curl');
		$this->client = new \GuzzleHttp\Client(['verify' => false, 'http_errors' => false]);
		$this->url_api = 'https://dev.mydiosing.com/mydio'; // untuk dev, besok dicomment
	}

	public function index()
	{
		// if (!$this->session->has_userdata('memberLogin')) {
		// 	redirect('login?next_url=profile');
		// }

		$reqTime = date('YmdHis');

		$res_myprofile = $this->client->request('GET', ''.$this->url_api.'/QueryUser', [
			'query' => [
				'type' => 'me',
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);

		$res_followers = $this->client->request('GET', ''.$this->url_api.'/Follower', [
			'query' => [
				'type' => 'follower',
				'otherId' => $this->session->userdata('userId'),
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);

		$res_following = $this->client->request('GET', ''.$this->url_api.'/Follower', [
			'query' => [
				'type' => 'following',
				'otherId' => $this->session->userdata('userId'),
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);

		$res_recording = $this->client->request('GET', ''.$this->url_api.'/QueryRecording', [
			'query' => [
				'type' => 'userId',
				'id' => $this->session->userdata('userId'),
				'offset' => 0,
				'limit' => 50
			]
		]);

		$res_clips = $this->client->request('GET', ''.$this->url_api.'/QueryUser', [
			'query' => [
				'type' => 'clips',
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);
		
		$user = json_decode($res_myprofile->getBody()->getContents(), TRUE);
		$followers = json_decode($res_followers->getBody()->getContents(), TRUE);
		$following = json_decode($res_following->getBody()->getContents(), TRUE);
		$recording = json_decode($res_recording->getBody()->getContents(), TRUE);
		$clips = json_decode($res_clips->getBody()->getContents(), TRUE);

		// $user = $this->user->getUser($this->session->userdata('userId'));
		// $count_followers = $this->user->countFollowers($this->session->userdata('userId'));
		// $count_following = $this->user->countFollowing($this->session->userdata('userId'));
		// $get_followers = $this->user->getFollowers($this->session->userdata('userId'));
		// $get_following = $this->user->getFollowing($this->session->userdata('userId'));
		
		// $this->output->cache(60);
		
		$navbar_back = true;
		$title = 'Back';
		$this->load->view('header', compact('navbar_back','title'));
		// $this->load->view('profile_member', compact('user','count_followers','count_following','get_followers','get_following'));
		$this->load->view('profile_member', compact('user','followers','following','recording','clips'));
		$this->load->view('footer');
	}

	public function check_isfollowing()
	{
		$reqTime = date('YmdHis');

		$res_isfollowing = $this->client->request('GET', ''.$this->url_api.'/Follower', [
			'query' => [
				'type' => 'isfollowing',
				'otherId' => $this->input->post('otherId'),
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);

		$isfollowing = json_decode($res_isfollowing->getBody()->getContents(), TRUE);

		$html = '';
		if($isfollowing['isFollowing'] == 0){
			$html .= '
			<button onClick="follow('.$this->input->post('otherId').'); return false;" id="follow-'.$this->input->post('otherId').'" class="custom btn btn-primary form-control follow-friend" status-follow="0" friend-id="'.$this->input->post('otherId').'">
                Follow
            </button>
			';
		} else {
			$html .= '
			<button onClick="unfollow('.$this->input->post('otherId').'); return false;" id="follow-'.$this->input->post('otherId').'" class="custom btn btn-outline-primary form-control follow-friend" status-follow="1" friend-id="'.$this->input->post('otherId').'">
                Unfollow
            </button>
			';
		}

		$return = [
			'isfollowing' => $isfollowing['isFollowing'],
			'html' => $html
		];

		header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function edit_profile()
	{
		// $user = $this->user->getUser($this->session->userdata('userId'));

		$reqTime = date('YmdHis');

		$res_myprofile = $this->client->request('GET', ''.$this->url_api.'/QueryUser', [
			'query' => [
				'type' => 'me',
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);

		$user = json_decode($res_myprofile->getBody()->getContents(), TRUE);

		$navbar_back = true;
		$title = 'Edit Profile';
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('edit_profile', compact('user'));
		$this->load->view('footer');
	}

	public function update()
	{
		// $user = $this->user->updateProfile($this->session->userdata('userId'));

		$reqTime = date('YmdHis');

		$res_updateprofile = $this->client->request('GET', ''.$this->url_api.'/UpdateUser', [
			'query' => [
				'type' => 'name',
				'name' => $this->input->post('name', true),
				'mood' => $this->input->post('mood', true),
				'gender' => $this->input->post('gender', true),
				'birthdate' => $this->input->post('birthdate', true),
				'relationship' => $this->input->post('relationship', true),
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);

		$update = json_decode($res_updateprofile->getBody()->getContents(), TRUE);

		if($update['result'] == 0){
			$return = [
				'status' => 403,
				'message' => 'Something went wrong please try again.'
			];
		} else {
			$return = [
				'status' => 200,
				'message' => ''
			];
		}

		header('Content-Type: application/json');
		echo json_encode($return);
	}

	public function update_pp()
	{
		$reqTime = date('YmdHis');

		$data = [
			'sessionId' => $this->session->userdata('sessionId'),
			'reqTime' => $reqTime,
			'sig' => genSignature($reqTime, $this->session->userdata('salt'))
		];

		$res_updatepp = $this->client->request('POST', ''.$this->url_api.'/UpdateUser?type=photo&sessionId='.$data['sessionId'].'&reqTime='.$data['reqTime'].'&sig='.$data['sig'].'', [
			'multipart' => [
				[
					'name' => ''.$_FILES["filename"]["tmp_name"].'', 
					'contents' => fopen(''.$_FILES["filename"]["tmp_name"].'', 'r'),
					'filename' => ''.$_FILES["filename"]["name"].''
				]
			]
		]);

		$update = json_decode($res_updatepp->getBody()->getContents(), TRUE);

		if($res_updatepp->getStatusCode() <> 200){
			$return = [
				'status' => 403,
				'message' => 'Something went wrong please try again. '.$update['error'].''
			];
		} else {
			$return = [
				'status' => 200,
				'src' => $update['urlPP']
			];
		}

		header('Content-Type: application/json');
		echo json_encode($return);
	}

	public function change_password()
	{
		$userId = $this->session->userdata('userId');
		$userEmail = $this->session->userdata('userEmail');
		$current_password = $this->input->post('current_password');
		$new_password = $this->input->post('new_password');

		// $user = $this->db->get_where('users', ['email' => $userEmail])->row_array();

		// if(password_verify($current_password, $user['password'])){
			
		// 	$data_update = [
		// 		'password' => password_hash($new_password, PASSWORD_DEFAULT)
		// 	];

		// 	$this->db->where('id', $userId);
		// 	$this->db->update('users', $data_update);

		// 	$return = [
		// 		'status' => 200,
		// 		'message' => 'Password successfully changed'
		// 	];

		// } else {
		// 	$return = [
		// 		'status' => 403,
		// 		'message' => 'The password you entered is incorrect'
		// 	];
		// }

		$reqTime = date('YmdHis');

		$res_change_password = $this->client->request('GET', ''.$this->url_api.'/Password', [
			'query' => [
				'password' => $current_password,
				'newPassword' => $new_password,
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);

		$user = json_decode($res_change_password->getBody()->getContents(), TRUE);

		if($user['success'] == 1){
			$return = [
				'status' => 200,
				'message' => 'Password successfully changed'
			];
		} else {
			$return = [
				'status' => 403,
				'message' => $user['error']
			];
		}

		header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function store_clip()
	{
		$reqTime = date('YmdHis');

		$data = [
			'sessionId' => $this->session->userdata('sessionId'),
			'reqTime' => $reqTime,
			'sig' => genSignature($reqTime, $this->session->userdata('salt'))
		];

		$res_updatepp = $this->client->request('POST', ''.$this->url_api.'/Upload?type=clip&sessionId='.$data['sessionId'].'&reqTime='.$data['reqTime'].'&sig='.$data['sig'].'', [
			'multipart' => [
				[
					'name' => 'filename', 
					'contents' => fopen(''.$_FILES["filename"]["tmp_name"].'', 'r')
				]
			]
		]);

		$store = json_decode($res_updatepp->getBody()->getContents(), TRUE);

		if($res_updatepp->getStatusCode() <> 200){
			$return = [
				'status' => 403,
				'message' => 'Something went wrong please try again. '.$store['error'].''
			];
		} else {
			// $html = '
			// <div class="col-4 pb-2 col-clip">
			//     <img src="'.$store['urlClip'].'" class="clip img-thumbnail rounded">
			//     <img src="'.base_url('assets/images/trash.png').'" class="icon-trash" onclick="deleteClip('.$val['clipId'].');">
			// </div>
			// ';

			$html = '
			<div class="col-4 pb-2 col-clip">
				<img src="'.$store['urlClip'].'" class="clip img-thumbnail rounded">
			</div>
			';
			
			$return = [
				'status' => 200,
				'html' => $html
			];
		}

		header('Content-Type: application/json');
		echo json_encode($return);
	}

	public function delete_clip()
	{
		$reqTime = date('YmdHis');
		
		$arr_clip = array(
			'clipId' => $this->input->post('clipId'),
			'urlClip' => $this->input->post('urlClip'), 
		);

		$res_del_clip = $this->client->request('GET', ''.$this->url_api.'/QueryRecording?', [
			'query' => [
				'type' => 'clipsdelete',
				'clips' => $arr_clip,
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			]
		]);

		$delete = json_decode($res_del_clip->getBody()->getContents(), TRUE);

		var_dump ($delete);
		die();
	}
}