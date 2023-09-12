<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

// to use RestController class we need to extend it to our controller class
class ApiAuth extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Pengguna_model');
    }

    public function regist_post()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[pengguna.email]', [
            'is_unique' => 'Email sudah terdaftar!',
        ]);
        $this->form_validation->set_rules('kategori', 'kategori', 'required|trim|in_list[2,3,4]', [
            'in_list' => 'Kategori tidak valid!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->response([
                'status' => false,
                'message' => validation_errors(),
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            $data = [
                'email' => $this->post('email'),
                'kategori' => $this->post('kategori'),
            ];

            $resultPengguna = $this->Pengguna_model->tambahPengguna($data);
            if ($resultPengguna) {
                $this->response([
                    'status' => true,
                    'data' => $resultPengguna,
                    'message' => 'Pengguna berhasil ditambahkan',
                ], RestController::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Pengguna gagal ditambahkan',
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }
    public function completeProfil_post()
    {
        $this->form_validation->set_rules('id_pengguna', 'ID Pengguna', 'required', [
            'required' => 'ID harus diisi',
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi',
        ]);
        $this->form_validation->set_rules('no_telp', 'kategori', 'required|trim', [
            'required' => 'Nomor Telepon harus diisi!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
            'required' => 'Email sudah terdaftar!',
            'min_length' => 'Kata sandi minimal 6 karakter!'
        ]);
        $this->form_validation->set_rules('passconf', 'Confirm Password', 'required|trim|matches[password]', [
            'matches' => 'Confirm Password tidak sama!',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat harus diisi!',
        ]);
        $this->form_validation->set_rules('kategori', 'kategori', 'required|trim|in_list[2,3,4]', [
            'in_list' => 'Kategori tidak valid!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->response([
                'status' => false,
                'message' => validation_errors(),
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->post('kategori') == 2) {
                $this->form_validation->set_rules('npwp', 'NPWP', 'required|trim', [
                    'required' => 'NPWP haris disi!',
                ]);
            }

            $id = $this->post('id_pengguna');
            $data = [
                'nama' => $this->post('nama'),
                'no_telp' => $this->post('no_telp'),
                'password' => md5($this->post('password')),
                'kategori' => $this->post('kategori'),
                'alamat' => $this->post('alamat'),
                'status' => 2,
                // 'status' => $this->post('status'),
                // 'token' => $this->post('token'),
                // 'is_active' => $this->post('is_active'),
                'tgl_update' => date('Y-m-d H:i:s'),
            ];
            if (null != $this->post('npwp')) {
                $data['npwp'] = $this->post('npwp');
            }

            $resultPengguna = $this->Pengguna_model->ubahPengguna($id, $data);
            if ($resultPengguna) {
                $this->response([
                    'status' => true,
                    'data' => $resultPengguna,
                    'message' => 'Pengguna berhasil diubah',
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Pengguna gagal diubah',
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }

    public function login_post()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email', [
            'required' => 'Email tidak boleh kosong!',
        ]);
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[6]', [
            'required' => 'Kata sandi tidak boleh kosong!',
            'min_length' => 'Kata sandi minimal 6 karakter!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->response([
                'status' => false,
                'message' => validation_errors(),
            ], RestController::HTTP_NOT_FOUND);
        } else {
            $email = $this->post('email');
            $password = md5($this->post('password'));

            $result = $this->Pengguna_model->login($email, $password);

            if ($result) {
                $this->response([
                    'status' => true,
                    'data' => $result,
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Email atau password salah',
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }
}
