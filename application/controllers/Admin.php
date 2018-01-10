<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('AdminModel','admin');
	}
	
	public function login(){
    	if(!$this->session->userdata('logged')){
    		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[60]');
	    	$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]');
	    	if($this->form_validation->run()){
	    		$user = $this->admin->login();
	    		if($user){
	    			$this->session->set_userdata('logged', true);
	    			$this->session->set_userdata('company', $user);
	    			redirect();
	    		}else{
	    			$this->acolyte->res_form("Invalid Access!");
	    		}
			}else{
			    $this->acolyte->res_form("Oops incorret informations, try again.");
			}
	    	
    	}else{
    		$this->acolyte->res_form("Already logged!");
    	}
    }
    
    public function logout(){
    	$this->session->unset_userdata('company');
    	$this->session->unset_userdata('logged');
    	redirect();
    }
    
    public function register(){
    	if(!$this->session->userdata('registerStep')){
	        $this->form_validation->set_rules('name', 'Name', 'required|max_length[60]|is_unique[company.name]');
	        $this->form_validation->set_rules('owner', 'Owner', 'required|max_length[60]');
	    	$this->form_validation->set_rules('address', 'Address', 'required|max_length[255]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[50]|is_unique[company.email]');
			if($this->form_validation->run()){
			    if($this->upload_picture()){
			    	$this->session->set_userdata('registerStep', 2);
			    	$this->session->set_userdata('namePending', $this->input->post('name'));
			    	$this->session->set_userdata('ownerPending', $this->input->post('owner'));
			    	$this->session->set_userdata('addressPending', $this->input->post('address'));
			    	$this->session->set_userdata('emailPending', $this->input->post('email'));
			    	$this->session->set_userdata('picturePending', $this->input->post('picture'));
			        $this->acolyte->res_ajax(200, "Success");
			    }else{
			        $this->acolyte->res_ajax(400, "Image not uploaded, try again.");
			    }
			}else{
			    $this->acolyte->res_ajax(422, "Oops incorret informations, try again.", $this->form_validation->error_array());
			}
    	}else{
    		if($this->admin->insert()){
    			$this->admin->send_email();
    			$this->session->set_userdata('registerStep', 3);
    			$this->acolyte->res_ajax(200, "Success");
    		}else{
    			$this->session->unset_userdata('registerStep');
    			$this->acolyte->res_ajax(400, "Sorry. An error ocurred while completing the registration. Start Again!");
    		}
    	}
    }
    
    public function register_login(){
    	if($this->session->userdata('registerStep') == 4){
    		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[30]|is_unique[admin.username]');
	    	$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]');
	    	if($this->form_validation->run()){
	    		$_POST['name'] = $this->session->userdata('company')->owner;
	    		if($this->admin->insert_login(true)){
	    			$this->session->set_userdata('registerStep', 5);
	    			$this->session->set_userdata('logged', true);
	    			$user = $this->session->userdata('company');
	    			$user->username = $this->input->post('username');
	    			$user->master   = true;
	    			$user->admin    = $this->input->post('name');
	    			$this->session->set_userdata('company', $user);
	    			$this->acolyte->res_ajax(200, "Success");
	    		}else{
	    			$this->acolyte->res_ajax(400, "Sorry. It won't possible complete this step!");
	    		}
			}else{
			    $this->acolyte->res_ajax(422, "Oops incorret informations, try again.", $this->form_validation->error_array());
			}
	    	
    	}else{
    		$this->acolyte->res_ajax(400, "Sorry. The action isn't possible in this step!");
    	}
    }
    
    public function register_complete(){
    	if($this->session->userdata('registerStep') == 5){
    		$this->form_validation->set_rules('layout', 'Layout', 'trim|required|in_list[ONE,TWO,THREE]');
	    	$this->form_validation->set_rules('type_fidelity', 'Type fidelity', 'trim|required|in_list[POINTS,POUNDS]');
	    	if($this->form_validation->run()){
	    		if($this->admin->insert_complete()){
	    			$this->session->unset_userdata('registerStep');
	    			$user = $this->session->userdata('company');
	    			$user->rule          = $this->input->post('rule');
	    			$user->layout        = $this->input->post('layout');
	    			$user->type_fidelity = $this->input->post('type_fidelity');
	    			$this->session->set_userdata('company', $user);
	    			$this->acolyte->res_ajax(200, "Success");
	    		}else{
	    			$this->acolyte->res_ajax(400, "Sorry. It won't possible complete this step!");
	    		}
			}else{
			    $this->acolyte->res_ajax(422, "Oops incorret informations, try again.", $this->form_validation->error_array());
			}
	    	
    	}else{
    		$this->acolyte->res_ajax(400, "Sorry. The action isn't possible in this step!");
    	}
    }
    
    
    public function confirm_step_three($hash){

    	$user = $this->admin->confirm_step_three($hash);
    	if($user){
    		$this->session->set_userdata('registerStep', 4);
    		$this->session->set_userdata('company', $user);
    		redirect('../register');
    	}else{
    		redirect();
    	}
    }
    
    public function score(){
    	if($this->session->userdata('logged')){
	        $this->form_validation->set_rules('user', 'User', 'required|trim|integer');
	        if($this->session->userdata('company')->type_fidelity == 'POUNDS'){
	        	$_POST['amount'] = filter_var($this->input->post('amount'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	        	$this->form_validation->set_rules('amount', 'Amount', 'required|trim|decimal');
	        }else{
	        	$this->form_validation->set_rules('amount', 'Amount', 'required|trim|greater_than[0]|less_than_equal_to[1]');
	        }
			if($this->form_validation->run()){
    			if($this->admin->score()){
    				$this->acolyte->res_form("Success!", '/');
    			}else{
    				$this->acolyte->res_form("Failed, sorry ):", '/');
    			}
			}else{
			    $this->acolyte->res_form("Oops incorret informations, try again.", '/');
			}
    	}else{
    	    redirect();   
    	}
    }
    
/* ADMIN INSERT, DELETE, UPDATE */
    
     public function insert_login(){
    	if($this->session->userdata('logged')){
	        $this->form_validation->set_rules('nick', 'Nick', 'required|max_length[60]');
	        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[30]|is_unique[admin.username]');
	    	$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]');
			if($this->form_validation->run()){
    			if($this->admin->insert_login()){
    				$this->acolyte->res_form("Success!", '/administrator');
    			}else{
    				$this->acolyte->res_form("Failed, sorry ):", '/administrator');
    			}
			}else{
			    $this->acolyte->res_form("Oops incorret informations, try again.", '/administrator');
			}
    	}else{
    	    redirect();   
    	}
    }
    
    public function update(){
    	if($this->session->userdata('logged') && $this->session->userdata('company')->master){
    		$id = $this->session->userdata('company')->id;
    		$this->form_validation->set_rules('name', 'Name', 'required|max_length[60]');
	        $this->form_validation->set_rules('owner', 'Owner', 'required|max_length[60]');
	    	$this->form_validation->set_rules('address', 'Address', 'required|max_length[255]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[50]');
			$this->form_validation->set_rules('layout', 'Layout', 'trim|required|in_list[ONE,TWO,THREE]');
	    	$this->form_validation->set_rules('type_fidelity', 'Type fidelity', 'trim|required|in_list[POINTS,POUNDS]');
	    	$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[30]');
	    	if($this->form_validation->run()){
				if($this->acolyte->is_unique_update($this->session->userdata('company')->admin_id, 'admin', 'username', $this->input->post('username'))){
					if($this->acolyte->is_unique_update($id, 'company', 'email', $this->input->post('email'))){
						if($this->acolyte->is_unique_update($id, 'company', 'name', $this->input->post('name'))){
							if($this->upload_picture()){
				    			if($this->admin->update()){
				    				$user = $this->admin->select_master();
		    						$this->session->set_userdata('company', $user);
				    				$this->acolyte->res_form("Success!", '/setting');
				    			}else{
				    				$this->acolyte->res_form("Failed, sorry ): Did you change some information?", '/setting');
				    			}
							}else{
								$this->acolyte->res_form("Image not uploaded, try again..", '/setting');
							}
						}else{
							$this->acolyte->res_form("Company name already exist.", '/setting');
						}
					}else{
						$this->acolyte->res_form("Email already exist.", '/setting');
					}
				}else{
					$this->acolyte->res_form("Username already exist.", '/setting');
				}
			}else{
			    $this->acolyte->res_form("Oops incorret informations, try again.", '/setting');
			}
    	}else{
    	    redirect();   
    	}
    }
    
    public function update_login($id){
    	if($this->session->userdata('logged')){
	        $this->form_validation->set_rules('nick', 'Nick', 'required|max_length[60]');
	        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[30]');
			if($this->form_validation->run()){
				if($this->acolyte->is_unique_update($id, 'admin', 'username', $this->input->post('username'))){
	    			if($this->admin->update_login($id)){
	    				$this->acolyte->res_form("Success!", '/administrator/' . $id);
	    			}else{
	    				$this->acolyte->res_form("Failed, sorry ): Did you change some information?", '/administrator/' . $id);
	    			}
				}else{
					$this->acolyte->res_form("Username already exist.", '/administrator/' . $id);
				}
			}else{
			    $this->acolyte->res_form("Oops incorret informations, try again.", '/administrator/' . $id);
			}
    	}else{
    	    redirect();   
    	}
    }
    
    public function delete_login($id){
    	if($this->session->userdata('logged')){
    		if($this->admin->delete($id)){
    			$this->acolyte->res_ajax(200, "Deleted with success.", true);
    		}else{
    			$this->acolyte->res_ajax(202, "Wasn't possible delete it.");
    		}
    	}else{
    		$this->acolyte->res_ajax(401, "You haven't authorization.");
    	}
    }
    
	
	private function upload_picture(){
		if(!empty($_FILES['picture']['name'])){
			$picture = uniqid("IMG_",false). "." . pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
			$config = array();
			$config['upload_path']   = './assets/img/company/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name']     = $picture;
			$config['max_size']      = '0';
			$config['overwrite']     = FALSE;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('picture')){
				$_POST['picture'] = $picture;
				return true;
			}else
				return false;
		}else
			return true;
	}
    
}