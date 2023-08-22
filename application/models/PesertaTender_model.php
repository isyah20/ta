<?php

defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class PesertaTender_model extends CI_Model
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function getPesertaTenderByTender()
    {
        $this->db->select(['peserta.nama_peserta, COUNT(peserta_tender.id_tender) AS jumlah_tender']);
        $this->db->from('peserta_tender');
        $this->db->join('peserta', 'peserta.npwp = peserta_tender.npwp');
        $this->db->group_by('peserta_tender.npwp');
        $this->db->order_by('COUNT(peserta_tender.id_tender)', 'desc');
        $this->db->limit('10');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllPesertaTender()
    {
        $data = $this->client->request('GET', 'pesertatender', $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getPesertaTenderById($id)
    {
        $data = $this->client->request('GET', "pesertatender/$id", $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function tambahPesertaTender($data)
    {
        $data = $this->client->request('POST', 'pesertatender/create', [
            'form_params' => $data,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        // $data = json_decode($data->getBody()->getContents(), true);
        // return $data;
    }

    public function ubahPesertaTender($id, $data)
    {
        $data = $this->client->request('PUT', "pesertatender/update/$id", [
            'form_params' => $data,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
    }

    public function hapusPesertaTender($id)
    {
        $data = $this->client->request('DELETE', "pesertatender/delete/$id", $this->client->getConfig('headers'));
    }

    // custom get data
    public $table = 'peserta_tender';
    public $column_order = ['id_peserta_tender', 'id_tender', 'npwp', 'harga_penawaran', 'harga_terkoreksi'];
    public $order = ['id_peserta_tender', 'id_tender', 'npwp', 'harga_penawaran', 'harga_terkoreksi'];

    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('id_peserta_tender', $_POST['search']['value']);
            $this->db->or_like('id_tender', $_POST['search']['value']);
            $this->db->or_like('npwp', $_POST['search']['value']);
            $this->db->or_like('harga_penawaran', $_POST['search']['value']);
            $this->db->or_like('harga_terkoreksi', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_peserta_tender', 'ASC');
        }
    }

    public function getDataPesertaTender()
    {
        $this->_get_data_query();
        // var_dump($this->_get_data_query());
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getFilterTender($npwp, $klpd, $tahun)
    {
        $data = [];
        try {
            $resp = $this->client->request('POST', 'pesertatender/filter', [
                'form_params' => [
                    'npwp' => $npwp,
                    'klpd' => $klpd,
                    'tahun' => $tahun,
                ],
                'auth' => $this->client->getConfig('headers')['auth'],
            ]);
            if ($resp->getStatusCode() == 200) {
                $data = json_decode($resp->getBody()->getContents(), true);
            }
        } catch (\Exception $ex) {
            log_message('error', 'error req ke pesertatender/filter: ' . $ex->getMessage());
        }
        return $data;
    }

    // function url_get_contents($url, $data)
    // {
    //     if (!function_exists('curl_init')) {
    //         die('CURL is not installed!');
    //     }

    //     $ch = curl_init();
    //     $post = [
    //         'npwp' => $data['npwp'],
    //         'klpd' => $data['klpd'],
    //         'tahun' => $data['tahun'],
    //     ];

    //     $username = 'beetend';
    //     $password = '76oZ8XuILKys5';
    //     $urlfull = base_url('api/');
    //     curl_setopt($ch, CURLOPT_URL, $urlfull.$url);
    //     curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
    //     curl_setopt_array($ch, array(CURLOPT_RETURNTRANSFER => TRUE));
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    //     $output = curl_exec($ch);
    //     curl_close($ch);
    //     return $output;
    //     // var_dump($output);
    // }

    public function getFilterHps($npwp, $klpd, $tahun)
    {
        $data = [];
        try {
            $resp = $this->client->request('POST', 'pesertatender/filterhps', [
                'form_params' => [
                    'npwp' => $npwp,
                    'klpd' => $klpd,
                    'tahun' => $tahun,
                ],
                'auth' => $this->client->getConfig('headers')['auth'],
            ]);
            if ($resp->getStatusCode() == 200) {
                $data = json_decode($resp->getBody()->getContents(), true);
            }
        } catch (\Exception $ex) {
        }
        return $data;
    }

    // pakai cURL
    // public function getFilterHps($npwp, $klpd, $tahun)
    // {
    //     $data = [
    //         'npwp' => $npwp,
    //         'klpd' => $klpd,
    //         'tahun' => $tahun
    //     ];
    //     $url = 'pesertatender/filterhps';
    //     $response = json_decode($this->url_get_contents($url, $data));
    //     return $response;
    // }

    // public function getFilterTender($npwp, $klpd, $tahun)
    // {
    //     $data = [
    //         'npwp' => $npwp,
    //         'klpd' => $klpd,
    //         'tahun' => $tahun
    //     ];

    //     // var_dump($data);
    //     // die();
    //     $url = 'pesertatender/filter';
    //     $response = json_decode($this->url_get_contents($url, $data));
    //     // return $response;

    // }

    public function getFilterPenurunan($npwp, $klpd, $tahun)
    {
        $data = $this->client->request('POST', 'pesertatender/filterpenurunan', [
            'form_params' => [
                'npwp' => $npwp,
                'klpd' => $klpd,
                'tahun' => $tahun,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function pesertaCompetitor($npwp)
    {
        $data = $this->client->request('POST', 'pesertacompetitor', [
            'form_params' => [
                'npwp' => $npwp,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    // public function getFilterAkumulasi($npwp, $klpd, $tahun)
    // {
    // 	$data = $this->client->request('POST', 'pesertatender/filterakumulasi', [
    // 		'form_params' => [
    //             'npwp' =>$npwp,
    // 			'klpd' => $klpd,
    //             'tahun' => $tahun,
    // 		],
    // 		'auth' =>  $this->client->getConfig('headers')['auth'],
    // 	]);
    // 	$data = json_decode($data->getBody()->getContents(), true);
    // 	return $data;
    // }

    public function getFilterTotal($npwp, $klpd, $tahun)
    {
        $data = null;
        try {
            $data = $this->client->request('POST', 'pesertatender/filterakumulasi', [
                'form_params' => [
                    'npwp' => $npwp,
                    'klpd' => $klpd,
                    'tahun' => $tahun,
                ],
                'auth' => $this->client->getConfig('headers')['auth'],
            ]);
        } catch (\Exception $ex) {
        }
        return $data;
    }

    public function getFilterKlpd($npwp, $klpd)
    {
        $data = $this->client->request('POST', 'pesertatender/filterklpd', [
            'form_params' => [
                'npwp' => $npwp,
                'klpd' => $klpd,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
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

    // Know Your Market
    public function getPesertaTenderByLpse($klpd, $jenisPengadaan, $hps, $tahun)
    {
        $data = $this->client->request('POST', 'pesertatender/getByLpse', [
            'form_params' => [
                'klpd' => $klpd,
                'jenisPengadaan' => $jenisPengadaan,
                'hps' => $hps,
                'tahun' => $tahun,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getPemenang($tahun)
    {
        $data = $this->client->request('POST', 'pesertatender/getPemenang', [
            'form_params' => [
                'tahun' => $tahun,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getPenawar($tahun)
    {
        $data = $this->client->request('POST', 'pesertatender/getPenawar', [
            'form_params' => [
                'tahun' => $tahun,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getPeserta($tahun)
    {
        $data = $this->client->request('POST', 'pesertatender/getPeserta', [
            'form_params' => [
                'tahun' => $tahun,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getPesertaMenawarPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    {
        $data = $this->client->request('POST', 'pesertatender/menawarPerMonthByLpse', [
            'form_params' => [
                'klpd' => $klpd,
                'jenisPengadaan' => $jenisPengadaan,
                'hps' => $hps,
                'tahun' => $tahun,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }
    public function getPesertaMendaftarPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    {
        // var_dump($klpd);
        $data = $this->client->request('POST', 'pesertatender/mendaftarPerMonthByLpse', [
            'form_params' => [
                'klpd' => $klpd,
                'jenisPengadaan' => $jenisPengadaan,
                'hps' => $hps,
                'tahun' => $tahun,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }
    // public function getPesertaMenawarPerMonth()
    // {
    //     $this->db->select('COUNT(npwp) as jumlah_peserta, tender.tgl_pembuatan as bulan');
    //     $this->db->from('peserta_tender');
    //     $this->db->join('tender', 'peserta_tender.id_tender = tender.id_tender');
    //     $this->db->where('peserta_tender.harga_penawaran !=', 0);
    //     $this->db->group_by('DATE_FORMAT(tender.tgl_pembuatan, "%m%y")');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    // public function getPesertaMendaftarPerMonth()
    // {
    //     $this->db->select('COUNT(npwp) as jumlah_peserta, tender.tgl_pembuatan as bulan');
    //     $this->db->from('peserta_tender');
    //     $this->db->join('tender', 'peserta_tender.id_tender = tender.id_tender');
    //     $this->db->where('peserta_tender.harga_penawaran =', 0);
    //     $this->db->group_by('DATE_FORMAT(tender.tgl_pembuatan, "%m%y")');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    public function searchMain($keyword)
    {
        if ($keyword != '') {
            $this->db->select('peserta_tender.*,peserta_tender.npwp as npwp_peserta, peserta.nama_peserta, hasil_evaluasi.*');
            $this->db->from('peserta_tender');
            $this->db->join('peserta', 'peserta_tender.npwp = peserta.npwp');
            $this->db->join('hasil_evaluasi', 'peserta_tender.npwp = hasil_evaluasi.npwp');
            $this->db->like('peserta.nama_peserta', $keyword);
            $this->db->group_by('peserta_tender.npwp');
            $this->db->order_by('peserta_tender.harga_penawaran DESC');
            $this->db->order_by('peserta_tender.harga_terkoreksi DESC');
            $this->db->order_by('peserta.nama_peserta ASC');
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function getPemenangTender()
    {
        $query = "SELECT COUNT(id_pemenang) FROM pemenang";

        return $this->db->query($query)->raw();
    }
}
