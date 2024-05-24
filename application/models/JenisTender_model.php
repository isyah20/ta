<?php

defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class JenisTender_model extends CI_Model
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function getListJenisTender($keyword, $page, $limit)
    {
        return $this->db->select("id_jenis as id, jenis_tender as text")
            ->like("jenis_tender", $keyword)
            ->get("jenis_tender", $limit, $page)->result_array();
    }

    public function getJumlahListJenisTender($keyword)
    {
        return $this->db->select("id_jenis as id, jenis_tender as text")
            ->like("jenis_tender", $keyword)
            ->count_all_results("jenis_tender");
    }

    public function getAllJenisTender()
    {
        $data = $this->client->request('GET', 'jenistender', $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getJenisTenderById($id)
    {
        $data = $this->client->request('GET', "jenistender/$id", $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function tambahJenisTender($data)
    {
        $data = $this->client->request('POST', 'jenistender/create', [
            'form_params' => $data,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        // return $data;
    }

    public function ubahJenisTender($id, $data)
    {
        $data = $this->client->request('PUT', "jenistender/update/$id", [
            'form_params' => $data,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
    }

    public function hapusJenisTender($id)
    {
        $data = $this->client->request('DELETE', "jenistender/delete/$id", $this->client->getConfig('headers'));
    }

    // custom get data
    public $table = 'jenis_tender';
    public $column_order = ['id_jenis', 'jenis_tender'];
    public $order = ['id_jenis', 'jenis_tender'];

    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('id_jenis', $_POST['search']['value']);
            $this->db->or_like('jenis_tender', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_jenis', 'ASC');
        }
    }

    public function getDataJenisTender()
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

    public function getNamaNamaJenisTenderById($idJenis)
    {
        $data = $this->client->request('POST', 'jenistender/namaNamaJenisTenderById', [
            'form_params' => [
                'id_jenis' => $idJenis,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getAllByListPk(array $listTypeId = []): array
    {
        if (count($listTypeId) == 0) {
            return $this->db->select('*')->from('jenis_tender')->get()->result_array();
        }
        return $this->db->select('*')->from('jenis_tender')->where_in('id_jenis', $listTypeId)->get()->result_array();
    }
}
