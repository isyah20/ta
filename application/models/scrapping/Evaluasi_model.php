<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Evaluasi_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllEvaluasi()
    {
        $query = $this->db->get('hasil_evaluasi');
        return $query->result_array();
    }

    public function getCountPesertaTenderByIdTender($id)
    {
        $sql = "SELECT COUNT(*) AS peserta FROM hasil_evaluasi WHERE id_tender = ?";
        $query = $this->db->query($sql, $id);
        $row = $query->row();
        return $row->peserta;
    }

    public function getEvaluasiByIdTender($id)
    {
        $query = $this->db->get_where('hasil_evaluasi', ['id_tender' => $id]);
        return $query->result_array();
    }
    public function getEvaluasiByNPWP($npwp)
    {
        $query = $this->db->get_where('hasil_evaluasi', ['npwp' => $npwp]);
        return $query->row();
    }

    public function tambahEvaluasi($data)
    {
        $this->db->insert('hasil_evaluasi', $data);
        return $this->db->insert_id();
    }

    public function ubahEvaluasi($id, $data_new)
    {
        $this->db->where('id_evaluasi', $id);
        return $this->db->update('hasil_evaluasi', $data_new);
    }

    public function hapusEvaluasi($id)
    {
        $this->db->where('id_evaluasi', $id);
        return $this->db->delete('hasil_evaluasi');
    }
}
