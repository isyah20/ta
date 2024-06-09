<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class Hasil extends CI_Controller
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != 4) {
        if (!get_cookie('id_pengguna')) {
            redirect('login');
        }

        // $this->load->library('input');
        $this->load->model('Hasil_model');
        $this->init();
    }
    /* public function index()
    {
        $data['jumlah_kriteria'] = $this->model->getNumKriteria();
        $data['jumlah_alternatif'] = $this->model->getNumAlternatif();
        $data['ranking'] = $this->model->getRanking();

        $this->load->view('templates/header');
        $this->load->view('hasil/index', $data);
        $this->load->view('templates/footer');
    } */
}
