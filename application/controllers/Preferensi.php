<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

/*use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\components\traits\ClientApi;
use App\components\traits\User;
use App\components\UserCategory;
use App\components\UserType;*/

class Preferensi extends CI_Controller
{
    /*use ClientApi;
    use User;

    public const LIMIT_MAX_KEYWORD = 5;
    public $perPage = 20;*/

    public function __construct()
    {
        parent::__construct();
        if (!get_cookie('id_pengguna')) redirect('login');
        
        $this->load->model('Preferensi_model', 'preferensi');
        
        /*$this->load->model('KategoriLpse_model');
        $this->load->model('JenisTender_model');
        $this->load->model('Tahapan_model');
        $this->load->model('Tender_model');
        $this->load->model('WilayahModel');
        $this->load->model('Lpse_model');
        $this->load->model('Pengguna_model');
        $this->load->library('pagination');
        $this->init();*/
    }

    public function index()
    {
        /*$id = $this->session->userdata('user_data')['id_pengguna'];
        $wilayah = $this->client->request('GET', 'wilayah', $this->client->getConfig('headers'));
        $wilayah = json_decode($wilayah->getBody()->getContents(), true);

        $lpse = $this->client->request('GET', 'lpse', $this->client->getConfig('headers'));
        $lpse = json_decode($lpse->getBody()->getContents(), true);

        // get kategori lpse
        $kategoriLpse = $this->KategoriLpse_model->getAllKategoriLpse();

        // get jenis_pengadaan
        $jenisPengadaan = $this->JenisTender_model->getAllJenisTender();

        // get tahapan
        $tahapan = $this->Tahapan_model->getAllTahapan();

        try {
            $response = $this->client->request('GET', 'preferensi/' . $id, $this->client->getConfig('headers'));
            $preferensi = json_decode($response->getBody()->getContents(), true);

            $preferensiTender = $this->client->request('GET', 'preferensi/tender/' . $id, $this->client->getConfig('headers'));
            $tender = json_decode($preferensiTender->getBody()->getContents(), true);
            // var_dump($tender['data']);
            // die;
        } catch (ClientException $e) {
            $tender = json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $this->load->library('user');
        
        $data = [
            'title' => 'Preferensi',
            'wilayah' => $wilayah['data'],
            'lpse' => $lpse['data'],
            'kategoriLpse' => $kategoriLpse['data'],
            'jenisPengadaan' => $jenisPengadaan['data'],
            'tahapan' => $tahapan['data'],
            'preferensi' => $preferensi['data'] ?? null,
            'tender' => $tender,
        ];

        $this->load->view('users/templates/header', $data);
        $this->load->view('users/preferensi', $data);
        $this->load->view('dashboard/templates/navbar', [
            'photo' => $this->user->getPhotoProfile((int) $id, $this->db),
        ]);
        $this->load->view('users/templates/footer');*/
        
        $data = [
            'title' => 'Preferensi Tender'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar');
        $this->load->view('users/preferensi');
        $this->load->view('templates/footer');
    }
    
    public function getPreferensiPengguna($id)
    {
        $response = $this->preferensi->getPreferensiPengguna($id)->row();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
			
		exit;
    }
    
    public function getPreferensiListJenisTender($jenis)
    {
        $response = $this->preferensi->getPreferensiListJenisTender($jenis)->result();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
			
		exit;
    }
    
    public function getPreferensiJenisTender($id)
    {
        $response = $this->preferensi->getPreferensiJenisTender($id)->row();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
			
		exit;
    }
    
    public function getPreferensiListLPSE()
    {
        $response = $this->preferensi->getPreferensiListLPSE()->result();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
			
		exit;
    }
    
    public function simpanPreferensi()
    {
        parse_str(file_get_contents('php://input'), $data);
        
        $nilai_hps_awal = str_replace('.', '', $data['nilai_hps_awal']);
        $nilai_hps_akhir = str_replace('.', '', $data['nilai_hps_akhir']);
        if ($data['all_lpse'] == '1') $lpse = ''; else $lpse = implode('|', $data['id_lpse']);

        if ($data['id_preferensi'] == '') {
            $id_pengguna = get_cookie('id_pengguna');
            
            $param = [
                "id_pengguna" => $id_pengguna,
                "nama_profil" => 'Primary',
                "keyword" => implode('|', $data['keyword']),
                "id_lpse" => $lpse,
                "jenis_pengadaan" => implode(',', $data['kategori']),
                "nilai_hps_awal" => $nilai_hps_awal,
                "nilai_hps_akhir" => $nilai_hps_akhir,
                "tgl_update" => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('preferensi', $param);
        } else {
            $param = [
                "nama_profil" => 'Primary',
                "keyword" => implode('|', $data['keyword']),
                "id_lpse" => $lpse,
                "jenis_pengadaan" => implode(',', $data['kategori']),
                "nilai_hps_awal" => $nilai_hps_awal,
                "nilai_hps_akhir" => $nilai_hps_akhir,
                "tgl_update" => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('id_preferensi', $data['id_preferensi'])
                     ->update('preferensi', $param);
        }
                 
        $response = array(
	        'Success' => true,
            
	        'Info' => 'Preferensi tender berhasil disimpan.',
	    );

	    $this->output
	         ->set_status_header(200)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
    }

    /*public function preferensi_notif()
    {
        $this->load->model('api/Preferensi_model');
        $id = $this->session->userdata('user_data')['id_pengguna'];
        $userCategory = $this->session->userdata('user_data')['kategori'];
        $wilayah = $this->WilayahModel->getAllWilayah();
        $profileComplete = $this->Pengguna_model->isProfileComplete((int) $id);
        if (!$profileComplete) {
            redirect('profile');
        }

        $filteredUserPref = $this->getUserPreference((int) $id);
        $kategoriLpse = $this->KategoriLpse_model->getAllKategoriLpse();
        // $jenisPengadaan = $this->JenisTender_model->getAllJenisTender();
        $lpse = $this->Lpse_model->getAllLpse();

        $this->load->library('user');
        // List semua jenis tender berdasarkan jenis perusahaan.
        // TODO: handle error jika jenis_perusahaan 0. brarti user belum menseting jenis_perusahaan via update profile
        $listProcurementType = $this->Preferensi_model->getListTypeOfTenderByCompanyType((int) $this->session->user_data['jenis_perusahaan']);
        $listProcurementType = $this->JenisTender_model->getAllByListPk($listProcurementType);
        $listTenderType = [];
        if (isset($filteredUserPref['jenis_pengadaan']) && is_array($filteredUserPref['jenis_pengadaan'])) {
            $listTenderType = $this->JenisTender_model->getAllByListPk($filteredUserPref['jenis_pengadaan']);
        }

        $trialUserDuration = $this->getUserDuration((int) $id);
        $data = [
            // 'lpse' => json_decode($lpse->getBody()->getContents(), true)['data'],
            'title' => 'Preferensi Tender',
            'idPengguna' => $id,
            'kategoriPengguna' => $userCategory,
            'wilayah' => $wilayah['data'],
            'kategoriLpse' => $kategoriLpse['data'],
            'preferensi' => $filteredUserPref,
            'procurementType' => $listTenderType,
            'listProcurementType' => $listProcurementType,
            'lpse' => $lpse['data'],
            'trialUserDuration' => $trialUserDuration,
            'userStatus' => (int) $this->session->user_data['status'],
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar', [
            'photo' => $this->user->getPhotoProfile((int) $id, $this->db),
        ]);
        $this->load->view('users/preferensi_notif', $data);
        $this->load->view('templates/footer');
    }
    
    public function selectkateg($id)
    {
        $jenisPengadaan = $this->JenisTender_model->getAllJenisTender();
        $jenis = [];
        $kateg1 = [3, 4, 7];
        $kateg2 = [5, 6, 7];
        $kateg3 = [1, 2, 7, 8];
        foreach ($jenisPengadaan['data'] as $key => $value) {
            switch ($id) {
                case 1:
                    if (in_array($value['id_jenis'], $kateg1)) {
                        $jenis[] = ['id_jenis' => $value['id_jenis'], 'jenis_tender' => $value['jenis_tender']];
                    }
                    break;
                case 2:
                    if (in_array($value['id_jenis'], $kateg2)) {
                        $jenis[] = ['id_jenis' => $value['id_jenis'], 'jenis_tender' => $value['jenis_tender']];
                    }
                    // code...
                    break;
                case 3:
                    if (in_array($value['id_jenis'], $kateg3)) {
                        $jenis[] = ['id_jenis' => $value['id_jenis'], 'jenis_tender' => $value['jenis_tender']];
                    }
                    // code...
                    break;
            }
        }

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($jenis, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    protected function getUserPreference(int $userId = 0)
    {
        if ($userId < 1) {
            return [];
        }

        $userPref = $this->preferensi->getOneByUserId($userId);
        $userPref = count($userPref) ? $userPref[0] : [];
        $filteredUserPref = [];
        if (count($userPref) == 0) {
            return [];
        }

        array_walk($userPref, function ($val, $key) use (&$filteredUserPref) {
            if (in_array($key, ['keyword', 'id_lpse'])) {
                $filteredUserPref[$key] = empty($val) ? [] : (strpos($val, '|') === false ? [$val] : explode('|', $val));
            } else {
                $filteredUserPref[$key] = $val;
            }
        });
        $procurementType = [];
        if (!empty($userPref['jenis_pengadaan']) && strpos($userPref['jenis_pengadaan'], ',') !== false) {
            $procurementType = explode(',', $userPref['jenis_pengadaan']);
        } elseif (!empty($userPref['jenis_pengadaan']) && strpos($userPref['jenis_pengadaan'], ',') === false) {
            $procurementType = [$userPref['jenis_pengadaan']];
        }
        $procurementType = array_filter($procurementType, fn ($item) => trim($item) != '');
        $filteredUserPref['jenis_pengadaan'] = $procurementType;
        return $filteredUserPref;
    }
    
    public function preferensi_notif_bak()
    {
        $this->load->model('api/Preferensi_model');
        $id = $this->session->userdata('user_data')['id_pengguna'];
        $userCategory = $this->session->userdata('user_data')['kategori'];
        $wilayah = $this->WilayahModel->getAllWilayah();
        $profileComplete = $this->Pengguna_model->isProfileComplete((int) $id);
        if (!$profileComplete) {
            redirect('profile');
        }

        $userPref = $this->preferensi->getOneByUserId($id);
        $userPref = count($userPref) ? $userPref[0] : [];
        $filteredUserPref = [];
        array_walk($userPref, function ($val, $key) use (&$filteredUserPref) {
            if (in_array($key, ['keyword', 'id_lpse'])) {
                $filteredUserPref[$key] = empty($val) ? [] : (strpos($val, '|') === false ? [$val] : explode('|', $val));
            } else {
                $filteredUserPref[$key] = $val;
            }
        });
        $procurementType = strpos($userPref['jenis_pengadaan'], ',') !== false ? explode(',', $userPref['jenis_pengadaan']) : [$userPref['jenis_pengadaan']];
        $procurementType = array_filter($procurementType, fn ($item) => trim($item) != '');
        $filteredUserPref['jenis_pengadaan'] = $procurementType;

        $kategoriLpse = $this->KategoriLpse_model->getAllKategoriLpse();
        // $jenisPengadaan = $this->JenisTender_model->getAllJenisTender();
        $lpse = $this->Lpse_model->getAllLpse();

        // Get Preferens ==============================================
        $prefList = [];
        $prefKeyword = [];
        $prefLpse = [];
        $prefJenisPengadaan = [];
        $prefHps = [];
        $prefKualifikasi = [];

        // Cek Count Array
        if (count($prefKeyword) > 0) {
            // Clear from Duplicate Data
            $prefKeyword = array_unique($prefKeyword);

            // Restrukturisasi data preferensi
            $prefKeyword = '["' . implode('","', $prefKeyword) . '"]';
        } else {
            $prefKeyword = "null";
        }

        if (count($prefLpse) > 0) {
            // Clear from Duplicate Data
            $prefLpse = array_unique($prefLpse);

            // Restrukturisasi data preferensi
            $prefLpse = '["' . implode('","', $prefLpse) . '"]';
        } else {
            $prefLpse = "null";
        }

        if (count($prefJenisPengadaan) > 0) {
            // Clear from Duplicate Data
            $prefJenisPengadaan = array_unique($prefJenisPengadaan);

            // Restrukturisasi data preferensi
            $prefJenisPengadaan = '["' . implode('","', $prefJenisPengadaan) . '"]';
        } else {
            $prefJenisPengadaan = "null";
        }

        if (count($prefHps) > 0) {
            // Clear from Duplicate Data
            $prefHps = array_unique($prefHps);

            // Restrukturisasi data preferensi
            $prefHps = '["' . implode('","', $prefHps) . '"]';
        } else {
            $prefHps = "null";
        }

        if (count($prefKualifikasi) > 0) {
            // Clear from Duplicate Data
            $prefKualifikasi = array_unique($prefKualifikasi);
            // Restrukturisasi data preferensi
            $prefKualifikasi = '["' . implode('","', $prefKualifikasi) . '"]';
        } else {
            $prefKualifikasi = "null";
        }

        $totalTender = $this->Tender_model->getSearchTenderC("", $prefKeyword, "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null");
        $config['base_url'] = base_url('Preferensi/preferensi_notif/');
        if (isset($totalTender['status']) && $totalTender['status'] !== false) {
            $config['total_rows'] = $totalTender['data'];
        } else {
            $config['total_rows'] = 0;
        }
        $config['per_page'] = $this->perPage;
        $config['suffix'] = '#list_tender';
        $config['start'] = $this->uri->segment(3);

        $this->pagination->initialize($config);
        $this->load->library('user');
        // List semua jenis tender berdasarkan jenis perusahaan.
        // TODO: handle error jika jenis_perusahaan 0. brarti user belum menseting jenis_perusahaan via update profile
        $listProcurementType = $this->Preferensi_model->getListTypeOfTenderByCompanyType((int) $this->session->user_data['jenis_perusahaan']);
        $listProcurementType = $this->JenisTender_model->getAllByListPk($listProcurementType);
        $data = [
            // 'lpse' => json_decode($lpse->getBody()->getContents(), true)['data'],
            'title' => 'Preferensi_Notif',
            'idPengguna' => $id,
            'kategoriPengguna' => $userCategory,
            'wilayah' => $wilayah['data'],
            'kategoriLpse' => $kategoriLpse['data'],
            'preferensi' => $filteredUserPref,
            'procurementType' => $this->JenisTender_model->getAllByListPk($filteredUserPref['jenis_pengadaan']),
            'listProcurementType' => $listProcurementType,
            'lpse' => $lpse['data'],
            'totalPage' => ceil($config['total_rows'] / $config['per_page']),
            'userStatus' => (int) $this->session->user_data['status'],
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar', [
            'photo' => $this->user->getPhotoProfile((int) $id, $this->db),
        ]);
        $this->load->view('users/preferensi_notif', $data);
        $this->load->view('templates/footer');
    }

    public function inputpref()
    {
        $this->load->model('Preferensi_model');
        $searchChar = ['Rp', '.', ' '];
        $user = $this->session->userdata('user_data');
        $userId = 0;
        if ($user != null) {
            $userId = $user['id_pengguna'];
        }

        $userType = $this->getUserType($id_user);
        if ($userType == UserType::FREE) {
            $result = ['error' => 1, 'message' => 'Anda tidak dapat memperbarui setingan preferensi tender karena masa trial sudah berakhir.' . $userType];
            $this->output->set_content_type('application/json');
            $this->output->set_status_header(500);
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        }

        $nilai_hps_awal = $this->input->post('nilai_hps_awal');
        $hps_awal = str_replace($searchChar, '', $nilai_hps_awal);
        $nilai_awal = (int) $hps_awal;

        $nilai_hps_akhir = $this->input->post('nilai_hps_akhir');
        $hps_akhir = str_replace($searchChar, '', $nilai_hps_akhir);
        $nilai_akhir = (int) $hps_akhir;

        $keyword = is_array($this->input->post('keyword')) ? $this->input->post('keyword') : [];
        $id_lpse = is_array($this->input->post('id_lpse')) ? $this->input->post('id_lpse') : [];
        $kategori = is_array($this->input->post('procurement_type')) ? $this->input->post('procurement_type') : [];
        // $kategori = is_array($this->input->post('kategori')) ? $this->input->post('kategori') : [];

        $params = [
            'keyword' => $keyword,
            'procurement_type' => $this->input->post('procurement_type'),
            'nilai_hps_awal' => $nilai_awal,
            'nilai_hps_akhir' => $nilai_akhir,
            'id_lpse' => $id_lpse,
        ];

        $allHpsValue = $this->input->post('all_hps_checked');
        $this->form_validation->set_rules('keyword[]', 'Kata kunci', 'required');
        if ($allHpsValue == null) {
            $this->form_validation->set_rules('nilai_hps_awal', 'Nilai HPS Awal', 'required|numeric');
            $this->form_validation->set_rules('nilai_hps_akhir', 'Nilai HPS Akhir', 'required|numeric|greater_than[0]');
        }
        $this->form_validation->set_rules('procurement_type[]', 'Jenis Pengadaan', 'required');
        $this->form_validation->set_data($params);

        $this->output->set_content_type('application/json');
        if ($this->form_validation->run() == false) {
            $this->output->set_status_header(422);
            $result = $this->form_validation->error_array();
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        } elseif ($this->form_validation->run() && count($keyword) > self::LIMIT_MAX_KEYWORD && $userType == UserType::TRIAL) {
            $this->output->set_content_type('application/json')
                ->set_status_header(422);
            $result = ['keyword' => sprintf('Kata kunci tidak boleh lebih dari %d!.', self::LIMIT_MAX_KEYWORD)];
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        } elseif ($this->form_validation->run() && $nilai_awal >= $nilai_akhir && $allHpsValue == null) {
            $this->output->set_content_type('application/json')
                ->set_status_header(422);
            $result = ['message' => 'Nilai hps tidak valid. Nilai awal harus < nilai akhir'];
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        }

        $input = [
            "id_pengguna" => $userId,
            "keyword" => implode('|', $keyword),
            "jenis_pengadaan" => implode('|', $kategori),
            "id_lpse" => implode('|', $id_lpse),
            "nilai_hps_awal" => $nilai_awal,
            "nilai_hps_akhir" => $nilai_akhir,
            "status" => '1',
        ];

        $this->db->insert('preferensi', $input);
        $result = ['error' => 0, 'message' => 'Tambah preferensi tender sukses.'];
        if ($this->db->affected_rows() > 0) {
            $userPref = $this->Preferensi_model->getPreferensiByUserId((int) $userId);
            $this->session->set_userdata('user_preferensi', $userPref);

            $this->output->set_status_header(200);
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        } else {
            $this->output->set_status_header(422);
            $result = ['error' => 1, 'message' => 'Tambah preferensi tender gagal.'];
            $this->output->set_status_header(400);
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        }
    }

    public function edit_pref()
    {
        $this->load->model('Preferensi_model');
        $this->load->library('form_validation');
        
        $id_user = $this->session->userdata('user_data')['id_pengguna'];
        $userType = $this->getUserType($id_user);
        if ($userType == UserType::FREE) {
            $result = ['error' => 1, 'message' => 'Anda tidak dapat memperbarui setingan preferensi tender karena masa trial sudah berakhir.' . $userType];
            $this->output->set_content_type('application/json');
            $this->output->set_status_header(500);
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        }

        $searchChar = ['Rp', '.', ' '];
        $nilai_hps_awal = $this->input->post('nilai_hps_awal');
        $hps_awal = str_replace($searchChar, '', $nilai_hps_awal);
        $nilai_awal = (int) $hps_awal;

        $nilai_hps_akhir = $this->input->post('nilai_hps_akhir');
        $hps_akhir = str_replace($searchChar, '', $nilai_hps_akhir);
        $nilai_akhir = (int) $hps_akhir;

        $keyword = is_array($this->input->post('keyword')) ? $this->input->post('keyword') : [];
        $id_lpse = is_array($this->input->post('id_lpse')) ? $this->input->post('id_lpse') : [];
        $kategori = is_array($this->input->post('procurement_type')) ? $this->input->post('procurement_type') : [];
        // $procurementCat = $this->input->post('kategori1');
        $params = [
            'keyword' => $keyword,
            'procurement_type' => $this->input->post('procurement_type'),
            'nilai_hps_awal' => $nilai_awal,
            'nilai_hps_akhir' => $nilai_akhir,
            'id_lpse' => $id_lpse,
        ];

        $allHpsValue = $this->input->post('all_hps_checked');
        $this->form_validation->set_rules('keyword[]', 'Kata kunci', 'required');

        if ($allHpsValue == null) {
            $this->form_validation->set_rules('nilai_hps_awal', 'Nilai HPS Awal', 'required|numeric');
            $this->form_validation->set_rules('nilai_hps_akhir', 'Nilai HPS Akhir', 'required|numeric|greater_than[0]');
        }
        $this->form_validation->set_rules('procurement_type[]', 'Jenis Pengadaan', 'required');
        $this->form_validation->set_data($params);

        $this->output->set_content_type('application/json');
        if ($this->form_validation->run() == false) {
            $this->output->set_status_header(422);
            $result = $this->form_validation->error_array();
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        } elseif ($this->form_validation->run() && count($keyword) > self::LIMIT_MAX_KEYWORD && $userType == UserType::TRIAL) {
            $this->output->set_content_type('application/json')
                ->set_status_header(422);
            $result = ['message' => sprintf('Kata kunci tidak boleh lebih dari %d!.', self::LIMIT_MAX_KEYWORD)];
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        } elseif ($this->form_validation->run() && $nilai_awal >= $nilai_akhir && $allHpsValue == null) {
            $this->output->set_content_type('application/json')
                ->set_status_header(422);
            $result = ['message' => 'Nilai hps tidak valid. Nilai awal harus < nilai akhir'];
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        }

        $data = [
            "nama_profil" => 'Primary', //$this->input->post('nama_profil'),
            "id_pengguna" => $id_user,
            "keyword" => implode('|', $keyword),
            "jenis_pengadaan" => implode('|', $kategori),
            "id_lpse" => implode('|', $id_lpse),
            "nilai_hps_awal" => $nilai_awal,
            "nilai_hps_akhir" => $nilai_akhir,
            "status" => '1',
        ];
        
        $this->db->where('id_preferensi', $this->input->post('id_preferensi'))
                 ->update('preferensi', $data);

        $result = ['error' => 0, 'message' => 'Update preferensi tender sukses.'];
        if ($this->db->affected_rows() > 0) {
            $userPref = $this->Preferensi_model->getPreferensiByUserId((int) $id_user);
            $this->session->set_userdata('user_preferensi', $userPref);
            $this->output->set_status_header(200);
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        } else {
            $this->output->set_status_header(422);
            $error = $this->db->error();
            $result = ['error' => 1, 'message' => 'Update preferensi tender gagal.' . $error['message']];
            $this->output->set_status_header(400);
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        }
    }

    public function pagination()
    {
        $id = $this->session->userdata('user_data')['id_pengguna'];

        $preferensi = $preferensi = $this->preferensi->getPreferensiByIdUser($id);

        // Get Preferens ==============================================
        $prefKeyword = [];
        $prefLpse = [];
        $prefJenisPengadaan = [];
        $prefHps = [];
        $prefKualifikasi = [];

        if ($preferensi['status'] !== false) {
            foreach ($preferensi['data'] as $prefFind) :
                if ($prefFind['status_preferensi'] === '1') {
                    // Keyword
                    if ($prefFind['keyword'] != null) {
                        $keywordFound = explode(',', $prefFind['keyword']);
                        foreach ($keywordFound as $item) {
                            $prefKeyword[] = (string) $item;
                        }
                    }

                    // Lpse
                    if ($prefFind['id_lpse'] != null) {
                        $lpseFound = explode(',', $prefFind['id_lpse']);
                        foreach ($lpseFound as $item) {
                            $prefLpse[] = (string) $item;
                        }
                    }

                    // Jenis Pengadaan
                    if ($prefFind['id_jenis_tender'] != null) {
                        $jenisPengadaanFound = explode(',', $prefFind['id_jenis_tender']);
                        foreach ($jenisPengadaanFound as $item) {
                            $prefJenisPengadaan[] = $item;
                        }
                    }

                    // Jenis Kualifikasi
                    if ($prefFind['kualifikasi'] != null) {
                        $kualifikasiFound = explode(',', $prefFind['kualifikasi']);
                        foreach ($kualifikasiFound as $item) {
                            $prefKualifikasi[] = (string) $item;
                        }
                    }
                }
            endforeach;

            // Cek Count Array
            if (count($prefKeyword) > 0) {
                // Clear from Duplicate Data
                $prefKeyword = array_unique($prefKeyword);

                // Restrukturisasi data preferensi
                $prefKeyword = '["' . implode('","', $prefKeyword) . '"]';
            } else {
                $prefKeyword = "null";
            }
            if (count($prefLpse) > 0) {
                // Clear from Duplicate Data
                $prefLpse = array_unique($prefLpse);

                // Restrukturisasi data preferensi
                $prefLpse = '["' . implode('","', $prefLpse) . '"]';
            } else {
                $prefLpse = "null";
            }
            if (count($prefJenisPengadaan) > 0) {
                // Clear from Duplicate Data
                $prefJenisPengadaan = array_unique($prefJenisPengadaan);

                // Restrukturisasi data preferensi
                $prefJenisPengadaan = '["' . implode('","', $prefJenisPengadaan) . '"]';
            } else {
                $prefJenisPengadaan = "null";
            }
            if (count($prefHps) > 0) {
                // Clear from Duplicate Data
                $prefHps = array_unique($prefHps);

                // Restrukturisasi data preferensi
                $prefHps = '["' . implode('","', $prefHps) . '"]';
            } else {
                $prefHps = "null";
            }
            if (count($prefKualifikasi) > 0) {
                // Clear from Duplicate Data
                $prefKualifikasi = array_unique($prefKualifikasi);

                // Restrukturisasi data preferensi
                $prefKualifikasi = '["' . implode('","', $prefKualifikasi) . '"]';
            } else {
                $prefKualifikasi = "null";
            }
        // End of Get Preferens =========================================
        } else {
            $prefKeyword = 'null';
            $prefLpse = 'null';
            $prefJenisPengadaan = 'null';
            $prefHps = 'null';
            $prefKualifikasi = 'null';
        }

        // if($keyword !== 'null' && $prefLpse !== 'null' && $prefJenisPengadaan !== 'null' && $prefHps !== 'null' && $prefKualifikasi !== 'null'){

        //     $perPage = $this->uri->segment(4);
        //     $keyword = $this->uri->segment(5);

        //     if($this->uri->segment(5) === "null"){
        //         $keyword = '';
        //     }
        //     // var_dump($keyword);
        //     $json = array();

        //     // $this->load->library('pagination');

        //     $config['base_url'] = base_url('preferensi/pagination');
        //     $config['total_rows'] = $this->pagination_total_rows($keyword, "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null");
        //     $config['per_page'] = $perPage;
        //     $config['uri_segment'] = 3;
        //     $config["use_page_numbers"] = TRUE;

        //     $this->pagination->initialize($config);

        //     $page = $this->uri->segment(3);
        //     $start = ($page - 1) * $config["per_page"];

        //     $tender = $this->pagination_data($keyword, "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null", $config["per_page"], $start);

        //     $json = array(
        //     'pagination_links'=> $this->pagination->create_links(),
        //     'pagination_results' => $tender,
        //     'total_page' => ceil($config['total_rows'] / $config['per_page']),
        //     'page_now' => $page,
        //     'per_page' => $perPage,
        //     'keyword' => $keyword,
        //     );

        //     // var_dump($json);

        //     $this->output
        //     ->set_content_type('application/json')
        //     ->set_output(json_encode($json));

        // } else {
        //     $perPage = $this->uri->segment(4);
        //     $keyword = $this->uri->segment(5);

        //     if($this->uri->segment(5) === "null"){
        //         $keyword = '';
        //     }
        //     // var_dump($keyword);
        //     $json = array();

        //     // $this->load->library('pagination');

        //     $config['base_url'] = base_url('preferensi/pagination');
        //     $config['total_rows'] = 0;
        //     $config['per_page'] = $perPage;
        //     $config['uri_segment'] = 3;
        //     $config["use_page_numbers"] = TRUE;

        //     $this->pagination->initialize($config);

        //     $page = $this->uri->segment(3);
        //     $start = ($page - 1) * $config["per_page"];

        //     $tender = null;

        //     $json = array(
        //     'pagination_links'=> $this->pagination->create_links(),
        //     'pagination_results' => $tender,
        //     'total_page' => ceil($config['total_rows'] / $config['per_page']),
        //     'page_now' => $page,
        //     'per_page' => $perPage,
        //     'keyword' => $keyword,
        //     );

        //     // var_dump($json);

        //     $this->output
        //     ->set_content_type('application/json')
        //     ->set_output(json_encode($json));
        // }
        $perPage = $this->uri->segment(4);
        $search = $this->uri->segment(5);
        // $keyword = null;

        // var_dump($this->uri->segment(5));
        if ($this->uri->segment(5) === "null") {
            $search = "";
        } elseif ($this->uri->segment(5) === null) {
            $search = "";
        }
        // $keyword = stripslashes($keyword);
        // var_dump($keyword);
        $json = [];

        // $this->load->library('pagination');

        $config['base_url'] = base_url('preferensi/pagination');
        $config['per_page'] = $perPage;
        $config['total_rows'] = $this->pagination_total_rows($search, $prefKeyword, "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null");
        $config['uri_segment'] = 3;
        $config["use_page_numbers"] = true;

        $this->pagination->initialize($config);

        $page = $this->uri->segment(3);
        $start = ($page - 1) * $config["per_page"];

        $tender = $this->pagination_data($search, $prefKeyword, "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null", $config["per_page"], $start);

        // if($search){
        //     if($tender!==null){
        //         $config['total_rows'] = count($tender);
        //     } else {
        //         $config['total_rows'] = 0;
        //     }
        // } else {
        //     $config['total_rows'] = $this->pagination_total_rows($prefKeyword, "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null");
        // }

        $json = [
            'pagination_links' => $this->pagination->create_links(),
            'pagination_results' => $tender,
            'total_page' => ceil($config['total_rows'] / $config['per_page']),
            'page_now' => $page,
            'per_page' => $perPage,
            'keyword' => $search,
        ];

        // var_dump($json);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function pagination_data($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby, $limit, $start)
    {
        // $tenderFix = [];
        // if($keyword !== 'null' || $wilayah !== 'null' || $klpd !== 'null' || $jenisPengadaan !== 'null' || $hps !== 'null' || $kualifikasi !== 'null' || $tahun !== 'null' || $tahapan !== 'null' || $orderby !== 'null'){
        //     $tender = $this->Tender_model->getSearchTenderLim($keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby, $limit, $start);
        //     if($tender['status'] !== false){
        //         if($search !== 'null'){
        //             foreach($tender['data'] as $item){
        //                 if(strpos($item['nama_tender'], $search) || strpos($item['nama_lpse'], $search)){
        //                     $tenderFix[] = $item;
        //                 }
        //             }
        //             if(count($tenderFix)>0){
        //                 return $tenderFix;
        //             } else if(count($tenderFix)<=0){
        //                 return null;
        //             }
        //         } else return $tender['data'];
        //     }
        // } else if($keyword !== 'null' && $wilayah !== 'null' && $klpd !== 'null' && $jenisPengadaan !== 'null' && $hps !== 'null' && $kualifikasi !== 'null' && $tahun !== 'null' && $tahapan !== 'null' && $orderby !== 'null'){
        //     return null;
        // }
        if ($search !== '' || $keyword !== 'null' || $wilayah !== 'null' || $klpd !== 'null' || $jenisPengadaan !== 'null' || $hps !== 'null' || $kualifikasi !== 'null' || $tahun !== 'null' || $tahapan !== 'null' || $orderby !== 'null') {
            $tender = $this->Tender_model->getSearchTenderLim($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby, $limit, $start);
            if ($tender['status'] !== false) {
                return $tender['data'];
            } else {
                return null;
            }
        } elseif ($search !== '' && $keyword !== 'null' && $wilayah !== 'null' && $klpd !== 'null' && $jenisPengadaan !== 'null' && $hps !== 'null' && $kualifikasi !== 'null' && $tahun !== 'null' && $tahapan !== 'null' && $orderby !== 'null') {
            return null;
        }
    }

    public function pagination_total_rows($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby)
    {
        if ($search !== '' || $keyword !== 'null' || $wilayah !== 'null' || $klpd !== 'null' || $jenisPengadaan !== 'null' || $hps !== 'null' || $kualifikasi !== 'null' || $tahun !== 'null' || $tahapan !== 'null' || $orderby !== 'null') {
            $totalTender = $this->Tender_model->getSearchTenderC($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby);
            if ($totalTender['status'] !== false) {
                return $totalTender['data'];
            } else {
                return 0;
            }
        } elseif ($search !== '' && $keyword !== 'null' && $wilayah !== 'null' && $klpd !== 'null' && $jenisPengadaan !== 'null' && $hps !== 'null' && $kualifikasi !== 'null' && $tahun !== 'null' && $tahapan !== 'null' && $orderby !== 'null') {
            return 0;
        }
    }

    public function preferensi_notif2()
    {
        $id = $this->session->userdata('user_data')['id_pengguna'];

        // get wilayah
        $wilayah = $this->WilayahModel->getAllWilayah();

        // get kategori lpse
        $kategoriLpse = $this->KategoriLpse_model->getAllKategoriLpse();

        // get jenis_pengadaan
        $jenisPengadaan = $this->JenisTender_model->getAllJenisTender();

        $lpse = $this->client->request('GET', 'lpse');
        $lpse = json_decode($lpse->getBody()->getContents(), true);

        $preferensi = $this->client->request('GET', 'preferensi/' . $id);
        $preferensi = json_decode($preferensi->getBody()->getContents(), true);

        // Get Preferens ==============================================
        $prefLpse = [];
        $prefJenisPengadaan = [];
        $prefHps = [];
        $prefKualifikasi = [];

        if ($preferensi['status'] !== false) {
            foreach ($preferensi['data'] as $prefFind) :
                if ($prefFind['status_preferensi'] === '1') {
                    // Lpse
                    if ($prefFind['id_lpse'] != null) {
                        $lpseFound = explode(',', $prefFind['id_lpse']);
                        foreach ($lpseFound as $item) {
                            $prefLpse[] = (string) $item;
                        }
                    }

                    // Jenis Pengadaan
                    if ($prefFind['id_jenis_tender'] != null) {
                        $jenisPengadaanFound = explode(',', $prefFind['id_jenis_tender']);
                        foreach ($jenisPengadaanFound as $item) {
                            $prefJenisPengadaan[] = $item;
                        }
                    }

                    // Jenis Kualifikasi
                    if ($prefFind['kualifikasi'] != null) {
                        $kualifikasiFound = explode(',', $prefFind['kualifikasi']);
                        foreach ($kualifikasiFound as $item) {
                            $prefKualifikasi[] = (string) $item;
                        }
                    }
                }
            endforeach;
        }

        // Cek Count Array
        if (count($prefLpse) > 0) {
            // Clear from Duplicate Data
            $prefLpse = array_unique($prefLpse);

            // Restrukturisasi data preferensi
            $prefLpse = '["' . implode('","', $prefLpse) . '"]';
        } else {
            $prefLpse = "null";
        }
        if (count($prefJenisPengadaan) > 0) {
            // Clear from Duplicate Data
            $prefJenisPengadaan = array_unique($prefJenisPengadaan);

            // Restrukturisasi data preferensi
            $prefJenisPengadaan = '["' . implode('","', $prefJenisPengadaan) . '"]';
        } else {
            $prefJenisPengadaan = "null";
        }
        if (count($prefHps) > 0) {
            // Clear from Duplicate Data
            $prefHps = array_unique($prefHps);

            // Restrukturisasi data preferensi
            $prefHps = '["' . implode('","', $prefHps) . '"]';
        } else {
            $prefHps = "null";
        }
        if (count($prefKualifikasi) > 0) {
            // Clear from Duplicate Data
            $prefKualifikasi = array_unique($prefKualifikasi);

            // Restrukturisasi data preferensi
            $prefKualifikasi = '["' . implode('","', $prefKualifikasi) . '"]';
        } else {
            $prefKualifikasi = "null";
        }
        // End of Get Preferens =========================================

        $totalTender = $this->Tender_model->getSearchTenderC("", "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null");
        if (!empty($this->input->get("page"))) {
            $start = $this->perPage * $this->input->get('page');
            // $tender = $this->Tender_model->getAllTenderLim($this->perPage, $start);
            // $tender = $this->Tender_model->getTenderDefaultLim($this->input->get('cariOrderBy'),$this->perPage, $start);
            $tender = $this->Tender_model->getSearchTenderLim("", "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null", $this->perPage, $start);
            $data['tender'] = $tender['data'];
            $data['totalPage'] = ceil($totalTender['data'] / $this->perPage);
            // $data['tender'] = array_slice($tender['data'], $start, $this->perPage); //limit,start
            $this->load->view('home/post_tender', $data);
        } else {
            $start = 0;
            // $tender = $this->Tender_model->getAllTenderLim($this->perPage, $start);
            $tender = $this->Tender_model->getSearchTenderLim("", "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null", $this->perPage, $start);
            $data = [
                // 'lpse' => json_decode($lpse->getBody()->getContents(), true)['data'],
                'title' => 'Preferensi_Notif',
                'wilayah' => $wilayah['data'],
                'kategoriLpse' => $kategoriLpse['data'],
                'jenisPengadaan' => $jenisPengadaan['data'],
                'preferensi' => $preferensi['data'],
                'lpse' => $lpse['data'],
                'tender' => $tender['data'],
                'totalPage' => ceil($totalTender['data'] / $this->perPage),
                'userStatus' => (int) $this->session->user_data['status'],
            ];

            $this->load->library('user');
            $this->load->view('templates/header', $data);
            $this->load->view('profile_pengguna/templates/navbar', [
                'photo' => $this->user->getPhotoProfile((int) $id, $this->db),
            ]);
            $this->load->view('users/preferensi_notif');
            $this->load->view('templates/footer');
        }

        // $tender = $this->Tender_model->getSearchTenderLim("", "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null", $this->perPage, $start);

        // $data = [
        //     // 'lpse' => json_decode($lpse->getBody()->getContents(), true)['data'],
        //     'title' => 'Preferensi_Notif',
        //     'wilayah' => $wilayah['data'],
        //     'kategoriLpse' => $kategoriLpse['data'],
        //     'jenisPengadaan' => $jenisPengadaan['data'],
        //     'preferensi' => $preferensi['data'],
        //     'lpse' => $lpse['data'],
        //     'tender' => $tender['data'],
        // ];

        // $this->load->view('templates/header', $data);
        // $this->load->view('profile_pengguna/templates/navbar');
        // $this->load->view('users/preferensi_notif');
        // $this->load->view('templates/footer');
    }

    public function loadTender()
    {
        $id = $this->session->userdata('user_data')['id_pengguna'];

        $preferensi = $this->client->request('GET', 'preferensi/' . $id, $this->client->getConfig('headers'));
        $preferensi = json_decode($preferensi->getBody()->getContents(), true);

        // Get Preferens ==============================================
        $prefLpse = [];
        $prefJenisPengadaan = [];
        $prefHps = [];
        $prefKualifikasi = [];

        if ($preferensi['status'] !== false) {
            foreach ($preferensi['data'] as $prefFind) :
                if ($prefFind['status_preferensi'] === '1') {
                    // Lpse
                    if ($prefFind['id_lpse'] != null) {
                        $lpseFound = explode(',', $prefFind['id_lpse']);
                        foreach ($lpseFound as $item) {
                            $prefLpse[] = (string) $item;
                        }
                    }

                    // Jenis Pengadaan
                    if ($prefFind['id_jenis_tender'] != null) {
                        $jenisPengadaanFound = explode(',', $prefFind['id_jenis_tender']);
                        foreach ($jenisPengadaanFound as $item) {
                            $prefJenisPengadaan[] = $item;
                        }
                    }

                    // Jenis Kualifikasi
                    if ($prefFind['kualifikasi'] != null) {
                        $kualifikasiFound = explode(',', $prefFind['kualifikasi']);
                        foreach ($kualifikasiFound as $item) {
                            $prefKualifikasi[] = (string) $item;
                        }
                    }
                }
            endforeach;
        }

        // Cek Count Array
        if (count($prefLpse) > 0) {
            // Clear from Duplicate Data
            $prefLpse = array_unique($prefLpse);

            // Restrukturisasi data preferensi
            $prefLpse = '["' . implode('","', $prefLpse) . '"]';
        } else {
            $prefLpse = "null";
        }
        if (count($prefJenisPengadaan) > 0) {
            // Clear from Duplicate Data
            $prefJenisPengadaan = array_unique($prefJenisPengadaan);

            // Restrukturisasi data preferensi
            $prefJenisPengadaan = '["' . implode('","', $prefJenisPengadaan) . '"]';
        } else {
            $prefJenisPengadaan = "null";
        }
        if (count($prefHps) > 0) {
            // Clear from Duplicate Data
            $prefHps = array_unique($prefHps);

            // Restrukturisasi data preferensi
            $prefHps = '["' . implode('","', $prefHps) . '"]';
        } else {
            $prefHps = "null";
        }
        if (count($prefKualifikasi) > 0) {
            // Clear from Duplicate Data
            $prefKualifikasi = array_unique($prefKualifikasi);

            // Restrukturisasi data preferensi
            $prefKualifikasi = '["' . implode('","', $prefKualifikasi) . '"]';
        } else {
            $prefKualifikasi = "null";
        }
        // End of Get Preferens =========================================
        // var_dump($prefLpse);
        // die();

        // $data = $this->input->post();
        // var_dump($data);
        if (!empty($this->input->post())) {
            // var_dump($this->input->post());
            $totalTender = $this->Tender_model->getSearchTenderC('', "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null");
            if ($this->input->post("cari") !== '') {
                $totalTender = $this->Tender_model->getSearchTenderC($this->input->post('cari'), "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null");
            }
            $this->perPage = $this->input->post('setPerPage');
            var_dump($this->perPage);
            $config['base_url'] = base_url('Preferensi/preferensi_notif/');
            $config['total_rows'] = $totalTender['data'];
            $config['per_page'] = $this->perPage;
            $config['suffix'] = '#list_tender';
            $config['start'] = $this->uri->segment(3);

            $this->pagination->initialize($config);
            $tender = $this->Tender_model->getSearchTenderLim($this->input->post("cari"), "null", $prefLpse, $prefJenisPengadaan, $prefHps, $prefKualifikasi, "null", "null", "null", $config['per_page'], $config['start']);

            $data = [
                'tender' => $tender['data'],
                'totalPage' => ceil($totalTender['data'] / $config['per_page']),
            ];

            $this->load->view('users\post_tender_preferensi.php', $data);
        }
    }

    public function loadProfilPreferensi()
    {
        $idPengguna = $this->session->userdata('user_data')['id_pengguna'];

        $id = $this->input->post('postIdPref');
        // Mengambil data preferensi yang diklik
        $prefClicked = $this->client->request('GET', 'preferensi/byIdPref/' . $id, $this->client->getConfig('headers'));
        $prefClicked = json_decode($prefClicked->getBody()->getContents(), true);

        $updateStatus = '0';

        // Cek status preferensi
        if ($prefClicked['data'][0]['status_preferensi'] === '0') {
            $updateStatus = '1';
        }

        // Update Status Preferensi
        $updatePref = $this->client->request('PUT', 'preferensi/updateByIdPref/' . $id, [
            'form_params' => [
                'nama_profil' => $prefClicked['data'][0]['nama_profil'],
                'id_kategori_lpse' => $prefClicked['data'][0]['id_kategori_lpse'],
                'id_lpse' => $prefClicked['data'][0]['id_lpse'],
                'id_jenis_tender' => $prefClicked['data'][0]['id_jenis_tender'],
                'id_wilayah' => $prefClicked['data'][0]['id_wilayah'],
                'nilai_hps' => $prefClicked['data'][0]['nilai_hps'],
                'kualifikasi' => $prefClicked['data'][0]['kualifikasi'],
                'status_preferensi' => $updateStatus,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $updatePref = json_decode($updatePref->getBody()->getContents(), true);

        // Cek Update Berhasil?
        if ($updatePref['status'] == true) {
            $preferensiLoaded = $this->preferensi->getPreferensiByIdUser($idPengguna);
            // Get Preferens ==============================================
            $prefList = [];

            if ($preferensiLoaded['status'] !== false) {
                $prefList = $preferensiLoaded['data'];
                $a = 0;
                foreach ($preferensiLoaded['data'] as $prefFind) :
                    // if($prefFind['id_wilayah']!=null){
                    //     $prefList[$a]['nama_wilayah'] = implode(', ',$this->WilayahModel->getNamaNamaWilayahById(explode(',',$prefFind['id_wilayah']))['data']);
                    // } else {
                    //     $prefList[$a]['nama_wilayah'] = 'null';
                    // }
                    // if($prefFind['id_jenis_tender']!=null){
                    //     $prefList[$a]['jenis_tender'] = implode(', ',$this->JenisTender_model->getNamaNamaJenisTenderById(explode(',',$prefFind['id_jenis_tender']))['data']);
                    // } else {
                    //     $prefList[$a]['jenis_tender'] = 'null';
                    // }
                    // if($prefFind['id_kategori_lpse']!=null){
                    //     $prefList[$a]['nama_kategori'] = implode(', ',$this->KategoriLpse_model->getNamaNamaKategoriById(explode(',',$prefFind['id_kategori_lpse']))['data']);
                    // } else {
                    //     $prefList[$a]['nama_kategori'] = 'null';
                    // }

                    if ($prefFind['keyword'] != null) {
                        $prefList[$a]['keyword'] = $prefFind['keyword'];
                    } else {
                        $prefList[$a]['keyword'] = 'null';
                    }
                    if ($prefFind['id_wilayah'] != null) {
                        $prefList[$a]['nama_wilayah'] = implode(', ', $this->WilayahModel->getNamaNamaWilayahById(explode(',', $prefFind['id_wilayah']))['data']);
                    } else {
                        $prefList[$a]['nama_wilayah'] = 'null';
                    }
                    if ($prefFind['id_kategori_lpse'] != null) {
                        $prefList[$a]['nama_kategori'] = implode(', ', $this->KategoriLpse_model->getNamaNamaKategoriById(explode(',', $prefFind['id_kategori_lpse']))['data']);
                    } else {
                        $prefList[$a]['nama_kategori'] = 'null';
                    }
                    if ($prefFind['kualifikasi'] != null) {
                        $kualifikasiFound = explode(',', $prefFind['kualifikasi']);
                        if (count($kualifikasiFound) == 5) {
                            $prefList[$a]['kualifikasi'] = 'Semua';
                        } else {
                            $namaKualifikasi = [];
                            foreach ($kualifikasiFound as $item) {
                                if ($item == 1) {
                                    $namaKualifikasi[] = 'Kecil';
                                } elseif ($item == 2) {
                                    $namaKualifikasi[] = 'Non-Kecil';
                                } elseif ($item == 3) {
                                    $namaKualifikasi[] = 'Besar';
                                } elseif ($item == 4) {
                                    $namaKualifikasi[] = 'Menengah';
                                }
                                if ($item == 5) {
                                    $namaKualifikasi[] = 'Kecil dan/atau Non-Kecil';
                                }
                            }
                            $prefList[$a]['kualifikasi'] = implode(', ', $namaKualifikasi);
                        }
                    } else {
                        $prefList[$a]['kualifikasi'] = 'null';
                    }
                    if ($prefFind['nilai_hps'] != null) {
                        // var_dump($prefFind['nilai_hps']);
                        $hpsFound = explode(',', $prefFind['nilai_hps']);
                        if (count($hpsFound) == 5) {
                            $prefList[$a]['nilai_hps'] = 'Semua';
                        } else {
                            $namaHps = [];
                            foreach ($hpsFound as $item) {
                                if ($item == 1) {
                                    $namaHps[] = 'Semua';
                                } elseif ($item == 2) {
                                    $namaHps[] = '<500JT';
                                } elseif ($item == 3) {
                                    $namaHps[] = '1M-10M';
                                } elseif ($item == 4) {
                                    $namaHps[] = '10M-100M';
                                }
                                if ($item == 5) {
                                    $namaHps[] = '>100M';
                                }
                            }
                            $prefList[$a]['nilai_hps'] = implode(', ', $namaHps);
                        }
                    } else {
                        $prefList[$a]['nilai_hps'] = 'null';
                    }
                    $a++;
                endforeach;
            } else {
                $prefList = null;
            }

            $data['preferensi'] = $prefList;
            $this->load->view('users/post_profil_preferensi', $data);
        }
    }

    public function saveProfilPreferensi()
    {
        $idPengguna = $this->session->userdata('user_data')['id_pengguna'];

        $data = $this->input->post();
        // $data['postKategoriLpse'] = json_decode(str_replace('&quot;', '', $data['postKategoriLpse']), true);
        // $data['postKualifikasi'] = json_decode(str_replace('&quot;', '', $data['postKualifikasi']), true);
        $getLpse = $this->Lpse_model->getLpseByWilKat('[' . $data['postWilayah'] . ']', $data['postKategoriLpse']);
        // var_dump($getLpse['data']);
        $lpse = null;
        if ($getLpse['status'] !== false) {
            $lpse = implode(',', $getLpse['data']);
        }
        if ($data['postKategoriLpse'] !== 'null') {
            $data['postKategoriLpse'] = implode(',', json_decode(str_replace('&quot;', '', $data['postKategoriLpse']), true));
        } else {
            $data['postKategoriLpse'] = '';
        }
        if ($data['postKualifikasi'] !== 'null') {
            $data['postKualifikasi'] = implode(',', json_decode(str_replace('&quot;', '', $data['postKualifikasi']), true));
        } else {
            $data['postKualifikasi'] = '';
        }

        // var_dump($data);
        // die();

        // Save Profil
        $createPref = $this->client->request('POST', 'preferensi/createProfil', [
            'form_params' => [
                'id_pengguna' => $idPengguna,
                'nama_profil' => $data['postNamaProfil'],
                'keyword' => $data['postKataKunci'],
                'id_kategori_lpse' => $data['postKategoriLpse'],
                'id_lpse' => $lpse,
                'id_jenis_tender' => null,
                'id_wilayah' => $data['postWilayah'],
                'nilai_hps' => $data['postHps'],
                'kualifikasi' => $data['postKualifikasi'],
                'status_preferensi' => 0,
            ],
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $createPref = json_decode($createPref->getBody()->getContents(), true);

        // Cek Create Berhasil?
        if ($createPref['status'] == true) {
            $preferensiLoaded = $preferensiLoaded = $this->preferensi->getPreferensiByIdUser($idPengguna);
            // Get Preferens ==============================================
            $prefList = [];

            if ($preferensiLoaded['status'] !== false) {
                $prefList = $preferensiLoaded['data'];
                $a = 0;
                // var_dump($preferensiLoaded['data']);
                foreach ($preferensiLoaded['data'] as $prefFind) :
                    // if($prefFind['id_wilayah']!=null){
                    //     $prefList[$a]['nama_wilayah'] = implode(', ',$this->WilayahModel->getNamaNamaWilayahById(explode(',',$prefFind['id_wilayah']))['data']);
                    // } else {
                    //     $prefList[$a]['nama_wilayah'] = 'null';
                    // }
                    // if($prefFind['id_jenis_tender']!=null){
                    //     $prefList[$a]['jenis_tender'] = implode(', ',$this->JenisTender_model->getNamaNamaJenisTenderById(explode(',',$prefFind['id_jenis_tender']))['data']);
                    // } else {
                    //     $prefList[$a]['jenis_tender'] = 'null';
                    // }
                    // if($prefFind['id_kategori_lpse']!=null){
                    //     $prefList[$a]['nama_kategori'] = implode(', ',$this->KategoriLpse_model->getNamaNamaKategoriById(explode(',',$prefFind['id_kategori_lpse']))['data']);
                    // } else {
                    //     $prefList[$a]['nama_kategori'] = 'null';
                    // }

                    if ($prefFind['keyword'] != null) {
                        $prefList[$a]['keyword'] = $prefFind['keyword'];
                    } else {
                        $prefList[$a]['keyword'] = 'null';
                    }
                    if ($prefFind['id_wilayah'] != null) {
                        $prefList[$a]['nama_wilayah'] = implode(', ', $this->WilayahModel->getNamaNamaWilayahById(explode(',', $prefFind['id_wilayah']))['data']);
                    } else {
                        $prefList[$a]['nama_wilayah'] = 'null';
                    }
                    if ($prefFind['id_kategori_lpse'] != null) {
                        $prefList[$a]['nama_kategori'] = implode(', ', $this->KategoriLpse_model->getNamaNamaKategoriById(explode(',', $prefFind['id_kategori_lpse']))['data']);
                    } else {
                        $prefList[$a]['nama_kategori'] = 'null';
                    }
                    if ($prefFind['kualifikasi'] != null) {
                        $kualifikasiFound = explode(',', $prefFind['kualifikasi']);
                        if (count($kualifikasiFound) == 5) {
                            $prefList[$a]['kualifikasi'] = 'Semua';
                        } else {
                            $namaKualifikasi = [];
                            foreach ($kualifikasiFound as $item) {
                                if ($item == 1) {
                                    $namaKualifikasi[] = 'Kecil';
                                } elseif ($item == 2) {
                                    $namaKualifikasi[] = 'Non-Kecil';
                                } elseif ($item == 3) {
                                    $namaKualifikasi[] = 'Besar';
                                } elseif ($item == 4) {
                                    $namaKualifikasi[] = 'Menengah';
                                }
                                if ($item == 5) {
                                    $namaKualifikasi[] = 'Kecil dan/atau Non-Kecil';
                                }
                            }
                            $prefList[$a]['kualifikasi'] = implode(', ', $namaKualifikasi);
                        }
                    } else {
                        $prefList[$a]['kualifikasi'] = 'null';
                    }
                    if ($prefFind['nilai_hps'] != null) {
                        // var_dump($prefFind['nilai_hps']);
                        $hpsFound = explode(',', $prefFind['nilai_hps']);
                        if (count($hpsFound) == 5) {
                            $prefList[$a]['nilai_hps'] = 'Semua';
                        } else {
                            $namaHps = [];
                            foreach ($hpsFound as $item) {
                                if ($item == 1) {
                                    $namaHps[] = 'Semua';
                                } elseif ($item == 2) {
                                    $namaHps[] = '<500JT';
                                } elseif ($item == 3) {
                                    $namaHps[] = '1M-10M';
                                } elseif ($item == 4) {
                                    $namaHps[] = '10M-100M';
                                }
                                if ($item == 5) {
                                    $namaHps[] = '>100M';
                                }
                            }
                            $prefList[$a]['nilai_hps'] = implode(', ', $namaHps);
                        }
                    } else {
                        $prefList[$a]['nilai_hps'] = 'null';
                    }
                    $a++;
                endforeach;
            } else {
                $prefList = null;
            }

            $data['preferensi'] = $prefList;
            $this->load->view('users/post_profil_preferensi', $data);
        }
    }

    public function hapusProfilPreferensi()
    {
        $idPengguna = $this->session->userdata('user_data')['id_pengguna'];

        $idDelete = $this->input->post('postIdPref');

        // Save Profil
        $deletePref = $this->client->request('DELETE', 'preferensi/deleteProfil' . $idDelete, [
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        $deletePref = json_decode($deletePref->getBody()->getContents(), true);

        // Cek Hapus Berhasil?
        if ($deletePref['status'] == true) {
            $preferensiLoaded = $preferensiLoaded = $this->preferensi->getPreferensiByIdUser($idPengguna);
            // Get Preferens ==============================================
            $prefList = [];

            if ($preferensiLoaded['status'] !== false) {
                $prefList = $preferensiLoaded['data'];
                $a = 0;
                foreach ($preferensiLoaded['data'] as $prefFind) :
                    // if($prefFind['id_wilayah']!=null){
                    //     $prefList[$a]['nama_wilayah'] = implode(', ',$this->WilayahModel->getNamaNamaWilayahById(explode(',',$prefFind['id_wilayah']))['data']);
                    // } else {
                    //     $prefList[$a]['nama_wilayah'] = 'null';
                    // }
                    // if($prefFind['id_jenis_tender']!=null){
                    //     $prefList[$a]['jenis_tender'] = implode(', ',$this->JenisTender_model->getNamaNamaJenisTenderById(explode(',',$prefFind['id_jenis_tender']))['data']);
                    // } else {
                    //     $prefList[$a]['jenis_tender'] = 'null';
                    // }
                    // if($prefFind['id_kategori_lpse']!=null){
                    //     $prefList[$a]['nama_kategori'] = implode(', ',$this->KategoriLpse_model->getNamaNamaKategoriById(explode(',',$prefFind['id_kategori_lpse']))['data']);
                    // } else {
                    //     $prefList[$a]['nama_kategori'] = 'null';
                    // }

                    if ($prefFind['keyword'] != null) {
                        $prefList[$a]['keyword'] = $prefFind['keyword'];
                    } else {
                        $prefList[$a]['keyword'] = 'null';
                    }
                    if ($prefFind['id_wilayah'] != null) {
                        $prefList[$a]['nama_wilayah'] = implode(', ', $this->WilayahModel->getNamaNamaWilayahById(explode(',', $prefFind['id_wilayah']))['data']);
                    } else {
                        $prefList[$a]['nama_wilayah'] = 'null';
                    }
                    if ($prefFind['id_kategori_lpse'] != null) {
                        $prefList[$a]['nama_kategori'] = implode(', ', $this->KategoriLpse_model->getNamaNamaKategoriById(explode(',', $prefFind['id_kategori_lpse']))['data']);
                    } else {
                        $prefList[$a]['nama_kategori'] = 'null';
                    }
                    if ($prefFind['kualifikasi'] != null) {
                        $kualifikasiFound = explode(',', $prefFind['kualifikasi']);
                        if (count($kualifikasiFound) == 5) {
                            $prefList[$a]['kualifikasi'] = 'Semua';
                        } else {
                            $namaKualifikasi = [];
                            foreach ($kualifikasiFound as $item) {
                                if ($item == 1) {
                                    $namaKualifikasi[] = 'Kecil';
                                } elseif ($item == 2) {
                                    $namaKualifikasi[] = 'Non-Kecil';
                                } elseif ($item == 3) {
                                    $namaKualifikasi[] = 'Besar';
                                } elseif ($item == 4) {
                                    $namaKualifikasi[] = 'Menengah';
                                }
                                if ($item == 5) {
                                    $namaKualifikasi[] = 'Kecil dan/atau Non-Kecil';
                                }
                            }
                            $prefList[$a]['kualifikasi'] = implode(', ', $namaKualifikasi);
                        }
                    } else {
                        $prefList[$a]['kualifikasi'] = 'null';
                    }
                    if ($prefFind['nilai_hps'] != null) {
                        // var_dump($prefFind['nilai_hps']);
                        $hpsFound = explode(',', $prefFind['nilai_hps']);
                        if (count($hpsFound) == 5) {
                            $prefList[$a]['nilai_hps'] = 'Semua';
                        } else {
                            $namaHps = [];
                            foreach ($hpsFound as $item) {
                                if ($item == 1) {
                                    $namaHps[] = 'Semua';
                                } elseif ($item == 2) {
                                    $namaHps[] = '<500JT';
                                } elseif ($item == 3) {
                                    $namaHps[] = '1M-10M';
                                } elseif ($item == 4) {
                                    $namaHps[] = '10M-100M';
                                }
                                if ($item == 5) {
                                    $namaHps[] = '>100M';
                                }
                            }
                            $prefList[$a]['nilai_hps'] = implode(', ', $namaHps);
                        }
                    } else {
                        $prefList[$a]['nilai_hps'] = 'null';
                    }
                    $a++;
                endforeach;
            } else {
                $prefList = null;
            }

            $data['preferensi'] = $prefList;
            $this->load->view('users/post_profil_preferensi', $data);
        }
    }

    public function preferensiList()
    {
        $idPengguna = $this->uri->segment(3);
        // var_dump($idPengguna);

        $preferensi = $this->client->request('GET', 'preferensi/' . $idPengguna, $this->client->getConfig('headers'));
        $preferensi = json_decode($preferensi->getBody()->getContents(), true);

        // Get Preferens ==============================================
        $prefList = [];
        $prefLpse = [];
        $prefJenisPengadaan = [];
        $prefHps = [];
        $prefKualifikasi = [];

        if ($preferensi['status'] !== false) {
            $prefList = $preferensi['data'];
            $a = 0;
            foreach ($preferensi['data'] as $prefFind) :
                if ($prefFind['status_preferensi'] === '1') {
                    // Lpse
                    if ($prefFind['id_lpse'] != null) {
                        $lpseFound = explode(',', $prefFind['id_lpse']);
                        foreach ($lpseFound as $item) {
                            $prefLpse[] = (string) $item;
                        }
                    }
                    // $prefList[$a]['nama_lpse'] = implode(', ',$this->Lpse_model->getNamaNamaLpseById($lpseFound)['data']);

                    // Jenis Pengadaan
                    if ($prefFind['id_jenis_tender'] != null) {
                        $jenisPengadaanFound = explode(',', $prefFind['id_jenis_tender']);
                        foreach ($jenisPengadaanFound as $item) {
                            $prefJenisPengadaan[] = $item;
                        }
                    }

                    // Jenis Kualifikasi
                    if ($prefFind['kualifikasi'] != null) {
                        $kualifikasiFound = explode(',', $prefFind['kualifikasi']);
                        foreach ($kualifikasiFound as $item) {
                            $prefKualifikasi[] = (string) $item;
                        }
                    }
                }
                // var_dump($this->WilayahModel->getNamaNamaWilayahById(explode(',',$prefFind['id_wilayah'])));
                if ($prefFind['keyword'] != null) {
                    $prefList[$a]['keyword'] = $prefFind['keyword'];
                } else {
                    $prefList[$a]['keyword'] = 'null';
                }
                if ($prefFind['id_wilayah'] != null) {
                    $prefList[$a]['nama_wilayah'] = implode(', ', $this->WilayahModel->getNamaNamaWilayahById(explode(',', $prefFind['id_wilayah']))['data']);
                } else {
                    $prefList[$a]['nama_wilayah'] = 'null';
                }
                if ($prefFind['id_kategori_lpse'] != null) {
                    $prefList[$a]['nama_kategori'] = implode(', ', $this->KategoriLpse_model->getNamaNamaKategoriById(explode(',', $prefFind['id_kategori_lpse']))['data']);
                } else {
                    $prefList[$a]['nama_kategori'] = 'null';
                }
                if ($prefFind['kualifikasi'] != null) {
                    $kualifikasiFound = explode(',', $prefFind['kualifikasi']);
                    if (count($kualifikasiFound) == 5) {
                        $prefList[$a]['kualifikasi'] = 'Semua';
                    } else {
                        $namaKualifikasi = [];
                        foreach ($kualifikasiFound as $item) {
                            if ($item == 1) {
                                $namaKualifikasi[] = 'Kecil';
                            } elseif ($item == 2) {
                                $namaKualifikasi[] = 'Non-Kecil';
                            } elseif ($item == 3) {
                                $namaKualifikasi[] = 'Besar';
                            } elseif ($item == 4) {
                                $namaKualifikasi[] = 'Menengah';
                            }
                            if ($item == 5) {
                                $namaKualifikasi[] = 'Kecil dan/atau Non-Kecil';
                            }
                        }
                        $prefList[$a]['kualifikasi'] = implode(', ', $namaKualifikasi);
                    }
                } else {
                    $prefList[$a]['kualifikasi'] = 'null';
                }
                if ($prefFind['nilai_hps'] != null) {
                    // var_dump($prefFind['nilai_hps']);
                    $hpsFound = explode(',', $prefFind['nilai_hps']);
                    if (count($hpsFound) == 5) {
                        $prefList[$a]['nilai_hps'] = 'Semua';
                    } else {
                        $namaHps = [];
                        foreach ($hpsFound as $item) {
                            if ($item == 1) {
                                $namaHps[] = 'Semua';
                            } elseif ($item == 2) {
                                $namaHps[] = '<500JT';
                            } elseif ($item == 3) {
                                $namaHps[] = '1M-10M';
                            } elseif ($item == 4) {
                                $namaHps[] = '10M-100M';
                            }
                            if ($item == 5) {
                                $namaHps[] = '>100M';
                            }
                        }
                        $prefList[$a]['nilai_hps'] = implode(', ', $namaHps);
                    }
                } else {
                    $prefList[$a]['nilai_hps'] = 'null';
                }
                // var_dump($this->JenisTender_model->getNamaNamaJenisTenderById(explode(',',$prefFind['id_jenis_tender'])));
                $a++;
            endforeach;

            // Cek Count Array
            if (count($prefLpse) > 0) {
                // Clear from Duplicate Data
                $prefLpse = array_unique($prefLpse);

                // Restrukturisasi data preferensi
                $prefLpse = '["' . implode('","', $prefLpse) . '"]';
            } else {
                $prefLpse = "null";
            }
            if (count($prefJenisPengadaan) > 0) {
                // Clear from Duplicate Data
                $prefJenisPengadaan = array_unique($prefJenisPengadaan);

                // Restrukturisasi data preferensi
                $prefJenisPengadaan = '["' . implode('","', $prefJenisPengadaan) . '"]';
            } else {
                $prefJenisPengadaan = "null";
            }
            if (count($prefHps) > 0) {
                // Clear from Duplicate Data
                $prefHps = array_unique($prefHps);

                // Restrukturisasi data preferensi
                $prefHps = '["' . implode('","', $prefHps) . '"]';
            } else {
                $prefHps = "null";
            }
            if (count($prefKualifikasi) > 0) {
                // Clear from Duplicate Data
                $prefKualifikasi = array_unique($prefKualifikasi);

                // Restrukturisasi data preferensi
                $prefKualifikasi = '["' . implode('","', $prefKualifikasi) . '"]';
            } else {
                $prefKualifikasi = "null";
            }
            // End of Get Preferens =========================================

            // foreach($preferensi['data'] as $pref){
            //     $prefList['nama_lpse'] = $this->Lpse_model->getNamaNamaLpseById($prefLpse)['data'];
            // }
        }

        $json = [];

        $json = [
            'pref_list' => $prefList,
        ];

        // var_dump($json);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function search()
    {
        $keyword = $this->input->post('search');
        $output = '';
        if ($keyword) {
            $data = $this->Lpse_model->searchMain($keyword);
            if ($data->num_rows() > 0) {
                foreach ($data->result_array() as $hasil) {
                    $output .= '<li>LPSE ' . $hasil['nama_lpse'] . '
                    <button class="btn-icon-add add"></button>
                </li>';
                }
            } else {
                $output .= 'data tidak ditemukan';
            }
        }
        echo $output;
    }

    public function tender()
    {
        $id = $this->session->userdata('user_data')['id_pengguna'];
        $data = $this->input->post();
        // var_dump($data);
        // die;
        try {
            $response = $this->client->request('GET', 'preferensi/' . $id, $this->client->getConfig('headers'));
            $preferensi = json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            $preferensi = json_decode($e->getResponse()->getBody()->getContents(), true);
        }
        if ($preferensi['status'] == true) {
            $response = $this->client->request('PUT', 'preferensi/update/' . $id, [
                'form_params' => [
                    'id_kategori_lpse' => $data['prefKLPD'],
                    'id_lpse' => $data['prefLPSE'],
                    'id_jenis_tender' => $data['prefJenisPengadaan'],
                    'id_wilayah' => $data['prefWilayah'],
                    'nilai_hps' => $data['prefHPS'],
                    'kualifikasi' => $data['prefKualifikasi'],
                ],
                'auth' => $this->client->getConfig('headers')['auth'],
            ]);
            $this->viewTender($id);
        } else {
            $response = $this->client->request('POST', 'preferensi/create', [
                'form_params' => [
                    'id_pengguna' => $id,
                    'id_lpse' => $data['prefLPSE'],
                    'id_wilayah' => $data['prefWilayah'],
                    'id_kategori_lpse' => $data['prefKLPD'],
                    'id_jenis_tender' => $data['prefJenisPengadaan'],
                    'nilai_hps' => $data['prefHPS'],
                    'kualifikasi' => $data['prefKualifikasi'],
                ],
                'auth' => $this->client->getConfig('headers')['auth'],
            ]);
            $this->viewTender($id);
        }
    }

    public function searchTender()
    {
        $id = $this->session->userdata('user_data')['id_pengguna'];
        $data = $this->input->post();
        // var_dump($data);
        // die;
        try {
            $response = $this->client->request('POST', 'preferensi/s/' . $id, [
                'form_params' => [
                    's' => $data['prefKeyword'],
                    'orderby' => $data['prefOrderby'],
                ],
                'auth' => $this->client->getConfig('headers')['auth'],
            ]);
            $tender = json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            $tender = json_decode($e->getResponse()->getBody()->getContents(), true);
        }
        // var_dump($tender['data']);
        // die;

        ?>
        <div class="myTable" data-infinite-scroll='{ "path": ".pagination__next", "append": ".post", "history": false }'>
            <?php
                    if ($tender['status'] == true) {
                        $tender = $tender['data'];
                        foreach ($tender as $tender) :
                            ?>
                    <a class="row-table d-flex mt-1 text-body" href="<?= base_url("tender/" . $tender['id_tender']) ?>">
                        <div class="col-lg-1 col-kode text-start mx-1"><?= $tender['id_tender'] ?></div>
                        <div class="col-lg-4 col-nama text-start mx-1">
                            <p class="mb-2" style="font-weight: 500;"><?= $tender['nama_tender'] ?></p>
                            <div class="row" style="color:#694747;">
                                <p class="col-1">
                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.4219 7.0625C12.4219 10.5781 7.5 13.8594 7.5 13.8594C7.5 13.8594 2.57812 10.5781 2.57812 7.0625C2.57812 5.75714 3.09668 4.50524 4.01971 3.58221C4.94274 2.65918 6.19464 2.14063 7.5 2.14062C8.80536 2.14063 10.0573 2.65918 10.9803 3.58221C11.9033 4.50524 12.4219 5.75714 12.4219 7.0625V7.0625Z" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7.5 8.23438C8.14721 8.23438 8.67188 7.70971 8.67188 7.0625C8.67188 6.41529 8.14721 5.89062 7.5 5.89062C6.85279 5.89062 6.32812 6.41529 6.32812 7.0625C6.32812 7.70971 6.85279 8.23438 7.5 8.23438Z" fill="#BF0C0C" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </p>
                                <p class="col-10 p-0">
                                    <?= $tender['lokasi_pekerjaan'] ?>
                                </p>
                            </div>
                            <div class="row" style="color:#694747;">
                                <p class="col-1">
                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.56243 3.69261L8.51721 6.64004C9.15654 7.2788 9.98613 7.69257 10.881 7.81905L7.3353 11.356C7.21059 10.4616 6.7953 9.63314 6.15339 8.99801L3.19861 6.05055L5.56243 3.69261ZM6.15337 0.745186L0.24381 6.64004C0.0874436 6.79675 -0.000257294 7.00915 5.67024e-07 7.23052C0.000258428 7.45188 0.088454 7.66408 0.245185 7.82042C0.401917 7.97677 0.614345 8.06446 0.835738 8.0642C1.05713 8.06394 1.26936 7.97576 1.42572 7.81905L2.01672 7.22953L4.9715 10.177C5.20466 10.4087 5.3897 10.6842 5.51597 10.9877C5.64224 11.2912 5.70724 11.6167 5.70724 11.9454C5.70724 12.2741 5.64224 12.5996 5.51597 12.9031C5.3897 13.2066 5.20466 13.4821 4.9715 13.7139L6.15341 14.8929L9.68142 11.3736L13.8181 15.5H15V14.321L10.8633 10.1946L14.4268 6.64004L13.2449 5.46107C12.7746 5.931 12.1369 6.19498 11.472 6.19498C10.8071 6.19498 10.1695 5.931 9.69916 5.46107L6.74434 2.51365L7.3353 1.92416C7.49166 1.76745 7.57937 1.55505 7.57911 1.33368C7.57885 1.11232 7.49065 0.900124 7.33392 0.743778C7.17719 0.587432 6.96476 0.499743 6.74337 0.500001C6.52198 0.500258 6.30975 0.588442 6.15339 0.745153L6.15337 0.745186Z" fill="#BF0C0C" />
                                    </svg>
                                </p>
                                <p class="col-10 p-0">
                                    <?= $tender['tender_status'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-jenis text-start mx-1">
                            <p class="mb-2" style="font-weight: 500;"><?= $tender['jenis_tender'] ?></p>
                            <p><?= $tender['tahun_anggaran'] ?> - <?= $tender['metode_pengadaan'] ?></p>
                            <p><?= $tender['metode_pemilihan'] ?></p>
                        </div>
                        <div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;"><?= $tender['nama_kategori'] ?></div>
                        <div class="col-lg col-hps text-start mx-1">
                            <h6 style="font-weight: 700;color:#139728;"><?= "Rp. " . number_format($tender['nilai_hps'], 0, ',', '.') ?? '0'; ?></h6>
                        </div>
                    </a>
            <?php
                        endforeach;
                    } elseif ($tender['status'] == false) {
                        echo "<h5 class='text-center pt-4'>" . $tender['message'] . "</h5>";
                    } else {
                        echo "<h5 class='text-center py-4'>Silahkan Pilih LPSE atau lainnya untuk dimonitor</h5>";
                    }
        ?>
        </div>
    <?php
    }

    protected function viewTender($id)
    {
        try {
            $preferensiTender = $this->client->request('GET', 'preferensi/tender/' . $id, $this->client->getConfig('headers'));
            $tender = json_decode($preferensiTender->getBody()->getContents(), true);
            // var_dump($tender['data']);
            // die;
        } catch (ClientException $e) {
            $tender = json_decode($e->getResponse()->getBody()->getContents(), true);
        }
        ?>
        <div class="myTable" data-infinite-scroll='{ "path": ".pagination__next", "append": ".post", "history": false }'>
            <?php
                if ($tender['status'] == true) {
                    $tender = $tender['data'];
                    foreach ($tender as $tender) :
                        ?>
                    <a class="row-table d-flex mt-1 text-body" href="<?= base_url("tender/" . $tender['id_tender']) ?>">
                        <div class="col-lg-1 col-kode text-start mx-1"><?= $tender['id_tender'] ?></div>
                        <div class="col-lg-4 col-nama text-start mx-1">
                            <p class="mb-2" style="font-weight: 500;"><?= $tender['nama_tender'] ?></p>
                            <div class="row" style="color:#694747;">
                                <p class="col-1">
                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.4219 7.0625C12.4219 10.5781 7.5 13.8594 7.5 13.8594C7.5 13.8594 2.57812 10.5781 2.57812 7.0625C2.57812 5.75714 3.09668 4.50524 4.01971 3.58221C4.94274 2.65918 6.19464 2.14063 7.5 2.14062C8.80536 2.14063 10.0573 2.65918 10.9803 3.58221C11.9033 4.50524 12.4219 5.75714 12.4219 7.0625V7.0625Z" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7.5 8.23438C8.14721 8.23438 8.67188 7.70971 8.67188 7.0625C8.67188 6.41529 8.14721 5.89062 7.5 5.89062C6.85279 5.89062 6.32812 6.41529 6.32812 7.0625C6.32812 7.70971 6.85279 8.23438 7.5 8.23438Z" fill="#BF0C0C" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </p>
                                <p class="col-10 p-0">
                                    <?= $tender['lokasi_pekerjaan'] ?>
                                </p>
                            </div>
                            <div class="row" style="color:#694747;">
                                <p class="col-1">
                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.56243 3.69261L8.51721 6.64004C9.15654 7.2788 9.98613 7.69257 10.881 7.81905L7.3353 11.356C7.21059 10.4616 6.7953 9.63314 6.15339 8.99801L3.19861 6.05055L5.56243 3.69261ZM6.15337 0.745186L0.24381 6.64004C0.0874436 6.79675 -0.000257294 7.00915 5.67024e-07 7.23052C0.000258428 7.45188 0.088454 7.66408 0.245185 7.82042C0.401917 7.97677 0.614345 8.06446 0.835738 8.0642C1.05713 8.06394 1.26936 7.97576 1.42572 7.81905L2.01672 7.22953L4.9715 10.177C5.20466 10.4087 5.3897 10.6842 5.51597 10.9877C5.64224 11.2912 5.70724 11.6167 5.70724 11.9454C5.70724 12.2741 5.64224 12.5996 5.51597 12.9031C5.3897 13.2066 5.20466 13.4821 4.9715 13.7139L6.15341 14.8929L9.68142 11.3736L13.8181 15.5H15V14.321L10.8633 10.1946L14.4268 6.64004L13.2449 5.46107C12.7746 5.931 12.1369 6.19498 11.472 6.19498C10.8071 6.19498 10.1695 5.931 9.69916 5.46107L6.74434 2.51365L7.3353 1.92416C7.49166 1.76745 7.57937 1.55505 7.57911 1.33368C7.57885 1.11232 7.49065 0.900124 7.33392 0.743778C7.17719 0.587432 6.96476 0.499743 6.74337 0.500001C6.52198 0.500258 6.30975 0.588442 6.15339 0.745153L6.15337 0.745186Z" fill="#BF0C0C" />
                                    </svg>
                                </p>
                                <p class="col-10 p-0">
                                    <?= $tender['tender_status'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-jenis text-start mx-1">
                            <p class="mb-2" style="font-weight: 500;"><?= $tender['jenis_tender'] ?></p>
                            <p><?= $tender['tahun_anggaran'] ?> - <?= $tender['metode_pengadaan'] ?></p>
                            <p><?= $tender['metode_pemilihan'] ?></p>
                        </div>
                        <div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;"><?= $tender['nama_kategori'] ?></div>
                        <div class="col-lg col-hps text-start mx-1">
                            <h6 style="font-weight: 700;color:#139728;"><?= "Rp. " . number_format($tender['nilai_hps'], 0, ',', '.') ?? '0'; ?></h6>
                        </div>
                    </a>
            <?php
                    endforeach;
                } elseif ($tender['status'] == false) {
                    echo "<h5 class='text-center pt-4'>" . $tender['message'] . "</h5>";
                } else {
                    echo "<h5 class='text-center py-4'>Silahkan Pilih LPSE atau lainnya untuk dimonitor</h5>";
                }
        ?>
        </div>
<?php
    }*/
}
