<?php

defined('BASEPATH') or exit('No direct script access allowed');

// import the library
require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

// use namespace

use App\components\traits\ClientApi;
use chriskacerguis\RestServer\RestController;
use App\components\UserCategory;
use App\components\traits\User;
use App\components\UserType;

class ApiSupplier extends RestController
{
    use \App\models\traits\Supplier;
    use User;
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Reset_model');
        $this->load->model('api/Supplier_api');
        $this->load->model('Supplier_model');
        // $this->load->model('Tender_model');
        $this->load->model('Tender_model');
        $this->load->library('form_validation', 'google');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->model('Pengguna_model');
        // $this->load->library('form_validation');
        $this->init();
    }

    public function index_get()
    {
        $id_supplier = $this->input->get('id_pengguna');
        $data = $this->Supplier_api->getTimMarketing($id_supplier);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getbyId_get($id)
    {
        // $id = $this->get('id_tim');
        $data = $this->Supplier_api->getTimMarketingById($id);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function create_post()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[pengguna.email]', ['required' => 'Email tidak boleh kosong!', 'valid_email' => 'Email tidak valid', 'is_unique' => 'Email tidak boleh sama']);
        $this->form_validation->set_rules('nama_tim', 'nama tim', 'required|trim', ['required' => 'Nama tim tidak boleh kosong!',]);
        $this->form_validation->set_rules('no_telp', 'nomor telepon', 'required|trim', ['required' => 'No telepon tidak boleh kosong!',]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim', ['required' => 'Alamat tidak boleh kosong!',]);
        $this->form_validation->set_rules('posisi', 'posisi', 'required|trim', ['required' => 'Posisi tidak boleh kosong!',]);

        if (!$this->form_validation->run()) {
            $this->response([
                'status' => false,
                'message' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $token = random_string('alnum', 25);
        $password = random_string('alnum', 8);
        $data_pengguna = [
            'nama' => $this->post('nama_tim'),
            'email' => $this->post('email'),
            'alamat' => $this->post('alamat'),
            'no_telp' => $this->post('no_telp'),
            'kategori' => UserCategory::MARKETING,
            'password' => md5($password),
            'token' => $token,
            'is_active' => 1,
            'tgl_update' => date('Y-m-d H:i:s'),
            // 'status' => UserType::PAID,
        ];
        $result = $this->Supplier_api->insertTimToPengguna($data_pengguna);

        if ($result['status']) {
            $data = [
                'posisi' => $this->post('posisi'),
                'is_valid_user' => 0,
                'password_default' => $password,
                // 'id_supplier' => 360,
                'id_supplier' => $_COOKIE['id_pengguna'],
                'id_pengguna' => $result['id_pengguna'],
            ];
            if ($this->Supplier_api->createTimMarketing($data) > 0) {
                $supplier = $this->Pengguna_model->getProfilPengguna($data['id_supplier'])->row_array();
                $data_pengguna['password_default'] = $password;
                $data_pengguna['nama_supplier'] = $supplier['nama'];
                $statusEmail = $this->sendEmailPassword_get($data_pengguna);
                if (!$statusEmail['status']) {
                    $this->response([
                        'status' => false,
                        'message' => 'Email gagal terkirim',
                    ], RestController::HTTP_BAD_REQUEST);
                }
                $this->response([
                    'status' => true,
                    'message' => 'Data berhasil ditambahkan'
                ], RestController::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Gagal menambahkan data tim markteing'
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menambahkan data pengguna'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function sendEmailPassword_get($data)
    {
        if (!empty($data)) {
            $reset_key = random_string('alnum', 25);

            if ($this->Reset_model->update_reset_key($data['email'], $reset_key)) {
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
                $this->email->to($data['email']);
                $this->email->subject("Konfirmasi Email Akun Marketing");

                $message = "<!DOCTYPE html>
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
                            <table role=\"presentation\" style=\"width:60%;padding:30px;border-collapse:collapse;border-spacing:0;\">
                                <tr>
                                    <td style=\"padding:20px\">
                                        <table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
                                            <tr>
                                                <td style=\"padding:0;\">
                                                    <table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
                                                        <tr>
                                                            <td align=\"center\" style=\"width:100%;padding:0 0 50px 0;vertical-align:top;color:#153643;\">
                                                                <p style=\"margin:0;font-size: 30px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 700;\">Pemberitahuan Pendaftaran</p>
                                                                <p style=\"margin:0;font-size: 30px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 700;\">Pengguna <span style=\"color: #BF0C0C;\">tender</span><sup>+</sup></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align=\"left\" style=\"width:100%;padding:0 0 15px 0;vertical-align:top;color:#153643;\">
                                                                <p style=\"margin:0;font-size: 16px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;\">Kepada {$data['nama']} yang terhormat,</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align=\"left\" style=\"width:100%;padding:0 0 15px 0;vertical-align:top;color:#153643;\">
                                                                <p style=\"text-align: justify;margin:0;font-size: 16px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;\">Kami memberitahukan bahwa akun Anda telah didaftarkan oleh <strong>{$data['nama_supplier']}</strong> sebagai anggota tim marketing di Tender Plus. Gunakan Tender Plus untuk memfollow up tim dari data leads. Berikut adalah informasi akun yang Anda butuhkan untuk masuk ke platform Tender Plus:</p
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align=\"left\" style=\"width:100%;padding:0 0 15px 0;vertical-align:top;color:#153643;\">
                                                                <p style=\"margin:0;font-size: 16px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;\">Email Pengguna: <strong>{$data['email']}</strong></p>
                                                                <p style=\"margin:0;font-size: 16px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;\">Kata Sandi: <strong>{$data['password_default']}</strong></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align=\"left\" style=\"width:100%;padding:0 0 15px 0;vertical-align:top;color:#153643;\">
                                                                <p style=\"text-align: justify;margin:0;font-size: 16px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;\">Kami sarankan Anda segera mengganti kata sandi Anda untuk meningkatkan keamanan akun Anda dengan mengklik tombol di bawah ini:</p>
                                                            </td>
                                                        </tr>
                                                        <table role=\"presentation\" style=\"margin:0;width:100%;padding:15px 0;border-collapse:collapse;border:0;border-spacing:0;\">
                                                            <tr>
                                                                <td align=\"center\" style=\"padding:20px 0;\">
                                                                    <table role=\"presentation\" style=\"width:auto;border-collapse:collapse;border:0;border-spacing:0;\">
                                                                        <tr>
                                                                            <td align=\"center\" style=\"background:#BF0C0C;border-radius:3px;padding:0;\">
                                                                                <a href='" . site_url('lupa/ubah/' . $reset_key) . '?email=' . $data['email'] . "' style=\"text-decoration: none;\">
                                                                                    <p style=\"font-size: 14px;margin:18px 12px;line-height:0;font-family:Ubuntu,sans-serif;color: #ffffff;font-style: normal;font-weight: 500;\">Ubah Sandi</p>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <tr>
                                                            <td align=\"left\" style=\"width:100%;padding:0 0 15px 0;vertical-align:top;color:#153643;\">
                                                                <p style=\"text-align: justify;margin:0;font-size: 16px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;\">Abaikan pesan ini jika Anda tidak mengenali Perusahanaan ini. Kami mengucapkan terima kasih atas partisipasi Anda dalam Tender Plus dan siap memberikan dukungan penuh untuk memastikan pengalaman Anda yang optimal.</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align=\"left\" style=\"width:100%;padding:0 0 15px 0;vertical-align:top;color:#153643;\">
                                                                <p style=\"margin:0;font-size: 16px;font-family:Ubuntu,sans-serif;color: #000000;font-style: normal;font-weight: 500;\">Salam hormat,</p>
                                                            </td>
                                                        </tr>
                                                       
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align=\"center\" style=\"padding:80px 0 20px 0px;\">
                                                    <img src=\"https://tenderplus.id/assets/img/logo-tender.png\" alt=\"\" width=\"150\" style=\"height:auto;display:block;\" />
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
                                                                                <img src=\"https://tenderplus.id/assets/img/instagram.png\" alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
                                                                            </a>
                                                                        </td>
                                                                        <td style=\"padding:0 0 0 10px;width:45px;\">
                                                                            <a href=\"\">
                                                                                <img src=\"https://tenderplus.id/assets/img/linkedin.png\" alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
                                                                            </a>
                                                                        </td>
                                                                        <td style=\"padding:0 0 0 10px;width:45px;\">
                                                                            <a href=\"\">
                                                                                <img src=\"https://tenderplus.id/assets/img/facebook.png\" alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
                                                                            </a>
                                                                        </td>
                                                                        <td style=\"padding:0 0 0 10px;width:45px;\">
                                                                            <a href=\"\">
                                                                                <img src=\"https://tenderplus.id/assets/img/homepage_img.png\" alt=\"\" width=\"40\" style=\"height:auto;display:block;\" />
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

            </html>";

                $sended = $this->email->message($message);

                if ($this->email->send()) {
                    $this->response([
                        'status' => true,
                        'data' => 'Email berhasil dikirim',
                    ], RestController::HTTP_OK);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => $sended,
                    ], RestController::HTTP_BAD_REQUEST);
                    $this->response([
                        'status' => false,
                        'message' => 'Email gagal dikirim',
                    ], RestController::HTTP_BAD_REQUEST);
                }
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Akun Belum Terdaftar, Silahkan Daftar Terlebih Dahulu',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function deleteTim_delete($id)
    {
        // $id = $this->get('id_tim');
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->Supplier_api->deleteTimMarketing($id) > 0) {
                if ($this->Supplier_model->resetPlotTim($id)) {
                    $this->response([
                        'status' => true,
                        'id' => $id,
                        'message' => 'Data berhasil dihapus'
                    ], RestController::HTTP_OK);
                } else {
                    $this->response([
                        'status' => true,
                        'message' => 'Data gagal dihapus'
                    ], RestController::HTTP_INTERNAL_ERROR);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function editTimMarketing_post($id)
    {
        // $id = $this->post('id_tim');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email', ['required' => 'Email tidak boleh kosong!', 'valid_email' => 'Email tidak valid']);
        $this->form_validation->set_rules('nama_tim', 'nama tim', 'required|trim', ['required' => 'Nama tim tidak boleh kosong!',]);
        $this->form_validation->set_rules('no_telp', 'nomor telepon', 'required|trim', ['required' => 'No telepon tidak boleh kosong!',]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim', ['required' => 'Alamat tidak boleh kosong!',]);
        $this->form_validation->set_rules('posisi', 'posisi', 'required|trim', ['required' => 'Posisi tidak boleh kosong!',]);
        if (!$this->form_validation->run()) {
            $this->response([
                'status' => false,
                'message' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $data = [
            'nama' => $this->post('nama_tim'),
            // 'posisi' => $this->post('posisi'),
            'no_telp' => $this->post('no_telp'),
            'email' => $this->post('email'),
            'alamat' => $this->post('alamat'),
        ];


        if (!isset($id)) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else if ($this->Supplier_api->updateTimPengguna($data, $this->Supplier_api->getTimMarketingById($id)['id_pengguna'])) {
            if ($this->Supplier_api->updateTimMarketing(array('posisi' => $this->post('posisi')), $id)) {
                $this->response([
                    'status' => true,
                    'message' => 'Data berhasil diubah'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data \'posisi\' gagal diubah'
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => false,
                // 'message' => 'Data gagal diubah'
                'message' => $id
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // Function Plotting
    public function insertIntoPlot_post()
    {
        $data = [
            'id_tim' => $this->post('id_tim'),
            'id_pemenang' => $this->post('id_pemenang'),
        ];

        if ($this->Supplier_api->insertPlotting($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal ditambahkan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function updatePlotting_post($id)
    {
        // $id = $this->post('id_plot');
        $data = [
            'id_tim' => $this->post('id_tim'),
            'id_pemenang' => $this->post('id_pemenang'),
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else if ($this->Supplier_api->updatePlotting($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal diubah'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function deletePlotting_delete($id)
    {
        // $id = $this->get('id_plot');
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->Supplier_api->deletePlotting($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data berhasil dihapus'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function getProfile_get($id)
    {
        // $id = $this->get('id_lead');
        $data = $this->Supplier_api->getProfile($id);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function insertProfile_post($id)
    {
        // $id = $this->post('id_lead');
        $data = [
            'profil' => $this->post('profil')
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else if ($this->Supplier_api->insertProfile($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal diubah'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function getContact_get($id)
    {
        // $id = $this->get('id_lead');
        $data = $this->Supplier_api->getContact($id);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getContactById_get($id)
    {
        // $id = $this->get('id_kontak');
        $data = $this->Supplier_api->getContactById($id);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function insertContact_post()
    {
        $data = [
            'id_lead' => $this->post('id_lead'),
            'nama' => $this->post('nama'),
            'posisi' => $this->post('posisi'),
            'no_telp' => $this->post('no_telp'),
            'email' => $this->post('email')
        ];

        if ($this->Supplier_api->insertContact($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal ditambahkan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function updateContact_post($id)
    {
        // $id = $this->post('id_kontak');
        $data = [
            // 'id_lead' => $this->post('id_lead'),
            'nama' => $this->post('nama'),
            'posisi' => $this->post('posisi'),
            'no_telp' => $this->post('no_telp'),
            'email' => $this->post('email')
        ];

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else if ($this->Supplier_api->updateContact($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal diubah'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function deleteContact_delete($id)
    {
        // $id = $this->get('id_kontak');
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Berikan id'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->Supplier_api->deleteContact($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data berhasil dihapus'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    //Get pemenang by npwp
    public function getPemenangByNPWP_get($npwp)
    {
        $data = $this->Supplier_api->getPemenangByNPWP($npwp);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    //Get pemenang filter
    public function pemenangFiltered_post()
    {
        $npwp               = $this->input->post('npwp');
        $lokasi             = $this->input->post('lokasi');
        $jenis              = $this->input->post('jenis_pengadaan');
        $penawaran_awal     = $this->input->post('nilai_penawaran_awal');
        $penawaran_akhir    = $this->input->post('nilai_penawaran_akhir');
        $tahun              = $this->input->post('tahun');
        $data = $this->Supplier_api->getPemenangFilter($npwp, $lokasi, $jenis, $penawaran_awal, $penawaran_akhir, $tahun);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_BAD_REQUEST);
            // ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getLeads_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $page_size = $_GET['pageSize'];
        $page_number = ($_GET['pageNumber'] - 1) * $page_size;
        $response = $this->Supplier_api->getDataLeads($id_pengguna, $page_size, $page_number)->result();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getCRMLeads_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $response = $this->Supplier_api->getCRMLeads($id_pengguna)->result();
        $response['jumlah'] = $this->Supplier_api->countCRMLeads($id_pengguna)->row('jumlah');

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();

        exit;
    }

    public function getCountLeadNull_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $data = $this->Supplier_api->getCountDataLeads($id_pengguna);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getTotalLeads_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $data = $this->Supplier_api->getTotalDataLeads($id_pengguna);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getTotalDataLeadFiltered_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $nama_perusahaan = $this->input->get('key');
        $data = $this->Supplier_api->getTotalDataLeadFiltered($id_pengguna, $nama_perusahaan);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getJumlahPemenangPerMonth_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $tahun = $this->input->get('tahun');
        // $preferensi = $this->Tender_model->getPreferensiPengguna($id_pengguna);
        $data = $this->Supplier_model->getJumlahPerMonth($id_pengguna, $tahun);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data,
                // 'message' => 'Data ditemukan'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getPemenang_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        // $tahun = $this->input->get('tahun');
        $data = $this->Supplier_model->getJumlahPemenangTender($id_pengguna)->result_array();

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data,
                // 'message' => 'Data ditemukan'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getLeadsTerbaru_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $data = $this->Supplier_api->getLeadsTerbaru($id_pengguna);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data,
                // 'message' => 'Data ditemukan'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function getLeadsNotPlotted_get()
    {
        $id_pengguna = $this->input->get('id_pengguna');
        $data = $this->Supplier_api->getLeadsNotPlotted($id_pengguna);

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data,
                // 'message' => 'Data ditemukan'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => $data,
                // 'message' => 'Data tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}
