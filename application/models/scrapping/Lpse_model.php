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

    public function getAllLpseLink()
    {
        $this->db->select(['id_lpse', 'id_wilayah', 'url']);
        // $this->db->order_by("id_lpse", "desc");
        // $this->db->where("id_lpse", 10);
        $this->db->where_in("id_lpse");
        $query = $this->db->get('lpse');
        return $query->result_array();
    }

    public function getAllLpseHaveTender()
    {
        $this->db->select(['lpse.id_lpse', 'lpse.id_wilayah', 'lpse.url']);
        $this->db->join('tender', 'lpse.id_lpse = tender.id_lpse');
        $this->db->group_by('lpse.id_lpse');
        // $this->db->order_by("id_lpse", "desc");
        // $this->db->where("id_lpse", 16);
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
}
