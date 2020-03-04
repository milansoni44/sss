<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Add you custom models here that you are loading in your controllers
 * @property user_model $user_model
 */
class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //	$this->check_login();
        $this->load->helper(array("form", "url"));
        $this->load->database();
        $this->load->model("user_model");

        $this->data['module_name'] = "Member";
    }

    public function index() {
        // $this->subjectList();
        $this->data['page_name'] = 'List Member';
        $this->data['user_info'] = $this->user_model->get_user();
        $this->data['breadcrumb'] = $this->load->view('user/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('user/user_list', $this->data);
        $this->load->view('layout/footer', $this->data);
    }

    public function addUser($user_id = NULL) {
        if ($user_id) {
            $this->data['task_type'] = "edit";
            $this->data['page_name'] = 'Edit Member';
            
            $param = array(
                'user_id' => $user_id
            );
            $user_info = $this->user_model->get_user($param);
            $this->data['user_info'] = $user_info;


        } else {
            $this->data['task_type'] = "add";
            $this->data['page_name'] = 'Add Member';
            
            $this->data['user_info'] = array(
                'name' => '',
                'address' => '',
                'user_name' => '',
                'password' => '',
                'area' => '',
                'city' => '',
                'state' => '',
                'pincode' => '',
                'country' => '',
                'email' => '',
                'phone' => '',
                'mobile' => '',
                'status' => '',
                'user_type' => '',
                'address' => '',
                'nominee1' => '',
                'nominee2' => '',
                'nominee1_reimbursement' => '',
                'nominee2_reimbursement' => '',
                'inactivity_date' => '',
                'membership_fee'=>0
            );



         }

        if ($this->input->server("REQUEST_METHOD") === "POST") {
            $this->load->library("form_validation");
            $config = array(
                array(
                    'field' => "name",
                    'label' => "Name",
                    'rules' => "trim|required"
                ),
                array(
                    'field' => "mobile",
                    'label' => "Mobile",
                    'rules' => "trim|required"
                ),
            );

            $this->form_validation->set_rules($config);
           // $this->data['user_info'] = $this->input->post();

           //$this->pre($this->data['user_info'])


            if ($this->form_validation->run() !== FALSE) {
                $data = $this->input->post();

                // echo "<pre>"; print_r($data);die;

                $new_user_id = $this->user_model->addUpdateUser($data, $user_id);
                if ($new_user_id) {
                    if ($user_id) {
                        $this->session->set_flashdata("success", "Member has been updated successfully.");
                    } else {
                        $this->session->set_flashdata("success", "Member has been added successfully.");
                    }
                } else {
                    $this->session->set_flashdata("failure", "Sorry, Something went wrong. Try later.");
                }
                redirect($this->data['admin_user_list_link'], 'location');
            }
        }
        $this->data['user_id'] = $user_id;

        $this->data['breadcrumb'] = $this->load->view('user/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('user/add_user', $this->data);
        $this->load->view('layout/footer', $this->data);
    }

    public function change_nominee($user_id = NULL) {
        if($user_id) {
            $this->data['page_name'] = 'Nominee Update';
            $this->data['user_id'] = $user_id;
            $user_info = $this->user_model->get_user(["user_id"=>$user_id]);

            $this->data['user_info'] = $user_info;
            
            $this->data['breadcrumb'] = $this->load->view('user/breadcrumb', $this->data, TRUE);
            $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

            $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
            $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

            $this->load->view('layout/header', $this->data);
            $this->load->view('user/nominee', $this->data);
            $this->load->view('layout/footer', $this->data);


        } else {
            show_404();
        }
    }

    public function profile() {
        $this->data['page_name'] = 'Profile Update';
        $this->data['task_type'] = "edit";
        $user_id = $this->session->userdata("login_admin_id");
        $param = array(
            'user_id' => $user_id
        );
        $user_info = $this->user_model->get_user($param);
        $this->data['user_info'] = $user_info;

        if ($this->input->server("REQUEST_METHOD") === "POST") {
            $this->load->library("form_validation");
            $config = array(
                array(
                    'field' => "name",
                    'label' => "Name",
                    'rules' => "trim|required"
                ),
                array(
                    'field' => "user_name",
                    'label' => "User name",
                    'rules' => "trim|required|callback_check_unique_user_name"
                ),
            );

            $this->form_validation->set_rules($config);
           // $this->data['user_info'] = $this->input->post();

           //$this->pre($this->data['user_info'])


            if ($this->form_validation->run() !== FALSE) {
                $data = $this->input->post();

                if($this->input->post("password") && $this->input->post("password") != ""){

                    $data['password'] = md5($this->input->post("password"));
                }else{
                    unset($data['password']);
                }

                $new_user_id = $this->user_model->addUpdateUser($data, $user_id);
                if ($new_user_id) {
                    if ($user_id) {
                        $this->session->set_flashdata("success", "Profile has been updated successfully.");
                    } else {
                        $this->session->set_flashdata("success", "Profile has been added successfully.");
                    }
                } else {
                    $this->session->set_flashdata("failure", "Sorry, Something went wrong. Try later.");
                }
                redirect($this->data['admin_profile_link'], 'location');
            }
        }
        $this->data['user_id'] = $user_id;

        $this->data['breadcrumb'] = $this->load->view('user/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('user/profile', $this->data);
        $this->load->view('layout/footer', $this->data);
    }

    public function userList() {
	$this->data['page_name'] = 'List Member';
        $this->data['user_info'] = $this->user_model->get_user();
        $this->data['breadcrumb'] = $this->load->view('user/breadcrumb', $this->data, TRUE);
        $this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);

        $this->data['footer_panel'] = $this->load->view('layout/footer_panel', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('layout/sidebar', $this->data, TRUE);

        $this->load->view('layout/header', $this->data);
        $this->load->view('user/user_list', $this->data);
        $this->load->view('layout/footer', $this->data);
    }


    public function delete_user($user_id) {


        $query_user_delete = "DELETE FROM user_master WHERE user_id = '$user_id'";
        $user_res= $this->db->query($query_user_delete);

        if($user_res){
            $this->session->set_flashdata("success", "Member has been Deleted successfully.");
        }else{
            $this->session->set_flashdata("failure", "Sorry, Something went wrong. Try later.");
        }

        redirect(base_url().'user', 'location');
    }

    public function check_unique_user_name($user_name) {
        $user_id = $this->session->userdata("login_admin_id");
        if ($this->user_model->check_user_name($user_id, $user_name)) {
            $this->form_validation->set_message("check_unique_user_name", "The %s is already exist.");
            return FALSE;
        }
        return TRUE;
    }

}
