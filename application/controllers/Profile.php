<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	var $user = null;
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('user')) {
			redirect('admin-login','refresh');
		}
		$this->load->helper('html');
		$this->user = $this->session->userdata('user');
		$this->url  = $this->uri->segment(1);
		$this->load->model('M_general', 'general');
	}

	public function index()
	{
		$con = array(
			'id' => $this->user['id'],
		);
		$data['admin'] = $this->general->edit($table='z_user', $con)->row_array();
		$this->load->view('admin/profile', $data);
	}

	public function update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('profile', 'Pastikan email dan username sudah terisi');
			redirect('/admin-profile', 'refresh');
		} else {
			$data = array();
			$id = $this->input->post('id', TRUE);
			$username = $this->input->post('username', TRUE);
			$email = $this->input->post('email', TRUE);
			$password = $this->input->post('password', TRUE);
			$icon = null;

			$config['upload_path']   = './assets/images';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite']     = TRUE;
			$this->load->library('upload', $config);
			
			if(!$this->upload->do_upload("files")){
				// $this->session->set_flashdata('slider', 'Pastikan telah memilih gambar terlebih dahulu');
				// redirect('/add-slider','refresh');
			}
			else{
				$thumb = $this->upload->data();
				$icon = $thumb['file_name'];
			}

			if (empty($password) && $icon == null)  {
				$data = array(
					'username' => $username,
					'email' => $email
				);
			}elseif (empty($password) && $icon != null) {
				$data = array(
					'username' => $username,
					'email' => $email,
					'icon' => $icon
				);
			}elseif ($icon == null && !empty($password)) {
				$this->load->library('Password');
				$data = array(
					'username' => $username,
					'email' => $email,
					'password' => $this->password->hash($password),
				);
			}else{
				$this->load->library('Password');
				$data = array(
					'username' => $username,
					'email' => $email,
					'password' => $this->password->hash($password),
					'icon' => $icon
				);
			}

			$con = array(
				'id' => $id
			);

			$res = $this->general->update($table='z_user', $con, $data);
			if($res){
				$this->session->set_flashdata('profile', 'Update Data Berhasil, silahkan logout dan login kembali');
				redirect('/admin-profile', 'refresh');
			}else{
				$this->session->set_flashdata('profile', 'Koneksi ke database gagal, periksa koneks internet');
				redirect('/admin-profile', 'refresh');
			}
		}
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */ 