<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Daftarhitam_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllDaftarHitam()
    {
        $query = $this->db->get('daftar_hitam');
        return $query->result_array();
    }

    public function getDaftarHitamById($id)
    {
        $query = $this->db->get_where('daftar_hitam', ['npwp' => $id]);
        return $query->row();
    }

    public function tambahDaftarHitam($data)
    {
        $this->db->insert('daftar_hitam', $data);
        return $this->db->insert_id();
    }

    public function ubahDaftarHitam($id, $data_new)
    {
        $this->db->where('id_daftar_hitam', $id);
        return $this->db->update('daftar_hitam', $data_new);
    }

    public function hapusDaftarHitam($id)
    {
        $this->db->where('id_daftar_hitam', $id);
        return $this->db->delete('daftar_hitam');
    }
}
