<?php

defined('BASEPATH') or exit('No direct script access allowed');
// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

class APIPreferensi extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Preferensi_model');
    }

    public function index_get()
    {
        $resultPreferensi = $this->Preferensi_model->getAllPreferensi();

        if ($resultPreferensi) {
            $this->response([
                'status' => true,
                'data' => $resultPreferensi,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getByIdUser_get($id)
    {
        $preferensi = $this->Preferensi_model->getPreferensiByIdUser($id);
        if ($preferensi) {
            $this->response([
                'status' => true,
                'data' => $preferensi,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data is empty',
            ], RestController::HTTP_OK);
        }

        // if ($preferensi) {
        //     $this->response([
        //         'status' => true,
        //         'data' => $preferensi
        //     ], RestController::HTTP_OK);
        // } else {
        //     $this->response([
        //         'status' => false,
        //         'message' => 'Preferensi Belum ada, Silahkan pilih LPSE atau lainnya untuk dimonitor'
        //     ], RestController::HTTP_NOT_FOUND);
        // }
    }

    public function getId_get($id)
    {
        $preferensi = $this->Preferensi_model->getPreferensiById($id);
        if ($preferensi) {
            $this->response([
                'status' => true,
                'data' => $preferensi,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Preferensi Belum ada, Silahkan pilih LPSE atau lainnya untuk dimonitor',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getIdPref_get($id)
    {
        $preferensi = $this->Preferensi_model->getPreferensiByIdPref($id);
        if ($preferensi) {
            $this->response([
                'status' => true,
                'data' => $preferensi,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Preferensi tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {
        $data = [
            'id_pengguna' => $this->post('id_pengguna'),
            'id_kategori_lpse' => $this->post('id_kategori_lpse'),
            'id_lpse' => $this->post('id_lpse'),
            'id_jenis_tender' => $this->post('id_jenis_tender'),
            'id_wilayah' => $this->post('id_wilayah'),
            'kualifikasi' => $this->post('kualifikasi'),
            'nilai_hps' => $this->post('nilai_hps'),
            'tgl_update' => date('Y-m-d H:i:s'),
        ];

        $resultPreferensi = $this->Preferensi_model->tambahPreferensi($data);
        if ($resultPreferensi) {
            $this->response([
                'status' => true,
                'data' => $resultPreferensi,
                'message' => 'Preferensi has been created',
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to create new data',
            ], 400);
        }
    }

    public function create_post()
    {
        // var_dump($this->post('nama_profil'));
        // die();
        $data = [
            'id_pengguna' => $this->post('id_pengguna'),
            'nama_profil' => $this->post('nama_profil'),
            'keyword' => $this->post('keyword'),
            'id_kategori_lpse' => $this->post('id_kategori_lpse'),
            'id_lpse' => $this->post('id_lpse'),
            'id_jenis_tender' => $this->post('id_jenis_tender'),
            'id_wilayah' => $this->post('id_wilayah'),
            'kualifikasi' => $this->post('kualifikasi'),
            'nilai_hps' => $this->post('nilai_hps'),
            'tgl_update' => date('Y-m-d H:i:s'),
            'status_preferensi' => $this->post('status_preferensi'),
        ];

        $resultPreferensi = $this->Preferensi_model->createPreferensi($data);
        if ($resultPreferensi) {
            $this->response([
                'status' => true,
                'data' => $resultPreferensi,
                'message' => 'Preferensi has been created',
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to create new data',
            ], 400);
        }
    }

    public function preferensiTender_get($id)
    {
        $preferensi = $this->Preferensi_model->getPreferensiById($id);

        $klpd = (string) $preferensi[0]['id_kategori_lpse'];
        $lpse = (string) $preferensi[0]['id_lpse'];
        $jenisPengadaan = (string) $preferensi[0]['id_jenis_tender'];
        $wilayah = (string) $preferensi[0]['id_wilayah'];
        $kualifikasi = (string) $preferensi[0]['kualifikasi'];
        $hps = (string) $preferensi[0]['nilai_hps'];

        if ($klpd == 'null' && $lpse == 'null' && $jenisPengadaan == 'null' && $wilayah == 'null' && $kualifikasi == 'null' && $hps == 'null') {
            $this->response([
                'status' => false,
                'message' => 'Preferensi Belum ada, Silahkan pilih LPSE atau lainnya untuk dimonitor',
            ], 404);
        } else {
            $data = $this->Preferensi_model->getPreferensiTender($lpse, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi);

            if ($data) {
                $this->response([
                    'status' => true,
                    'data' => $data,
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Tender Tidak ada, Silahkan pilih preferensi lainnya',
                ], 404);
            }
        }
    }

    public function update_put($id)
    {
        $data = [
            'id_kategori_lpse' => $this->put('id_kategori_lpse'),
            'id_lpse' => $this->put('id_lpse'),
            'id_jenis_tender' => $this->put('id_jenis_tender'),
            'id_wilayah' => $this->put('id_wilayah'),
            'nilai_hps' => $this->put('nilai_hps'),
            'kualifikasi' => $this->put('kualifikasi'),
            'tgl_update' => date('Y-m-d H:i:s'),
        ];

        $data_new = [];
        foreach ($data as $key => $value) {
            if ($value != 'null' or $value != null) {
                $data_new[$key] = $value;
            }
        }

        $preferensi = $this->Preferensi_model->updatePreferensi($id, $data_new);

        if ($preferensi) {
            $this->response([
                'status' => true,
                'message' => 'Preferensi Berhasil diubah',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal mengubah preferensi',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function updateByIdPref_put($id)
    {
        $data = [
            'nama_profil' => $this->put('nama_profil'),
            'id_kategori_lpse' => $this->put('id_kategori_lpse'),
            'id_lpse' => $this->put('id_lpse'),
            'id_jenis_tender' => $this->put('id_jenis_tender'),
            'id_wilayah' => $this->put('id_wilayah'),
            'nilai_hps' => $this->put('nilai_hps'),
            'kualifikasi' => $this->put('kualifikasi'),
            'tgl_update' => date('Y-m-d H:i:s'),
            'status_preferensi' => $this->put('status_preferensi'),
        ];

        $data_new = [];
        foreach ($data as $key => $value) {
            if ($value != 'null' or $value != null) {
                $data_new[$key] = $value;
            }
        }

        $preferensi = $this->Preferensi_model->updatePreferensiByIdPref($id, $data_new);

        if ($preferensi) {
            $this->response([
                'status' => true,
                'message' => 'Preferensi Berhasil diubah',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal mengubah preferensi',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function tenderS_post($id)
    {
        $keyword = $this->post('s', true);
        $orderby = $this->post('orderby', true);

        $data = $this->Preferensi_model->tenderSearch($id, $keyword, $orderby);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data,
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tender Tidak ditemukan',
            ], 404);
        }
    }

    public function destroy_delete($id)
    {
        $resultPreferensi = $this->Preferensi_model->hapusPreferensi($id);

        if ($resultPreferensi) {
            $this->response([
                'status' => true,
                'message' => 'Preferensi berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Preferensi gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
