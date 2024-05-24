<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KategoriLpse_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllKategoriLpse()
    {
        $query = $this->db->get('kategori_lpse');
        return $query->result_array();
    }

    public function getKategoriLpseById($id)
    {
        $query = $this->db->get_where('kategori_lpse', ['id_kategori' => $id]);
        return $query->row();
    }

    public function tambahKategoriLpse($data)
    {
        $this->db->insert('kategori_lpse', $data);
        return $this->db->insert_id();
    }

    public function ubahKategoriLpse($id, $data_new)
    {
        $this->db->where('id_lpse', $id);
        return $this->db->update('lpse', $data_new);
    }

    public function hapusKategoriLpse($id)
    {
        $this->db->where('id_lpse', $id);
        return $this->db->delete('lpse');
    }
}
