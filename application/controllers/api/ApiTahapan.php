<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiTahapan extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Tahapan_model', 'tahapan');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultTahapan = $this->tahapan->getAllTahapan();

        if ($resultTahapan) {
            $this->response([
                'status' => true,
                'data' => $resultTahapan,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => true,
                'message' => 'Data is empty',
            ], RestController::HTTP_OK);
        }
    }

    public function getId_get($id)
    {
        $resultTahapan = $this->tahapan->getTahapanById($id);

        if ($resultTahapan) {
            $this->response([
                'status' => true,
                'data' => $resultTahapan,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id_tahapan tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function create_post()
    {
        $this->form_validation->set_rules('nama_tahapan', 'nama_tahapan', 'required|trim');
        $this->form_validation->set_rules('icon', 'icon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->response([
                'status' => false,
                'message' => validation_errors(),
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            $data = [
                'nama_tahapan' => htmlspecialchars($this->post('nama_tahapan', true)),
                'icon' => htmlspecialchars($this->post('icon', true)),
            ];

            $resultTahapan = $this->tahapan->tambahTahapan($data);

            if ($resultTahapan) {
                $this->response([
                    'status' => true,
                    'message' => 'Tahapan berhasil ditambahkan',
                ], RestController::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Tahapan gagal ditambahkan',
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }

    public function update_put($id)
    {
        $data = [
            'nama_tahapan' => htmlspecialchars($this->put('nama_tahapan', true)),
            'icon' => htmlspecialchars($this->put('icon', true)),
        ];
        $data_new = [];
        foreach ($data as $key => $value) {
            if ($value) {
                $data_new[$key] = $value;
            }
        }
        $resultTahapan = $this->tahapan->ubahTahapan($id, $data_new);
        if ($resultTahapan) {
            $this->response([
                'status' => true,
                'message' => 'Tahapan berhasil diupdate',
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
        $resultTahapan = $this->tahapan->hapusTahapan($id);

        if ($resultTahapan) {
            $this->response([
                'status' => true,
                'message' => 'Tahapan berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tahapan gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
