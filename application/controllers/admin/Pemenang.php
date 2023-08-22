<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Pemenang extends CI_Controller
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
        $this->load->model('Pemenang_model');
        $this->load->model('Tender_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            "title" => "Pemenang",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/pemenang', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function getdata()
    {
        $results = $this->Pemenang_model->getDataPemenang();
        // var_dump($results);
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = '<div class="dt-control"></div>';
            $row[] = $result->id_pemenang;
            $row[] = $result->id_tender;
            $row[] = $result->npwp;
            $row[] = $result->harga_negosiasi;
            $row[] = $result->harga_kontrak;
            // $row[] = '<a href='.base_url('pemenang/update/').$result->id_pemenang.'/'.$result->id_tender.'><button class="btn_edit"></button></a> <a href='.base_url('pemenang/destroy/').$result->id_pemenang.' onclick="return confirm(" Apakah Anda yakin ingin menghapus data ini?")"><button class="btn_remove"></button></a>';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Pemenang_model->count_all_data(),
            "recordsFiltered" => $this->Pemenang_model->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function create()
    {
        $tender = $this->Tender_model->getAllTender();
        $data = [
            "title" => "Pemenang",
            'tender' => $tender['data'],
        ];

        $this->form_validation->set_rules('id_tender', 'id_tender', 'required|trim|is_unique[pemenang.id_tender]', [
            'is_unique' => 'Tender ini sudah ada pemenang!',
        ]);
        $this->form_validation->set_rules('npwp', 'npwp', 'required');
        $this->form_validation->set_rules('harga_negosiasi', 'harga_negosiasi', 'required');
        $this->form_validation->set_rules('harga_kontrak', 'harga_kontrak', 'required');
        $this->form_validation->set_rules('nilai_pdn', 'nilai_pdn', 'required');
        $this->form_validation->set_rules('nilai_umk', 'nilai_umk', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/pemenang');
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                'id_tender' => htmlspecialchars($this->input->post('id_tender', true)),
                'npwp' => htmlspecialchars($this->input->post('npwp', true)),
                'harga_negosiasi' => htmlspecialchars($this->input->post('harga_negosiasi', true)),
                'harga_kontrak' => htmlspecialchars($this->input->post('harga_kontrak', true)),
                'nilai_pdn' => htmlspecialchars($this->input->post('nilai_pdn', true)),
                'nilai_umk' => htmlspecialchars($this->input->post('nilai_umk', true)),
            ];
            // var_dump($data);
            $this->Pemenang_model->tambahPemenang($data);

            redirect('pemenang');
        }
    }

    public function update($idPemenang)
    {
        // var_dump($this->uri->segment(4));
        $result = $this->Pemenang_model->getPemenangById($idPemenang);
        $tender = $this->Tender_model->getTenderById($this->uri->segment(4));

        $data = [
            'pemenangs' => $result['data'][0],
            'tender' => $tender['data'],
            "title" => "Pemenang",
        ];

        // var_dump($result);
        // var_dump($tender);

        $this->form_validation->set_rules('npwp', 'npwp', 'required');
        $this->form_validation->set_rules('harga_negosiasi', 'harga_negosiasi', 'required');
        $this->form_validation->set_rules('harga_kontrak', 'harga_kontrak', 'required');
        $this->form_validation->set_rules('nilai_pdn', 'nilai_pdn', 'required');
        $this->form_validation->set_rules('nilai_umk', 'nilai_umk', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/update/pemenang', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                'npwp' => htmlspecialchars($this->input->post('npwp', true)),
                'harga_negosiasi' => htmlspecialchars($this->input->post('harga_negosiasi', true)),
                'harga_kontrak' => htmlspecialchars($this->input->post('harga_kontrak', true)),
                'nilai_pdn' => htmlspecialchars($this->input->post('nilai_pdn', true)),
                'nilai_umk' => htmlspecialchars($this->input->post('nilai_umk', true)),
            ];
            // var_dump($data);
            $this->Pemenang_model->ubahPemenang($idPemenang, $data);

            redirect('pemenang');
        }
    }

    public function destroy($id)
    {
        $this->Pemenang_model->hapusPemenang($id);

        redirect('pemenang');
    }
}
