<?php

// MY OWN LIBRARY, MADE IN @GMORAIZ

defined('BASEPATH') OR exit('No direct script access allowed');
class Acolyte {
    private $CI;
    
    public function __construct(){
        $this->CI =& get_instance();
    }
    
    public function res_ajax($cd,$msg,$data = null){
        if(empty($data))
            $data = new stdClass();
	    $this->CI->output->set_content_type('application/json')
		                  ->set_status_header($cd)
			              ->set_output(json_encode($msg != null ? array("msg" => $msg, "data" => $data) : $data, JSON_NUMERIC_CHECK))
			              ->_display();
	    exit;
	}
	
	public function res_form($msg, $route = null){
		$this->CI->session->set_flashdata('MSG', $msg);
		$route == null ? redirect(base_url(),'refresh') : redirect($route,'refresh');
	}
	
	public function is_unique_update($id, $table, $field, $value, $idField = 'id')
    {
        $this->CI->db->where($idField . '!=', $id);
        $this->CI->db->where($field, $value);
        $this->CI->db->get($table);
        if($this->CI->db->affected_rows())
            return false;
        else
            return true;
    }
    
    public function is_mobile_authorized(){
		if(!empty(apache_request_headers()["authorization"])){
			$this->CI->load->model('UserModel','user');
			return $this->CI->user->is_mobile_authorized(apache_request_headers()["authorization"]);
		}else
			return false;	
	}

    public function generate_token($user){
        $alg = 'HS256';
        $key = 'developmentkey';
        $iss = $user;
        $aud = 'insane-marketing.development';
        $typ = 'JWT';
        $tim = time();
        $header  = ['typ' => $typ, 'alg' => $alg];
        $payload = ['iss' => $iss, 'tim' => $tim, 'aud' => $aud];
        $header  = json_encode($header);
        $header  = base64_encode($header);
        $payload = json_encode($payload);
        $payload = base64_encode($payload);
        $signature = hash_hmac('sha256', "$header.$payload",$key, true);
        $signature = base64_encode($signature);
        return "$header.$payload.$signature";
    }

}