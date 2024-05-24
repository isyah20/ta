<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

class ApiPesertaTender extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/PesertaTenderModel');
    }

    public function index_get()
    {
        $result = $this->PesertaTenderModel->getAllPesertaTender();

        if ($result) {
            $this->response([
                'status' => true,
                'data' => $result,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Peserta Tender not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getId_get($id)
    {
        $result = $this->PesertaTenderModel->getPesertaTenderById($id);

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

    public function getIdByIdTender_get($id)
    {
        $result = $this->PesertaTenderModel->getPesertaTenderByIdTender($id);

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

    public function getIdMonthly_get($npwp)
    {
        $result = $this->PesertaTenderModel->getPesertaTenderMonthly($npwp);

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

    public function getIdAnnual_get($npwp)
    {
        $result = $this->PesertaTenderModel->getPesertaTenderAnnual($npwp);

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

    public function getIdCompetitor_post()
    {
        $data = [
            'npwp' => htmlspecialchars((string) $this->post('npwp', true)),
        ];

        $result = $this->PesertaTenderModel->getPesertaCompetitor($data);

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

    public function getIdFilter()
    {
        $data = [
            'npwp' => htmlspecialchars((string) $this->get('npwp', true)),
            'klpd' => htmlspecialchars((string) $this->get('klpd', true)),
            'tahun' => htmlspecialchars((string) $this->get('tahun', true)),
        ];

        $result = $this->PesertaTenderModel->getPesertaTenderFilter($data);
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

    public function getIdFilter_post()
    {
        $data = [
            'npwp' => htmlspecialchars((string) $this->post('npwp', true)),
            'klpd' => htmlspecialchars((string) $this->post('klpd', true)),
            'tahun' => htmlspecialchars((string) $this->post('tahun', true)),
        ];

        $result = $this->PesertaTenderModel->getPesertaTenderFilter($data);
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

    public function getIdFilterHps_post()
    {
        $data = [
            'npwp' => htmlspecialchars((string) $this->post('npwp', true)),
            'klpd' => htmlspecialchars((string) $this->post('klpd', true)),
            'tahun' => htmlspecialchars((string) $this->post('tahun', true)),
        ];

        // var_dump($data);
        // die();
        $result = $this->PesertaTenderModel->getPesertaTenderFilterHps($data);

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

    public function getIdFilterPenurunan_post()
    {
        $data = [
            'npwp' => htmlspecialchars((string) $this->post('npwp', true)),
            'klpd' => htmlspecialchars((string) $this->post('klpd', true)),
            'tahun' => htmlspecialchars((string) $this->post('tahun', true)),
        ];

        // var_dump($data);
        $result = $this->PesertaTenderModel->getPesertaTenderFilterPenurunan($data);

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

    public function getIdFilterKlpd_post()
    {
        $data = [
            'npwp' => htmlspecialchars((string) $this->post('npwp', true)),
            'klpd' => htmlspecialchars((string) $this->post('klpd', true)),
        ];

        // var_dump($data);
        $result = $this->PesertaTenderModel->getPesertaTenderFilterKlpd($data);

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

    public function getIdFilterAkumulasi_post()
    {
        $data = [
            'npwp' => htmlspecialchars((string) $this->post('npwp', true)),
            'klpd' => htmlspecialchars((string) $this->post('klpd', true)),
            'tahun' => htmlspecialchars((string) $this->post('tahun', true)),
        ];

        // var_dump($data);
        $result = $this->PesertaTenderModel->getPesertaTenderFilterAkumulasi($data);

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

    public function getIdTotal_get($npwp)
    {
        $result = $this->PesertaTenderModel->getPesertaTenderTotal($npwp);

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

    public function getIdHps_get($npwp)
    {
        $result = $this->PesertaTenderModel->getPesertaTenderHps($npwp);

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

    public function getIdPenurunan_get($npwp)
    {
        $result = $this->PesertaTenderModel->getPesertaTenderPenurunan($npwp);

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

    public function getIdKlpd_get($npwp)
    {
        $result = $this->PesertaTenderModel->getPesertaTenderKlpd($npwp);

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
            'id_tender' => htmlspecialchars((string) $this->post('id_tender', true)),
            'npwp' => htmlspecialchars((string) $this->post('npwp', true)),
            'harga_penawaran' => htmlspecialchars((string) $this->post('harga_penawaran', true)),
            'harga_terkoreksi' => htmlspecialchars((string) $this->post('harga_terkoreksi', true)),
        ];

        $result = $this->PesertaTenderModel->tambahPesertaTender($data);

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

    public function update_put($id)
    {
        $data = [
            'id_tender' => htmlspecialchars((string) $this->put('id_tender', true)),
            'npwp' => htmlspecialchars((string) $this->put('npwp', true)),
            'harga_penawaran' => htmlspecialchars((string) $this->put('harga_penawaran', true)),
            'harga_terkoreksi' => htmlspecialchars((string) $this->put('harga_terkoreksi', true)),
        ];

        $new_data = [];

        foreach ($data as $key => $value) {
            if ($value) {
                $new_data[$key] = $value;
            }
        }

        $result = $this->PesertaTenderModel->ubahPesertaTender($id, $new_data);

        if ($result) {
            $this->response([
                'status' => true,
                'data' => 'Peserta Tender berhasil diupdate',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Peserta Tender gagal diupdate',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function destroy_delete($id)
    {
        $result = $this->PesertaTenderModel->hapusPesertaTender($id);

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

    // Know Your Market
    public function getPesertaTenderByLpse_post()
    {
        $klpd = htmlspecialchars((string) $this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars((string) $this->post('jenisPengadaan', true));
        $hps = htmlspecialchars($this->post('hps', true));
        $tahun = htmlspecialchars($this->post('tahun', true));

        $result = $this->PesertaTenderModel->getPesertaTenderByLpse($klpd, $jenisPengadaan, $hps, $tahun);

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

    public function getPemenangTender_post()
    {
        $tahun = htmlspecialchars($this->post('tahun', true));

        $result = $this->PesertaTenderModel->getPemenangByTahun($tahun);

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

    public function getPenawarTender_post()
    {
        $tahun = htmlspecialchars($this->post('tahun', true));

        $result = $this->PesertaTenderModel->getPenawarByTahun($tahun);

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

    public function getPesertaTender_post()
    {
        $tahun = htmlspecialchars($this->post('tahun', true));

        $result = $this->PesertaTenderModel->getPesertaByTahun($tahun);

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

    public function getPesertaMenawarPerMonth_post()
    {
        $klpd = htmlspecialchars((string) $this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars((string) $this->post('jenisPengadaan', true));
        $hps = htmlspecialchars($this->post('hps', true));
        $tahun = htmlspecialchars($this->post('tahun', true));

        $result = $this->PesertaTenderModel->getPesertaMenawarPerMonth($klpd, $jenisPengadaan, $hps, $tahun);

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

    public function getPesertaMendaftarPerMonth_post()
    {
        $klpd = htmlspecialchars((string) $this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars((string) $this->post('jenisPengadaan', true));
        $hps = htmlspecialchars($this->post('hps', true));
        $tahun = htmlspecialchars($this->post('tahun', true));

        $result = $this->PesertaTenderModel->getPesertaMendaftarPerMonth($klpd, $jenisPengadaan, $hps, $tahun);

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
}
