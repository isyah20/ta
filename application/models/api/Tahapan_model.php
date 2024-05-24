<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tahapan_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }
    //Detai Tahapan
    public function getAllTahapan()
    {
        $query = $this->db->get('tahapan');
        return $query->result_array();
    }

    //id Tahapan
    public function getTahapanById($id_tahapan)
    {
        $query = $this->db->get_where('tahapan', ['id_tahapan' => $id_tahapan]);
        return $query->row_array();
    }

    public function getIdTahapanByName($name)
    {
        $this->db->select('id_tahapan');
        $this->db->like('nama_tahapan', $name);
        $query = $this->db->get('tahapan');
        $row = $query->row();
        if ($row) {
            return $row->id_tahapan;
        } else {
            return null;
        }
    }

    //tambah Tahapan
    public function tambahTahapan($data)
    {
        $this->db->insert('tahapan', $data);
        return $this->db->affected_rows();
    }
    //ubah data Tahapan
    public function ubahTahapan($id_tahapan, $data)
    {
        $this->db->where('id_tahapan', $id_tahapan);
        $this->db->update('tahapan', $data);
        return $this->db->affected_rows();
    }

    //hapus Data Tahapan
    public function hapusTahapan($id_tahapan)
    {
        $this->db->where('id_tahapan', $id_tahapan);
        $this->db->delete('tahapan');
        return $this->db->affected_rows();
    }
}
