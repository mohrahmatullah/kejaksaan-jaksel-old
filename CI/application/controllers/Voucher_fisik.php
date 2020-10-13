<?php

require APPPATH . '/libraries/REST_Controller.php';

class Voucher_fisik extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
				$this->load->model('model_voucher_fisik');
    }

    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
					// Set the response and exit
					$this->response([
							'status' => FALSE,
							'message' => 'Kode Voucher tidak valid'
					], REST_Controller::HTTP_NOT_FOUND);
        } else {
            $voucher = $this->model_voucher_fisik->get_voucher_by_id($id);
						if (isset($voucher)){
							// Set the response and exit
							$this->response([
									'status' => TRUE,
									'id_pembayaran' => $voucher->invoice_id,
									'no_invoice' => $voucher->no_invoice,
									'message' => 'Kode Voucher Valid'
							], REST_Controller::HTTP_OK);
						} else {
							// Set the response and exit
							$this->response([
									'status' => FALSE,
									'message' => 'Kode Voucher tidak valid'
							], REST_Controller::HTTP_NOT_FOUND);
						}
        }
    }
		
}
