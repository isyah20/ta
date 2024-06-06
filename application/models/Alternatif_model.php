<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Alternatif_model');
    }

    public function get_alternatives()
    {
        return $this->db->get('data_alternatif')->result();
        /* return $this->db->count_all('data_alternatif'); */
    }

    public function add_alternatif($data)
    {
        return $this->db->insert('data_alternatif', $data);
    }

    public function update_alternative($id, $data)
    {
        return $this->db->where('id_alternatif', $id)->update('data_alternatif', $data);
    }

    public function delete_alternative($id)
    {
        return $this->db->where('id_alternatif', $id)->delete('data_alternatif');
    }
}
