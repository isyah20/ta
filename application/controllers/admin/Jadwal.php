<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != 1) {
            redirect('login');
        }
        $this->load->model('Tender_model');
        $this->load->model('Jadwal_model');
        $this->load->model('Tahapan_model');
    }

    public function index()
    {
        $data = [
            "title" => "Jadwal",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/jadwal', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function getdata()
    {
        $results = $this->Jadwal_model->getDataJadwal();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = [];
            $row[] = $result->id_jadwal;
            // $row[] = $result->id_tender;
            // $row[] = $result->id_tahapan;
            $row[] = $result->kode_tender;
            $row[] = $result->id_tahap;
            $row[] = $result->tgl_mulai;
            $row[] = $result->tgl_akhir;
            if ($result->perubahan > 0) {
                $row[] = $result->perubahan;
            } else {
                $row[] = 'Tidak ada';
            }
            $row[] = '<a href="' . base_url('perubahan-jadwal/') . '' . $result->id_jadwal . '"><button class="btn_show"></button></a>
            <a href="' . base_url('perubahan-jadwal/create') . '' . $result->id_jadwal . '"><button class="btn_edit"></button></a>
            <a href="' . base_url('jadwal/destroy/') . '' . $result->id_jadwal . '" onclick="return confirm(" Apakah Anda yakin ingin menghapus data ini?")"><button class="btn_remove"></button></a>';
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Jadwal_model->count_all_data(),
            "recordsFiltered" => $this->Jadwal_model->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('aplication/json')->set_output(json_encode($output));
    }

    public function create()
    {
        $tender = $this->Tender_model->getAllTender();
        $tahapan = $this->Tahapan_model->getAllTahapan();

        $data = [
            "tenders" => $tender['data'],
            "tahapans" => $tahapan['data'],
            "title" => "Jadwal",
        ];

        $this->form_validation->set_rules('id_tender', 'id_tender', 'required');
        $this->form_validation->set_rules('id_tahapan', 'id_tahapan', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'tgl_mulai', 'required');
        $this->form_validation->set_rules('tgl_akhir', 'tgl_akhir', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/jadwal', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "id_tender" => htmlspecialchars($this->input->post('id_tender', true)),
                "id_tahapan" => htmlspecialchars($this->input->post('id_tahapan', true)),
                "tgl_mulai" => date('Y-m-d H:i:s', strtotime($this->input->post('tgl_mulai', true))),
                "tgl_akhir" => date('Y-m-d H:i:s', strtotime($this->input->post('tgl_akhir', true))),
            ];
            $this->Jadwal_model->tambahJadwal($data);

            redirect('jadwal');
        }
    }

    public function destroy($id)
    {
        $this->Jadwal_model->hapusJadwal($id);

        redirect('jadwal');
    }
}
