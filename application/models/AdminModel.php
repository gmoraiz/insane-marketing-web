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

    public function login(){
        $this->db->select('c.*, a.username, a.master, a.name AS admin');
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
    
    public function insert_login($is_master = false){
        $data = array(
            'username'   => $this->input->post('username'),
            'password'   => hash('sha256', $this->input->post('password')),
            'master'     => $is_master,
            'name'       => $this->input->post('name'),
            'company_id' => $this->session->userdata('company')->id
        );
        $this->db->insert('admin', $data);
        if($this->db->affected_rows() == -1){
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