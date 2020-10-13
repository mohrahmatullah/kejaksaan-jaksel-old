<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_uraian extends CI_Controller
{

	/**
	 * @author Rusmanto
	 **/

	public function __construct()
	{
			parent::__construct();
			date_default_timezone_set("Asia/Jakarta");
			$this->load->library('ajax_pagination');
			$this->load->model('admin_uraian_model');
	}

	public function index($page=1)
	{
		if ($this->session->userdata('user_logged_in') != TRUE){
			redirect(base_url());
		}
		
		$data = array(
				'title'    				=> 'Dashboard Aplikasi Kejaksaan Negeri Jakarta Selatan',
				'description' 			=> 'Dashboard Aplikasi Kejaksaan Negeri Jakarta Selatan',
				'keywords' 				=> 'kejaksaan negeri, jakarta selatan, jaksa agung, pengadilan negeri',
				'nav_active'			=> 'master',
				'content'  				=> 'admin_uraian/main'
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
		$data_rec 					= $this->admin_uraian_model->get_uraian($cari,$offset,$limit)->result_array();
		$data_rec_count 			= $this->admin_uraian_model->get_uraian($cari,0,0)->result_array();
		$config['base_url'] 		= base_url().'admin_uraian/lists_uraian/'.$cari.'/';			
	
		$config['total_rows'] 		= count($data_rec_count);
		$config['per_page'] 		= $limit;
		$config['uri_segment']		= 4;
		$config['num_links'] 		= 1;
		$config['use_page_numbers'] = TRUE;
		$config['show_count']		= FALSE;
		$config['first_link'] 		= 'First';
		$config['last_link'] 		= 'Last';
		$config['next_link'] 		= '&gt;';
		$config['prev_link'] 		= '&lt;';
		$config['full_tag_open'] 	= "<ul class='pagination'>";
		$config['full_tag_close'] 	="</ul>";
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] 	= "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] 	= "<li>";
		$config['next_tagl_close'] 	= "</li>";
		$config['prev_tag_open'] 	= "<li>";
		$config['prev_tagl_close'] 	= "</li>";
		$config['first_tag_open'] 	= "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] 	= "<li>";
		$config['last_tagl_close'] 	= "</li>";
		
		$this->ajax_pagination->initialize($config);
			
		$data['rec'] 				= $data_rec;
		$data['paginator'] 			= $this->ajax_pagination->create_links();

		$data['count'] 				= count($data_rec_count);
		$data['no'] 				= $no;
		$data['start'] 				= $page;
    	$data['hal'] 				= $page;
    	$data['cari'] 				= $cari;

		$this->load->view('template_admin',$data);
	}
    
	public function lists_uraian($cari=0, $page=1)
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

		$data_rec 					= $this->admin_uraian_model->get_uraian($sqlcari,$offset,$limit)->result_array();
		$data_rec_count 			= $this->admin_uraian_model->get_uraian($sqlcari,0,0)->result_array();
		$config['base_url'] 		= base_url().'admin_uraian/lists_uraian/'.$cari.'/';			
	
		$config['total_rows'] 		= count($data_rec_count);
		$config['per_page'] 		= $limit;
		$config['uri_segment']		= 4;
		$config['num_links'] 		= 1;
		$config['use_page_numbers'] = TRUE;
		$config['show_count']		= FALSE;
		$config['first_link'] 		= 'First';
		$config['last_link'] 		= 'Last';
		$config['next_link'] 		= '&gt;';
		$config['prev_link'] 		= '&lt;';
		$config['full_tag_open'] 	= "<ul class='pagination'>";
		$config['full_tag_close'] 	= "</ul>";
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] 	= "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] 	= "<li>";
		$config['next_tagl_close'] 	= "</li>";
		$config['prev_tag_open'] 	= "<li>";
		$config['prev_tagl_close'] 	= "</li>";
		$config['first_tag_open'] 	= "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] 	= "<li>";
		$config['last_tagl_close'] 	= "</li>";
		
		$this->ajax_pagination->initialize($config);
			
		$data['rec'] 				= $data_rec;
		$data['paginator'] 			= $this->ajax_pagination->create_links();

		$data['count'] 				= count($data_rec_count);
		$data['no'] 				= $no;
		$data['start'] 				= $page;
    	$data['hal'] 				= $page;
    	$data['cari'] 				= $cari;
						
		$this->load->view('main_tabel_ajax',$data);
	}

	public function add_uraian()
	{
		$data['sop']	= $this->admin_uraian_model->get_sop()->result_array();
		$data['users']	= $this->admin_uraian_model->get_users()->result_array();
		$this->load->view('add',$data);
	}

	public function edit_uraian($id,$page,$cari)
	{
		$data['custdata']		= $this->admin_uraian_model->get_uraian_detail($id);
		$data['sop']			= $this->admin_uraian_model->get_sop()->result_array();
		$data['users']			= $this->admin_uraian_model->get_users()->result_array();
		$data['page']			= $page;
		$data['cari']			= $cari;

		$this->load->view('edit',$data);
	}

	public function simpan_uraian()
	{
		$id = $this->input->post('iduraian');
		if ($this->input->post('cari')){
			$cari = $this->input->post('cari');
		} else {
			$cari = 0;
		}
		$data = array(			 
			 'sop_id' 				=> $this->input->post('sop'),
			 'nama' 				=> $this->input->post('nama'),
			 'deskripsi' 			=> $this->input->post('deskripsi'),
			 'pegawai_id'			=> $this->input->post('userid'),
		);

		if ($id == ''){
			$page = 1;
	        $this->load->library('upload');
	        $extension 					= pathinfo($_FILES['fileuraian']['name'], PATHINFO_EXTENSION);
			$filename 					= date('dmyhis');
	        $config['upload_path'] 		= 'uploads/uraian-kerja/';
	        $config['allowed_types'] 	= 'pdf|docx|xlsx|doc|xls|gif|jpg|png';
	        $config['max_size'] 		= '5024';
	        $config['file_name'] 		= $filename;

			if ($_FILES['fileuraian']['name'] != ''){
		        $this->upload->initialize($config);
		        if (!$this->upload->do_upload('fileuraian')){
		        	$error = $this->upload->display_errors();
					$this->session->set_flashdata('pesan', $error);
					redirect('uraian-kerja');
		        } else{
					$data['created_by'] 	= $this->session->userdata('user_login_id');
					$data['create_date'] 	= date('Y-m-d');
					$data['file'] 			= $filename.'.'.$extension;
					$this->db->insert('uraian', $data);
					$this->session->set_flashdata('pesan','Data berhasil di simpan');
					redirect('uraian-kerja');
		        }
		    } else{
				$data['created_by'] 	= $this->session->userdata('user_login_id');
				$data['create_date'] 	= date('Y-m-d');
				$this->db->insert('uraian', $data);
				$this->session->set_flashdata('pesan','Data berhasil di simpan');
				redirect('uraian-kerja');
		    }
		} else {
			if ($_FILES['fileuraian']['name'] != ''){
		        $this->load->library('upload');
		        $extension 					= pathinfo($_FILES['fileuraian']['name'], PATHINFO_EXTENSION);
				$filename 					= date('dmyhis');
		        $config['upload_path'] 		= 'uploads/uraian-kerja/';
		        $config['allowed_types'] 	= 'pdf|docx|xlsx|doc|xls|gif|jpg|png';
		        $config['max_size'] 		= '5024';
		        $config['file_name'] 		= $filename;

		        $this->upload->initialize($config);
		        if (!$this->upload->do_upload('fileuraian')){
		        	$error = $this->upload->display_errors();
					$this->session->set_flashdata('pesan', $error);
					redirect('uraian-kerja');
		        } else{
					$dt = $this->admin_uraian_model->get_uraian_detail($id);
					unlink('uploads/uraian-kerja/'.$dt->file);

					$data['update_by'] 		= $this->session->userdata('user_login_id');
					$data['update_date'] 	= date('Y-m-d');
					$data['file'] 			= $filename.'.'.$extension;
					$this->db->where('id_uraian', $id);
					$this->db->update('uraian', $data);
					$this->session->set_flashdata('pesan','Data berhasil di simpan');
					redirect('uraian-kerja');
		        }
		    } else{
				$data['update_by'] 		= $this->session->userdata('user_login_id');
				$data['update_date'] 	= date('Y-m-d');
				$this->db->where('id_uraian', $id);
				$this->db->update('uraian', $data);
				$this->session->set_flashdata('pesan','Data berhasil di simpan');
				redirect('uraian-kerja');
		    }
		}	
	}

	public function delete($id,$page,$cari)
	{
		$dt = $this->admin_uraian_model->get_uraian_detail($id);
		unlink('uploads/uraian-kerja/'.$dt->file);

		$this->db->where('id_uraian', $id);
		$this->db->delete('uraian');

		$this->session->set_flashdata('pesan','Data berhasil di hapus');
		
		$this->lists_uraian($cari,$page);
	}

}