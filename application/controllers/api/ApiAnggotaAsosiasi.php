<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\ColumnIterator;

//  to use RestController class we need to extend it to our controller class
class ApiAnggotaAsosiasi extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/AnggotaAsosiasi_model');
        $this->load->model('Asosiasi_model');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultAnggotaAsosiasi = $this->Asosiasi_model->getAll();

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

    public function getAsosiasiAnggota_get() {
        // input id pengguna
        $id_pengguna = $this->input->get('id_pengguna');

        $response = $this->AnggotaAsosiasi_model->getAsosiasiAnggota($id_pengguna);

        if ($response) {
            $this->response([
                'status' => true,
                'data' => $response
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getAnggotaAsosiasi_get() {
        $id_pengguna = $this->input->get('id_pengguna');

        $res = $this->AnggotaAsosiasi_model->getAnggotaAsosiasi($id_pengguna);

        if($res) {
            $this->response([
                'status' => true,
                'data' => $res
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getDataChart_get(){
        $id_pengguna = $this->input->get('id_pengguna');

        $res = $this->AnggotaAsosiasi_model->getDataCharts($id_pengguna);

        if ($res) {
            $this->response([
                'status' => true,
                'data' => $res
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function upload_excel() {
        // Upload configuration
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv|xls|xlsx';
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('excel_file')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = $this->upload->data();
            $file_path = './uploads/' . $data['file_name'];
    
            // Load the PhpSpreadsheet library
            $this->load->library('PhpSpreadsheet');
    
            // Read the Excel file
            $spreadsheet = $this->phpspreadsheet->load($file_path);
            $sheet = $spreadsheet->getActiveSheet();
    
            // Get the highest row and column
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
    
            // Loop through each row of the worksheet
            for ($row = 1; $row <= $highestRow; $row++) {
                // Get cell values
                $npwp = $sheet->getCellByColumnAndRow(1, $row)->getValue();
                // $column2 = $sheet->getCellByColumnAndRow(2, $row)->getValue();
                // ... add more columns as needed
    
                // Insert data into the database
                $data = array(
                    'npwp' => $npwp,
                    // 'column2' => $column2,
                    // ... add more columns as needed
                );
    
                $this->db->insert('anggota_asoiasi', $data);
            }
    
            // Delete the uploaded file
            unlink($file_path);
    
            // echo 'Data inserted successfully.';
        }
    }

    public function insertNewAnggota_post(){
        $data = [
            'id_pengguna' => htmlspecialchars((string) $this->post('id_pengguna', true)),
            'npwp' => htmlspecialchars((string) $this->post('npwp', true)),
        ];

        $resp = $this->AnggotaAsosiasi_model->insertAnggota($data);

        if ($resp) {
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
    
    
}
