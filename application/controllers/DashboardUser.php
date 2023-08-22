<?php
defined('BASEPATH') or exit('No direct script access allowed');

// use GuzzleHttp\Exception\ClientException;
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
        $this->init();
    }

    public function index()
    {
        $id_pengguna = get_cookie('id_pengguna');
        if ($id_pengguna) {
            /*$status = $this->Pengguna_model->getStatusPengguna($id_pengguna)->row();
            if ($status->status == '0') $this->listTenderPage();
            else $this->monitorAndStatTenderPage();*/
            
            $this->listTenderPage();
        } else redirect('login');
    }
    
    // Dashboard untuk user premium
    public function monitorAndStatTenderPage()
    {
        $this->load->library('session');
        $this->load->library('user');
        $this->load->model('api/PesertaTenderModel');
        $sessionData = $this->session->user_data;
        $npwpComplete = $this->isNpwpFilled((int) $sessionData['id_pengguna']);
        $notif = null;
        try {
            $tenderResp = $this->client->request('GET', 'tender/notifikasi-tender-baru-dashboard-user', $this->client->getConfig('headers'));
            if ($tenderResp->getStatusCode() == 200) {
                $notif = json_decode($tenderResp->getBody()->getContents(), true);
                $notif = $notif['data'] ?? [];
            }
        } catch (ClientException $e) {
            $notif = null;
        }

        //get LPSE
        $lpse = $this->client->request('GET', 'lpse', $this->client->getConfig('headers'));
        //get pengguna
        $userResp = $this->client->request('GET', 'pengguna/' . $this->session->user_data['id_pengguna'], $this->client->getConfig('headers'));
        $pengguna = json_decode($userResp->getBody()->getContents(), true)['data'];
        $npwp = '0';
        if ($npwp = $pengguna['npwp'] != null) {
            $npwp = $pengguna['npwp'];
        }

        $peserta = $this->Peserta_model->getPesertaNpwp($npwp);
        if (isset($peserta['status']) && $peserta['status'] != false) {
            $peserta = $peserta['data'];
        } else {
            $peserta = null;
        }
        $tahun = (int) date('Y');

        // get peserta tender (time series user)
        $response = $this->PesertaTender_model->getFilterTender($npwp, "", $tahun);
        if (isset($response['status']) && $response['status'] != false) {
            $monthly = $response['data'];
            $timeSeriesUser = [];

            for ($i = 0; $i < 12; $i++) {
                $timeSeriesUser[$i] = 0;
                foreach ($monthly as $bulan) {
                    if ($bulan['month'] == $i + 1) {
                        $timeSeriesUser[$i]++;
                    }
                }
            }
        } else {
            $timeSeriesUser = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        }

        // get peserta tender (akumulasi ikut tender)
        // $response = $this->client->request('GET', 'pesertatendertotal/' . $npwp,  $this->client->getConfig('headers'));
        try {
            $params = [
                'npwp' => $npwp,
                'klpd' => '',
                'tahun' => $tahun
            ];
            
            // $params = array_map(fn ($item) => htmlspecialchars($item), $params);
            $result = $this->PesertaTenderModel->getPesertaTenderFilterAkumulasi($params);
            $total = [];
            if (is_array($result) && count($result) > 0) {
                $total = $result;
            }

            if (count($total)) {
                $akumulasi = [];
                foreach ($total as $data) {
                    $akumulasi[0] = (int) $data['total'];
                    $akumulasi[1] = (int) $data['menang'];
                    $akumulasi[2] = (int) $data['kalah'];
                    $akumulasi[3] = (int) $data['ikut'];
                }

                if (($total['0']['menang'] + $total['0']['kalah']) != 0) {
                    $akumulasi[4] = round($total['0']['menang'] / ($total['0']['menang'] + $total['0']['kalah']) * 100);
                    $akumulasi[5] = round($total['0']['kalah'] / ($total['0']['menang'] + $total['0']['kalah']) * 100);
                } else {
                    $akumulasi[4] = 0;
                    $akumulasi[5] = 0;
                }
            } else {
                $akumulasi = [0, 0, 0, 0, 0, 0, 0];
            }
        } catch (ClientException $e) {
            $akumulasi = [0, 0, 0, 0, 0, 0, 0];
        }

        $hps = $this->PesertaTender_model->getFilterHps($npwp, "", $tahun);
        if (isset($hps['status']) && $hps['status'] != false) {
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

        $data = [
            'title' => 'Dashboard',
            'lpse' => json_decode($lpse->getBody()->getContents(), true)['data'],
            'pengguna' => $pengguna,
            'peserta' => $peserta,
            // 'npwp' => $npwp,
            'notif' => $notif,
            'timeSeriesUser' => isset($timeSeriesUser) ? json_encode($timeSeriesUser) : null,
            'akumulasi' => isset($akumulasi) ? json_encode($akumulasi) : null,
            'range' => isset($range) ? json_encode($range) : null,
            'photo' => $this->user->getPhotoProfile((int) $sessionData['id_pengguna'], $this->db),
            'userId' => (int) $sessionData['id_pengguna'],
            'userStatus' => (int) $sessionData['status'],
            'npwpComplete' => $npwpComplete,
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

    protected function isNpwpFilled(int $userId)
    {
        $query = $this->db->select('npwp')->from('pengguna')->where('id_pengguna', $userId)->get();
        $row = $query->row();
        if (
            $row == null
            || ($row != null && (trim($row->npwp) == '' || !$this->isNpwpValid($row->npwp)))
        ) {
            return false;
        }
        return true;
    }

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
            //get npwp
            // $response = $this->client->request('GET', 'pengguna/' . $this->session->user_data['id_pengguna'], $this->client->getConfig('headers'));
            // $pengguna = json_decode($response->getBody()->getContents(), true)['data'];
            $userId = $this->session->user_data['id_pengguna'];
            $query = $this->db->select('npwp')->from('pengguna')->where('id_pengguna', $userId)->get();
            $row = $query->row_array();

            if (count($row) > 0 && isset($row['npwp'])) {
                $npwp = $row['npwp'];
            } else {
                $npwp = '0';
            }

            // api/models/PesertaTenderModel/getPesertaTenderFilter
            $response = $this->PesertaTender_model->getFilterTender($npwp, $data['cariKLPD'], $data['cariTahun']);
            if (isset($response['status']) && $response['status'] !== false) {
                $monthly = $response['data'];

                $timeSeriesUser = [];

                if ($data['cariTahun'] != null) {
                    for ($i = 0; $i < 12; $i++) {
                        $timeSeriesUser[$i] = 0;
                        foreach ($monthly as $bulan) {
                            // $tgl = strtotime($bulan['tgl_pembuatan']);
                            // $tgl = date('Y', $tgl);
                            // if ($tgl == $data['cariTahun']) {
                            if ($bulan['month'] == $i + 1) {
                                $timeSeriesUser[$i]++;
                            }
                            // }
                        }
                    }
                } else {
                    if (is_iterable($monthly)) {
                        for ($i = 0; $i < 12; $i++) {
                            $timeSeriesUser[$i] = 0;
                            foreach ($monthly as $bulan) {
                                if ($bulan['month'] == $i + 1) {
                                    $timeSeriesUser[$i]++;
                                }
                            }
                        }
                    }
                }
            } else {
                $timeSeriesUser = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            }
            ?>
			<p class="d-none" id="chart1"><?php echo json_encode($timeSeriesUser) ?></p>
			<?php
            // api/ApiPesertaTender/getIdFilterHps
            $hps = $this->PesertaTender_model->getFilterHps($npwp, $data['cariKLPD'], $data['cariTahun']);
            if (isset($hps['status']) && $hps['status'] != false) {
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
			<p class="d-none" id="chart3"><?php echo json_encode($range) ?></p>
			<?php

            $responses = $this->PesertaTender_model->getFilterTotal($npwp, $data['cariKLPD'], $data['cariTahun']);
            $total = [];
            if ($responses != null && $responses->getStatusCode() == 200) {
                $total = json_decode($responses->getBody()->getContents(), true);
            }

            if (isset($total['status']) && $total['status'] != false) {
                $akumulasi = [];
                $total = $total['data'];

                foreach ($total as $data) {
                    $akumulasi[0] = (int) $data['total'];
                    $akumulasi[1] = (int) $data['menang'];
                    $akumulasi[2] = (int) $data['kalah'];
                    $akumulasi[3] = (int) $data['ikut'];
                }

                if (($total['0']['menang'] + $total['0']['kalah']) != 0) {
                    $akumulasi[4] = round($total['0']['menang'] / ($total['0']['menang'] + $total['0']['kalah']) * 100);
                    $akumulasi[5] = round($total['0']['kalah'] / ($total['0']['menang'] + $total['0']['kalah']) * 100);
                } else {
                    $akumulasi[4] = 0;
                    $akumulasi[5] = 0;
                }
            } else {
                $akumulasi = [0, 0, 0, 0, 0, 0, 0];
            }

            ?>
			<p class="d-none" id="chart2"><?php echo json_encode($akumulasi) ?></p>
<?php

        }
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
