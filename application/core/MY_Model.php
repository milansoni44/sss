<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    /**
     * function for print array
     */
    public function pre($arr = array())
    {
        echo "<pre>";
        print_r($arr);
        exit;
    }

    public function mdytoymd($date)
    {
        $mm_dd_yyyy = explode('-',$date);
        $yyyy_mm_dd = $mm_dd_yyyy[2] . '-' . $mm_dd_yyyy[0] . '-' . $mm_dd_yyyy[1];
        return $yyyy_mm_dd;
    }
}