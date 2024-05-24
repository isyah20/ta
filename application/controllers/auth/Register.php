<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Exception\ClientException;
use App\components\traits\User;
use App\components\traits\ClientApi;
use App\components\traits\ClientMobileApi;
use App\components\UserType;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Register extends CI_Controller
{
    use User;
    use ClientApi;
    use ClientMobileApi;
    use \App\models\traits\Wilayah;

    public function __construct()
    {
        parent::__construct();

        require APPPATH . 'libraries/phpmailer/src/Exception.php';
        require APPPATH . 'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH . 'libraries/phpmailer/src/SMTP.php';

        $this->load->model('api/Pengguna_model');
        $this->load->library('form_validation', 'google');
        $this->load->helper('form');
        $this->init();
        $this->initMobile();
    }

    public function index()
    {
        if ($this->session->userdata('user_data')) {
            redirect('');
        } else {
            $google_client = new Google\Client();
            $google_client->setClientId('397353161605-icd30d2vnjh3tngrm47ngq2iuuq9i7pr.apps.googleusercontent.com'); // ClientID
            $google_client->setClientSecret('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'); // Client Secret Key
            $google_client->setRedirectUri(base_url() . 'login'); // Redirect Uri
            $google_client->addScope('email');
            $google_client->addScope('profile');

            if (isset($_GET["code"])) {
                $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
                if (!isset($token["error"])) {
                    $google_client->setAccessToken($token['access_token']);
                    $this->session->set_userdata('access_token', $token['access_token']);
                    $google_service = new Google\Service\Oauth2($google_client);
                    $data = $google_service->userinfo->get();

                    $flag = false;
                    try {
                        $response = $this->client->request('GET', 'pengguna/email/' . $data['email'], $this->client->getConfig('headers'));
                        $result = json_decode($response->getBody()->getContents(), true);

                        $userId = $result['data']['id_pengguna'];
                        set_cookie('id_pengguna', $userId, time() + 86400);

                        if ($result['status'] == 200) {
                            $data_session = [
                                'id_pengguna' => $userId,
                                'nama' => $result['data']['nama'],
                                'email' => $result['data']['email'],
                                'kategori' => $result['data']['kategori'],
                                'status' => $result['data']['status'],
                                'is_active' => $result['data']['is_active'],
                                'jenis_perusahaan' => $result['data']['jenis_perusahaan'],
                                'wa_status' => $result['data']['whatsapp_status'],
                                'lengkap' => $this->isProfileComplete((int) $result['data']['id_pengguna']) ? '1' : '0',
                            ];
                            $this->session->set_userdata('user_data', $data_session);
                            $flag = true;
                        }
                    } catch (ClientException $e) {
                        $this->session->set_flashdata('error', 'Data tidak ada!');
                    }

                    if (!$flag) {
                        return $this->chooseRoles($data);
                    }
                    $result = $this->session->user_data['kategori'];
                    if ($result == 1) {
                        redirect('tender');
                    } elseif ($result == 2) {
                        redirect('user-dashboard');
                    } elseif ($result == 3) {
                        redirect('asosiasi');
                    } elseif ($result == 4) {
                        redirect('suplier');
                    } else {
                        echo 'Not found!';
                    }
                }
            }

            $login_button = '';
            if (!$this->session->userdata('access_token') || !$this->session->userdata('user_data')) {
                $login_button = $google_client->createAuthUrl();
                $data = [
                    'title' => 'Daftar',
                    'login_button' => $login_button,
                ];
                $this->load->view('auth/templates/main_head', $data);
                $this->load->view('auth/register', $data);
                // $this->load->view('auth/cek-email');
                $this->load->view('auth/templates/main_end');
            } else {
                redirect('');
            }
        }
        // $data = [
        // 	'title' => 'Daftar',
        // ];
        // $this->load->view('auth/notifikasi');
        // $this->load->view('auth/templates/main_head', $data);
        // $this->load->view('auth/register');
        // $this->load->view('auth/templates/main_end');
    }

    private function chooseRoles($data)
    {
        if (!$this->session->userdata('access_token')) {
            redirect('login');
        } else {
            $this->load->view('auth/templates/main_head', ['title' => 'Choosing As']);
            $this->load->view('auth/choose', $data);
            $this->load->view('auth/templates/main_end');
        }
    }

    private function cekEmail($email)
    {
        $this->load->view('auth/templates/main_head', ['title' => 'Cek Email']);
        $this->load->view('auth/cekemailVerify', ['email' => $email]);
        $this->load->view('auth/templates/main_end');
    }

    public function newacc()
    {
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('checkout_url');
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('user_preferensi');
        redirect('register');
    }

    public function lengkapi_profile()
    {
        $data = [
            'title' => 'Lengkapi Profil'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar');
        $this->load->view('profile_pengguna/lengkapi-profil');
        $this->load->view('templates/footer');
    }

    /*public function lengkapi_profile()
    {
        if (!$this->session->userdata('user_data')) {
            redirect('login');
        }

        $companyType = $this->input->post('jenis_perusahaan');
        $companyType = $companyType == null ? 0 : (int) $companyType;
        $this->form_validation->set_rules('no_telp', 'no_telp', 'required|trim|regex_match[([0-9])]', [
            'required' => 'Nomor WhatsApp harus diisi',
            'regex_match' => 'Nomor WhatsApp harus berupa angka',
        ]);
        $kategori = $this->session->user_data['kategori'];
        if ($kategori != 4) {
            $this->form_validation->set_rules('jenis_perusahaan', 'jenis_perusahaan', 'required|trim|greater_than[0]|less_than[4]|numeric', [
                'required' => 'Jenis perusahaan harus diisi',
                'greater_than' => 'Jenis perusahaan wajib dipilih!',
                'less_than' => 'Jenis perusahaan harus kurang dari 4',
                'numeric' => 'Jenis perusahaan harus berupa angka',
            ]);
        }
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim|min_length[1]', [
            'required' => (in_array((int) $companyType, [1, 3]) ? 'Alamat perusahaan ' : 'Alamat ') . ' harus diisi',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[password_confirm]', [
            'required' => 'Kata sandi harus diisi',
            'min_length' => 'Kata sandi minimal 6 karakter',
            'matches' => 'Kata sandi tidak sama',
        ]);
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|min_length[6]|matches[password]', [
            'required' => 'Ulangi kata sandi harus diisi',
            'min_length' => 'Ulangi kata sandi minimal 6 karakter',
            'matches' => 'Kata sandi tidak sama',
        ]);
        $this->form_validation->set_rules('nama', 'nama', 'required|min_length[3]', [
            'required' => (in_array($companyType, [1, 3]) ? 'Nama perusahaan' : 'Nama lengkap') . ' harus diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $response = $this->client->request('GET', 'pengguna/' . $this->session->user_data['id_pengguna'], $this->client->getConfig('headers'));
            $user = null;
            if ($this->session->userdata('user_data') != null) {
                $user = $this->session->userdata('user_data');
            }
            $this->load->library('user');
            $photo = null;
            if ($user != null) {
                $photo = $this->user->getPhotoProfile((int) $user['id_pengguna'], $this->db);
            }

            $provinces = $this->getProvinces();
            $data = [
                'title' => 'Lengkapi Profil',
                'halaman' => 'auth/lengkapi-profile/lengkapi-profile',
                'photo' => $photo,
                'userId' => $user['id_pengguna'],
                'pengguna' => json_decode($response->getBody()->getContents(), true)['data'],
                'provinsi' => $provinces,
                'isVerify' => 1
            ];

            if ($this->input->is_ajax_request()) {
                $this->output->set_content_type('application/json')
                    ->set_status_header(422)
                    ->set_output(json_encode($this->form_validation->error_array()))
                    ->_display();
                exit();
            }

            $this->load->view('templates/layout', $data);

            $data['pengguna'] = json_decode($response->getBody()->getContents(), true)['data'];
            $data['provinsi'] = $provinces;
            $data['photo'] = $photo;
            $data['userId'] = $user['id_pengguna'];
            $data['isVerify'] = 1;
            if ($this->input->is_ajax_request()) {
                $this->output->set_content_type('application/json')
                    ->set_status_header(422)
                    ->set_output(json_encode($this->form_validation->error_array()))
                    ->_display();
                exit();
            }

            $this->load->view('auth/lengkapi-profile/templates/header', ['title' => 'Lengkapi profile']);
            // $this->load->view('templates/header', ['title' => 'Lengkapi profile']);
            $this->load->view('templates/navbar', ['photo' => $photo]);
            $this->load->view('auth/lengkapi-profile/lengkapi-profile', $data);
            // $this->load->view('profile_pengguna/templates/footer');
            $this->load->view('templates/footer');
        } else {
            $result = ['error' => 0, 'message' => 'Profil sukses diperbarui.', 'url' => ''];
            $no_wa = substr($this->input->post('no_telp'), 0, 1) == '0' ? '62' . substr($this->input->post('no_telp'), 1, strlen($this->input->post('no_telp')) - 1) : $this->input->post('no_telp');
            $address = sprintf('%s, %s, %s', $this->input->post('alamat'), $this->input->post('city'), $this->input->post('province'));
            $data = [
                'nama' => $this->input->post('nama'),
                'no_telp' => $no_wa,
                'alamat' => $address,
                'npwp' => $this->input->post('npwp'),
                'password' => $this->input->post('password'),
                'is_active' => 1,
                'status' => sprintf('%d', UserType::TRIAL),
            ];
            if ($kategori != 4) {
                $data['jenis_perusahaan'] = $this->input->post('jenis_perusahaan');
            }

            try {
                $response = $this->client->request('POST', 'pengguna/update/' . $this->session->user_data['id_pengguna'], [
                    'form_params' => $data,
                    'auth' => $this->client->getConfig('headers')['auth'],
                ]);

                $userId = $this->session->user_data['id_pengguna'];
                set_cookie('id_pengguna', $userId, time() + 86400);

                $data_session = [
                    'lengkap' => '1',
                    'id_pengguna' => $userId,
                    'email' => $this->session->user_data['email'],
                    'kategori' => $this->session->user_data['kategori'],
                    'nama' => $this->input->post('nama'),
                    'npwp' => null,
                    'is_active' => 1,
                    'wa_status' => $this->session->user_data['wa_status'],
                    'status' => sprintf('%d', UserType::TRIAL),
                ];
                if ($kategori != 4) {
                    $data_session['jenis_perusahaan'] = $this->input->post('jenis_perusahaan');
                }
                $this->session->set_userdata('user_data', $data_session);

                $userCat = $this->session->user_data['kategori'];
                $url = '';
                if ($userCat == UserCategory::SRV_PROVIDER) {
                    $url = 'user-dashboard';
                } elseif ($userCat == UserCategory::ASSOCIATION) {
                    $url = 'asosiasi';
                } elseif ($userCat == UserCategory::SUPPLIER) {
                    $url = 'suplier';
                } else {
                    $url = '/';
                }

                if ($this->input->is_ajax_request()) {
                    $result['url'] = $url;
                    $this->output->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($result))
                        ->_display();
                    exit();
                } else {
                    redirect($url);
                }
            } catch (ClientException $e) {
                $data = json_decode($e->getResponse()->getBody()->getContents());
                $message = $data->message;
                $this->session->set_flashdata('error', $message);
                if ($this->input->is_ajax_request()) {
                    $result['error'] = 1;
                    $result['message'] = $message;
                    $this->output->set_content_type('application/json')
                        ->set_status_header(500)
                        ->set_output(json_encode($result))
                        ->_display();
                    exit();
                }
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }*/

    public function aksi_register()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[pengguna.email]', [
            'is_unique' => 'Email sudah terdaftar!',
        ]);
        $this->form_validation->set_rules(
            'kategori',
            'role',
            'required|trim|in_list[2,3,4]',
            [
                'required' => 'Pilih role terlebih dahulu!',
                'in_list' => 'Role tidak valid',
            ]
        );
        if ($this->form_validation->run() == false) {
            try {
                $data = $this->client->request('get', 'pengguna/email/' . $this->input->post('email'), $this->client->getConfig('headers'));
                $resultCheck = json_decode($data->getBody()->getContents(), true);
                if ($resultCheck['data']['is_active'] == 0) {
                    $this->session->set_flashdata('error', 'Akun Anda belum aktif! Cek pesan masuk email untuk aktivasi akun. <a href="' . base_url('send/verify/') . $this->input->post('email') . '" style="font-weight: 500; color: #D21B1B;"><button id="demo" class="timer" disabled>Klik di sini untuk mengirim ulang email</button></a><div class="countdown" id="countdown"></div>');
                    redirect('login');
                } else {
                    $this->session->set_flashdata('error', 'Email sudah terdaftar, silakan login!');
                    redirect('login');
                    return;
                }
            } catch (ClientException $e) {
                $message = $e->getResponse()->getBody()->getContents();
                $message = json_decode($message, true);
                $this->session->set_flashdata('error', $message['message']);
                return $this->index();
            }
        } else {
            /*$email = $this->input->post('email');
                    $token = random_string('alnum', 25);
                    
                    $mail = new PHPMailer();
            
                    // SMTP configuration
                    $mail->isSMTP();
                    $mail->Host       = 'mail.tenderplus.id';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'noreply@tenderplus.id';
                    $mail->Password   = 'C%87SfcjjaHb*te';
                    $mail->SMTPSecure = 'ssl'; //'tls'
                    $mail->Port       = 25; //587

                    $mail->Timeout = 60; // timeout pengiriman (dalam detik)
                    $mail->SMTPKeepAlive = true; 
            
                    $mail->setFrom('no-reply@tenderplus.id', 'Admin TenderPlus'); // user email
                    $mail->addAddress($email); //email tujuan pengiriman email
            
                    // Email subject
                    $mail->Subject = 'Verifikasi Pendaftaran'; //subject email
            
                    // Set email format to HTML
                    $mail->isHTML(true);
            
                    // Email body content
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
                                    <h2 class=t90 style=\"text-decoration:none;text-transform:none;direction:ltr;color:#000000;text-align:center;mso-line-height-rule:exactly;mso-text-raise:1px;font:normal 500 40px/44px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\">
                                    Dear Pengguna TenderPlus</h2></td></tr></table></td>
                                </tr>
                                
                                <tr>
                                    <td><div class=t94 style=\"mso-line-height-rule:exactly;mso-line-height-alt:30px;line-height:30px;font-size:1px;display:block;\">&nbsp;</div></td>
                                </tr>
                                
                                <tr>
                                    <td><table class=t85 role=presentation cellpadding=0 cellspacing=0 align=center><tr><td class=t86 style=\"width:350px;\">
                                    <p class=t92 style=\"text-decoration:none;text-transform:none;direction:ltr;color:#000;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;font:normal 400 20px/30px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\">
                                    Untuk mengaktifkan akun Anda, silakan klik tombol di bawah ini!</p></td></tr></table></td>
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
                                    &copy; 2023. TenderPlus. All Rights Reserved</p></td></tr></table></td>
                                </tr>
                                
                                <tr>
                                    <td><div class=t62 style=\"mso-line-height-rule:exactly;mso-line-height-alt:25px;line-height:25px;font-size:1px;display:block;\">&nbsp;</div></td></tr></table></td>
                                </tr>
                                
                                </table>
                            </div>
                            </body>
                        </html>";
                    
                    $mail->Body = $message;
            
                    // Send email
                    if (!$mail->send()) {
                        $this->session->set_flashdata('error', 'Gagal mengirim email verifikasi ke <strong>'.$email.'</strong>.<br>'.$mail->ErrorInfo);
                        $this->index();
                    } else {
                        $this->client->request('POST', 'pengguna/create', [
                            'form_params' => [
                                'email' => $email,
                                'kategori' => $this->input->post('kategori'),
                                'password' => md5(random_string('alnum', 8)),
                                'token' => $token,
                                'is_active' => 0,
                                'tgl_update' => date('Y-m-d H:i:s'),
                                'status' => sprintf('%s', UserType::TRIAL),
                            ],
                            'auth' => $this->client->getConfig('headers')['auth'],
                        ]);
                        return $this->cekEmail($email);
                    }*/



            //$this->load->library('email');
            $email = $this->input->post('email');
            $token = random_string('alnum', 25);
            /*$this->email->from('no-reply@tenderplus.id', 'Admin TenderPlus');
            $this->email->to($email);
            $this->email->subject('Verifikasi Pendaftaran');
            
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
                        <h2 class=t90 style=\"text-decoration:none;text-transform:none;direction:ltr;color:#000000;text-align:center;mso-line-height-rule:exactly;mso-text-raise:1px;font:normal 500 40px/44px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\">
                        Dear Pengguna TenderPlus</h2></td></tr></table></td>
                    </tr>
                    
                    <tr>
                        <td><div class=t94 style=\"mso-line-height-rule:exactly;mso-line-height-alt:30px;line-height:30px;font-size:1px;display:block;\">&nbsp;</div></td>
                    </tr>
                    
                    <tr>
                        <td><table class=t85 role=presentation cellpadding=0 cellspacing=0 align=center><tr><td class=t86 style=\"width:350px;\">
                        <p class=t92 style=\"text-decoration:none;text-transform:none;direction:ltr;color:#000;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;font:normal 400 20px/30px BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif, 'Fira Sans';\">
                        Untuk mengaktifkan akun Anda, silakan klik tombol di bawah ini!</p></td></tr></table></td>
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
                        &copy; 2023. TenderPlus. All Rights Reserved</p></td></tr></table></td>
                    </tr>
                    
                    <tr>
                        <td><div class=t62 style=\"mso-line-height-rule:exactly;mso-line-height-alt:25px;line-height:25px;font-size:1px;display:block;\">&nbsp;</div></td></tr></table></td>
                    </tr>
                    
                    </table>
                </div>
                </body>
                </html>";
                
            $this->email->message($message);
            $this->email->set_mailtype('html');
            
            if ($this->email->send()) {
                $this->client->request('POST', 'pengguna/create', [
                    'form_params' => [
                        'email' => $email,
                        'kategori' => $this->input->post('kategori'),
                        'password' => md5(random_string('alnum', 8)),
                        'token' => $token,
                        'is_active' => 0,
                        'tgl_update' => date('Y-m-d H:i:s'),
                        'status' => sprintf('%s', UserType::TRIAL),
                    ],
                    'auth' => $this->client->getConfig('headers')['auth'],
                ]);
                return $this->cekEmail($email);
            } else {
                $this->session->set_flashdata('error', 'Gagal mengirim email verifikasi ke <strong>'.$email.'</strong>.<br>Silakan masukkan email Anda yang valid!');
                $this->index();
            }*/

            $this->client->request('POST', 'pengguna/create', [
                'form_params' => [
                    'email' => $email,
                    'kategori' => $this->input->post('kategori'),
                    'password' => md5(random_string('alnum', 8)),
                    'token' => $token,
                    'is_active' => 0,
                    'tgl_update' => date('Y-m-d H:i:s'),
                    'status' => sprintf('%s', UserType::TRIAL),
                ],
                'auth' => $this->client->getConfig('headers')['auth'],
            ]);

            $this->verify($token, $email);
        }
    }

    public function verify($token)
    {
        $email = $this->input->get('email');
        try {
            $result = $this->client->request('get', 'verify/status/' . $token . '?email=' . $email, $this->client->getConfig('headers'));
            $result = json_decode($result->getBody()->getContents(), true);
            if ($result['data']['is_active'] == 1) {
                $this->session->set_flashdata('success', 'Email Anda sudah terverifikasi.<br>Silakan login menggunakan akun Anda!');
                redirect('login');
            } else {
                if ($result['status'] == 200) {
                    $data = [
                        'email' => $email,
                        'password' => md5(random_string('alnum', 6)),
                    ];
                    $result = $this->client->request('post', 'verify/' . $token . '?email=' . $email, [
                        'form_params' => $data,
                        'auth' => $this->client->getConfig('headers')['auth'],
                    ]);
                    $result = json_decode($result->getBody()->getContents(), true);

                    $userId = $result['data']['id_pengguna'];
                    set_cookie('id_pengguna', $userId, time() + 86400);

                    $data_session = [
                        'lengkap' => '0',
                        'id_pengguna' => $userId,
                        'email' => $email,
                        'kategori' => $result['data']['kategori'],
                        'nama' => $result['data']['nama'],
                        'npwp' => null,
                        'is_active' => 1,
                        'jenis_perusahaan' => $result['data']['jenis_perusahaan'],
                        'wa_status' => $result['data']['whatsapp_status'],
                        'status' => $result['data']['status'],
                    ];
                    $this->session->set_userdata('user_data', $data_session);
                    $this->session->set_flashdata('success', 'Selamat, email Anda berhasil diverifikasi.<br>Silakan lengkapi profil Anda agar dapat mengakses fitur-fitur yang tersedia!');
                    $this->lengkapi_profile();
                } else {
                    $this->session->set_flashdata('error', 'Email gagal diverifikasi.<br>Silakan coba menggunakan email lain!');
                    redirect('login');
                }
            }
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Email gagal diverifikasi.<br>Silakan coba menggunakan email lain!');
            redirect('login');
        }
    }
    public function verifyMobile($email, $token)
    {
        try {
            $check = $this->Pengguna_model->verifyCheck($token, $email);

            if (isset($check)) {
                $resultPengguna = $this->Pengguna_model->verifUser($email);

                if ($resultPengguna) {
                    $this->session->set_flashdata('success', 'Email Anda sudah terverifikasi.<br>Silakan login menggunakan akun di aplikasi mobile Tenderplus Anda!');
                    redirect('blank');
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan!');
                    redirect('blank');
                }
            } else {
                $this->session->set_flashdata('error', 'Email gagal diverifikasi.<br>Silakan coba menggunakan email lain!');
                redirect('blank');
            }
            $result = $this->clientMobile->request('get', 'check-verify?email=' . $email, $this->client->getConfig('headers'));
            $result = json_decode($result->getBody()->getContents(), true);
            if ($result['data']['is_active'] == 1) {
                $this->session->set_flashdata('success', 'Email Anda sudah terverifikasi.<br>Silakan login menggunakan akun di aplikasi mobile Tenderplus Anda!');
                redirect('blank');
            } else {
                $this->session->set_flashdata('error', 'Email gagal diverifikasi.<br>Silakan coba menggunakan email lain!');
                redirect('blank');
            }
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Email gagal diverifikasi.<br>Silakan coba menggunakan email lain!');
            redirect('blank');
        }
    }
    public function blankPageMobile()
    {
        // $this->load->view('auth/templates/main_head');
        $this->load->view('auth/blank');
        // $this->load->view('auth/templates/main_end');
    }

    public function sendEmail($email)
    {
        try {
            $result = $this->client->request('get', 'verifySend?email=' . $email, $this->client->getConfig('headers'));
            $result = json_decode($result->getBody()->getContents(), true);
            if ($result['status'] == 200) {
                $this->session->set_flashdata('success', 'Email verifikasi berhasil dikirim.<br>Silakan cek pesan masuk email Anda!');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Email verifikasi gagal dikirim.<br>Silakan coba kembali!');
                redirect('login');
            }
        } catch (ClientException $e) {
            $message = $e->getResponse()->getBody()->getContents();
            $message = json_decode($message, true);
            // $this->session->set_flashdata('error', $message['message']);
            redirect('login');
        }
    }

    public function getCities($provinceId)
    {
        // $pool = $this->getPool();
        // $res = wait($this->getAsyncCities($pool, (int) $provinceId));
        // $res = $this->getCities((int) $provinceId);
        $res = $this->findCities((int) $provinceId);
        $this->output->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($res))
            ->_display();
        exit();
    }

    private function findCities(int $provinceId)
    {
        $provId = sprintf('%d', $provinceId);
        $head = substr($provId, 0, 2);
        $query = $this->db->select('*')->from('wilayah AS w')
            ->where('w.`id_wilayah` >=', 1000)
            ->where('SUBSTR(CAST(w.`id_wilayah` AS CHAR), 1, 2) =', $head)
            ->where('w.`id_wilayah` <>', $provinceId)
            ->order_by('w.wilayah ASC')
            ->get();
        return $query->result();
    }

    public function getProvince()
    {
        $res = $this->getProvinces();
        $this->output->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($res))
            ->_display();
        exit();
    }

    public function verify_wa()
    {
        $this->form_validation->set_rules('kode_otp', 'kode_otp', 'required|min_length[4]', [
            'required' => 'Kode OTP harus diisi',
            'min_length' => 'Masukkan 4 digit kode OTP',
        ]);
        if ($this->form_validation->run() == false) {
            $no_wa = substr($this->input->post('no_telp'), 0, 1) == '0' ? '62' . substr($this->input->post('no_telp'), 1, strlen($this->input->post('no_telp')) - 1) : $this->input->post('no_telp');
            $kode = strval(rand(1000, 9999));
            $data = [
                'no_telp' => $no_wa,
                'otp' => $kode,
            ];
            $flag = true;
            $response = $this->client->request('GET', 'pengguna', $this->client->getConfig('headers'));
            $results = json_decode($response->getBody()->getContents(), true)['data'];
            foreach ($results as $result) {
                if ($result['no_telp'] == $no_wa && $result['whatsapp_status'] == '1') {
                    $flag = false;
                    break;
                }
            }
            if (!$flag) {
                $resp['error'] = 1;
                $resp['message'] = "Nomor sudah terdaftar";
                $this->output->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode($resp))
                    ->_display();
                exit();
            } else {
                try {
                    $result = ['error' => 0];
                    $response = $this->client->request('POST', 'pengguna/update/' . $this->session->user_data['id_pengguna'], [
                        'form_params' => $data,
                        'auth' => $this->client->getConfig('headers')['auth'],
                    ]);
                    $pesan = "Halo *{$this->input->post('nama')}*,\n\nBerikut adalah kode OTP untuk verifikasi nomor whatsapp diakun Tenderplus.id Anda:\n\n*{$kode}*\n\n*Kode OTP berlaku selama 3 menit jaga kerahasiaan kode OTP Anda.";

                    $data = [
                        'api_key' => 'OAcYMmjgG1vpneHlpRAHduHOLvpDEn',
                        'sender' => '6282328429138',
                        'number' => $no_wa,
                        'message' => $pesan
                    ];

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://wa.srv3.wapanels.com/send-message',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => json_encode($data),
                        CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
                    ));

                    curl_exec($curl);
                    curl_close($curl);
                    $this->output->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($result))
                        ->_display();
                    exit();
                } catch (ClientException $e) {
                    $data = json_decode($e->getResponse()->getBody()->getContents());
                    $message = $data->message;
                    $this->session->set_flashdata('error', $message);
                    if ($this->input->is_ajax_request()) {
                        $result['error'] = 1;
                        $result['message'] = $message;
                        $this->output->set_content_type('application/json')
                            ->set_status_header(500)
                            ->set_output(json_encode($result))
                            ->_display();
                        exit();
                    }
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        } else {
            try {
                $response = $this->client->request('GET', 'pengguna/' . $this->session->user_data['id_pengguna'], $this->client->getConfig('headers'));
                $result = json_decode($response->getBody()->getContents(), true)['data'];
                $time = date('Y-m-d H:i:s');
                $limitTime = date('Y-m-d H:i:s', strtotime($result['tgl_update'] . ' +3 minutes'));
                $data = [
                    'whatsapp_status' => '1',
                    'otp' => ' ',
                ];

                if ($result['otp'] == $this->input->post('kode_otp') && $time <= $limitTime) {
                    $response = $this->client->request('POST', 'pengguna/update/' . $this->session->user_data['id_pengguna'], [
                        'form_params' => $data,
                        'auth' => $this->client->getConfig('headers')['auth'],
                    ]);
                    $resp = ['error' => 0, 'message' => 'Kode otp terverifikasi.'];
                    $kategori = $this->session->user_data['kategori'];

                    $userId = $this->session->user_data['id_pengguna'];
                    set_cookie('id_pengguna', $userId, time() + 86400);

                    $data_session = [
                        'lengkap' => '1',
                        'id_pengguna' => $userId,
                        'email' => $this->session->user_data['email'],
                        'kategori' => $kategori,
                        'nama' => $this->session->user_data['nama'],
                        'npwp' => null,
                        'is_active' => 1,
                        'wa_status' => '1',
                        'status' => sprintf('%d', UserType::TRIAL),
                    ];
                    if ($kategori != 4) {
                        $data_session['jenis_perusahaan'] = $this->input->post('jenis_perusahaan');
                    }
                    $this->session->set_userdata('user_data', $data_session);

                    $this->output->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($resp))
                        ->_display();
                    exit();
                } else {
                    $data['whatsapp_status'] = '0';
                    if ($time > $limitTime) {
                        $response = $this->client->request('POST', 'pengguna/update/' . $this->session->user_data['id_pengguna'], [
                            'form_params' => $data,
                            'auth' => $this->client->getConfig('headers')['auth'],
                        ]);
                    }
                    $resp = ['error' => 1, 'message' => 'Gagal Memverifikasi.'];
                    $this->output->set_content_type('application/json')
                        ->set_status_header(500)
                        ->set_output(json_encode($resp))
                        ->_display();
                    exit();
                }
            } catch (ClientException $e) {
                $data = json_decode($e->getResponse()->getBody()->getContents());
                $message = $data->message;
                $this->session->set_flashdata('error', $message);
                if ($this->input->is_ajax_request()) {
                    $result['error'] = 1;
                    $result['message'] = $message;
                    $this->output->set_content_type('application/json')
                        ->set_status_header(500)
                        ->set_output(json_encode($result))
                        ->_display();
                    exit();
                }
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
}
