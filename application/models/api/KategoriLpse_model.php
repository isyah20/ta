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
        $this->db->where('id_kategori', $id);
        return $this->db->update('kategori_lpse', $data_new);
    }

    public function hapusKategoriLpse($id)
    {
        $this->db->where('id_kategori', $id);
        return $this->db->delete('kategori_lpse');
    }

    // Custom API
    public function getNamaNamaKategoriById($idKategori)
    {
        // $idLpse = json_decode(str_replace('&quot;', '', $idLpse), true);
        // var_dump($idLpse);

        $this->db->select(['nama_kategori']);
        $this->db->from('kategori_lpse');
        // $this->db->where_in('id_lpse', json_decode($idLpse));
        $this->db->where_in('id_kategori', $idKategori);
        $query = $this->db->get();

        return $query->result_array();
    }
}
