<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace

use App\components\traits\ClientApi;
use chriskacerguis\RestServer\RestController;
use App\components\UserCategory;
use App\components\traits\User;
use App\components\UserType;

class ApiPreferensi extends RestController
{
    use \App\models\traits\Supplier;
    use User;
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('api/Supplier_api');
        // $this->load->model('api/Pengguna_model');
        // $this->load->model('Supplier_model');
        // $this->load->model('Tender_model');
        $this->load->model('Preferensi_model', 'preferensi');
        $this->init();
    }

    public function getPreferensiPengguna_get($id)
    {
        $res = $this->preferensi->getPreferensiPengguna($id)->row();

        if ($res) {
            $this->response([
                'status' => true,
                'data' => $res
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0,
                'message' => 'Data tidak ditemukannnnnnn'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getPreferensiListJenisTender_get($jenis)
    {
        $response = $this->preferensi->getPreferensiListJenisTender($jenis)->result();

        if ($response) {
            $this->response([
                'status' => true,
                'data' => $response
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0,
                'message' => 'Data tidak ditemukannnnnnn'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getPreferensiJenisTender_get($id)
    {
        $response = $this->preferensi->getPreferensiJenisTender($id)->row();

        if ($response) {
            $this->response([
                'status' => true,
                'data' => $response
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getPreferensiListLPSE_get()
    {
        $response = $this->preferensi->getPreferensiListLPSE()->result();

        if ($response) {
            $this->response([
                'status' => true,
                'data' => $response
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 0,
                'message' => 'Data tidak ditemukannnnnnn'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function simpanPreferensi_post()
    {
        parse_str(file_get_contents('php://input'), $data);
        
        $nilai_hps_awal = str_replace('.', '', $data['nilai_hps_awal']);
        $nilai_hps_akhir = str_replace('.', '', $data['nilai_hps_akhir']);
        if ($data['all_lpse'] == '1') $lpse = ''; else $lpse = implode('|', $data['id_lpse']);

        if ($data['id_preferensi'] == '') {
            $id_pengguna = get_cookie('id_pengguna');
            
            $param = [
                "id_pengguna" => $id_pengguna,
                "nama_profil" => 'Primary',
                "keyword" => implode('|', $data['keyword']),
                "id_lpse" => $lpse,
                "jenis_pengadaan" => implode(',', $data['kategori']),
                "nilai_hps_awal" => $nilai_hps_awal,
                "nilai_hps_akhir" => $nilai_hps_akhir,
                "tgl_update" => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('preferensi', $param);
        } else {
            $param = [
                "nama_profil" => 'Primary',
                "keyword" => implode('|', $data['keyword']),
                "id_lpse" => $lpse,
                "jenis_pengadaan" => implode(',', $data['kategori']),
                "nilai_hps_awal" => $nilai_hps_awal,
                "nilai_hps_akhir" => $nilai_hps_akhir,
                "tgl_update" => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('id_preferensi', $data['id_preferensi'])
                     ->update('preferensi', $param);
        }

        if ($this->db->affected_rows() > 0) {
            $this->response([
                'status' => true,
                'message' => 'Preferensi tender berhasil disimpan.'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Preferensi tender gagal disimpan.'
            ], RestController::HTTP_NOT_FOUND);
        }
                 
        // $response = array(
	    //     'Success' => true,
            
	    //     'Info' => 'Preferensi tender berhasil disimpan.',
	    // );
    }
}
