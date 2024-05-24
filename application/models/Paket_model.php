<?php

defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class Paket_model extends CI_Model
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function getAllPaket()
    {
        $data = $this->client->request('GET', 'paket', $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;

        // Get from table paket
        // $this->db->select(['*']);
        // $this->db->from('paket');
        // $query = $this->db->get();
        // return $query->result_array();
    }

    public function getPaketById($id)
    {
        $data = $this->client->request('GET', "paket/$id", $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getHpsPerMonth($klpd, $jenisPengadaan, $tahun)
    {
        $klpd = str_replace(['[', ']'], '', $klpd);
        $klpd = str_replace('"', '', $klpd);
        $klpd = intval($klpd);

        $jenisPengadaan = str_replace(['[', ']'], '', $jenisPengadaan);
        $jenisPengadaan = str_replace('"', '', $jenisPengadaan);
        $jenisPengadaan = intval($jenisPengadaan);

        $data = $this->client->request('POST', 'paket/s-getHpsPerMonth', [
            'form_params' => [
                'klpd' => $klpd,
                'jenisPengadaan' => $jenisPengadaan,
                // 'rentangHps' => $rentangHps,
                'tahun' => $tahun,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    // public $table = 'paket';
    // public $column_order = ['id_peserta', 'npwp', 'nama_peserta', 'alamat', 'kelurahan', 'kecamatan'];
    // public $order = ['id_peserta', 'npwp', 'nama_peserta', 'alamat', 'kelurahan', 'kecamatan'];

    // private function _get_data_query()
    // {
    //     $this->db->from($this->table);
    //     if (isset($_POST['search']['value'])) {
    //         $this->db->like('id_peserta', $_POST['search']['value']);
    //         $this->db->or_like('npwp', $_POST['search']['value']);
    //         $this->db->or_like('nama_peserta', $_POST['search']['value']);
    //         $this->db->or_like('alamat', $_POST['search']['value']);
    //         $this->db->or_like('kelurahan', $_POST['search']['value']);
    //         $this->db->or_like('kecamatan', $_POST['search']['value']);
    //     }

    //     if (isset($_POST['order'])) {
    //         $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    //     } else {
    //         $this->db->order_by('id_peserta', 'ASC');
    //     }
    // }

    // public function getDataPeserta()
    // {
    //     $this->_get_data_query();
    //     if ($_POST['length'] != -1) {
    //         $this->db->limit($_POST['length'], $_POST['start']);
    //     }
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function count_filtered_data()
    // {
    //     $this->_get_data_query();
    //     $query = $this->db->get();
    //     return $query->num_rows();
    // }

    // public function count_all_data()
    // {
    //     $this->db->from($this->table);
    //     return $this->db->count_all_results();
    // }
}
