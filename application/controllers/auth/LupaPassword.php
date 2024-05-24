<?php

defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientMobileApi;

class LupaPassword extends CI_Controller
{
    use ClientMobileApi;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Reset_model');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->initMobile();
    }

    public function index()
    {
        $data = [
            'title' => 'Lupa Password',
        ];
        $this->load->view('auth/templates/main_head', $data);
        $this->load->view('auth/lupa-password');
        $this->load->view('auth/templates/main_end');
    }

    public function cekEmail()
    {
        $data = [
            'title' => 'Cek Email',
        ];
        $this->load->view('auth/templates/main_head', $data);
        $this->load->view('auth/cek-email');
        $this->load->view('auth/templates/main_end');
    }

    public function emailValidation()
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
                                                                                    <a href='" . site_url('lupa/ubah/' . $reset_key) . '?email=' . $email . "' style=\"text-decoration: none;\">
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
                    $this->session->set_flashdata('success', 'Silakan cek email ' . $this->input->post('email') . 'untuk mengubah password!');
                    redirect('lupa/cekemail');
                } else {
                    show_error($this->email->print_debugger());
                    $this->session->set_flashdata('error', 'Gagal mengirim email ke ' . $this->input->post('email') . '!');
                }
                $this->index();
            } else {
                $this->session->set_flashdata('error', 'Email yang Anda masukkan belum terdaftar atau diaktivasi!');
                $this->index();
            }
        } else {
            $this->load->view('auth/lupa-password');
        }
    }

    public function resetValidation($reset_key)
    {
        $email = $this->input->get('email');
        $data['title'] = 'Kata Sandi Baru';
        $data['pengguna'] = $this->Reset_model->getResetKey($reset_key, $email);
        if (!$data['pengguna']) {
            return $this->viewEror();
        } elseif ($data['pengguna']['expire_key'] == 1) {
            $this->session->set_flashdata('error', 'Link Expired, Silahkan Send Email lagi');
            $this->index();
        } elseif ($data['pengguna']['reset_key'] != null && $data['pengguna']['expire_key'] != 1) {
            $this->load->view('auth/templates/main_head', $data);
            $this->load->view('auth/new-password', $data);
            $this->load->view('auth/templates/main_end');
        }
    }
    public function resetValidationMobile($reset_key)
    {
        $email = $this->input->get('email');
        $data['pengguna'] = $this->Reset_model->getResetKey($reset_key, $email);
        if (!$data['pengguna']) {
            $this->session->set_flashdata('error', 'Permintaan reset anda tidak valid');
            redirect('blank');
        } elseif ($data['pengguna']['expire_key'] == 1) {
            $this->session->set_flashdata('error', 'Link Expired, Silahkan Send Email lagi');
            $this->index();
        } elseif ($data['pengguna']['reset_key'] != null && $data['pengguna']['expire_key'] != 1) {
            $this->session->set_flashdata('success', 'Link Valid, silahkan ubah password akun di aplikasi mobile tenderplus Anda!');
            redirect('blank');
        }
    }

    public function ubahPass($reset_key)
    {
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[password_confirm]', [
            'matches' => 'Kata Sandi Tidak Sama',
        ]);
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|min_length[6]|matches[password]', [
            'matches' => 'Kata Sandi Tidak Sama',
        ]);
        $email = $this->input->get('email');
        if ($this->form_validation->run() != false) {
            $validate = $this->resetKeyValidation($reset_key, $email);
            $password = md5($this->input->post('password'));
            $expire = 1;

            if ($validate == true) {
                if ($this->Reset_model->reset_password($reset_key, $password, $expire)) {
                    $this->session->set_flashdata('success', 'Kata sandi berhasil diubah');
                    redirect('login');
                } else {
                    $this->session->set_flashdata('error', 'Gagal Mengbuah Kata sandi');
                    return $this->resetValidation($reset_key);
                }
            } else {
                return $this->viewEror();
            }
        } else {
            return $this->resetValidation($reset_key);
        }
    }

    public function resetKeyValidation($reset_key, $email)
    {
        $validate = $this->Reset_model->check_reset_key($reset_key, $email);

        if ($validate == 1) {
            return true;
        }

        $expire = $this->Reset_model->getResetKey($reset_key, $email);

        if ($expire['expire_key'] == 1) {
            $this->load->view('auth/templates/main_head', ['title' => 'Redirect back']);
            echo "<h2 class='text-center text-white pt-5' > Link Expired, Silahkan Send Email lagi </h2>";
            $this->load->view('auth/templates/main_end');
            $this->output->set_header('refresh:5; url=' . base_url('lupa'));
        } else {
            $this->load->view('auth/templates/main_head', ['title' => 'Redirect back']);
            echo "<h2 class='text-center text-white pt-5' > Jangan Mengubah apapun </h2>";
            $this->load->view('auth/templates/main_end');
            $this->output->set_header('refresh:2; url=' . base_url() . '/lupa/ubah/' . $reset_key);
        }
    }

    public function viewEror()
    {
        $this->load->view('auth/templates/main_head', ['title' => 'Redirect back']);
        echo "<h2 class='text-center text-white pt-5' > Halaman Tidak ditemukan</h2>";
        $this->load->view('auth/templates/main_end');
        $this->output->set_header('refresh:2; url=' . base_url());
    }
}
