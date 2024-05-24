<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiPeserta extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Peserta_model');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultPeserta = $this->Peserta_model->getAllPeserta();

        if ($resultPeserta) {
            $this->response([
                'status' => true,
                'data' => $resultPeserta,
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
        $resultPeserta = $this->Peserta_model->getPesertaById($id);

        if ($resultPeserta) {
            $this->response([
                'status' => true,
                'data' => $resultPeserta,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getNpwp_get($npwp)
    {
        $resultPeserta = $this->Peserta_model->getPesertaByNPWP($npwp);

        if ($resultPeserta) {
            $this->response([
                'status' => true,
                'data' => $resultPeserta,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getPesertaNpwp_post()
    {
        $data = [
            'npwp' => htmlspecialchars((string) $this->post('npwp', true)),
        ];

        // var_dump($data);
        $result = $this->Peserta_model->getPesertaNpwp($data);

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

    public function create_post()
    {
        $data = [
            'npwp' => htmlspecialchars((string) $this->post('npwp', true)),
            'nama_peserta' => htmlspecialchars((string) $this->post('nama_peserta', true)),
            'alamat' => htmlspecialchars((string) $this->post('alamat', true)),
            'kelurahan' => htmlspecialchars((string) $this->post('kelurahan', true)),
            'kecamatan' => htmlspecialchars((string) $this->post('kecamatan', true)),
            'kabupaten' => htmlspecialchars((string) $this->post('kabupaten', true)),
            'provinsi' => htmlspecialchars((string) $this->post('provinsi', true)),
            'kode_klu' => htmlspecialchars((string) $this->post('kode_klu', true)),
            'klu' => htmlspecialchars((string) $this->post('klu', true)),
            'no_telp' => htmlspecialchars((string) $this->post('no_telp', true)),
            'email' => htmlspecialchars((string) $this->post('email', true)),
        ];

        $resultPeserta = $this->Peserta_model->tambahPeserta($data);
        if ($resultPeserta) {
            $this->response([
                'status' => true,
                'message' => 'Peserta berhasil ditambahkan',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Peserta gagal ditambahkan',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function update_put($id)
    {
        $data = [
            'npwp' => htmlspecialchars((string) $this->put('npwp', true)),
            'nama_peserta' => htmlspecialchars((string) $this->put('nama_peserta', true)),
            'alamat' => htmlspecialchars((string) $this->put('alamat', true)),
            'kelurahan' => htmlspecialchars((string) $this->put('kelurahan', true)),
            'kecamatan' => htmlspecialchars((string) $this->put('kecamatan', true)),
            'kabupaten' => htmlspecialchars((string) $this->put('kabupaten', true)),
            'provinsi' => htmlspecialchars((string) $this->put('provinsi', true)),
            'kode_klu' => htmlspecialchars((string) $this->put('kode_klu', true)),
            'klu' => htmlspecialchars((string) $this->put('klu', true)),
            'no_telp' => htmlspecialchars((string) $this->put('no_telp', true)),
            'email' => htmlspecialchars((string) $this->put('email', true)),
        ];
        $data_new = [];
        foreach ($data as $key => $value) {
            if ($value) {
                $data_new[$key] = $value;
            }
        }
        $resultPeserta = $this->Peserta_model->ubahPeserta($id, $data_new);
        if ($resultPeserta) {
            $this->response([
                'status' => true,
                'message' => 'Peserta berhasil diupdate',
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
        $resultPeserta = $this->Peserta_model->hapusPeserta($id);

        if ($resultPeserta) {
            $this->response([
                'status' => true,
                'message' => 'Peserta berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Peserta gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function getPesertaTender_get() {
        $npwp = $this->get('npwp');
        $response = $this->Peserta_model->getPesertaIkutTender($npwp);

        if ($response) {
            $this->response([
                'status' => true,
                'data' => $response,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}
