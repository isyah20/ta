<?php

defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;
use GuzzleHttp\Exception\ClientException;

class Market extends CI_Controller
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != 2) {
            redirect('login');
        }
        $this->load->model('Tender_model');
        $this->load->model('KategoriLpse_model');
        $this->load->model('Lpse_model');
        $this->load->model('JenisTender_model');
        $this->load->model('WilayahModel');
        $this->load->model('PesertaTender_model');
        $this->load->model('Peserta_model');
        $this->load->model('Pemenang_model');
        $this->load->model('Pengguna_model');
        $this->load->model('Preferensi_model');
        $this->load->model('Paket_model');
        $this->init();
    }

    public function index()
    {
        $id = $this->session->userdata('user_data')['id_pengguna'];

        $idWilayahDef = null;

        // get jenis_pengadaan
        $pengguna = $this->Pengguna_model->getPenggunaById($id);

        if ($pengguna['status'] !== false) {
            $alamatExplode = explode(' ', preg_replace("/[^a-zA-Z' ']/", "", $pengguna['data']['alamat']));
            // var_dump($alamatExplode);
            $i = 0;
            foreach ($alamatExplode as $alamat) {
                $wilayahByName = null;
                try {
                    $wilayahByName = $this->WilayahModel->getWilayahByName($alamat);
                } catch (ClientException $e) {
                    $wilayahByName = null;
                }

                if ($wilayahByName != null && count($wilayahByName['data']) == 2) {
                    if (count($wilayahByName['data']) > 1) {
                        $alamatFind = $alamatExplode[$i - 1];
                        if (strtolower($alamatFind) == 'kabupaten') {
                            $alamatFind = 'kab';
                        }
                        $alamatFind = strtolower($alamatFind);
                        foreach ($wilayahByName['data'] as $wilayahFind) {
                            if ($alamatFind == 'kab' || $alamatFind == 'kota') {
                                if (fnmatch("$alamatFind*", strtolower($wilayahFind['wilayah'])) == true) {
                                    $idWilayahDef = $wilayahFind['id_wilayah'];
                                    break;
                                } else {
                                    $idWilayahDef = $wilayahByName['data'][1]['id_wilayah'];
                                    break;
                                }
                            }
                        }
                        // }
                    }
                } elseif ($wilayahByName != null && count($wilayahByName['data']) <= 1) {
                    $idWilayahDef = $wilayahByName['data'][0]['id_wilayah'];
                    break;
                }

                $i++;
            }
        }
        $idLpse = null;
        try {
            $idLpse = $this->Lpse_model->getLpseByIdWilayah($idWilayahDef);
        } catch (ClientException $e) {
            $idLpse = null;
        }
        $arrayIdLpse = [];
        if ($idLpse !== null) {
            foreach ($idLpse['data'] as $idLpse) {
                $arrayIdLpse[] = $idLpse['id_lpse'];
            }
        }

        $data = [];
        $data['cariKLPD'] = '["' . implode('","', $arrayIdLpse) . '"]';

        $pengguna = $this->Pengguna_model->getPenggunaById($id);
        $idLpse = null;
        $arrayIdLpse = [];
        if ($idLpse !== null) {
            foreach ($idLpse['data'] as $idLpse) {
                $arrayIdLpse[] = $idLpse['id_lpse'];
            }
        } else {
            $lpse = $this->Lpse_model->getLpseById(11);
            //print_r($lpse);
        }

        $jan = [];
        $feb = [];
        $mar = [];
        $apr = [];
        $mei = [];
        $jun = [];
        $jul = [];
        $ags = [];
        $sep = [];
        $okt = [];
        $nov = [];
        $des = [];
        $paket = $this->Paket_model->getAllPaket();
        foreach ($paket['data'] as $val) {
            $month = date('m', strtotime($val['tanggal_pembuatan']));
            if ($month == "01") {
                $jan[] = $val['nilai_hps_paket'];
            } elseif ($month == "02") {
                $feb[] = $val['nilai_hps_paket'];
            } elseif ($month == "03") {
                $mar[] = $val['nilai_hps_paket'];
            } elseif ($month == "04") {
                $apr[] = $val['nilai_hps_paket'];
            } elseif ($month == "05") {
                $mei[] = $val['nilai_hps_paket'];
            } elseif ($month == "06") {
                $jun[] = $val['nilai_hps_paket'];
            } elseif ($month == "07") {
                $jul[] = $val['nilai_hps_paket'];
            } elseif ($month == "08") {
                $ags[] = $val['nilai_hps_paket'];
            } elseif ($month == "09") {
                $sep[] = $val['nilai_hps_paket'];
            } elseif ($month == "10") {
                $okt[] = $val['nilai_hps_paket'];
            } elseif ($month == "11") {
                $nov[] = $val['nilai_hps_paket'];
            } else {
                $des[] = $val['nilai_hps_paket'];
            }
            //$allHps[] = ["tanggal" => $val['tanggal_pembuatan'], "nilai_hps" => $val['nilai_hps_paket']];
        }

        $getPesertaTenderByLpse = $this->PesertaTender_model->getPesertaTenderByLpse($lkpd = null, $jenisPengadaan = null, $hps = null, date('Y'));
        $jan3 = [];
        $feb3 = [];
        $mar3 = [];
        $apr3 = [];
        $mei3 = [];
        $jun3 = [];
        $jul3 = [];
        $ags3 = [];
        $sep3 = [];
        $okt3 = [];
        $nov3 = [];
        $des3 = [];

        if ($getPesertaTenderByLpse['status'] !== false) {
            foreach ($getPesertaTenderByLpse['data'] as $val) {
                $month = date('m', strtotime($val['tanggal_pembuatan']));
                if ($month == "01") {
                    $jan3[] = $val['id_lpse'];
                } elseif ($month == "02") {
                    $feb3[] = $val['id_lpse'];
                } elseif ($month == "03") {
                    $mar3[] = $val['id_lpse'];
                } elseif ($month == "04") {
                    $apr3[] = $val['id_lpse'];
                } elseif ($month == "05") {
                    $mei3[] = $val['id_lpse'];
                } elseif ($month == "06") {
                    $jun3[] = $val['id_lpse'];
                } elseif ($month == "07") {
                    $jul3[] = $val['id_lpse'];
                } elseif ($month == "08") {
                    $ags3[] = $val['id_lpse'];
                } elseif ($month == "09") {
                    $sep3[] = $val['id_lpse'];
                } elseif ($month == "10") {
                    $okt3[] = $val['id_lpse'];
                } elseif ($month == "11") {
                    $nov3[] = $val['id_lpse'];
                } else {
                    $des3[] = $val['id_lpse'];
                }
            }
        }

        $dataHps = [
            array_sum($jan),
            array_sum($feb),
            array_sum($mar),
            array_sum($apr),
            array_sum($mei),
            array_sum($jun),
            array_sum($jul),
            array_sum($ags),
            array_sum($sep),
            array_sum($okt),
            array_sum($nov),
            array_sum($des),
        ];

        $dataLpse = [
            array_sum($jan3),
            array_sum($feb3),
            array_sum($mar3),
            array_sum($apr3),
            array_sum($mei3),
            array_sum($jun3),
            array_sum($jul3),
            array_sum($ags3),
            array_sum($sep3),
            array_sum($okt3),
            array_sum($nov3),
            array_sum($des3),
        ];

        $pemenangTender = $this->PesertaTender_model->getPemenang(date('Y'));
        $penawarTender = $this->PesertaTender_model->getPenawar(date('Y'));
        $pesertaTender = $this->PesertaTender_model->getPeserta(date('Y'));

        $dataStatistik = [
            'lpse' => $data['cariKLPD'],
            'hpsData' => json_encode($dataHps),
            'lpseData' => json_encode($dataLpse),
            'pemenang' => $pemenangTender['status'] == true ? $pemenangTender['data'][0]['pemenang'] : '0',
            'penawar' => $penawarTender['status'] == true ? $penawarTender['data'][0]['penawar'] : '0',
            'peserta' => $pesertaTender['status'] == true ? $pesertaTender['data'][0]['peserta'] : '0',
        ];

        // $namaLspe = array();
        $chart1 = [];
        $chart1_1 = [];
        $chart1_2 = [];
        $chart1_3 = [];
        $chart2_1 = [];
        $chart2_2 = [];
        $chart2_3 = [];
        $chart3_1 = [];
        $chart3_2 = [];
        $chart3_3 = [];

        $this->load->library('user');
        $data = [
            'title' => 'Know Your Market',
            // 'wilayah' => $wilayah['data'],
            //'lpse' => $data['cariKLPD'],
            // 'jenisPengadaan' => $jenisPengadaan['data'],
            'idWilayah' => $idWilayahDef,
            'chart1' => json_encode($chart1),
            'chart1_1' => json_encode($chart1_1),
            'chart1_2' => json_encode($chart1_2),
            'chart1_3' => json_encode($chart1_3),
            'chart2_1' => json_encode($chart2_1),
            'chart2_2' => json_encode($chart2_2),
            'chart2_3' => json_encode($chart2_3),
            'chart3_1' => json_encode($chart3_1),
            'chart3_2' => json_encode($chart3_2),
            'chart3_3' => json_encode($chart3_3),
            'photo' => $this->user->getPhotoProfile((int) $id, $this->db),
            'userStatus' => (int) $this->session->user_data['status'],
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('statistik/market', $dataStatistik);
        $this->load->view('profile_pengguna/templates/navbar', [
            'photo' => $this->user->getPhotoProfile((int) $id, $this->db),
            'userStatus' => (int) $this->session->user_data['status'],
        ]);
        $this->load->view('templates/footer');
    }

    public function getWilayah()
    {
        $lpse = $this->WilayahModel->getAllWilayah();

        $search = $this->input->get();
        if ($this->input->get()) {
            $search = $search['q'];
        } else {
            $search = "";
        }
        // var_dump("*".$search."*");

        $json = [];
        $data = [];
        if ($lpse['status'] !== false) {
            foreach ($lpse['data'] as $lpse) {
                // var_dump("*$search*");
                if (fnmatch("*$search*", strtolower($lpse['wilayah'])) == true) {
                    $data[] = [
                        'id' => $lpse['id_wilayah'],
                        'text' => $lpse['wilayah'],
                    ];
                }
            }
        }
        // $pagination = array(
        // 	"more" => true
        // );
        $json = [
            'results' => $data,
            // "pagination" => $pagination
        ];

        // var_dump(json_encode($json));

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function getLpse()
    {
        $lpse = $this->Lpse_model->getAllLpse();

        $search = $this->input->get();
        if ($this->input->get()) {
            $search = $search['q'];
        } else {
            $search = "";
        }
        // var_dump("*".$search."*");

        $json = [];
        $data = [];

        if ($lpse['status'] !== false) {
            foreach ($lpse['data'] as $lpse) {
                // var_dump("*$search*");
                if (fnmatch("*$search*", strtolower($lpse['nama_lpse'])) == true) {
                    $data[] = [
                        'id' => $lpse['id_lpse'],
                        'text' => $lpse['nama_lpse'],
                    ];
                }
            }
        }
        // $pagination = array(
        // 	"more" => true
        // );
        $json = [
            'results' => $data,
            // "pagination" => $pagination
        ];

        // var_dump(json_encode($json));

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function getJenisPengadaan()
    {
        $jenisPengadaan = $this->JenisTender_model->getAllJenisTender();

        $search = $this->input->get();
        if ($this->input->get()) {
            $search = $search['q'];
        } else {
            $search = "";
        }
        // var_dump("*".$search."*");

        $json = [];
        $data = [];

        if ($jenisPengadaan['status'] !== false) {
            foreach ($jenisPengadaan['data'] as $jenisPengadaan) {
                // var_dump("*$search*");
                if (fnmatch("*$search*", strtolower($jenisPengadaan['jenis_tender'])) == true) {
                    $data[] = [
                        'id' => $jenisPengadaan['id_jenis'],
                        'text' => $jenisPengadaan['jenis_tender'],
                    ];
                }
            }
        }
        // $pagination = array(
        // 	"more" => true
        // );
        $json = [
            'results' => $data,
            // "pagination" => $pagination
        ];

        // var_dump(json_encode($json));

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function getLpseWil()
    {
        $idWilayah = $this->uri->segment(3);

        $lpse = $this->Lpse_model->getLpseByIdWilayah($idWilayah);

        $search = $this->input->get();
        if ($this->input->get()) {
            $search = $search['q'];
        } else {
            $search = "";
        }

        $json = [];
        $data = [];
        if ($lpse['status'] !== false) {
            foreach ($lpse['data'] as $lpse) {
                // var_dump("*$search*");
                if (fnmatch("*$search*", strtolower($lpse['nama_lpse'])) == true) {
                    $data[] = [
                        'id' => $lpse['id_lpse'],
                        'text' => $lpse['nama_lpse'],
                    ];
                }
            }
        }

        $json = [
            'results' => $data,
            // "pagination" => $pagination
        ];
        // $json = array(
        // 	'lpse' => $lpse['data'],
        // );

        // var_dump($json);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function chart()
    {
        $data = $this->input->post();

        $klpd = str_replace('"', '', $data['cariKLPD']);
        $jenisPengadaan = str_replace('"', '', $data['cariJenisPengadaan']);
        $tahunC1 = str_replace('"', '', $data['cariTahunC1']);
        if ($data != null) {
            $tahunC1 = str_replace('"', '', $data['cariTahunC1']);
            $tahunC2 = str_replace('"', '', $data['cariTahunC2']);
            $tahunC3 = str_replace('"', '', $data['cariTahunC3']);
            $hpsPerMonth = $this->Paket_model->getHpsPerMonth($klpd, $jenisPengadaan, $tahunC1);
            //var_dump($hpsPerMonth);die;
            $chart1 = null;
            $jan = [];
            $feb = [];
            $mar = [];
            $apr = [];
            $mei = [];
            $jun = [];
            $jul = [];
            $ags = [];
            $sep = [];
            $okt = [];
            $nov = [];
            $des = [];
            if ($hpsPerMonth['status'] !== false) {
                foreach ($hpsPerMonth['data'] as $val) {
                    $month = date('m', strtotime($val['tanggal_pembuatan']));
                    if ($month == "01") {
                        $jan[] = $val['nilai_hps_paket'];
                    } elseif ($month == "02") {
                        $feb[] = $val['nilai_hps_paket'];
                    } elseif ($month == "03") {
                        $mar[] = $val['nilai_hps_paket'];
                    } elseif ($month == "04") {
                        $apr[] = $val['nilai_hps_paket'];
                    } elseif ($month == "05") {
                        $mei[] = $val['nilai_hps_paket'];
                    } elseif ($month == "06") {
                        $jun[] = $val['nilai_hps_paket'];
                    } elseif ($month == "07") {
                        $jul[] = $val['nilai_hps_paket'];
                    } elseif ($month == "08") {
                        $ags[] = $val['nilai_hps_paket'];
                    } elseif ($month == "09") {
                        $sep[] = $val['nilai_hps_paket'];
                    } elseif ($month == "10") {
                        $okt[] = $val['nilai_hps_paket'];
                    } elseif ($month == "11") {
                        $nov[] = $val['nilai_hps_paket'];
                    } else {
                        $des[] = $val['nilai_hps_paket'];
                    }
                }
                $chart1 = [
                    array_sum($jan),
                    array_sum($feb),
                    array_sum($mar),
                    array_sum($apr),
                    array_sum($mei),
                    array_sum($jun),
                    array_sum($jul),
                    array_sum($ags),
                    array_sum($sep),
                    array_sum($okt),
                    array_sum($nov),
                    array_sum($des),
                ];
            } else {
                $chart1 = null;
            }
            $this->output->set_output(json_encode($chart1));
        }
    }

    public function getPesertaByLpse()
    {
        $data = $this->input->post();
        $getPesertaTenderByLpse = $this->PesertaTender_model->getPesertaTenderByLpse($data['cariKLPD'], $data['cariJenisPengadaan'], $data['cariHPS'], $data['cariTahunC3']);
        $chart3 = [];
        $jan = [];
        $feb = [];
        $mar = [];
        $apr = [];
        $mei = [];
        $jun = [];
        $jul = [];
        $ags = [];
        $sep = [];
        $okt = [];
        $nov = [];
        $des = [];

        if ($getPesertaTenderByLpse['status'] !== false) {
            foreach ($getPesertaTenderByLpse['data'] as $val) {
                $month = date('m', strtotime($val['tanggal_pembuatan']));
                if ($month == "01") {
                    $jan[] = $val['id_lpse'];
                } elseif ($month == "02") {
                    $feb[] = $val['id_lpse'];
                } elseif ($month == "03") {
                    $mar[] = $val['id_lpse'];
                } elseif ($month == "04") {
                    $apr[] = $val['id_lpse'];
                } elseif ($month == "05") {
                    $mei[] = $val['id_lpse'];
                } elseif ($month == "06") {
                    $jun[] = $val['id_lpse'];
                } elseif ($month == "07") {
                    $jul[] = $val['id_lpse'];
                } elseif ($month == "08") {
                    $ags[] = $val['id_lpse'];
                } elseif ($month == "09") {
                    $sep[] = $val['id_lpse'];
                } elseif ($month == "10") {
                    $okt[] = $val['id_lpse'];
                } elseif ($month == "11") {
                    $nov[] = $val['id_lpse'];
                } else {
                    $des[] = $val['id_lpse'];
                }
            }

            $chart3['lpse'] = [
                array_sum($jan),
                array_sum($feb),
                array_sum($mar),
                array_sum($apr),
                array_sum($mei),
                array_sum($jun),
                array_sum($jul),
                array_sum($ags),
                array_sum($sep),
                array_sum($okt),
                array_sum($nov),
                array_sum($des),
            ];
        }

        $pemenangTender = $this->PesertaTender_model->getPemenang($data['cariTahunC3']);
        $penawarTender = $this->PesertaTender_model->getPenawar($data['cariTahunC3']);
        $pesertaTender = $this->PesertaTender_model->getPeserta($data['cariTahunC3']);
        $chart3['pemenang'] = $pemenangTender['status'] == true ? $pemenangTender['data'][0]['pemenang'] : '0';
        $chart3['penawar'] = $penawarTender['status'] == true ? $penawarTender['data'][0]['penawar'] : '0';
        $chart3['peserta'] = $pesertaTender['status'] == true ? $pesertaTender['data'][0]['peserta'] : '0';

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($chart3));
    }
}
