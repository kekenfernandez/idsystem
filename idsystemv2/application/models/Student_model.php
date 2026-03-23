<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Student_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get($id = null)
    {
        if($id == null) {
            $this->db->select('users.id, full_name, rfid_number, school_id_number, contact_number, image, grade_level, section_name');
            $this->db->join('sections', 'sections.id = users.grade_id', 'LEFT OUTER');
            $this->db->where('role', 'student');
            $query = $this->db->get('users');
            return $query->result_array();
        }

        $this->db->select('users.id as id, full_name, rfid_number, school_id_number, contact_number, image, sections.id as section_id ,grade_level, section_name');
        $this->db->join('sections', 'sections.id = users.grade_id', 'LEFT OUTER');
        $this->db->where('users.id', $id);
        $this->db->where('role', 'student');
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function create($image_name)
    {
        if($this->input->post('grade_section') == '') {
            $grade_id = null;
        } else {
            $grade_id = $this->input->post('grade_section');
        }

        $data = array(
          'rfid_number' => $this->input->post('rfid_number'),
          'school_id_number' => $this->input->post('school_id_number'),
          'full_name' => strtoupper($this->input->post('name')),
          'contact_number' => $this->input->post('contact_number'),
          'grade_id' => $grade_id,
          'image'=> $image_name,
          'role' => 'student'
        );

        return $this->db->insert('users', $data);
    }

    public function name_check_duplicate($name)
    {
        $this->db->where('full_name', $name);
        $this->db->where('role', 'student');
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

            if($this->input->post('grade_section') == '') {
                $grade_id = null;
            } else {
                $grade_id = $this->input->post('grade_section');
            }

            $data = array(
                'rfid_number' => $this->input->post('rfid_number'),
                'school_id_number' => $this->input->post('school_id_number'),
                'full_name' => strtoupper($this->input->post('name')),
                'contact_number' => $this->input->post('contact_number'),
                'grade_id' => $grade_id,
                'image'=> $image_name
            );

            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        }
    }

    public function check_section_member_exists($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('section_members');
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function check_id_exists($id)
    {
        $this->db->where('id', $id);
        $this->db->where('role', 'student');
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
        $this->db->where('role', 'student');
        return $this->db->delete('users');
    }

    public function count_students()
    {
        $this->db->where('role', 'student');
        $query = $this->db->get('users');
        return $query->num_rows();
    }
}