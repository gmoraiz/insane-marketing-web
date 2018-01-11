<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MessageModel extends CI_Model{
    
    public function insert(){
        $data = array(
            'title'       => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'activated'   => $this->input->post('activated') ? true : false,
            'company_id'  => $this->session->userdata('company')->id,
            'type'        => $this->input->post('type'),
            'period'      => $this->input->post('period'),
        );
        $this->db->insert('message', $data);
        if($this->db->affected_rows() == -1){
             return false;
        }
        return true;
    }
    
     public function update($id){
        $data = array(
            'title'       => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'activated'   => $this->input->post('activated') ? true : false,
            'company_id'  => $this->session->userdata('company')->id,
            'type'        => $this->input->post('type'),
            'period'      => $this->input->post('period'),
        );
        
        $this->db->update('message', $data, array('id' => $id, 'company_id' => $this->session->userdata('company')->id));
        if($this->db->affected_rows())
            return true;
        else
            return false;
    }
    
    public function select($id = null, $pagination = 0){
        if($id){
            return $this->db->get_where('message', array('id' => $id, 'company_id' => $this->session->userdata('company')->id))->row();
        }
        $this->db->limit(PAGINATION_COUNT, $pagination);
        $this->db->order_by('id', 'DESC');
        return $this->db->get_where('message', array('company_id' => $this->session->userdata('company')->id))->result();
    }
    
    public function delete($id){
        $this->db->delete('message', array('id' => $id));
        if($this->db->affected_rows())
            return true;
        else
            return false;
    }
    
}