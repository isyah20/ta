<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class HasilEvaluasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != 1) {
            redirect('login');
        }
        $this->_client = new Client([
            'base_uri' => 'http://localhost/procurement-platform/api/',
        ]);
        $this->load->model('HasilEvaluasi_model');
        $this->load->library('form_validation');
    }

    public function getdata()
    {
        $results = $this->HasilEvaluasi_model->getDataHasilEvaluasi();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = '<div class="dt-control"></div>';
            $row[] = $result->id_evaluasi;
            $row[] = $result->id_tender;
            $row[] = $result->npwp;
            $row[] = $result->evaluasi_kualifikasi;
            $row[] = $result->skor_kualifikasi;
            $row[] = $result->evaluasi_administrasi;
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->HasilEvaluasi_model->count_all_data(),
            "recordsFiltered" => $this->HasilEvaluasi_model->count_filtered_data(),
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
        $this->load->view('dashboard/admin/hasil_evaluasi', $data);
        $this->load->view('dashboard/templates/footer');
    }
}
