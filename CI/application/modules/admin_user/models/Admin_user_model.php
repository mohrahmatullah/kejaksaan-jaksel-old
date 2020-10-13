<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_user_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function get_users($cari=0,$offset, $limit=0){
		$this->db->select("users.*");
		$this->db->from("users");
		if ($cari != '0'){
			$this->db->like('users.nama', $cari);
		}
    $this->db->order_by('users.nama', 'ASC');
		if ($limit > 0){
			$this->db->limit($limit, $offset);
		}
		$result = $this->db->get();

		return $result;
	}
		
	function get_users_detail($id){
		$this->db->select("*");
		$this->db->from("users");
    $this->db->where('id', $id);
		$result = $this->db->get();

		return $result->row();
	}
		
	function get_username($id){
		$this->db->select("*");
		$this->db->from("users");
    $this->db->where('username', $id);
		$result = $this->db->get();

		return $result->num_rows();
	}
		
}
 
