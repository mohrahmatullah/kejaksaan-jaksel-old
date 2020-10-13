<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_pegawai extends CI_Controller
{

	/**
	 * @author Rusmanto
	 **/

	public function __construct()
	{
			parent::__construct();
			date_default_timezone_set("Asia/Jakarta");
			$this->load->library('ajax_pagination');
			$this->load->model('admin_pegawai_model');
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
				'content'  				=> 'admin_pegawai/main'
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
		$data_rec 					= $this->admin_pegawai_model->get_pegawai($cari,$offset,$limit)->result_array();
		$data_rec_count 			= $this->admin_pegawai_model->get_pegawai($cari,0,0)->result_array();
		$config['base_url'] 		= base_url().'admin_pegawai/lists_pegawai/'.$cari.'/';			
	
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
    
	public function lists_pegawai($cari=0, $page=1)
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

		$data_rec 					= $this->admin_pegawai_model->get_pegawai($sqlcari,$offset,$limit)->result_array();
		$data_rec_count 			= $this->admin_pegawai_model->get_pegawai($sqlcari,0,0)->result_array();
		$config['base_url'] 		= base_url().'admin_pegawai/lists_pegawai/'.$cari.'/';			
	
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

	public function get_opsi_kabupaten($prop)
	{
		$kab	= $this->admin_pegawai_model->get_kabupaten($prop)->result_array();
		
		echo '<select id="kabpegawai" class="form-control select2" name="kabpegawai" style="width:100%;">';
		echo '<option value="">Pilih Kabupaten</option>';
		foreach ($kab as $data){
			echo '<option value="'.$data["id_kabupaten"].'">'.$data["nama_kabupaten"].'</option>';
		}
		echo '</select>';
	}

	public function add_pegawai()
	{
		$data['propinsiall']	= $this->admin_pegawai_model->get_propinsi()->result_array();
		$data['pegawaitype']	= $this->admin_pegawai_model->get_pegawai_jabatan()->result_array();

		$this->load->view('add',$data);
	}

	public function edit_pegawai($id,$page,$cari)
	{
		$data['custdata']		= $this->admin_pegawai_model->get_pegawai_detail($id);
		$data['propinsiall']	= $this->admin_pegawai_model->get_propinsi()->result_array();
		$data['kabupatenall']	= $this->admin_pegawai_model->get_kabupaten_all()->result_array();
		$data['pegawaitype']	= $this->admin_pegawai_model->get_pegawai_jabatan()->result_array();
		$data['page']			= $page;
		$data['cari']			= $cari;

		$this->load->view('edit',$data);
	}

	public function simpan_pegawai()
	{
		$id = $this->input->post('idpegawai');
		if ($this->input->post('cari')){
			$cari = $this->input->post('cari');
		} else {
			$cari = 0;
		}
		$data = array(			 
			 'nik' 				=> $this->input->post('nik'),
			 'nama' 			=> $this->input->post('nama'),
			 'alamat' 			=> $this->input->post('alamat'),
			 'kabupaten' 		=> $this->input->post('kabupaten'),
			 'propinsi' 		=> $this->input->post('propinsi'),
			 'telp' 			=> $this->input->post('telp'),
			 'email' 			=> $this->input->post('email'),
			 'jabatan_id'		=> $this->input->post('jabatan'),
		);

		$datauser = array(			 
			 'nama' 			=> $this->input->post('nama'),
			 'email' 			=> $this->input->post('email'),
		);

		if ($id == ''){
			$page = 1;
			$this->db->insert('pegawai', $data);
			$idlast = $this->db->insert_id();

			$datauser['username'] 	= strtolower(str_replace(' ', '', $this->input->post('nama')));
			$datauser['password'] 	= md5('123456');
			$datauser['level'] 		= 'admin';
			$datauser['pegawai_id']	= $idlast;
			$this->db->insert('users', $datauser);
			$this->session->set_flashdata('pesan','Data berhasil di simpan');
		} else {
			$this->db->where('id_pegawai', $id);
			$this->db->update('pegawai', $data);

			$datauser['username'] 	= strtolower(str_replace(' ', '', $this->input->post('nama')));
			$this->db->where('pegawai_id', $id);
			$this->db->update('users', $datauser);
			$this->session->set_flashdata('pesan','Data berhasil di simpan');
			$page = $this->input->post('page');
		}
		
		$this->lists_pegawai($cari,$page);
	}

	public function delete($id,$page,$cari)
	{
		$this->db->where('id_pegawai', $id);
		$this->db->delete('pegawai');
		
		$this->db->where('pegawai_id', $id);
		$this->db->delete('users');

		$this->session->set_flashdata('pesan','Data berhasil di hapus');
		
		$this->lists_pegawai($cari,$page);
	}

}