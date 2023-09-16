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
        $this->load->model('api/Reset_model');
        $this->load->library('form_validation');
        $this->load->library('email');
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
                'token' => random_string('alnum', 25),
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
                // 'is_active' => 1,
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

    public function verifyCheck_get()
    {
        // $token = $this->get('token');
        $email = $this->get('email');
        $resultPengguna = $this->Pengguna_model->cekVerif($email);

        if ($resultPengguna) {
            $this->response([
                'status' => true,
                'data' => $resultPengguna,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found!',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }


    public function verify_post()
    {
        $email = $this->input->post('email');
        $token = $this->input->post('token');

        $check = $this->Pengguna_model->verifyCheck($token, $email);

        if (isset($check)) {
            $resultPengguna = $this->Pengguna_model->verifUser($email);

            if ($resultPengguna) {
                $this->response([
                    'status' => true,
                    'data' => $resultPengguna,
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data not found',
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Email atau token tidak sesuai!',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function verifySend_get()
    {
        $email = $this->input->get('email');
        $result = $this->Pengguna_model->getByEmail($email);

        if ($result) {
            $tokenOld = random_string('alnum', 25);
            $tokenUpdate = $this->Pengguna_model->updateToken($email, $tokenOld);
            $token = $tokenUpdate['token'];
            $this->load->library('email');
            $config = [];
            $config['charset'] = 'utf-8';
            $config['useragent'] = 'Codeigniter';
            $config['protocol'] = "smtp";
            $config['mailtype'] = "html";
            $config['smtp_host'] = "smtp.gmail.com"; //pengaturan smtp
            // $config['smtp_host'] = "sv2.ecc.co.id"; //pengaturan smtp
            $config['smtp_port'] = "465";
            $config['smtp_timeout'] = "5";
            $config['smtp_user'] = "misterlemper@gmail.com"; // isi dengan email
            $config['smtp_pass'] = "xvzihfwhawxxyjgb"; // isi dengan password
            // $config['smtp_user'] = "security@tenderplus.id"; // isi dengan email
            // $config['smtp_pass'] = "HLILrJW8uTLJ"; // isi dengan password
            $config['crlf'] = "\r\n";
            $config['newline'] = "\r\n";
            $config['smtp_crypto'] = "ssl"; //pengaturan smtp
            // $config['smtp_crypto'] = "tls"; //pengaturan smtp
            $config['wordwrap'] = true;

            //memanggil library email dan set konfigurasi untuk pengiriman email
            $this->email->initialize($config);

            //konfigurasi pengiriman
            $this->email->from('misterlemper@gmail.com', 'Tender Plus');
            $this->email->to($email);
            $this->email->subject("Verifikasi Email");

            $message = "<html>
                <body class=t0 style=\"min-width:100%;Margin:0px;padding:0px;background-color:#F0F0F0;\">
                <div class=t1 style=\"background-color:#F0F0F0;\"><table role=presentation width=100% cellpadding=0 cellspacing=0 border=0 align=center><tr>
                <td class=t113 style=\"font-size:0;line-height:0;mso-line-height-rule:exactly;\" valign=top align=center>

                <div class=t55 style=\"display:inline-table;text-align:initial;vertical-align:inherit;width:100%;max-width:600px;\">
                    <table role=presentation width=100% cellpadding=0 cellspacing=0 class=t57>
                    
                    <tr>
                        <td class=t58 style=\"background-color:unset;\">
                        <table role=presentation width=100% cellpadding=0 cellspacing=0><tr>
                        <td><div class=t103 style=\"mso-line-height-rule:exactly;mso-line-height-alt:25px;line-height:25px;font-size:1px;display:block;\">&nbsp;</div></td>
                    </tr>

                    <tr>                        
                        <td><table class=t95 role=presentation cellpadding=0 cellspacing=0 align=center><tr><td class=t96 style=\"width:315px;\">
                        <h1 class=t90 style=\"text-decoration:none;text-transform:none;direction:ltr;color:#000000;text-align:center;mso-line-height-rule:exactly;mso-text-raise:1px;font:normal 500 40px/44px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\">
                        Dear Pengguna Tender+</h1></td></tr></table></td>
                    </tr>
                    
                    <tr>
                        <td><div class=t94 style=\"mso-line-height-rule:exactly;mso-line-height-alt:30px;line-height:30px;font-size:1px;display:block;\">&nbsp;</div></td>
                    </tr>
                    
                    <tr>
                        <td><table class=t85 role=presentation cellpadding=0 cellspacing=0 align=center><tr><td class=t86 style=\"width:350px;\">
                        <p class=t92 style=\"text-decoration:none;text-transform:none;direction:ltr;color:#666666;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;font:normal 500 20px/30px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\">
                        Untuk Mengaktifkan Akun anda, klik tombol di bawah ini.</p></td></tr></table></td>
                    </tr>
                    
                    <tr>
                        <td><div class=t71 style=\"mso-line-height-rule:exactly;mso-line-height-alt:20px;line-height:20px;font-size:1px;display:block;\">&nbsp;</div></td>
                    </tr>
                        
                    <tr>
                        <td><table class=t73 role=presentation cellpadding=0 cellspacing=0 align=center><tr><td class=t74 
                        style=\"background-color:#DB2828;width:308px;text-align:center;line-height:58px;mso-line-height-rule:exactly;mso-text-raise:11px;border-radius:14px 14px 14px 14px;\">
                        <a class=t80 href='" . site_url('verify-mobile/' . $email . '/' . $token) . "'  style=\"display:block;text-decoration:none;direction:ltr;color:#FFFFFF;text-align:center;mso-line-height-rule:exactly;mso-text-raise:11px;font:normal 600 21px/58px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\" target=_blank>Verifikasi Akun</a></td></tr></table></td>
                    </tr>
                    
                    <tr>
                        <td><div class=t71 style=\"mso-line-height-rule:exactly;mso-line-height-alt:20px;line-height:20px;font-size:1px;display:block;\">&nbsp;</div></td>
                    </tr>
                    
                    <tr>
                        <td><table class=t63 role=presentation cellpadding=0 cellspacing=0 align=center><tr><td class=t64 style=\"width:350px;\">
                        <p class=t70 style=\"text-decoration:none;text-transform:none;direction:ltr;color:#B3B3B3;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;font:normal 400 16px/25px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\"></p></td></tr></table></td>
                    </tr>

                    <tr>
                        <center>
                            <img src='https://tenderplus.id/assets/img/logo-tender.png' width='150px' heigth='150px'>
                        </center>

                        <a href='https://www.instagram.com/beecons/'>
								<iconify-icon class=\"iconify\" icon=\"akar-icons:instagram-fill\" 
                                width=\"20\" height=\"20\"></iconify-icon>
							</a>
                    </tr>

                    <tr>
                        <p class=t70 style=\"text-decoration:none;text-transform:none;direction:ltr;color:#000000;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;font:normal 400 16px/25px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\">                       
					    <a href='" . site_url("tentang_kami") . "' style=\"text-decoration:none;text-transform:none;direction:ltr;color:#000000;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;font:normal 400 16px/25px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\">Tentang Kami .</a>
					    <a href='" . site_url("kebijakan_privasi") . "' style=\"text-decoration:none;text-transform:none;direction:ltr;color:#000000;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;font:normal 400 16px/25px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\">Kebijakan Privasi .</a>
					    <a href='" . site_url("hubungi_kami") . "' style=\"text-decoration:none;text-transform:none;direction:ltr;color:#000000;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;font:normal 400 16px/25px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\"> Kontak Kami .</a>
					    <a href='" . site_url("faq") . "' style=\"text-decoration:none;text-transform:none;direction:ltr;color:#000000;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;font:normal 400 16px/25px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\"> FAQ</a>
                    </tr>

                    <tr>
                        <p class=t70 style=\"text-decoration:none;text-transform:none;direction:ltr;color:#000000;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;font:normal 400 16px/25px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\">
                        &copy; 2022. Tender+</p></td></tr></table></td>
                    </tr>
                    
                    <tr>
                        <td><div class=t62 style=\"mso-line-height-rule:exactly;mso-line-height-alt:25px;line-height:25px;font-size:1px;display:block;\">&nbsp;</div></td></tr></table></td>
                    </tr>
                    
                    </table>
                </div>
                </body>
                </html>";

            $this->email->message($message);

            if ($this->email->send()) {
                $this->response([
                    'status' => true,
                    'data' => 'Email berhasil dikirim',
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Email gagal dikirim',
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Akun Belum Terdaftar, Silahkan Daftar Terlebih Dahulu',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function sendResetKey_post()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $reset_key = random_string('alnum', 25);

            if ($this->Reset_model->update_reset_key($email, $reset_key)) {
                $this->load->library('email');
                $config = [];
                $config['charset'] = 'utf-8';
                $config['useragent'] = 'Codeigniter';
                $config['protocol'] = "smtp";
                $config['mailtype'] = "html";
                $config['smtp_host'] = "smtp.gmail.com"; //pengaturan smtp
                // $config['smtp_host'] = "sv2.ecc.co.id"; //pengaturan smtp
                $config['smtp_port'] = "465";
                $config['smtp_timeout'] = "5";
                $config['smtp_user'] = "misterlemper@gmail.com"; // isi dengan email
                $config['smtp_pass'] = "xvzihfwhawxxyjgb"; // isi dengan password
                // $config['smtp_user'] = "security@tenderplus.id"; // isi dengan email
                // $config['smtp_pass'] = "HLILrJW8uTLJ"; // isi dengan password
                $config['crlf'] = "\r\n";
                $config['newline'] = "\r\n";
                $config['smtp_crypto'] = "ssl"; //pengaturan smtp
                // $config['smtp_crypto'] = "tls"; //pengaturan smtp
                $config['wordwrap'] = true;

                //memanggil library email dan set konfigurasi untuk pengiriman email
                $this->email->initialize($config);

                //konfigurasi pengiriman
                // $this->email->from('no-reply@tenderplus.id', 'Tender Plus');
                $this->email->from('misterlemper@gmail.com', 'Tender Plus');
                $this->email->to($this->input->post('email'));
                $this->email->subject("Reset Your Password");

                $message = "
                <!DOCTYPE html>
                <html lang=\"en\">

                <head>
                    <meta charset=\"UTF-8\">
                    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                    <title>Document</title>
                </head>

                <body style=\"margin:0;padding:0;\">
                    <table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
                        <tr>
                            <td align=\"center\" style=\"padding:0;\">
                                <table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border-spacing:0;\">
                                    <tr>
                                        <td style=\"padding:20px\">
                                            <table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
                                                <tr>
                                                    <td style=\"padding:0;\">
                                                        <table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
                                                            <tr>
                                                                <td align=\"center\" style=\"width:100%;padding:0 0 75px 0;vertical-align:top;color:#153643;\">
                                                                    <p style=\"margin:0;font-size: 30px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 700;\">Dear Pengguna <span style=\"color: #BF0C0C;\">tender</span><sup>+</sup></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align=\"center\" style=\"width:100%;padding:0 0 20px 0;vertical-align:top;color:#153643;\">
                                                                    <p style=\"margin:0;font-size: 20px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;\">Untuk mengatur ulang kata sandi kamu,<br>klik tombol di bawah ini.</p>
                                                                </td>
                                                            </tr>
                                                            <table role=\"presentation\" style=\"margin:0;width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
                                                                <tr>
                                                                    <td align=\"center\" style=\"padding:0;\">
                                                                        <table role=\"presentation\" style=\"width:auto;border-collapse:collapse;border:0;border-spacing:0;\">
                                                                            <tr>
                                                                                <td align=\"center\" style=\"background:#BF0C0C;border-radius:3px;padding:0;\">
                                                                                    <a href='" . site_url('lupa/ubah-mobile/' . $reset_key) . '?email=' . $email . "' style=\"text-decoration: none;\">
                                                                                        <p style=\"font-size: 14px;margin:18px 12px;line-height:0;font-family:Ubuntu,sans-serif;color: #ffffff;font-style: normal;font-weight: 500;\">Ubah Kata Sandi</p>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <tr>
                                                                <td align=\"center\" style=\"width:100%;padding:20px 0 0 0;vertical-align:top;color:#153643;\">
                                                                    <p style=\"margin:0;font-size: 13px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;\">Abaikan email ini jika kamu tidak pernah meminta<br>untuk mengatur ulang kata sandi kamu.</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align=\"center\" style=\"padding:100px 0 0 20px;\">
                                                        <img src='https://tenderplus.id/assets/img/logo-tender.png' alt=\"\" width=\"150\" style=\"height:auto;display:block;\" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style=\"padding: 0;\">
                                                        <table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
                                                            <tr>
                                                                <td style=\"padding:0;\">
                                                                    <table align=\"center\" role=\"presentation\" style=\"border-collapse:collapse;border:0;border-spacing:0;\">
                                                                        <tr>
                                                                            <td style=\"padding:0 0 0 10px;width:45px;\">
                                                                                <a href=\"\">
                                                                                    <img src='https://tenderplus.id/assets/img/instagram.png' alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
                                                                                </a>
                                                                            </td>
                                                                            <td style=\"padding:0 0 0 10px;width:45px;\">
                                                                                <a href=\"\">
                                                                                    <img src='https://tenderplus.id/assets/img/linkedin.png' alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
                                                                                </a>
                                                                            </td>
                                                                            <td style=\"padding:0 0 0 10px;width:45px;\">
                                                                                <a href=\"\">
                                                                                    <img src='https://tenderplus.id/assets/img/facebook.png' alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
                                                                                </a>
                                                                            </td>
                                                                            <td style=\"padding:0 0 0 10px;width:45px;\">
                                                                                <a href=\"\">
                                                                                    <img src='https://tenderplus.id/assets/img/homepage_img.png' alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    <table align=\"center\" role=\"presentation\" style=\"border-collapse:collapse;border:0;border-spacing:0;margin-top:20px;\">
                                                                        <tr>
                                                                            <td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
                                                                                <a style=\"text-decoration: none;\" href='" . site_url("tentang_kami") . "'>
                                                                                    <p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">Tentang Kami</p>
                                                                                </a>
                                                                            </td>
                                                                            <td align=\"center\" style=\"padding:0 0 0 10px;width:1px;\">
                                                                                <p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">.</p>
                                                                            </td>
                                                                            <td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
                                                                                <a style=\"text-decoration: none;\" href='" . site_url("hubungi_kami") . "'>
                                                                                    <p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">Kontak Kami</p>
                                                                                </a>
                                                                            </td>
                                                                            <td align=\"center\" style=\"padding:0 0 0 10px;width:1px;\">
                                                                                <p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">.</p>
                                                                            </td>
                                                                            <td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
                                                                                <a style=\"text-decoration: none;\" href='" . site_url("kebijakan_privasi") . "'>
                                                                                    <p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">Kebijakan Privasi</p>
                                                                                </a>
                                                                            </td>
                                                                            <td align=\"center\" style=\"padding:0 0 0 10px;width:1px;\">
                                                                                <p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">.</p>
                                                                            </td>
                                                                            <td align=\"center\" style=\"padding:0 0 0 10px;width:auto;\">
                                                                                <a style=\"text-decoration: none;\" href='" . site_url("faq") . "'>
                                                                                    <p style=\"font-size: 14px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">FAQ</p>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    <table align=\"center\" role=\"presentation\" style=\"border-collapse:collapse;border:0;border-spacing:0;\">
                                                                        <tr>
                                                                            <td align=\"center\" style=\"padding:0;width:auto;\">
                                                                                <p style=\"font-size: 12px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;\">&copy;2022. tender<sup>+</sup></p>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </body>

                </html>
                ";

                $this->email->message($message);

                if ($this->email->send()) {
                    $this->response([
                        'status' => true,
                        'data' => 'Email berhasil dikirimkan!',
                    ], RestController::HTTP_OK);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => $this->email->print_debugger(),
                    ], RestController::HTTP_NOT_FOUND);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Email yang Anda masukkan belum terdaftar atau diaktivasi!',
                ], RestController::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Email gagal terkirim',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function getResetKey_get()
    {
        $email = $this->input->get('email');

        if (!empty($email)) {
            $reset_key = $this->Reset_model->getResetKeyByEmail($email);

            if (!empty($reset_key)) {
                $this->response([
                    'status' => true,
                    'data' => $reset_key,
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Email tidak terdaftar atau email tidak valid!',
                ], RestController::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => "Email harus disi!",
            ], RestController::HTTP_BAD_REQUEST);
        }
    }



    public function changePassword_post($reset_key)
    {
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[passconf]', [
            'matches' => 'Kata Sandi Tidak Sama',
        ]);
        $this->form_validation->set_rules('passconf', 'Confirm Password', 'required|min_length[6]|matches[password]', [
            'matches' => 'Kata Sandi Tidak Sama',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'valid_email' => 'Email tidak Valid',
        ]);
        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $validate = $this->Reset_model->check_reset_key($reset_key, $email);
            $password = md5($this->input->post('password'));
            $expire = 1;

            if ($validate) {
                if ($this->Reset_model->reset_password($reset_key, $password, $expire)) {
                    $this->response([
                        'status' => true,
                        'data' => 'Kata sandi berhasil diubah!',
                    ], RestController::HTTP_OK);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Gagal Mengbuah Kata sandi',
                    ], RestController::HTTP_NOT_FOUND);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Link Expired, Silahkan Send Email lagi',
                ], RestController::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Mengbuah Kata sandi',
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}
