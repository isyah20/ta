<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Wilayah_model extends CI_Model
{
    public function getAllWilayah()
    {
        $query = $this->db->get('wilayah');
        return $query->result_array();
    }

    public function getWilayahByName($nama)
    {
        // var_dump("%$nama%");
        $this->db->where('LOWER(wilayah) LIKE', "%$nama%");
        $query = $this->db->get('wilayah');
        // var_dump( $query->result_array() );
        return $query->result_array();
    }

    public function getWilayahById($id)
    {
        $this->db->where('id_wilayah', $id);
        $query = $this->db->get('wilayah');
        return $query->row_array();
    }

    public function tambahWilayah($data)
    {
        $this->db->insert('wilayah', $data);
        return $this->db->affected_rows();
    }

    public function ubahWilayah($id, $data)
    {
        $this->db->where('id_wilayah', $id);
        $this->db->update('wilayah', $data);
        return $this->db->affected_rows();
    }

    public function hapusWilayah($id)
    {
        $this->db->where('id_wilayah', $id);
        $this->db->delete('wilayah');
        return $this->db->affected_rows();
    }

    // Custom API
    public function getNamaNamaWilayahById($idWilayah)
    {
        // $idLpse = json_decode(str_replace('&quot;', '', $idLpse), true);
        // var_dump($idWilayah);
        // var_dump("cek");

        $this->db->select(['wilayah']);
        $this->db->from('wilayah');
        // $this->db->where_in('id_wilayah', json_decode($idWilayah));
        $this->db->where_in('id_wilayah', $idWilayah);
        $query = $this->db->get();

        return $query->result_array();
    }
}
