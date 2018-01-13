<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model{
    
    public function checkin($id){
        $checkForAtualCheckIn = $this->db->get_where('checkin', array('user_id' => $id))->row();
        if(!$checkForAtualCheckIn){
            $data = array(
                'user_id' => $id,
            );
            $this->db->insert('checkin', $data);
            if($this->db->affected_rows() == -1){
                 return false;
            }
            return true;
        }
        return false;
    }
    
    public function login(){
        $this->db->select("user.id, user.name, user.phone, user.address, user.email, user.birth, DATE_FORMAT(user.created,'%d/%m/%Y') AS created");
        $user = $this->db->get_where('user', array('email' => $this->input->post('email'), 'password' => hash('sha256', $this->input->post('password'))))->row();
        if($user){
            $token = $this->acolyte->generate_token($user->email);
            $this->db->set('token',$token);
            $this->db->set('fcm',$this->input->post('fcm'));
            $this->db->where('email',$user->email);
            $this->db->update('user');
            return $token;
        }else
            return false;
    }
    
    public function insert(){
        $data = array(
            'name'       => $this->input->post('name'),
            'phone'      => $this->input->post('phone'),
            'password'   => hash('sha256', $this->input->post('password')),
            'email'      => $this->input->post('email'),
            'address'    => $this->input->post('address'),
            'birth'      => $this->input->post('birth') ? date('Y-m-d', strtotime($this->input->post('birth'))) : NULL,
            'created'    => date('Y-m-d')
        );
        $this->db->insert('user', $data);
        if($this->db->affected_rows() == -1){
             return false;
        }
        return true;
    }
    
    public function update($id){
        $data = array(
            'name'       => $this->input->post('name'),
            'phone'      => $this->input->post('phone'),
            'password'   => hash('sha256',$this->input->post('password')),
            'email'      => $this->input->post('email'),
            'address'    => $this->input->post('address'),
            'birth'      => $this->input->post('birth') ? date('Y-m-d', strtotime($this->input->post('birth'))) : NULL
        );
        
        if($this->input->post('password')){
            $data['password'] = hash('sha256', $this->input->post('password'));
        }
        
        $this->db->update('user', $data, array('id' => $id));
        if($this->db->affected_rows())
            return true;
        else
            return false;
    }
    
    public function select($id = null, $pagination = 0){
        if($id){
            return $this->db->get_where('user', array('id' => $id, 'deleted' => FALSE))->row();
        }
        $this->db->limit(PAGINATION_COUNT, $pagination);
        $this->db->order_by('name', 'ASC');
        $users = $this->db->get_where('user', array('deleted' => FALSE))->result();
        foreach($users as $user)
            $user->points = $this->points($user->id);
        return $users;
    }
    
    public function by_phone($phone){
        $this->db->like('phone', $phone, 'after');  
        return $this->db->get('user')->result();
    }
    
    public function delete($id){
        $this->db->update('user', array('deleted' => true), array('id' => $id));
        if($this->db->affected_rows())
            return true;
        else
            return false;
    }
    
    public function points($id){
        $this->db->select('SUM(amount) as total');
        $points = $this->db->get_where('fidelity', array('user_id' => $id))->row();
        return $points ? $points->total : 0;
    }
    
    public function is_mobile_authorized($token){
        $this->db->select("user.id, user.name, user.phone, user.address, user.email, user.birth, DATE_FORMAT(user.created,'%d/%m/%Y') AS created");
        $user = $this->db->get_where('user', array('token' => $token))->row();
        if($user){
            $user->points = $this->points($user->id);
            return $user;
        }
        return false;
    }
    
    public function insert_fidelity($amount, $uid){
        $data = array(
            'amount'     => $amount,
            'company_id' => $this->session->userdata('company')->id,
            'user_id'    => $uid
        );
        $this->db->insert('fidelity', $data);
        if($this->db->affected_rows() == -1){
             return false;
        }
        return true;
    }
        
    public function last_checkin(){
        $this->db->select('user.name, user.phone, user.address, user.id, user.email, user.birth, checkin.id AS checkin_id');
        $this->db->join('user', 'checkin.user_id = user.id');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('checkin')->row();
    }
    
    public function delete_checkin($cid){
        return $this->db->delete('checkin', array('id' => $cid));
    }
    
    public function get_fcm($id = null){
        $this->db->select('fcm');
        if($id){
            $user = $this->db->get_where('user', array('id' => $id))->row();
            return $user ? $user->fcm : '';
        }
        return $this->db->get_where('user')->result_array();
    }
    
    public function delete_fidelity($uid, $fid = null){
        if($fid){
            return $this->db->delete('fidelity', array('id' => $fid, 'user_id' => $uid));
        }
        return $this->db->delete('fidelity', array('user_id' => $uid));
    }
    
}