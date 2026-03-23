<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sms_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_users($role = null)
    {
        if($role == null) {
            $this->db->select('id, full_name, contact_number');
            $this->db->where('contact_number !=', '');
            $query = $this->db->get('users');
            return $query->result_array();
        } else {
            $this->db->select('id, full_name, contact_number');
            $this->db->where('contact_number !=', '');
            $this->db->where('role', $role);
            $query = $this->db->get('users');
            return $query->result_array();
        }
    }

    public function create($data)
    {
        return $this->db->insert_batch('sms', $data);
    }

    public function get()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('sms');
        return $query->result_array();
    }

    public function count($status)
    {
        $this->db->where('status', $status);
        $query = $this->db->get('sms');
        return $query->num_rows();
    }
}
