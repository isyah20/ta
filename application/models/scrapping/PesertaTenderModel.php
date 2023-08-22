<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PesertaTenderModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPesertaTender()
    {
        $query = $this->db->get('peserta_tender');

        return $query->result_array();
    }

    public function getCountPesertaTenderByIdTender($id)
    {
        $sql = "SELECT COUNT(*) AS peserta FROM peserta_tender WHERE id_tender = ?";
        $query = $this->db->query($sql, $id);
        $row = $query->row();
        return $row->peserta;
    }

    public function getTenderById($id)
    {
        $query = $this->db->get_where('id_tender', ['id_tender' => $id]);

        return $query->row();
    }

    public function getPesertaTenderById($id)
    {
        $query = $this->db->get_where('peserta_tender', ['id_peserta_tender' => $id]);

        return $query->row();
    }

    public function tambahPesertaTender($data)
    {
        $this->db->insert('peserta_tender', $data);

        return $this->db->insert_id();
    }

    public function ubahPesertaTender($id, $new_data)
    {
        $this->db->where('id_peserta_tender', $id);

        return $this->db->update('peserta_tender', $new_data);
    }

    public function hapusPesertaTender($id)
    {
        $this->db->where('id_peserta_tender', $id);

        return $this->db->delete('peserta_tender');
    }
}
