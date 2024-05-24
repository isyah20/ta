<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiKategoriLpse extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/KategoriLpse_model', 'kategoriLpse');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultKategoriLpse = $this->kategoriLpse->getAllKategoriLpse();

        if ($resultKategoriLpse) {
            $this->response([
                'status' => true,
                'data' => $resultKategoriLpse,
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
        $resultKategoriLpse = $this->kategoriLpse->getKategoriLpseById($id);

        if ($resultKategoriLpse) {
            $this->response([
                'status' => true,
                'data' => $resultKategoriLpse,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id_kategori tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function create_post()
    {
        $data = [
            'nama_kategori' => htmlspecialchars($this->post('nama_kategori', true)),
        ];

        $resultKategoriLpse = $this->kategoriLpse->tambahKategoriLpse($data);

        if ($resultKategoriLpse) {
            $this->response([
                'status' => true,
                'message' => 'Kategori LPSE berhasil ditambahkan',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Kategori LPSE gagal ditambahkan',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function update_put($id)
    {
        $data = [
            'nama_kategori' => htmlspecialchars($this->put('nama_kategori', true)),
        ];
        $data_new = [];
        foreach ($data as $key => $value) {
            if ($value) {
                $data_new[$key] = $value;
            }
        }
        $resultKategoriLpse = $this->kategoriLpse->ubahKategoriLpse($id, $data_new);
        if ($resultKategoriLpse) {
            $this->response([
                'status' => true,
                'message' => 'Kategori LPSE berhasil diupdate',
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
        $resultKategoriLpse = $this->kategoriLpse->hapusKategoriLpse($id);

        if ($resultKategoriLpse) {
            $this->response([
                'status' => true,
                'message' => 'Kategori LPSE berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Kategori LPSE gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // Custom API
    public function namaNamaKategoriById_post()
    {
        $idkategori = $this->post('id_kategori', true);
        // var_dump($idLpse);
        $resultkategori = $this->kategoriLpse->getNamaNamaKategoriById($idkategori);
        $result = [];
        foreach ($resultkategori as $item) {
            $result[] = $item['nama_kategori'];
        }

        if ($resultkategori) {
            $this->response([
                'status' => true,
                'data' => $result,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data is empty',
            ], RestController::HTTP_OK);
        }
    }
}
