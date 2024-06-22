<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getNumKriteria()
    {
        return $this->db->get('data_kriteria')->num_rows();
    }

    public function getNumAlternatif()
    {
        return $this->db->get('data_alternatif')->num_rows();
    }

    public function getRanking()
    {
        $query = "SELECT data_alternatif.id_alternatif, data_alternatif.nama_perusahaan, ranking.id_alternatif, ranking.nilai 
                FROM data_alternatif, ranking 
                WHERE data_alternatif.id_alternatif = ranking.id_alternatif ORDER BY nilai DESC";
        return $this->db->query($query)->result_array();
    }

    public function getNumKriteriaPV()
    {
        $this->db->where('pv IS NOT NULL');
        return $this->db->get('data_kriteria')->num_rows();
    }

    public function getNumAlternatifPV()
    {
        $this->db->where('pv IS NOT NULL');
        return $this->db->get('data_alternatif')->num_rows();
    }

    public function getAlternatifId($index)
    {
        $this->db->limit(1, $index);
        return $this->db->get('data_alternatif')->row()->id_alternatif;
    }

    public function getKriteriaId($index)
    {
        $this->db->limit(1, $index);
        return $this->db->get('data_kriteria')->row()->id_kriteria;
    }

    public function getAlternatifPV($id_alternatif, $id_kriteria)
    {
        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->get('nilai_alternatif')->row()->pv;
    }

    public function getKriteriaPV($id_kriteria)
    {
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->get('data_kriteria')->row()->pv;
    }

    public function insertRanking($id_alternatif, $nilai)
    {
        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->update('ranking', ['nilai' => $nilai]);
    }
}
