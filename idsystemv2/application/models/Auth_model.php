<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if(!$this->username_exist($username)) {
            return false;
        } else {
            $user = $this->username_exist($username);
            $hashed_password = $user['password'];
            if(!password_verify($password, $hashed_password)) {
                return false;
            } else {
                return $user;
            }
        }
    }

    public function username_exist($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('accounts');
        if($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }


    public function create_user($data)
    {
        $this->db->insert('accounts', $data);
    }
}
