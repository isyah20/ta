<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Tahapan_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => base_url('/api/'),
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
    }

    public function getAllTahapan()
    {
        $data = $this->_client->request('GET', 'tahapan', $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getTahapanById($id)
    {
        $data = $this->_client->request('GET', "tahapan/$id", $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function tambahTahapan()
    {
        $data = [
            "nama_tahapan" => htmlspecialchars($this->input->post('nama_tahapan', true)),
            "icon" => htmlspecialchars($this->input->post('icon', true)),
        ];
        $response = $this->_client->request('POST', 'tahapan/create', [
            'form_params' => $data,
            'auth' => $this->_client->getConfig('headers')['auth'],
        ]);

        return $response;
    }

    public function ubahTahapan($id, $data)
    {
        $data = $this->_client->request('PUT', "tahapan/update/$id", [
            'form_params' => $data,
            'auth' => $this->_client->getConfig('headers')['auth'],
        ]);
    }

    public function hapusTahapan($id)
    {
        $response = $this->_client->request('DELETE', "tahapan/delete/$id", $this->_client->getConfig('headers'));
        return $response;
    }

    // custom get data
    public $table = 'tahapan';
    public $column_order = ['id_tahapan', 'nama_tahapan'];
    public $order = ['id_tahapan', 'nama_tahapan'];

    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('id_tahapan', $_POST['search']['value']);
            $this->db->or_like('nama_tahapan', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_tahapan', 'ASC');
        }
    }

    public function getDataTahapan()
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
}
