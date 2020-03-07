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
                        'created_at'            => date('Y-m-d H:i:s')
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
        /*echo "<pre>";
        echo $this->db->last_query();
        echo "-----------------------------------------------------------";
        echo "<br/>";
        print_r($resultArr);
        echo "</pre>";*/

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
        if($this->input->is_ajax_request()) {
            $request = $_REQUEST;
            $columns = [
                'user_master.name',
                'user_master.mobile',
                'user_master.user_type',
                'user_master.address',
                'transactions.amount',
                'transactions.date_created',
                'ledger_account',
                'transactions.status'
            ];

            $where = " WHERE 1=1";

            if( !empty($request['search']['value']) ) {

                $search_value = $this->db->escape_like_str($request['search']['value']);

                $where .= " AND ( ";
                $where .="user_master.name LIKE '%".$search_value."%' ";
                $where .= " OR user_master.mobile LIKE '%".$search_value."%' ";
                $where .= " OR user_master.user_type LIKE '%".$search_value."%' ";
                $where .= " OR user_master.address LIKE '%".$search_value."%' ";
                $where .= " OR transactions.amount LIKE '%".$search_value."%' ";
                $where .= " OR transactions.date_created LIKE '%".$search_value."%' ";
                $where .= " OR transactions.status = '".$search_value."' ";
                $where .= " )";
            }

            $sql = "SELECT 
                        transactions.*,
                        user_master.name,
                        user_master.mobile,
                        user_master.user_type,
                        user_master.address,
                        (
                            CASE 
                                WHEN transactions.ledger_id IS NOT NULL THEN ledger.name
                                WHEN transactions.demise_user_id IS NOT NULL THEN demise_user.name
                                ELSE NULL
                            END
                        ) AS ledger_account
                    FROM transactions
                    LEFT JOIN user_master ON user_master.user_id = transactions.user_id
                    LEFT JOIN user_master AS demise_user ON demise_user.user_id = transactions.demise_user_id
                    LEFT JOIN ledger ON ledger.id = transactions.ledger_id
                    ";

            // echo "<pre>".$sql;die;
            $rs = $this->db->query($sql.$where);
            $records_total = $this->db->affected_rows();
            $records_filtered = $records_total;

            $orderBy = "";
            if( count($request['order']) > 0 ) {

                $temp = array();

                foreach($request['order'] as $order){
                    $temp[]= "".$columns[$order['column']]." ".$order['dir'];
                }
                $orderBy .= " ORDER BY ";
                $orderBy .= implode(",",$temp);
            }

            $c = $this->db->query($sql.$where.$orderBy);
            $records_filtered = $this->db->affected_rows();
            $limit = "";
            if($request['length'] != -1){
                $limit .= " LIMIT ".$request['start']." ,".$request['length'];
            }

            $rs = $this->db->query($sql.$where.$orderBy.$limit);
            $data =  $rs->result_array();

            $json_data = array(
                "draw"            => intval( $request['draw'] ),
                "recordsTotal"    => intval( $records_total ),
                "recordsFiltered" => intval( $records_filtered ),
                "data"            => $data
            );
            echo json_encode($json_data);die;
        }
        $this->data['page_name'] = "Payments";
		$this->data['breadcrumb'] = $this->load->view('payment/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('payment/payment_list', $this->data);
        $this->load->view('layout/footer', $this->data);
    }
    
    public function generate_invoice() {

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

        /*Get Total Inactive members of last 6 month*/
        $demise_members = $this->db->query("SELECT
                                                COUNT(*) AS total_demises,
                                                GROUP_CONCAT(user_id) AS user_demises_ids
                                            FROM user_master
                                            WHERE status = 'Deactive'
                                            AND user_type <> 'Admin'
                                            AND inactivity_date BETWEEN '2019-07-01' AND '2020-03-31'
                                            ")->row_array();

        // print_r($demise_members);die;

        if(!empty($active_members)) {
            foreach($active_members as &$member) {
                $member['demise_rate'] = ($demise_members['total_demises']*100);
                $member['institute_rate'] = ($demise_members['total_demises']*30);
                $member['administrative_rate_unit'] = (1*90);
                $member['total_demise'] = $demise_members['total_demises'];
                $member['demise_rate_unit'] = 100;
                $member['institute_rate_unit'] = 30;
                $member['demises_ids'] = $demise_members['user_demises_ids'];
            }
        }
        // print_r($active_members);
        // die;

        if(!empty($active_members)) {
            foreach($active_members as $transaction) {

                $txtArr = explode(',', $transaction['demises_ids']);
                if(!empty($txtArr)) {
                    $institute = [
                        'user_id'=>$transaction['user_id'],
                        'amount'=>$transaction['institute_rate'],
                        'ledger_id'=>3,
                        'date_created'=>date('Y-m-d H:i:s'),
                        'status'=> ($transaction['user_type'] != "Advance deposite") ? 'UNPAID' : 'PAID'
                    ];
                    // print_r($institute);
                    if($transaction['user_type'] == 'Advance deposite') {
                        $institute['payment_mode'] = 'Deposite';
                    }
                    $this->db->insert("transactions", $institute);
                    if($transaction['user_type'] == "Advance deposite") {
                        $this->db->set('balance', 'balance-'.$transaction['institute_rate'], false);
                        $this->db->where('user_id' , $transaction['user_id']);
                        $this->db->update('user_master');
                    }
                }

                // print_r($demiseArr);
                foreach($txtArr as $txn) {
                    // check user membership year > 25 years
                    if($transaction['membership_years'] < 25) {
                        $demise = [
                            'user_id'=>$transaction['user_id'],
                            'amount'=>100,
                            'demise_user_id'=>$txn,
                            'date_created'=>date('Y-m-d H:i:s'),
                            'status'=>($transaction['user_type'] != "Advance deposite") ? 'UNPAID' : 'PAID'
                        ];
                        if($transaction['user_type'] == 'Advance deposite') {
                            $demise['payment_mode'] = 'Deposite';
                        }
                        $this->db->insert("transactions", $demise);
                        if($transaction['user_type'] == "Advance deposite") {
                            $this->db->set('balance', 'balance-'.$transaction['institute_rate'], false);
                            $this->db->where('user_id' , $transaction['user_id']);
                            $this->db->update('user_master');
                        }
                    }
                    // print_r($demise);
                }

                $administrative = [
                    'user_id'=>$transaction['user_id'],
                    'amount'=>90,
                    'ledger_id'=>1,
                    'date_created'=>date('Y-m-d H:i:s'),
                    'status'=>($transaction['user_type'] != "Advance deposite") ? 'UNPAID' : 'PAID'
                ];
                
                if($transaction['user_type'] == 'Advance deposite') {
                    $administrative['payment_mode'] = 'Deposite';
                }
                $this->db->insert("transactions", $administrative);
                if($transaction['user_type'] == "Advance deposite") {
                    $this->db->set('balance', 'balance-'.$transaction['institute_rate'], false);
                    $this->db->where('user_id' , $transaction['user_id']);
                    $this->db->update('user_master');
                }
            }
        }
        echo "Success";
    }

    public function interest_paid() {
        // 3 monthly
        // pay interest 4% in user account

        $interests = $this->db->query("SELECT
                            user_master.*
                        FROM user_master
                        WHERE user_type = 'Advance Deposite'
                        AND status = 'Active'
                        ")->result_array();
        // echo "<pre>";
        // echo "Total Advance Deposite Members : ".count($interests)."<br/>";
        // print_r($interests);

        if(!empty($interests)) {
            foreach($interests as $interest) {
                $int_paid_amount = (float)(($interest['balance']*4)/100);
                echo "User_id : {$interest['user_id']} Balance : ".$interest['balance']." Interest Amount : {$int_paid_amount}<br/>";
                $this->db->query("UPDATE user_master SET balance = {$interest['balance']}+{$int_paid_amount}");

                $transactions = [
                    'user_id'=>$interest['user_id'],
                    'amount'=>$int_paid_amount,
                    'ledger_id'=>3,
                    'date_created'=>date('Y-m-d H:i:s'),
                    'date_paid'=>date('Y-m-d H:i:s'),
                    'payment_mode'=>'AUTO',
                    'status'=>'PAID',
                    'type'=>'Credit'
                ];

                $this->db->insert('transactions', $transactions);

                // update institute ledger account
                $this->db->set('balance', 'balance-'.$int_paid_amount, false);
                $this->db->where('id' , 3);
                $this->db->update('ledger');
            }
        }
        echo "Success";die;
    }

    public function post_payment_individually() {

        $this->data['user_id'] = null;
        $this->data['pending_payments'] = null;

        if( $this->input->server('REQUEST_METHOD') == 'POST') {
            
            $user_id = $this->input->post('member_id');
            $this->data['user_id'] = $user_id;
            
            $action = $this->input->post('action');

            $pending_payments = $this->db
                                    ->query("SELECT
                                        ledger.name as ledger_name,
                                        user_master.name as user_name,
                                        transactions.id,
                                        transactions.demise_user_id,
                                        transactions.ledger_id,
                                        transactions.amount,
                                        transactions.date_created
                                    FROM transactions
                                    LEFT JOIN ledger ON ledger.id = transactions.ledger_id
                                    LEFT JOIN user_master ON user_master.user_id = transactions.demise_user_id
                                    WHERE transactions.user_id = '{$user_id}'
                                    AND transactions.status = 'UNPAID'")->result_array();
            $this->data['pending_payments'] = $pending_payments;

            if($action == 'Pay') {
                
                // echo "<pre>";print_r($pending_payments);die;
                // $paid_amount = $this->input->post('paid_amount');
                
                $this->db->trans_start();
                foreach($pending_payments as $pd) {
                    if($pd['ledger_id']) {
                        $this->db->query("Update ledger set `balance` = `balance` + {$pd['amount']} WHERE id = {$pd['ledger_id']}");
                    } else {
                        $this->db->query("Update user_master set `balance` = `balance` + {$pd['amount']} WHERE user_id = {$pd['demise_user_id']}");
                    }

                    $this->db->where("id",$pd['id'])->update("transactions",["status"=>"PAID"]);
                }

                $this->db->trans_complete();

                if($this->db->trans_status() === TRUE) {
                    $this->session->set_flashdata("success", "Payment Processed.");
                } else {
                    $this->session->set_flashdata("failure", "Payment not Processed.");
                }
                
                redirect("payments/post_payment_individually");
            }
        }

        $this->data['page_name'] = 'Recieve Payment';        
        

        $this->data['members'] = $this->db->select("user_id, name")->get("user_master")->result_array();

        $this->data['breadcrumb'] = $this->load->view('payment/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('payment/post_payment_individually', $this->data);
        $this->load->view('layout/footer', $this->data);

    }
}