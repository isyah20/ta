<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiTender extends RestController
{
    use \App\models\traits\Supplier;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Tender_model');
        // $this->load->model('Tender_model');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultTender = $this->Tender_model->getAllTender();

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function tenderAll_get()
    {
        // $resultTender = $this->Tender_model->getAllTender();
        $tender = $this->Tender_model->getAllTenderP();
        $config['base_url'] = base_url('api/tender/page');
        $config['total_rows'] = count($tender) - 1;
        $config['per_page'] = 10;
        $config['num_links'] = 3;
        $config['use_page_numbers'] = true;
        $config['reuse_query_string'] = true;
        $config['cur_tag_open'] = '<p>';
        $config['cur_tag_close'] = '</p>';
        $config['prev_tag_open'] = '<p>';
        $config['prev_tag_close'] = '</p>';
        $config['prev_link'] = '<p></p>';
        $config['first_tag_open'] = '<p">';
        $config['first_tag_close'] = '</p>';
        $config['last_tag_open'] = '<p">';
        $config['last_tag_close'] = '</p>';
        $config['next_tag_open'] = '<p>';
        $config['next_tag_close'] = '</p>';
        $config['next_link'] = '<p></p>';

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $resultTender = array_slice($tender, $data['start'] ?? 1, $config['per_page']);
        $links = $this->pagination->create_links();
        if ($resultTender) {
            $this->response([
                'hit' => 'To current page => ' . $config['base_url'] . '/(number page)',
                'status' => true,
                'total Page' => $config['total_rows'],
                'links' => $links,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function indexLim_post()
    {
        $limit = htmlspecialchars($this->post('limit', true));
        $start = htmlspecialchars($this->post('start', true));
        $resultTender = $this->Tender_model->getAllTenderLim($limit, $start);

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function indexC_get()
    {
        $resultTender = $this->Tender_model->getAllTenderC();

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function default_post()
    {
        $orderby = htmlspecialchars((string) $this->post('orderby', true));
        $resultTender = $this->Tender_model->getTenderDefault($orderby);

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function defaultLim_post()
    {
        $orderby = htmlspecialchars((string) $this->post('orderby', true));
        $limit = htmlspecialchars($this->post('limit', true));
        $start = htmlspecialchars($this->post('start', true));
        $resultTender = $this->Tender_model->getTenderDefaultLim($orderby, $limit, $start);

        if ($resultTender) {
            $this->response([
                'status' => true,
                // 'recordsTotal' => $this->Tender_model->count_all_data_default($orderby),
                'data' => $resultTender,
                // 'data' => json_decode($results)
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function defaultC_post()
    {
        $orderby = htmlspecialchars((string) $this->post('orderby', true));
        $resultTender = $this->Tender_model->getTenderDefaultC($orderby);
        // $resultTender =  $this->Tender_model->getTenderDefaultC($orderby);

        // if ($resultTender) {
        //     $this->response([
        //         'status' => true,
        //         'data' => $resultTender
        //     ], RestController::HTTP_OK);
        // } else {
        //     $this->response([
        //         'status' => false,
        //         'message' => 'Data not found'
        //     ], RestController::HTTP_NOT_FOUND);
        // }
    }

    public function getId_get($id)
    {
        $resultTender = $this->Tender_model->getTenderById($id);

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    // public function cekTenderBaru_get()
    // {
    //     $resultTender = $this->Tender_model->checkNewTender();

    //     if ($resultTender) {
    //         $this->response([
    //             'status' => true,
    //             'data' => $resultTender
    //         ], RestController::HTTP_OK);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'Tidak ada tender baru'
    //         ], RestController::HTTP_NOT_FOUND);
    //     }
    // }

    // public function preferensiTenderBaru_get()
    // {
    //     $resultTender = $this->Tender_model->preferenceNewTender();

    //     if ($resultTender) {
    //         $this->response([
    //             'status' => true,
    //             'data' => $resultTender
    //         ], RestController::HTTP_OK);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'Tidak ada tender baru'
    //         ], RestController::HTTP_NOT_FOUND);
    //     }
    // }

    public function spNotifikasiTenderBaru_get()
    {
        $resultTender = $this->Tender_model->spNewTenderNotification();

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Store procedure tender kosong!',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function notifikasiTenderBaru_get()
    {
        $resultTender = $this->Tender_model->newTenderNotification();

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada tender baru!',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function notifikasiTenderBaruByKeyword_get()
    {
        $resultTender = $this->Tender_model->newTenderNotificationByKeyword();

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada tender baru!',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function notifikasiTenderBaruDashboardUser_get()
    {
        $resultTender = $this->Tender_model->newTenderNotificationDashboardUser();

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada tender baru',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function tenderNotif_get()
    {
        $resultTender = $this->Tender_model->getTenderNotif();

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
                'total' => count($resultTender),
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada tender baru',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function search_post()
    {
        $search = htmlspecialchars((string) $this->post('s', true));
        $keyword = htmlspecialchars((string) $this->post('keyword', true));
        $wilayah = htmlspecialchars((string) $this->post('wilayah', true));
        $klpd = htmlspecialchars((string) $this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars((string) $this->post('jenisPengadaan', true));
        $hps = htmlspecialchars((string) $this->post('hps', true));
        $kualifikasi = htmlspecialchars((string) $this->post('kualifikasi', true));
        $tahun = htmlspecialchars((string) $this->post('tahun', true));
        $tahapan = htmlspecialchars((string) $this->post('tahapan', true));
        $orderby = htmlspecialchars((string) $this->post('orderby', true));

        $resultTender = $this->Tender_model->getSearchTender($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby);

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'keyword tidak ditemukan',
            ], RestController::HTTP_OK);
        }
    }

    public function searchLim_post()
    {
        $search = htmlspecialchars((string) $this->post('s', true));
        $keyword = htmlspecialchars((string) $this->post('keyword', true));
        $wilayah = htmlspecialchars($this->post('wilayah', true));
        $klpd = htmlspecialchars($this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars($this->post('jenisPengadaan', true));
        $hps = htmlspecialchars($this->post('hps', true));
        $kualifikasi = htmlspecialchars($this->post('kualifikasi', true));
        $tahun = htmlspecialchars($this->post('tahun', true));
        $tahapan = htmlspecialchars($this->post('tahapan', true));
        $orderby = htmlspecialchars($this->post('orderby', true));
        $limit = htmlspecialchars($this->post('limit', true));
        $start = htmlspecialchars($this->post('start', true));

        // var_dump($limit);

        $resultTender = $this->Tender_model->getSearchTenderLim($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby, $limit, $start);
        // $resultTender = $this->Tender_model->getDataTableFilter($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby, $limit, $start);

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'keyword tidak ditemukan',
            ], RestController::HTTP_OK);
        }
    }

    public function searchC_post()
    {
        $search = htmlspecialchars((string) $this->post('s', true));
        $keyword = htmlspecialchars((string) $this->post('keyword', true));
        $wilayah = htmlspecialchars($this->post('wilayah', true));
        $klpd = htmlspecialchars($this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars($this->post('jenisPengadaan', true));
        $hps = htmlspecialchars($this->post('hps', true));
        $kualifikasi = htmlspecialchars($this->post('kualifikasi', true));
        $tahun = htmlspecialchars($this->post('tahun', true));
        $tahapan = htmlspecialchars($this->post('tahapan', true));
        $orderby = htmlspecialchars($this->post('orderby', true));

        $resultTender = $this->Tender_model->getSearchTenderC($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby);

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'keyword tidak ditemukan',
            ], RestController::HTTP_OK);
        }
    }

    public function create_post()
    {
        $data = [
            'id_tender' => htmlspecialchars($this->post('id_tender', true)),
            'id_lpse' => htmlspecialchars($this->post('id_lpse', true)),
            'nama_tender' => htmlspecialchars($this->post('nama_tender', true)),
            'id_jenis' => htmlspecialchars($this->post('id_jenis', true)),
            'tahun_anggaran' => htmlspecialchars($this->post('tahun_anggaran', true)),
            'metode_pemilihan' => htmlspecialchars($this->post('metode_pemilihan', true)),
            'metode_pengadaan' => htmlspecialchars($this->post('metode_pengadaan', true)),
            'metode_evaluasi' => htmlspecialchars($this->post('metode_evaluasi', true)),
            'alasan' => htmlspecialchars($this->post('alasan', true)),
            'status' => htmlspecialchars($this->post('status', true)),
            'versi_lpse' => htmlspecialchars($this->post('versi_lpse', true)),
            'nilai_kontrak' => htmlspecialchars($this->post('nilai_kontrak', true)),
            'kualifikasi' => htmlspecialchars($this->post('kualifikasi', true)),
            'nilai_hps' => htmlspecialchars($this->post('nilai_hps', true)),
            'tgl_pembuatan' => date('Y-m-d'),
        ];

        $resultTender = $this->Tender_model->tambahTender($data);

        if ($resultTender > 0) {
            $this->response([
                'status' => true,
                'message' => 'Tender berhasil ditambahkan',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tender gagal ditambahkan',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function update_put($id)
    {
        $data = [
            'id_tender' => htmlspecialchars($this->put('id_tender', true)),
            'id_lpse' => htmlspecialchars($this->put('id_lpse', true)),
            'nama_tender' => htmlspecialchars($this->put('nama_tender', true)),
            'id_jenis' => htmlspecialchars($this->put('id_jenis', true)),
            'tahun_anggaran' => htmlspecialchars($this->put('tahun_anggaran', true)),
            'metode_pemilihan' => htmlspecialchars($this->put('metode_pemilihan', true)),
            'metode_pengadaan' => htmlspecialchars($this->put('metode_pengadaan', true)),
            'metode_evaluasi' => htmlspecialchars($this->put('metode_evaluasi', true)),
            'alasan' => htmlspecialchars($this->put('alasan', true)),
            'status' => htmlspecialchars($this->put('status', true)),
            'versi_lpse' => htmlspecialchars($this->put('versi_lpse', true)),
            'nilai_kontrak' => htmlspecialchars($this->put('nilai_kontrak', true)),
            'kualifikasi' => htmlspecialchars($this->put('kualifikasi', true)),
            'nilai_hps' => htmlspecialchars($this->put('nilai_hps', true)),
            'tgl_pembuatan' => date($this->put('tgl_pembuatan', true)),
        ];

        $resultTender = $this->Tender_model->ubahTender($id, $data);
        if ($resultTender > 0) {
            $this->response([
                'status' => true,
                'message' => 'Tender berhasil diupdate',
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
        $resultTender = $this->Tender_model->hapusTender($id);

        if ($resultTender > 0) {
            $this->response([
                'status' => true,
                'message' => 'Tender berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tender gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // Halaman Know Your Market
    public function searchHpsPerMonth_post()
    {
        // var_dump("cek");
        // var_dump(htmlspecialchars((string)$this->post('klpd', true)));
        $klpd = htmlspecialchars((string) $this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars((string) $this->post('jenisPengadaan', true));
        $hps = htmlspecialchars($this->post('hps', true));
        $tahun = htmlspecialchars($this->post('tahun', true));

        $resultTender = $this->Paket_model->getHpsPerMonth($klpd, $jenisPengadaan, $hps, $tahun);

        if ($resultTender > 0) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tender gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function searchTenderSelesaiPerMonth_post()
    {
        // var_dump("cek");
        // var_dump(htmlspecialchars((string)$this->post('klpd', true)));
        $klpd = htmlspecialchars((string) $this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars((string) $this->post('jenisPengadaan', true));
        $hps = htmlspecialchars($this->post('hps', true));
        $tahun = htmlspecialchars($this->post('tahun', true));

        $resultTender = $this->Tender_model->getTenderSelesaiPerMonth($klpd, $jenisPengadaan, $hps, $tahun);

        if ($resultTender > 0) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tender gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function searchTenderUlangPerMonth_post()
    {
        // var_dump("cek");
        // var_dump(htmlspecialchars((string)$this->post('klpd', true)));
        $klpd = htmlspecialchars((string) $this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars((string) $this->post('jenisPengadaan', true));
        $hps = htmlspecialchars($this->post('hps', true));
        $tahun = htmlspecialchars($this->post('tahun', true));

        $resultTender = $this->Tender_model->getTenderUlangPerMonth($klpd, $jenisPengadaan, $hps, $tahun);

        if ($resultTender > 0) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tender gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function searchTenderGagalPerMonth_post()
    {
        // var_dump("cek");
        // var_dump(htmlspecialchars((string)$this->post('klpd', true)));
        $klpd = htmlspecialchars((string) $this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars((string) $this->post('jenisPengadaan', true));
        $hps = htmlspecialchars($this->post('hps', true));
        $tahun = htmlspecialchars($this->post('tahun', true));

        $resultTender = $this->Tender_model->getTenderGagalPerMonth($klpd, $jenisPengadaan, $hps, $tahun);

        if ($resultTender > 0) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tender gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function searchForecastingTender_post()
    {
        // var_dump("cek");
        // var_dump(htmlspecialchars((string)$this->post('klpd', true)));
        $klpd = htmlspecialchars((string) $this->post('klpd', true));
        $jenisPengadaan = htmlspecialchars((string) $this->post('jenisPengadaan', true));
        $hps = htmlspecialchars($this->post('hps', true));
        $tahun = htmlspecialchars($this->post('tahun', true));

        $resultTender = $this->Tender_model->getForecastingTender($klpd, $jenisPengadaan, $hps, $tahun);

        if ($resultTender > 0) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tender gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function getdatastatistik_get()
    {
        $resultTender = $this->Tender_model->getdatastatistik();

        if ($resultTender) {
            $this->response([
                'status' => true,
                'data' => $resultTender,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getListNewestTender_get()
    {
        $this->load->model('Tender_model');
        // $keyword = htmlspecialchars((string) $this->post('keyword', true));
        // $wilayah = htmlspecialchars($this->post('wilayah', true));
        // $klpd = htmlspecialchars($this->post('klpd', true));
        // $jenisPengadaan = htmlspecialchars($this->post('jenisPengadaan', true));
        // $hps = htmlspecialchars($this->post('hps', true));
        // $kualifikasi = htmlspecialchars($this->post('kualifikasi', true));
        // $tahun = htmlspecialchars($this->post('tahun', true));
        // $tahapan = htmlspecialchars($this->post('tahapan', true));
        // $orderby = htmlspecialchars($this->post('orderby', true));
        $pageNumber = htmlspecialchars($this->get('page', true));
        $pageSize = htmlspecialchars($this->get('per_page', true));
        $prefs = [];
        $result = $this->Tender_model->getListKatalogTenderTerbaru($prefs, $pageNumber, $pageSize);
        if (count($result) > 0) {
            $this->response([
                'status' => true,
                'data' => $result,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'keyword tidak ditemukan',
            ], RestController::HTTP_OK);
        }
    }

    public function listWinnerTender_get($id)
    {
        $pageNumber = htmlspecialchars($this->get('page', true));
        $pageSize = htmlspecialchars($this->get('per_page', true));
        if ((int) $pageNumber < 0) {
            $pageNumber = 0;
        }

        if ((int) $pageSize < 0) {
            $pageSize = 20;
        }

        $filters = [];
        $result = $this->getWinnerTenderByFilters((int) $id, (int) $pageSize, (int) $pageNumber, $filters);
        $resp = ['error' => 0, 'items' => []];
        if (is_array($result) && empty($result)) {
            $resp['error'] = 1;
        }

        $this->response($resp, RestController::HTTP_OK);
    }
}
