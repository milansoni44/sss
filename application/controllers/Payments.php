<?php
ini_set('max_execution_time', 0); // 0 = Unlimited
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends MY_Controller {
    public $debug = false;
    public function __construct() {
        parent::__construct();
        $this->data['module_name'] = "Payments";
        $this->debug = true;
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


            if($member_id = $request['member']) {
                $where .= " AND transactions.user_id = {$member_id}";
            }
            if($date_range = $request['date_range']) {                
                $date_arr = explode(" - ",$date_range); // 2020-03-09 - 2020-03-09
                $where .= " AND (DATE(transactions.date_created) BETWEEN '{$date_arr[0]}' AND '{$date_arr[1]}')";
            }
// echo $sql.$where;die;
            $c = $this->db->query($sql.$where.$orderBy);
            $records_filtered = $this->db->affected_rows();
            $limit = "";
            if($request['length'] != -1){
                $limit .= " LIMIT ".$request['start']." ,".$request['length'];
            }

            $rs = $this->db->query($sql.$where.$orderBy.$limit);
            $data =  $rs->result_array();

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

            $json_data = array(
                "draw"            => intval( $request['draw'] ),
                "badge_data"      => $badge_data,
                "recordsTotal"    => intval( $records_total ),
                "recordsFiltered" => intval( $records_filtered ),
                "data"            => $data
            );
            echo json_encode($json_data);die;
        }

        $this->data['members'] = $this->db->select("user_id, name")->from("user_master")->where("user_type <> 'Admin'")->get()->result_array();

        $this->data['page_name'] = "Payments";
		$this->data['breadcrumb'] = $this->load->view('payment/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('payment/payment_list', $this->data);
        $this->load->view('layout/footer', $this->data);
    }

    public function post_payment_individually() {

        if ($this->input->is_ajax_request()) {
            
            $user_id = $this->input->post('user_id');

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

            $response_row = "";
            if($pending_payments) {

                $total = 0;
                foreach($pending_payments as $pd){
                    $account_name = ($pd['ledger_name']) ? $pd['ledger_name'] : $pd['user_name'];
                    $date = date('Y-m-d',strtotime($pd['date_created']));
                    $total += $pd['amount'];

                    $response_row .=  "<tr>
                                            <td>
                                                <input type='checkbox' 
                                                        name='transection_ids[]' 
                                                        value='{$pd['id']}' 
                                                        class='user_checkbox'
                                                        data-amount='{$pd['amount']}'
                                                        checked 
                                                />
                                            </td>
                                            <td>{$account_name}</td>
                                            <td>{$date}</td>
                                            <td>{$pd['amount']}</td>
                                        </tr>";
                }

                $response_html = "<div class='form-group'>
                                    <table id='dynamic_table' class='table table-striped table-bordered table-hover'>
                                        <thead>
                                        <th><input type='checkbox' id='all_checkbox' checked/></th>
                                        <th>Account</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        </thead>
                                        <tbody>
                                            {$response_row}
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class='text-right'>TOTAL RECIEVABLE AMOUNT: </td>
                                                <td>{$total}</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class='form-group'>
                                    <div class='col-xs-12 col-sm-2'>
                                        <div class='clearfix'>
                                            <label style='font-weight: 600;font-size: 110%;'> Amount Recieving: <span id='total_td'>{$total}</span></label>
                                        </div>
                                    </div>
                                    <div class='col-xs-12 col-sm-2 col-sm-offset-8 text-right'>
                                        <div class='clearfix'>
                                            <input type='button' id='pay_button' value='Recieve' class='btn btn-sm btn-success' style='height: 30px;padding-top: 3px;'/>
                                        </div>
                                    </div>
                                </div>";
            } else {
                $response_html = "<p class='text-center'>No Payments are pending</p>";
            }
            echo $response_html;die;
        }

        if( $this->input->server('REQUEST_METHOD') == 'POST') {
            
            // echo "<pre>";print_r($_POST);die;

            $user_id = $this->input->post('member_id');
            $transection_ids = $this->input->post('transection_ids');

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
                            
            $this->db->trans_start();

            foreach($transection_ids as $t_id) {

                if($pd = $this->db->where("id",$t_id)->get("transactions")->row_array()) {  //transection_details
                    
                    if($pd['ledger_id']) {
                        $this->db->query("Update ledger set `balance` = `balance` + {$pd['amount']} WHERE id = {$pd['ledger_id']}");
                    } else {
                        $this->db->query("Update user_master set `balance` = `balance` + {$pd['amount']} WHERE user_id = {$pd['demise_user_id']}");
                    }

                    $this->db->where("id",$pd['id'])->update("transactions",["status"=>"PAID","payment_mode"=>"CHEQUE","date_paid"=>date("Y-m-d H:i:s")]);
                }
            }

            $this->db->trans_complete();

            if($this->db->trans_status() === TRUE) {
                $this->session->set_flashdata("success", "Payment Processed.");
            } else {
                $this->session->set_flashdata("failure", "Payment not Processed.");
            }
            
            redirect("payments/post_payment_individually");
        }

        $this->data['page_name'] = 'Recieve Payment';                

        $this->data['members'] = $this->db->select("user_id, name")->from("user_master")->where("user_type <> 'Admin'")->get()->result_array();

        $this->data['breadcrumb'] = $this->load->view('payment/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('payment/post_payment_individually', $this->data);
        $this->load->view('layout/footer', $this->data);

    }

    public function import_payment() {
        if($this->input->server("REQUEST_METHOD") == "POST") {
            // echo "<pre>"; print_r($_POST);
            // print_r($_FILES);die;

            if(isset($_FILES['csv_file']) && $_FILES['csv_file']['error']==0) {

                $csv_data = $this->readExcel($_FILES['csv_file']['tmp_name']);
                // echo "<pre>"; print_r($csv_data);die;
                if(count($csv_data) > 1) {
                    $insertCount = 0;
                    $errors_main = [];
                    foreach($csv_data as $k=>$arr) {
                        $errors = [];
                        if($k==1) continue; //Skip header row
    
                        if(trim($arr['A']) != "" && trim($arr['B']) != "" && trim($arr['C']) != "") {
                            $user_id = trim($arr['A']);
                            $amount = trim($arr['C']);
                            $name = trim($arr['B']);
                            $pending_payment = $this->db->query(
                                "SELECT
                                    t.*,
                                    (
                                        SELECT
                                            SUM(amount)
                                        FROM transactions
                                        WHERE transactions.user_id = t.user_id
                                        AND status = 'UNPAID'
                                        AND type = 'Debit'
                                    ) AS total_amount
                                FROM transactions t
                                WHERE user_id = '{$user_id}'
                                AND status = 'UNPAID'
                                AND type = 'Debit'
                                "
                            )->result_array();

                            // echo "<pre>";
                            // echo "Unpaid Invoices Amount :.".$pending_payment[0]['total_amount']."<br/>";
                            // echo $user_id."<pre>";
                            // print_r($pending_payment);die;

                            if(!$pending_payment) {
                                $errors[] = "Line No: ".$k." with data {$name} : There is no pending amount for {$name}.";
                            } elseif($pending_payment[0]['total_amount'] != $amount) {
                                $errors[] = "Line No: ".$k." with data {$name} : Amount provided in excel sheet <b style='text-decoration: underline;'> ".$amount."</b> is not same as pending amount which is {$pending_payment[0]['total_amount']}.";
                            }
                                                        
                            if(empty($errors)) {
                                                                
                                if(!empty($pending_payment)) {
                                    foreach($pending_payment as $pay) {
                                        // transaction status update
                                        $this->db->update("transactions", ["status"=>"PAID","date_paid"=>date("Y-m-d H:i:s"),"payment_mode"=>"ECS"], ["id"=>$pay['id']]);

                                        // member account update
                                        if(isset($pay['demise_user_id'])) {
                                            $this->db->set('balance', 'balance+'.$pay['amount'], false);
                                            $this->db->where('user_id' , $pay['demise_user_id']);
                                            $this->db->update('user_master');
                                        }

                                        // ledger account update
                                        if(isset($pay['ledger_id'])) {
                                            $this->db->set('balance', 'balance+'.$pay['amount'], false);
                                            $this->db->where('id' , $pay['ledger_id']);
                                            $this->db->update('ledger');
                                        }
                                    }
                                }
                                $insertCount ++;
                            }
                            // echo "<pre>"; print_r($arr);
    
                        } else {
                            $errors[] = "Line No: ".$k." Please provide user_id, name and amount.";
                        }
                        // print_r($errors);
                        $errors_main = array_merge($errors_main,$errors);
                    }
                    //$this->pre($errors_main);
                    if($insertCount > 0 && !empty($errors_main)) {
                        $this->session->set_flashdata("success","{$insertCount} records imported successfully.");
                        $this->session->set_flashdata('failure', $errors_main);
                    } else if( $insertCount == 0 &&  !empty($errors_main)) {
                        $this->session->set_flashdata('failure', $errors_main);
                    } else {
                        $this->session->set_flashdata("success","{$insertCount} records imported successfully.");
                    }
                    
                }else{
                    $this->session->set_flashdata("failure","Empty file can't be processed.");
                    // redirect("payments", "location");
                }//rakesh
            }else{
                $this->session->set_flashdata("failure","Please try again later.");
                // redirect("payments", "location");
            }

            redirect("payments/import_payment", "location");
        }
        $this->data['page_name'] = 'Import Payment';
        $this->data['breadcrumb'] = $this->load->view('payment/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('payment/import_payment', $this->data);
        $this->load->view('layout/footer', $this->data);
    }

    public function apply_penalty() {

        $penlty_members = $this->db->query("SELECT
                                transactions.user_id,
                                user_master.name,
                                DATE(transactions.date_created),
                                DATEDIFF(CURDATE(), DATE(transactions.date_created)),
                                DAY(LAST_DAY(transactions.date_created)),
                                MONTHNAME(CURDATE()) AS month_name,
                                YEAR(CURDATE()) AS penalty_year
                            FROM transactions
                            LEFT JOIN user_master ON user_master.user_id = transactions.user_id
                            WHERE user_master.status = 'Active'
                            AND transactions.status = 'UNPAID'
                            AND DATEDIFF(CURDATE(), DATE(transactions.date_created)) > DAY(LAST_DAY(transactions.date_created))
                            GROUP BY transactions.user_id
                            ")->result_array();
            // echo "<pre>";
            // print_r($penlty_members);die;
        $this->data['penalty_members'] = $penlty_members;
        if($this->input->server("REQUEST_METHOD") == "POST") {
            

            if(!empty($penlty_members)) {
                foreach($penlty_members as $member) {
                    //entry in transaction for the penalty ledger
                    $data = [
                        'user_id'=>$member['user_id'],
                        'amount'=>10
                    ];
                }
            }
        }

        $this->data['page_name'] = 'Apply Penalty';
        $this->data['breadcrumb'] = $this->load->view('payment/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('payment/penalty', $this->data);
        $this->load->view('layout/footer', $this->data);
    }
}