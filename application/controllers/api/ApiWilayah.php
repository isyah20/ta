<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiWilayah extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Wilayah_model');
        // $this->load->model('Wilayah_model');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultWilayah = $this->Wilayah_model->getAllWilayah();

        if ($resultWilayah) {
            $this->response([
                'status' => true,
                'data' => $resultWilayah,
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
        $resultWilayah = $this->Wilayah_model->getWilayahById($id);

        if ($resultWilayah) {
            $this->response([
                'status' => true,
                'data' => $resultWilayah,
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

        $resultWilayah = $this->Wilayah_model->getSearchWilayah($keyword);

        if ($resultWilayah) {
            $this->response([
                'status' => true,
                'data' => $resultWilayah,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'keyword tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getWilayahByName_post()
    {
        // echo "hsajsa";

        $nama = htmlspecialchars($this->post('nama', true));

        // var_dump($nama);

        $resultWilayah = $this->Wilayah_model->getWilayahByName(strtolower($nama));

        if ($resultWilayah) {
            $this->response([
                'status' => true,
                'data' => $resultWilayah,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'keyword tidak ditemukan',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function create_post()
    {
        $data = [
            'wilayah' => htmlspecialchars($this->post('wilayah', true)),
        ];

        $resultWilayah = $this->Wilayah_model->tambahWilayah($data);

        if ($resultWilayah > 0) {
            $this->response([
                'status' => true,
                'message' => 'Wilayah berhasil ditambahkan',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Wilayah gagal ditambahkan',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function update_put($id)
    {
        $data = [
            'wilayah' => htmlspecialchars($this->put('wilayah', true)),
        ];

        $resultWilayah = $this->Wilayah_model->ubahWilayah($id, $data);
        if ($resultWilayah > 0) {
            $this->response([
                'status' => true,
                'message' => 'Wilayah berhasil diupdate',
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
        $resultWilayah = $this->Wilayah_model->hapusWilayah($id);

        if ($resultWilayah > 0) {
            $this->response([
                'status' => true,
                'message' => 'Wilayah berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Wilayah gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // Custom API
    public function namaNamaWilayahById_post()
    {
        $idWilayah = $this->post('id_wilayah', true);
        // var_dump($idWilayah);
        $resultWilayah = $this->Wilayah_model->getNamaNamaWilayahById($idWilayah);
        // var_dump($resultWilayah);
        $result = [];
        foreach ($resultWilayah as $item) {
            $result[] = $item['wilayah'];
        }

        if ($resultWilayah) {
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
