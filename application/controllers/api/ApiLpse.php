<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

//  to use RestController class we need to extend it to our controller class
class ApiLpse extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Lpse_model', 'lpse');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $pageNumber = $this->get('page');
        $pageNumber = $pageNumber != null ? $pageNumber : 0;
        $pageSize = $this->get('limit');
        $pageSize = $pageSize != null ? $pageSize : 20;
        $woLimit = $this->get('nolimit');
        $woLimit = $woLimit != null ? true : false;
        $result = $this->lpse->getAll($pageNumber, $pageSize, $woLimit);

        if (is_iterable($result) && count($result)) {
            $this->response([
                'status' => true,
                'data' => $result,
            ], RestController::HTTP_OK);
        }

        $this->response([
            'status' => true,
            'message' => 'Data is empty',
        ], RestController::HTTP_OK);
    }

    public function lpseAll_get()
    {
        // $resultTender = $this->Tender_model->getAllTender();
        $lpse = $this->lpse->getAllLpse();
        $config['base_url'] = base_url('api/lpse/page');
        $config['total_rows'] = count($lpse) - 1;
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
        $resultLpse = array_slice($lpse, $data['start'] ?? 1, $config['per_page']);
        $links = $this->pagination->create_links();
        if ($resultLpse) {
            $this->response([
                'hit' => 'To current page => ' . $config['base_url'] . '/(number page)',
                'status' => true,
                'total Page' => $config['total_rows'],
                'links' => $links,
                'data' => $resultLpse,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getId_get($id)
    {
        $resultLpse = $this->lpse->getLpseById($id);

        if ($resultLpse) {
            $this->response([
                'status' => true,
                'data' => $resultLpse,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id_lpse tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function create_post()
    {
        $this->form_validation->set_rules('id_wilayah', 'IdWilayah', 'required');
        $this->form_validation->set_rules('id_kategori', 'IdKategori', 'required');
        $this->form_validation->set_rules('nama_lpse', 'NamaLpse', 'required|trim');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        $this->form_validation->set_rules('versi', 'Versi', 'required|trim');
        $this->form_validation->set_rules('id_repo', 'IdRepo', 'required|trim');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required|trim');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        // $this->form_validation->set_rules('foto', 'Foto', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->response([
                'status' => false,
                'message' => validation_errors(),
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            $data = [
                'id_wilayah' => htmlspecialchars((string) $this->post('id_wilayah', true)),
                'id_kategori' => htmlspecialchars((string) $this->post('id_kategori', true)),
                'nama_lpse' => htmlspecialchars((string) $this->post('nama_lpse', true)),
                'url' => htmlspecialchars((string) $this->post('url', true)),
                'versi' => htmlspecialchars((string) $this->post('versi', true)),
                'id_repo' => htmlspecialchars((string) $this->post('id_repo', true)),
                'latitude' => htmlspecialchars((string) $this->post('latitude', true)),
                'longitude' => htmlspecialchars((string) $this->post('longitude', true)),
                'alamat' => htmlspecialchars((string) $this->post('alamat', true)),
                'status' => $this->post('status', true),
                // 'foto' => htmlspecialchars($this->post('foto', true)),
            ];

            $resultLpse = $this->lpse->tambahLpse($data);

            if ($resultLpse) {
                $this->response([
                    'status' => true,
                    'message' => 'LPSE berhasil ditambahkan',
                ], RestController::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'LPSE gagal ditambahkan',
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }

    public function update_put($id)
    {
        $data = [
            'id_wilayah' => htmlspecialchars((string) $this->put('id_wilayah', true)),
            'id_kategori' => htmlspecialchars((string) $this->put('id_kategori', true)),
            'nama_lpse' => htmlspecialchars((string) $this->put('nama_lpse', true)),
            'url' => htmlspecialchars((string) $this->put('url', true)),
            'versi' => htmlspecialchars((string) $this->put('versi', true)),
            'id_repo' => htmlspecialchars((string) $this->put('id_repo', true)),
            'latitude' => htmlspecialchars((string) $this->put('latitude', true)),
            'longitude' => htmlspecialchars((string) $this->put('longitude', true)),
            'alamat' => htmlspecialchars((string) $this->put('alamat', true)),
            'status' => $this->put('status', true),
            // 'foto' => htmlspecialchars($this->put('foto', true)),
        ];
        $data_new = [];
        foreach ($data as $key => $value) {
            if ($value) {
                $data_new[$key] = $value;
            }
        }
        $resultLpse = $this->lpse->ubahLpse($id, $data_new);
        if ($resultLpse) {
            $this->response([
                'status' => true,
                'message' => 'LPSE berhasil diupdate',
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
        $resultLpse = $this->lpse->hapusLpse($id);

        if ($resultLpse) {
            $this->response([
                'status' => true,
                'message' => 'LPSE berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'LPSE gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // Custom API
    public function namaNamaLpseById_post()
    {
        $idLpse = $this->post('id_lpse', true);
        // var_dump($idLpse);
        $resultLpse = $this->lpse->getNamaNamaLpseById($idLpse);
        $result = [];
        foreach ($resultLpse as $item) {
            $result[] = $item['nama_lpse'];
        }

        if ($resultLpse) {
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

    public function getLpseByWilKat_post()
    {
        $idWilayah = $this->post('id_wilayah', true);
        $idKategori = $this->post('id_kategori', true);
        // var_dump($idWilayah);
        $resultLpse = $this->lpse->getLpseByWilKat($idWilayah, $idKategori);
        // var_dump($resultLpse);
        $result = [];
        foreach ($resultLpse as $item) {
            $result[] = $item['id_lpse'];
        }

        if ($resultLpse) {
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

    public function getByIdWilayah_get($idWilayah)
    {
        // var_dump($idLpse);
        $resultLpse = $this->lpse->getLpseByIdWilayah($idWilayah);

        if ($resultLpse) {
            $this->response([
                'status' => true,
                'data' => $resultLpse,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data is empty',
            ], RestController::HTTP_OK);
        }
    }

    public function getlatlong_get($cariKLPD)
    {
        // var_dump($idLpse);
        $resultLpse = $this->lpse->getlatlong($cariKLPD);

        if ($resultLpse) {
            $this->response([
                'status' => true,
                'data' => $resultLpse,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data is empty',
            ], RestController::HTTP_OK);
        }
    }
}
