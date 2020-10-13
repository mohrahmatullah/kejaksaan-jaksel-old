<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_main_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function cek_login($username,$password){
		$this->db->select("*");
		$this->db->from("users");
    	$this->db->where('username', $username);
    	$this->db->where('password', $password);
		$result = $this->db->get();

		return $result;
	}
		
}
 
