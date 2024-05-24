<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiDetailTender extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/DetailTender_model');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultDetailTender = $this->DetailTender_model->getAllDetailTender();

        if ($resultDetailTender) {
            $this->response([
                'status' => true,
                'data' => $resultDetailTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getId_get($id_tender)
    {
        $resultDetailTender = $this->DetailTender_model->getDetailTenderById($id_tender);

        if ($resultDetailTender) {
            $this->response([
                'status' => true,
                'data' => $resultDetailTender,
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
            'id_detail_tender' => $this->post('id_detail_tender'),
            'id_tender' => $this->post('id_tender'),
            'satker' => $this->post('satker', true),
            'nilai_pagu' => $this->post('nilai_pagu', true),
            'lokasi_kerja' => $this->post('lokasi_kerja', true),
            'kabupaten_kerja' => $this->post('kabupaten_kerja', true),
            'provinsi_kerja' => $this->post('provinsi_kerja', true),
            'cara_bayar' => $this->post('cara_bayar', true),
            'jumlah_peserta' => $this->post('jumlah_peserta', true),
        ];
        $resultDetailTender = $this->DetailTender_model->tambahDetailDataTender($data);

        if ($resultDetailTender > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data Tender berhasil ditambahkan',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data Tender gagal ditambahkan',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function update_put($id_detail_tender)
    {
        $data = [
            'id_tender' => $this->put('id_tender'),
            'satker' => $this->put('satker', true),
            'nilai_pagu' => $this->put('nilai_pagu', true),
            'lokasi_kerja' => $this->put('lokasi_kerja', true),
            'kabupaten_kerja' => $this->put('kabupaten_kerja', true),
            'provinsi_kerja' => $this->put('provinsi_kerja', true),
            'cara_bayar' => $this->put('cara_bayar', true),
            'jumlah_peserta' => $this->put('jumlah_peserta', true),
        ];
        $resultDetailTender = $this->DetailTender_model->ubahDetailDataTender($id_detail_tender, $data);
        if ($resultDetailTender > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data Tender berhasil diupdate',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal mengupdate Data Tender',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function destroy_delete($id_tender)
    {
        $resultDetailTender = $this->DetailTender_model->hapusDetailDataTender($id_tender);

        if ($resultDetailTender > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data Tender berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data Tender gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
