<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiPaket extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Paket_model');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultPaket = $this->Paket_model->getAllPaket();

        if ($resultPaket) {
            $this->response([
                'status' => true,
                'data' => $resultPaket,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getId_get($id)
    {
        $resultPaket = $this->Paket_model->getPaketById($id);

        if ($resultPaket) {
            $this->response([
                'status' => true,
                'data' => $resultPaket,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    // Halaman Know Your Market
    public function searchHpsPerMonth_post()
    {
        $klpd = htmlspecialchars($this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars($this->post('jenisPengadaan', true));
        // $rentangHps = htmlspecialchars($this->post('rentangHps', true));
        $tahun = htmlspecialchars($this->post('tahun', true));

        $resultTender = $this->Paket_model->getHpsPerMonth($klpd, $jenisPengadaan, $tahun);

        if ($resultTender > 0) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tender gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
