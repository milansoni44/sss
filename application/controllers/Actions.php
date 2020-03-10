<?php
ini_set('max_execution_time', 0); // 0 = Unlimited
defined('BASEPATH') OR exit('No direct script access allowed');

class Actions extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['module_name'] = "Payments";
    }

	public function index() {
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
                    redirect("actions");
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

        $interests = $this
                        ->db
                        ->query("SELECT
                                user_master.*,
                                transactions.id as transection_id
                            FROM user_master
                            LEFT JOIN transactions ON transactions.user_id = user_master.user_id AND transactions.financial_year = {$fn_year} AND transactions.fy_start_date = '{$start}' AND transactions.fy_end_date = '{$end}' AND transactions.type='Credit'
                            WHERE user_master.user_type = 'Advance deposite'
                            AND user_master.status = 'Active'
                            GROUP BY user_master.user_id")
                        ->result_array();
        
        // echo "<pre>";print_r($interests);die;

        if(!empty($interests)) {

            $this->db->trans_start();

            foreach($interests as $interest) {

                if($interest['transection_id']) {
                    echo "SKIPPING<br/>";
                    continue;
                }

                $int_paid_amount = (float)(($interest['balance']*4)/100);
                
                $this->db->query("UPDATE user_master SET balance = {$interest['balance']}+{$int_paid_amount}");
                // echo "<pre>".$this->db->last_query();
                $transactions = [
                    'user_id'=>$interest['user_id'],
                    'amount'=>$int_paid_amount,
                    'ledger_id'=>3,
                    'date_created'=>date('Y-m-d H:i:s'),
                    'date_paid'=>date('Y-m-d H:i:s'),
                    'payment_mode'=>'AUTO',
                    'status'=>'PAID',
                    'type'=>'Credit',
                    'financial_year'=>$fn_year,
                    'fy_start_date'=>$start,
                    'fy_end_date'=>$end,
                ];

                $this->db->insert('transactions', $transactions);
                // echo "<pre>".$this->db->last_query();
                // update institute ledger account
                $this->db->set('balance', 'balance-'.$int_paid_amount, false);
                $this->db->where('id' , 3);
                $this->db->update('ledger');
                // echo "<pre>".$this->db->last_query();
            }

            $this->db->trans_complete();

            if($this->db->trans_status() === TRUE) {
                $this->session->set_flashdata("success", "Interest Payment transection completed.");
            } else {
                $this->session->set_flashdata("error", "Interest Payment transection failed.");
            }

        } else {
            $this->session->set_flashdata("success", "No data to process.");
        }

        // die;
        redirect("actions");

    }

    public function generate_invoice($fn_year,$start,$end) {

        // Get all active members
        $active_members = $this->db->query("SELECT
                                                user_id,
                                                user_type,
                                                DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(insert_date, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(insert_date, '00-%m-%d')) AS membership_years
                                            FROM user_master
                                            WHERE status = 'Active'
                                            AND user_type <> 'Admin'
                                            ")->result_array();
                
        // echo "<pre>"; 
        // echo "Total Active Members :".count($active_members)."<br/>";
        // print_r($active_members);die;

        /*Get Total Inactive members between $start and $end*/
        $demise_members = $this->db->query("SELECT
                                                COUNT(*) AS total_demises,
                                                GROUP_CONCAT(user_id) AS user_demises_ids
                                            FROM user_master
                                            WHERE status = 'Deactive'
                                            AND user_type <> 'Admin'
                                            AND demise_date BETWEEN '{$start}' AND '{$end}'
                                            ")->row_array();
        // print_r($demise_members);die;
    }

    public function send_invoice_email($fn_year,$start,$end) {
    }

};