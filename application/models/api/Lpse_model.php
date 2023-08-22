<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lpse_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllLpse()
    {
        $query = $this->db->get('lpse');
        return $query->result_array();
    }

    /**
     * @param int $pageNumber current page. default 0
     * @param int $pageSize limit data per sekali ambil. default = 20
     */
    public function getAll(int $pageNumber = 0, int $pageSize = 20, bool $woLimit = false)
    {
        $query = null;
        if ($woLimit) {
            $query = $this->db->get('lpse');
        } else {
            $query = $this->db->limit($pageSize, $pageNumber)->get('lpse');
        }
        return $query->result_array();
    }

    public function getAllLpseLink()
    {
        $this->db->select(['id_lpse', 'url']);
        $query = $this->db->get('lpse');
        return $query->result_array();
    }

    public function getLpseById($id)
    {
        $query = $this->db->get_where('lpse', ['id_lpse' => $id]);
        return $query->row();
    }

    public function tambahLpse($data)
    {
        $this->db->insert('lpse', $data);
        return $this->db->insert_id();
    }

    public function ubahLpse($id, $data_new)
    {
        $this->db->where('id_lpse', $id);
        return $this->db->update('lpse', $data_new);
    }

    public function hapusLpse($id)
    {
        $this->db->where('id_lpse', $id);
        return $this->db->delete('lpse');
    }

    // custom API
    public function getNamaNamaLpseById($idLpse)
    {
        // $idLpse = json_decode(str_replace('&quot;', '', $idLpse), true);
        // var_dump($idLpse);

        $this->db->select(['nama_lpse']);
        $this->db->from('lpse');
        // $this->db->where_in('id_lpse', json_decode($idLpse));
        $this->db->where_in('id_lpse', $idLpse);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getLpseByWilKat($idWilayah, $idKategori)
    {
        $idWilayah = json_decode(str_replace('&quot;', '', $idWilayah), true);
        $idKategori = json_decode(str_replace('&quot;', '', $idKategori), true);
        // var_dump($idLpse);

        $this->db->select(['id_lpse']);
        $this->db->from('lpse');
        // $this->db->where_in('id_lpse', json_decode($idLpse));
        if ($idWilayah !== null) {
            $this->db->where_in('id_wilayah', $idWilayah);
        }
        if ($idKategori !== null) {
            $this->db->where_in('id_kategori', $idKategori);
        }
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getLpseByIdWilayah($idWilayah)
    {
        // $idLpse = json_decode(str_replace('&quot;', '', $idLpse), true);
        // var_dump($idLpse);

        $this->db->select(['*']);
        $this->db->from('lpse');
        // $this->db->where_in('id_lpse', json_decode($idLpse));
        $this->db->where_in('id_wilayah', $idWilayah);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getlatlong($cariKLPD)
    {
        $this->db->select("nama_lpse, latitude, longitude");
        $this->db->from("lpse");
        $this->db->where("id_lpse", $cariKLPD);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getlatlongall()
    {
        $this->db->select("nama_lpse, latitude, longitude");
        $this->db->from("lpse");
        // $this->db->where("id_lpse", $cariKLPD);
        $query = $this->db->get();
        return $query->result_array();
    }
}
