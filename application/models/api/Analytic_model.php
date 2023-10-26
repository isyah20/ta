<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Analytic_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('tanggal');
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => base_url(),
            // You can set any number of default request options.
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
    }

    // Get nama peserta from table peserta then get jumlah tender yang diikuti with counting kode tender in peserta tender wich npwp is in peserta
    // public function getPesertaTender()
    // {
    //     $this->db->select(['nama_peserta', 'COUNT(kode_tender) AS jumlah_tender']);
    //     $this->db->from('peserta');
    //     $this->db->join('peserta_tender', 'peserta.npwp = peserta_tender.npwp');
    //     $this->db->where('peserta.id_peserta', $id);
    //     $this->db->group_by('peserta.npwp');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    // Get nama peserta dari tabel peserta dan jumlah ikut tender dari tabel peserta tender dengan menyamakan npwp di tabel peserta_tender dan peserta
    public function getPesertaTender($page_size, $page_number)
    {
        // $page_size = $data['pageSize'];
        // $page_number = ($data['pageNumber'] - 1) * $page_size;

        $this->db->select(['nama_peserta', 'COUNT(kode_tender) AS jumlah_tender']);
        $this->db->from('peserta');
        $this->db->join('peserta_tender', 'peserta.npwp = peserta_tender.npwp');
        $this->db->group_by('peserta.npwp');
        $this->db->limit($page_size, $page_number);
        $query = $this->db->get();
        return $query->result_array();
    }


    
}