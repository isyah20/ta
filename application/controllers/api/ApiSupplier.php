<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace

use App\components\traits\ClientApi;
use chriskacerguis\RestServer\RestController;
use App\components\UserCategory;
use App\components\traits\User;

class ApiSupplier extends RestController
{
    use \App\models\traits\Supplier;
    use User;
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Supplier_api');
        // $this->init();
    }

    public function index_get()
    {
        $data = $this->Supplier_api->getTimMarketing();
        
        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getbyId_get()
    {
        $id = $this->get('id_tim');
        $data = $this->Supplier_api->getTimMarketingById($id);
        
        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function create_post()
    {
        $data = [
            'nama_tim' => $this->post('nama_tim'),
            'posisi' => $this->post('posisi'),
            'no_telp' => $this->post('no_telp'),
            'email' => $this->post('email'),
            'alamat' => $this->post('alamat'),
        ];

        if ($this->Supplier_api->createTimMarketing($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal ditambahkan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function deleteTim_delete($id)
    {
        // $id = $this->get('id_tim');
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->Supplier_api->deleteTimMarketing($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data berhasil dihapus'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function editTimMarketing_post($id)
    {
        // $id = $this->post('id_tim');
        $data = [
            'nama_tim' => $this->post('nama_tim'),
            'posisi' => $this->post('posisi'),
            'no_telp' => $this->post('no_telp'),
            'email' => $this->post('email'),
            'alamat' => $this->post('alamat'),
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else if ($this->Supplier_api->updateTimMarketing($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal diubah'
            ], RestController::HTTP_BAD_REQUEST);
        }
        // if ($this->Supplier_api->updateTimMarketing($data, $id) > 0) {
        //     $this->response([
        //         'status' => true,
        //         'message' => 'Data berhasil diubah'
        //     ], RestController::HTTP_OK);
        // } else {
        //     $this->response([
        //         'status' => false,
        //         'message' => 'Data gagal diubah'
        //     ], RestController::HTTP_BAD_REQUEST);
        // }
    }
}