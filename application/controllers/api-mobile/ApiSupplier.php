<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace

use App\components\traits\ClientApi;
use chriskacerguis\RestServer\RestController;
use App\components\UserCategory;
use App\components\traits\User;
use App\components\UserType;

class ApiSupplier extends RestController
{
    use \App\models\traits\Supplier;
    use User;
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Supplier_api');
        $this->load->model('api/Pengguna_model');
        $this->load->model('Supplier_model');
        $this->load->model('Tender_model');
        $this->load->model('Preferensi_model', 'preferensi');
        $this->load->library('form_validation', 'google');
        $this->load->helper('form');
        $this->init();
    }

    public function index_get()
    {
        $id_supplier = $this->input->get('id_pengguna');
        $data = $this->Supplier_api->getTimMarketing($id_supplier);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getbyId_get($id)
    {
        // $id = $this->get('id_tim');
        $data = $this->Supplier_api->getTimMarketingById($id);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function create_post()
    {
        $data = [
            'nama_tim' => $this->post('nama_tim'),
            'posisi' => $this->post('posisi'),
            'no_telp' => $this->post('no_telp'),
            'email' => $this->post('email'),
            'alamat' => $this->post('alamat'),
            'id_supplier' => $_SESSION['id_pengguna'],
        ];

        $token = random_string('alnum', 25);

        $data_pengguna = [
            'nama' => $this->post('nama_tim'),
            'email' => $this->post('email'),
            'alamat' => $this->post('alamat'),
            'no_telp' => $this->post('no_telp'),
            'kategori' => UserCategory::MARKETING,
            // 'password' => md5($this->post('password')),
            'token' => $token,
            'is_active' => 1,
            'tgl_update' => date('Y-m-d H:i:s'),
            'status' => UserType::PAID,
        ];

        // if($this->Supplier_api->insertTimToPengguna($data_pengguna) > 0){
        //     $this->response([
        //         'status' => true,
        //         'message' => 'Data berhasil ditambahkan'
        //     ], RestController::HTTP_CREATED);
        // } else {
        //     $this->response([
        //         'status' => false,
        //         'message' => 'Data gagal ditambahkan'
        //     ], RestController::HTTP_BAD_REQUEST);
        // }
        $this->Supplier_api->insertTimToPengguna($data_pengguna);
        if ($this->Supplier_api->createTimMarketing($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
            $this->Supplier_api->insertTimToPengguna($data_pengguna);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal ditambahkan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function deleteTim_delete($id)
    {
        // $id = $this->get('id_tim');
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->Supplier_api->deleteTimMarketing($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data berhasil dihapus'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function editTimMarketing_post($id)
    {
        // $id = $this->post('id_tim');
        $data = [
            'nama_tim' => $this->post('nama_tim'),
            'posisi' => $this->post('posisi'),
            'no_telp' => $this->post('no_telp'),
            'email' => $this->post('email'),
            'alamat' => $this->post('alamat'),
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else if ($this->Supplier_api->updateTimMarketing($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal diubah'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // Function Plotting
    public function insertIntoPlot_post()
    {
        $data = [
            'id_tim' => $this->post('id_tim'),
            'id_pemenang' => $this->post('id_pemenang'),
        ];

        if ($this->Supplier_api->insertPlotting($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal ditambahkan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function updatePlotting_post($id)
    {
        // $id = $this->post('id_plot');
        $data = [
            'id_tim' => $this->post('id_tim'),
            'id_pemenang' => $this->post('id_pemenang'),
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else if ($this->Supplier_api->updatePlotting($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal diubah'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function deletePlotting_delete($id)
    {
        // $id = $this->get('id_plot');
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->Supplier_api->deletePlotting($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data berhasil dihapus'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function getProfile_get($id)
    {
        // $id = $this->get('id_lead');
        $data = $this->Supplier_api->getProfile($id);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function insertProfile_post($id)
    {
        // $id = $this->post('id_lead');
        $data = [
            'profil' => $this->post('profil')
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else if ($this->Supplier_api->insertProfile($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal diubah'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function getContact_get($id)
    {
        // $id = $this->get('id_lead');
        $data = $this->Supplier_api->getContact($id);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getContactById_get($id)
    {
        // $id = $this->get('id_kontak');
        $data = $this->Supplier_api->getContactById($id);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function insertContact_post()
    {
        $data = [
            'id_lead' => $this->post('id_lead'),
            'nama' => $this->post('nama'),
            'posisi' => $this->post('posisi'),
            'no_telp' => $this->post('no_telp'),
            'email' => $this->post('email')
        ];

        if ($this->Supplier_api->insertContact($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal ditambahkan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function updateContact_post($id)
    {
        // $id = $this->post('id_kontak');
        $data = [
            // 'id_lead' => $this->post('id_lead'),
            'nama' => $this->post('nama'),
            'posisi' => $this->post('posisi'),
            'no_telp' => $this->post('no_telp'),
            'email' => $this->post('email')
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else if ($this->Supplier_api->updateContact($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal diubah'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function deleteContact_delete($id)
    {
        // $id = $this->get('id_kontak');
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->Supplier_api->deleteContact($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data berhasil dihapus'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    //Get pemenang by npwp
    public function getPemenangByNPWP_get($npwp)
    {
        $data = $this->Supplier_api->getPemenangByNPWP($npwp);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    //Get pemenang filter
    public function pemenangFiltered_post()
    {
        $npwp               = $this->input->post('npwp');
        $lokasi             = $this->input->post('lokasi');
        $jenis              = $this->input->post('jenis_pengadaan');
        $penawaran_awal     = $this->input->post('nilai_penawaran_awal');
        $penawaran_akhir    = $this->input->post('nilai_penawaran_akhir');
        $tahun              = $this->input->post('tahun');
        $data = $this->Supplier_api->getPemenangFilter($npwp, $lokasi, $jenis, $penawaran_awal, $penawaran_akhir, $tahun);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_BAD_REQUEST);
            // ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getLeads_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $page_size = $_GET['pageSize'];
        $page_number = ($_GET['pageNumber'] - 1) * $page_size;
        $response = $this->Supplier_api->getDataLeads($id_pengguna, $page_size, $page_number)->result();

        // $this->output
        //     ->set_status_header(200)
        //     ->set_content_type('application/json')
        //     ->set_output(json_encode($response, JSON_PRETTY_PRINT))
        //     ->_display();
        // exit;

        if ($response) {
            $this->response([
                'status' => true,
                'data' => $response,
                // 'jumlah' => $this->Supplier_api->countDataLeads($id_pengguna)->row('jumlah')
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
    // public function getCRMLeads_get()
    // {
    //     $id_pengguna = $this->input->get('id_pengguna');
    //     $response = $this->Supplier_api->getCRMLeads($id_pengguna)->result();
    //     $response['jumlah'] = $this->Supplier_api->countCRMLeads($id_pengguna)->row('jumlah');

    //     $this->output
    //         ->set_status_header(200)
    //         ->set_content_type('application/json')
    //         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
    //         ->_display();

    //     exit;
    // }

    public function getCountLeadNull_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $data = $this->Supplier_api->getCountDataLeads($id_pengguna);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getTotalLeads_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $data = $this->Supplier_api->getTotalDataLeads($id_pengguna);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getDataLeadsLengkap_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        // $data = $this->Supplier_api->getDataLeadsLengkap($id_pengguna);
        $belum_lengkap = $this->Supplier_api->getCountDataLeads($id_pengguna);
        $total = $this->Supplier_api->getTotalDataLeads($id_pengguna);
        $lengkap = $total - $belum_lengkap;

        $data = [
            'belum_lengkap' => $belum_lengkap,
            'lengkap' => $lengkap,
            'total' => $total
        ];

        if ($total) {
            $this->response([
                'status' => true,
                'data' => $data,
                // 'jumlah' => $this->Supplier_api->countDataLeads($id_pengguna)->row('jumlah')
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => $data
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getJumlahPemenang_get()
    {
        $id = $this->input->get('id_pengguna');
        $res = $this->Supplier_model->getJumlahPemenangTender($id)->row();

        // $this -> response($res);

        if ($res) {
            $this->response([
                'status' => true,
                'data' => $res
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getJumKatalogPemenang_get()
    {
        // parse_str(file_get_contents('php://input'), $data);
        $data = [
            'id_pengguna' => $this->input->get('id_pengguna'),
            'keyword' => $this->input->get('keyword'),
            'jenis_pengadaan' => $this->input->get('jenis_pengadaan'),
            'nilai_hps_awal' => $this->input->get('nilai_hps_awal'),
            'nilai_hps_akhir' => $this->input->get('nilai_hps_akhir'),
            'prov' => $this->input->get('prov'),
            'kab' => $this->input->get('kab'),
        ];
        $response = $this->Tender_model->getJumKatalogPemenangTerbaruByPengguna1($data)->row();

        if ($response) {
            $this->response([
                'status' => true,
                'data' => $response
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getKatalogPemenang_get()
    {
        // parse_str(file_get_contents('php://input'), $data);
        $data = [
            'id_pengguna' => $this->input->get('id_pengguna'),
            'keyword' => $this->input->get('keyword'),
            'jenis_pengadaan' => $this->input->get('jenis_pengadaan'),
            'nilai_hps_awal' => $this->input->get('nilai_hps_awal'),
            'nilai_hps_akhir' => $this->input->get('nilai_hps_akhir'),
            'prov' => $this->input->get('prov'),
            'kab' => $this->input->get('kab'),
            'pageSize' => $this->input->get('pageSize'),
            'pageNumber' => $this->input->get('pageNumber'),
            'sort' => $this->input->get('sort'),
        ];
        $response = $this->Tender_model->getKatalogPemenangTerbaruByPengguna1($data)->result();

        if ($response) {
            $this->response([
                'status' => true,
                'data' => $response
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getPemenangTender_get()
    {
        $data = [
            'id_pengguna' => $this->input->get('id_pengguna'),
            'keyword' => $this->input->get('keyword'),
            'jenis_pengadaan' => $this->input->get('jenis_pengadaan'),
            'nilai_hps_awal' => $this->input->get('nilai_hps_awal'),
            'nilai_hps_akhir' => $this->input->get('nilai_hps_akhir'),
            'prov' => $this->input->get('prov'),
            'kab' => $this->input->get('kab'),
            // 'pageSize' => $this->input->get('pageSize'),
            // 'pageNumber' => $this->input->get('pageNumber'),
            'sort' => $this->input->get('sort'),
        ];

        $response = $this->Tender_model->getPemenangTerbaruByPengguna($data)->result();

        if ($response) {
            $this->response([
                'status' => true,
                'data' => $response,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getRiwayatPemenang_get()
    {
        $npwp = $this->input->get('npwp');
        $data = $this->Supplier_api->getPemenangByNPWP($npwp);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getListLokasiPekerjaan_get()
    {
        // $response = array(
        //   "total_count" => $this->Tender_model->getJumlahListLokasiPekerjaan($this->input->get("q"), $this->input->get("id_pengguna"), $this->input->get("jenis")),
        //   "results" => $this->Tender_model->getListLokasiPekerjaan(
        //   					$this->input->get("q"),
        //   					$this->input->get("id_pengguna"),
        //   					$this->input->get("jenis"),
        //   					$this->input->get("page") * $this->input->get("page_limit"),
        //   					$this->input->get("page_limit")
        //   			   )
        // );

        $q = $this->input->get("q");
        $id_pengguna = $this->input->get("id_pengguna");
        $jenis = $this->input->get("jenis");
        // $page_limit = $this->input->get("page_limit");
        // $page = $page_limit * $this->input->get("page");

        $total_count = $this->Tender_model->getJumlahLokasiPekerjaan($q, $id_pengguna, $jenis);
        $res = $this->Tender_model->getLokasiPekerjaan($q, $id_pengguna, $jenis);

        if ($res) {
            $this->response([
                'status' => true,
                'data' => $res,
                'total_count' => $total_count
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0,
                'message' => "Data tidak ditemukan"
            ], RestController::HTTP_NOT_FOUND);
        }

        // $this->output
        //   	 ->set_status_header(200)
        //   	 ->set_content_type('application/json')
        //   	 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
        //   	 ->_display();
        // exit;
    }

    public function getListJenisPengadaan_get()
    {
        // $response = array(
        //   "total_count" => $this->Tender_model->getJumlahListJenisPengadaan($this->input->get("q"), $this->input->get("id_pengguna"), $this->input->get("jenis")),
        //   "results" => $this->Tender_model->getListJenisPengadaan(
        //   					$this->input->get("q"),
        //   					$this->input->get("id_pengguna"),
        //   					$this->input->get("jenis"),
        //   					$this->input->get("page") * $this->input->get("page_limit"),
        //   					$this->input->get("page_limit")
        //   			   )
        // );
        $q = $this->input->get("q");
        $id_pengguna = $this->input->get("id_pengguna");
        $jenis = $this->input->get("jenis");
        // $page_limit = $this->input->get("page_limit");
        // $page = $page_limit * $this->input->get("page");

        $total_count = $this->Tender_model->getJumlahJenisPengadaan($q, $id_pengguna, $jenis);
        $res = $this->Tender_model->getJenisPengadaan($q, $id_pengguna, $jenis);

        if ($res) {
            $this->response([
                'status' => true,
                'data' => $res,
                'total_count' => $total_count
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0,
                'message' => "Data tidak ditemukan"
            ], RestController::HTTP_NOT_FOUND);
        }

        // $this->output
        //   	 ->set_status_header(200)
        //   	 ->set_content_type('application/json')
        //   	 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
        //   	 ->_display();
        // exit;
    }

    public function getDetailPemenang_get()
    {
        $id = $this->input->get('kode_tender');
        $response = $this->Tender_model->getWinnerById($id)->row();

        if ($response) {
            $this->response([
                'status' => true,
                'data' => $response,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0,
                'message' => "Data tidak ditemukan"
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getTahun_get()
    {
        $npwp = $this->input->get('npwp');
        $res = $this->Supplier_api->getTahun($npwp);

        if ($response) {
            $this->response([
                'status' => true,
                'data' => $res,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0,
                'message' => "Data tidak ditemukan"
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getPemenangFiltered()
    {
        $data = [
            'npwp' => $this->input->get('npwp'),
            'lokasi' => $this->input->get('lokasi'),
            'jenis' => $this->input->get('jenis_pengadaan'),
            'penawaran_awal' => $this->input->get('nilai_penawaran_awal'),
            'penawaran_akhir' => $this->input->get('nilai_penawaran_akhir'),
            'tahun' => $this->input->get('tahun'),
        ];

        $response = $this->Supplier_api->getRiwayatPemenangFiltered($data);

        if ($response) {
            $this->response([
                'status' => true,
                'data' => $response,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0,
                'message' => "Data tidak ditemukan"
            ], RestController::HTTP_NOT_FOUND);
        }
    }




    // CRM
    public function createMarketing_post()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[pengguna.email]', ['required' => 'Email tidak boleh kosong!', 'valid_email' => 'Email tidak valid', 'is_unique' => 'Email tidak boleh sama']);
        $this->form_validation->set_rules('nama_tim', 'nama tim', 'required|trim', ['required' => 'Nama tim tidak boleh kosong!',]);
        $this->form_validation->set_rules('no_telp', 'nomor telepon', 'required|trim', ['required' => 'No telepon tidak boleh kosong!',]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim', ['required' => 'Alamat tidak boleh kosong!',]);
        $this->form_validation->set_rules('posisi', 'posisi', 'required|trim', ['required' => 'Posisi tidak boleh kosong!',]);

        if (!$this->form_validation->run()) {
            $this->response([
                'status' => false,
                'message' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $token = random_string('alnum', 25);
        $password = random_string('alnum', 8);
        $data_pengguna = [
            'nama' => $this->post('nama_tim'),
            'email' => $this->post('email'),
            'alamat' => $this->post('alamat'),
            'no_telp' => $this->post('no_telp'),
            'kategori' => UserCategory::MARKETING,
            'password' => md5($password),
            'token' => $token,
            'is_active' => 1,
            'tgl_update' => date('Y-m-d H:i:s'),
            // 'status' => UserType::PAID,
        ];
        $result = $this->Supplier_api->insertTimToPengguna($data_pengguna);

        if ($result['status']) {
            $data = [
                'posisi' => $this->post('posisi'),
                'is_valid_user' => 0,
                'password_default' => $password,
                // 'id_supplier' => 360,
                'id_supplier' => $_COOKIE['id_pengguna'],
                'id_pengguna' => $result['id_pengguna'],
            ];
            if ($this->Supplier_api->createTimMarketing($data) > 0) {
                $supplier = $this->Pengguna_model->getProfilPengguna($data['id_supplier'])->row_array();
                $data_pengguna['password_default'] = $password;
                $data_pengguna['nama_supplier'] = $supplier['nama'];
                $statusEmail = $this->sendEmailPassword_get($data_pengguna);
                if (!$statusEmail['status']) {
                    $this->response([
                        'status' => false,
                        'message' => 'Email gagal terkirim',
                    ], RestController::HTTP_BAD_REQUEST);
                }
                $this->response([
                    'status' => true,
                    'message' => 'Data berhasil ditambahkan'
                ], RestController::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Gagal menambahkan data tim markteing'
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menambahkan data pengguna'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }


    public function getCRMLeads_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $response = $this->Supplier_api->getCRMLeads($id_pengguna)->result();
        $response['jumlah'] = $this->Supplier_api->countCRMLeads($id_pengguna)->row('jumlah');

        if (!empty($response)) {
            $this->response([
                'status' => true,
                'data' => $response,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0,
                'message' => "Data lead CRM tidak ditemukan!"
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getTimMarketingByIdSupplier_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $response = $this->Supplier_model->getTimBySupplierId($id_pengguna);
        if (!empty($response)) {
            $this->response([
                'status' => true,
                'data' => $response,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0,
                'message' => "Data tim marketing tidak ditemukan!"
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getLeadByIdTim_get()
    {
        $id_tim = $this->input->get('id_tim');
        $response = $this->Supplier_model->getDataLeadByIdTim($id_tim);
        if (!empty($response)) {
            $this->response([
                'status' => true,
                'data' => $response,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0,
                'message' => "Data lead pada tim tidak ditemukan!"
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function plotCRM_get()
    {
        $id_lead = $this->input->get('id_lead');
        $id_tim = $this->input->get('id_tim');
        $response = $this->Supplier_model->insertUpdatePlotTim($id_lead, $id_tim);

        if ((bool)$response) {
            $this->response([
                'status' => true,
                'id_lead' => $id_lead,
                'id_tim' => $id_tim,
                'message' => 'Plotting CRM berhasil!',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'id_lead' => $id_lead,
                'id_tim' => $id_tim,
                'message' => "Terjadi kesalahan dalam plotting CRM!"
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function getMarketing_get()
    {

        $id_supplier = $this->input->get('id_pengguna');
        $data = $this->Supplier_api->getTimMarketing($id_supplier);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function deleteTimMaketing_delete()
    {
        $id_tim = $this->input->get('id_tim');

        if ($id_tim === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->Supplier_api->deleteTimMarketing($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data berhasil dihapus'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function getTimMarketingById_get()
    {
        $id_tim = $this->get('id_tim');
        $data = $this->Supplier_api->getTimMarketingById($id_tim);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}
