<?php
ini_set('max_execution_time', 0); // 0 = Unlimited
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
    public $debug = false;
    public function __construct() {
        parent::__construct();
        $this->data['module_name'] = "Payments";
        $this->debug = true;
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
        // echo "<pre>";
        // print_r($active_members);
        // die;

        if(!empty($active_members)) {
            foreach($active_members as $transaction) {
                // if($transaction['user_id'] != 3) continue;
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
                        // print_r($demise);
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
                // print_r($administrative);
                $this->db->insert("transactions", $administrative);
                if($transaction['user_type'] == "Advance deposite") {
                    $this->db->set('balance', 'balance-'.$transaction['institute_rate'], false);
                    $this->db->where('user_id' , $transaction['user_id']);
                    $this->db->update('user_master');
                }
            }
        }
        echo "Success";
        //TDDO loggin in future
    }

    public function send_invoice_email() {

        $member = $this->db->where("user_id",3)->get("user_master")->row_array();

        $pending_payments = $this->db
                                    ->query("SELECT
                                        (
                                            CASE 
                                                WHEN transactions.ledger_id IS NOT NULL THEN ledger.name
                                                WHEN transactions.demise_user_id IS NOT NULL THEN ud.name
                                                ELSE NULL
                                            END
                                        ) AS ledger_name,
                                        user_master.name as user_name,
                                        transactions.id,
                                        transactions.demise_user_id,
                                        transactions.ledger_id,
                                        transactions.amount,
                                        transactions.date_created
                                    FROM transactions
                                    LEFT JOIN ledger ON ledger.id = transactions.ledger_id
                                    LEFT JOIN user_master ud ON ud.user_id = transactions.demise_user_id
                                    LEFT JOIN user_master ON user_master.user_id = transactions.user_id
                                    WHERE transactions.user_id = '{$member['user_id']}'
                                    AND transactions.status = 'UNPAID'")->result_array();
        // echo $this->db->last_query();die;
        // echo "<pre>"; print_r($pending_payments);die;
        $this->data['member'] = $member;
        $this->data['details'] = $pending_payments;
        // echo "<pre>"; print_r($this->data['details']);die;
        $this->data['payable_amount'] = ($pending_payments) ? array_sum(array_column($pending_payments,'amount')) : 0;

        // $this->load->view('payment_pdf_template/invoice_header_only', $this->data);
        // $this->load->view('payment_pdf_template/invoice', $this->data);
        // $this->load->view('layout/footer', $this->data);

        
        $html ="";
        $html .= $this->load->view('payment_pdf_template/invoice_header_only', $this->data, true);
        $html .= $this->load->view('payment_pdf_template/invoice', $this->data, true);
        $html .= $this->load->view('layout/footer', $this->data, true);

        // 1. Display PDF in browser
        // $this->generate_pdf($html,"my_pdf_file.pdf");

        // 2. Generate PDF and store in file system, so it can be used to send as email attachment.
        $file_name = FCPATH.'Generated PDF'. DIRECTORY_SEPARATOR . "rakesh.pdf";
        $this->generate_pdf($html,$file_name,"F");


        // 3. Send PDF as email attachment
        if(file_exists($file_name)){
            $this->load->library('mymailer');
            $attachment = array($file_name);
            $email_response = $this->mymailer->send_email("Invoice","Please Find Attached Invoice",$member['email'],null,null,$attachment);
            var_dump($email_response);
            unlink($file_name);
        }
    }

    protected function generate_pdf($html,$file_name=NULL,$mode='I'){

        if($mode == 'F') {
            $pathInfo = pathinfo($file_name);
            if(isset($pathInfo['extension']) && $pathInfo['dirname']!='.'){

                $dir_structure =dirname($file_name);
                if (!file_exists($dir_structure)) {
                    mkdir($dir_structure, 0777, true);
                }
            }
        }

        $modeArr = array(
            'I'=>\Mpdf\Output\Destination::INLINE,
            'D'=>\Mpdf\Output\Destination::DOWNLOAD,
            'F'=>\Mpdf\Output\Destination::FILE,
            'S'=>\Mpdf\Output\Destination::STRING_RETURN,
        );

        $mpdf = new \Mpdf\Mpdf(
            array(
                // 'mode' => 'utf-8',
                // 'format' => array(210, 297),
                // 'orientation' => 'P',
                // 'setAutoTopMargin' => 'stretch',
                // 'autoMarginPadding' => 0,
                // 'bleedMargin' => 0,
                // 'crossMarkMargin' => 0,
                // 'cropMarkMargin' => 0,
                // 'nonPrintMargin' => 0,
                // 'margBuffer' => 0,
                // 'collapseBlockMargins' => false,
            )
        );
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name,$modeArr[$mode]);
    }

    public function interest_paid() {
        // 3 monthly
        // pay interest 4% in user account

        $interests = $this->db->query("SELECT
                            user_master.*
                        FROM user_master
                        WHERE user_type = 'Advance deposite'
                        AND status = 'Active'
                        ")->result_array();
        // echo "<pre>";
        // echo "Total Advance Deposite Members : ".count($interests)."<br/>";
        // print_r($interests);

        if(!empty($interests)) {
            foreach($interests as $interest) {
                $int_paid_amount = (float)(($interest['balance']*4)/100);
                // echo "User_id : {$interest['user_id']} Balance : ".$interest['balance']." Interest Amount : {$int_paid_amount}<br/>";
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

}