<?php 

class Login_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function login_authorization( $username_email, $password )
	{
		$q = $this->db->select("*")
			->from("user_master")
			->where("user_name",$username_email)
			->where("password", md5($password))
			->where("status", "Active")
			->get();
		return ( $q->num_rows() > 0 ) ? $q->row_array() : false;		
	}
}