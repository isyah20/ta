<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Pengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!get_cookie('id_pengguna')) redirect('login');
        
        $this->_client = new Client([
            'base_uri' => base_url(),
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
        
        $this->load->model('Pengguna_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $result = $this->Pengguna_model->getAllPengguna();

        $data = [
            'penggunas' => $result['data'],
            "title" => "Pengguna",
            'start' => 0,
        ];
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/templates/sidebar');
        $this->load->view('dashboard/templates/navbar');
        $this->load->view('dashboard/admin/pengguna', $data);
        $this->load->view('dashboard/templates/footer');
    }

    public function create()
    {
        $data = [
            "title" => "Pengguna",
        ];

        $this->form_validation->set_rules('nama', 'nama', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[pengguna.email]', [
            'is_unique' => 'Email sudah terdaftar!',
        ]);
        $this->form_validation->set_rules('password', 'kata sandi', 'required|trim|min_length[6]', [
            'min_length' => 'Kata sandi minimal 6 karakter!',
        ]);
        $this->form_validation->set_rules('password_confirm', 'ulangi kata sandi', 'required|trim|matches[password]', [
            'matches' => 'Kata sandi tidak sama!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/create/pengguna');
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'npwp' => htmlspecialchars($this->input->post('npwp', true)),
                'password' => $this->input->post('password'),
                'kategori' => 2,
                'tgl_update' => date('Y-m-d H:i:s'),
            ];
            $this->Pengguna_model->tambahPengguna($data);

            redirect('pengguna');
        }
    }

    public function update($id)
    {
        $result = $this->Pengguna_model->getPenggunaById($id);

        $data = [
            'penggunas' => $result['data'],
            "title" => "Pengguna",
        ];

        $this->form_validation->set_rules('nama', 'nama', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim');
        $this->form_validation->set_rules('password', 'kata sandi', 'required|trim|min_length[6]', [
            'min_length' => 'Kata sandi minimal 6 karakter!',
        ]);
        $this->form_validation->set_rules('password_confirm', 'ulangi kata sandi', 'required|trim|matches[password]', [
            'matches' => 'Kata sandi tidak sama!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/templates/header', $data);
            $this->load->view('dashboard/templates/sidebar');
            $this->load->view('dashboard/templates/navbar');
            $this->load->view('dashboard/admin/update/pengguna', $data);
            $this->load->view('dashboard/templates/footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'npwp' => htmlspecialchars($this->input->post('npwp', true)),
                'password' => $this->input->post('password'),
                'kategori' => 2,
                'tgl_update' => date('Y-m-d H:i:s'),
            ];
            // var_dump($test);
            $this->Pengguna_model->ubahPengguna($id, $data);

            redirect('pengguna');
        }
    }

    public function destroy($id)
    {
        $this->Pengguna_model->hapusPengguna($id);

        redirect('pengguna');
    }

    public function getToken()
    {
        $result = ['key' => 'beetend', 'token' => '76oZ8XuILKys5'];
        $this->output->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($result))
            ->_display();
        exit();
    }
}
