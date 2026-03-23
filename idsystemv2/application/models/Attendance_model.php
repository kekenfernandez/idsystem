<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Attendance_model extends CI_Model
{
    public string $school_name;
    public $limit;
    public function __construct()
    {
        $this->load->database();
        $this->school_name = $GLOBALS['SCHOOL_SHORT_NAME'];
        $this->limit = $GLOBALS['ATTENDANCE_LIMIT'];
    }

    public function rfid_exist($rfid)
    {
        $query = $this->db->get_where('users', array('rfid_number' => $rfid));
        if($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function attendance_exist()
    {
        $this->db->where('date', $this->date);
        $this->db->where('user_id', $this->user_id);
        $this->db->order_by('date_created', 'DESC');
        $query = $this->db->get('attendance');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function save_login()
    {
        if($this->is_attendance_limit_reach()) {
            return false;
        }

        $data = array(
            'user_id' => $this->user_id,
            'login' => $this->time,
            'date' => $this->date,
            'type' => 1
        );


        $this->db->insert('attendance', $data);
        return $this->db->insert_id();
    }

    public function save_logout()
    {
        $data = array(
            'user_id' => $this->user_id,
            'logout' => $this->time,
            'type' => 2
        );

        $this->db->where('id', $this->attendance_id);
        return $this->db->update('attendance', $data);
    }

    public function save_logout_exit()
    {

        if($this->is_attendance_limit_reach()) {
            return false;
        }

        $data = array(
            'user_id' => $this->user_id,
            'logout' => $this->time,
            'date' => $this->date,
            'type' => 2
        );


        $this->db->insert('attendance', $data);
        return $this->db->insert_id();
    }

    public function is_attendance_limit_reach()
    {
        $this->db->where('date', $this->date);
        $this->db->where('user_id', $this->user_id);
        $this->db->order_by('date_created', 'DESC');
        $query = $this->db->get('attendance');
        if ($query->num_rows() === $this->limit) {
            return true;
        } else {
            return false;
        }
    }

    public function save_sms_notification($sms_type)
    {
        $name = $this->user_information['full_name'];
        $number = $this->user_information['contact_number'];
        $time = date('h:i A', strtotime($this->time));
        $date = $this->date;

        $sms_type_value = '';

        if ($sms_type == 1) {
            $sms_type_value = 'entered';
        } else {
            $sms_type_value = 'exited';
        }

        if ($this->user_information['role'] == 'student') {

            $sms = 'From ' . $this->school_name . ': Good Day! Your son or daughter ' . $name . ' has ' . $sms_type_value . ' the campus at ' . $time . ' ' . $date;
            $data = array(
              'name' => $name,
              'number' => $number,
              'content' => $sms
            );

            return $this->db->insert('sms', $data);
        } else {

            $sms = 'From ' . $this->school_name . ': ' . $name . ' has ' . $sms_type_value . ' the campus at ' . $time . ' ' . $date;
            $data = array(
              'name' => $name,
              'number' => $number,
              'content' => $sms
            );

            return $this->db->insert('sms', $data);
        }

    }

    public function save_logs($type = null)
    {
        if($type == null) {
            $data = array(
                'attendance_id' => $this->attendance_id
              );

            return $this->db->insert('logs', $data);
        } else {
            $data = array(
                'attendance_id' => $this->attendance_id,
                'log_type' => $type
              );
            return $this->db->insert('logs', $data);
        }

    }

    public function current_log_check()
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('logs');
        $current = $query->row_array();

        if($current == null) {
            return false;
        }

        if($current['attendance_id'] == $this->attendance_id) {
            return true;
        } else {
            return false;
        }
    }

    public function get($date = null)
    {
        if($date == null) {
            $this->db->select('TIME_FORMAT(login, "%h:%i %p") as login, TIME_FORMAT(logout, "%h:%i %p") as logout, date, full_name, role, grade_level, section_name');
            $this->db->join('users', 'users.id = attendance.user_id');
            $this->db->join('sections', 'sections.id = users.grade_id', 'LEFT OUTER');
            $this->db->order_by('attendance.date_created', 'DESC');
            $query = $this->db->get('attendance');
            return $query->result_array();
        }

        $this->db->select('TIME_FORMAT(login, "%h:%i %p") as login, TIME_FORMAT(logout, "%h:%i %p") as logout, date, full_name , grade_level, section_name, role');
        $this->db->join('users', 'users.id = attendance.user_id');
        $this->db->join('sections', 'sections.id = users.grade_id', 'LEFT OUTER');
        $this->db->where('date', $date);
        $this->db->order_by('attendance.date_created', 'DESC');
        $query = $this->db->get('attendance');
        return $query->result_array();
    }

    public function count_login()
    {
        $date = date('Y-m-d');
        $this->db->where('login !=', null);
        $this->db->where('date', $date);
        $query = $this->db->get('attendance');
        return $query->num_rows();
    }

    public function count_logout()
    {
        $date = date('Y-m-d');
        $this->db->where('logout !=', null);
        $this->db->where('date', $date);
        $query = $this->db->get('attendance');
        return $query->num_rows();
    }

    public function get_student_attendance($id)
    {
        $this->db->select('TIME_FORMAT(login, "%h:%i %p") as login, TIME_FORMAT(logout, "%h:%i %p") as logout, date, full_name , grade_level, section_name');
        $this->db->join('users', 'users.id = attendance.user_id', 'LEFT OUTER');
        $this->db->join('sections', 'sections.id = users.grade_id', 'LEFT OUTER');
        $this->db->where_in('users.id', $id);
        $this->db->order_by('attendance.date_created', 'DESC');
        $this->db->order_by('attendance.login', 'ASC');
        $query = $this->db->get('attendance');
        return $query->result_array();
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

    public function test()
    {
        $this->db->select('date, full_name,
        MIN(login) as AMLOGIN,
        MIN(logout) as AMLGOUT,
        CASE
            WHEN COUNT(*) > 1 THEN MAX(login)
            ELSE NULL
        END AS PMLOGIN,
        CASE
            WHEN COUNT(*) > 1 THEN MAX(logout)
            ELSE NULL
        END AS PMLOGOUT');
        $this->db->join('users', 'users.id = attendance.user_id', 'LEFT OUTER');
        $this->db->group_by(array('full_name', 'date'));
        $query = $this->db->get('attendance');
        return $query->result_array();
    }

    public function test2()
    {
        $query = $this->db->query('
        SELECT
            user_id,
            date,
            MIN(CASE WHEN rn = 1 THEN login END) as MORNING_LOGIN,
            MAX(CASE WHEN rn = 1 THEN logout END) as MORNING_LOGOUT,
            MIN(CASE WHEN rn = 2 THEN login END) as AFTERNOON_LOGIN,
            MAX(CASE WHEN rn = 2 THEN logout END) as AFTERNOON_LOGOUT
        FROM (
            SELECT
                user_id,
                login,
                logout,
                date,
                ROW_NUMBER() OVER (PARTITION BY user_id, date ORDER BY login) as rn
            FROM
                attendance
        ) AS subquery
        GROUP BY
            user_id,
            date
        ');

        return $query->result_array();
    }

    public function test3()
    {
        $query = $this->db->query("
        SELECT 
            u.full_name,
            date,
            subquery.user_id,
            MIN(CASE WHEN rn = 1 THEN subquery.login END) AS LOGIN1, 
            MAX(CASE WHEN rn = 1 THEN subquery.logout END) AS LOGOUT1, 
            MIN(CASE WHEN rn = 2 THEN subquery.login END) AS LOGIN2, 
            MAX(CASE WHEN rn = 2 THEN subquery.logout END) AS LOGOUT2
        FROM (
            SELECT 
                user_id,
                login,
                logout,
                date,
                ROW_NUMBER() OVER (PARTITION BY user_id, date ORDER BY login) AS rn
            FROM 
                attendance
        ) AS subquery
        INNER JOIN users u ON u.id = subquery.user_id
        GROUP BY 
            u.full_name,
            subquery.user_id, 
            date
    ");
        return $query->result_array();
    }

    public function get_student_rep($id)
    {
        $this->db->select('TIME_FORMAT(login, "%h:%i %p") as login, TIME_FORMAT(logout, "%h:%i %p") as logout, date, full_name , grade_level, section_name');
        $this->db->join('users', 'users.id = attendance.user_id', 'LEFT OUTER');
        $this->db->join('section_members', 'section_members.user_id = attendance.user_id', 'LEFT OUTER');
        $this->db->join('sections', 'sections.id = section_members.section_id', 'LEFT OUTER');
        $this->db->where_in('users.id', $id);
        $this->db->order_by('attendance.date_created', 'DESC');
        $this->db->order_by('attendance.login', 'ASC');
        $query = $this->db->get('attendance');
        return $query->result_array();
    }

}
