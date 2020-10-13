<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_uraian_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function get_uraian($cari=0,$offset, $limit=0){
		$this->db->select("uraian.*, sop.nama as namasop, pegawai.nama as namauser");
		$this->db->from("uraian");
		$this->db->join("sop","sop.id_sop = uraian.sop_id","left");
		$this->db->join("pegawai","pegawai.id_pegawai = uraian.pegawai_id","left");
		$this->db->join("users","users.pegawai_id = pegawai.id_pegawai","left");
		if ($cari != '0'){
			$this->db->like('uraian.nama', $cari);
			$this->db->or_like('uraian.deskripsi', $cari);
		}
    	$this->db->order_by('sop.nama', 'ASC');
		if ($limit > 0){
			$this->db->limit($limit, $offset);
		}
		$result = $this->db->get();

		return $result;
	}
		
	function get_uraian_detail($id){
		$this->db->select("*");
		$this->db->from("uraian");
    	$this->db->where('id_uraian', $id);
		$result = $this->db->get();

		return $result->row();
	}
		
	function get_sop(){
		$this->db->select("*");
		$this->db->from("sop");
    	$this->db->order_by('nama', 'ASC');
		$result = $this->db->get();

		return $result;
	}
		
	function get_users(){
		$this->db->select("pegawai.*");
		$this->db->from("pegawai");
		$this->db->join("users","users.pegawai_id = pegawai.id_pegawai","left");
    	$this->db->where('users.level', 'admin');
    	$this->db->order_by('pegawai.nama', 'ASC');
		$result = $this->db->get();

		return $result;
	}
		
}
 
