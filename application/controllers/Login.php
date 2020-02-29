<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper( array("form", "url") );
		$this->load->library("session");
		$this->load->config("global_path");
		$this->data['admin_design_path'] = $this->config->item("admin_design_path");
		$this->data['login_page_link'] = $this->config->item("admin_base_url").'login/';
		$this->data['admin_base_url'] = $this->config->item("admin_base_url");
		$this->data['admin_dashboard_link'] = $this->data['admin_base_url'].'dashboard/';
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		session_destroy();
		$this->session->set_flashdata("message", "Logout successfully.");
		redirect($this->data['login_page_link'], "location");
	}
	
	public function index()
	{
		if( $this->session->userdata("login_admin_id") )
		{
			redirect($this->data['admin_dashboard_link'], 'location');
		}
		
		$login_failed_errors = '';
		if( $this->input->server("REQUEST_METHOD") === "POST" )
		{
			$this->load->library("form_validation");
			$config = array(
				array(
					'field'	=> "username",
					'label'	=> "Username",
					'rules'	=> "trim|required"
				),
				array(
					'field'	=> "password",
					'label'	=> "Password",
					'rules'	=> "trim|required"
				)
			);
			
			$this->form_validation->set_rules($config);
			
			if( $this->form_validation->run() !== FALSE )
			{
				$this->load->model("login_model");
				$username_email = $this->input->post("username");
				$password = $this->input->post("password");
				
				$login_failed_errors = 'Incorrect login details.';
				
				$user_info = $this->login_model->login_authorization( $username_email, $password );
				if($user_info)
				{
					if( ($username_email == $user_info['user_name'] ) && md5($password) == $user_info['password'] )
					{
						$this->load->library("session");
						$this->session->set_userdata( array(
								'login_admin_id'		=> $user_info['user_id'],
								'login_admin_full_name'	=> $user_info['name'],
								'login_admin_username'	=> $user_info['user_name'],
							)
						);
						redirect($this->data['admin_dashboard_link'], 'location');
					}
				}
			}
			$this->data['login_failed_errors'] = $login_failed_errors;
		}
		$this->data['jquery_view'] = $this->load->view('layout/jQuery', $this->data, TRUE);
		$this->load->view('login/login', $this->data );
	}
}
