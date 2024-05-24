<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class SyaratKualifikasi extends CI_Controller
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
        $this->load->model('SyaratKualifikasi_model');
        $this->load->library('form_validation');
    }

    public function getdata()
    {
        $results = $this->SyaratKualifikasi_model->getDataSyaratKualifikasi();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = $result->id_syarat;
            $row[] = $result->id_tender;
            $row[] = $result->kategori;
            $row[] = '<a href="#"><button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter' . $result->id_syarat . '" class="btn_up"><iconify-icon inline icon="material-symbols:search-rounded" style="color: white;"></iconify-icon></button></a>
            <div class="modal fade" id="exampleModalCenter' . $result->id_syarat . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable rincian-modal">
                    <div class="modal-content">
                        <div class="modal-header header-syarat">
                            <h5 class="modal-title" id="exampleModalLabel">Syarat Kualifikasi</h5>
                            <button type="button" class="btn-close close-syarat" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-syarat">
                            <p class="syarat-table">' . $result->syarat . '</p>
                        </div>
                    </div>
                </div>
            </div>';
            $row[] = '<a href="#"><button class="btn_edit"></button></a>
            <a href="#"><button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" class="btn_remove"></button></a>';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SyaratKualifikasi_model->count_all_data(),
            "recordsFiltered" => $this->SyaratKualifikasi_model->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function index()
    {
        $data = [
            "title" => "Syarat Kualifikasi",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/syarat_kualifikasi', $data);
        $this->load->view('dashboard/templates/footer');
    }
}
