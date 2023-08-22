<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SyaratKualifikasi_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllSyarat()
    {
        $query = $this->db->get('syarat_kualifikasi');
        return $query->result_array();
    }

    public function getSyaratByIdTender($id)
    {
        $this->db->select('id_tender');
        $this->db->from('tender');
        $this->db->join('syarat_kualifikasi', 'syarat_kualifikasi.id_tender = syarat_kualifikasi.id_tender', 'left');
        $this->db->where('tender.id_tender', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahSyarat($data)
    {
        $this->db->insert('syarat_kualifikasi', $data);
        return $this->db->insert_id();
    }

    public function ubahSyarat($id, $data_new)
    {
        $this->db->where('id_syarat', $id);
        return $this->db->update('syarat_kualifikasi', $data_new);
    }

    public function hapusSyarat($id)
    {
        $this->db->where('id_syarat', $id);
        return $this->db->delete('syarat_kualifikasi');
    }
    //Detai Tender

    //id tender
    public function getSyaratById($id_tender)
    {
        $this->db->select('*');
        $this->db->from('syarat_kualifikasi');
        $this->db->where('id_tender', $id_tender);
        $query = $this->db->get();
        return $query->result_array();
    }
}
