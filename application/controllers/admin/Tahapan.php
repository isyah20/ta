<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Tahapan extends CI_Controller
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
        $this->load->model('Tahapan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            "title" => "Tahapan LPSE",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/tahapan', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function getdata()
    {
        $results = $this->Tahapan_model->getDataTahapan();
        // var_dump($results);
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = $result->id_tahapan;
            $row[] = $result->nama_tahapan;
            $row[] = '<a href=' . base_url('tahapan/update/') . $result->id_tahapan . '><button class="btn_edit"></button></a> <a href=' . base_url('tahapan/destroy/') . $result->id_tahapan . ' onclick="return confirm(" Apakah Anda yakin ingin menghapus data ini?")"><button class="btn_remove"></button></a>';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Tahapan_model->count_all_data(),
            "recordsFiltered" => $this->Tahapan_model->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function create()
    {
        $data = [
            "title" => "Tahapan",
        ];

        $this->form_validation->set_rules('nama_tahapan', 'nama_tahapan', 'required|min_length[3]');
        $this->form_validation->set_rules('icon', 'nama_tahapan', 'required|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/tahapan');
            $this->load->view('dashboard/templates/footer');
        } else {
            $this->Tahapan_model->tambahTahapan();

            redirect('tahapan');
        }
    }

    public function update($id)
    {
        $result = $this->Tahapan_model->getTahapanById($id);

        $data = [
            'tahapans' => $result['data'],
            "title" => "Tahapan",
        ];

        $test = [
            $this->form_validation->set_rules('nama_tahapan', 'nama_tahapan', 'required|min_length[3]'),
            $this->form_validation->set_rules('icon', 'icon', 'required|min_length[3]'),
        ];

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/update/tahapan', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "nama_tahapan" => htmlspecialchars($this->input->post('nama_tahapan', true)),
                "icon" => htmlspecialchars($this->input->post('icon', true)),
            ];

            $this->Tahapan_model->ubahTahapan($id, $data);

            redirect('tahapan');
        }
    }

    public function destroy($id)
    {
        $this->Tahapan_model->hapusTahapan($id);

        redirect('tahapan');
    }
}
