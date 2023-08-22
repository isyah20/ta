<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use App\components\traits\ClientApi;

class WilayahModel extends CI_Model
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function getAllWilayah()
    {
        $response = $this->client->request('GET', 'wilayah', $this->client->getConfig('headers'));
        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    public function getWilayahById($id)
    {
        $response = $this->client->request('GET', "wilayah/$id", $this->client->getConfig('headers'));
        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }
    
    public function getListProvinsi($keyword,$page,$limit){
    	return $this->db->select("id_wilayah as id, wilayah as text")
    	                ->where('RIGHT(id_wilayah,2)','00')
    					->like("wilayah", $keyword)
    					->order_by("wilayah","asc")
    					->get("wilayah", $limit, $page)->result_array();
	}
  	
  	public function getJumlahListProvinsi($keyword){
      	return $this->db->select("id_wilayaht")
      	                ->where('RIGHT(id_wilayah,2)','00')
    					->like("wilayah", $keyword)
						->count_all_results("wilayah");
  	}
  	
  	public function getListKabupaten($prov,$keyword,$page,$limit){
    	return $this->db->select("id_wilayah as id, wilayah as text")
    	                ->where('LENGTH(id_wilayah) > ',2)
    	                ->where('RIGHT(id_wilayah,2) <> ','00')
    	                ->where('LEFT(id_wilayah,2)',substr($prov,0,2))
    					->like("wilayah", $keyword)
    					->order_by("wilayah","asc")
    					->get("wilayah", $limit, $page)->result_array();
	}
  	
  	public function getJumlahListKabupaten($prov,$keyword){
      	return $this->db->select("id_wilayah")
      	                ->where('LENGTH(id_wilayah) > ',2)
      	                ->where('RIGHT(id_wilayah,2) <> ','00')
    	                ->where('LEFT(id_wilayah,2)',substr($prov,0,2))
    					->like("wilayah", $keyword)
						->count_all_results("wilayah");
  	}

    public function tambahWilayah()
    {
        $data = [
            "wilayah" => htmlspecialchars($this->input->post('wilayah', true)),
        ];
        $response = $this->client->request('POST', 'wilayah/create', [
            'form_params' => $data,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);

        return $response;
    }

    public function getWilayahByKode($kode)
    {
        return $this->db->query("SELECT wilayah FROM wilayah WHERE id_wilayah={$kode}");
    }
    
    public function getWilayahByName($nama)
    {
        $nama = str_replace('%20', ' ', $nama);
        return $this->db->query("SELECT id_wilayah FROM wilayah WHERE wilayah='{$nama}'");
        
        /*$response = $this->client->request('POST', 'wilayah/getWilayahByName', [
            'form_params' => [
                'nama' => $nama,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $response = json_decode($response->getBody()->getContents(), true);
        return $response;*/
    }

    public function ubahWilayah($id, $data)
    {
        $data = $this->client->request('PUT', "wilayah/update/$id", [
            'form_params' => $data,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
    }

    public function hapusWilayah($id)
    {
        $response = $this->client->request('DELETE', "wilayah/delete/$id", $this->client->getConfig('headers'));

        return $response;
    }

    // custom get data
    public $table = 'wilayah';
    public $column_order = ['id_wilayah', 'wilayah'];
    public $order = ['id_wilayah', 'wilayah'];

    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('id_wilayah', $_POST['search']['value']);
            $this->db->or_like('wilayah', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_wilayah', 'ASC');
        }
    }

    public function getDataWilayah()
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

    public function getNamaNamaWilayahById($idWilayah)
    {
        // var_dump($idWilayah);
        // die();
        $data = $this->client->request('POST', 'wilayah/namaNamaWilayahById', [
            'form_params' => [
                'id_wilayah' => $idWilayah,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        // var_dump($data);
        return $data;
    }
}
