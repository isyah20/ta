<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiPerubahanJadwal extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Jadwal_model');
        $this->load->model('api/PerubahanJadwal_model');
    }

    public function getPerubahanJadwal_get($id)
    {
        $resultPerubahan = $this->perubahan->getPerubahanJadwalByIdPerubahan($id);

        if ($resultPerubahan) {
            $this->response([
                'status' => true,
                'data' => $resultPerubahan,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan',
            ], RestController::HTTP_OK);
        }
    }

    public function create_post()
    {
        $data = [
            'id_perubahan' => htmlspecialchars($this->post('id_perubahan', true)),
            'tgl_mulai' => date($this->post('tgl_mulai', true)),
            'tgl_akhir' => date($this->post('tgl_akhir', true)),
            'tgl_diedit' => date('Y-m-d H:i:s'),
            'keterangan' => htmlspecialchars($this->post('keterangan', true)),
        ];

        $resultPerubahanJadwal = $this->PerubahanJadwal_model->tambahPerubahanJadwal($data);

        if ($resultPerubahanJadwal) {
            $this->response([
                'status' => true,
                'message' => 'Perubahan jadwal berhasil ditambahkan',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Perubahan jadwal gagal ditambahkan',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function update_put($id)
    {
        $data = [
            'id_tender' => htmlspecialchars($this->put('id_tender', true)),
            'id_tahapan' => htmlspecialchars($this->put('id_tahapan', true)),
            'tgl_mulai' => date($this->put('tgl_mulai', true)),
            'tgl_akhir' => date($this->put('tgl_akhir', true)),
            'perubahan' => htmlspecialchars($this->put('perubahan', true)),
        ];

        $data_new = [];
        foreach ($data as $key => $value) {
            if ($value) {
                $data_new[$key] = $value;
            }
        }
        $resultJadwal = $this->Jadwal_model->ubahJadwal($id, $data_new);
        if ($resultJadwal) {
            $this->response([
                'status' => true,
                'message' => 'Jadwal berhasil diupdate',
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
        $resultJadwal = $this->Jadwal_model->hapusJadwal($id);

        if ($resultJadwal) {
            $this->response([
                'status' => true,
                'message' => 'Jadwal berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Jadwal gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
