<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
    }

    public function login()
    {
        if($this->session->userdata('access') == 'admin') {
            redirect('dashboard', 'refresh');
        }

        $data['page_title'] = 'ID System Login';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() == false) {
            $this->load->view('admin-login');
        } else {
            if(!$this->auth->login()) {
                redirect('admin/login', 'refresh');
            } else {
                $user = $this->auth->login();

                $data = array(
                    'name' => $user['full_name'],
                    'role' =>$user['role'],
                    'access' => 'admin'
                );

                $this->session->set_userdata($data);
                redirect('dashboard', 'refresh');
            }
        }
    }

    public function logout()
    {
        if(!$this->session->userdata('access') == 'admin') {
            redirect('admin/login', 'refresh');
        }

        $this->session->sess_destroy();
        redirect('admin/login');
    }
}