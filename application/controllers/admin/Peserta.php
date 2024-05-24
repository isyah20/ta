<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Peserta extends CI_Controller
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
        $this->load->model('Peserta_model');
        $this->load->library('form_validation');
    }

    public function getdata()
    {
        $results = $this->Peserta_model->getDataPeserta();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = '<div class="dt-control"></div>';
            $row[] = $result->id_peserta;
            $row[] = $result->npwp;
            $row[] = $result->nama_peserta;
            $row[] = $result->alamat;
            $row[] = $result->kelurahan;
            $row[] = $result->kecamatan;
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Peserta_model->count_all_data(),
            "recordsFiltered" => $this->Peserta_model->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function index()
    {
        $data = [
            "title" => "Peserta",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/peserta', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function create()
    {
        $data = [
            "title" => "Peserta",
        ];

        $this->form_validation->set_rules('npwp', 'npwp', 'required|trim|is_unique[peserta.npwp]', [
            'is_unique' => 'NPWP sudah terdaftar!',
        ]);
        $this->form_validation->set_rules('nama_peserta', 'nama_peserta', 'required|min_length[3]');
        $this->form_validation->set_rules('kecamatan', 'kecamatan', 'required|min_length[3]');
        $this->form_validation->set_rules('kelurahan', 'kelurahan', 'required|min_length[3]');
        $this->form_validation->set_rules('kabupaten', 'kabupaten', 'required|min_length[3]');
        $this->form_validation->set_rules('provinsi', 'provinsi', 'required|min_length[3]');
        $this->form_validation->set_rules('kode_klu', 'kode_klu', 'required');
        $this->form_validation->set_rules('klu', 'klu', 'required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'email', 'required|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/peserta');
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "npwp" => htmlspecialchars($this->input->post('npwp', true)),
                "nama_peserta" => htmlspecialchars($this->input->post('nama_peserta', true)),
                "alamat" => htmlspecialchars($this->input->post('alamat', true)),
                "kecamatan" => htmlspecialchars($this->input->post('kecamatan', true)),
                "kelurahan" => htmlspecialchars($this->input->post('kelurahan', true)),
                "kabupaten" => htmlspecialchars($this->input->post('kabupaten', true)),
                "provinsi" => htmlspecialchars($this->input->post('provinsi', true)),
                "kode_klu" => htmlspecialchars($this->input->post('kode_klu', true)),
                "klu" => htmlspecialchars($this->input->post('klu', true)),
                "no_telp" => htmlspecialchars($this->input->post('npwp', true)),
                "email" => htmlspecialchars($this->input->post('email', true)),
            ];
            $this->Peserta_model->tambahPeserta($data);

            redirect('peserta');
        }
    }

    public function update($id)
    {
        $result = $this->Peserta_model->getPesertaById($id);

        $data = [
            'pesertas' => $result['data'],
            "title" => "Peserta",
        ];

        $this->form_validation->set_rules('nama_peserta', 'nama_peserta', 'required|min_length[3]');
        $this->form_validation->set_rules('kecamatan', 'kecamatan', 'required|min_length[3]');
        $this->form_validation->set_rules('kelurahan', 'kelurahan', 'required|min_length[3]');
        $this->form_validation->set_rules('kabupaten', 'kabupaten', 'required|min_length[3]');
        $this->form_validation->set_rules('provinsi', 'provinsi', 'required|min_length[3]');
        $this->form_validation->set_rules('kode_klu', 'kode_klu', 'required');
        $this->form_validation->set_rules('klu', 'klu', 'required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'email', 'required|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/update/peserta', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "npwp" => htmlspecialchars($this->input->post('npwp', true)),
                "nama_peserta" => htmlspecialchars($this->input->post('nama_peserta', true)),
                "alamat" => htmlspecialchars($this->input->post('alamat', true)),
                "kecamatan" => htmlspecialchars($this->input->post('kecamatan', true)),
                "kelurahan" => htmlspecialchars($this->input->post('kelurahan', true)),
                "kabupaten" => htmlspecialchars($this->input->post('kabupaten', true)),
                "provinsi" => htmlspecialchars($this->input->post('provinsi', true)),
                "kode_klu" => htmlspecialchars($this->input->post('kode_klu', true)),
                "klu" => htmlspecialchars($this->input->post('klu', true)),
                "no_telp" => htmlspecialchars($this->input->post('npwp', true)),
                "email" => htmlspecialchars($this->input->post('email', true)),
            ];
            // var_dump($test);
            $this->Peserta_model->ubahPeserta($id, $data);

            redirect('peserta');
        }
    }

    public function destroy($id)
    {
        $this->Peserta_model->hapusPeserta($id);

        redirect('peserta');
    }
}
