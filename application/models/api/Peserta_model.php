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

    public function getPesertaNpwp($data)
    {
        $npwp = $data['npwp'];
        $this->db->select('*');
        $this->db->from('peserta');
        $this->db->where('npwp', $npwp);
        $query = $this->db->get();
        return $query->result_array();
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

    // Get nama peserta from table peserta by npwp in table peserta_tender. And get harga penwaran from peserta tender, where harga_penawaran not 0
    public function getPesertaIkutTender($npwp, $data) 
    {
        $data['tahun'] = $tahun;
        
        $this->db->select('peserta.nama_peserta, peserta_tender.harga_penawaran, paket.nama_tender, paket.nilai_hps_paket');
        $this->db->from('peserta_tender');
        $this->db->join('peserta', 'peserta.npwp = peserta_tender.npwp');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where('peserta_tender.npwp', $npwp)
        ->where('peserta_tender.harga_penawaran !=', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
}
