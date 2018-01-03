<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('MessageModel','message');
    }
    
    public function insert(){
    	if($this->session->userdata('logged')){
    		$this->form_validation->set_rules('title', 'Title', 'required|max_length[60]');
	        $this->form_validation->set_rules('description', 'Description', 'required');
	        $this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[WEEKLY,ANUALLY,DAILY,MONTHLY,SPECIFIC,BIRTHDAY]');
			if($this->form_validation->run()){
				switch($this->input->post('type')){
					case 'ANUALLY':
						$this->form_validation->set_rules('dayMonth', 'dayMonth', 'required|trim|max_length[5]|min_length[5]');
						$_POST['period'] = $this->input->post('dayMonth');
						break;
					case 'MONTHLY':
						$this->form_validation->set_rules('day', 'Day', 'required|greater_than_equal_to[1]|less_than_equal_to[31]');
						$_POST['period'] = $this->input->post('day');
						break;
					case 'WEEKLY':
						$this->form_validation->set_rules('week', 'Week', 'trim|required|in_list[SUNDAY,MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY]');
						$_POST['period'] = $this->input->post('week');
						break;
					case 'SPECIFIC':
						$this->form_validation->set_rules('date', 'Date', 'required|trim|callback_valid_date');
						$_POST['period'] = $this->input->post('date');
						break;
					default:
						$_POST['period'] = null;
				}
			    if($this->form_validation->run()){
    			    if($this->message->insert()){
    			        $this->acolyte->res_form("Success!", '/message');
    			    }else{
    			        $this->acolyte->res_form("Failed, sorry ):", '/message');
    			    }
    			}else{
    			    $this->acolyte->res_form("Oops incorret informations in period.", '/message');
    			}
			}else{
			    $this->acolyte->res_form("Oops incorret informations, try again.", '/message');
			}
    	}else{
    	    redirect();   
    	}
    }
    
    public function update($id){
    	if($this->session->userdata('logged')){
    		$this->form_validation->set_rules('title', 'Title', 'required|max_length[60]');
	        $this->form_validation->set_rules('description', 'Description', 'required');
	        $this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[WEEKLY,ANUALLY,DAILY,MONTHLY,SPECIFIC,BIRTHDAY]');
			if($this->form_validation->run()){
				switch($this->input->post('type')){
					case 'ANUALLY':
						$this->form_validation->set_rules('dayMonth', 'dayMonth', 'required|trim|max_length[5]|min_length[5]');
						$_POST['period'] = $this->input->post('dayMonth');
						break;
					case 'MONTHLY':
						$this->form_validation->set_rules('day', 'Day', 'required|greater_than_equal_to[1]|less_than_equal_to[31]');
						$_POST['period'] = $this->input->post('day');
						break;
					case 'WEEKLY':
						$this->form_validation->set_rules('week', 'Week', 'trim|required|in_list[SUNDAY,MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY]');
						$_POST['period'] = $this->input->post('week');
						break;
					case 'SPECIFIC':
						$this->form_validation->set_rules('date', 'Date', 'required|trim|callback_valid_date');
						$_POST['period'] = $this->input->post('date');
						break;
					default:
						$_POST['period'] = null;
				}
			    if($this->form_validation->run()){
    			    if($this->message->update($id)){
    			        $this->acolyte->res_form("Success!", '/message/'.$id);
    			    }else{
    			        $this->acolyte->res_form("Failed. Did you change some information?", '/message/'.$id);
    			    }
    			}else{
    			    $this->acolyte->res_form("Oops incorret informations in period.", '/message/'.$id);
    			}
			}else{
			    $this->acolyte->res_form("Oops incorret informations, try again.", '/message/'.$id);
			}
    	}else{
    	    redirect();   
    	}
    }
    
    public function delete($id){
    	if($this->session->userdata('logged')){
    		if($this->message->delete($id)){
    			$this->acolyte->res_ajax(200, "Deleted with success.", true);
    		}else{
    			$this->acolyte->res_ajax(202, "Wasn't possible delete it.");
    		}
    	}else{
    		$this->acolyte->res_ajax(401, "You haven't authorization.");
    	}
    }
    
	public function valid_date($date){
	    $day = (int) substr($date, 0, 2);
	    $month = (int) substr($date, 3, 2);
	    $year = (int) substr($date, 6, 4);
	    return checkdate($month, $day, $year);
	}
    
}