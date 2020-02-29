<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends MY_Controller {
    public $debug = false;
    public function __construct() {
        parent::__construct();
        $this->data['module_name'] = "Payments";
        $this->debug = true;
    }

    public function pay_membership_fee() {
        if($this->input->server("REQUEST_METHOD") == "POST") {
            $data = $this->input->post();
            
            if(!empty($data['user_id']) && !empty($data['membership_fee'])) {
                $arrTransaction = [];
                $user = $data['user_id'];
                $fee = $data['membership_fee'];
                for($index = 0; $index < count($data['user_id']); $index++) {
                    $arrTransaction[$index] = [
                        'user_id'               => $user[$index],
                        'membership_fee_paid'   => $fee[$index],
                        'created_at'            => date('Y-m-d H:i:s'),
                        // 'fee_flag'              => 'MEMBER_FEE'
                    ];
                }

                /* if($this->debug) {
                    echo "<pre>"; 
                    print_r($arrTransaction);
                    echo "</pre>";
                    die;
                } */
                $this->db->trans_start();
                $this->db->insert_batch('transactions', $arrTransaction);
                $this->db->trans_complete();
                if($this->db->trans_status()) {
                    $this->session->set_flashdata("success", "Membership fee paid successfully.");
                } else {
                    $this->session->set_flashdata("success", "Membership fee is failed to pay. Please try again later");
                }
            }
        } else {
            show_404();
        }
    }

    public function add_membership_fee() {
        /**
         * get the members who do not pay the monthly membership fee 
         */
        $sql = "SELECT 
                    user_master.*,
                    month_member.membership_fee_paid
                FROM user_master
                LEFT JOIN (
                    SELECT
                        transactions.membership_fee_paid,
                        transactions.user_id
                    FROM transactions
                    WHERE (MONTH(created_at) = '".date('m')."' AND YEAR(created_at) = '".date('Y')."')
                ) AS month_member ON month_member.user_id = user_master.user_id
                WHERE month_member.membership_fee_paid IS NULL
                AND user_master.user_type <> 'Admin'
                ";
        
        $resultArr = $this->db->query($sql)->result_array();
        if($this->debug) {
            /*echo "<pre>";
            echo $this->db->last_query();
            echo "-----------------------------------------------------------";
            echo "<br/>";
            print_r($resultArr);
            echo "</pre>";*/
        }

        $this->data['members'] = $resultArr;
        $this->data['page_name'] = "Membership Fee Pay";
		$this->data['breadcrumb'] = $this->load->view('payment/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('payment/membership_fee', $this->data);
        $this->load->view('layout/footer', $this->data);
    }

	public function index()
	{        
        $transactions = $this->db->query("SELECT 
                            transactions.*,
                            user_master.*
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