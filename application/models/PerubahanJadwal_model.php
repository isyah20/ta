<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class PerubahanJadwal_model extends CI_Model
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

    public function getPerubahanJadwalById($id)
    {
        $data = $this->_client->request('GET', "PerubahanJadwal/$id", $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function tambahPerubahanJadwal($data)
    {
        $data = $this->_client->request('POST', 'perubahan-jadwal/create', [
            'form_params' => $data,
            'auth' => $this->_client->getConfig('headers')['auth'],
        ]);
    }

    public function ubahPerubahanJadwal($id, $data)
    {
        $data = $this->_client->request('PUT', "PerubahanJadwal/update/$id", [
            'form_params' => $data,
            'auth' => $this->_client->getConfig('headers')['auth'],
        ]);
    }

    public function hapusPerubahanJadwal($id)
    {
        $data = $this->_client->request('DELETE', "PerubahanJadwal/delete/$id", $this->_client->getConfig('headers'));
    }
}
