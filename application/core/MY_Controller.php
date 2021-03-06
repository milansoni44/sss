<?php defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//  Confirm Form Resubmission when back button pressed
//header("Cache-Control: no cache");
//session_cache_limiter("private_no_expire");

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->config("global_path");
        $this->load->helper("url");
        $this->load->database();
        $this->data['admin_base_url'] = $this->config->item("admin_base_url");
        $this->data['admin_design_path'] = $this->config->item("admin_design_path");
        $this->data['login_page_link'] = $this->config->item("admin_base_url") . 'login/';
        $this->data['logout_link'] = $this->config->item("admin_base_url") . 'login/logout/';
        $this->all_links();
        $this->check_login();
        $this->all_constances();

    }

    public function check_login()
    {
        if (!$this->session->userdata("login_admin_id")) {
            redirect($this->data['login_page_link'], 'location');
        }
    }

    public function all_constances()
    {
        define('COMPANY_NAME',"Horus SSS");
        define('POWERED_BY',"Fluxy Tech");
        define('POWERED_BY_LINK',"http://www.fluxytech.com/");
    }


    public function all_links()
    {
        $this->data['admin_dashboard_link'] = $this->data['admin_base_url'] . 'dashboard/';
        $this->user_module_links();
        $this->payment_module_links();
        $this->action_module_links();
    }

    public function user_module_links()
    {
        // ******************************** User Module * Start ********************************
        $primary_url = $this->data['admin_base_url'] . 'user/';
        $this->data['admin_add_user_link'] = $primary_url . 'addUser';
        $this->data['admin_profile_link'] = $primary_url . 'profile';
        $this->data['admin_user_list_link'] = $primary_url . 'userList';
        $this->data['admin_user_status_change_link'] = $primary_url . 'statusChange';

        // ******************************** User Module * End ********************************
    }

    public function payment_module_links()
    {
        // ******************************** User Module * Start ********************************
        $primary_url = $this->data['admin_base_url'] . 'payments/';
        $this->data['admin_add_membership_fee_link'] = $primary_url . 'add_membership_fee';
        $this->data['admin_transaction_link'] = $primary_url . 'index';
        $this->data['admin_pay_membership_fee_link'] = $primary_url . 'pay_membership_fee';
        $this->data['admin_post_payment_individually'] = $primary_url . 'post_payment_individually';
        $this->data['admin_import_payment'] = $primary_url . 'import_payment';

        // ******************************** User Module * End ********************************
    }
    public function action_module_links()
    {
        // ******************************** User Module * Start ********************************
        $primary_url = $this->data['admin_base_url'] . 'actions/';
        $this->data['admin_actions_page'] = $primary_url . 'index';

        // ******************************** User Module * End ********************************
    }

    public function readExcel( $file ){
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
		// echo "<pre>"; print_r($spreadsheet);die;
		// read excel data and store into an array
		$xls_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		return $xls_data;
	}



    /**
     * function for print array
     */
    public function pre($arr = array(),$exit=true)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        if($exit){
            exit;
        }
    }
    /**
     * function for convert date dd-mm-yyyy to yyyy-mm-dd
     */
    public function date_convert($date)
    {
        $dd_mm_yyyy = explode('-',$date);
        $yyyy_mm_dd = $dd_mm_yyyy[2] . '-' . $dd_mm_yyyy[1] . '-' . $dd_mm_yyyy[0];
        return $yyyy_mm_dd;
    }

    public function do_upload( $file = NULL,$folder = "")
    {
        $storeFolder = dirname(dirname(__DIR__)).'/upload/'.$folder;
        $config['upload_path'] = $storeFolder;
        $config['allowed_types'] = '*';
        $config['overwrite']             = FALSE;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($file)) {
            $uploaded_file = "";
            //$error = array('error' => $this->upload->display_errors());
        } else {
            $data = $this->upload->data();
            $uploaded_file= $data['file_name'];
        }
        return $uploaded_file;
    }

}


?>