<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sections extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Section_model', 'section');
    }

    public function index()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Grade and Sections';
        $data['url'] = 'sections';

        $data['sections'] = $this->section->get();

        $this->load->view('admin-header', $data);
        $this->load->view('sections/index');
        $this->load->view('admin-footer');
        $this->load->view('sections/js-script');
    }

    public function create()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Create Grade and Section';
        $data['url'] = 'sections';

        $this->form_validation->set_rules('grade', 'Grade Level', 'required');
        $this->form_validation->set_rules('section', 'Section Name', 'required');

        if($this->form_validation->run() == false) {
            $this->load->view('admin-header', $data);
            $this->load->view('sections/create');
            $this->load->view('admin-footer');
            $this->load->view('sections/js-script');
        } else {
            $this->section->create();
            $this->session->set_flashdata('section_created', 'A grade and section was added.');
            redirect('sections/index', 'refresh');
        }
    }

    public function edit($id)
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $data['page_title'] = 'Edit Grade and Section';
        $data['url'] = 'sections';
        $data['section'] = $this->section->get($id);

        $this->load->view('admin-header', $data);
        $this->load->view('sections/edit');
        $this->load->view('admin-footer');
        $this->load->view('sections/js-script');
    }

    public function update()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $this->section->update();
        $this->session->set_flashdata('section_updated', 'A grade and section information was updated.');
        redirect('sections/index', 'refresh');
    }

    public function delete($id)
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $this->section->delete($id);
        $this->session->set_flashdata('section_deleted', 'A section was deleted.');
        redirect('sections/index', 'refresh');
    }

    public function members($section_id = null)
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        if($section_id == null) {
            redirect('sections/index');
        }

        $data['url'] = 'sections';

        $data['students'] = $this->section->get_students($section_id);
        $data['members'] = $this->section->get_members($section_id);
        $data['section'] = $this->section->get($section_id);
        $data['page_title'] = 'Section Members ' . $data['section']['grade_level'] . '-' . $data['section']['section_name'];

        $this->load->view('admin-header', $data);
        $this->load->view('sections/members');
        $this->load->view('admin-footer');
        $this->load->view('sections/js-script');
    }

    public function add_member()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $this->section->add_member();
        $this->session->set_flashdata('member_added', 'A member was added.');
        redirect('sections/members/'.$this->input->post('section_id'), 'refresh');
    }

    public function remove_member($user_id = null)
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        if($user_id == null) {
            redirect('sections/index', 'refresh');
        }

        $this->section->remove_member($user_id);
        $this->session->set_flashdata('member_removed', 'A member was removed.');

        redirect($_SERVER['HTTP_REFERER']);
    }
}