<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;

// to use RestController class we need to extend it to our controller class
class ApiLogin extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Pengguna_model');
    }

    public function index_post()
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
