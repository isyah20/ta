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

class ApiAnalytic extends RestController {

    use \App\models\traits\Supplier;
    use User;
    use ClientApi;

    public function __construct() {
        parent::__construct();
        $this->load->model('api/Supplier_api');
        $this->load->model('api/Pengguna_model');
        $this->load->model('api/Analytic_model');
        $this->load->model('Supplier_model');
        $this->load->model('Tender_model');
        $this->load->model('Preferensi_model', 'preferensi');
        $this->load->library('form_validation', 'google');
        $this->load->helper('form');
        $this->init();
    }

    public function getPesertaTender_get() {
        // $id = $this->get('id_peserta');
        // $page_size = $this->get('pageSize');
        // $page_number = ($this->get('pageNumber') - 1) * $page_size;
        $data = [
            'id_pengguna' => $this->get('id_pengguna'),
            'keyword' => $this->get('keyword'),
            'pageSize' => $this->get('pageSize'),
            'pageNumber' => $this->get('pageNumber')
        ];

        $res = $this->Analytic_model->getPesertaTender($data)->result();

        if ($res) {
            $this->response([
                'status' => true,
                'data' => $res
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getCountPerMonth_get() {
        $id_pengguna = $this->input->get('id_pengguna');

        $res = $this->Analytic_model->getWinner($id_pengguna)->result();

        if ($res) {
            $this->response([
                'status' => true,
                'data' => $res
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getPesertaDaftar_get() {
        $id_pengguna = $this->input->get('id_pengguna');
        $res = $this->Analytic_model->getPesertaMendaftar($id_pengguna)->result();

        if ($res) {
            $this->response([
                'status' => true,
                'data' => $res
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

}