<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employee_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get($id = null)
    {
        if($id == null) {
            $this->db->select('id, full_name, rfid_number, school_id_number, contact_number, image, role');
            $this->db->where('role', 'employee');
            $query = $this->db->get('users');
            return $query->result_array();
        } else {
            $this->db->select('id, full_name, rfid_number, school_id_number, contact_number, image, role');
            $this->db->where('users.id', $id);
            $this->db->where('role', 'employee');
            $query = $this->db->get('users');
            return $query->row_array();
        }
    }

    public function create($image_name)
    {
        $data = array(
          'rfid_number' => $this->input->post('rfid_number'),
          'school_id_number' => $this->input->post('school_id_number'),
          'full_name' => strtoupper($this->input->post('name')),
          'contact_number' => $this->input->post('contact_number'),
          'image'=> $image_name,
          'role' => 'employee'
        );

        return $this->db->insert('users', $data);
    }

    public function name_check_duplicate($name)
    {
        $this->db->where('full_name', $name);
        $this->db->where('role', 'employee');
        $query = $this->db->get('users');

        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($id, $image_name)
    {
        if(!$this->check_id_exists($id)) {
            return false;
        } else {
            $data = array(
                'rfid_number' => $this->input->post('rfid_number'),
                'school_id_number' => $this->input->post('school_id_number'),
                'full_name' => strtoupper($this->input->post('name')),
                'contact_number' => $this->input->post('contact_number'),
                'image'=> $image_name
            );

            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        }
    }

    public function check_id_exists($id)
    {
        $this->db->where('id', $id);
        $this->db->where('role', 'employee');
        $query = $this->db->get('users');
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->where('role', 'employee');
        return $this->db->delete('users');
    }

    public function get_employee_attendance($id)
    {
        $this->db->select('TIME_FORMAT(login, "%h:%i %p") as login, TIME_FORMAT(logout, "%h:%i %p") as logout, date, full_name');
        $this->db->join('users', 'users.id = attendance.user_id', 'LEFT OUTER');
        $this->db->where_in('users.id', $id);
        $this->db->order_by('attendance.date_created', 'DESC');
        $this->db->order_by('attendance.login', 'ASC');
        $query = $this->db->get('attendance');
        return $query->result_array();
    }

    public function count()
    {
        $this->db->where('role', 'employee');
        $query = $this->db->get('users');
        return $query->num_rows();
    }
}
