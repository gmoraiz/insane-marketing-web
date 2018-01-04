<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model{
    
    public function by_phone($phone){
        $this->db->like('phone', $phone, 'after');  
        return $this->db->get('user')->result();
    }
    
}