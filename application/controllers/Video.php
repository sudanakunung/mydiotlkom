<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {
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
		$data['admin'] = $this->user;
		$this->load->view('admin/add-video', $data);
	}

	public function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('link', 'Link', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('video','Pastikan sudah mengisi link video');
			redirect('/add-video','refresh');
		} else {
			$config['file_name'] = 'file_'.time();
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);
			$thumb = null;
			if ( ! $this->upload->do_upload('image')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$thumb = $this->upload->data();
				$thumb = $thumb['file_name'];
			}
			if ($thumb == null) {
				$this->session->set_flashdata('video','Pastikan sudah mengisi thumbnail video');
				redirect('/add-video','refresh');
			} else{
				$data = array(
					'link' => $this->input->post('link', TRUE),
					'thumb' => $thumb
				);
				$res = $this->general->add($table='z_video', $data);
				$this->session->set_flashdata('video','Insert Data Berhasil');
				redirect('/data-video', 'refresh');
			}
		}
	}

	public function viewVideo()
	{
		$data['admin'] = $this->user;
		$this->load->view('admin/data-video', $data);
	}

	public function getVideo()
	{
		$this->load->model('M_DataVideo', 'datatables');
		$list = $this->datatables->get_datatables();
        $data = array();
        $no = $this->input->post('start', TRUE);
       	foreach ($list as $key => $lt) {
       		$no++;
       		$row 	= array();
       		$row[] = $no;
       		$row[] = '<img src="'.base_url('uploads/'.$lt['thumb']).'" style="max-height:300px;"/>';
       		$row[] 	= '<iframe width="100%" height="300px" src="'.$lt['link'].'" frameborder="0" allowfullscreen></iframe>';
            // $row[] 	= "<a href='".$lt['link']."'>".$lt['link']."</a>";
            $row[] 	= "<a href='#' onclick=hapus(".$lt['id'].")><button class='btn btn-danger'><i class='fa fa-trash'></i></button></a>";
            $data[] = $row;
       	}
        $output = array(
	        "draw" => $_POST['draw'],
	        "recordsTotal" => $this->datatables->count_all(),
	        "recordsFiltered" => $this->datatables->count_filtered(),
	        "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	public function delete()
	{
		$id = $this->input->post('id', TRUE);
		$con = array(
			'id' => $id
		);
		$thum = $this->general->edit('z_video', $con)->row_array();
		unlink('./uploads/'.$thum['thumb']);
		$res = $this->general->delete($table='z_video', $con);

		if ($res) {
			$newtoken = $this->security->get_csrf_hash();
			echo json_encode(array('res'=>$res, 'token'=>$newtoken));
		}
	}

	public function edit()
	{
		$id = $this->uri->segment(2);
		$con = array(
			'id' => $id
		);

		$data['admin'] = $this->user;
		$data['video'] = $this->general->edit($table='z_video', $con)->row_array();
		$this->load->view('admin/edit-video', $data);
	}

	public function update($value='')
	{
		$id   = $this->input->post('id', TRUE);
		$con  = array('id' => $id );
		$data = array('link' => $this->input->post('link', TRUE));
		$res  = $this->general->update($table='z_video', $con, $data);
		if ($res) {
			$this->session->set_flashdata('video','Edit Data Berhasil');
			redirect('/data-video', 'refresh');
		}
	}

}

/* End of file Video.php */
/* Location: ./application/controllers/Video.php */ 