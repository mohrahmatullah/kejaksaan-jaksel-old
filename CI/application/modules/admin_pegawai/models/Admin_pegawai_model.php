<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_pegawai_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function get_pegawai($cari=0,$offset, $limit=0){
		$this->db->select("pegawai.*, propinsi.nama_propinsi AS propinsi, kabupaten.nama_kabupaten AS kabupaten, pegawai_jabatan.nama AS tipe");
		$this->db->from("pegawai");
		$this->db->join("propinsi","pegawai.propinsi = propinsi.id_propinsi","left");
		$this->db->join("kabupaten","pegawai.kabupaten = kabupaten.id_kabupaten","left");
		$this->db->join("pegawai_jabatan","pegawai.jabatan_id = pegawai_jabatan.id_jabatan","left");
    	$this->db->where('pegawai.deleted', 0);
		if ($cari != '0'){
			$this->db->like('pegawai.nama', $cari);
			$this->db->or_like('propinsi.nama_propinsi', $cari);
			$this->db->or_like('kabupaten.nama_kabupaten', $cari);
			$this->db->or_like('pegawai_jabatan.nama', $cari);
		}
    	$this->db->order_by('pegawai.nama', 'ASC');
		if ($limit > 0){
			$this->db->limit($limit, $offset);
		}
		$result = $this->db->get();

		return $result;
	}
		
	function get_pegawai_detail($id){
		$this->db->select("*");
		$this->db->from("pegawai");
    	$this->db->where('id_pegawai', $id);
		$result = $this->db->get();

		return $result->row();
	}
		
	function get_propinsi(){
		$this->db->select("*");
		$this->db->from("propinsi");
    	$this->db->order_by('nama_propinsi', 'ASC');
		$result = $this->db->get();

		return $result;
	}
		
	function get_pegawai_jabatan(){
		$this->db->select("*");
		$this->db->from("pegawai_jabatan");
    	$this->db->order_by('id_jabatan', 'ASC');
		$result = $this->db->get();

		return $result;
	}
		
	function get_kabupaten($propinsi){
		$this->db->select("*");
		$this->db->from("kabupaten");
    	$this->db->where('propinsi_id', $propinsi);
    	$this->db->order_by('nama_kabupaten', 'ASC');
		$result = $this->db->get();

		return $result;
	}
		
	function get_kabupaten_all(){
		$this->db->select("*");
		$this->db->from("kabupaten");
    	$this->db->order_by('nama_kabupaten', 'ASC');
		$result = $this->db->get();

		return $result;
	}
		
}
 
