<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller{

	public function index(){
		if($this->session->userdata('logged')){
			$data['body'] = "index";
		}
		else if($this->session->userdata('isNotFirstAccess')){
			$data['body'] = "login";
		}
		else{
			$data['body'] = "first-access";
		}
		$this->load->view('templates/html', $data);
	}
	
	public function get_login(){
		$this->session->set_userdata('isNotFirstAccess', true);
		redirect();
	}
	
	public function get_register(){
		if($this->session->userdata('logged')){
			redirect();
		}else{
			$step = $this->session->userdata('registerStep');
			switch($step){
				case 2:
					$data['body'] = 'register/step-two';
					break;
				case 3:
					$data['body'] = 'register/step-three';
					$data['email'] = $this->session->userdata('emailPending');
					break;
				case 4:
					break;
				default:
					$data['body'] = 'register/step-one';
			}
			$this->load->view('templates/html', $data);
		}
	}
	
}
