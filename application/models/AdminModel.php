<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        if(!$this->db->affected_rows()){
             return false;
        }
        return true;
    }
    
}