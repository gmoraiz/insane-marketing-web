<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('RewardModel','reward');
    }
    
    public function insert(){
    	if($this->session->userdata('logged')){
	        $this->form_validation->set_rules('description', 'Name', 'required');
	        $this->form_validation->set_rules('required', 'Required', 'required|trim');
			if($this->form_validation->run()){
			    if($this->upload_picture()){
    			    if($this->reward->insert()){
    			        $this->acolyte->res_form("Success!", '/reward');
    			    }else{
    			        $this->acolyte->res_form("Failed, sorry ):", '/reward');
    			    }
    			}else{
    			    $this->acolyte->res_form("Image not uploaded, try again.", '/reward');
    			}
			}else{
			    $this->acolyte->res_form("Oops incorret informations, try again.", '/reward');
			}
    	}else{
    	    redirect();   
    	}
    }
    
    public function update($id){
    	if($this->session->userdata('logged')){
	        $this->form_validation->set_rules('description', 'Name', 'required');
	        $this->form_validation->set_rules('required', 'Required', 'required|trim');
			if($this->form_validation->run()){
			    if($this->upload_picture() || !empty($this->input->post('no-picture'))){
    			    if($this->reward->update($id)){
    			        $this->acolyte->res_form("Success!", '/reward/' . $id);
    			    }else{
    			        $this->acolyte->res_form("Failed, sorry ): Did you change some information?", '/reward/' . $id);
    			    }
    			}else{
    			    $this->acolyte->res_form("Image not uploaded, try again.", '/reward/' . $id);
    			}
			}else{
			    $this->acolyte->res_form("Oops incorret informations, try again.", '/reward/' . $id);
			}
    	}else{
    	    redirect();   
    	}
    }
    
    public function delete($id){
    	if($this->session->userdata('logged')){
    		if($this->reward->delete($id)){
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
			$config['upload_path']   = './assets/img/reward/';
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