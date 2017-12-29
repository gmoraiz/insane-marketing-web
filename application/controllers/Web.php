<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller{

	public function index(){
		if($this->session->userdata('logged')){
			if(!$this->session->userdata('company')->layout){
				$this->session->set_userdata('registerStep', 5);
				redirect('/register');
			}
			$data['body'] = "index";
		}else if($this->session->userdata('isNotFirstAccess')){
			$data['body'] = "login";
		}else{
			$data['body'] = "first-access";
		}
		$this->load->view('templates/html', $data);
	}
	
	public function reward(){
		if($this->session->userdata('logged')){
			$this->load->model('RewardModel','reward');
			$data['rewards'] = $this->reward->select();
			$data['body'] = "reward";
			$this->load->view('templates/html', $data);
		}else{
			redirect();
		}
	}
	
	public function reward_edit($id){
		if($this->session->userdata('logged')){
			$this->load->model('RewardModel','reward');
			$data['reward'] = $this->reward->select($id);
			$data['body'] = "edit/reward";
			$this->load->view('templates/html', $data);
		}else{
			redirect();
		}
	}
	
	public function login(){
		$this->session->set_userdata('isNotFirstAccess', true);
		redirect();
	}
	
	public function register(){
		$step = $this->session->userdata('registerStep');
		if($this->session->userdata('logged') && $step != 5){
			redirect();
		}else{
			switch($step){
				case 2:
					$data['body'] = 'register/step-two';
					break;
				case 3:
					$data['body'] = 'register/step-three';
					$data['email'] = $this->session->userdata('emailPending');
					break;
				case 4:
					$data['body'] = 'register/step-four';
					$data['company'] = $this->session->userdata('company');
					break;
				case 5:
					$data['body'] = 'register/step-five';
					$data['company'] = $this->session->userdata('company');
					break;
				default:
					$data['body'] = 'register/step-one';
			}
			$this->load->view('templates/html', $data);
		}
	}
	
}
