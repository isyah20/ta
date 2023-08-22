<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Wilayah extends CI_Controller
{
    private $_client;

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
        $this->load->model('WilayahModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            "title" => "Wilayah",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/wilayah', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function getdata()
    {
        $results = $this->WilayahModel->getDataWilayah();
        // var_dump($results);
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = $result->id_wilayah;
            $row[] = $result->wilayah;
            $row[] = '<a href=' . base_url('wilayah/update/') . $result->id_wilayah . '><button class="btn_edit"></button></a> <a href=' . base_url('wilayah/destroy/') . $result->id_wilayah . ' onclick="return confirm(" Apakah Anda yakin ingin menghapus data ini?")"><button class="btn_remove"></button></a>';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->WilayahModel->count_all_data(),
            "recordsFiltered" => $this->WilayahModel->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function create()
    {
        $data = [
            "title" => "Wilayah",
        ];

        $this->form_validation->set_rules('wilayah', 'wilayah', 'required|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/wilayah');
            $this->load->view('dashboard/templates/footer');
        } else {
            $this->WilayahModel->tambahWilayah();

            redirect('wilayah');
        }
    }

    public function update($id)
    {
        $result = $this->WilayahModel->getWilayahById($id);

        $data = [
            'wilayahs' => $result['data'],
            "title" => "Wilayah",
        ];

        $test = $this->form_validation->set_rules('wilayah', 'wilayah', 'required|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/update/wilayah', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "wilayah" => htmlspecialchars($this->input->post('wilayah', true)),
            ];
            $this->WilayahModel->ubahWilayah($id, $data);

            redirect('wilayah');
        }
    }

    public function destroy($id)
    {
        $this->WilayahModel->hapusWilayah($id);

        redirect('wilayah');
    }
}
