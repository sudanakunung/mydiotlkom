<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	/**
	 * @author [Ari Sudarma] <[arisudarma@gmail.com]>
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
		$this->load->model('M_general', 'general');
	}

	public function index()
	{
		if ($this->session->has_userdata('user')) {
			redirect('/admin','refresh');
		}
		$this->load->view('admin/login');
	}

	public function forgotView()
	{
		$this->load->view('admin/forgot');
	}

	/**
	 * [function ini untuk verifikasi login user :: mydiosing]
	 * @param  string $value [email::email. passord::hash]
	 * @return [session]        [flashdata jika terjadi error atau email dan password tidak match]
	 */
	public function verify()
	{
		$this->load->library('Password');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('login', 'email dan password diperlukan');
            redirect('/admin-login','refresh');
        }else{
        	//mulai cek data user....
        	$email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);
            $ip = $this->input->ip_address();

            $condition = array(
            	'email' => $email
            );

            $result = $this->general->verify($table='z_user', $condition);
            if ($result->num_rows() === 1) {
            	$user = $result->row_array();
            	if ($this->password->check($password, $user['password'])) {
            		unset($user['password']);
            		
            		$condition = array(
            			'id' => $user['id']
            		);

            		$data = array(
            			'ip_address' => $ip
            		);

                    $this->general->update($table='z_user', $condition,$data);
                    $this->session->set_userdata('user', $user);
                    redirect('/admin');
            	}else{
            		$this->session->set_flashdata('login', 'password salah');
                    redirect('/admin-login','refresh');
            	}
            }else{
            	$this->session->set_flashdata('login', 'email dan password tidak ditemukan');
                redirect('/admin-login','refresh');
            }
        }
	}

	public function forgot()
	{
		$this->load->library('Password');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'email', 'required');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('login', 'email diperlukan...');
			redirect('/forgot-password','refresh');	
		}else{
			$email 	= $this->input->post('email', TRUE);
			$ip 		= $this->input->post('ip_address', TRUE);
			$condition 	= array(
				'email' => $email
			);

			$result = $this->general->verify($table='z_user', $condition);
			if ($result->num_rows() === 1) {
				$this->load->helper('string');
				$pass 		= random_string('alnum', 8);
				$condition 	= array(
            		'email' => $email
            	);
            	$data = array(
            		'password' 		=> $this->password->hash($pass),
            		'ip_address' 	=> $ip
            	);
            	if($this->general->update($table='z_user',$condition,$data)){
            		date_default_timezone_set("Asia/Makassar");
            		$this->load->library('email');
            		
            		$this->email->from('service@bali-footballl.com', 'Bali Football');
            		$this->email->to(''.$email);
            		
            		$this->email->subject('Password Baru');
            		$this->email->message('Password Baru Anda : '.$pass);
            		
            		$this->email->send();

            		$this->session->set_flashdata('forgot', 'cek email Anda, kami sudah kirim password baru');
					redirect('/forgot-password','refresh');
            	}else{
            		$this->session->set_flashdata('forgot', 'terjadi kesalahan pada database');
					redirect('/forgot-password','refresh');
            	}
			}else{
				$this->session->set_flashdata('forgot', 'email tidak terdaftar');
				redirect('/forgot-password','refresh');
			}
		}
	}

	public function logoutAdmin()
	{
		$this->session->sess_destroy();
		redirect('/admin-login','refresh');
	}

	public function add()
	{
		$this->load->library('Password');
		$pass = 'admin';
		$data = array(
			'email' 	=> 'admin@mydiosing.com',
			'password'	=> $this->password->hash($pass),
			'ip_address'=> $this->input->ip_address(), 	
		);

		echo $this->general->add($table='z_user', $data);
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */ 