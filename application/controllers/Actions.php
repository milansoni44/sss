<?php
ini_set('max_execution_time', 0); // 0 = Unlimited
defined('BASEPATH') OR exit('No direct script access allowed');

class Actions extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['module_name'] = "Payments";
    }

	public function index()
	{

        if($this->input->server('REQUEST_METHOD') === 'POST'){
            
            $fn_year = $this->input->post("fn_year");   //2016, 2017 ...
            list($start, $end) = array_map(function($val){return date('Y-m-d',$val);},explode("-",$this->input->post("duration")));
            $action_type = $this->input->post("action_type");

            switch($action_type) {
                case 'pay_interest':
                    $this->pay_interest($fn_year,$start,$end);
                    break;                    
                case 'generate_invoice':
                    $this->generate_invoice($fn_year,$start,$end);
                    break;
                case 'send_invoice_email':
                    $this->send_invoice_email($fn_year,$start,$end);
                    break;
                default:
                    recirect("actions");
            }
        }

        $this->data['page_name'] = 'Periodic Activities';
        $this->data['breadcrumb'] = $this->load->view('payment/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('actions/trigger_action', $this->data);
        $this->load->view('layout/footer', $this->data);
    }

    public function pay_interest($fn_year,$start,$end) {

        // $interests = $this
        //                 ->db
        //                 ->query("SELECT
        //                         user_master.*,
        //                         transactions.id
        //                     FROM user_master
        //                     LEFT JOIN transactions ON transactions.user_id = user_master.user_id AND transactions.financial_year = {$fn_year} AND transactions.fy_start_date = '{$start}' AND transactions.fy_end_date = '{$end}' AND transactions.type='Credit'
        //                     WHERE user_master.user_type = 'Advance deposite'
        //                     AND user_master.status = 'Active'
        //                     GROUP BY user_master.id")
        //                 ->result_array();
        
        echo "<pre>","SELECT
        user_master.*,
        transactions.id
    FROM user_master
    LEFT JOIN transactions ON transactions.user_id = user_master.user_id AND transactions.financial_year = {$fn_year} AND transactions.fy_start_date = '{$start}' AND transactions.fy_end_date = '{$end}' AND transactions.type='Credit'
    WHERE user_master.user_type = 'Advance deposite'
    AND user_master.status = 'Active'
    GROUP BY user_master.id";die;print_r($interests);die;

    }

    public function generate_invoice($fn_year,$start,$end) {
    }

    public function send_invoice_email($fn_year,$start,$end) {
    }

};