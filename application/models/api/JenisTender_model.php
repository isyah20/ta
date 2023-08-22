<?php

defined('BASEPATH') or exit('No direct script access allowed');

class JenisTender_model extends CI_Model
{
    public function getAllJenisTender()
    {
        $query = $this->db->get('jenis_tender');
        return $query->result_array();
    }

    // public function getSearchJEnisTender($keyword)
    // {
    // 	$this->db->like('id_lpse', $keyword);
    // 	$this->db->or_like('nama_tender', $keyword);
    // 	$query = $this->db->get('tender');
    // 	return $query->result_array();
    // }

    public function getJenisTenderById($id)
    {
        $this->db->where('id_jenis', $id);
        $query = $this->db->get('jenis_tender');
        return $query->row_array();
    }

    public function getIdJenisTenderByName($name)
    {
        $this->db->select('id_jenis');
        $this->db->where('jenis_tender', ucwords($name));
        $query = $this->db->get('jenis_tender');
        return $query->row();
    }

    public function tambahJenisTender($data)
    {
        $this->db->insert('jenis_tender', $data);
        return $this->db->affected_rows();
    }

    public function ubahJenisTender($id, $data_new)
    {
        $this->db->where('id_jenis', $id);
        $this->db->update('jenis_tender', $data_new);
        return $this->db->affected_rows();
    }

    public function hapusJenisTender($id)
    {
        $this->db->where('id_jenis', $id);
        $this->db->delete('jenis_tender');
        return $this->db->affected_rows();
    }

    // Custom API
    public function getNamaNamaJenisTenderById($idJenis)
    {
        // $idLpse = json_decode(str_replace('&quot;', '', $idLpse), true);
        // var_dump($idLpse);

        $this->db->select(['jenis_tender']);
        $this->db->from('jenis_tender');
        // $this->db->where_in('id_lpse', json_decode($idLpse));
        $this->db->where_in('id_jenis', $idJenis);
        $query = $this->db->get();

        return $query->result_array();
    }
}
