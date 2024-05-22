<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\components\UserCategory;
use App\components\CompanyType;

class Competitor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $companyType = 0;
        if ($this->session->userdata('user_data') != null && isset($this->session->user_data['jenis_perusahaan'])) {
            $companyType = (int) $this->session->user_data['jenis_perusahaan'];
        }

        if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != UserCategory::SRV_PROVIDER) {
            redirect('login');
        }

        // Jika jenis perusahaan bukan konsultan badan usaha maka redirect ke home
        if ($companyType != CompanyType::ENT_BUSINESS_CONSULTANT) {
            redirect('home');
        }

        $this->load->model('Lpse_model');
        // $this->load->model('Peserta_model');
        $this->load->model('Tender_model');
        $this->load->model('PesertaTender_model');
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => base_url() . 'api/',
            // You can set any number of default request options.
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
    }

    // public function index()
    // {
    //     //get LPSE
    //     $lpse = $this->client->request('GET', 'lpse', $this->client->getConfig('headers'));

    //     //get npwp
    //     try {
    //         $penggunas = $this->client->request('GET', 'pengguna/' . $this->session->user_data['id_pengguna'], $this->client->getConfig('headers'));
    //         $pengguna = json_decode($penggunas->getBody()->getContents(), true)['data'];
    //         if ($pengguna['npwp'] != null) {
    //             $npwp = $pengguna['npwp'];
    //         } else {
    //             $npwp = '0';
    //         }
    //     } catch (ClientException $e) {
    //     }

    //     //get peserta
    //     $peserta = $this->PesertaTender_model->pesertaCompetitor($npwp);

    //     if ($peserta['status'] != false) {
    //         $peserta = $peserta['data'];
    //         $npwp = $peserta['0']['npwp'];
    //     } else {
    //         $peserta = [];
    //         $npwp = '0';
    //     }

    //     $tahun = (int) date('Y');

    //     // $response = $this->PesertaTender_model->getFilterTender($npwp, "", $tahun);

    //     // if ($response['status'] !=  false) {
    //     // 	$monthly = $response['data'];
    //     // 	$timeSeries = array();

    //     // 	for ($i = 0; $i < 12; $i++) {
    //     // 		$timeSeries[$i] = 0;
    //     // 		foreach ($monthly as $bulan) {
    //     // 			if ($bulan['month'] == $i + 1) {
    //     // 				$timeSeries[$i]++;
    //     // 			}
    //     // 		}
    //     // 	}
    //     // } else {
    //     // 	$timeSeries = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    //     // }

    //     // //get tender by hps (hps competitor)
    //     // $hps = $this->PesertaTender_model->getFilterHps($npwp, "", $tahun);

    //     // if ($hps['status'] !== false) {
    //     // 	$hps = $hps['data'];
    //     // 	$range  = array();
    //     // 	$range1 = array();
    //     // 	$range2 = array();
    //     // 	$range3 = array();
    //     // 	$range4 = array();
    //     // 	$range5 = array();

    //     // 	for ($i = 0; $i < 12; $i++) {
    //     // 		$hps1 = 0;
    //     // 		$hps2 = 0;
    //     // 		$hps3 = 0;
    //     // 		$hps4 = 0;
    //     // 		$hps5 = 0;
    //     // 		foreach ($hps as $range) {
    //     // 			if ($range['month'] == $i + 1) {
    //     // 				if ($range['nilai_hps'] < 500000000) {
    //     // 					$hps1++;
    //     // 				} else if ($range['nilai_hps'] >= 500000000 && $range['nilai_hps'] < 1000000000) {
    //     // 					$hps2++;
    //     // 				} else if ($range['nilai_hps'] >= 1000000000 && $range['nilai_hps'] < 10000000000) {
    //     // 					$hps3++;
    //     // 				} else if ($range['nilai_hps'] >= 10000000000 && $range['nilai_hps'] < 100000000000) {
    //     // 					$hps4++;
    //     // 				} else if ($range['nilai_hps'] >= 100000000000) {
    //     // 					$hps5++;
    //     // 				}
    //     // 			}
    //     // 		}
    //     // 		$range1[] = $hps1;
    //     // 		$range2[] = $hps2;
    //     // 		$range3[] = $hps3;
    //     // 		$range4[] = $hps4;
    //     // 		$range5[] = $hps5;
    //     // 	}

    //     // 	$range[0] = $range1;
    //     // 	$range[1] = $range2;
    //     // 	$range[2] = $range3;
    //     // 	$range[3] = $range4;
    //     // 	$range[4] = $range5;

    //     // 	$range['range1'] = array_sum($range1);
    //     // 	$range['range2'] = array_sum($range2);
    //     // 	$range['range3'] = array_sum($range3);
    //     // 	$range['range4'] = array_sum($range4);
    //     // 	$range['range5'] = array_sum($range5);
    //     // } else {
    //     // 	$range['range1'] = 0;
    //     // 	$range['range2'] = 0;
    //     // 	$range['range3'] = 0;
    //     // 	$range['range4'] = 0;
    //     // 	$range['range5'] = 0;
    //     // }

    //     // // get peserta tender (akumulasi ikut tender)
    //     // $response = $this->PesertaTender_model->getFilterTotal($npwp, "", $tahun);
    //     // $total = json_decode($response->getBody()->getContents(), true);

    //     // if ($total['status'] != false) {
    //     // 	$total = $total['data'];
    //     // 	$akumulasi = array();

    //     // 	foreach ($total as $data) {
    //     // 		$akumulasi[0] = (int)$data['menang_klpd'];
    //     // 		$akumulasi[1] = (int)$data['ikut'];
    //     // 	}

    //     // 	if (($total['0']['menang'] + $total['0']['kalah']) != 0) {
    //     // 		$akumulasi[2] = round($total['0']['menang'] / ($total['0']['menang'] + $total['0']['kalah']) * 100);
    //     // 		$akumulasi[3] = round($total['0']['kalah'] / ($total['0']['menang'] + $total['0']['kalah']) * 100);
    //     // 	} else {
    //     // 		$akumulasi[2] = 0;
    //     // 		$akumulasi[3] = 0;
    //     // 	}
    //     // } else {
    //     // 	$akumulasi = [0, 0, 0, 0];
    //     // }

    //     //get peserta tender (penurunan hps)
    //     // $ArrPenurunan = $this->PesertaTender_model->getFilterPenurunan($npwp, "", $tahun);

    //     // if ($ArrPenurunan['status'] !== false) {
    //     // 	$ArrPenurunan = $ArrPenurunan['data'];

    //     // 	$sum  = 0;
    //     // 	$var  = 0;
    //     // 	$temp = array();
    //     // 	foreach ($ArrPenurunan as $gap) {
    //     // 		$sum    = $sum + $gap['penurunan'];
    //     // 		$temp[] = $gap;
    //     // 		$var++;
    //     // 	}

    //     // 	if ($var != 0) {
    //     // 		$mean = $sum / $var;
    //     // 	} else {
    //     // 		$mean = 0;
    //     // 	}

    //     // 	$penurunan[] = array();
    //     // 	$penurunan['0'] = $temp;
    //     // 	$penurunan['1'] = round($mean);
    //     // 	$penurunan['2'] = round($sum);
    //     // } else {
    //     // 	$penurunan[] = array();
    //     // 	$penurunan['0'] = [];
    //     // 	$penurunan['1'] = 0;
    //     // 	$penurunan['2'] = 0;
    //     // }

    //     // //get peserta tender (by K/L/PD competitor)
    //     // $response = $this->client->request('GET', 'pesertatenderklpd/' . '0', $this->client->getConfig('headers'));
    //     // $byKlpd = json_decode($response->getBody()->getContents(), true);
    //     // // var_dump($byKlpd);
    //     // // die;
    //     // if ($byKlpd['status'] !== false) {
    //     // 	$byKlpd = $byKlpd['data'];
    //     // 	$klpd = array();
    //     // 	$j = 0;
    //     // 	$count = count($byKlpd);

    //     // 	for ($i = 0; $i < 12; $i++) {
    //     // 		if ($j < $count) {
    //     // 			if ($byKlpd[$j]['month'] == ($i + 1)) {
    //     // 				$klpd[] = (int)$byKlpd[$j]['count'];
    //     // 				$j++;
    //     // 			} else {
    //     // 				$klpd[] = 0;
    //     // 			}
    //     // 		}
    //     // 	}
    //     // } else {
    //     // 	$byKlpd = [];
    //     // 	$klpd = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    //     // }

    //     $data = [
    //         'title' => 'Know Your Competitor',
    //         'lpse' => json_decode($lpse->getBody()->getContents(), true)['data'],
    //         'npwp' => $npwp,
    //         'peserta' => $peserta,
    //         'pengguna' => $pengguna,
    //         'timeSeries' => '{}', // json_encode($timeSeries),
    //         'range' => '{"range1": 0, "range2": 0, "range3": 0, "range4": 0, "range5": 0}', // json_encode($range),
    //         'akumulasi' => '[]', // json_encode($akumulasi),
    //         'klpd' => '{}', // json_encode($klpd),
    //         'penurunan' => '{}', // $penurunan,
    //         'latlong' => '{}', // $byKlpd
    //     ];

    //     $userId = $this->session->user_data['id_pengguna'];
    //     $this->load->library('user');

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('profile_pengguna/templates/navbar', [
    //         'photo' => $this->user->getPhotoProfile((int) $userId, $this->db),
    //         'userStatus' => (int) $this->session->user_data['status'],
    //     ]);
    //     $this->load->view('statistik/competitor');
    //     $this->load->view('templates/footer');
    // }



    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        $this->load->model('PesertaTender_model');
        // $data = $this->Tender_model->getPreferensiPengguna($_COOKIE['id_pengguna']);
        // $data = $this->PesertaTender_model->getPesertaByKeyword(10, '');
        // var_dump($data, 'test');
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar');
        $this->load->view('statistik/competitor');
        $this->load->view('templates/footer');
    }
    public function getPesertaByKeyword()
    {
        $keyword = $this->input->post('keyword');

        $data = $this->PesertaTender_model->getPesertaByKeyword(10, $keyword);
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($data, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }
    public function getDataChartByNPWP()
    {
        $data = $this->input->post();

        if ($data != null) {
            $this->load->library('session');
            $this->load->library('user');
            $this->load->model('api/Peserta_model');
            $this->load->model('api/PesertaTenderModel');
            $this->load->model('scrapping/Pengguna_model');
            $this->load->model('scrapping/Lpse_model');


            $dataPesertaTender = $this->PesertaTenderModel->getDataTenderFilter($data['npwp'], '', '');

            $timeSeriesUser = array_fill(0, 12, 0);
            $dataIkut = [];
            $dataMenang = [];
            $dataMenangKalah = [];
            $totalMenang = 0;
            $totalKalah = 0;
            $totalIkut = 0;
            foreach ($dataPesertaTender as $key => $value) {
                if ($value['status_peserta'] == 'ikut') {
                    array_push($dataIkut, $value);
                } else {
                    $timeSeriesUser[((int)$value['month']) - 1]++;
                    array_push($dataMenangKalah, $value);
                    if ($value['status_peserta'] == 'menang') {
                        array_push($dataMenang, $value);
                    }
                }

                // Switch counting 
                switch ($value['status_peserta']) {
                    case 'menang':
                        $totalMenang++;
                        break;
                    case 'kalah':
                        $totalKalah++;
                        break;
                    case 'ikut':
                        $totalIkut++;
                        break;
                    default:
                        break;
                }
            }

            // time sereies chart Tender
            $akumulasi[0] = $totalMenang;
            $akumulasi[1] = $totalKalah;
            $akumulasi[2] = $totalIkut;
            $akumulasi[3] = ($totalKalah + $totalMenang + $totalIkut);

            // hps chart ikut tender
            for ($i = 0; $i < 12; $i++) {
                $hps1 = 0;
                $hps2 = 0;
                $hps3 = 0;
                $hps4 = 0;
                $hps5 = 0;
                foreach ($dataPesertaTender as $range) {
                    if ($range['month'] == $i + 1) {

                        switch (true) {
                            case $range['nilai_hps'] >= 100000000000:
                                $hps5++;
                                break;
                            case $range['nilai_hps'] >= 10000000000:
                                $hps4++;
                                break;
                            case $range['nilai_hps'] >= 1000000000:
                                $hps3++;
                                break;
                            case $range['nilai_hps'] >= 500000000:
                                $hps2++;
                                break;
                            default:
                                $hps1++;
                                break;
                        }
                    }
                }

                $range1[] = $hps1;
                $range2[] = $hps2;
                $range3[] = $hps3;
                $range4[] = $hps4;
                $range5[] = $hps5;
            }

            $range[0] = $range1;
            $range[1] = $range2;
            $range[2] = $range3;
            $range[3] = $range4;
            $range[4] = $range5;

            $range['range1'] = array_sum($range1);
            $range['range2'] = array_sum($range2);
            $range['range3'] = array_sum($range3);
            $range['range4'] = array_sum($range4);
            $range['range5'] = array_sum($range5);

            $dataChart['time_series'] = $timeSeriesUser;
            $dataChart['range'] = $range;
            $dataChart['akumulasi'] = $akumulasi;
            $dataChart['win_lose'] = $dataMenangKalah;
            $dataChart['join'] = $dataIkut;
            // return json_encode($dataChart);
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($dataChart, JSON_PRETTY_PRINT))
                ->_display();

            exit;
        }
    }
    public function chart()
    {
        $data = $this->input->post();

        if ($data != null) {
            $response = $this->PesertaTender_model->getFilterTender($data['cariPeserta'], $data['cariKLPD'], $data['cariTahun']);

            if ($response['status'] != false) {
                $monthly = $response['data'];
                $timeSeries = [];

                for ($i = 0; $i < 12; $i++) {
                    $timeSeries[$i] = 0;
                    foreach ($monthly as $bulan) {
                        if ($bulan['month'] == $i + 1) {
                            $timeSeries[$i]++;
                        }
                    }
                }
            } else {
                $timeSeries = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            }
            // var_dump($timeSeries);
?>
            <p class="d-none" id="chart1"><?php echo json_encode($timeSeries) ?></p>
            <?php

            // get peserta tender (akumulasi ikut tender)
            $response = $this->PesertaTender_model->getFilterTotal($data['cariPeserta'], $data['cariKLPD'], $data['cariTahun']);
            $total = json_decode($response->getBody()->getContents(), true);

            if ($total['status'] !== false) {
                $total = $total['data'];

                $akumulasi = [];

                foreach ($total as $data_akumulasi) {
                    $akumulasi[0] = (int) $data_akumulasi['menang_klpd'];
                    $akumulasi[1] = (int) $data_akumulasi['ikut'];
                }
                if (($total['0']['menang'] + $total['0']['kalah']) !== 0) {
                    $akumulasi[2] = round($total['0']['menang'] / ($total['0']['menang'] + $total['0']['kalah']) * 100);
                    $akumulasi[3] = round($total['0']['kalah'] / ($total['0']['menang'] + $total['0']['kalah']) * 100);
                } else {
                    $akumulasi[2] = 0;
                    $akumulasi[3] = 0;
                }
            } else {
                $akumulasi = [0, 0, 0, 0];
            }
            ?>
            <p class="d-none" id="chart3"><?php echo json_encode($akumulasi) ?></p>
            <?php

            //get tender by hps (hps competitor)
            $hps = $this->PesertaTender_model->getFilterHps($data['cariPeserta'], $data['cariKLPD'], $data['cariTahun']);

            if ($hps['status'] != false) {
                $hps = $hps['data'];
                $range = [];
                $range1 = [];
                $range2 = [];
                $range3 = [];
                $range4 = [];
                $range5 = [];

                for ($i = 0; $i < 12; $i++) {
                    $hps1 = 0;
                    $hps2 = 0;
                    $hps3 = 0;
                    $hps4 = 0;
                    $hps5 = 0;
                    foreach ($hps as $range) {
                        if ($range['month'] == $i + 1) {
                            if ($range['nilai_hps'] < 500000000) {
                                $hps1++;
                            } elseif ($range['nilai_hps'] >= 500000000 && $range['nilai_hps'] < 1000000000) {
                                $hps2++;
                            } elseif ($range['nilai_hps'] >= 1000000000 && $range['nilai_hps'] < 10000000000) {
                                $hps3++;
                            } elseif ($range['nilai_hps'] >= 10000000000 && $range['nilai_hps'] < 100000000000) {
                                $hps4++;
                            } elseif ($range['nilai_hps'] >= 100000000000) {
                                $hps5++;
                            }
                        }
                    }
                    $range1[] = $hps1;
                    $range2[] = $hps2;
                    $range3[] = $hps3;
                    $range4[] = $hps4;
                    $range5[] = $hps5;
                }

                $range[0] = $range1;
                $range[1] = $range2;
                $range[2] = $range3;
                $range[3] = $range4;
                $range[4] = $range5;

                $range['range1'] = array_sum($range1);
                $range['range2'] = array_sum($range2);
                $range['range3'] = array_sum($range3);
                $range['range4'] = array_sum($range4);
                $range['range5'] = array_sum($range5);
            } else {
                $range['range1'] = 0;
                $range['range2'] = 0;
                $range['range3'] = 0;
                $range['range4'] = 0;
                $range['range5'] = 0;
            }
            ?>
            <p class="d-none" id="chart2"><?php echo json_encode($range) ?></p>
            <?php

            //get peserta tender (penurunan hps)
            $ArrPenurunan = $this->PesertaTender_model->getFilterPenurunan($data['cariPeserta'], $data['cariKLPD'], $data['cariTahun']);
            if ($ArrPenurunan['status'] !== false) {
                $ArrPenurunan = $ArrPenurunan['data'];

                $sum = 0;
                $var = 0;
                $temp = [];
                foreach ($ArrPenurunan as $gap) {
                    $sum = $sum + $gap['penurunan'];
                    $temp[] = $gap;
                    $var++;
                }

                if ($var != 0) {
                    $mean = $sum / $var;
                } else {
                    $mean = 0;
                }

                $penurunan[] = [];
                $penurunan['0'] = $temp;
                $penurunan['1'] = round($mean);
                $penurunan['2'] = round($sum);
            } else {
                $penurunan[] = [];
                $penurunan['0'] = [];
                $penurunan['1'] = 0;
                $penurunan['2'] = 0;
            }
            ?>
            <p class="d-none" id="gap"><?php echo json_encode($penurunan) ?></p>
            <?php

            // var_dump($data['cariKLPD']);
            //get peserta tender (by K/L/PD competitor)
            $response = $this->PesertaTender_model->getFilterKlpd($data['cariPeserta'], $data['cariKLPD']);

            if ($response['status'] !== false) {
                $byKlpd = $response['data'];
                $klpd = [];

                for ($i = 0; $i < 12; $i++) {
                    $klpd[$i] = 0;
                    foreach ($byKlpd as $dump) {
                        $tgl = strtotime($dump['tgl_pembuatan']);
                        $tgl = date('Y', $tgl);
                        if ($tgl == $data['cariTahun']) {
                            if ($dump['month'] == $i + 1) {
                                $klpd[$i]++;
                            }
                        }
                    }
                }
            } else {
                $klpd = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            }

            ?>
            <p class="d-none" id="chart5"><?php echo json_encode($klpd) ?></p>
            <?php

            $latlong = $this->Lpse_model->getlatlong($data['cariKLPD']);

            ?>
            <!-- <p class="d-none" id="chart5"><?php //echo json_encode($latlong);
                                                // var_dump($response);
                                                ?></p> -->
<?php

            // var_dump($klpd);
        }
    }
}
