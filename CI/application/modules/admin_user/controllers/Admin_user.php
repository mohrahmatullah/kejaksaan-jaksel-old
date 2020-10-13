<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_user extends CI_Controller
{

	/**
	 * @author Rusmanto
	 **/

	public function __construct()
	{
			parent::__construct();
			date_default_timezone_set("Asia/Jakarta");
			$this->load->library('ajax_pagination');
			$this->load->model('admin_user_model');
	}

	public function index($page=1)
	{
		if ($this->session->userdata('user_logged_in') != TRUE){
			redirect(base_url());
		}
		
		$data = array(
				'title'    				=> 'Dashboard Prime Mobile Inventory',
				'description' 		=> 'Dashboard Prime Mobile Inventory',
				'keywords' 				=> 'primemobile, bimbel online, prime generation',
				'nav_active'			=> 'setting',
				'content'  				=> 'admin_user/main'
		);

		$limit		= 10;
		if($page == 1){
			$offset = 0;
			$no = 1;
		} else {
			$offset = ($page-1) * $limit;
			$no = (($page*$limit) - $limit) + 1;
		}	
		
		$cari = 0;
		$data_rec 									= $this->admin_user_model->get_users($cari,$offset,$limit)->result_array();
		$data_rec_count 						= $this->admin_user_model->get_users($cari,0,0)->result_array();
		$config['base_url'] 				= base_url().'admin_user/lists_user/'.$cari.'/';			
	
		$config['total_rows'] 			= count($data_rec_count);
		$config['per_page'] 				= $limit;
		$config['uri_segment']			= 4;
		$config['num_links'] 				= 1;
		$config['use_page_numbers'] = TRUE;
		$config['show_count']				= FALSE;
		$config['first_link'] 			= 'First';
		$config['last_link'] 				= 'Last';
		$config['next_link'] 				= '&gt;';
		$config['prev_link'] 				= '&lt;';
		$config['full_tag_open'] 		= "<ul class='pagination'>";
		$config['full_tag_close'] 	="</ul>";
		$config['num_tag_open'] 		= '<li>';
		$config['num_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] 		= "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] 		= "<li>";
		$config['next_tagl_close'] 	= "</li>";
		$config['prev_tag_open'] 		= "<li>";
		$config['prev_tagl_close'] 	= "</li>";
		$config['first_tag_open'] 	= "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] 		= "<li>";
		$config['last_tagl_close'] 	= "</li>";
		
		$this->ajax_pagination->initialize($config);
			
		$data['rec'] 					= $data_rec;
		$data['paginator'] 		= $this->ajax_pagination->create_links();

		$data['count'] 				= count($data_rec_count);
		$data['no'] 					= $no;
		$data['start'] 				= $page;
    $data['hal'] 					= $page;
    $data['cari'] 				= $cari;

		$this->load->view('template_admin',$data);
	}
    
	public function lists_user($cari=0, $page=1)
	{
		$limit		= 10;
		if($page == 1){
			$offset = 0;
			$no = 1;
		} else {
			$offset = ($page-1) * $limit;
			$no = (($page*$limit) - $limit) + 1;
		}	
		
		if($this->input->post('cari')){
			$sqlcari 		= $this->input->post('cari');
			$cari 			= url_title($sqlcari, '-', true);
		} else {
			if ($cari != 0){
				$sqlcari 		= str_replace('-',' ',$cari);
				$cari 			= $cari;
			} else {
				$sqlcari 		= $cari;
				$cari 			= $cari;
			}
		}

		$data_rec 									= $this->admin_user_model->get_users($sqlcari,$offset,$limit)->result_array();
		$data_rec_count 						= $this->admin_user_model->get_users($sqlcari,0,0)->result_array();
		$config['base_url'] 				= base_url().'admin_user/lists_user/'.$cari.'/';			
	
		$config['total_rows'] 			= count($data_rec_count);
		$config['per_page'] 				= $limit;
		$config['uri_segment']			= 4;
		$config['num_links'] 				= 1;
		$config['use_page_numbers'] = TRUE;
		$config['show_count']				= FALSE;
		$config['first_link'] 			= 'First';
		$config['last_link'] 				= 'Last';
		$config['next_link'] 				= '&gt;';
		$config['prev_link'] 				= '&lt;';
		$config['full_tag_open'] 		= "<ul class='pagination'>";
		$config['full_tag_close'] 	="</ul>";
		$config['num_tag_open'] 		= '<li>';
		$config['num_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] 		= "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] 		= "<li>";
		$config['next_tagl_close'] 	= "</li>";
		$config['prev_tag_open'] 		= "<li>";
		$config['prev_tagl_close'] 	= "</li>";
		$config['first_tag_open'] 	= "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] 		= "<li>";
		$config['last_tagl_close'] 	= "</li>";
		
		$this->ajax_pagination->initialize($config);
			
		$data['rec'] 					= $data_rec;
		$data['paginator'] 		= $this->ajax_pagination->create_links();

		$data['count'] 				= count($data_rec_count);
		$data['no'] 					= $no;
		$data['start'] 				= $page;
    $data['hal'] 					= $page;
    $data['cari'] 				= $cari;
						
		$this->load->view('main_tabel_ajax',$data);
	}

	public function cekusername($id)
	{
		$cek				= $this->admin_user_model->get_username($id);
		if ($cek > 0){
			echo '<label class="alert alert-error"><i>Username sudah pernah terdaftar sebelumnya</i></label>';
		} else {
			echo '';
		}
	}

	public function add_user()
	{
		$this->load->view('add');
	}

	public function edit_user($id,$page,$cari)
	{
		$data['usdata']				= $this->admin_user_model->get_users_detail($id);
		$data['page']					= $page;
		$data['cari']					= $cari;

		$this->load->view('edit',$data);
	}

	public function simpan_user()
	{
		$id = $this->input->post('iduser');
		if ($this->input->post('cari')){
			$cari = $this->input->post('cari');
		} else {
			$cari = 0;
		}

		if ($id == ''){
			$data 	= array(
				 'nama' 				=> $this->input->post('nama'),
				 'username' 		=> $this->input->post('username'),
				 'password' 		=> md5($this->input->post('password')),
				 'level' 				=> $this->input->post('level')
			);
			$this->db->insert('users', $data);
			$this->session->set_flashdata('pesan','Data berhasil di simpan');
			$page = 1;
		} else {
			if ($this->input->post('password') != ''){
				$data = array(
					 'nama' 				=> $this->input->post('nama'),
					 'username' 		=> $this->input->post('username'),
					 'password' 		=> md5($this->input->post('password')),
					 'level' 				=> $this->input->post('level')
				);
			} else {
				$data = array(
					 'nama' 				=> $this->input->post('nama'),
					 'username' 		=> $this->input->post('username'),
					 'level' 				=> $this->input->post('level')
				);
			}
			$this->db->where('id', $id);
			$this->db->update('users', $data);
			$this->session->set_flashdata('pesan','Data berhasil di simpan');
			$page = $this->input->post('page');
		}
		
		$this->lists_user($cari,$page);
	}

	public function delete($id,$page,$cari)
	{
		$this->db->where('id', $id);
		$this->db->delete('users');
		
		$this->session->set_flashdata('pesan','Data berhasil di hapus');
		
		$this->lists_user($cari,$page);
	}

}