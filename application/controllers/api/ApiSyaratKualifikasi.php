<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiSyaratKualifikasi extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/SyaratKualifikasi_model');
    }

    public function getId_get($id_tender)
    {
        $resultSyarat = $this->SyaratKualifikasi_model->getSyaratById($id_tender);

        if ($resultSyarat) {
            $this->response([
                'status' => true,
                'data' => $resultSyarat,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}
