<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Wilayah_model extends CI_Model
{
    public function getAllWilayah()
    {
        $query = $this->db->get('wilayah');
        return $query->result_array();
    }

    public function getSearchWilayah($keyword)
    {
        $this->db->like('id_lpse', $keyword);
        $this->db->or_like('wilayah', $keyword);
        $query = $this->db->get('wilayah');
        return $query->result_array();
    }

    public function getWilayahById($id)
    {
        $this->db->select('wilayah');
        $this->db->where('id_wilayah', $id);
        $query = $this->db->get('wilayah');
        $result = $query->row();
        return $result->wilayah;
    }

    public function tambahWilayah($data)
    {
        $this->db->insert('wilayah', $data);
        return $this->db->affected_rows();
    }

    public function ubahWilayah($id, $data)
    {
        $this->db->where('id_wilayah', $id);
        $this->db->update('wilayah', $data);
        return $this->db->affected_rows();
    }

    public function hapusWilayah($id)
    {
        $this->db->where('id_wilayah', $id);
        $this->db->delete('wilayah');
        return $this->db->affected_rows();
    }
}
