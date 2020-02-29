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
        redirect($this->data['admin_user_list_link'], 'location');

		//$this->instanceList();
	}

}