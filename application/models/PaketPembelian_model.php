<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class PaketPembelian_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => base_url('api/'),
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
    }

    public function getAllData()
    {
        $data = $this->_client->request('GET', 'ApiPaketPembelian', $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getData($categoryId)
    {
        return $this->db->select('paket_pembelian.*')
            ->from('paket_pembelian')
            ->where('id_kategori', $categoryId)
            ->order_by('id_paket_pembelian', 'ASC')
            ->get();
    }

    public function getPaketById($id)
    {
        $data = $this->_client->request('GET', 'paketpembelian', $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }
}
