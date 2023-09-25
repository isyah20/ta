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
        $this->load->library('form_validation', 'google');
        $this->load->helper('form');
        $this->init();
    }

    public function index_get()
    {
        $data = $this->Supplier_api->getTimMarketing();

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
        ];

        $token = random_string('alnum', 25);

        $data_pengguna = [
            'nama' => $this->post('nama_tim'),
            'email' => $this->post('email'),
            'alamat' => $this->post('alamat'),
            'no_telp' => $this->post('no_telp'),
            'kategori' => UserCategory::MARKETING,
            'password' => md5($this->post('password')),
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
        // if ($this->Supplier_api->updateTimMarketing($data, $id) > 0) {
        //     $this->response([
        //         'status' => true,
        //         'message' => 'Data berhasil diubah'
        //     ], RestController::HTTP_OK);
        // } else {
        //     $this->response([
        //         'status' => false,
        //         'message' => 'Data gagal diubah'
        //     ], RestController::HTTP_BAD_REQUEST);
        // }
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
        $response = $this->Supplier_api->getDataLeads($id_pengguna,$page_size,$page_number)->result();

        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT))
        ->_display();

        exit;
    }

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

}
