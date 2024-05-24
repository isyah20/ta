<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Jadwal_model extends CI_Model
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

    public function getAllJadwal()
    {
        $data = $this->_client->request('GET', 'jadwal', $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getJadwalByIdTender($id)
    {
        $data = $this->_client->request('GET', "jadwal/tender/$id", $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getJadwalById($id): array
    {
        $data = ['data' => null];
        $resp = null;
        try {
            $resp = $this->_client->request('GET', "jadwal/$id", $this->_client->getConfig('headers'));
            if ($resp->getStatusCode() == 200) {
                $data = json_decode($resp->getBody()->getContents(), true);
            }
        } catch (\Exception $e) {
        }
        return $data;
    }

    public function getPerubahanJadwalById($id)
    {
        $data = $this->_client->request('GET', "jadwal/perubahan/$id", $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function tambahJadwal($data)
    {
        $data = $this->_client->request('POST', 'jadwal/create', [
            'form_params' => $data,
            'auth' => $this->_client->getConfig('headers')['auth'],
        ]);
    }

    public function ubahJadwal($id, $data)
    {
        $data = $this->_client->request('PUT', "jadwal/update/$id", [
            'form_params' => $data,
            'auth' => $this->_client->getConfig('headers')['auth'],
        ]);
    }

    public function hapusJadwal($id)
    {
        $data = $this->_client->request('DELETE', "jadwal/delete/$id", $this->_client->getConfig('headers'));
    }

    public $table = 'jadwal';
    public $column_order = ['id_jadwal', 'id_tender', 'id_tahapan', 'tgl_mulai', 'tgl_akhir', 'perubahan'];
    public $order = ['id_jadwal', 'id_tender', 'id_tahapan', 'tgl_mulai', 'tgl_akhir', 'perubahan'];

    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('id_jadwal', $_POST['search']['value']);
            // NOTE: apakah kolom id_tender sudah diganti dengan kode_tender?
            // $this->db->or_like('id_tender', $_POST['search']['value']);
            // $this->db->or_like('id_tahapan', $_POST['search']['value']);
            $this->db->or_like('kode_tender', $_POST['search']['value']);
            $this->db->or_like('id_tahap', $_POST['search']['value']);
            $this->db->or_like('tgl_mulai', $_POST['search']['value']);
            $this->db->or_like('tgl_akhir', $_POST['search']['value']);
            $this->db->or_like('perubahan', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_jadwal', 'ASC');
        }
    }

    public function getDataJadwal()
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
