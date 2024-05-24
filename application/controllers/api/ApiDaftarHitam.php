<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiDaftarHitam extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Daftarhitam_model');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultDaftarhitam = $this->Daftarhitam_model->getAllDaftarHitam();

        if ($resultDaftarhitam) {
            $this->response([
                'status' => true,
                'data' => $resultDaftarhitam,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function daftarhitambynpwp_get()
    {
        $resultDaftarhitam = $this->Daftarhitam_model->getDaftarHItamByNpwp();

        if ($resultDaftarhitam) {
            $this->response([
                'status' => true,
                'data' => $resultDaftarhitam,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function jmldatablacklist_get()
    {
        $resultDaftarhitam = $this->Daftarhitam_model->getjmlblacklist();

        if ($resultDaftarhitam) {
            $this->response([
                'status' => true,
                'data' => $resultDaftarhitam,
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
        $resultDaftarhitam = $this->Daftarhitam_model->getPenggunaDaftarHitamById($id);

        if ($resultDaftarhitam) {
            $this->response([
                'status' => true,
                'data' => $resultDaftarhitam,
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
            'npwp' => htmlspecialchars((string) $this->post('npwp', true)),
            'status' => htmlspecialchars((string) $this->post('status', true)),
            'tgl_tayang' => htmlspecialchars((string) $this->post('tgl_tayang', true)),
            'masa_berlaku_sanksi' => htmlspecialchars((string) $this->post('masa_berlaku_sanksi', true)),
            'sk_penetapan' => htmlspecialchars((string) $this->post('sk_penetapan', true)),
        ];

        $resultDaftarhitam = $this->Daftarhitam_model->tambahDaftarHitam($data);

        if ($resultDaftarhitam) {
            $this->response([
                'status' => true,
                'message' => 'Daftar hitam berhasil ditambahkan',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Daftar hitam ditambahkan',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function update_put($id)
    {
        $data = [
            'npwp' => htmlspecialchars($this->put('npwp', true)),
            'status' => htmlspecialchars($this->put('status', true)),
            'tgl_tayang' => htmlspecialchars($this->put('tgl_tayang', true)),
            'masa_berlaku_sanksi' => htmlspecialchars($this->put('masa_berlaku_sanksi', true)),
            'sk_penetapan' => htmlspecialchars($this->put('sk_penetapan', true)),
        ];

        $data_new = [];
        foreach ($data as $key => $value) {
            if ($value) {
                $data_new[$key] = $value;
            }
        }

        $resultDaftarhitam = $this->Daftarhitam_model->ubahDaftarHitam($id, $data_new);
        if ($resultDaftarhitam) {
            $this->response([
                'status' => true,
                'message' => 'Daftar hitam berhasil diupdate',
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
        $resultDaftarhitam = $this->Daftarhitam_model->hapusDaftarHitam($id);

        if ($resultDaftarhitam) {
            $this->response([
                'status' => true,
                'message' => 'Daftar hitam berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Daftar hitam gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
