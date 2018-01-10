<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    //USER ON COMPANY'S PERSPECTIVE IS A CLIENT, OBVIOUSLY.
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel', 'user');
    }
    
    public function insert(){
    	if($this->session->userdata('logged')){
    		$this->form_validation->set_rules('name', 'Name', 'required|max_length[60]');
	        $this->form_validation->set_rules('phone', 'Phone', 'required|max_length[13]|trim');
	        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]');
	    	$this->form_validation->set_rules('address', 'Address', 'required|max_length[255]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[50]|is_unique[user.email]');
			$this->form_validation->set_rules('birth', 'Birth', 'required|trim|callback_valid_date');
			if($this->form_validation->run()){
    	        if($this->user->insert()){
    			    $this->acolyte->res_form("Success!", '/client');
    			}else{
    			    $this->acolyte->res_form("Failed, sorry ):", '/client');
    			}
			}else{
			    $this->acolyte->res_form("Oops incorret informations, try again.", '/client');
			}
    	}else{
    	    redirect();   
    	}
    }
    
    public function update($id){
    	if($this->session->userdata('logged')){
    		$this->form_validation->set_rules('name', 'Name', 'required|max_length[60]');
	        $this->form_validation->set_rules('phone', 'Phone', 'required|max_length[13]|trim');
	    	$this->form_validation->set_rules('address', 'Address', 'required|max_length[255]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[50]');
			$this->form_validation->set_rules('birth', 'Birth', 'required|trim|callback_valid_date');
			if($this->form_validation->run()){
			    if($this->acolyte->is_unique_update($id, 'user', 'email', $this->input->post('email'))){
        	        if($this->user->update($id)){
        			    $this->acolyte->res_form("Success!", '/client/' . $id);
        			}else{
        			    $this->acolyte->res_form("Failed, sorry ):", '/client/' . $id);
        			}
    			}else{
    			    $this->acolyte->res_form("Email already exist.", '/client/' . $id);
    			}
			}else{
			    $this->acolyte->res_form("Oops incorret informations, try again.", '/client/' . $id);
			}
    	}else{
    	    redirect();   
    	}
    }
    
    public function delete($id){
    	if($this->session->userdata('logged')){
    		if($this->user->delete($id)){
    			$this->acolyte->res_ajax(200, "Deleted with success.", true);
    		}else{
    			$this->acolyte->res_ajax(202, "Wasn't possible delete it.");
    		}
    	}else{
    		$this->acolyte->res_ajax(401, "You haven't authorization.");
    	}
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
    
    public function valid_date($date){
	    $day = (int) substr($date, 0, 2);
	    $month = (int) substr($date, 3, 2);
	    $year = (int) substr($date, 6, 4);
	    return checkdate($month, $day, $year);
	}
    
}