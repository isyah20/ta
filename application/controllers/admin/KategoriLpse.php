<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class KategoriLpse extends CI_Controller
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
        $this->load->model('KategoriLpse_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            "title" => "Kategori LPSE",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/kategori_lpse', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function getdata()
    {
        $results = $this->KategoriLpse_model->getDataKategoriLpse();
        // var_dump($results);
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = $result->id_kategori;
            $row[] = $result->nama_kategori;
            $row[] = '<a href=' . base_url('kategori-lpse/update/') . $result->id_kategori . '><button class="btn_edit"></button></a> <a href=' . base_url('kategori-lpse/destroy/') . $result->id_kategori . ' onclick="return confirm(" Apakah Anda yakin ingin menghapus data ini?")"><button class="btn_remove"></button></a>';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->KategoriLpse_model->count_all_data(),
            "recordsFiltered" => $this->KategoriLpse_model->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function create()
    {
        $data = [
            "title" => "Kategori LPSE",
        ];

        $this->form_validation->set_rules('nama_kategori', 'nama_kategori', 'required|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/kategoriLpse');
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "nama_kategori" => htmlspecialchars($this->input->post('nama_kategori', true)),
            ];
            $this->KategoriLpse_model->tambahKategoriLpse($data);

            redirect('kategori-lpse');
        }
    }

    public function update($id)
    {
        $result = $this->KategoriLpse_model->getKategoriLpseById($id);

        $data = [
            'kategoris' => $result['data'],
            "title" => "Kategori LPSE",
        ];

        $test = $this->form_validation->set_rules('nama_kategori', 'nama_kategori', 'required|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/update/kategoriLpse', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "nama_kategori" => htmlspecialchars($this->input->post('nama_kategori', true)),
            ];
            // var_dump($test);
            $this->KategoriLpse_model->ubahKategoriLpse($id, $data);

            redirect('kategori-lpse');
        }
    }

    public function destroy($id)
    {
        $this->KategoriLpse_model->hapusKategoriLpse($id);

        redirect('kategori-lpse');
    }
}
