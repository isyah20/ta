<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Rup_model extends CI_Model
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

    // public function getAllLpse()
    // {
    //     $data = $this->_client->request('GET', 'lpse');
    //     $data = json_decode($data->getBody()->getContents(), true);
    //     return $data;
    // }

    // public function getLpseById($id)
    // {
    //     $data = $this->_client->request('GET', "lpse/$id");
    //     $data = json_decode($data->getBody()->getContents(), true);
    //     return $data;
    // }

    // public function tambahLpse($data)
    // {
    //     $data = $this->_client->request('POST', 'lpse/create', [
    //         'form_params' => $data
    //     ]);
    //     // $data = json_decode($data->getBody()->getContents(), true);
    //     // return $data;
    // }

    // public function ubahLpse($id, $data)
    // {
    //     $data = $this->_client->request('PUT', "lpse/update/$id", [
    //         'form_params' => $data
    //     ]);
    // }

    // public function hapusLpse($id)
    // {
    //     $data = $this->_client->request('DELETE', "lpse/delete/$id");
    // }

    public $table = 'rup';
    public $column_order = ['id', 'id_rup', 'id_tender', 'nama_paket', 'sumber_dana'];
    public $order = ['id', 'id_rup', 'id_tender', 'nama_paket', 'sumber_dana'];
    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('id_urut_rup', $_POST['search']['value']);
            $this->db->or_like('id_rup', $_POST['search']['value']);
            $this->db->or_like('id_tender', $_POST['search']['value']);
            $this->db->or_like('nama_paket', $_POST['search']['value']);
            $this->db->or_like('sumber_dana', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_urut_rup', 'ASC');
        }
    }

    public function getDataRup()
    {
        $this->_get_data_query();
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
