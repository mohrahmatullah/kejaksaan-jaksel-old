<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_main extends CI_Controller
{

	/**
	 * @author Rusmanto
	 **/

	public function __construct()
	{
			parent::__construct();
			$this->load->library('ajax_pagination');
			$this->load->model('admin_main_model');
	}

	public function logout(){
			session_destroy();
			redirect(base_url(), 'refresh');
	}
	
	public function index()
	{
		if ($this->session->userdata('user_login_id')){
			redirect(base_url('dashboard'));
		}
		
		$data = array(
				'title'    				=> 'Dashboard Aplikasi Kejaksaan Negeri Jakarta Selatan',
				'description' 			=> 'Dashboard Aplikasi Kejaksaan Negeri Jakarta Selatan',
				'keywords' 				=> 'kejaksaan negeri, jakarta selatan, jaksa agung, pengadilan negeri',
				'nav_active'			=> 'login'
		);

		if ($this->input->post('username')){
				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));
				
				$cek 			= $this->admin_main_model->cek_login($username,$password);
				$total 		= $cek->num_rows();

				if ($total > 0){
						$hasil 	= $cek->row();
						$sesi 	= array(
							'user_login_id'  		=> $hasil->id,
							'user_pegawai_id'  		=> $hasil->pegawai_id,
							'user_login_name'     	=> $hasil->username,
							'user_login_level'    	=> $hasil->level,
							'user_login_nama'    	=> $hasil->nama,
							'user_logged_in' 		=> 1
						);
						$this->session->set_userdata($sesi);

						redirect(base_url('dashboard'), 'refresh');
				} else {
						$this->session->set_flashdata('error', 'Username atau password tidak valid');
						redirect(base_url(), 'refresh');
				}
		}
		$this->load->view('login', $data);
	}

  public function dashboard()
	{
		if ($this->session->userdata('user_logged_in') != 1){
			redirect(base_url());
		}
		
		$data = array(
				'title'    				=> 'Dashboard Aplikasi Kejaksaan Negeri Jakarta Selatan',
				'description' 			=> 'Dashboard Aplikasi Kejaksaan Negeri Jakarta Selatan',
				'keywords' 				=> 'kejaksaan negeri, jakarta selatan, jaksa agung, pengadilan negeri',
				'nav_active'			=> 'home',
				'content'  				=> 'admin_main/dashboard'
		);

		$this->load->view('template_admin',$data);
	}
    
	public function change_password()
	{
		$data = array(
				'title'    				=> 'Dashboard Aplikasi Kejaksaan Negeri Jakarta Selatan',
				'description' 			=> 'Dashboard Aplikasi Kejaksaan Negeri Jakarta Selatan',
				'keywords' 				=> 'kejaksaan negeri, jakarta selatan, jaksa agung, pengadilan negeri',
				'nav_active'			=> 'home',
				'content'  				=> 'admin_main/password'
		);

		$this->load->view('template_admin',$data);
	}

	public function simpan_password()
	{
		$id = $this->session->userdata('user_login_id');
		
		if ($this->input->post('password') == $this->input->post('password1')){
			$data = array(
				 'password' 				=> md5($this->input->post('password')),
			);
			
			$this->db->where('id', $id);
			$this->db->update('users', $data);
			$this->session->set_flashdata('pesan','<label class="alert alert-success col-lg-12">Password berhasil dirubah</label>');
		} else {
			$this->session->set_flashdata('pesan','<label class="alert alert-danger col-lg-12">Konfirmasi Password tidak sama</label>');
		}
		
		redirect('change-password');
	}

}