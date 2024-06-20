<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PerbandinganAlternatif_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PerbandinganAlternatif_model');
    }

    // Ambil data kriteria berdasarkan id_kriteria
    public function getKriteria($id_kriteria)
    {
        $this->db->where('id_kriteria', $id_kriteria);
        $query = $this->db->get('kriteria');
        return $query->row_array();
    }

    // Ambil semua data alternatif
    public function getAlternatif()
    {
        $query = $this->db->get('data_alternatif');
        return $query->result_array();
    }

    // Hitung jumlah alternatif
    public function getNumAlternatif()
    {
        return $this->db->count_all('data_alternatif');
    }

    // Ambil id alternatif berdasarkan index
    public function getAlternatifId($index)
    {
        $query = $this->db->get('data_alternatif', 1, $index);
        return $query->row_array();
    }

    // Hitung jumlah perbandingan alternatif berdasarkan id_alternatif1, id_alternatif2, dan id_kriteria
    public function getNumPerbandinganAlternatif($id_alternatif1, $id_alternatif2, $id_kriteria)
    {
        $this->db->where('id_alternatif1', $id_alternatif1);
        $this->db->where('id_alternatif2', $id_alternatif2);
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->count_all_results('perbandingan_alternatif');
    }

    // Insert data perbandingan alternatif ke database
    public function insertPerbandinganAlternatif($id_alternatif1, $id_alternatif2, $id_kriteria, $nilai)
    {
        $data = array(
            'id_alternatif1' => $id_alternatif1,
            'id_alternatif2' => $id_alternatif2,
            'id_kriteria' => $id_kriteria,
            'nilai' => $nilai
        );
        $this->db->insert('perbandingan_alternatif', $data);
    }

    // Update data perbandingan alternatif di database
    public function updatePerbandinganAlternatif($id_alternatif1, $id_alternatif2, $id_kriteria, $nilai)
    {
        $data = array(
            'nilai' => $nilai
        );
        $this->db->where('id_alternatif1', $id_alternatif1);
        $this->db->where('id_alternatif2', $id_alternatif2);
        $this->db->where('id_kriteria', $id_kriteria);
        $this->db->update('perbandingan_alternatif', $data);
    }

    // Hitung jumlah alternatif PV berdasarkan id_alternatif dan id_kriteria
    public function getNumWithIdAlternatifPV($id_alternatif, $id_kriteria)
    {
        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->count_all_results('pv_alternatif');
    }

    // Insert data alternatif PV ke database
    public function insertAlternatifPV($id_alternatif, $id_kriteria, $nilai_pv)
    {
        $data = array(
            'id_alternatif' => $id_alternatif,
            'id_kriteria' => $id_kriteria,
            'nilai_pv' => $nilai_pv
        );
        $this->db->insert('pv_alternatif', $data);
    }

    // Update data alternatif PV di database
    public function updateAlternatifPV($id_alternatif, $id_kriteria, $nilai_pv)
    {
        $data = array(
            'nilai_pv' => $nilai_pv
        );
        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->where('id_kriteria', $id_kriteria);
        $this->db->update('pv_alternatif', $data);
    }

}
