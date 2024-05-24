<?php

defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class Lpse_model extends CI_Model
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function getListLpse($keyword, $page, $limit)
    {
        return $this->db->select("id_lpse as id, nama_lpse as text")
            ->like("nama_lpse", $keyword)
            ->get("lpse", $limit, $page)->result_array();
    }

    public function getJumlahListLpse($keyword)
    {
        return $this->db->select("id_lpse as id, nama_lpse as text")
            ->like("nama_lpse", $keyword)
            ->count_all_results("lpse");
    }

    public function getAllLpse()
    {
        $result = ['error' => 0, 'message' => '', 'data' => []];
        try {
            $resp = $this->client->request('GET', 'lpse', $this->client->getConfig('headers'));
            if ($resp->getStatusCode() == 200) {
                $data = json_decode($resp->getBody()->getContents(), true);
                $result = array_merge($result, $data);
            }
            return $result;
        } catch (\Exception $e) {
            $result['error'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getLpseById($id)
    {
        $data = $this->client->request('GET', "lpse/$id", $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function tambahLpse($data)
    {
        $data = $this->client->request('POST', 'lpse/create', [
            'form_params' => $data,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        // $data = json_decode($data->getBody()->getContents(), true);
        // return $data;
    }

    public function ubahLpse($id, $data)
    {
        $data = $this->client->request('PUT', "lpse/update/$id", [
            'form_params' => $data,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
    }

    public function hapusLpse($id)
    {
        $data = $this->client->request('DELETE', "lpse/delete/$id", $this->client->getConfig('headers'));
    }

    public $table = 'lpse';
    public $column_order = ['id_lpse', 'id_wilayah', 'id_kategori', 'id_repo', 'nama_lpse', 'alamat', 'url'];
    public $order = ['id_lpse', 'id_wilayah', 'id_kategori', 'id_repo', 'nama_lpse', 'alamat', 'url'];

    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('id_lpse', $_POST['search']['value']);
            $this->db->or_like('id_wilayah', $_POST['search']['value']);
            $this->db->or_like('id_kategori', $_POST['search']['value']);
            $this->db->or_like('id_repo', $_POST['search']['value']);
            $this->db->or_like('nama_lpse', $_POST['search']['value']);
            $this->db->or_like('alamat', $_POST['search']['value']);
            $this->db->or_like('url', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_lpse', 'ASC');
        }
    }

    public function getDataLpse()
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

    public function searchMain($keyword)
    {
        if ($keyword != '') {
            return $this->db->select('*')->like('nama_lpse', $keyword)->get('lpse');
        }
    }

    // custom get data
    public function getNamaNamaLpseById2($idLpse)
    {
        // $data = json_decode(str_replace('&quot;', '', $data), true);
        // var_dump('cek model');
        // var_dump($data);
        // die();
        $data = $this->client->request('POST', 'lpse/namaNamaLpseById', [
            'form_params' => $idLpse,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        // $data = json_decode($data->getBody()->getContents(), true);
        // return $data;
    }

    public function getNamaNamaLpseById($idLpse)
    {
        $data = $this->client->request('POST', 'lpse/namaNamaLpseById', [
            'form_params' => [
                'id_lpse' => $idLpse,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getLpseByWilKat($idWilayah, $idKategori)
    {
        $data = $this->client->request('POST', 'lpse/getLpseByWilKat', [
            'form_params' => [
                'id_wilayah' => $idWilayah,
                'id_kategori' => $idKategori,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getLpseByIdWilayah($idWilayah)
    {
        $data = $this->client->request('GET', "lpse/getByIdWilayah/$idWilayah", $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getlatlong($cariKLPD)
    {
        $data = $this->client->request('GET', "ApiLpse/getlatlong/$cariKLPD", $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }
    public function getLpseByIds($ids)
    {
        $this->db->select('id_lpse,nama_lpse')->from('lpse')->where_in('id_lpse', $ids);
        $query = $this->db->get();
        return $query->result_array();
    }
}
