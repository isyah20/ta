<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class PesertaTender extends CI_Controller
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
        $this->load->model('PesertaTender_model');
        $this->load->model('Tender_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            "title" => "Peserta Tender",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/pesertatender', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function getdata()
    {
        $results = $this->PesertaTender_model->getDataPesertaTender();
        // var_dump($results);
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = $result->id_peserta_tender;
            $row[] = $result->id_tender;
            $row[] = $result->npwp;
            $row[] = $result->harga_penawaran;
            $row[] = $result->harga_terkoreksi;
            $row[] = '<a href=' . base_url('peserta-tender/update/') . $result->id_peserta_tender . '/' . $result->id_tender . '><button class="btn_edit"></button></a> <a href=' . base_url('peserta-tender/destroy/') . $result->id_peserta_tender . ' onclick="return confirm(" Apakah Anda yakin ingin menghapus data ini?")"><button class="btn_remove"></button></a>';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->PesertaTender_model->count_all_data(),
            "recordsFiltered" => $this->PesertaTender_model->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function create()
    {
        $tender = $this->Tender_model->getAllTender();
        $data = [
            "title" => "Peserta Tender",
            'tender' => $tender['data'],
        ];

        $this->form_validation->set_rules('id_tender', 'id_tender', 'required');
        $this->form_validation->set_rules('npwp', 'npwp', 'required');
        $this->form_validation->set_rules('harga_penawaran', 'harga_penawaran', 'required');
        $this->form_validation->set_rules('harga_terkoreksi', 'harga_terkoreksi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/pesertatender');
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                'id_tender' => htmlspecialchars($this->input->post('id_tender', true)),
                'npwp' => htmlspecialchars($this->input->post('npwp', true)),
                'harga_penawaran' => htmlspecialchars($this->input->post('harga_penawaran', true)),
                'harga_terkoreksi' => htmlspecialchars($this->input->post('harga_terkoreksi', true)),
            ];
            // var_dump($data);
            $this->PesertaTender_model->tambahPesertaTender($data);

            redirect('peserta-tender');
        }
    }

    public function update($idPesertaTender)
    {
        // var_dump($this->uri->segment(4));
        $result = $this->PesertaTender_model->getPesertaTenderById($idPesertaTender);
        $tenderOld = $this->Tender_model->getTenderById($this->uri->segment(4));
        $tender = $this->Tender_model->getAllTender();

        $data = [
            'pesertaTenders' => $result['data'][0],
            'tenderOld' => $tenderOld['data'],
            'tender' => $tender['data'],
            "title" => "Pemenang",
        ];

        // var_dump($result);
        // var_dump($tender);

        $this->form_validation->set_rules('id_tender', 'id_tender', 'required');
        $this->form_validation->set_rules('npwp', 'npwp', 'required');
        $this->form_validation->set_rules('harga_penawaran', 'harga_penawaran', 'required');
        $this->form_validation->set_rules('harga_terkoreksi', 'harga_terkoreksi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/update/pesertatender', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                'id_tender' => htmlspecialchars($this->input->post('id_tender', true)),
                'npwp' => htmlspecialchars($this->input->post('npwp', true)),
                'harga_penawaran' => htmlspecialchars($this->input->post('harga_penawaran', true)),
                'harga_terkoreksi' => htmlspecialchars($this->input->post('harga_terkoreksi', true)),
            ];
            // var_dump($data);
            $this->PesertaTender_model->ubahPesertaTender($idPesertaTender, $data);

            redirect('peserta-tender');
        }
    }

    public function destroy($id)
    {
        $this->PesertaTender_model->hapusPesertaTender($id);

        redirect('peserta-tender');
    }
}
