<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiPemenang extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Pemenang_model');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultPemenang = $this->Pemenang_model->getAllPemenang();

        if ($resultPemenang) {
            $this->response([
                'status' => true,
                'data' => $resultPemenang,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getIdTahapan_get()
    {
        $resultPemenang = $this->Pemenang_model->getAllPemenangbyIdTahapan();

        if ($resultPemenang) {
            $this->response([
                'status' => true,
                'data' => $resultPemenang,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getDataPemenang_post()
    {
        $limit = htmlspecialchars($this->post('limit', true));
        $start = htmlspecialchars($this->post('start', true));
        $resultPemenang = $this->Pemenang_model->getPemenangbyIdTahapanLim($limit, $start);

        if ($resultPemenang) {
            $this->response([
                'status' => true,
                'data' => $resultPemenang,
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
        $resultPemenang = $this->Pemenang_model->getPemenangById($id);

        if ($resultPemenang) {
            $this->response([
                'status' => true,
                'data' => $resultPemenang,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function create_post()
    {
        $data = [
            'id_tender' => htmlspecialchars($this->post('id_tender', true)),
            'npwp' => htmlspecialchars($this->post('npwp', true)),
            'harga_negosiasi' => htmlspecialchars($this->post('harga_negosiasi', true)),
            'harga_kontrak' => htmlspecialchars($this->post('harga_kontrak', true)),
            'nilai_pdn' => htmlspecialchars($this->post('nilai_pdn', true)),
            'nilai_umk' => htmlspecialchars($this->post('nilai_umk', true)),
        ];

        $resultPemenang = $this->Pemenang_model->tambahPemenang($data);
        if ($resultPemenang) {
            $this->response([
                'status' => true,
                'data' => $resultPemenang,
                'message' => 'Pengguna berhasil ditambahkan',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Pengguna gagal ditambahkan',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function update_put($id)
    {
        $data = [
            'npwp' => htmlspecialchars($this->put('npwp', true)),
            'harga_negosiasi' => htmlspecialchars($this->put('harga_negosiasi', true)),
            'harga_kontrak' => htmlspecialchars($this->put('harga_kontrak', true)),
            'nilai_pdn' => htmlspecialchars($this->put('nilai_pdn', true)),
            'nilai_umk' => htmlspecialchars($this->put('nilai_umk', true)),
        ];
        $data_new = [];
        foreach ($data as $key => $value) {
            if ($value) {
                $data_new[$key] = $value;
            }
        }
        $resultPemenang = $this->Pemenang_model->ubahPemenang($id, $data_new);
        if ($resultPemenang) {
            $this->response([
                'status' => true,
                'message' => 'pengguna berhasil diupdate',
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
        $resultPemenang = $this->Pemenang_model->hapusPemenang($id);

        if ($resultPemenang) {
            $this->response([
                'status' => true,
                'message' => 'Pengguna berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Pengguna gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function getId_get2($id)
    {
        $result = $this->Pemenang_model->getPemenangByIdTender($id);

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

    public function getTenderId_get($id)
    {
        $result = $this->Pemenang_model->getPemenangByIdTender($id);

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

    public function getAllPemenangbyLpse_post()
    {
        $id = htmlspecialchars((string) $this->post('lpse', true));
        // var_dump($id);
        $result = $this->Pemenang_model->getAllPemenangbyLpse($id);

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

    public function getAllPemenangbyLpse_get()
    {
        $result = $this->Pemenang_model->getAllPemenangbyLpseA();

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

    public function jmldata_get()
    {
        $result = $this->Pemenang_model->id_jenistender();

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

    // Know Your Market
    public function getPemenangPerMonthByLpse_post()
    {
        $klpd = htmlspecialchars((string) $this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars((string) $this->post('jenisPengadaan', true));
        $hps = htmlspecialchars($this->post('hps', true));
        $tahun = htmlspecialchars($this->post('tahun', true));

        $result = $this->Pemenang_model->getPemenangPerMonthByLpse($klpd, $jenisPengadaan, $hps, $tahun);

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
    public function getDataTotal_get()
    {
        $result = $this->Pemenang_model->getPemenangTotal();

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
