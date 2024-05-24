<?php

defined('BASEPATH') or exit('No direct script access allowed');

use App\components\CompanyType;
use App\components\traits\ClientApi;
use GuzzleHttp\Client;

class Preferensi_model extends CI_Model
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function getAllPreferensi()
    {
        $data = $this->client->request('GET', 'preferensi', $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getPreferensiById($id)
    {
        $data = $this->client->request('GET', 'preferensi/' . $id, $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        // $data = $this->client->request('GET', "preferensi/byIdUser/$id", $this->client->getConfig('headers'));
        // $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }
    
    public function getPreferensiPengguna($id)
    {
        return $this->db->query("SELECT id_preferensi,keyword,id_lpse,jenis_pengadaan,nilai_hps_awal,nilai_hps_akhir FROM preferensi WHERE id_pengguna={$id}");
    }
    
    public function getPreferensiListJenisTender($jenis)
    {
        if ($jenis == '1') $id_jenis = '3,4,7,8'; //badan usaha
        else if ($jenis == '2') $id_jenis = '5,6,7'; //perorangan
        else if ($jenis == '3') $id_jenis = '1,2,7,8'; //kontraktor
        else $id_jenis = '1,2,3,4,5,6,7,8';
        
        return $this->db->query("SELECT * FROM jenis_tender WHERE id_jenis IN({$id_jenis})");
    }
    
    public function getPreferensiJenisTender($id)
    {
        return $this->db->query("SELECT jenis_tender FROM jenis_tender WHERE id_jenis={$id}");
    }
    
    public function getPreferensiListLPSE()
    {
        return $this->db->query("SELECT id_lpse,nama_lpse FROM lpse ORDER BY nama_lpse ASC");
    }

    public function getPreferensiByUserId(int $userId)
    {
        $this->db->select('preferensi.*, pengguna.nama, pengguna.email, pengguna.npwp, pengguna.kategori, pengguna.status');
        $this->db->from('preferensi');
        $this->db->join('pengguna', 'preferensi.id_pengguna = pengguna.id_pengguna');
        $this->db->where('preferensi.id_pengguna', $userId);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPreferensiByIdUser($id)
    {
        $data = $this->client->request('GET', 'preferensi/byIdUser/' . $id, $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }
    // public function getPreferensiByIdUser($id)
    // {
    //     // return $id;
    //     // $data = $this->client->request('GET', 'preferensi/'. $id, $this->client->getConfig('headers'));
    //     // $data = json_decode($data->getBody()->getContents(), true);
    //     $data = $this->client->request('GET', "preferensi/byIdUser/$id", $this->client->getConfig('headers'));
    //     $data = json_decode($data->getBody()->getContents(), true);
    //     return $data;
    // }

    public $table = 'preferensi';
    public $column_order = ['id_preferensi', 'id_pengguna', 'id_kategori_lpse', 'id_lpse', 'provinsi', 'kabupaten', 'id_jenis_tender', 'kualifikasi', 'nilai_hps', 'tgl_update'];
    public $order = ['id_preferensi', 'id_pengguna', 'id_kategori_lpse', 'id_lpse', 'provinsi', 'kabupaten', 'id_jenis_tender', 'kualifikasi', 'nilai_hps', 'tgl_update'];

    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('id_preferensi', $_POST['search']['value']);
            $this->db->or_like('id_pengguna', $_POST['search']['value']);
            $this->db->or_like('id_kategori_lpse', $_POST['search']['value']);
            $this->db->or_like('id_lpse', $_POST['search']['value']);
            // $this->db->or_like('provinsi', $_POST['search']['value']);
            // $this->db->or_like('kabupaten', $_POST['search']['value']);
            $this->db->or_like('id_jenis_tender', $_POST['search']['value']);
            $this->db->or_like('kualifikasi', $_POST['search']['value']);
            $this->db->or_like('nilai_hps', $_POST['search']['value']);
            $this->db->or_like('tgl_update', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_preferensi', 'ASC');
        }
    }

    public function getDataPreferensi()
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

    public function getOneByUserId(int $userId, bool $asArray = true)
    {
        $this->db->select('preferensi.*, pengguna.nama, pengguna.email, pengguna.npwp, pengguna.kategori, pengguna.status');
        $this->db->from('preferensi');
        $this->db->join('pengguna', 'preferensi.id_pengguna = pengguna.id_pengguna');
        $this->db->where('preferensi.id_pengguna', $userId);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($asArray) {
            return $query->result_array();
        }
        return $query->row();
    }

    public function getListTypeOfTenderByCompanyType(int $compType): array
    {
        $businessEnt = [3, 4, 8]; // JK. Badan Usaha
        $personal = [5, 6, 8]; // JK. Perorangan
        $constructionWork = [1, 2, 7, 8]; // Pekerjaan Konstruksi

        if ($compType == CompanyType::ENT_BUSINESS_CONSULTANT) {
            return $businessEnt;
        } elseif ($compType == CompanyType::PERSONAL_CONSULTANT) {
            return $personal;
        } elseif ($compType == CompanyType::CONTRACTOR) {
            return $constructionWork;
        }

        return [];
    }

    public function getProcurementCategory(int $companyType, array $listTenderType = [])
    {
        $businessEnt = [3, 4, 8]; // JK. Badan Usaha
        $personal = [5, 6, 8]; // JK. Perorangan
        $constructionWork = [1, 2, 7, 8]; // Pekerjaan Konstruksi
        if ($companyType == 0) {
            $result = [];
            foreach ($listTenderType as $val) {
                $result[] = ['id_jenis' => $val['id_jenis'], 'jenis_tender' => $val['jenis_tender']];
            }
            return $result;
        }

        $result = 0;
        foreach ($listTenderType as $val) {
            if ($companyType == CompanyType::ENT_BUSINESS_CONSULTANT) {
                if (in_array($val['id_jenis'], $businessEnt)) {
                    $result[] = ['id_jenis' => $val['id_jenis'], 'jenis_tender' => $val['jenis_tender']];
                }
            } elseif ($companyType == CompanyType::PERSONAL_CONSULTANT) {
                if (in_array($val['id_jenis'], $personal)) {
                    $result[] = ['id_jenis' => $val['id_jenis'], 'jenis_tender' => $val['jenis_tender']];
                }
            } elseif ($companyType == CompanyType::CONTRACTOR) {
                if (in_array($val['id_jenis'], $constructionWork)) {
                    $result[] = ['id_jenis' => $val['id_jenis'], 'jenis_tender' => $val['jenis_tender']];
                }
            }
        }
        return $result;
    }
}
