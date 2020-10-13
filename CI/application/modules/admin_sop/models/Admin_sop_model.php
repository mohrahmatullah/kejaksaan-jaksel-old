<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_sop_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function get_sop($cari=0,$offset, $limit=0){
		$this->db->select("sop.*, peraturan.nomor, peraturan.tahun, peraturan.tentang");
		$this->db->from("sop");
		$this->db->join("peraturan","peraturan.id_peraturan = sop.peraturan_id","left");
		if ($cari != '0'){
			$this->db->like('sop.nama', $cari);
			$this->db->or_like('sop.deskripsi', $cari);
		}
    	$this->db->order_by('sop.nama', 'ASC');
		if ($limit > 0){
			$this->db->limit($limit, $offset);
		}
		$result = $this->db->get();

		return $result;
	}
		
	function get_sop_detail($id){
		$this->db->select("*");
		$this->db->from("sop");
    	$this->db->where('id_sop', $id);
		$result = $this->db->get();

		return $result->row();
	}
		
	function get_peraturan(){
		$this->db->select("*");
		$this->db->from("peraturan");
    	$this->db->order_by('nomor', 'ASC');
		$result = $this->db->get();

		return $result;
	}
		
}
 
