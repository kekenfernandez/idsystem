<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Student_model', 'student');
        $this->load->model('Attendance_model', 'attendance');
        $this->load->model('Report_model', 'report');
        $this->load->model('Section_model', 'section');
        $this->load->model('Employee_model', 'employee');
    }


    public function index()
    {
        redirect('reports/student');
    }

    public function student()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Reports';
        $data['url'] ='reports';
        $data['students'] = $this->student->get();

        $this->load->view('admin-header', $data);
        $this->load->view('reports/student-search');
        $this->load->view('admin-footer');
        $this->load->view('reports/report-js');
    }

    public function generate_student()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Reports';
        $data['url'] ='reports';
        $data['role'] = 'student';

        $id = $this->input->post('students');

        if($id == null) {
            redirect('reports/student');
        } elseif(in_array('all-students', $id)) {
            $data['results'] = $this->report->student_report();
        } else {
            $data['results'] = $this->report->student_report($id);
        }

        $this->load->view('admin-header', $data);
        $this->load->view('reports/result');
        $this->load->view('admin-footer');
        $this->load->view('reports/report-js');
    }

    public function section()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Reports';
        $data['url'] ='reports';
        $data['sections'] = $this->section->get();

        $this->load->view('admin-header', $data);
        $this->load->view('reports/section-search');
        $this->load->view('admin-footer');
        $this->load->view('reports/report-js');
    }

    public function generate_section()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Reports';
        $data['url'] ='reports';
        $id = $this->input->post('sections');
        $data['role'] = 'student';


        if($id == null) {
            redirect('reports/section');
        }

        $data['results'] = $this->report->section_report($id);

        $this->load->view('admin-header', $data);
        $this->load->view('reports/result');
        $this->load->view('admin-footer');
        $this->load->view('reports/report-js');
    }

    public function employee()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Reports';
        $data['url'] ='reports';
        $data['employees'] = $this->employee->get();

        $this->load->view('admin-header', $data);
        $this->load->view('reports/employee-search');
        $this->load->view('admin-footer');
        $this->load->view('reports/report-js');
    }

    public function generate_employee()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Reports';
        $data['role'] = 'employee';
        $data['url'] ='reports';

        $id = $this->input->post('employees');

        if($id == null) {
            redirect('reports/employee');
        } elseif(in_array('all-employees', $id)) {
            $data['results'] = $this->report->employee_report();
        } else {
            $data['results'] = $this->report->employee_report($id);
        }

        $this->load->view('admin-header', $data);
        $this->load->view('reports/result');
        $this->load->view('admin-footer');
        $this->load->view('reports/report-js');
    }

}
