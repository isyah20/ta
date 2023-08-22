<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Rup extends CI_Controller
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
        $this->load->model('Rup_model');
        $this->load->library('form_validation');
    }

    public function getdata()
    {
        $results = $this->Rup_model->getDataRup();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = '<div class="dt-control"></div>';
            $row[] = $result->id_urut_rup;
            $row[] = $result->id_rup;
            $row[] = $result->id_tender;
            $row[] = $result->nama_paket;
            $row[] = $result->sumber_dana;
            $row[] = '<a href="#"><button class="btn_edit"></button></a>
            <a href="#"><button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" class="btn_remove"></button></a>';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Rup_model->count_all_data(),
            "recordsFiltered" => $this->Rup_model->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function index()
    {
        $data = [
            "title" => "Hasil Evaluasi",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/rup', $data);
        $this->load->view('dashboard/templates/footer');
    }

    // public function create()
    // {
    //     // get wilayah
    //     $wilayah = $this->Wilayah_model->getAllWilayah();

    //     // get kategori lpse
    //     $kategoriLpse = $this->KategoriLpse_model->getAllKategoriLpse();

    //     // var_dump($wilayah);
    //     $data = [
    //         'wilayahs' => $wilayah,
    //         'kategoris' => $kategoriLpse,
    //         "title" => "LPSE",
    //     ];

    //     $test = $this->form_validation->set_rules('id_wilayah', 'id_wilayah', 'required');
    //     $test = $this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');
    //     $test = $this->form_validation->set_rules('nama_lpse', 'nama_lpse', 'required');
    //     $test = $this->form_validation->set_rules('url', 'url', 'required');
    //     $test = $this->form_validation->set_rules('versi', 'versi', 'required');
    //     $test = $this->form_validation->set_rules('id_repo', 'id_repo', 'required');
    //     $test = $this->form_validation->set_rules('latitude', 'latitude', 'required');
    //     $test = $this->form_validation->set_rules('longitude', 'longitude', 'required');
    //     $test = $this->form_validation->set_rules('alamat', 'alamat', 'required');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('dashboard/templates/header', $data);
    //         $this->load->view('dashboard/templates/sidebar');
    //         $this->load->view('dashboard/templates/navbar');
    //         $this->load->view('dashboard/admin/create/lpse', $data);
    //         $this->load->view('dashboard/templates/footer');
    //     } else {
    //         $data = [
    //             "id_wilayah" => htmlspecialchars($this->input->post('id_wilayah', true)),
    //             "id_kategori" => htmlspecialchars($this->input->post('id_kategori', true)),
    //             "nama_lpse" => htmlspecialchars($this->input->post('nama_lpse', true)),
    //             "url" => htmlspecialchars($this->input->post('url', true)),
    //             "versi" => htmlspecialchars($this->input->post('versi', true)),
    //             "id_repo" => htmlspecialchars($this->input->post('id_repo', true)),
    //             "latitude" => htmlspecialchars($this->input->post('latitude', true)),
    //             "longitude" => htmlspecialchars($this->input->post('longitude', true)),
    //             "alamat" => htmlspecialchars($this->input->post('alamat', true)),
    //             "status" => '1'
    //         ];
    //         $this->Lpse_model->tambahLpse($data);

    //         redirect('lpse');
    //     }
    // }
}
