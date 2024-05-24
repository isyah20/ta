<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pemenang_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPemenang()
    {
        $query = $this->db->get('pemenang');
        return $query->result_array();
    }

    public function getPemenangByIdTender($id)
    {
        $query = $this->db->get_where('pemenang', ['id_tender' => $id]);
        return $query->result_array();
    }

    public function getPemenangByNPWP($npwp)
    {
        $query = $this->db->get_where('pemenang', ['npwp' => $npwp]);
        return $query->row();
    }

    public function tambahPemenang($data)
    {
        $this->db->insert('pemenang', $data);
        return $this->db->insert_id();
    }

    public function ubahPemenang($id, $data_new)
    {
        $this->db->where('id_pemenang', $id);
        return $this->db->update('pemenang', $data_new);
    }

    public function hapusPemenang($id)
    {
        $this->db->where('id_pemenang', $id);
        return $this->db->delete('pemenang');
    }
}
