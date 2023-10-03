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
}