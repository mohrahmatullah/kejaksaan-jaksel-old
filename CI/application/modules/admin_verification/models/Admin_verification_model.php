<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_verification_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function get_verification($cari=0,$offset, $limit=0){
		if ($this->session->userdata('user_login_level') == 'admin'){
			$this->db->where('uraian.pegawai_id', $this->session->userdata('user_pegawai_id'));
		}
		$this->db->select("verification.*, peraturan.nomor as nomorperaturan, peraturan.tentang as tentangperaturan, sop.nama as namasop, pegawai.nama as namapegawai, uraian.nama as namauraian, uraian.create_date as tglbuat, uraian.id_uraian");
		$this->db->from("uraian");
		$this->db->join("sop","sop.id_sop = uraian.sop_id","left");
		$this->db->join("peraturan","peraturan.id_peraturan = sop.peraturan_id","left");
		$this->db->join("pegawai","pegawai.id_pegawai = uraian.pegawai_id","left");
		$this->db->join("users","users.pegawai_id = pegawai.id_pegawai","left");
		$this->db->join("verification","verification.uraian_id = uraian.id_uraian","left");
		if ($cari != '0'){
			$this->db->like('uraian.nama', $cari);
			$this->db->or_like('uraian.deskripsi', $cari);
		}
    	$this->db->order_by('uraian.create_date', 'DESC');
		if ($limit > 0){
			$this->db->limit($limit, $offset);
		}
		$result = $this->db->get();

		return $result;
	}
		
	function get_verification_detail($id){
		$this->db->select("*");
		$this->db->from("verification");
    	$this->db->where('id_verification', $id);
		$result = $this->db->get();

		return $result->row();
	}
		
	function get_verification_by_uraian($id){
		$this->db->select("*");
		$this->db->from("verification");
    	$this->db->where('uraian_id', $id);
		$result = $this->db->get();

		return $result->row();
	}
		
	function get_uraian_detail($id){
		$this->db->select("uraian.*, sop.id_sop, peraturan.id_peraturan, verification.*, uraian.pegawai_id as idpegawai");
		$this->db->from("uraian");
		$this->db->join("sop","sop.id_sop = uraian.sop_id","left");
		$this->db->join("peraturan","peraturan.id_peraturan = sop.peraturan_id","left");
		$this->db->join("pegawai","pegawai.id_pegawai = uraian.pegawai_id","left");
		$this->db->join("users","users.pegawai_id = pegawai.id_pegawai","left");
		$this->db->join("verification","verification.uraian_id = uraian.id_uraian","left");
    	$this->db->where('id_uraian', $id);
		$result = $this->db->get();

		return $result->row();
	}
		
	function get_sop_detail($id){
		$this->db->select("*");
		$this->db->from("sop");
    	$this->db->where('id_sop', $id);
		$result = $this->db->get();

		return $result->row();
	}
		
	function get_peraturan_detail($id){
		$this->db->select("*");
		$this->db->from("peraturan");
    	$this->db->where('id_peraturan', $id);
		$result = $this->db->get();

		return $result->row();
	}
		
	function get_pegawai_detail($id){
		$this->db->select("pegawai.*, pegawai_jabatan.nama as jabatan");
		$this->db->from("pegawai");
		$this->db->join("pegawai_jabatan","pegawai_jabatan.id_jabatan = pegawai.jabatan_id","left");
    	$this->db->where('id_pegawai', $id);
		$result = $this->db->get();

		return $result->row();
	}
		
	function get_pegawai(){
		$this->db->select("*");
		$this->db->from("pegawai");
    	$this->db->order_by('nama', 'ASC');
		$result = $this->db->get();

		return $result;
	}
		
	function get_peraturan(){
		$this->db->select("*");
		$this->db->from("peraturan");
    	$this->db->order_by('nomor', 'ASC');
		$result = $this->db->get();

		return $result;
	}
		
	function get_sop(){
		$this->db->select("*");
		$this->db->from("sop");
    	$this->db->order_by('nama', 'ASC');
		$result = $this->db->get();

		return $result;
	}
		
	function get_uraian($id=null){
		if ($id != null){
			$this->db->where("sop_id", $id);
		}
		$this->db->select("*");
		$this->db->from("uraian");
    	$this->db->order_by('nama', 'ASC');
		$result = $this->db->get();

		return $result;
	}
		
}
 
