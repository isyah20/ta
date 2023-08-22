<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

class ApiHasilEvaluasi extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/HasilEvaluasi_model');
    }

    public function index_get()
    {
        $result = $this->HasilEvaluasi_model->getAllHasilEvaluasi();

        if ($result) {
            $this->response([
                'status' => true,
                'data' => $result,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Hasil Evaluasi not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getId_get($id)
    {
        $result = $this->HasilEvaluasi_model->getEvaluasiByIdTender($id);

        if ($result) {
            $this->response([
                'status' => true,
                'data' => $result,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_OK);
        }
    }
}
