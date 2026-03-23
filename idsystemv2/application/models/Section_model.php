<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Section_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get($id = null)
    {
        if(!$id == null) {
            $this->db->where('id', $id);
            $query = $this->db->get('sections');
            return $query->row_array();
        }

        $this->db->order_by('grade_level', 'ASC');
        $this->db->order_by('section_name', 'ASC');
        $query = $this->db->get('sections');
        return $query->result_array();
    }

    public function create()
    {
        $data = array(
          'grade_level' => $this->input->post('grade'),
          'section_name' => $this->input->post('section')
        );
        return $this->db->insert('sections', $data);
    }

    public function update()
    {
        $data = array(
          'grade_level' => $this->input->post('grade'),
          'section_name' => $this->input->post('section')
        );
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('sections', $data);
    }

    public function count_students($id)
    {
        $this->db->where('grade_id', $id);
        $query = $this->db->get('users');
        return $query->num_rows();
    }

    public function get_students($section_id)
    {
        $this->db->select('users.id, users.full_name');
        $this->db->where('grade_id', null);
        $this->db->where('role', 'student');
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function get_members($section_id)
    {
        $this->db->where('grade_id', $section_id);
        $this->db->where('role', 'student');
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('sections');
    }

    public function add_member()
    {
        $section_id = $this->input->post('section_id');
        $members = $this->input->post('members');
        $data = array();
        foreach($members as $member) {
            $data[] = array(
                'id' => $member,
                'grade_id' => $section_id
            );
        }
        return $this->db->update_batch('users', $data, 'id');
    }

    public function remove_member($id)
    {
        $data =array(
            'grade_id' => null
        );

        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
}
