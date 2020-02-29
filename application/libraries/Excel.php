<?php defined('BASEPATH') OR exit('No direct script access allowed.');
/**
 * CodeIgniter compatible email-library powered by PHPMailer.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2012-2017.
 * @license The MIT License (MIT), http://opensource.org/licenses/MIT
 * @link https://github.com/ivantcholakov/codeigniter-phpmailer
 *
 * This class is intended to be compatible with CI 3.1.x.
 */
require_once APPPATH."/third_party/PHPExcel.php";

class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}