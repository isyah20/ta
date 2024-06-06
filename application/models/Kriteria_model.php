<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kriteria_model');
    }

    public function get_criteria()
    {
        return $this->db->get('data_kriteria')->result();
    }

    public function add_criteria($data)
    {
        return $this->db->insert('data_kriteria', $data);
    }

    public function delete_kriteria($id)
    {
        $this->db->where('id_kriteria', $id);
        $this->db->delete('data_kriteria');
    }
}
