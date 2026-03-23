<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function student_report($id = null)
    {
        $from = $this->input->post('date_from');
        $to = $this->input->post('date_to').' 23:00:00';

        $where = 'attendance.date_created BETWEEN "'.$from.'" AND "'.$to.'"';

        if(!$id == null) {
            $this->db->select('TIME_FORMAT(login, "%h:%i %p") as login, TIME_FORMAT(logout, "%h:%i %p") as logout, date, full_name , grade_level, section_name, role');
            $this->db->join('users', 'users.id = attendance.user_id');
            $this->db->join('sections', 'sections.id = users.grade_id', 'LEFT OUTER');
            $this->db->where($where);
            $this->db->where('role', 'student');
            $this->db->where_in('users.id', $id);
            $this->db->order_by('attendance.date', 'DESC');
            $this->db->order_by('users.full_name', 'ASC');
            $this->db->order_by('attendance.login', 'ASC');
            $query = $this->db->get('attendance');
            return $query->result_array();
        } else {
            $this->db->select('TIME_FORMAT(login, "%h:%i %p") as login, TIME_FORMAT(logout, "%h:%i %p") as logout, date, full_name , grade_level, section_name, role');
            $this->db->join('users', 'users.id = attendance.user_id');
            $this->db->join('sections', 'sections.id = users.grade_id', 'LEFT OUTER');
            $this->db->where($where);
            $this->db->where('role', 'student');
            $this->db->order_by('attendance.date', 'DESC');
            $this->db->order_by('grade_level', 'ASC');
            $this->db->order_by('section_name', 'ASC');
            $this->db->order_by('full_name', 'ASC');
            $query = $this->db->get('attendance');
            return $query->result_array();
        }
    }

    public function section_report($id)
    {
        $from = $this->input->post('date_from');
        $to = $this->input->post('date_to').' 23:00:00';

        $where = 'attendance.date_created BETWEEN "'.$from.'" AND "'.$to.'"';

        $this->db->select('TIME_FORMAT(login, "%h:%i %p") as login, TIME_FORMAT(logout, "%h:%i %p") as logout, date, full_name , grade_level, section_name, role');
        $this->db->join('users', 'users.id = attendance.user_id');
        $this->db->join('sections', 'sections.id = users.grade_id', 'LEFT OUTER');
        $this->db->where($where);
        $this->db->where_in('sections.id', $id);
        $this->db->order_by('attendance.date', 'DESC');
        $this->db->order_by('users.full_name', 'ASC');
        $this->db->order_by('attendance.login', 'ASC');
        $query = $this->db->get('attendance');
        return $query->result_array();
    }

    public function employee_report($id = null)
    {
        $from = $this->input->post('date_from');
        $to = $this->input->post('date_to').' 23:00:00';

        $where = 'attendance.date_created BETWEEN "'.$from.'" AND "'.$to.'"';

        if(!$id == null) {
            $this->db->select('TIME_FORMAT(login, "%h:%i %p") as login, TIME_FORMAT(logout, "%h:%i %p") as logout, date, full_name, role');
            $this->db->join('users', 'users.id = attendance.user_id', 'LEFT OUTER');
            $this->db->where($where);
            $this->db->where('role', 'employee');
            $this->db->where_in('users.id', $id);
            $this->db->order_by('attendance.date', 'DESC');
            $this->db->order_by('users.full_name', 'ASC');
            $this->db->order_by('attendance.login', 'ASC');
            $query = $this->db->get('attendance');
            return $query->result_array();
        } else {
            $this->db->select('TIME_FORMAT(login, "%h:%i %p") as login, TIME_FORMAT(logout, "%h:%i %p") as logout, date, full_name, role');
            $this->db->join('users', 'users.id = attendance.user_id', 'LEFT OUTER');
            $this->db->where($where);
            $this->db->where('role', 'employee');
            $this->db->order_by('attendance.date', 'DESC');
            $this->db->order_by('full_name', 'ASC');
            $query = $this->db->get('attendance');
            return $query->result_array();
        }
    }


}
