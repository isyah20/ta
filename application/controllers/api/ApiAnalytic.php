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
        $page_size = $this->get('pageSize');
        $page_number = ($this->get('pageNumber') - 1) * $page_size;
        $data = $this->Analytic_model->getPesertaTender($page_size, $page_number);

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