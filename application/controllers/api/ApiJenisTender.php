<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiJenisTender extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/JenisTender_model');
        // $this->load->model('Wilayah_model');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultJenisTender = $this->JenisTender_model->getAllJenisTender();

        if ($resultJenisTender) {
            $this->response([
                'status' => true,
                'data' => $resultJenisTender,
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
        $resultJenisTender = $this->JenisTender_model->getJenisTenderById($id);

        if ($resultJenisTender) {
            $this->response([
                'status' => true,
                'data' => $resultJenisTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function search_post()
    {
        // echo "hsajsa";

        $keyword = htmlspecialchars($this->post('keyword', true));

        // var_dump($keyword);

        $resultJenisTender = $this->JenisTender_model->getSearchJenisTender($keyword);

        if ($resultJenisTender) {
            $this->response([
                'status' => true,
                'data' => $resultJenisTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'keyword tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function create_post()
    {
        $data = [
            'jenis_tender' => htmlspecialchars($this->post('jenis_tender', true)),
        ];

        $resultJenisTender = $this->JenisTender_model->tambahJenisTender($data);

        if ($resultJenisTender > 0) {
            $this->response([
                'status' => true,
                'message' => 'Jenis Tender berhasil ditambahkan',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Jenis Tender gagal ditambahkan',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function update_put($id)
    {
        $data = [
            'jenis_tender' => htmlspecialchars($this->put('jenis_tender', true)),
        ];
        $data_new = [];
        foreach ($data as $key => $value) {
            if ($value) {
                $data_new[$key] = $value;
            }
        }
        $resultJenisTender = $this->JenisTender_model->ubahJenisTender($id, $data_new);
        if ($resultJenisTender) {
            $this->response([
                'status' => true,
                'message' => 'Jenis Tender berhasil diupdate',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal mengupdate data',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function destroy_delete($id)
    {
        $resultJenisTender = $this->JenisTender_model->hapusJenisTender($id);

        if ($resultJenisTender > 0) {
            $this->response([
                'status' => true,
                'message' => 'JenisTender berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'JenisTender gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // Custom API
    public function namaNamaJenisTenderById_post()
    {
        $idJenis = $this->post('id_jenis', true);
        // var_dump($idLpse);
        $resultJenis = $this->JenisTender_model->getNamaNamaJenisTenderById($idJenis);
        $result = [];
        foreach ($resultJenis as $item) {
            $result[] = $item['jenis_tender'];
        }

        if ($resultJenis) {
            $this->response([
                'status' => true,
                'data' => $result,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data is empty',
            ], RestController::HTTP_OK);
        }
    }
}
