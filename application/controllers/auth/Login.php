<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Exception\ClientException;
use App\components\UserCategory;
use App\components\traits\User;
use App\components\traits\ClientApi;
use App\components\UserType;

class Login extends CI_Controller
{
    use User;
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Pengguna_model');
        $this->load->library('form_validation', 'google');
        $this->load->helper('form');
        $this->init();
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
                        if ($result['status'] == 200) {
                            $userId = $result['data']['id_pengguna'];
                            set_cookie('id_pengguna', $userId, time()+86400);
                            
                            $data_session = [
                                'id_pengguna' => $userId,
                                'nama' => $result['data']['nama'],
                                'email' => $result['data']['email'],
                                'kategori' => $result['data']['kategori'],
                                'status' => $result['data']['status'],
                                'is_active' => $result['data']['is_active'],
                                'jenis_perusahaan' => $result['data']['jenis_perusahaan'],
                                'lengkap' => $this->isProfileComplete((int) $result['data']['id_pengguna']) ? '1' : '0',
                                // 'wa_status' => $result['data']['whatsapp_status'],
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
                    if ($result == UserCategory::ADMIN) {
                        redirect('tender');
                    } elseif ($result == UserCategory::SRV_PROVIDER) {
                        redirect('user-dashboard');
                    } elseif ($result == UserCategory::ASSOCIATION) {
                        redirect('asosiasi');
                    } elseif ($result == UserCategory::SUPPLIER) {
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
                    'title' => 'Masuk',
                    'login_button' => $login_button,
                ];
                $this->load->view('auth/templates/main_head', $data);
                $this->load->view('auth/login', $data);
                // $this->load->view('auth/cek-email');
                $this->load->view('auth/templates/main_end');
            } else {
                redirect('');
            }
        }
    }

    protected function login(string $email, string $password): ?object
    {
        $this->db->select('id_pengguna, nama, email, kategori, status, token, is_active, foto, jenis_perusahaan, ');
        $this->db->from('pengguna');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get();
        return $query->row();
    }

    public function aksi_login()
    {
        $this->load->model('Preferensi_model');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email', [
            'required' => 'Email tidak boleh kosong!',
        ]);
        $this->form_validation->set_rules('password', 'kata sandi', 'required|trim|min_length[6]', [
            'required' => 'Kata sandi tidak boleh kosong!',
            'min_length' => 'Kata sandi minimal 6 karakter!',
        ]);

        $checkoutUrl = $this->session->userdata('checkout_url');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if ($this->form_validation->run() == false) {
            return $this->index();
        } else {
            try {
                $user = $this->login($email, md5($password));
                if ($user == null) {
                    $this->session->set_flashdata('error', 'Email atau password salah!');
                    return $this->index();
                    exit();
                }

                if ($user->is_active == 0) {
                    $this->session->set_flashdata('warning', 'Akun Anda belum aktif.<br>Silakan cek email Anda untuk proses aktivasi!<br>Belum menerima email?<a href="' . base_url('send/verify/') . $email . '" class="link-email">Kirim ulang</a>');
                    redirect('login');
                } else {
                    // Cek user type (free, trial, premium) dan update status jika user free dan trial habis.
                    // set status ke session.
                    $userId = $user->id_pengguna;
                    $userCat = $user->kategori;
                    $userSts = $user->status;
                    $companyType = (int) $user->jenis_perusahaan;
                    $userStatus = 0;
                    if ((int) $userCat != UserCategory::ADMIN) {
                        $userStatus = $this->updateUserType($userSts, (int) $userId);
                    }
                    
                    set_cookie('id_pengguna', $userId, time()+86400);

                    $data_session = [
                        'id_pengguna' => $userId,
                        'nama' => $user->nama,
                        'email' => $user->email,
                        'kategori' => $userCat,
                        'status' => $userStatus,
                        'is_active' => $user->is_active,
                        'photo' => $user->foto,
                        'jenis_perusahaan' => $companyType,
                        'wa_status' => $user->wa_status,
                        'lengkap' => $this->isProfileComplete((int) $userId) ? '1' : '0',
                    ];

                    $userPref = null;
                    if ($this->session->userdata('user_preferensi') == null) {
                        $userPref = $this->Preferensi_model->getPreferensiByUserId((int) $data_session['id_pengguna']);
                        $this->session->set_userdata('user_preferensi', $userPref);
                    }

                    $this->session->set_userdata('user_data', $data_session);
                    if ($companyType == 0 && $userCat != 4) {
                        redirect('profile');
                    }

                    if ($checkoutUrl) {
                        $this->session->unset_userdata('checkout_url');
                        redirect($checkoutUrl);
                    } else {
                        if ($userCat == UserCategory::ADMIN) {
                            redirect('tender');
                        } elseif ($userCat == UserCategory::SRV_PROVIDER) {
                            redirect('user-dashboard');
                        } elseif ($userCat == UserCategory::ASSOCIATION) {
                            redirect('asosiasi');
                        } elseif ($userCat == UserCategory::SUPPLIER) {
                            redirect('suplier');
                        } else {
                            echo 'Not found!';
                        }
                    }
                }
            } catch (ClientException $e) {
                $data = json_decode($e->getResponse()->getBody()->getContents());
                $message = $data->message;
                $this->session->set_flashdata('error', $message);
                return $this->index();
            }
        }
    }

    /**
     * Setelah login user akan dicek tipenya, jika trial masih berlaku akan diupdatekan ke kolom status agar statusnya seragam.
     */
    protected function updateUserType($userStatus, int $userId = 0)
    {
        $duration = 0;
        // Jika tipe user trial (brarti sudah menggunakan tipe 2) maka diupdate statusnya.
        if ((int) $userStatus == UserType::TRIAL) {
            $duration = $this->getUserDuration($userId);
            if ($duration == 0) {
                $this->db->where('id_pengguna', $userId)->set('status', sprintf('%d', UserType::FREE))->update('pengguna');
                $error = $this->db->error();
                ['code' => $code, 'message' => $msg] = $error;
                if ($code == 0) {
                    return UserType::FREE;
                }
            } else {
                return UserType::TRIAL;
            }
        } elseif ((int) $userStatus == UserType::FREE) {
            $duration = $this->getUserDuration($userId);
            if ($duration > 0) {
                $this->db->where('id_pengguna', $userId)->set('status', sprintf('%d', UserType::TRIAL))->update('pengguna');
                return UserType::TRIAL;
            } else {
                return UserType::FREE;
            }
        }
        return (int) $userStatus;
    }

    public function aksi_logout()
    {
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('checkout_url');
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('user_preferensi');
        delete_cookie('id_pengguna');
        
        redirect('');
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

    public function aksiSso()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[pengguna.email]', [
            'is_unique' => 'Email sudah terdaftar!',
        ]);
        $this->form_validation->set_rules('kategori', 'role', 'required|trim|in_list[2,3,4]', [
            'required' => 'Pilih salah satu role!',
            'in_list' => 'Jangan mengubah apapun!',
        ]);
        if ($this->form_validation->run() == false) {
            return $this->chooseRoles([
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
            ]);
        } else {
            $response = $this->client->request(
                'POST',
                'pengguna/create',
                $params = [
                    'form_params' => [
                        'nama' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                        'password' => md5(random_string('alnum', 8)),
                        'kategori' => $this->input->post('kategori'),
                        'is_active' => 1,
                        'status' => sprintf('%s', UserType::TRIAL),
                    ],
                    'auth' => $this->client->getConfig('headers')['auth'],
                ]
            );
            
            $userId = json_decode($response->getBody()->getContents(), true)['data']['id_pengguna'];
            set_cookie('id_pengguna', $userId, time()+86400);
            
            $data_session = [
                'id_pengguna' => $userId,
                'nama' => $params['form_params']['nama'],
                'email' => $params['form_params']['email'],
                'npwp' => null,
                'kategori' => $params['form_params']['kategori'],
                'status' => $params['form_params']['status'],
                'is_active' => 1,
                'wa_status' => '0',
                'lengkap' => $this->isProfileComplete((int) $userId) ? '1' : '0',
            ];
            $this->session->set_userdata('user_data', $data_session);
            redirect('lengkapi-profile');
            // if ($data_session['kategori'] == 1) {
            // 	redirect('tender');
            // } else if ($data_session['kategori'] == 2) {
            // 	redirect('user-dashboard');
            // } else if ($data_session['kategori'] == 3) {
            // 	redirect('asosiasi');
            // } else if ($data_session['kategori'] == 4) {
            // 	redirect('supplier');
            // } else {
            // 	echo 'Not Found';
            // }
        }
    }
    public function roles()
    {
        $this->load->view('auth/templates/main_head');
        $this->load->view('auth/choose');
        $this->load->view('auth/templates/main_end');
    }
}
