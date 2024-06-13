<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PerbandinganKriteria_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PerbandinganKriteria_model');
    }
    public function insertPerbandinganKriteria($id_kriteria1, $id_kriteria2, $nilai)
    {
        $data = [
            'id_kriteria1' => $id_kriteria1,
            'id_kriteria2' => $id_kriteria2,
            'nilai_perbandingan' => $nilai
        ];
        $this->db->insert('perbandingan_kriteria', $data);
    }

    // Mengambil ID kriteria berdasarkan indeks
    public function getKriteriaId($index)
    {
        $query = $this->db->get('data_kriteria');
        $result = $query->result_array();
        return isset($result[$index]['id']) ? $result[$index]['id'] : null;
    }

    // Menyimpan perbandingan kriteria
    /* public function insertPerbandinganKriteria($id_kriteria1, $id_kriteria2, $nilai)
    {
        $data = [
            'id_kriteria1' => $id_kriteria1,
            'id_kriteria2' => $id_kriteria2,
            'nilai' => $nilai
        ];
        $this->db->insert('perbandingan_kriteria', $data);
    } */

    // Memperbarui perbandingan kriteria
    public function updatePerbandinganKriteria($id_kriteria1, $id_kriteria2, $nilai)
    {
        $this->db->where('id_kriteria1', $id_kriteria1);
        $this->db->where('id_kriteria2', $id_kriteria2);
        $this->db->update('perbandingan_kriteria', ['nilai' => $nilai]);
    }

    // Mengambil jumlah kriteria
    public function getNumKriteria()
    {
        return $this->db->count_all('data_kriteria');
    }

    // Mengambil jumlah perbandingan kriteria antara dua kriteria tertentu
    public function getNumPerbandinganKriteria($id_kriteria1, $id_kriteria2)
    {
        $this->db->where('id_kriteria1', $id_kriteria1);
        $this->db->where('id_kriteria2', $id_kriteria2);
        return $this->db->count_all_results('perbandingan_kriteria');
    }

    // Mengambil jumlah nilai PV untuk kriteria tertentu
    public function getNumWithIdKriteriaPV($id_kriteria)
    {
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->count_all_results('pv_kriteria');
    }

    // Menyimpan nilai PV untuk kriteria tertentu
    public function insertKriteriaPV($id_kriteria, $nilai_pv)
    {
        $data = [
            'id_kriteria' => $id_kriteria,
            'nilai_pv' => $nilai_pv
        ];
        $this->db->insert('pv_kriteria', $data);
    }

    // Memperbarui nilai PV untuk kriteria tertentu
    public function updateKriteriaPV($id_kriteria, $nilai_pv)
    {
        $this->db->where('id_kriteria', $id_kriteria);
        $this->db->update('pv_kriteria', ['nilai_pv' => $nilai_pv]);
    }
}
