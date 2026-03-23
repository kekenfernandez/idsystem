<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employees extends CI_Controller
{
    public string $image_extension;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model', 'employee');
        $this->load->model('Section_model', 'section');
        $this->load->model('Attendance_model', 'attendance');
        $this->image_extension = $GLOBALS['IMAGE_EXTENSION'];
    }

    public function index()
    {
        if($this->session->userdata('access') != 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Employees';
        $data['url'] = 'employees';
        $data['employees'] = $this->employee->get();

        $this->load->view('admin-header', $data);
        $this->load->view('employees/index');
        $this->load->view('admin-footer');
        $this->load->view('employees/employee-js');
    }

    public function create()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Create Employee';
        $data['url'] = 'employees';

        // Set validation rules
        $this->form_validation->set_rules('school_id_number', 'School ID Number', 'required');
        $this->form_validation->set_rules('name', 'Fullname', 'required|callback_name_check');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin-header', $data);
            $this->load->view('employees/create');
            $this->load->view('admin-footer');
            $this->load->view('employees/employee-js');

        } else {

            $image_name = $this->input->post('school_id_number') . $this->image_extension;

            $config['upload_path']          = './assets/images/users/';
            $config['file_name']             = $image_name;
            $config['allowed_types']        = 'png|jpg';
            $config['max_size']             = 5000;
            $config['max_width']            = 5000;
            $config['max_height']           = 5000;
            $config['overwrite']            = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

            $this->employee->create($image_name);
            $this->session->set_flashdata('employee_created', 'Employee successfully created.');
            redirect('employees/index', 'refresh');
        }
    }

    // Check if name is already in the system
    public function name_check($str)
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        if($this->employee->name_check_duplicate($str)) {
            $this->form_validation->set_message('name_check', 'Employee name already registered.');
            return false;
        } else {
            return true;
        }
    }

    public function view($id)
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'View Employees';
        $data['url'] = 'employees';
        $data['employee'] = $this->employee->get($id);

        $this->load->view('admin-header', $data);
        $this->load->view('employees/view');
        $this->load->view('admin-footer');
        $this->load->view('employees/employee-js');
    }

    public function update()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $id = $this->input->post('id');

        $image_name = $this->input->post('school_id_number') . $this->image_extension;

        $config['upload_path']          = './assets/images/users/';
        $config['file_name']             = $image_name;
        $config['allowed_types']        = 'png|jpg';
        $config['max_size']             = 5000;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;
        $config['overwrite']            = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        if(!$this->employee->update($id, $image_name)) {
            $this->session->set_flashdata('employee_update_error', 'Employee update error. Please try again.');
        } else {
            $this->session->set_flashdata('employee_updated', 'Employee information updated.');
        }

        redirect('employees/index', 'refresh');
    }

    public function delete($id)
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $this->employee->delete($id);
        $this->session->set_flashdata('employee_deleted', 'Employee deleted.');
        redirect('employees/index', 'refresh');
    }

    public function attendance($id)
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Employee Attendance';
        $data['url'] = 'employees';
        $data['attendance_records'] = $this->attendance->get_employee_attendance($id);
        $data['employee'] = $this->employee->get($id);

        $this->load->view('admin-header', $data);
        $this->load->view('employees/attendance');
        $this->load->view('admin-footer');
        $this->load->view('employees/employee-attendance-js');
    }
}
