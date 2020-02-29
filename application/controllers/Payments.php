<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['module_name'] = "Payments";
    }
	public function index()
	{        
        $transactions = $this->db->query("SELECT 
                            transactions.*
                        FROM transactions
                        LEFT JOIN user_master ON user_master.user_id = transactions.user_id
                        LEFT JOIN user_master AS demise_user ON demise_user.user_id = transactions.demise_user_id
                        ")->result_array();
        $this->data['transactions'] = $transactions;
        $this->data['page_name'] = "Payments";
		$this->data['breadcrumb'] = $this->load->view('payment/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('payment/payment_list', $this->data);
        $this->load->view('layout/footer', $this->data);
	}
}