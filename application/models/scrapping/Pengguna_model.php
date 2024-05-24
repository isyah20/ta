<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{
    // should add return
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPengguna()
    {
        $query = $this->db->get('pengguna');
        return $query->result_array();
    }

    public function getPenggunaById($id)
    {
        $query = $this->db->get_where('pengguna', ['id_pengguna' => $id]);
        return $query->row_array();
    }

    public function tambahPengguna($data)
    {
        $this->db->insert('pengguna', $data);
        $this->db->insert_id();
        return $this->db->get_where('pengguna', ['email' => $data['email']])->row_array();
    }

    public function ubahPengguna($id, $data_new)
    {
        $this->db->where('id_pengguna', $id);
        return $this->db->update('pengguna', $data_new);
    }

    public function hapusPengguna($id)
    {
        $this->db->where('id_pengguna', $id);
        return $this->db->delete('pengguna');
    }

    public function login($email, $password)
    {
        $this->db->select('*');
        $this->db->from('pengguna');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get();
        return $query->row();
    }
}
