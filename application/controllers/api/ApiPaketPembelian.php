<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiPaketPembelian extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/PaketPembelian_model', 'paketpembelian');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultPaketPem = $this->paketpembelian->getAllPaketPembelian();

        if ($resultPaketPem) {
            $this->response([
                'status' => true,
                'data' => $resultPaketPem,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => true,
                'message' => 'Data is empty',
            ], RestController::HTTP_OK);
        }
    }
}
