<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use App\components\traits\ClientApi;

class KategoriLpse_model extends CI_Model
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function getAllKategoriLpse()
    {
        $data = $this->client->request('GET', 'kategorilpse', $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getKategoriLpseById($id)
    {
        $data = $this->client->request('GET', "kategorilpse/$id", $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function tambahKategoriLpse($data)
    {
        $data = $this->client->request('POST', 'kategorilpse/create', [
            'form_params' => $data,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        // $data = json_decode($data->getBody()->getContents(), true);
        // return $data;
    }

    public function ubahKategoriLpse($id, $data)
    {
        $data = $this->client->request('PUT', "kategorilpse/update/$id", [
            'form_params' => $data,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
    }

    public function hapusKategoriLpse($id)
    {
        $data = $this->client->request('DELETE', "kategorilpse/delete/$id", $this->client->getConfig('headers'));
    }

    // custom get data
    public $table = 'kategori_lpse';
    public $column_order = ['id_kategori', 'nama_kategori'];
    public $order = ['id_kategori', 'nama_kategori'];

    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('id_kategori', $_POST['search']['value']);
            $this->db->or_like('nama_kategori', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_kategori', 'ASC');
        }
    }

    public function getDataKategoriLpse()
    {
        $this->_get_data_query();
        // var_dump($this->_get_data_query());
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_data()
    {
        $this->_get_data_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // Custom API
    public function getNamaNamaKategoriById($idKategori)
    {
        // var_dump($idKategori);
        $data = $this->client->request('POST', 'kategorilpse/namaNamaKategoriById', [
            'form_params' => [
                'id_kategori' => $idKategori,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }
}
