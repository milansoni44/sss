<?php defined('BASEPATH') OR exit('No direct script access allowed');

$CI =& get_instance();
$base_url = $CI->config->item("base_url");
$config['admin_base_url'] = $base_url.'';
$config['admin_design_path'] = $base_url;