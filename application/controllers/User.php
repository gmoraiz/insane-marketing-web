<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    //USER ON COMPANY'S PERSPECTIVE IS A CLIENT, OBVIOUSLY.
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel', 'user');
        $_POST = json_decode(file_get_contents("php://input"), true);
    }
    
    public function select(){
    	$user = $this->acolyte->is_mobile_authorized();
    	if($user){
    		$this->acolyte->res_ajax(200, null, $user);
    	}
    	$this->acolyte->res_ajax(401, "Unauthorized");
    }
    
    public function checkin(){
    	$user = $this->acolyte->is_mobile_authorized();
    	if($user){
    		if($this->user->checkin($user->id)){
    			$this->acolyte->res_ajax(200, "Checked with success!");
    		}else{
    			$this->acolyte->res_ajax(202, "You already have a checkin open.");
    		}
    	}
    	$this->acolyte->res_ajax(401, "Unauthorized");
    }
    
    public function login(){
	    $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[50]');
		if($this->form_validation->run()){
			$token = $this->user->login();
    	    if($token){
    			$this->acolyte->res_ajax(200, null, $token);
    		}else{
    			$this->acolyte->res_ajax(202,"Email or Password invalid.");
    		}
		}else{
			    $this->acolyte->res_ajax(422, "Invalid informations.", $this->form_validation->error_array());
		}
    }
    
    public function insert($token){
    	if($token == TOKEN_SELECT_COMPANY){
	    	$this->form_validation->set_rules('name', 'Name', 'required|max_length[60]');
		    $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[13]|trim');
		    $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]');
			$this->form_validation->set_rules('address', 'Address', 'max_length[255]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[50]|is_unique[user.email]');
			$this->form_validation->set_rules('day', 'Day', 'trim|greater_than_equal_to[1]|less_than_equal_to[31]');
			$this->form_validation->set_rules('month', 'Month', 'trim|greater_than_equal_to[1]|less_than_equal_to[12]');
			if($this->form_validation->run()){
				if($this->input->post('day') && $this->input->post('month')){
					$_POST['birth'] = $this->input->post('day') . '-' . $this->input->post('month') . '-' . '2000'; 
				}
	    		if($this->user->insert()){
	    			$this->acolyte->res_ajax(200, 'Register successful');
	    		}else{
	    			$this->acolyte->res_ajax(201, 'User already exist.');
	    		}
			}else{
				$this->acolyte->res_ajax(422, 'Invalid informations.', $this->form_validation->error_array());
			}
    	}
			$this->acolyte->res_ajax(401, "Unauthorized");
    }
    
    public function insert_by_company(){
    	if($this->session->userdata('logged')){
    		$this->form_validation->set_rules('name', 'Name', 'required|max_length[60]');
	        $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[13]|trim');
	        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]');
	    	$this->form_validation->set_rules('address', 'Address', 'max_length[255]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[50]|is_unique[user.email]');
			$this->form_validation->set_rules('birth', 'Birth', 'trim|max_length[5]|min_length[5]');
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
    
    public function update(){
    	$user = $this->acolyte->is_mobile_authorized();
    	if($user){
    		$this->form_validation->set_data($_POST);
    		$this->form_validation->set_rules('name', 'Name', 'required|max_length[60]');
		    $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[13]|trim');
		    $this->form_validation->set_rules('password', 'Password', 'trim|max_length[30]');
			$this->form_validation->set_rules('address', 'Address', 'max_length[255]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[50]');
			$this->form_validation->set_rules('day', 'Day', 'trim|greater_than_equal_to[1]|less_than_equal_to[31]');
			$this->form_validation->set_rules('month', 'Month', 'trim|greater_than_equal_to[1]|less_than_equal_to[12]');
			if($this->form_validation->run()){
			    if($this->acolyte->is_unique_update($user->id, 'user', 'email', $this->input->post('email'))){
			    	if($this->input->post('day') && $this->input->post('month')){
						$_POST['birth'] = $this->input->post('day') . '-' . $this->input->post('month') . '-' . '2000'; 
					}
        	        if($this->user->update($user->id)){
        			    $this->acolyte->res_ajax(202, "Informations updated!");
        			}else{
        			    $this->acolyte->res_ajax(202, "Did you change any information?");
        			}
    			}else{
    			    $this->acolyte->res_ajax(422, "Email already exist!");
    			}
			}else{
			    $this->acolyte->res_ajax(422, "Invalid informations", $this->form_validation->error_array());
			}
    	}
    	$this->acolyte->res_ajax(401, "Unauthorized");
    }
    
    public function update_by_company($id){
    	if($this->session->userdata('logged')){
    		$this->form_validation->set_rules('name', 'Name', 'required|max_length[60]');
	        $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[13]|trim');
	    	$this->form_validation->set_rules('address', 'Address', 'max_length[255]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[50]');
			$this->form_validation->set_rules('birth', 'Birth', 'trim|max_length[5]|min_length[5]');
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