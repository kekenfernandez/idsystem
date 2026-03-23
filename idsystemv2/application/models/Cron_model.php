<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cron_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function delete_logs()
    {
        $date = date('Y-m-d');
        $this->db->where('DATE_FORMAT(date_created,"%Y-%m-%d") !=', $date);
        return $this->db->delete('logs');
    }

    public function delete_sms()
    {
        $yesterday = date('Y-m-d', strtotime("yesterday"));
        $today = date('Y-m-d');
        $this->db->where('DATE_FORMAT(date_created, "%Y-%m-%d") !=', $yesterday);
        $this->db->where('DATE_FORMAT(date_created, "%Y-%m-%d") !=', $today);
        return $this->db->delete('sms');
    }

    public function get_daily_attendance()
    {
        $date = date('Y-m-d');

        $this->db->select('full_name, grade_level, section_name, TIME_FORMAT(login, "%h:%i %p") as login, TIME_FORMAT(logout, "%h:%i %p") as logout, role, date');
        $this->db->join('users', 'users.id = attendance.user_id');
        $this->db->join('sections', 'sections.id = users.grade_id', 'LEFT OUTER');
        $this->db->where('date', $date);
        $this->db->order_by('attendance.date_created', 'DESC');
        $query = $this->db->get('attendance');
        return $query->result_array();
    }
    
    public function create_sms($info) {
        $login = $info['login'];
        $logout= $info['logout'];
        $sent = $info['sent'];
        $sending = $info['sending'];
        
        $data = array(
            'name' => 'SMS Monitor',
            'number' => '09179524463',
            'content' => 'Login/Logout:'. $login .'/'. $logout .'. ' . 'Sent/Sending: ' . $sent .'/'. $sending
        );
        return $this->db->insert('sms', $data);
    }
}