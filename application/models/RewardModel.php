<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RewardModel extends CI_Model{
    
    public function insert(){
        $data = array(
            'description' => $this->input->post('description'),
            'required'    => $this->input->post('required'),
            'company_id'  => $this->session->userdata('company')->id,
            'picture'     => $this->input->post('picture')
        );
        $this->db->insert('reward', $data);
        if($this->db->affected_rows() == -1){
             return false;
        }
        return true;
    }
    
     public function update($id){
        $data = array(
            'description' => $this->input->post('description'),
            'required'    => $this->input->post('required')
        );
        if(!empty($this->input->post('picture'))){
            $data['picture'] =  $this->input->post('picture');
        }
        
        if(!empty($this->input->post('no-picture'))){
            $data['picture'] =  NULL;
        }
        
        $this->db->update('reward', $data, array('id' => $id, 'company_id' => $this->session->userdata('company')->id));
        if($this->db->affected_rows())
            return true;
        else
            return false;
    }
    
    public function select($id = null, $pagination = 0){
        if($id){
            return $this->db->get_where('reward', array('id' => $id, 'company_id' => $this->session->userdata('company')->id, 'deleted' => FALSE))->row();
        }
        $this->db->limit(PAGINATION_COUNT, $pagination);
        $this->db->order_by('id', 'DESC');
        return $this->db->get_where('reward', array('company_id' => $this->session->userdata('company')->id,  'deleted' => FALSE))->result();
    }
    
    public function is_reward_possible($uid, $rid = null){
        $this->db->where('required <=', '(SELECT SUM(amount) AS amount FROM fidelity WHERE user_id = ' . $uid .')', FALSE);
        if($rid){
            return $this->db->get_where('reward', array('id' => $rid))->row();
        }
        return $this->db->get('reward')->result();
    }
    
    public function delete($id){
        $this->db->update('reward', array('deleted' => true), array('id' => $id, 'company_id' => $this->session->userdata('company')->id));
        if($this->db->affected_rows())
            return true;
        else
            return false;
    }
    
}