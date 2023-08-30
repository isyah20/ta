<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllJadwalOrigin()
    {
        $this->db->select(['*']);
        $this->db->from('jadwal');
        $jadwal = $this->db->get();
        return $jadwal->result_array();
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

    public function getIdTahapanByIdTahapan($kode_tender, $id)
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
        $this->db->select(['jadwal.kode_tender', 'jadwal.id_jadwal', 'tahapan.nama_tahap AS tahapan', 'jadwal.tgl_mulai', 'jadwal.tgl_akhir', 'jadwal.perubahan', 'tahapan.icon']);
        $this->db->from('jadwal');
        $this->db->join('tahapan', 'tahapan.id_tahap = jadwal.id_tahap');
        $this->db->where('jadwal.id_Jadwal', $id);
        $query = $this->db->get();
        $row = $query->row();
        // if ($row)
        // 	return $row->id_jadwal;
        // else
        // 	return null;
        return $query->row_array();
    }

    public function getJadwalByTenderId($id)
    {
        $this->db->select(['jadwal.id_jadwal', 'jadwal.kode_tender', 'jadwal.id_tahap', 'tahapan.nama_tahap AS tahapan', 'jadwal.tgl_mulai', 'jadwal.tgl_akhir', 'jadwal.perubahan', 'tahapan.icon']);
        $this->db->from('jadwal');
        $this->db->join('tahapan', 'tahapan.id_tahap = jadwal.id_tahap');
        $this->db->where('jadwal.kode_tender', $id);
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
