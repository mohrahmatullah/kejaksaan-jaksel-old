<?php 

/**
* 
*/
class Model_voucher_fisik extends CI_Model
{
  
	function __construct()
	{
		parent::__construct();
	}
  
	/* VOUCHER */
	function get_voucher_by_id($id)
	{
		$this->db->select("voucher_stok.invoice_id, voucher_out.no_invoice");
		$this->db->from("voucher_stok");
		$this->db->join("voucher_out", "voucher_out.id_invoice = voucher_stok.invoice_id");
		$this->db->where("voucher_stok.no_voucher", $id);
		$query = $this->db->get();

		return $query->row();
	}

}