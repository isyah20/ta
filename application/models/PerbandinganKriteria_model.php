<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PerbandinganKriteria_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PerbandinganKriteria_model');
    }
    public function save_comparison_data($data)
    {
        // Lakukan penyimpanan data ke database
        $comparison_data = array(
            'comparison1' => $data['comparison1'],
            'comparison2' => $data['comparison2'],
            'nilai1' => $data['nilai1'],
            // tambahkan untuk semua nilai yang lain
        );

        $this->db->insert('perbandingan', $comparison_data);

        if ($this->db->affected_rows() > 0) {
            return array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            return array('status' => 'error', 'message' => 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    // Mengambil data kriteria
    public function get_criteria($id = null)
    {
        if ($id == null) {
            return $this->db->get('data_kriteria')->result_array();
        } else {
            return $this->db->get_where('data_kriteria', ['id_kriteria' => $id])->row_array();
        }
    }

    // Mengambil jumlah n data kriteria
    public function getNumKriteria()
    {
        return $this->db->get('data_kriteria')->num_rows();
    }

    public function getNumPerbandinganKriteria($id_kriteria1, $id_kriteria2, $id_kriteria3, $id_kriteria4)
    {
        return $this->db->get_where('perbandingan_kriteria', ['id_kriteria1' => $id_kriteria1, 'id_kriteria2' =>$id_kriteria2, 'id_kriteria3' =>$id_kriteria3, 'id_kriteria4' => $id_kriteria4])->num_rows();
    }

    public function insertPerbandinganKriteria($id_kriteria1, $id_kriteria2, $id_kriteria3, $id_kriteria4, $nilai)
    {
        $this->db->insert('perbandingan_kriteria', ['id_kriteria1' => $id_kriteria1, 'id_kriteria2' => $id_kriteria2, 'id_kriteria3' =>$id_kriteria3, 'id_kriteria4' => $id_kriteria4, 'nilai_perbandingan' => $nilai]);
    }

    public function updatePerbandinganKriteria($id_kriteria1, $id_kriteria2,$id_kriteria3, $id_kriteria4, $nilai)
    {
        $this->db->where(['id_kriteria1' => $id_kriteria1, 'id_kriteria2' => $id_kriteria2,'id_kriteria3' => $id_kriteria3, 'id_kriteria4' => $id_kriteria4]);
        $this->db->update('perbandingan_kriteria', ['nilai_perbandingan' => $nilai]);
    }

    public function getNumWithIdKriteriaPV($id_kriteria)
    {
        return $this->db->get_where('bobot_kriteria', ['id_kriteria' => $id_kriteria])->num_rows();
    }

    public function insertKriteriaPV($id_kriteria, $pv)
    {
        $this->db->insert('bobot_kriteria', ['id_kriteria' => $id_kriteria, 'nilai' => $pv]);
    }

    public function updateKriteriaPV($id_kriteria, $pv)
    {
        $this->db->where(['id_kriteria' => $id_kriteria]);
        $this->db->update('bobot_kriteria', ['nilai' => $pv]);
    }
}
