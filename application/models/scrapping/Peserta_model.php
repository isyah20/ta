<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peserta_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPeserta()
    {
        $query = $this->db->get('peserta');
        return $query->result_array();
    }

    public function getPesertaById($id)
    {
        $query = $this->db->get_where('peserta', ['id_peserta' => $id]);
        return $query->row();
    }
    public function getPesertaByNPWP($npwp)
    {
        $query = $this->db->get_where('peserta', ['npwp' => $npwp]);
        return $query->row();
    }

    public function tambahPeserta($data)
    {
        $this->db->insert('peserta', $data);
        return $this->db->insert_id();
    }

    public function ubahPeserta($id, $data_new)
    {
        $this->db->where('id_peserta', $id);
        return $this->db->update('peserta', $data_new);
    }

    public function hapusPeserta($id)
    {
        $this->db->where('id_peserta', $id);
        return $this->db->delete('peserta');
    }
}
