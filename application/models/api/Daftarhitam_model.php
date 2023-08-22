<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Daftarhitam_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllDaftarHitam()
    {
        $query = $this->db->get('daftar_hitam');
        return $query->result_array();
    }

    public function getDaftarHitamById($id)
    {
        $query = $this->db->get_where('daftar_hitam', ['npwp' => $id]);
        return $query->row();
    }

    public function tambahDaftarHitam($data)
    {
        $this->db->insert('daftar_hitam', $data);
        return $this->db->insert_id();
    }

    public function ubahDaftarHitam($id, $data_new)
    {
        $this->db->where('id_daftar_hitam', $id);
        return $this->db->update('daftar_hitam', $data_new);
    }

    public function hapusDaftarHitam($id)
    {
        $this->db->where('id_daftar_hitam', $id);
        return $this->db->delete('daftar_hitam');
    }

    public function getDaftarHItamByNpwp()
    {
        $this->db->select('*');
        $this->db->from('daftar_hitam');
        $this->db->join('peserta_de', 'daftar_hitam.npwp = peserta_de.npwp');
        $this->db->limit(15, 0);
        $this->db->order_by('daftar_hitam.id_daftar_hitam', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getjmlblacklist()
    {
        //data dinamis button slide

        $this->db->select('COUNT(id_daftar_hitam)');
        $this->db->from('blacklist_aktif');
        $total_aktif = $this->db->get_compiled_select();

        $this->db->select('*');
        $this->db->select("($total_aktif) as aktif");
        $this->db->select('COUNT(id_daftar_hitam) AS selesai');
        $this->db->from('blacklist_selesai');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_blacklist($limit, $offset, $search, $count)
    {
        $this->db->select('*');
        $this->db->from('blacklist_aktif');
        if ($search['keyword'] != null) {
            $keyword = $search['keyword'];
            if ($keyword) {
                $this->db->where("nama_peserta LIKE '%$keyword%'");
            }
        }
        if ($search['wilayah'] != null) {
            $keyword = $search['wilayah'];
            if ($keyword) {
                $this->db->where("id_wilayah LIKE '%$keyword%'");
            }
        }
        if ($count) {
            return $this->db->count_all_results();
        } else {
            $this->db->limit($limit, $offset);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
        }

        return [];
    }

    public function get_blacklistselesai($limit, $offset, $search, $count)
    {
        $this->db->select('*');
        $this->db->from('blacklist_selesai');
        if ($search['keyword'] != null) {
            $keyword = $search['keyword'];
            if ($keyword) {
                $this->db->where("nama_peserta LIKE '%$keyword%'");
            }
        }
        if ($search['wilayah'] != null) {
            $keyword = $search['wilayah'];
            if ($keyword) {
                $this->db->where("id_wilayah LIKE '%$keyword%'");
            }
        }
        if ($count) {
            return $this->db->count_all_results();
        } else {
            $this->db->limit($limit, $offset);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
        }

        return [];
    }
}
