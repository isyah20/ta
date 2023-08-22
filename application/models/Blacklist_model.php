<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Blacklist_model extends CI_Model
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

    public function getAll()
    {
        $data = $this->_client->request('GET', 'jmldata_blacklist', $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }
}
