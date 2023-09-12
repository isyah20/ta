<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class DashboardUserMarketing extends CI_Controller
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != 4) {
        if (!get_cookie('id_pengguna')) {
            redirect('login');
        }

        $this->load->helper('tanggal');
        $this->load->model('Lpse_model');
        $this->load->model('Pemenang_model');
        $this->load->model('Supplier_model');
        $this->load->model('api/Pemenang_model', 'pemenang');
        $this->init();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar');
        $this->load->view('dashboard/supplier/marketing/index');
        $this->load->view('templates/footer');
    }
}
