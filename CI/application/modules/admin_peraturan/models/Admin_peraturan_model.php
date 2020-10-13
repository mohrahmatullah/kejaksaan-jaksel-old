<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_peraturan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function get_peraturan($cari=0,$offset, $limit=0){
		$this->db->select("peraturan.*");
		$this->db->from("peraturan");
		if ($cari != '0'){
			$this->db->like('peraturan.nomor', $cari);
			$this->db->or_like('peraturan.tentang', $cari);
			$this->db->or_like('peraturan.tahun', $cari);
		}
    	$this->db->order_by('peraturan.nomor', 'ASC');
		if ($limit > 0){
			$this->db->limit($limit, $offset);
		}
		$result = $this->db->get();

		return $result;
	}
		
	function get_peraturan_detail($id){
		$this->db->select("*");
		$this->db->from("peraturan");
    	$this->db->where('id_peraturan', $id);
		$result = $this->db->get();

		return $result->row();
	}
		
}
 
