<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rup_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }
    //Detai Tender
    public function getAllRup()
    {
        $query = $this->db->get('rup');
        return $query->result_array();
    }
    //id tender
    public function getRupById($id_rup)
    {
        $query = $this->db->get_where('rup', ['id_rup' => $id_rup]);
        return $query->row_array();
    }

    //tambah tender
    public function tambahRupTender($data)
    {
        $this->db->insert('rup', $data);
        return $this->db->affected_rows();
    }
    //ubah data tender
    public function ubahRup($id_rup, $data)
    {
        $this->db->where('id_rup', $id_rup);
        $this->db->update('rup', $data);
        return $this->db->affected_rows();
    }
    //hapus Data Tender
    public function hapusRup($id_rup)
    {
        $this->db->where('id_rup', $id_rup);
        $this->db->delete('detail_tender');
        return $this->db->affected_rows();
    }
}
