<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiAnggotaAsosiasi extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/AnggotaAsosiasi_model', 'anggota');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultAnggotaAsosiasi = $this->AnggotaAsosiasi_model->getData();

        if ($resultAnggotaAsosiasi) {
            $this->response([
                'status' => true,
                'data' => $resultAnggotaAsosiasi,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getdatadinamis_post()
    {
        $search = [
            'lpse' => htmlspecialchars((string) $this->post('lpse', true)),
            'tahun' => htmlspecialchars((string) $this->post('tahun', true)),
        ];
        $id_pengguna = htmlspecialchars((string) $this->post('id_pengguna', true));
        $resultAnggotaAsosiasi = $this->AnggotaAsosiasi_model->getdatadinamis($search, $id_pengguna);

        if ($resultAnggotaAsosiasi) {
            $this->response([
                'status' => true,
                'data' => $resultAnggotaAsosiasi,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function create_post()
    {
        $data = [
            'id_pengguna' => htmlspecialchars((string) $this->post('id_pengguna', true)),
            'npwp' => htmlspecialchars((string) $this->post('npwp', true)),
        ];

        $result = $this->anggota->tambahAnggota($data);

        if ($result) {
            $this->response([
                'status' => true,
                'data' => 'Peserta Tender berhasil ditambahkan',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Peserta Tender gagal ditambahkan',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function destroy_delete($id)
    {
        $result = $this->anggota->hapusAnggota($id);

        if ($result) {
            $this->response([
                'status' => true,
                'data' => 'Peserta Tender berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Peserta Tender gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // public function testing_get()
    // {
    //     $resultAnggotaAsosiasi = $this->AnggotaAsosiasi_model->getDatatesting();

    //     if ($resultAnggotaAsosiasi) {
    //         $this->response([
    //             'status' => true,
    //             'data' => $resultAnggotaAsosiasi
    //         ], RestController::HTTP_OK);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'Data not found'
    //         ], RestController::HTTP_NOT_FOUND);
    //     }
    // }

    // public function asosiasifilter_get($year)
    // {
    //     $resultAnggotaAsosiasi = $this->AnggotaAsosiasi_model->getDataFilter($year);

    //     if ($resultAnggotaAsosiasi) {
    //         $this->response([
    //             'status' => true,
    //             'data' => $resultAnggotaAsosiasi
    //         ], RestController::HTTP_OK);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'Data not found'
    //         ], RestController::HTTP_NOT_FOUND);
    //     }
    // }

    // public function asosiasifilterhps_get($year)
    // {
    //     $resultAnggotaAsosiasi = $this->AnggotaAsosiasi_model->getDataFilterhps($year);

    //     if ($resultAnggotaAsosiasi) {
    //         $this->response([
    //             'status' => true,
    //             'data' => $resultAnggotaAsosiasi
    //         ], RestController::HTTP_OK);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'Data not found'
    //         ], RestController::HTTP_NOT_FOUND);
    //     }
    // }

    // public function asosiasibylpse_get()
    // {
    //     $resultAnggotaAsosiasi = $this->AnggotaAsosiasi_model->getdatabylpse('10', '2022');

    //     if ($resultAnggotaAsosiasi) {
    //         $this->response([
    //             'status' => true,
    //             'data' => $resultAnggotaAsosiasi
    //         ], RestController::HTTP_OK);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'Data not found'
    //         ], RestController::HTTP_NOT_FOUND);
    //     }
    // }

    // public function asosiasibylpse1_get($lpse)
    // {
    //     $resultAnggotaAsosiasi = $this->AnggotaAsosiasi_model->getdatabylpse1($lpse);
    //     if ($resultAnggotaAsosiasi) {
    //         $this->response([
    //             'status' => true,
    //             'data' => $resultAnggotaAsosiasi
    //         ], RestController::HTTP_OK);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'Data not found'
    //         ], RestController::HTTP_NOT_FOUND);
    //     }
    // }
}
