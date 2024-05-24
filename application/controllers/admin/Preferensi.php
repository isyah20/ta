<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Preferensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != 1) {
            redirect('login');
        }
        $this->_client = new Client([
            'base_uri' => 'http://localhost/procurement-platform/api/',
            [
                'auth' => ['beetend', '76oZ8XuILKys5'],
            ],
        ]);
        $this->load->model('Preferensi_model');
        $this->load->model('Pengguna_model');
        $this->load->model('KategoriLpse_model');
        $this->load->model('Lpse_model');
        $this->load->model('JenisTender_model');
        // $this->load->model('Wilayah_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            "title" => "Preferensi",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/preferensi', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function getdata()
    {
        $results = $this->Preferensi_model->getDataPreferensi();
        // var_dump($results);
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = '<div class="dt-control"></div>';
            $row[] = $result->id_preferensi;
            $row[] = $result->id_pengguna;
            $row[] = $result->id_kategori_lpse;
            $row[] = $result->id_lpse;
            $row[] = $result->id_jenis_tender;
            $row[] = $result->nilai_hps;
            $row[] = $result->kualifikasi;
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Preferensi_model->count_all_data(),
            "recordsFiltered" => $this->Preferensi_model->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function create()
    {
        $pengguna = $this->Pengguna_model->getAllPengguna();
        $kategori = $this->KategoriLpse_model->getAllKategoriLpse();
        $lpse = $this->Lpse_model->getAllLpse();
        // $wilayah = $this->Wilayah_model->getAllWilayah();
        $jenis = $this->JenisTender_model->getAllJenisTender();

        $data = [
            "penggunas" => $pengguna['data'],
            "kategoris" => $kategori['data'],
            "lpses" => $lpse['data'],
            // "wilayahs" => $wilayah['data'],
            "jeniss" => $jenis['data'],
            "title" => "Preferensi",
        ];

        $this->form_validation->set_rules('id_pengguna', 'id_pengguna', 'required|min_length[3]');
        $this->form_validation->set_rules('id_kategori_lpse', 'id_kategori_lpse', 'required|min_length[3]');
        $this->form_validation->set_rules('id_lpse', 'id_lpse', 'required|min_length[3]');
        $this->form_validation->set_rules('provinsi', 'provinsi', 'required|min_length[3]');
        $this->form_validation->set_rules('kabupaten', 'kabupaten', 'required|min_length[3]');
        $this->form_validation->set_rules('id_jenis_tender', 'id_jenis_tender', 'required|min_length[3]');
        $this->form_validation->set_rules('kualifikasi', 'kualifikasi', 'required|min_length[3]');
        $this->form_validation->set_rules('nilai_hps', 'nilai_hps', 'required|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/preferensi', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "id_pengguna" => htmlspecialchars($this->input->post('id_pengguna', true)),
                "id_kategori_lpse" => htmlspecialchars($this->input->post('id_kategori_lpse', true)),
                "id_lpse" => htmlspecialchars($this->input->post('id_lpse', true)),
                "provinsi" => htmlspecialchars($this->input->post('provinsi', true)),
                "kabupaten" => htmlspecialchars($this->input->post('kabupaten', true)),
                "id_jenis_tender" => htmlspecialchars($this->input->post('id_jenis_tender', true)),
                "kualifikasi" => htmlspecialchars($this->input->post('kualifikasi', true)),
                "nilai_hps" => htmlspecialchars($this->input->post('nilai_hps', true)),
                "tgl_update" => date("Y-m-d H:i:s"),
            ];
            $this->Preferensi_model->tambahPreferensi($data);

            redirect('preferensi');
        }
    }

    public function destroy($id)
    {
        $this->Preferensi_model->hapusPreferensi($id);

        redirect('preferensi');
    }
}
