<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class PerubahanJadwal extends CI_Controller
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
        // $this->load->model('PerubahanJadwal_model');
        $this->load->model('Jadwal_model');
        $this->load->model('PerubahanJadwal_model');
        $this->load->library('form_validation');
    }

    public function getPerubahan($id)
    {
        $find_jadwal = $this->Jadwal_model->getJadwalById($id);
        $data_perubahan = $find_jadwal['data'];

        if (isset($data_perubahan['id_perubahan']) && $data_perubahan['id_perubahan'] != null) {
            $id_perubahan = $data_perubahan['id_perubahan'];
        } else {
            $id_perubahan = 0;
        }

        $result = $this->Jadwal_model->getPerubahanJadwalById($id_perubahan);

        if ($result['status'] != false) {
            $perubahan = $result['data'];
        } else {
            $perubahan = null;
        }

        $data = [
            'perubahans' => $perubahan,
            "title" => "Perubahan Jadwal",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/perubahan_jadwal', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function create($idJadwal)
    {
        // get id jadwal
        $jadwal = $this->Jadwal_model->getJadwalById($idJadwal);

        $data = [
            "title" => "Perubahan Jadwal",
            "jadwals" => $jadwal['data'],
        ];

        $this->form_validation->set_rules('id_perubahan', 'id_perubahan', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'tgl_mulai', 'required');
        $this->form_validation->set_rules('tgl_akhir', 'tgl_akhir', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/perubahanJadwal', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                "id_perubahan" => htmlspecialchars($this->input->post('id_perubahan', true)),
                "tgl_mulai" => date('Y-m-d H:i:s', strtotime($this->input->post('tgl_mulai', true))),
                "tgl_akhir" => date('Y-m-d H:i:s', strtotime($this->input->post('tgl_mulai', true))),
                'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
                'tgl_diedit' => date('Y-m-d H:i:s'),
            ];
            $data2 = [
                "id_perubahan" => htmlspecialchars($this->input->post('id_perubahan', true)),
            ];

            $this->Jadwal_model->ubahJadwal($idJadwal, $data2);
            $this->PerubahanJadwal_model->tambahPerubahanJadwal($data);

            redirect('jadwal');
        }
    }
}
