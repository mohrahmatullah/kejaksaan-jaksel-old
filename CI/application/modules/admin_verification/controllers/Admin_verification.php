<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_verification extends CI_Controller
{

	/**
	 * @author Rusmanto
	 **/

	public function __construct()
	{
			parent::__construct();
			date_default_timezone_set("Asia/Jakarta");
			$this->load->library('ajax_pagination');
			$this->load->model('admin_verification_model');
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
				'nav_active'			=> 'verification',
				'content'  				=> 'admin_verification/main'
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
		$data_rec 					= $this->admin_verification_model->get_verification($cari,$offset,$limit)->result_array();
		$data_rec_count 			= $this->admin_verification_model->get_verification($cari,0,0)->result_array();
		$config['base_url'] 		= base_url().'admin_verification/lists_verification/'.$cari.'/';			
	
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
    
	public function lists_verification($cari=0, $page=1)
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

		$data_rec 					= $this->admin_verification_model->get_verification($sqlcari,$offset,$limit)->result_array();
		$data_rec_count 			= $this->admin_verification_model->get_verification($sqlcari,0,0)->result_array();
		$config['base_url'] 		= base_url().'admin_verification/lists_verification/'.$cari.'/';			
	
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

	public function edit_verification($id,$page,$cari)
	{
		$data['custdata']		= $this->admin_verification_model->get_uraian_detail($id);
		$data['verdata'] 		= $this->admin_verification_model->get_verification_by_uraian($id);
		if ($this->session->userdata('user_login_level') == 'superadmin'){
			$data['pegawai']	= $this->admin_verification_model->get_pegawai()->result_array();
		} else {
			$data['pegawai']	= $this->admin_verification_model->get_pegawai_detail($this->session->userdata('user_pegawai_id'));
		}
		$data['peraturan']		= $this->admin_verification_model->get_peraturan()->result_array();
		$data['sop']			= $this->admin_verification_model->get_sop()->result_array();
		$data['uraian']			= $this->admin_verification_model->get_uraian($data['custdata']->sop_id)->result_array();
		$data['page']			= $page;
		$data['cari']			= $cari;

		$this->load->view('edit',$data);
	}

	public function simpan_verification()
	{
		$id = $this->input->post('idverification');
		if ($this->input->post('cari')){
			$cari = $this->input->post('cari');
		} else {
			$cari = 0;
		}

		$data = array(			 
			 'pegawai_id' 				=> $this->input->post('pegawai'),
			 'peraturan_id' 			=> $this->input->post('peraturan'),
			 'sop_id' 					=> $this->input->post('sop'),
			 'laporan' 					=> $this->input->post('laporan'),
			 'uraian_id' 				=> $this->input->post('uraian'),
		);

		if ($id == ''){
			$page = 1;
	        $this->load->library('upload');
	        /* BEFORE */
	        $extension 					= pathinfo($_FILES['filebefore']['name'], PATHINFO_EXTENSION);
			$filename1 					= date('dmyhis').'_1';
	        $config['upload_path'] 		= 'uploads/verification-file/before/';
	        $config['allowed_types'] 	= 'pdf|docx|xlsx|doc|xls|gif|jpg|png';
	        $config['max_size'] 		= '5024';
	        $config['file_name'] 		= $filename1;
			if ($_FILES['filebefore']['name'] != ''){
		        $this->upload->initialize($config);
		        if (!$this->upload->do_upload('filebefore')){
		        	$error = $this->upload->display_errors();
					$this->session->set_flashdata('pesan', $error);
					redirect('verification-file');
		        } else{
					$data['file_before'] 	= $filename1.'.'.$extension;
					$data['time_before'] 	= date('Y-m-d H:i:s', strtotime($this->input->post('timebefore')));
		        }
		    } else {
				$data['file_before'] 	= '';
				$data['time_before'] 	= '';
		    }

	        /* AFTER */
	        $extension 					= pathinfo($_FILES['fileafter']['name'], PATHINFO_EXTENSION);
			$filename2 					= date('dmyhis').'_2';
	        $config1['upload_path'] 	= 'uploads/verification-file/after/';
	        $config1['allowed_types'] 	= 'pdf|docx|xlsx|doc|xls|gif|jpg|png';
	        $config1['max_size'] 		= '5024';
	        $config1['file_name'] 		= $filename2;
			if ($_FILES['fileafter']['name'] != ''){
		        $this->upload->initialize($config1);
		        if (!$this->upload->do_upload('fileafter')){
		        	$error = $this->upload->display_errors();
					$this->session->set_flashdata('pesan', $error);
					redirect('verification-file');
		        } else{
					$data['file_after'] 	= $filename2.'.'.$extension;
					$data['time_after'] 	= date('Y-m-d H:i:s', strtotime($this->input->post('timeafter')));
		        }
		    } else {
				$data['file_after'] 	= '';
				$data['time_after'] 	= '';
		    }

			$data['created_by'] 	= $this->session->userdata('user_login_id');
			$data['create_date'] 	= date('Y-m-d');
			$this->db->insert('verification', $data);
			$this->session->set_flashdata('pesan','Data berhasil di simpan');
			redirect('verification-file');
		} else {
	        $this->load->library('upload');
			if ($_FILES['filebefore']['name'] != ''){
		        $extension 					= pathinfo($_FILES['filebefore']['name'], PATHINFO_EXTENSION);
				$filename 					= date('dmyhis').'_1';
		        $config['upload_path'] 		= 'uploads/verification-file/before/';
		        $config['allowed_types'] 	= 'pdf|docx|xlsx|doc|xls|gif|jpg|png';
		        $config['max_size'] 		= '5024';
		        $config['file_name'] 		= $filename;

		        $this->upload->initialize($config);
		        if (!$this->upload->do_upload('filebefore')){
		        	$error = $this->upload->display_errors();
					$this->session->set_flashdata('pesan', $error);
					redirect('verification-file');
		        } else{
					$dt = $this->admin_verification_model->get_verification_detail($id);
					unlink('uploads/verification-file/before/'.$dt->file_before);
		        }
				$data['update_by'] 		= $this->session->userdata('user_login_id');
				$data['update_date'] 	= date('Y-m-d');
				$data['file_before']	= $filename.'.'.$extension;
				$data['time_before'] 	= date('Y-m-d H:i:s', strtotime($this->input->post('timebefore')));
				$this->db->where('id_verification', $id);
				$this->db->update('verification', $data);
			}
			if ($_FILES['fileafter']['name'] != ''){
		        $extension 					= pathinfo($_FILES['fileafter']['name'], PATHINFO_EXTENSION);
				$filename 					= date('dmyhis').'_2';
		        $config1['upload_path'] 		= 'uploads/verification-file/after/';
		        $config1['allowed_types'] 	= 'pdf|docx|xlsx|doc|xls|gif|jpg|png';
		        $config1['max_size'] 		= '5024';
		        $config1['file_name'] 		= $filename;

		        $this->upload->initialize($config1);
		        if (!$this->upload->do_upload('fileafter')){
		        	$error = $this->upload->display_errors();
					$this->session->set_flashdata('pesan', $error);
					redirect('verification-file');
		        } else{
					$dt = $this->admin_verification_model->get_verification_detail($id);
					unlink('uploads/verification-file/after/'.$dt->file_after);
		        }
				$data['update_by'] 		= $this->session->userdata('user_login_id');
				$data['update_date'] 	= date('Y-m-d');
				$data['file_after']		= $filename.'.'.$extension;
				$data['time_after'] 	= date('Y-m-d H:i:s', strtotime($this->input->post('timeafter')));
				$this->db->where('id_verification', $id);
				$this->db->update('verification', $data);
		    } 
		    if ($_FILES['filebefore']['name'] == '' && $_FILES['fileafter']['name'] == ''){
				$data['update_by'] 		= $this->session->userdata('user_login_id');
				$data['update_date'] 	= date('Y-m-d');
				$this->db->where('id_verification', $id);
				$this->db->update('verification', $data);
		    }
			$this->session->set_flashdata('pesan','Data berhasil di simpan');
			redirect('verification-file');
		}	
	}

	public function delete($id,$page,$cari)
	{
		$dt = $this->admin_verification_model->get_verification_detail($id);
		unlink('uploads/verification-file/before/'.$dt->file_before);
		unlink('uploads/verification-file/after/'.$dt->file_after);

		$this->db->where('id_verification', $id);
		$this->db->delete('verification');

		$this->session->set_flashdata('pesan','Data berhasil di hapus');
		
		$this->lists_verification($cari,$page);
	}

	public function get_opsi_sop($sop)
	{
		$dt	= $this->admin_verification_model->get_uraian($sop)->result_array();
		
		echo '<select id="uraian" class="form-control select2" multiple name="uraian[]" style="width:100%;" required>';
		echo '<option value="">Pilih Uraian Kerja</option>';
		foreach ($dt as $data){
			echo '<option value="'.$data["id_uraian"].'">'.$data["nama"].'</option>';
		}
		echo '</select>';
	}

}