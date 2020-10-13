<?php
class Not_found extends CI_Controller {

	public function __construct(){
			parent::__construct();
	}
		
	public function index()
	{
		$data = array(
			'title'    				=> 'Dashboard Aplikasi Kejaksaan Negeri Jakarta Selatan',
			'description' 			=> 'Dashboard Aplikasi Kejaksaan Negeri Jakarta Selatan',
			'keywords' 				=> 'kejaksaan negeri, jakarta selatan, jaksa agung, pengadilan negeri',
			'nav_active'			=> 'home',
			'content'  				=> 'not_found'
		);

		$this->load->view('template_admin',$data);
	}
	
}

