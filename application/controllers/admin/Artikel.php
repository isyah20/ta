<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Google\Service\Analytics\Resource\Data;
use GuzzleHttp\Client;

class Artikel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != 1) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'title' => "Artikel",
        ];

        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/artikel', $data);
        $this->load->view('dashboard/templates/footer');
    }
}
