<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class AdminPost extends CI_Controller {

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

	{	$data['admin'] = $this->user;

		$this->load->view('admin/post', $data);

	}



	public function add()

	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('judul', 'Judul', 'required');

		//$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		if ($this->form_validation->run() == FALSE) {

			redirect('/admin-post','refresh');

		}else{

			date_default_timezone_set('Asia/Makassar');

			$judul      = $this->input->post('judul', TRUE);

			$link       = site_url().''.$this->sluggify($judul);

			$meta       = $this->input->post('meta', TRUE);

			$artikel    = $this->input->post('artikel');

			$bahasa		= $this->input->post('bahasa', TRUE);

			$tanggal	= $this->input->post('tanggal', TRUE);

			$gambar     = '';

			$created_at = ($tanggal == '') ? date("Y-m-d H:i:s"): date("Y-m-d H:i:s", strtotime($tanggal));

			//start uload gambar

			$config['file_name']	 = 'file_'.time();

			$config['upload_path']   = './plugins/kcfinder/upload/images';

			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$config['overwrite']     = TRUE;

			$this->load->library('upload', $config);

			

				if(!$this->upload->do_upload("files")){

					// $error = array('error' => $this->upload->display_errors());

					// die();

				}

				else{

					$thumb = $this->upload->data();

					$gambar = $thumb['file_name'];

				}

			$id = $this->general->lastId('z_artikel')->row_array();

			$id = $id['AUTO_INCREMENT'];

			$data = array(

				'thumbnail'  => $gambar,

				'judul'      => $judul,

				'artikel'    => $artikel,

				'meta'       => $meta,

				'author'	 => $this->user['username'],

				'bahasa'	 => $bahasa, 

				'created_at' => $created_at,

				'jumlah_tayangan' => 0,

				'link'            => 'news/'.$id.'/'.$this->sluggify($judul),

			);

			$id = $this->general->insertId($table='z_artikel', $data);

			if ($id>0) {

				$this->session->set_flashdata('berhasil', 'Data Berhasil di Publish');

				redirect('/data-post','refresh');

			}

		}

	}



	function sluggify($url)

	{

	    # Prep string with some basic normalization

	    $url = substr($url, 0, strrpos(substr($url, 0, 30), ' '));

	    $url = strtolower($url);

	    $url = strip_tags($url);

	    $url = stripslashes($url);

	    $url = html_entity_decode($url);



	    # Remove quotes (can't, etc.)

	    $url = str_replace('\'', '', $url);



	    # Replace non-alpha numeric with hyphens

	    $match = '/[^a-z0-9]+/';

	    $replace = '-';

	    $url = preg_replace($match, $replace, $url);



	    $url = trim($url, '-');



	    return $url;

	}



	public function data()

	{

		$data['admin'] = $this->user;

		$this->load->view('admin/data-post', $data);

	}



	public function getPost()

	{

		$this->load->model('M_DataPost', 'datatables');

		$list = $this->datatables->get_datatables();

        $data = array();

        $no = $this->input->post('start', TRUE);

       	foreach ($list as $key => $lt) {

       		$no++;

       		$row 	= array();

       		$row[] = $no;

       		$row[] 	= '<a href="'.site_url($lt['link']).'" target="blank_"><p>'.$lt['judul'].'</p></a>

                                 <p><i class="fa fa-eye"></i> '.$lt['jumlah_tayangan'].' Views</p>';

            $row[] 	= ($lt['bahasa'] == 'id') ? 'Bahasa Indonesia' : 'Bahasa Inggris';

            $row[] 	= "<a href='".$lt['link']."' target='blank_'><button class='btn btn-info'><i class='fa fa-eye'></i></button></a> <a href='".site_url('edit-post/'.$lt['id'])."'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button></a> <a href='#' onclick=hapus(".$lt['id'].")><button class='btn btn-danger'><i class='fa fa-trash'></i></button></a>";

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



	public function edit()

	{

		$id = $this->uri->segment(2);

		$con = array(

			'id' => $id

		);

		$data['admin'] = $this->user;

		$data['artikel'] = $this->general->edit($table='z_artikel', $con)->row_array();

		// var_dump($data);

		// die();

		$this->load->view('admin/edit-post', $data);

	}



	public function update(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('judul', 'Judul', 'required');

		if ($this->form_validation->run() == FALSE) {

			$this->load->library('user_agent');

			redirect(''.$this->agent->referrer(),'refresh');

		}else{

			$id 		= $this->input->post('id', TRUE);

			$judul      = $this->input->post('judul', TRUE);

			$meta       = $this->input->post('meta', TRUE);

			$artikel    = $this->input->post('artikel');

			$bahasa    = $this->input->post('bahasa');

			$gambar 	= null;

			//start uload gambar

			$config['file_name']	 = 'file_'.time();

			$config['upload_path']   = './plugins/kcfinder/upload/images';

			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$config['overwrite']     = TRUE;

			$this->load->library('upload', $config);

				if(!$this->upload->do_upload("files")){

					// $error = array('error' => $this->upload->display_errors());

					// var_dump($error);

					// die();

				}

				else{

					$thumb = $this->upload->data();

					$gambar = $thumb['file_name'];

				}

			$data = array();

			//data untuk insert

			if ($gambar==null) {

				$data = array(

					'judul'      => $judul,

					'artikel'    => $artikel,

					'meta'       => $meta,

					'bahasa'     => $bahasa,

				);

			}else{

				$data = array(

					'thumbnail'  => $gambar,

					'judul'      => $judul,

					'artikel'    => $artikel,

					'meta'       => $meta,

					'bahasa' 	 => $bahasa,

				);

			}

			$con2 = array(

				'id' => $id

			);



			$result = $this->general->update($table='z_artikel', $con2, $data);

			if ($result) {

				$this->session->set_flashdata('berhasil', 'Edit Data Berhasil');

				redirect('/data-post','refresh');

			}else{

				$this->session->set_flashdata('berhasil', 'Insert Data Gagal, Gagal Koneksi Ke Database');

				$this->load->library('user_agent');

				redirect(''.$this->agent->referrer(),'refresh');

			}

		}



	}



	public function delete()

	{

		$id = $this->input->post('id', TRUE);

		$con = array(

			'id' => $id

		);

		$res = $this->general->delete($table='z_artikel', $con);

		$newtoken = $this->security->get_csrf_hash();

		echo json_encode(array('res'=>$res, 'token'=>$newtoken));

	}



}



/* End of file AdminPost.php */

/* Location: ./application/controllers/AdminPost.php */ 