<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiPesertaTender extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/PesertaTender_model');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultPesertaTender = $this->PesertaTender_model->getAllPesertaTender();

        if ($resultPesertaTender) {
            $this->response([
                'status' => true,
                'data' => $resultPesertaTender,
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
        $resultPesertaTender = $this->PesertaTender_model->getPesertaTenderById($id);

        if ($resultPesertaTender) {
            $this->response([
                'status' => true,
                'data' => $resultPesertaTender,
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
            'harga_penawaran' => htmlspecialchars($this->post('harga_penawaran', true)),
            'harga_terkoreksi' => htmlspecialchars($this->post('harga_terkoreksi', true)),
        ];

        $resultPesertaTender = $this->PesertaTender_model->tambahPesertaTender($data);
        if ($resultPesertaTender) {
            $this->response([
                'status' => true,
                'data' => $resultPesertaTender,
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
            'id_tender' => htmlspecialchars($this->post('id_tender', true)),
            'npwp' => htmlspecialchars($this->post('npwp', true)),
            'harga_penawaran' => htmlspecialchars($this->post('harga_penawaran', true)),
            'harga_terkoreksi' => htmlspecialchars($this->post('harga_terkoreksi', true)),
        ];
        $data_new = [];
        foreach ($data as $key => $value) {
            if ($value) {
                $data_new[$key] = $value;
            }
        }
        $resultPesertaTender = $this->PesertaTender_model->ubahPesertaTender($id, $data_new);
        if ($resultPesertaTender) {
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
        $resultPesertaTender = $this->PesertaTender_model->hapusPesertaTender($id);

        if ($resultPesertaTender) {
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
}
