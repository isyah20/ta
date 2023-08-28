<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Tender extends CI_Controller
{
    private $__perPage = 10;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != 1) {
            redirect('login');
        }
        
        $this->_client = new Client([
            'base_uri' => base_url(),
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
        
        $this->load->model('Tender_model');
        $this->load->model('api/JenisTender_model');
        $this->load->model('api/Lpse_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }

    public function index2()
    {
        // $limit = 5;
        // var_dump($limit);
        $result = $this->Tender_model->getAllTender();
        $data = [
            'tenders' => $result['data'],
            "title" => "Tender",
            // 'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/tender', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function index()
    {
        $data = [
            // 'start' => $config['start'],
            // 'limit' => $config['per_page'],
            // 'total' => $config['total_rows'],
            "title" => "Tender",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/tender', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function getdata()
    {
        $results = $this->Tender_model->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            // $row[] = $result->id_tender;
            $row[] = $result->id_lpse;
            // $row[] = $result->id_jenis;
            $row[] = $result->nama_tender;
            // $row[] = $result->nilai_hps;
            // $row[] = $result->nilai_kontrak;
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Tender_model->count_all_data(),
            "recordsFiltered" => $this->Tender_model->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function create()
    {
        // get jenis pengadaan
        $pengadaan = $this->JenisTender_model->getAllJenisTender();

        // get LPSE
        $lpse = $this->Lpse_model->getAllLpse();

        $data = [
            "title" => "Tender",
            "pengadaans" => $pengadaan,
            "lpses" => $lpse,
        ];
        $this->form_validation->set_rules('id_tender', 'id_tender', 'required');
        $this->form_validation->set_rules('id_lpse', 'id_lpse', 'required');
        $this->form_validation->set_rules('id_jenis', 'id_jenis', 'required');
        $this->form_validation->set_rules('nama_tender', 'nama_tender', 'required');
        $this->form_validation->set_rules('tahun_anggaran', 'tahun_anggaran', 'required');
        $this->form_validation->set_rules('nilai_hps', 'nilai_hps', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/tender', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "id_tender" => htmlspecialchars($this->input->post('id_tender', true)),
                "id_lpse" => htmlspecialchars($this->input->post('id_lpse', true)),
                "id_jenis" => htmlspecialchars($this->input->post('id_jenis', true)),
                "nama_tender" => htmlspecialchars($this->input->post('nama_tender', true)),
                "tahun_anggaran" => htmlspecialchars($this->input->post('tahun_anggaran', true)),
                "metode_pemilihan" => htmlspecialchars($this->input->post('metode_pemilihan', true)),
                "metode_pengadaan" => htmlspecialchars($this->input->post('metode_pengadaan', true)),
                "metode_evaluasi" => htmlspecialchars($this->input->post('metode_evaluasi', true)),
                "status" => htmlspecialchars($this->input->post('status', true)),
                "alasan" => htmlspecialchars($this->input->post('alasan', true)),
                "versi_lpse" => htmlspecialchars($this->input->post('versi_lpse', true)),
                "nilai_kontrak" => htmlspecialchars($this->input->post('nilai_kontrak', true)),
                "kualifikasi" => htmlspecialchars($this->input->post('kualifikasi', true)),
                "nilai_hps" => htmlspecialchars($this->input->post('nilai_hps', true)),
                'tgl_pembuatan' => date('Y-m-d'),
            ];
            $this->Tender_model->tambahTender($data);

            redirect('tender');
        }
    }

    public function update($id)
    {
        //get tender
        $result = $this->Tender_model->getTenderById($id);

        // get jenis pengadaan
        $pengadaan = $this->JenisTender_model->getAllJenisTender();

        // get LPSE
        $lpse = $this->Lpse_model->getAllLpse();

        $data = [
            "title" => "Tender",
            "pengadaans" => $pengadaan,
            "lpses" => $lpse,
            "tenders" => $result['data'],
        ];
        $this->form_validation->set_rules('id_tender', 'id_tender', 'required');
        $this->form_validation->set_rules('id_lpse', 'id_lpse', 'required');
        $this->form_validation->set_rules('id_jenis', 'id_jenis', 'required');
        $this->form_validation->set_rules('nama_tender', 'nama_tender', 'required');
        $this->form_validation->set_rules('tahun_anggaran', 'tahun_anggaran', 'required');
        $this->form_validation->set_rules('nilai_hps', 'nilai_hps', 'required');
        $this->form_validation->set_rules('tgl_pembuatan', 'tgl_pembuatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/update/tender', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "id_tender" => htmlspecialchars($this->input->post('id_tender', true)),
                "id_lpse" => htmlspecialchars($this->input->post('id_lpse', true)),
                "id_jenis" => htmlspecialchars($this->input->post('id_jenis', true)),
                "nama_tender" => htmlspecialchars($this->input->post('nama_tender', true)),
                "tahun_anggaran" => htmlspecialchars($this->input->post('tahun_anggaran', true)),
                "metode_pemilihan" => htmlspecialchars($this->input->post('metode_pemilihan', true)),
                "metode_pengadaan" => htmlspecialchars($this->input->post('metode_pengadaan', true)),
                "metode_evaluasi" => htmlspecialchars($this->input->post('metode_evaluasi', true)),
                "status" => htmlspecialchars($this->input->post('status', true)),
                "alasan" => htmlspecialchars($this->input->post('alasan', true)),
                "versi_lpse" => htmlspecialchars($this->input->post('versi_lpse', true)),
                "nilai_kontrak" => htmlspecialchars($this->input->post('nilai_kontrak', true)),
                "kualifikasi" => htmlspecialchars($this->input->post('kualifikasi', true)),
                "nilai_hps" => htmlspecialchars($this->input->post('nilai_hps', true)),
                'tgl_pembuatan' => date($this->input->post('tgl_pembuatan', true)),
            ];
            // var_dump($test);
            $this->Tender_model->ubahTender($id, $data);

            redirect('tender');
        }
    }

    public function destroy($id)
    {
        $this->Tender_model->hapusTender($id);

        redirect('tender');
    }
}
