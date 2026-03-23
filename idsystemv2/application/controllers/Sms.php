<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sms_model', 'sms');
        $this->load->model('Section_model', 'section');
    }

    public function index()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'SMS Blast Logs';
        $data['url'] = 'sms';
        $data['logs'] = $this->sms->get();

        $this->load->view('admin-header', $data);
        $this->load->view('sms/index');
        $this->load->view('admin-footer');
        $this->load->view('sms/sms-js');
    }

    public function all()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'SMS Blast';
        $data['url'] = 'sms';

        $this->load->view('admin-header', $data);
        $this->load->view('sms/all');
        $this->load->view('admin-footer');
        $this->load->view('sms/sms-js');
    }

    public function all_send()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $temp_message = $this->input->post('message');
        $message = str_replace(array("\r", "\n"), " ", $temp_message);
        $users = $this->sms->get_users();

        if(empty($users)){
            $this->session->set_flashdata('sms_error', 'No users registered.');
            redirect('sms/all','refresh');
        }

        $date = date('Y-m-d');
        $data = array();

        foreach($users as $user) {
            $data[] = array(
              'name' => $user['full_name'],
              'number' => $user['contact_number'],
              'content' => $message
            );
        }

        $this->sms->create($data);
        $this->session->set_flashdata('sms_created', 'Message saved in queue.');
        redirect('sms/all', 'refresh');
    }

    public function students()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $role = 'student';
        $data['page_title'] = 'SMS Blast';
        $data['url'] = 'sms';
        $data['users'] = $this->sms->get_users($role);

        $this->load->view('admin-header', $data);
        $this->load->view('sms/student');
        $this->load->view('admin-footer');
        $this->load->view('sms/sms-js');
    }

    public function student_send()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $temp_message = $this->input->post('message');
        $message = str_replace(array("\r", "\n"), " ", $temp_message);
        $role ='student';
        $to = $this->input->post('send_to');

        if($to == null) {
            redirect('sms/students', 'refresh');
        } elseif(in_array('all', $to)) {
            $students = $this->sms->get_users($role);

            if(empty($students)){
                $this->session->set_flashdata('sms_error', 'No users registered.');
                redirect('sms/students','refresh');
            }
            
            $data = array();
            foreach($students as $student) {
                $data[] = array(
                  'name' => $student['full_name'],
                  'number'=> $student['contact_number'],
                  'content'=> $message
                );
            }
            $this->sms->create($data);
            $this->session->set_flashdata('sms_created', 'Message saved in queue.');
            redirect('sms/students', 'refresh');
        } else {
            $data = array();
            foreach($to as $student) {
                $explode = explode('_', $student);
                $data[] = array(
                  'name'=> $explode[0],
                  'number'=>$explode[1],
                  'content'=>$message
                );
            }
            $this->sms->create($data);
            $this->session->set_flashdata('sms_created', 'Message saved in queue.');
            redirect('sms/students', 'refresh');
        }
    }

    public function employees()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $role = 'employee';
        $data['page_title'] = 'SMS Blast';
        $data['url'] = 'sms';
        $data['users'] = $this->sms->get_users($role);

        $this->load->view('admin-header', $data);
        $this->load->view('sms/employee');
        $this->load->view('admin-footer');
        $this->load->view('sms/sms-js');
    }

    public function employee_send()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $temp_message = $this->input->post('message');
        $message = str_replace(array("\r", "\n"), " ", $temp_message);
        $role ='employee';
        $to = $this->input->post('send_to');

        if($to == null) {
            redirect('sms/employees', 'refresh');
        } elseif(in_array('all', $to)) {
            $employees = $this->sms->get_users($role);
            if(empty($employees)){
                $this->session->set_flashdata('sms_error', 'No users registered.');
                redirect('sms/employees','refresh');
            }
            $data = array();
            foreach($employees as $employee) {
                $data[] = array(
                  'name' => $employee['full_name'],
                  'number'=> $employee['contact_number'],
                  'content'=> $message
                );
            }
            $this->sms->create($data);
            $this->session->set_flashdata('sms_created', 'Message saved in queue.');
            redirect('sms/employees', 'refresh');
        } else {
            $data = array();
            foreach($to as $employee) {
                $explode = explode('_', $employee);
                $data[] = array(
                  'name'=> $explode[0],
                  'number'=>$explode[1],
                  'content'=>$message
                );
            }
            $this->sms->create($data);
            $this->session->set_flashdata('sms_created', 'Message saved in queue.');
            redirect('sms/employees', 'refresh');
        }
    }

    public function sections()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'SMS Blast';
        $data['url'] = 'sms';
        $data['sections'] = $this->section->get();

        $this->load->view('admin-header', $data);
        $this->load->view('sms/sections');
        $this->load->view('admin-footer');
        $this->load->view('sms/sms-js');
    }

    public function section_send()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $temp_message = $this->input->post('message');
        $message = str_replace(array("\r", "\n"), " ", $temp_message);
        $sections = $this->input->post('send_to');
        $data = array();

        foreach($sections as $section) {
            $students = $this->section->get_members($section);
            if(empty($students)){
                $this->session->set_flashdata('sms_error', 'No users registered.');
                redirect('sms/sections','refresh');
            }
            foreach($students as $student) {
                $data[] = array(
                  'name'=> $student['full_name'],
                  'number' => $student['contact_number'],
                  'content' => $message
                );
            }
        }

        $this->sms->create($data);
        $this->session->set_flashdata('sms_created', 'Message saved in queue.');
        redirect('sms/sections', 'refresh');
    }
}