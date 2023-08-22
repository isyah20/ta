<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class JenisTender extends CI_Controller
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
        $this->load->model('JenisTender_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            "title" => "Jenis Tender",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/jenis_tender', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function getdata()
    {
        $results = $this->JenisTender_model->getDataJenisTender();
        // var_dump($results);
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = '<div class="dt-control"></div>';
            $row[] = $result->id_jenis;
            $row[] = $result->jenis_tender;
            $row[] = '<a href=' . base_url('jenis-tender/update/') . $result->id_jenis . '><button class="btn_edit"></button></a> <a href=' . base_url('jenis-tender/destroy/') . $result->id_jenis . ' onclick="return confirm(" Apakah Anda yakin ingin menghapus data ini?")"><button class="btn_remove"></button></a>';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->JenisTender_model->count_all_data(),
            "recordsFiltered" => $this->JenisTender_model->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function create()
    {
        $data = [
            "title" => "Kategori LPSE",
        ];

        $this->form_validation->set_rules('jenis_tender', 'jenis_tender', 'required|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/jenisTender');
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "jenis_tender" => htmlspecialchars($this->input->post('jenis_tender', true)),
            ];
            $this->JenisTender_model->tambahJenisTender($data);

            redirect('jenis-tender');
        }
    }

    public function update($id)
    {
        $result = $this->JenisTender_model->getJenisTenderById($id);

        $data = [
            'jenis' => $result['data'],
            "title" => "Jenis Tender",
        ];

        $test = $this->form_validation->set_rules('jenis_tender', 'jenis_tender', 'required|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/update/jenisTender', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "jenis_tender" => htmlspecialchars($this->input->post('jenis_tender', true)),
            ];
            // var_dump($test);
            $this->JenisTender_model->ubahJenisTender($id, $data);

            redirect('jenis-tender');
        }
    }

    public function destroy($id)
    {
        $this->JenisTender_model->hapusJenisTender($id);

        redirect('jenis-tender');
    }
}
