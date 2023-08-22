<?php

defined('BASEPATH') or exit('No direct script access allowed');

class HasilEvaluasi_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    // get all with id_tender
    public function getEvaluasiByIdTender($id)
    {
        // $this->db->select('*');
        // $this->db->from('hasil_evaluasi');
        // $this->db->join('peserta_tender', 'peserta_tender.npwp = hasil_evaluasi.npwp');
        // $this->db->join('peserta', 'peserta.npwp = peserta_tender.npwp');
        // // $this->db->join('pemenang', 'pemenang.npwp = peserta.npwp', 'left');
        // $this->db->where('hasil_evaluasi.id_tender', $id);
        // $query = $this->db->get();
        // return $query->result_array();

        // get all hasil evaluasi from id_tender with peserta_tender and peserta
        // $this->db->select('hasil_evaluasi.*, peserta_tender.*, peserta.*');
        // $this->db->from('hasil_evaluasi');
        // $this->db->join('peserta_tender', 'peserta_tender.id_tender = hasil_evaluasi.id_tender');
        // $this->db->join('peserta', 'peserta.npwp = peserta_tender.npwp');
        // $this->db->where('hasil_evaluasi.id_tender', $id);
        // $this->db->group_by('peserta_tender.id_peserta_tender');
        // $query = $this->db->get();
        // return $query->result_array();

        $this->db->select('*');
        $this->db->from('hasil_evaluasi');
        $this->db->where('hasil_evaluasi.id_tender', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}
