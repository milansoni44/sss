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

		$year = date('Y');
		$month = date('m');

		if($month <= 3) $year--;

		$fn_start = "{$year}-04-01";
		$h2_start = date('Y-m-d',strtotime($fn_start. " +6 months"));
		$h1_end = date('Y-m-d',strtotime($h2_start. " -1 days"));
		$fn_end = date('Y-m-d',strtotime($h2_start. " +6 months -1 days"));

		// echo $fn_start,"<br/>";
		// echo $h1_end,"<br/>";
		// echo $h2_start,"<br/>";
		// echo $fn_end,"<br/>";
		
		$start = $end = null;
		if(strtotime(date('Y-m-d')) >= $fn_start && strtotime(date('Y-m-d')) <= $h1_end) {
			$start = $fn_start;
			$end = $h1_end;
		} else {
			$start = $h2_start;
			$end = $fn_end;
		}

		$demise_members = $this->db->query("SELECT
                                                COUNT(*) AS total_demises
                                            FROM user_master
                                            WHERE status = 'Deactive'
                                            AND user_type <> 'Admin'
                                            AND demise_date BETWEEN '{$start}' AND '{$end}'
                                            ")->row_array();

		$this->data['total_demises'] = $demise_members['total_demises'];
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