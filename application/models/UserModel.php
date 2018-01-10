<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model{
    
    public function insert(){
        $data = array(
            'name'       => $this->input->post('name'),
            'phone'      => $this->input->post('phone'),
            'password'   => hash('sha256',$this->input->post('password')),
            'email'      => $this->input->post('email'),
            'address'    => $this->input->post('address'),
            'birth'      => date('Y-m-d', strtotime($this->input->post('birth')))
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
            'birth'      => date('Y-m-d', strtotime($this->input->post('birth')))
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
        return $this->db->get_where('user', array('deleted' => FALSE))->result();
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
    
    
    
    
}