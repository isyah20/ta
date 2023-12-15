<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Exception\ClientException;
use App\components\traits\ClientApi;
use App\components\traits\User;
use App\components\UserCategory;
use App\components\UserType;

class DashboardUser extends CI_Controller
{
    use ClientApi;
    use User;

    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != 2) {
        if (!get_cookie('id_pengguna')) {
            redirect('login');
        }

        $this->load->model('Pengguna_model');
        $this->load->model('Peserta_model');
        $this->load->model('PesertaTender_model');
        $this->load->model('Api/PesertaTenderModel');
        $this->load->model('api/Peserta_model', 'ApiPesertaModel');
        $this->init();
    }

    public function index()
    {
        $id_pengguna = get_cookie('id_pengguna');
        if ($id_pengguna) {
            $status = $this->Pengguna_model->getStatusPengguna($id_pengguna)->row();
            if ($status->status == '0') $this->listTenderPage();
            else $this->monitorAndStatTenderPage();

            // $this->listTenderPage();
        } else redirect('login');
    }

    // Dashboard untuk user premium
    public function monitorAndStatTenderPage()
    {
        $this->load->library('session');
        $this->load->library('user');
        $this->load->model('api/Peserta_model');
        $this->load->model('api/PesertaTenderModel');
        $this->load->model('scrapping/Pengguna_model');
        $this->load->model('scrapping/Lpse_model');
        $this->load->model('api/Peserta_model', 'ApiPesertaModel');

        $sessionData = $this->session->user_data;
        $pengguna = $this->Pengguna_model->getPenggunaById((int) $sessionData['id_pengguna'])['data'];
        $npwpComplete = !empty($pengguna['npwp']);

        $notif = null;
        try {
            $tenderResp = $this->client->request('GET', 'tender/notif', $this->client->getConfig('headers'));
            if ($tenderResp->getStatusCode() == 200) {
                $notif = json_decode($tenderResp->getBody()->getContents(), true);
                $notif = $notif['data'] ?? [];
            } else {
                $notif = null;
            }
        } catch (ClientException $e) {
            // die;
            $notif = null;
        }

        //get LPSE
        $lpse = $this->client->request('GET', 'lpse', $this->client->getConfig('headers'));
        $peserta = $this->Peserta_model->getPesertaNpwp($pengguna['npwp']);
        // $tahun = date('Y');
        // var_dump($tahun);
        // die;
        $dataPesertaTender = $this->PesertaTenderModel->getPesertaPemenangTenderFilter(array('npwp' => $pengguna['npwp'], 'id_lpse' => "", 'tahun' => ''));
        // var_dump($dataPesertaTender);
        // die;
        // Get Peserta Tender yang sedang diikuti 
        // $pesertaTenderIkut = $this->ApiPesertaModel->getPesertaIkutTender($pengguna['npwp']);
        $pesertaTenderIkut = null;
        try {
            // $pesertaResp = $this->client->request('GET', 'peserta/pesertaIkutTender', $this->client->getConfig('headers'));
            $pesertaResp = $this->ApiPesertaModel->getPesertaIkutTender($pengguna['npwp']);
            if ($pesertaResp) {
                // $pesertaTenderIkut = json_decode($pesertaResp->getBody()->getContents(), true);
                $pesertaTenderIkut = $pesertaResp ?? [];
            } else {
                $pesertaTenderIkut = null;
            }
        } catch (ClientException $e) {
            $pesertaTenderIkut = null;
        }



        // Statistik Ikut Tender
        $timeSeriesUser = array_fill(0, 12, 0);
        $totalMenang = 0;
        $totalKalah = 0;
        foreach ($dataPesertaTender as $dpt => $valueDPT) {
            $timeSeriesUser[((int)$valueDPT['month']) - 1]++;
            if ($valueDPT['status_pemenang'] == 'true') {
                $totalMenang++;
            } else {
                $totalKalah++;
            }
        }

        // time sereies chart Tender
        $akumulasi[0] = $this->PesertaTenderModel->getJumlahTenderFilter(array('id_lpse' => "", 'tahun' => ''));
        $akumulasi[1] = $totalMenang;
        $akumulasi[2] = $totalKalah;
        $akumulasi[3] = $totalKalah + $totalMenang;
        $akumulasi[4] = (($totalKalah + $totalMenang) != 0) ? ($totalMenang / ($totalKalah + $totalMenang) * 100) : 0;
        $akumulasi[5] = (($totalKalah + $totalMenang) != 0) ? ($totalKalah / ($totalKalah + $totalMenang) * 100) : 0;

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

        // var_dump($peserta);
        // die;
        $data = [
            'title' => 'Dashboard',
            'lpse' => json_decode($lpse->getBody()->getContents(), true)['data'],
            'pengguna' => $pengguna,
            'peserta' => $peserta['data'],
            'npwp' => $npwpComplete ? $pengguna['npwp'] : null,
            'notif' => $notif,
            'timeSeriesUser' => isset($timeSeriesUser) ? json_encode($timeSeriesUser) : null,
            'akumulasi' => isset($akumulasi) ? json_encode($akumulasi) : null,
            'range' => isset($range) ? json_encode($range) : null,
            // 'photo' => $this->user->getPhotoProfile((int) $sessionData['id_pengguna'], ''),
            'userId' => (int) $sessionData['id_pengguna'],
            'userStatus' => (int) $sessionData['status'],
            'npwpComplete' => $npwpComplete,
            'pesertaTenderIkut' => $pesertaTenderIkut
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar', $data);
        $this->load->view('dashboard/user/index');
        // $this->load->view('dashboard/templates/navbar');
        $this->load->view('templates/footer');
    }

    // Dashboard untuk user free
    public function listTenderPage()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        var_dump($data);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar');
        $this->load->view('dashboard/user/list-newest-tender');
        $this->load->view('templates/footer');
    }

    protected function isNpwpValid(string $npwp): bool
    {
        $re = '/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}\.[0-9]{1}-[0-9]{3}\.[0-9]{3}$/m';
        preg_match_all($re, $npwp, $matches, PREG_SET_ORDER, 0);
        return count($matches) > 0;
    }

    // protected function isNpwpFilled(int $userId)
    // {
    //     $query = $this->db->select('npwp')->from('pengguna')->where('id_pengguna', $userId)->get();
    //     $row = $query->row();
    //     if (
    //         $row == null
    //         || ($row != null && (trim($row->npwp) == '' || !$this->isNpwpValid($row->npwp)))
    //     ) {
    //         return false;
    //     }
    //     return true;
    // }

    protected function getPesertaTender($npwp, $tahun): array
    {
        $timeSeriesUser = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $response = $this->PesertaTender_model->getFilterTender($npwp, "", $tahun);
        log_message('error', 'hasil getPesertaTender: ' . print_r($response));
        if (isset($response['status']) && $response['status'] != false) {
            $monthly = $response['data'];

            for ($i = 0; $i < 12; $i++) {
                $timeSeriesUser[$i] = 0;
                foreach ($monthly as $bulan) {
                    if ($bulan['month'] == $i + 1) {
                        $timeSeriesUser[$i]++;
                    }
                }
            }
        }
        return $timeSeriesUser;
    }

    public function getPesertaTenderFilterHps()
    {
        $data = [
            'npwp' => '08.178.554.2-123.321',
        ];
        // $klpd = json_decode(str_replace('&quot;', '', $data['klpd']), true);
        // $tahun = json_decode(str_replace('&quot;', '', $data['tahun']), true);
        $klpd = '';
        $tahun = 2023;

        $this->db->select('id_tender');
        $this->db->from('peserta_tender');
        $this->db->where('npwp', $data['npwp'], null, false);
        $sub = $this->db->get_compiled_select();

        $this->db->select('count(id_tender)');
        $this->db->from('tender');
        $this->db->where("`id_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps` < 500000000", null, false);
        $this->db->where("YEAR(`tgl_pembuatan`) = ($tahun)", null, false);
        $range1 = $this->db->get_compiled_select();

        $this->db->select('count(id_tender)');
        $this->db->from('tender');
        $this->db->where("`id_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps` >= 500000000", null, false);
        $this->db->where("`nilai_hps` < 1000000000", null, false);
        $this->db->where("YEAR(`tgl_pembuatan`) = ($tahun)", null, false);
        $range2 = $this->db->get_compiled_select();

        $this->db->select('count(id_tender)');
        $this->db->from('tender');
        $this->db->where("`id_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps` >= 1000000000", null, false);
        $this->db->where("`nilai_hps` < 10000000000", null, false);
        $this->db->where("YEAR(`tgl_pembuatan`) = ($tahun)", null, false);
        $range3 = $this->db->get_compiled_select();

        $this->db->select('count(id_tender)');
        $this->db->from('tender');
        $this->db->where("`id_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps` >= 10000000000", null, false);
        $this->db->where("`nilai_hps` < 100000000000", null, false);
        $this->db->where("YEAR(`tgl_pembuatan`) = ($tahun)", null, false);
        $range4 = $this->db->get_compiled_select();

        $this->db->select('count(id_tender)');
        $this->db->from('tender');
        $this->db->where("`id_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps` >= 100000000000", null, false);
        $this->db->where("YEAR(`tgl_pembuatan`) = ($tahun)", null, false);
        $range5 = $this->db->get_compiled_select();

        $this->db->select('*');
        $this->db->from('peserta_tender');
        // $this->db->select('CAST(SUBSTRING(tender.tgl_pembuatan, 6, 2)as INT) as month');
        // $this->db->select("($range1) as range1");
        // $this->db->select("($range2) as range2");
        // $this->db->select("($range3) as range3");
        // $this->db->select("($range4) as range4");
        // $this->db->select("($range5) as range5");
        $this->db->join('tender', 'tender.id_tender = peserta_tender.id_tender');
        $this->db->where('peserta_tender.npwp', $data['npwp']);
        if ($tahun != null) {
            $this->db->where("YEAR(`tgl_pembuatan`) = ($tahun)", null, false);
        }
        $this->db->where_in('tender.id_lpse', $klpd);
        $this->db->group_by('tender.id_tender', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function index()
    // {
    // 	// get new tender notification
    // 	// $tender = $this->client->request('GET', 'tender/notifikasi-tender-baru', $this->client->getConfig('headers'));
    // 	// $notif = json_decode($tender->getBody()->getContents(), true);

    // 	$notif = null;

    // 	try {
    // 		$tender = $this->client->request('GET', 'api/tender/notifikasi-tender-baru-dashboard-user', $this->client->getConfig('headers'));
    // 		$notif = json_decode($tender->getBody()->getContents(), true);

    // 		$notif = $notif['data'];
    // 	} catch (ClientException $e) {
    // 		$notif = null;
    // 	}

    // 	// var_dump($notif);
    // 	// die;

    // 	//get pengguna
    // 	$response = $this->client->request('GET', 'pengguna/' . $this->session->user_data['id_pengguna'], $this->client->getConfig('headers'));

    // 	//get LPSE
    // 	$lpse = $this->client->request('GET', 'lpse', $this->client->getConfig('headers'));

    // 	//get npwp
    // 	$pengguna = json_decode($response->getBody()->getContents(), true)['data'];

    // 	if ($npwp 	= $pengguna['npwp'] != null) {
    // 		$npwp   = $pengguna['npwp'];
    // 	} else {
    // 		$npwp 	= '0';
    // 	}

    // 	//get data peserta
    // 	try {
    // 		// $response = $this->client->request('GET', 'pesertanpwp/' . $npwp, $this->client->getConfig('headers'));
    // 		// $peserta  = json_decode($response->getBody()->getContents(), true);
    // 		$peserta = $this->Peserta_model->getPesertaNpwp($npwp);
    // 		if ($peserta['status'] != false) {
    // 			$peserta  = $peserta['data'];
    // 		} else {
    // 			$peserta = null;
    // 		}
    // 	} catch (ClientException $e) {
    // 		$peserta = null;
    // 	}

    // 	// var_dump($peserta);

    // 	$tahun = (int)date('Y');

    // 	// get peserta tender (time series user)
    // 	$response = $this->PesertaTender_model->getFilterTender($npwp, "", $tahun);

    // 	if ($response['status'] !=  false) {
    // 		$monthly = $response['data'];
    // 		$timeSeriesUser = array();

    // 		for ($i = 0; $i < 12; $i++) {
    // 			$timeSeriesUser[$i] = 0;
    // 			foreach ($monthly as $bulan) {
    // 				if ($bulan['month'] == $i + 1) {
    // 					$timeSeriesUser[$i]++;
    // 				}
    // 			}
    // 		}
    // 	} else {
    // 		$timeSeriesUser = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    // 	}

    // 	// get peserta tender (akumulasi ikut tender)
    // 	// $response = $this->client->request('GET', 'pesertatendertotal/' . $npwp,  $this->client->getConfig('headers'));
    // 	try {
    // 		$responses = $this->PesertaTender_model->getFilterTotal($npwp, "", $tahun);
    // 		$total = json_decode($responses->getBody()->getContents(), true);

    // 		if ($total['status'] == true) {
    // 			$akumulasi = array();
    // 			$total     = $total['data'];

    // 			foreach ($total as $data) {
    // 				$akumulasi[0] = (int)$data['total'];
    // 				$akumulasi[1] = (int)$data['menang'];
    // 				$akumulasi[2] = (int)$data['kalah'];
    // 				$akumulasi[3] = (int)$data['ikut'];
    // 			}

    // 			if (($total['0']['menang'] + $total['0']['kalah']) != 0) {
    // 				$akumulasi[4] = round($total['0']['menang'] / ($total['0']['menang'] + $total['0']['kalah']) * 100);
    // 				$akumulasi[5] = round($total['0']['kalah'] / ($total['0']['menang'] + $total['0']['kalah']) * 100);
    // 			} else {
    // 				$akumulasi[4] = 0;
    // 				$akumulasi[5] = 0;
    // 			}
    // 		} else {
    // 			$akumulasi  = [0, 0, 0, 0, 0, 0, 0];
    // 		}
    // 	} catch (ClientException $e) {
    // 		$akumulasi  = [0, 0, 0, 0, 0, 0, 0];
    // 	}

    // 	$hps = $this->PesertaTender_model->getFilterHps($npwp, "", $tahun);
    // 	// var_dump($hps);
    // 	// exit;

    // 	if ($hps['status'] != false) {
    // 		$hps    = $hps['data'];
    // 		$range  = array();
    // 		$range1 = array();
    // 		$range2 = array();
    // 		$range3 = array();
    // 		$range4 = array();
    // 		$range5 = array();

    // 		for ($i = 0; $i < 12; $i++) {
    // 			$hps1 = 0;
    // 			$hps2 = 0;
    // 			$hps3 = 0;
    // 			$hps4 = 0;
    // 			$hps5 = 0;
    // 			foreach ($hps as $range) {
    // 				// $tgl = strtotime($range['tgl_pembuatan']);
    // 				// $tgl = date('Y', $tgl);
    // 				// if ($tgl == $tahun) {
    // 				if ($range['month'] == $i + 1) {
    // 					if ($range['nilai_hps'] < 500000000) {
    // 						$hps1++;
    // 					} else if ($range['nilai_hps'] >= 500000000 && $range['nilai_hps'] < 1000000000) {
    // 						$hps2++;
    // 					} else if ($range['nilai_hps'] >= 1000000000 && $range['nilai_hps'] < 10000000000) {
    // 						$hps3++;
    // 					} else if ($range['nilai_hps'] >= 10000000000 && $range['nilai_hps'] < 100000000000) {
    // 						$hps4++;
    // 					} else if ($range['nilai_hps'] >= 100000000000) {
    // 						$hps5++;
    // 					}
    // 				}
    // 				// }
    // 			}
    // 			$range1[] = $hps1;
    // 			$range2[] = $hps2;
    // 			$range3[] = $hps3;
    // 			$range4[] = $hps4;
    // 			$range5[] = $hps5;
    // 		}

    // 		$range[0] = $range1;
    // 		$range[1] = $range2;
    // 		$range[2] = $range3;
    // 		$range[3] = $range4;
    // 		$range[4] = $range5;

    // 		$range['range1'] = array_sum($range1);
    // 		$range['range2'] = array_sum($range2);
    // 		$range['range3'] = array_sum($range3);
    // 		$range['range4'] = array_sum($range4);
    // 		$range['range5'] = array_sum($range5);
    // 	} else {
    // 		$range['range1'] = 0;
    // 		$range['range2'] = 0;
    // 		$range['range3'] = 0;
    // 		$range['range4'] = 0;
    // 		$range['range5'] = 0;
    // 	}

    // 	$data = [
    // 		'title'          => 'User Dashboard',
    // 		'lpse'           => json_decode($lpse->getBody()->getContents(), true)['data'],
    // 		'pengguna'       => $pengguna,
    // 		'peserta'        => $peserta,
    // 		'npwp'			 => $npwp,
    // 		'notif'			 => $notif,
    // 		'timeSeriesUser' => isset($timeSeriesUser) ? json_encode($timeSeriesUser) : null,
    // 		'akumulasi'      => isset($akumulasi) ? json_encode($akumulasi) : null,
    // 		'range'     	 => isset($range) ? json_encode($range) : null
    // 	];

    // 	$this->load->view('templates/header', $data);
    // 	$this->load->view('profile_pengguna/templates/navbar');
    // 	$this->load->view('dashboard/user/index');
    // 	// $this->load->view('dashboard/templates/navbar');
    // 	$this->load->view('templates/footer');
    // }

    public function chart()
    {
        $data = $this->input->post();

        if ($data != null) {
            // return json_encode($data['cariTahun']);
            // return json_encode($data['cariKLPD']);
            // $this->output
            //     ->set_status_header(200)
            //     ->set_content_type('application/json')
            //     ->set_output(json_encode($data['cariKLPD'], JSON_PRETTY_PRINT))
            //     ->_display();

            // exit;

            // die;
            $this->load->library('session');
            $this->load->library('user');
            $this->load->model('api/Peserta_model');
            $this->load->model('api/PesertaTenderModel');
            $this->load->model('scrapping/Pengguna_model');
            $this->load->model('scrapping/Lpse_model');

            $sessionData = $this->session->user_data;
            $pengguna = $this->Pengguna_model->getPenggunaById((int) $sessionData['id_pengguna'])['data'];

            // $peserta = $this->Peserta_model->getPesertaNpwp($pengguna['npwp']);
            // $dataPesertaTender = $this->PesertaTenderModel->getPesertaPemenangTenderFilter(array('npwp' => $pengguna['npwp'], 'id_lpse' =>  $data['cariKLPD'], 'tahun' => $data['cariTahun']));
            // $dataPesertaTender = $this->PesertaTenderModel->getPesertaPemenangTenderFilter(array('npwp' => $pengguna['npwp'], 'id_lpse' =>  $data['cariKLPD'], 'tahun' => $data['cariTahun']));
            // $dataPesertaTender = $this->PesertaTenderModel->getPesertaPemenangTenderFilter(array('npwp' => '02.750.385.3-013.000', 'id_lpse' => '', 'tahun' => '2022'));

            // $dataPesertaTender["TEST"] = $data['cariTahun'];
            // echo json_encode($dataPesertaTender);

            // $dataPesertaTender = $this->PesertaTenderModel->getDataTenderFilter($pengguna['npwp'], '');


            // var_dump($dataIkut, $dataPesertaTender);
            $dataPesertaTender = $this->PesertaTenderModel->getDataTenderFilter($pengguna['npwp'], $data['cariKLPD'], $data['cariTahun']);

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


            // $totalSemua = $totalMenang + $totalKalah + $totalIkut;

            // $totals = [
            //     'total_menang' => $totalMenang,
            //     'total_kalah' => $totalKalah,
            //     'total_ikut' => $totalIkut,
            //     'total_semua' => $totalSemua,
            // ];
            // die;
            // exit;
            // Statistik Ikut Tender


            // return $timeSeriesUser;
            // var_dump($timeSeriesUser);
            // die;

            // $tenderDiikuti = 0;
            // $tenderDiikuti = $this->PesertaTenderModel->getJumlahTenderFilter(array('id_lpse' =>  $data['cariKLPD'], 'tahun' => $data['cariTahun']));

            // time sereies chart Tender
            $akumulasi[0] = $totalMenang;
            $akumulasi[1] = $totalKalah;
            $akumulasi[2] = $totalIkut;
            $akumulasi[3] = ($totalKalah + $totalMenang + $totalIkut);
            // $akumulasi[3] = $totalKalah + $totalMenang;
            // $akumulasi[4] = (($totalKalah + $totalMenang + $tenderDiikuti) != 0) ? ($tenderDiikuti / ($totalKalah + $totalMenang + $tenderDiikuti) * 100) : 0;
            // $akumulasi[5] = (($totalKalah + $totalMenang + $tenderDiikuti) != 0) ? ($totalMenang / ($totalKalah + $totalMenang + $tenderDiikuti) * 100) : 0;
            // $akumulasi[6] = (($totalKalah + $totalMenang + $tenderDiikuti) != 0) ? ($totalKalah / ($totalKalah + $totalMenang + $tenderDiikuti) * 100) : 0;

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

            // echo '<p class="d-none" id="chart1">' . json_encode($timeSeriesUser) . '</p><p class="d-none" id="chart3">' . json_encode($range) . '</p><p class="d-none" id="chart2">' . json_encode($akumulasi) . '</p>';
        }
    }

    public function updateMenangKalahByMonth()
    {
        $data = $this->input->post();
        // $this->output
        //     ->set_status_header(200)
        //     ->set_content_type('application/json')
        //     ->set_output(json_encode($data, JSON_PRETTY_PRINT))
        //     ->_display();
        // exit;
        $sessionData = $this->session->user_data;
        $pengguna = $this->Pengguna_model->getPenggunaById((int) $sessionData['id_pengguna'])['data'];
        $dataPesertaTender = $this->PesertaTenderModel->getDataTenderFilterByMonth($pengguna['npwp'], $data['cariKLPD'], $data['cariTahun'], $data['cariBulan']);

        $dataIkut = [];
        $dataMenangKalah = [];
        $totalMenang = 0;
        $totalKalah = 0;
        $totalIkut = 0;
        // $this->output
        //     ->set_status_header(200)
        //     ->set_content_type('application/json')
        //     ->set_output(json_encode($dataPesertaTender, JSON_PRETTY_PRINT))
        //     ->_display();
        // exit;
        foreach ($dataPesertaTender as $key => $value) {
            if ($value['status_peserta'] == 'ikut') {
                array_push($dataIkut, $value);
            } else {
                // $timeSeriesUser[((int)$value['month']) - 1]++;
                array_push($dataMenangKalah, $value);
                // if ($value['status_peserta'] == 'menang') {
                //     array_push($dataMenang, $value);
                // }
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

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($dataMenangKalah, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }
    public function update($id)
    {
        $this->form_validation->set_rules('npwp', 'NPWP', 'required|trim');

        if ($this->form_validation->run() != false) {
            $data = [
                'npwp' => htmlspecialchars($this->input->post('npwp', true)),
                'tgl_update' => date('Y-m-d H:i:s'),
            ];
            // var_dump($test);
            $this->Pengguna_model->ubahPengguna($id, $data);

            redirect('user-dashboard');
        }
    }
}
