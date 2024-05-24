<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Lpse extends CI_Controller
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
        $this->load->model('Lpse_model');
        $this->load->model('api/Wilayah_model');
        $this->load->model('api/KategoriLpse_model');
        $this->load->library('form_validation');
    }

    public function getdata()
    {
        $results = $this->Lpse_model->getDataLpse();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = '<div class="dt-control"></div>';
            $row[] = $result->id_lpse;
            $row[] = $result->id_wilayah;
            $row[] = $result->id_kategori;
            $row[] = $result->id_repo;
            $row[] = $result->nama_lpse;
            $row[] = '<a href="' . $result->url . '" target="_blank" rel="noopener noreferrer">' . $result->url . '</a>';
            $row[] = '<a href="' . base_url('lpse/update/') . '' . $result->id_lpse . '"><button class="btn_edit"></button></a>
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter' . $result->id_lpse . '" class="btn_remove"></button><div class="modal fade" id="exampleModalCenter' . $result->id_lpse . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-remove modal-dialog-centered" role="document">
                <div class="modal-content modal-header">
                    <div class="content mx-3 my-3">
                        <i><iconify-icon icon="emojione-v1:warning" style="color: #ffdd15;" width="40px" height="40px"></iconify-icon></i>
                        <p> Apakah anda yakin <br> ingin menghapus data ini ?' . $result->id_lpse . ' </p>
                    </div>
                    <div class="footer-modals mx-3 my-3 mt-0">
                    <a href="' . base_url('lpse/destroy/') . '' . $result->id_lpse . '"><button type="button" class="btn-yakin">Yakin</button></a><br>
                        <button type="button" class="btn-batal" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Lpse_model->count_all_data(),
            "recordsFiltered" => $this->Lpse_model->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function index()
    {
        $data = [
            "title" => "LPSE",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/lpse', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function create()
    {
        // get wilayah
        $wilayah = $this->Wilayah_model->getAllWilayah();

        // get kategori lpse
        $kategoriLpse = $this->KategoriLpse_model->getAllKategoriLpse();

        // var_dump($wilayah);
        $data = [
            'wilayahs' => $wilayah,
            'kategoris' => $kategoriLpse,
            "title" => "LPSE",
        ];

        $test = $this->form_validation->set_rules('id_wilayah', 'id_wilayah', 'required');
        $test = $this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');
        $test = $this->form_validation->set_rules('nama_lpse', 'nama_lpse', 'required');
        $test = $this->form_validation->set_rules('url', 'url', 'required');
        $test = $this->form_validation->set_rules('versi', 'versi', 'required');
        $test = $this->form_validation->set_rules('id_repo', 'id_repo', 'required');
        $test = $this->form_validation->set_rules('latitude', 'latitude', 'required');
        $test = $this->form_validation->set_rules('longitude', 'longitude', 'required');
        $test = $this->form_validation->set_rules('alamat', 'alamat', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/lpse', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "id_wilayah" => htmlspecialchars($this->input->post('id_wilayah', true)),
                "id_kategori" => htmlspecialchars($this->input->post('id_kategori', true)),
                "nama_lpse" => htmlspecialchars($this->input->post('nama_lpse', true)),
                "url" => htmlspecialchars($this->input->post('url', true)),
                "versi" => htmlspecialchars($this->input->post('versi', true)),
                "id_repo" => htmlspecialchars($this->input->post('id_repo', true)),
                "latitude" => htmlspecialchars($this->input->post('latitude', true)),
                "longitude" => htmlspecialchars($this->input->post('longitude', true)),
                "alamat" => htmlspecialchars($this->input->post('alamat', true)),
                "status" => '1',
            ];
            $this->Lpse_model->tambahLpse($data);

            redirect('lpse');
        }
    }

    public function update($id)
    {
        // get lpse by id
        $lpse = $this->Lpse_model->getLpseById($id);
        // var_dump($lpse);

        // get wilayah
        $wilayah = $this->Wilayah_model->getAllWilayah();

        // get kategori lpse
        $kategoriLpse = $this->KategoriLpse_model->getAllKategoriLpse();

        $data = [
            'lpses' => $lpse['data'],
            'wilayahs' => $wilayah,
            'kategoris' => $kategoriLpse,
            "title" => "LPSE",
        ];

        $test = $this->form_validation->set_rules('id_wilayah', 'id_wilayah', 'required');
        $test = $this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');
        $test = $this->form_validation->set_rules('nama_lpse', 'nama_lpse', 'required');
        $test = $this->form_validation->set_rules('url', 'url', 'required');
        $test = $this->form_validation->set_rules('versi', 'versi', 'required');
        $test = $this->form_validation->set_rules('id_repo', 'id_repo', 'required');
        $test = $this->form_validation->set_rules('latitude', 'latitude', 'required');
        $test = $this->form_validation->set_rules('longitude', 'longitude', 'required');
        $test = $this->form_validation->set_rules('alamat', 'alamat', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/update/lpse', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "id_wilayah" => htmlspecialchars($this->input->post('id_wilayah', true)),
                "id_kategori" => htmlspecialchars($this->input->post('id_kategori', true)),
                "nama_lpse" => htmlspecialchars($this->input->post('nama_lpse', true)),
                "url" => htmlspecialchars($this->input->post('url', true)),
                "versi" => htmlspecialchars($this->input->post('versi', true)),
                "id_repo" => htmlspecialchars($this->input->post('id_repo', true)),
                "latitude" => htmlspecialchars($this->input->post('latitude', true)),
                "longitude" => htmlspecialchars($this->input->post('longitude', true)),
                "alamat" => htmlspecialchars($this->input->post('alamat', true)),
            ];
            // var_dump($test);
            $this->Lpse_model->ubahLpse($id, $data);

            redirect('lpse');
        }
    }

    public function destroy($id)
    {
        $this->Lpse_model->hapusLpse($id);

        redirect('lpse');
    }
}
