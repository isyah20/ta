<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllJadwal()
    {
        $this->db->select(['jadwal.id_jadwal', 'jadwal.id_tender', 'tahapan.nama_tahapan AS tahapan', 'jadwal.tgl_mulai', 'jadwal.tgl_akhir', 'tahapan.icon']);
        $this->db->from('jadwal');
        $this->db->join('tahapan', 'tahapan.id_tahapan = jadwal.id_tahapan');
        $jadwal = $this->db->get();
        return $jadwal->result_array();
    }

    public function getCountJadwalByTender($kode_tender)
    {
        $this->db->where('id_tender', $kode_tender);
        $query = $this->db->get('jadwal');
        return $query->num_rows();
    }

    public function getCountTenderByLPSE($id_lpse)
    {
        $sql = "SELECT COUNT(DISTINCT id_tender) AS tender FROM jadwal WHERE REVERSE(SUBSTRING(REVERSE(id_tender),1,2)) = ?";
        $query = $this->db->query($sql, $id_lpse);
        $row = $query->row();
        // $this->db->where('id_lpse', $id_lpse);
        // $query = $this->db->get();
        return $row->tender;
    }

    public function getIdTahapanInJadwal($kode_tender, $id)
    {
        $this->db->where('id_tender', $kode_tender);
        $this->db->where('id_tahapan', $id);
        $query = $this->db->get('jadwal');
        $row = $query->row();
        if ($row) {
            return $row->id_tahapan;
        } else {
            return null;
        }
    }

    public function getPerubahanJadwalByIdTahapan($kode_tender, $id)
    {
        $this->db->where('id_tender', $kode_tender);
        $this->db->where('id_tahapan', $id);
        $query = $this->db->get('jadwal');
        $row = $query->row();
        if ($row) {
            return $row->perubahan;
        } else {
            return null;
        }
    }

    public function getRecentJadwalByCurrentTender($id_lpse)
    {
        $this->db->select('jadwal.id_tender');
        $this->db->from('jadwal');
        $this->db->join('tender', 'jadwal.id_tender = tender.id_tender');
        $this->db->join('lpse', 'tender.id_lpse = lpse.id_lpse');
        $this->db->where('tender.id_lpse', $id_lpse);
        $this->db->order_by('id_jadwal', 'ASC')->limit(1);
        $query = $this->db->get();
        return $query->row('id_tender');
    }

    public function getJadwalByKodeTenderAndIdTahap($id_duplikat, $id_tahapan)
    {
        $this->db->where('id_tender', $id_duplikat);
        $this->db->where('id_tahapan', $id_tahapan);
        $query = $this->db->get('jadwal');
        $row = $query->row();
        if ($row) {
            return $row->id_jadwal;
        } else {
            return null;
        }
    }

    // public function getJadwalByIdTahapan($kode_tender, $id)
    // {
    // 	$this->db->where('id_tender', $kode_tender);
    // 	$this->db->where('id_tahapan', $id);
    // 	$query = $this->db->get('jadwal');
    // 	$row = $query->row();
    // 	if ($row)
    // 		return $row->perubahan;
    // 	else
    // 		return null;
    // }

    //public function getIdJadwalBY
    public function getJadwalById($id)
    {
        $this->db->select(['jadwal.id_tender', 'tahapan.nama_tahapan AS tahapan', 'jadwal.tgl_mulai', 'jadwal.tgl_akhir', 'jadwal.perubahan', 'tahapan.icon']);
        $this->db->from('jadwal');
        $this->db->join('tahapan', 'tahapan.id_tahapan = jadwal.id_tahapan');
        $this->db->where('jadwal.id_Jadwal', $id);
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            return $row->id_jadwal;
        } else {
            return null;
        }
        // return $query->result_array();
    }

    public function getJadwalByTenderId($id)
    {
        $this->db->select(['jadwal.id_jadwal', 'jadwal.id_tender', 'tahapan.nama_tahapan AS tahapan', 'jadwal.tgl_mulai', 'jadwal.tgl_akhir', 'jadwal.perubahan', 'tahapan.icon']);
        $this->db->from('jadwal');
        $this->db->join('tahapan', 'tahapan.id_tahapan = jadwal.id_tahapan');
        $this->db->where('jadwal.id_tender', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function tambahJadwal($data)
    {
        $this->db->insert('jadwal', $data);
        return $this->db->insert_id();
    }

    public function ubahJadwal($id, $data_new)
    {
        $this->db->where('id_jadwal', $id);
        return $this->db->update('jadwal', $data_new);
    }

    public function ubahJadwalByKodeTenderAndIdTahap($kode_tender, $id, $data_new)
    {
        $this->db->where('id_tender', $kode_tender);
        $this->db->where('id_tahapan', $id);
        return $this->db->update('jadwal', $data_new);
    }

    public function ubahJadwalByIdTahapan($kode_tender, $id_tahapan, $data_new)
    {
        $this->db->where('id_tender', $kode_tender);
        $this->db->where('id_tahapan', $id_tahapan);
        return $this->db->update('jadwal', $data_new);
    }

    public function hapusJadwal($id)
    {
        $this->db->where('id_jadwal', $id);
        return $this->db->delete('jadwal');
    }
}
