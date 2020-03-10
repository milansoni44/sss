<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Add you custom models here that you are loading in your controllers
 * @property user_model $user_model
 */
class Dashboard extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper( array("form", "url") );
		$this->load->library("session");
		$this->load->config("global_path");
        $this->load->model("user_model");
		$this->data['admin_design_path'] = $this->config->item("admin_design_path");
        $this->data['module_name'] = "Dashboard";
	}
	
	public function index()
	{

		$badge_data = $this
                            ->db
                            ->query("
                                SELECT
                                ledger.name,
                                (
                                    IFNULL(SUM(debit_tr.amount),0) - IFNULL(SUM(credit_tr.amount),0)
                                ) as `balance`
                            FROM ledger
                            LEFT JOIN transactions as debit_tr ON debit_tr.ledger_id = ledger.id AND debit_tr.type = 'Debit' AND debit_tr.status='PAID'
                            LEFT JOIN transactions as credit_tr ON credit_tr.ledger_id = ledger.id AND credit_tr.type = 'Credit' AND credit_tr.status='PAID'
                            GROUP BY ledger.id")
							->result_array();
		
		$this->data['badge_data'] = $badge_data;

		$active_members = $this->db->query("SELECT
                                                COUNT(*) as `total_active_members`
                                            FROM user_master
                                            WHERE status = 'Active'
                                            AND user_type <> 'Admin'
                                            ")->row_array();

		$this->data['total_active_members'] = $active_members['total_active_members'];

        $this->data['page_name'] = '';
        
        $this->data['breadcrumb'] = $this->load->view('user/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('user/dashboard', $this->data);
        $this->load->view('layout/footer', $this->data);
	}

}