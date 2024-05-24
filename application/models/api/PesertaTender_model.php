<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PesertaTender_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPesertaTender()
    {
        $query = $this->db->get('peserta_tender');
        return $query->result_array();
    }

    public function getPesertaTenderById($id)
    {
        $query = $this->db->get_where('peserta_tender', ['id_peserta_tender' => $id]);
        return $query->result_array();
    }

    public function tambahPesertaTender($data)
    {
        $this->db->insert('peserta_tender', $data);
        return $this->db->insert_id();
    }

    public function ubahPesertaTender($id, $data_new)
    {
        $this->db->where('id_peserta_tender', $id);
        $this->db->update('peserta_tender', $data_new);
        return $this->db->affected_rows();
    }

    public function hapusPesertaTender($id)
    {
        $this->db->where('id_peserta_tender', $id);
        return $this->db->delete('peserta_tender');
    }
}
