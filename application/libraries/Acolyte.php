<?php

// MY OWN LIBRARY, MADE IN @GMORAIZ

defined('BASEPATH') OR exit('No direct script access allowed');
class Acolyte {
    private $CI;
    
    public function __construct(){
        $this->CI =& get_instance();
    }
    
    public function res_ajax($cd,$msg,$data = null){
	    $this->CI->output->set_content_type('application/json')
		                  ->set_status_header($cd)
			              ->set_output(json_encode(array("msg" => $msg, "data" => $data), JSON_NUMERIC_CHECK))
			              ->_display();
	    exit;
	}
	
	public function res_form($msg, $route = null){
		$this->CI->session->set_flashdata('MSG', $msg);
		$route == null ? redirect(base_url(),'refresh') : redirect($route,'refresh');
	}

}