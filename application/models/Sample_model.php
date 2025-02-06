<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sample_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function save_data($insert_data)
    {
        return $this->db->insert('users', $insert_data);
    }

    function get_records()
    {
        $this->db->where('status', 0);
        $query = $this->db->get('users');
        return $query->result();
    }

    function get_record($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row_array();
    }


    function update_data($update_data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('user', $update_data);
    }


}