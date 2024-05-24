<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PerubahanJadwal_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPerubahanJadwal()
    {
        $query = $this->db->get('perubahan_jadwal');
        return $query->result_array();
    }

    public function getPerubahanJadwalById($id)
    {
        $query = $this->db->get_where('perubahan_jadwal', ['id_perubahan' => $id]);
        return $query->row();
    }

    public function getPerubahanJadwalByIdJadwal($id)
    {
        $query = $this->db->get_where('perubahan_jadwal', ['id_jadwal' => $id]);
        return $query->result_array();
    }

    public function tambahJadwal($data)
    {
        $this->db->insert('perubahan_jadwal', $data);
        return $this->db->insert_id();
    }

    public function ubahJadwal($id, $data_new)
    {
        $this->db->where('id_jadwal', $id);
        return $this->db->update('jadwal', $data_new);
    }

    // public function hapusJadwal($id)
    // {
    // 	$this->db->where('id_jadwal', $id);
    // 	return $this->db->delete('jadwal');
    // }
    public function hapusJadwal($id)
    {
        $this->db->where('id_perubahan', $id);
        $query = $this->db->delete('perubahan_jadwal');
    }
    public function hapusJadwalByIdPerubahan($id)
    {
        $this->db->where('id_perubahan', $id);
        $query = $this->db->delete('perubahan_jadwal');
    }
}
