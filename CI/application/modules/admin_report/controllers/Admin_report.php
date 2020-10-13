<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_report extends CI_Controller
{

	/**
	 * @author Rusmanto
	 **/

	public function __construct()
	{
			parent::__construct();
			date_default_timezone_set("Asia/Jakarta");
			$this->load->library('ajax_pagination');
			$this->load->model('admin_report_model');
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
				'nav_active'			=> 'report',
				'content'  				=> 'admin_report/main'
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
		$data_rec 					= $this->admin_report_model->get_report($cari,$offset,$limit)->result_array();
		$data_rec_count 			= $this->admin_report_model->get_report($cari,0,0)->result_array();
		$config['base_url'] 		= base_url().'admin_report/lists_report/'.$cari.'/';			
	
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
    
	public function lists_report($cari=0, $page=1)
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

		$data_rec 					= $this->admin_report_model->get_report($sqlcari,$offset,$limit)->result_array();
		$data_rec_count 			= $this->admin_report_model->get_report($sqlcari,0,0)->result_array();
		$config['base_url'] 		= base_url().'admin_report/lists_report/'.$cari.'/';			
	
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

}