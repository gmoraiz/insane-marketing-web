<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdminModel extends CI_Model{
    
    public function insert(){
        $data = array(
            'name'    => $this->session->userdata('namePending'),
            'owner'   => $this->session->userdata('ownerPending'),
            'address' => $this->session->userdata('addressPending'),
            'email'   => $this->session->userdata('emailPending'),
            'picture' => $this->session->userdata('picturePending')
        );
        $this->db->insert('company', $data);
        if($this->db->affected_rows() == -1){
             return false;
        }
        return true;
    }
    
    public function select($id = null, $pagination = 0){
        $this->db->where('master', false);
        if($id){
            return $this->db->get_where('admin', array('id' => $id, 'company_id' => $this->session->userdata('company')->id))->row();
        }
        $this->db->limit(PAGINATION_COUNT, $pagination);
        $this->db->order_by('nick', 'ASC');
        return $this->db->get_where('admin', array('company_id' => $this->session->userdata('company')->id))->result();
    }
    
    public function score(){
        $data = array(
            'amount'     => $this->input->post('amount'),
            'company_id' => $this->session->userdata('company')->id,
            'user_id'    => $this->input->post('user')
        );
        $this->db->insert('fidelity', $data);
        if($this->db->affected_rows() == -1){
             return false;
        }
        return true;
    }
    
    public function fidelities($pagination = 0){
        $this->db->select("user.name, user.phone, concat('£', format(fidelity.amount, 2)) AS amount");
        $this->db->join('user', 'fidelity.user_id = user.id');
        $this->db->limit(PAGINATION_COUNT, $pagination);
        $this->db->order_by('fidelity.id', 'DESC');
        return $this->db->get_where('fidelity', array('company_id' => $this->session->userdata('company')->id))->result();
    }

    public function login(){
        $this->db->select('c.*, a.username, a.master, a.nick, a.id AS admin_id');
        $this->db->from('company AS c');
        $this->db->join('admin AS a','a.company_id = c.id');
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', hash('sha256',$this->input->post('password')));
        $user = $this->db->get()->row();
        if(!$user){
            return false;
        }
        return $user;
    }
    
    public function select_master(){
        $this->db->select('c.*, a.username, a.master, a.nick, a.id AS admin_id');
        $this->db->from('company AS c');
        $this->db->join('admin AS a','a.company_id = c.id');
        $this->db->where('a.id', $this->session->userdata('company')->admin_id);
        return $this->db->get()->row();
    }
    
    public function insert_login($is_master = false){
        $data = array(
            'username'   => $this->input->post('username'),
            'password'   => hash('sha256', $this->input->post('password')),
            'master'     => $is_master,
            'nick'       => $this->input->post('nick'),
            'company_id' => $this->session->userdata('company')->id
        );
        $this->db->insert('admin', $data);
        if($this->db->affected_rows() == -1){
             return false;
        }
        return true;
    }
    
    public function update_login($id, $is_master = false){
        $data = array(
            'username'   => $this->input->post('username'),
            'master'     => $is_master,
            'nick'       => $this->input->post('nick')
        );
        
        if($this->input->post('password')){
            $data['password'] = hash('sha256', $this->input->post('password'));
        }
        
        $this->db->update('admin', $data, array('id' => $id, 'company_id' => $this->session->userdata('company')->id));
        if($this->db->affected_rows())
            return true;
        else
            return false;
    }
    
    public function update(){
        $data = array(
            'name' => $this->input->post('name'),
            'owner'=> $this->input->post('owner'),
            'address'=> $this->input->post('address'),
            'email'=> $this->input->post('email'),
            'type_fidelity'=> $this->input->post('type_fidelity'),
            'layout'=> $this->input->post('layout')
        );
        if(!empty($this->input->post('picture'))){
            $this->db->set('picture', $this->input->post('picture'));
        }
        $this->db->update('company', $data, array('id' => $this->session->userdata('company')->id));
        
        $affectedCompany = $this->db->affected_rows();
        
        $data = array(
            'username' => $this->input->post('username'),
            'nick' => $this->input->post('owner')
        );
        if(!empty($this->input->post('password'))){
            $this->db->set('password', hash('sha256', $this->input->post('password')));
        }
        $this->db->update('admin', $data, array('id' => $this->session->userdata('company')->admin_id));
        
        $affectedAdmin = $this->db->affected_rows();
        
        if(!$affectedCompany && !$affectedAdmin){
            return false;
        }
        return true;
    }
    
    public function insert_complete(){
        $data = array(
            'type_fidelity' => $this->input->post('type_fidelity'),
            'rule'          => $this->input->post('rule'),
            'layout'        => $this->input->post('layout')
        );
        $this->db->where('id', $this->session->userdata('company')->id);
        $this->db->update('company', $data);
        if($this->db->affected_rows() == -1){
             return false;
        }
        $this->destroy_hash();
        return true;
    }
    
    public function send_email(){
        $mail = new PHPMailer(true);
        try{
            //$mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'swapei.noreply@gmail.com';
            $mail->Password = 'swapei-tcc-2017';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('swapei.noreply@gmail.com', 'Insane Marketing');
            $mail->addAddress($this->session->userdata('emailPending'), $this->session->userdata('ownerPending'));
            $mail->isHTML(true);
            $mail->Subject = $this->session->userdata('ownerPending') . ', finish step 3.';
            $mail->Body    = 'Confirm your account and generate a login in <a href="'.$this->generate_hash().'"><b>this link</b></a>';
            $mail->send();
            return true;
        }catch (Exception $e){
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        }
    }
    
    public function confirm_step_three($hash){
        $user = $this->db->get_where('pending_register', array('hash' => $hash));
        if($this->db->affected_rows()){
            $this->db->select('*');
            return $this->db->get_where('company', array('email' => $user->row()->email))->row();
        }
        return false;
    }
    
    private function generate_hash(){
        $hash = bin2hex(uniqid() . mt_rand() . $this->session->userdata('emailPending'));
        $data = array(
            'hash'  => $hash,
            'email' => $this->session->userdata('emailPending')
        );
        $this->db->insert('pending_register', $data);
        return 'www.insane-marketing-web-gmoraiz.c9users.io/register/'. $hash;
    }
    
    private function destroy_hash(){
        $this->db->where('email', $this->session->userdata('company')->email);
        $this->db->delete('pending_register');
    }
    
}