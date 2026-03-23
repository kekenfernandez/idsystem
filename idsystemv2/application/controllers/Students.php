<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Students extends CI_Controller
{
    public string $image_extension;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Student_model', 'student');
        $this->load->model('Section_model', 'section');
        $this->load->model('Attendance_model', 'attendance');
        $this->image_extension = $GLOBALS['IMAGE_EXTENSION'];
    }

    public function index()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Students';
        $data['url'] = 'students';
        $data['students'] = $this->student->get();

        $this->load->view('admin-header', $data);
        $this->load->view('students/index');
        $this->load->view('admin-footer');
        $this->load->view('students/js-script');
    }

    public function create()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Create Student';
        $data['grades'] = $this->section->get();
        $data['url'] = 'students';

        $this->form_validation->set_rules('school_id_number', 'School ID Number', 'required');
        $this->form_validation->set_rules('name', 'Fullname', 'required|callback_name_check');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin-header', $data);
            $this->load->view('students/create');
            $this->load->view('admin-footer');
            $this->load->view('students/js-script');

        } else {

            $image_name = $this->input->post('school_id_number').$this->image_extension;

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

            $this->student->create($image_name);
            $this->session->set_flashdata('student_created', 'Student successfully created.');
            redirect('students/index', 'refresh');
        }
    }

    public function name_check($str)
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        if($this->student->name_check_duplicate($str)) {
            $this->form_validation->set_message('name_check', 'Student name already registered.');
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

        $data['page_title'] = 'View Student';
        $data['url'] = 'students';
        $data['student'] = $this->student->get($id);
        $data['grades'] = $this->section->get();

        $this->load->view('admin-header', $data);
        $this->load->view('students/view');
        $this->load->view('admin-footer');
        $this->load->view('students/js-script');
    }

    public function update()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $id = $this->input->post('id');

        $image_name = $this->input->post('school_id_number').$this->image_extension;

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

        if(!$this->student->update($id, $image_name)) {
            $this->session->set_flashdata('student_update_error', 'Student update error. Please try again.');
        } else {
            $this->session->set_flashdata('student_updated', 'Student information updated.');
        }

        redirect('students/index', 'refresh');
    }

    public function delete($id)
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $this->student->delete($id);
        $this->session->set_flashdata('student_deleted', 'Student deleted.');
        redirect('students/index', 'refresh');
    }

    public function attendance($id)
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['url'] = 'students';
        $data['page_title'] = 'Student Logs';
        $data['attendance_records'] = $this->attendance->get_student_attendance($id);
        $data['student'] = $this->student->get($id);

        $this->load->view('admin-header', $data);
        $this->load->view('students/attendance');
        $this->load->view('admin-footer');
        $this->load->view('students/student-attendance-js');
    }

}
