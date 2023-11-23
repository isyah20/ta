<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Peserta_model extends CI_Model
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

    public function getAllPeserta()
    {
        $data = $this->_client->request('GET', 'peserta', $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getPesertaById($id)
    {
        $data = $this->_client->request('GET', "peserta/$id", $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getPesertaNpwp($npwp)
    {
        $data = [];
        try {
            $resp = $this->_client->request('POST', 'pesertanpwp', [
                'form_params' => [
                    'npwp' => $npwp,
                ],
                'auth' => $this->_client->getConfig('headers')['auth'],
            ]);

            if ($resp->getStatusCode() == 200) {
                $data = json_decode($resp->getBody()->getContents(), true);
            }
        } catch (\Exception $ex) {
        }
        return $data;
    }

    public function tambahPeserta($data)
    {
        $data = $this->_client->request('POST', 'peserta/create', [
            'form_params' => $data,
            'auth' => $this->_client->getConfig('headers')['auth'],
        ]);
        // $data = json_decode($data->getBody()->getContents(), true);
        // return $data;
    }

    public function ubahPeserta($id, $data)
    {
        $data = $this->_client->request('PUT', "peserta/update/$id", [
            'form_params' => $data,
            'auth' => $this->_client->getConfig('headers')['auth'],
        ]);
    }

    public function hapusPeserta($id)
    {
        $data = $this->_client->request('DELETE', "peserta/delete/$id", $this->_client->getConfig('headers'));
    }

    public $table = 'peserta';
    public $column_order = ['id_peserta', 'npwp', 'nama_peserta', 'alamat', 'kelurahan', 'kecamatan'];
    public $order = ['id_peserta', 'npwp', 'nama_peserta', 'alamat', 'kelurahan', 'kecamatan'];

    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('id_peserta', $_POST['search']['value']);
            $this->db->or_like('npwp', $_POST['search']['value']);
            $this->db->or_like('nama_peserta', $_POST['search']['value']);
            $this->db->or_like('alamat', $_POST['search']['value']);
            $this->db->or_like('kelurahan', $_POST['search']['value']);
            $this->db->or_like('kecamatan', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_peserta', 'ASC');
        }
    }

    public function getDataPeserta()
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

    public function getPesertaIkutTender($npwp) 
    {
        $this->db->select('peserta.nama_peserta, peserta_tender.harga_penawaran, paket.nama_tender, paket.nilai_hps_paket');
        $this->db->from('peserta_tender');
        $this->db->join('peserta', 'peserta.npwp = peserta_tender.npwp');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where('peserta_tender.npwp', $npwp)
        ->where('peserta_tender.harga_penawaran !=', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
}
