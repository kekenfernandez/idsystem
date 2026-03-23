<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logs_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function recent()
    {
        $this->db->select("users.full_name, users.image, TIME_FORMAT(attendance.login, '%h:%i %p') as login, TIME_FORMAT(attendance.logout, '%h:%i %p') as logout, DATE_FORMAT(attendance.date, '%M %e, %Y') as date, logs.date_created");
        $this->db->join('attendance', 'attendance.id = logs.attendance_id');
        $this->db->join('users', 'users.id = attendance.user_id');
        $this->db->where('attendance.date', $this->date);
        $this->db->limit(7);
        $this->db->order_by('logs.date_created', 'DESC');
        $query = $this->db->get('logs');
        return $query->result_array();
    }

    public function recent_by_type($type)
    {
        $this->db->select("users.full_name, users.image, TIME_FORMAT(attendance.login, '%h:%i %p') as login, TIME_FORMAT(attendance.logout, '%h:%i %p') as logout, DATE_FORMAT(attendance.date, '%M %e, %Y') as date, logs.date_created, logs.log_type");
        $this->db->join('attendance', 'attendance.id = logs.attendance_id');
        $this->db->join('users', 'users.id = attendance.user_id');
        $this->db->where('attendance.date', $this->date);
        $this->db->where('logs.log_type', $type);
        $this->db->limit(7);
        $this->db->order_by('logs.date_created', 'DESC');
        $query = $this->db->get('logs');
        return $query->result_array();
    }

    public function get_login()
    {
        $this->db->select("users.full_name, users.image, TIME_FORMAT(attendance.login, '%h:%i %p') as login, TIME_FORMAT(attendance.logout, '%h:%i %p') as logout, DATE_FORMAT(attendance.date, '%M %e, %Y') as date");
        $this->db->join('users', 'users.id = attendance.user_id');
        $this->db->where('attendance.login !=', null);
        $this->db->where('attendance.date', $this->date);
        $this->db->limit(6);
        $this->db->order_by('attendance.date_created', 'DESC');
        $query = $this->db->get('attendance');
        return $query->result_array();
    }

    public function get_logout()
    {
        $this->db->select("users.full_name, users.image, TIME_FORMAT(attendance.login, '%h:%i %p') as login, TIME_FORMAT(attendance.logout, '%h:%i %p') as logout, DATE_FORMAT(attendance.date, '%M %e, %Y') as date");
        $this->db->join('users', 'users.id = attendance.user_id');
        $this->db->where('attendance.logout !=', null);
        $this->db->where('attendance.date', $this->date);
        $this->db->limit(6);
        $this->db->order_by('attendance.date_created', 'DESC');
        $query = $this->db->get('attendance');
        return $query->result_array();
    }

    public function get_recent_entrance()
    {
        $this->db->select("users.full_name, users.image, TIME_FORMAT(attendance.login, '%h:%i %p') as login, TIME_FORMAT(attendance.logout, '%h:%i %p') as logout, DATE_FORMAT(attendance.date, '%M %e, %Y') as date, logs.date_created, logs.log_type");
        // $this->db->group_by('attendance_id');
        $this->db->join('attendance', 'attendance.id = logs.attendance_id');
        $this->db->join('users', 'users.id = attendance.user_id');
        $this->db->where('attendance.date', $this->date);
        $this->db->where('attendance.login !=', null);
        $this->db->where('logs.log_type', '1');
        $this->db->limit(7);
        $this->db->order_by('logs.date_created', 'DESC');
        $query = $this->db->get('logs');
        return $query->result_array();
    }

    public function get_recent_exit()
    {
        $this->db->select("users.full_name, users.image, TIME_FORMAT(attendance.login, '%h:%i %p') as login, TIME_FORMAT(attendance.logout, '%h:%i %p') as logout, DATE_FORMAT(attendance.date, '%M %e, %Y') as date, logs.date_created, logs.log_type");
        // $this->db->group_by('attendance_id');
        $this->db->join('attendance', 'attendance.id = logs.attendance_id');
        $this->db->join('users', 'users.id = attendance.user_id');
        $this->db->where('attendance.date', $this->date);
        $this->db->where('attendance.logout !=', null);
        $this->db->where('logs.log_type', '2');
        $this->db->limit(7);
        $this->db->order_by('logs.date_created', 'DESC');
        $query = $this->db->get('logs');
        return $query->result_array();
    }


    public function current()
    {
        $this->db->select("users.full_name, users.image, TIME_FORMAT(attendance.login, '%h:%i %p') as login, TIME_FORMAT(attendance.logout, '%h:%i %p') as logout, DATE_FORMAT(attendance.date, '%M %e, %Y') as date");
        // $this->db->select('users.full_name, users.image, TIME_FORMAT(attendance.login, "%h:%i %p") as login, TIME_FORMAT(attendance.logout, "%h:%i %p") as logout, attendance.date');
        $this->db->join('attendance', 'attendance.id = logs.attendance_id');
        $this->db->join('users', 'users.id = attendance.user_id');
        $this->db->where('attendance.date', $this->date);
        $this->db->order_by('logs.date_created', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('logs');
        return $query->row_array();
    }

    public function recentx()
    {
        $this->db->select('DISTINCT(attendance_id), logs.id, logs.date_created');
        $this->db->select("users.full_name, users.image, TIME_FORMAT(attendance.login, '%h:%i %p') as login, TIME_FORMAT(attendance.logout, '%h:%i %p') as logout, DATE_FORMAT(attendance.date, '%M %e, %Y') as date");
        $this->db->group_by('attendance_id');
        $this->db->join('attendance', 'attendance.id = logs.attendance_id');
        $this->db->join('users', 'users.id = attendance.user_id');
        $this->db->where('attendance.date', $this->date);
        $this->db->order_by('logs.id', 'DESC');
        $this->db->limit(6);
        $query = $this->db->get('logs');
        return $query->result_array();
    }
}
