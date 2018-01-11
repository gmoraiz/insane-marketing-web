<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller{
	private $pagination;
	
	public function __construct(){
		parent::__construct();
		$this->pagination = isset($_GET['pagination']) ? $_GET['pagination'] : 0; //When 0 load complete page, else load only list to append.
	}
	
	public function index(){
		if($this->session->userdata('logged')){
			if(!$this->session->userdata('company')->layout){
				$this->session->set_userdata('registerStep', 5);
				redirect('/register');
			}
			$this->load->model('AdminModel','admin');
			$data['fidelities'] = $this->admin->fidelities($this->pagination);
			if($this->pagination){
				$this->load->view('lists/index', $data);
			}else{
				$data['body'] = "index";
				$this->load->view('templates/html', $data);
			}
		}else if($this->session->userdata('isNotFirstAccess')){
			$data['body'] = "login";
			$this->load->view('templates/html', $data);
		}else{
			$data['body'] = "first-access";
			$this->load->view('templates/html', $data);
		}
	}
	
	public function chance(){
		$data['body'] = "chance";
		$this->load->view('templates/html', $data);
	}
	
	public function client(){
		if($this->session->userdata('logged')){
			$this->load->model('UserModel','user');
			$data['clients'] = $this->user->select(null, $this->pagination);
			if($this->pagination){
				$this->load->view('lists/client', $data);
			}else{
				$data['body'] = "client";
				$this->load->view('templates/html', $data);
			}
		}else{
			redirect();
		}
	}
	
	public function client_edit($id){
		if($this->session->userdata('logged')){
			$this->load->model('UserModel','user');
			$data['client'] = $this->user->select($id);
			$data['body'] = "edit/client";
			$this->load->view('templates/html', $data);
		}else{
			redirect();
		}
	}
	
	public function message(){
			if($this->session->userdata('logged')){
			$this->load->model('MessageModel','message');
			$data['messages'] = $this->message->select(null, $this->pagination);
			if($this->pagination){
				$this->load->view('lists/message', $data);
			}else{
				$data['body'] = "message";
				$this->load->view('templates/html', $data);
			}
		}else{
			redirect();
		}
	}
	
	public function message_edit($id){
		if($this->session->userdata('logged')){
			$this->load->model('MessageModel','message');
			$data['message'] = $this->message->select($id);
			$data['body'] = "edit/message";
			$this->load->view('templates/html', $data);
		}else{
			redirect();
		}
	}
	
	public function admin(){
			if($this->session->userdata('logged')){
			$this->load->model('AdminModel','admin');
			$data['administrators'] = $this->admin->select(null, $this->pagination);
			if($this->pagination){
				$this->load->view('lists/administrators', $data);
			}else{
				$data['body'] = "administrator";
				$this->load->view('templates/html', $data);
			}
		}else{
			redirect();
		}
	}
	
	public function admin_edit($id){
		if($this->session->userdata('logged')){
			$this->load->model('AdminModel','admin');
			$data['administrator'] = $this->admin->select($id);
			$data['body'] = "edit/administrator";
			$this->load->view('templates/html', $data);
		}else{
			redirect();
		}
	}
	
	public function reward(){
		if($this->session->userdata('logged')){
			$this->load->model('RewardModel','reward');
			$data['rewards'] = $this->reward->select(null, $this->pagination);
			if($this->pagination){
				$this->load->view('lists/reward', $data);
			}else{
				$data['body'] = "reward";
				$this->load->view('templates/html', $data);
			}
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
	
	public function setting(){
		if($this->session->userdata('logged') && $this->session->userdata('company')->master){
			$data['administrator'] = $this->session->userdata('company');
			$data['body'] = "setting";
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
