<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PerbandinganAlternatif_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PerbandinganAlternatif_model');
    }
    public function getKriteria($id = null)
    {
        if ($id == null) {
            return $this->db->get('data_kriteria')->result_array();
        } else {
            return $this->db->get_where('data_kriteria', ['id_kriteria' => $id])->row_array();
        }
    }

    public function getAlternatif($id = null)
    {
        if ($id == null) {
            return $this->db->get('data_alternatif')->result_array();
        } else {
            return $this->db->get_where('data_alternatif', ['id_alternatif' => $id])->row_array();
        }
    }

    public function getNumAlternatif()
    {
        return $this->db->get('data_alternatif')->num_rows();
    }

    public function getNumPerbandinganAlternatif($id_alternatif1, $id_alternatif2, $id_alternatif3, $id_kriteria)
    {
        return $this->db->get_where('perbandingan_alternatif', ['id_alternatif1' => $id_alternatif1, 'id_alternatif2' => $id_alternatif2, 'id_alternatif3' => $id_alternatif3, 'id_kriteria' => $id_kriteria])->num_rows();
    }

    public function insertPerbandinganAlternatif($id_alternatif1, $id_alternatif2,$id_alternatif3, $id_kriteria, $nilai)
    {
        $this->db->insert('perbandingan_alternatif', ['id_alternatif1' => $id_alternatif1, 'id_alternatif2' => $id_alternatif2, 'id_alternatif3' => $id_alternatif3,'id_kriteria' => $id_kriteria, 'nilai_perbandingan' => $nilai]);
    }

    public function updatePerbandinganAlternatif($id_alternatif1, $id_alternatif2, $id_alternatif3, $id_kriteria, $nilai)
    {
        $this->db->where(['id_alternatif1' => $id_alternatif1, 'id_alternatif2' => $id_alternatif2, 'id_alternatif1' => $id_alternatif1,'id_kriteria' => $id_kriteria]);
        $this->db->update('perbandingan_alternatif', ['nilai_perbandingan' => $nilai]);
    }

    /* public function getNumWithIdAlternatifPV($id_alternatif, $id_kriteria)
    {
        return $this->db->get_where('tb_bobot_alternatif', ['id_alternatif' => $id_alternatif, 'id_kriteria' => $id_kriteria])->num_rows();
    }

    public function insertAlternatifPV($id_alternatif, $id_kriteria, $pv)
    {
        $this->db->insert('tb_bobot_alternatif', ['id_alternatif' => $id_alternatif, 'id_kriteria' => $id_kriteria, 'nilai' => $pv]);
    }

    public function updateAlternatifPV($id_alternatif, $id_kriteria, $pv)
    {
        $this->db->where(['id_alternatif' => $id_alternatif, 'id_kriteria' => $id_kriteria]);
        $this->db->update('tb_bobot_alternatif', ['nilai' => $pv]);
    } */
}
