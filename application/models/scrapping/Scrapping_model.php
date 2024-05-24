<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Scrapping_model extends CI_Model
{
    public function kirimNotifikasi()
    {
        $sql = "SELECT pengguna.id_pengguna,nama,no_telp FROM pengguna,preferensi,tender_terbaru
		        WHERE pengguna.id_pengguna=preferensi.id_pengguna AND (preferensi.id_lpse=tender_terbaru.id_lpse OR tender_terbaru.nama_pekerjaan LIKE CONCAT('%',keyword,'%'))
		        GROUP BY id_pengguna ORDER BY id_pengguna";

        return $this->db->query($sql);
    }

    public function kirimTenderTerbaru($id_pengguna)
    {
        $sql = "SELECT id_tender,nama_pekerjaan,hps,akhir_daftar,nama_lpse,url
		        FROM pengguna,preferensi,tender_terbaru,lpse
		        WHERE pengguna.id_pengguna=preferensi.id_pengguna AND pengguna.id_pengguna={$id_pengguna} AND tender_terbaru.id_lpse=lpse.id_lpse AND (preferensi.id_lpse=tender_terbaru.id_lpse OR tender_terbaru.nama_pekerjaan LIKE CONCAT('%',keyword,'%'))";

        return $this->db->query($sql);
    }

    public function getJumlahTenderTerbaru($id_pengguna)
    {
        $sql = "SELECT COUNT(id_tender) AS jumlah FROM pengguna,preferensi,tender_terbaru
		        WHERE pengguna.id_pengguna=preferensi.id_pengguna AND pengguna.id_pengguna={$id_pengguna} AND (preferensi.id_lpse=tender_terbaru.id_lpse OR tender_terbaru.nama_pekerjaan LIKE CONCAT('%',keyword,'%'))";

        return $this->db->query($sql);
    }

    //Detai Tender
    public function getAllScrap()
    {
        $query = $this->db->get('monitor_scrap');
        return $query->result_array();
    }
    public function getHistoryByIdLpse($id_lpse, $id_jenis)
    {
        $this->db->select('id_lpse');
        $this->db->where('id_lpse', $id_lpse);
        $this->db->where('id_jenis_monitoring', $id_jenis);
        $query = $this->db->get('monitor_scrap');
        $row = $query->row();
        if ($row) {
            return $row->id_lpse;
        } else {
            return null;
        }
    }

    public function getDataHistory($id_lpse, $id_jenis)
    {
        $this->db->where('id_lpse', $id_lpse);
        $this->db->where('id_jenis_monitoring', $id_jenis);
        $this->db->where('date', date('Y-m-d'));
        $query = $this->db->get('monitor_scrap');
        return $query->result_array();
    }

    //tambah tender
    public function tambahScrap($data)
    {
        $this->db->insert('monitor_scrap', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return $this->db->error();
        }
    }
    //ubah data tender
    public function ubahScrap($id_lpse, $id_jenis, $data)
    {
        $this->db->where('id_lpse', $id_lpse);
        $this->db->where('id_jenis_monitoring', $id_jenis);
        $this->db->update('monitor_scrap', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return $this->db->error();
        }
        // return $this->db->affected_rows();
    }
    //hapus Data Tender
    public function hapusScrap($id_lpse)
    {
        $this->db->where('id_lpse', $id_lpse);
        $this->db->delete('monitor_scrap');
        return $this->db->affected_rows();
    }
}
