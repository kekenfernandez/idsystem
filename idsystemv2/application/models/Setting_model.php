<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get($name)
    {
        $data = array(
            'name' => $name
        );

        $query = $this->db->get_where('settings', $data);
        return $query->row_array();
    }
}
