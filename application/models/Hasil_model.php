<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hasil_model');
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
        $query = "SELECT data_alternatif.id_alternatif, data_alternatif.nama_perusahaan, ranking.id_alternatif, ranking.nilai FROM data_alternatif, tb_ranking 
                  WHERE data_alternatif.id_alternatif = ranking.id_alternatif ORDER BY nilai DESC";
        return $this->db->query($query)->result_array();
    }
}
