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

class ApiMarketing extends RestController {

    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Marketing_model', 'marketing');
        $this->load->model('Supplier_model', 'supplier');
        $this->init();
    }

    public function show_get($id) {
        $data = $this->marketing->getPlotTim($id);

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

    public function update_post($id) {
        // $data = $this->put();
        $data = [
            'status' => $this->post('status'),
            'jadwal' => $this->post('jadwal'),
            'catatan' => $this->post('catatan')
        ];
        $this->marketing->updatePlotTim($data, $id);
        $this->response([
            'status' => true,
            'message' => 'Data berhasil diubah'
        ], RestController::HTTP_OK);
    }

    public function getLeadsByTim_get(){
        $id_pengguna = $this->input->get('id_pengguna');
        $page_size = $_GET['pageSize'];
        $page_number = ($_GET['pageNumber'] - 1) * $page_size;
        $data = $this->marketing->getLeadsByTim($id_pengguna, $page_size, $page_number);

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

    public function getTotalLeadsByTim_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $data = $this->marketing->getTotalLeadsByTim($id_pengguna);

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

    //Get filter
    public function leadsByTimFiltered_post()
    {
        $id_pengguna = $this->input->post('id_pengguna');
        $nama_perusahaan = $this->input->post('nama_perusahaan');
        $status = $this->input->post('status');
        $data = $this->marketing->getLeadsByTimFiltered($id_pengguna, $nama_perusahaan, $status);

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
        }
    }

    public function getKontakLeadById_get($id){
        $data = $this->marketing->getKontakLeadById($id);

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

    public function getHistoryMarketing_get($id){
        $data = $this->marketing->getHistoryMarketing($id);

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

    public function insertHistory_post() {
        $data = [
            'id_lead' => $this->post('id_lead'),
            // $id_team = $this->post('id_team'),
            'jadwal' => $this->post('jadwal'),
            'catatan' => $this->post('catatan'),
            'status' => $this->post('status'),
        ];

        $res = $this->supplier->insertPlotMarketing($data);

        if ($res) {
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
}