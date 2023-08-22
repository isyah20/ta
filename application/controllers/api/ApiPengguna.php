<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace
use chriskacerguis\RestServer\RestController;
use App\components\UserCategory;
use App\components\traits\User;

//  to use RestController class we need to extend it to our controller class
class ApiPengguna extends RestController
{
    use User;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Pengguna_model');
    }

    // method must name between _get to using get request
    public function index_get()
    {
        $resultPengguna = $this->Pengguna_model->getAllPengguna();

        if ($resultPengguna) {
            $this->response([
                'status' => true,
                'data' => $resultPengguna,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getId_get($id)
    {
        $resultPengguna = $this->Pengguna_model->getPenggunaById($id);

        if ($resultPengguna) {
            $this->response([
                'status' => true,
                'data' => $resultPengguna,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function create_post()
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
                'nama' => $this->post('nama'),
                'email' => $this->post('email'),
                'password' => md5($this->post('password')),
                'kategori' => $this->post('kategori'),
                'alamat' => $this->post('alamat'),
                'npwp' => $this->post('npwp'),
                'no_telp' => $this->post('no_telp'),
                'status' => $this->post('status'),
                'token' => $this->post('token'),
                'is_active' => $this->post('is_active'),
                'tgl_update' => date('Y-m-d H:i:s'),
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

    public function update_post($id)
    {
        $compType = $this->post('jenis_perusahaan');
        if ($compType == null || (int) $compType < 1) {
            $compType = 2;
        }

        $data = [
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'password' => $this->post('password'),
            'kategori' => $this->post('kategori'),
            'alamat' => $this->post('alamat'),
            'npwp' => $this->post('npwp'),
            'no_telp' => $this->post('no_telp'),
            'status' => $this->post('status'),
            'token' => $this->post('token'),
            'otp' => $this->post('otp'),
            'whatsapp_status' => $this->post('whatsapp_status'),
            'is_active' => $this->post('is_active'),
            'tgl_update' => date('Y-m-d H:i:s'),
            'jenis_perusahaan' => $compType,
        ];
        $data_new = [];
        foreach ($data as $key => $value) {
            if ($value) {
                if ($key == 'password') {
                    $data_new[$key] = md5($value);
                } else {
                    $data_new[$key] = $value;
                }
            }
        }
        $resultPengguna = $this->Pengguna_model->ubahPengguna($id, $data_new);
        if ($resultPengguna) {
            $this->response([
                'status' => true,
                'message' => 'pengguna berhasil diupdate',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal mengupdate data',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function destroy_delete($id)
    {
        $resultPengguna = $this->Pengguna_model->hapusPengguna($id);

        if ($resultPengguna) {
            $this->response([
                'status' => true,
                'message' => 'Pengguna berhasil dihapus',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Pengguna gagal dihapus',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function getEmail_get($email)
    {
        $resultPengguna = $this->Pengguna_model->getByEmail($email);

        if ($resultPengguna) {
            $this->response([
                'status' => true,
                'data' => $resultPengguna,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Akun Belum Terdaftar, Silahkan Daftar Terlebih Dahulu',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function verifyCheck_get($token)
    {
        $email = $this->get('email');
        $resultPengguna = $this->Pengguna_model->verifyCheck($token, $email);

        if ($resultPengguna) {
            $this->response([
                'status' => true,
                'data' => $resultPengguna,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'not found',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function verify_post($token)
    {
        $email = $this->input->get('email');
        $data = [
            'email' => $email,
            'password' => md5($this->post('password')),
            'token' => $token,
            'tgl_update' => date('Y-m-d H:i:s'),
        ];
        $resultPengguna = $this->Pengguna_model->verify($data);

        if ($resultPengguna) {
            $this->response([
                'status' => true,
                'data' => $resultPengguna,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'not found',
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
            $config['smtp_host'] = "sv2.ecc.co.id"; //pengaturan smtp
            $config['smtp_port'] = "465";
            $config['smtp_timeout'] = "5";
            $config['smtp_user'] = "security@tenderplus.id"; // isi dengan email
            $config['smtp_pass'] = "HLILrJW8uTLJ"; // isi dengan password
            $config['crlf'] = "\r\n";
            $config['newline'] = "\r\n";
            $config['smtp_crypto'] = "ssl"; //pengaturan smtp
            $config['wordwrap'] = true;

            //memanggil library email dan set konfigurasi untuk pengiriman email
            $this->email->initialize($config);

            //konfigurasi pengiriman
            $this->email->from('no-reply@tenderplus.id', 'Tender Plus');
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
                        <a class=t80 href='" . site_url('verify/' . $token) . '?email=' . $email . "'  style=\"display:block;text-decoration:none;direction:ltr;color:#FFFFFF;text-align:center;mso-line-height-rule:exactly;mso-text-raise:11px;font:normal 600 21px/58px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\" target=_blank>Verifikasi Akun</a></td></tr></table></td>
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
                            <img src='" . base_url() . "assets/img/logo-tender.png' width='150px' heigth='150px'>
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

    // Periksa status user yang trial dan update statusnya menjadi free jika masa trial habis.
    public function checkAndUpdateUserType_get()
    {
        $result = ['error_code' => 0, 'message' => ''];
        $listNonAdmin = array_map(fn ($item) => sprintf('%d', $item), UserCategory::getNonAdmin());
        $query = $this->db->select('id_pengguna, status')->from('pengguna')
            ->where_in('kategori', $listNonAdmin)
            ->where('status', '2')
            ->where('is_active', 1)->get();
        $rows = $query->result_array();
        if (!$rows) {
            $result['message'] = 'User trial tidak ditemukan.';
            $this->response($result, RestController::HTTP_OK);
            exit();
        }

        $cnt = 0;
        foreach ($rows as $row) {
            $duration = $this->getUserDuration($row['id_pengguna']);
            if ($duration > 0) {
                continue;
            }
            $this->db->where('id_pengguna', $row['id_pengguna'])->set('status', '0')->update('pengguna');
            $error = $this->db->error();
            if ((int) $error['code'] == 0) {
                $cnt++;
            }
        }

        $result['message'] = sprintf('%d user trial berhasil diubah ke user free karena masa trial habis.', $cnt);
        $this->response($result, RestController::HTTP_OK);
    }
}
