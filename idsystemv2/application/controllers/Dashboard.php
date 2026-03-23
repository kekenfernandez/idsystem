<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Attendance_model', 'attendance');
        $this->load->model('Student_model', 'student');
        $this->load->model('Employee_model', 'employee');
        $this->load->model('Sms_model', 'sms');
    }

    public function index()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login');
        }

        $date = date('Y-m-d');

        $data['page_title'] = 'Dashboard';
        $data['url'] = 'dashboard';
        $data['login_count'] = $this->attendance->count_login();
        $data['logout_count'] = $this->attendance->count_logout();
        $data['student_count'] = $this->student->count_students();
        $data['employee_count'] = $this->employee->count();
        $data['daily_attendance'] = $this->attendance->get($date);
        $data['sent'] = $this->sms->count(1);
        $data['sending'] =$this->sms->count(0);

        $this->load->view('admin-header', $data);
        $this->load->view('dashboard/index');
        $this->load->view('admin-footer');
        $this->load->view('dashboard/js-script');
    }



}
