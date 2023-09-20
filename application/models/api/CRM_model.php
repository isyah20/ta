<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CRM_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllTim()
    {
        $query = $this->db->get('tim_marketing');
        return $query->result_array();
    }
    public function getTimBySuplierId($id_suplier)
    {
        $query = $this->db->get_where('tim_marketing', ['id_suplier' => $id_suplier]);
        return $query->result_array();
    }
    public function getAllAnggota()
    {
        $query = $this->db->get('anggota');
        return $query->result_array();
    }


    public function getTimById($id)
    {
        $query = $this->db->get_where('tim_marketing', ['id_tim' => $id]);
        return $query->row_array();
    }

    public function getAnggotaById($id)
    {
        $query = $this->db->get_where('anggota', ['id_anggota' => $id]);
        return $query->row_array();
    }

    public function tambahTim($data)
    {
        $this->db->insert('tim_marketing', $data);
        $this->db->insert_id();
        return $this->db->get_where('tim_marketing', ['nama_tim' => $data['nama_tim']])->row_array();
    }

    public function tambahAnggota($data)
    {
        $this->db->insert('anggota', $data);
        $this->db->insert_id();
        return $this->db->get_where('anggota', ['nama_anggota' => $data['nama_anggota']])->row_array();
    }

    public function ubahTim($id, $data_new)
    {
        $this->db->where('id_tim', $id);

        return $this->db->update('tim_marketing', $data_new);
    }

    public function ubahAnggota($id, $data_new)
    {
        $this->db->where('id_anggota', $id);

        return $this->db->update('anggota', $data_new);
    }

    public function hapusTim($id)
    {
        $this->db->where('id_tim', $id);
        $this->db->delete('tim_marketing');
        return $this->db->affected_rows();
    }

    public function hapusAnggota($id)
    {
        $this->db->where('id_anggota', $id);
        $this->db->delete('anggota');
        return $this->db->affected_rows();
    }

    public function login($email, $password)
    {
        $this->db->select('*');
        $this->db->from('tim_marketing');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get();
        return $query->row();
    }
}
