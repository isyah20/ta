<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DetailTender_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }
    //Detai Tender
    public function getAllDetailTender()
    {
        $query = $this->db->get('detail_tender');
        return $query->result_array();
    }
    //id tender
    public function getDetailTenderById($id_tender)
    {
        $this->db->select('*');
        $this->db->from('tender');
        $this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
        $this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        $this->db->join('lpse', 'tender.id_lpse= lpse.id_lpse');
        $this->db->join('kategori_lpse', 'lpse.id_kategori = kategori_lpse.id_kategori');
        $this->db->join('rup', 'rup.id_tender = tender.id_tender', 'left');
        $this->db->where('tender.id_tender', $id_tender);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getDetailTenderOnlyById($id_tender)
    {
        $this->db->where('id_tender', $id_tender);
        $query = $this->db->get('detail_tender');
        $row = $query->row();
        if ($row) {
            return $row->id_tender;
        } else {
            return null;
        }
    }

    //tambah tender
    public function tambahDetailDataTender($data)
    {
        $this->db->insert('detail_tender', $data);
        return $this->db->affected_rows();
    }
    //ubah data tender
    public function ubahDetailDataTender($id_detail_tender, $data)
    {
        $this->db->where('id_detail_tender', $id_detail_tender);
        $this->db->update('detail_tender', $data);
        return $this->db->affected_rows();
    }
    //hapus Data Tender
    public function hapusDetailDataTender($id_detail_tender)
    {
        $this->db->where('id_detail_tender', $id_detail_tender);
        $this->db->delete('detail_tender');
        return $this->db->affected_rows();
    }
}
