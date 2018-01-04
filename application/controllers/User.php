<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel', 'user');
    }
	
	public function by_phone($phone){
    	if($this->session->userdata('logged')){
    	    $users = $this->user->by_phone($phone);
    	    if($users){
    	        $this->acolyte->res_ajax(200, null, $users);
    	    }else{
    	        
    	    }
    	}
    }
    
}