<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Exception\ClientException;
use App\components\traits\FileSystem;
// use App\components\traits\ClientApi;
// use App\components\traits\User;
// use App\components\UserCategory;

class ProfilePengguna extends CI_Controller 
{
    use FileSystem;
    // use ClientApi;
    // use User;

    public function __construct()
    {
        parent::__construct();
        if (!get_cookie('id_pengguna')) redirect('login');
        
        $this->load->model('api/Pengguna_model');
        $this->load->model('WilayahModel');
    }

    public function index()
    {
        /*$this->load->library('user');
        $userData = $this->session->user_data;
        $userId = (int) $this->session->user_data['id_pengguna'];
        $userCat = (int) $this->session->user_data['kategori'];
        // $this->form_validation->set_rules('npwp', 'npwp', 'required|min_length[20]|max_length[20]', [
        //     'required' => 'NPWP harus diisi',
        //     'numeric' => 'Pastikan NPWP anda benar',
        // ]);
        $companyType = $this->input->post('jenis_perusahaan');
        $companyType = $companyType == null ? 0 : (int) $companyType;
        $pass = $this->input->post('password');
        $passConfirm = $this->input->post('password_confirm');
        $changePassword = false;
        $this->form_validation->set_rules('no_telp', 'no_telp', 'required|trim|regex_match[([0-9])]', [
            'required' => 'No Whatsapp harus diisi',
            'regex_match' => 'No Whatsapp harus berupa angka',
        ]);

        if ($userCat != UserCategory::SUPPLIER) {
            $this->form_validation->set_rules('jenis_perusahaan', 'jenis_perusahaan', 'required|trim|greater_than[0]|less_than[4]|numeric', [
                'required' => 'Jenis Perusahaan harus diisi',
                'greater_than' => 'Jenis Perusahaan wajib dipilih!.',
                'less_than' => 'Jenis Perusahaan harus kurang dari 4',
                'numeric' => 'Jenis Perusahaan harus berupa angka',
            ]);
        }

        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim|min_length[1]', [
            'required' => (in_array((int) $companyType, [1, 3]) ? 'Alamat Perusahaan ' : 'Alamat ') . ' harus diisi',
        ]);
        $this->form_validation->set_rules('province', 'province', 'required|trim|min_length[1]', [
            'required' => 'Provinsi wajib dipilih',
        ]);
        $this->form_validation->set_rules('city', 'city', 'required|trim|min_length[1]', [
            'required' => 'Kota wajib dipilih',
        ]);

        if (trim($pass) != '' && trim($passConfirm) != '') {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[password_confirm]', [
                'required' => 'Kata sandi harus diisi',
                'min_length' => 'Kata sandi minimal 6 karakter',
                'matches' => 'Kata Sandi Tidak Sama',
            ]);
            $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|min_length[6]|matches[password]', [
                'required' => 'Ulangi Kata sandi harus diisi',
                'min_length' => 'Ulangi Kata sandi minimal 6 karakter',
                'matches' => 'Kata sandi Tidak Sama',
            ]);
            $changePassword = true;
        }
        $this->form_validation->set_rules('nama', 'nama', 'required|min_length[3]', [
            'required' => (in_array($companyType, [1, 3]) ? 'Nama Perusahaan' : 'Nama Lengkap') . ' harus diisi',
        ]);

        $photo = $this->user->getPhotoProfile((int) $userId, $this->db);
        if ($this->form_validation->run() == false) {
            $response = $this->client->request('GET', 'pengguna/' . $this->session->user_data['id_pengguna'], $this->client->getConfig('headers'));
            $data['pengguna'] = json_decode($response->getBody()->getContents(), true)['data'];
            $data['title'] = 'Profile Pengguna';
            $data['userId'] = $userId;
            $data['photo'] = $photo;
            $data['isVerify'] = 0;
            $data['userStatus'] = (int) $userData['status'];

            if ($this->input->is_ajax_request()) {
                $this->output->set_content_type('application/json')
                    ->set_status_header(422)
                    ->set_output(json_encode($this->form_validation->error_array()))
                    ->_display();
                exit();
            }

            $this->load->view('templates/header', $data);
            $this->load->view('profile_pengguna/templates/navbar', $data);
            $this->load->view('profile_pengguna/index', $data);
            $this->load->view('templates/footer');
        } else {
            $result = ['error' => 0, 'message' => 'Profile sukses diperbarui.', 'url' => ''];
            $no_wa = substr($this->input->post('no_telp'), 0, 1) == '0' ? '62' . substr($this->input->post('no_telp'), 1, strlen($this->input->post('no_telp')) - 1) : $this->input->post('no_telp');
            $address = sprintf('%s, %s, %s', $this->input->post('alamat'), $this->input->post('city'), $this->input->post('province'));
            $data = [
                'nama' => $this->input->post('nama'),
                'no_telp' => $no_wa,
                'alamat' => $address,
            ];
            if ($userCat != UserCategory::SUPPLIER) {
                $data['jenis_perusahaan'] = $companyType;
            }
            if ($changePassword) {
                $data['password'] = $this->input->post('password');
            }

            if ($companyType != '0') $redirectUrl = 'user-dashboard';
            else $redirectUrl = 'suplier';

            try {
                $response = $this->client->request('POST', 'pengguna/update/' . $this->session->user_data['id_pengguna'], [
                    'form_params' => $data,
                    'auth' => $this->client->getConfig('headers')['auth'],
                ]);
                $result['url'] = $redirectUrl;
                $this->updateSession($userId);
            } catch (ClientException $e) {
                $data = json_decode($e->getResponse()->getBody()->getContents());
                $message = $data->message;
                $this->session->set_flashdata('error', $message);
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                $result['url'] = $redirectUrl;
                $result['error'] = 1;
                $result['message'] = $message;
            }

            if ($this->input->is_ajax_request()) {
                $statusCode = $result['error'] == 1 ? 500 : 200;
                $this->output->set_content_type('application/json')
                    ->set_status_header($statusCode)
                    ->set_output(json_encode($result))
                    ->_display();
                exit();
            }
            redirect($redirectUrl);
        }*/
        
        $data = [
            'title' => 'Profil Pengguna'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar');
        $this->load->view('profile_pengguna/index');
        $this->load->view('templates/footer');
    }
    
    public function ubahProfil()
    {
        parse_str(file_get_contents('php://input'), $data);
        
        $id_pengguna = get_cookie('id_pengguna');
        
        $jenis_perusahaan = $data['kategori'] == '2' ? $data['jenis_perusahaan'] : '0';
        
        $kabupaten = $this->WilayahModel->getWilayahByKode($data['kabupaten'])->row();
        $provinsi = $this->WilayahModel->getWilayahByKode($data['provinsi'])->row();
        $alamat = sprintf('%s, %s, %s', $data['alamat'], $kabupaten->wilayah, $provinsi->wilayah);
        
        $pengguna = $this->db->query("SELECT password FROM pengguna WHERE id_pengguna={$id_pengguna}")->row();
        if ($pengguna->password != $data['password']) $password = md5($data['password']);
        else $password = $data['password'];
        
        $param = [
            "nama" => $data['nama'],
            "jenis_perusahaan" => $jenis_perusahaan,
            "npwp" => $data['npwp'],
            "alamat" => $alamat,
            "no_telp" => $data['no_telp'],
            "password" => $password,
            "foto" => '',
            "tgl_update" => date('Y-m-d H:i:s')
        ];
            
        $this->db->where('id_pengguna', $id_pengguna)
                 ->update('pengguna', $param);
                 
        $response = array(
	        'Success' => true,
	        'Info' => 'Profil pengguna berhasil diperbaharui.',
	    );

	    $this->output
	         ->set_status_header(200)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
    }

    public function updateSession(int $userId)
    {
        $query = $this->db->select('id_pengguna, nama, email, kategori, status, is_active, foto, jenis_perusahaan, whatsapp_status as wa_status')
            ->from('pengguna')->where('id_pengguna', $userId)->get();
        $row = $query->result_array();
        if (is_array($row) && empty($row)) {
            return;
        }

        $row = $row[0];
        $row['lengkap'] = $this->isProfileComplete($userId) ? '1' : '0';
        $this->session->set_userdata('user_data', $row);
    }

    public function ubah()
    {
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[password_confirm]', [
            'required' => 'Kata sandi harus diisi',
            'min_length' => 'Kata sandi minimal 6 karakter',
            'matches' => 'Kata Sandi Tidak Sama',
        ]);
        // var_dump($this->input->post('password'));
        // die;
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|min_length[6]|matches[password]', [
            'required' => 'Tulis Ulangi Kata sandi harus diisi',
            'matches' => 'Kata Sandi Tidak Sama',
        ]);

        if ($this->form_validation->run() == false) {
            // $response = $this->client->request('GET', 'pengguna/' . $this->session->user_data['id_pengguna'], $this->client->getConfig('headers'));
            // $data['pengguna'] = json_decode($response->getBody()->getContents(), true)['data'];
            // $data['title'] = 'Profile Pengguna';

            // $this->load->view('templates/header', $data);
            // $this->load->view('profile_pengguna/templates/navbar');
            // $this->load->view('profile_pengguna/index', $data);
            // $this->load->view('profile_pengguna/templates/footer');
            redirect('profile?pesan=gagal');
        } else {
            $data = [
                // 'nama' => $this->input->post('nama'),
                // 'no_telp' => $this->input->post('no_telp'),
                // 'alamat' => $this->input->post('alamat'),
                // 'npwp' => $this->input->post('npwp'),
                'password' => $this->input->post('password'),
                // 'is_active' => 1,
            ];
            try {
                $response = $this->client->request('POST', 'pengguna/update/' . $this->session->user_data['id_pengguna'], [
                    'form_params' => $data,
                    'auth' => $this->client->getConfig('headers')['auth'],
                ]);
                redirect('profile?pesan=berhasil');
            } catch (ClientException $e) {
                $data = json_decode($e->getResponse()->getBody()->getContents());
                $message = $data->message;
                $this->session->set_flashdata('error', $message);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function changePassword($id)
    {
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[password_confirm]', [
            'required' => 'Kata sandi harus diisi',
            'min_length' => 'Kata sandi minimal 6 karakter',
            'matches' => 'Kata Sandi Tidak Sama',
        ]);
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|min_length[6]|matches[password]', [
            'required' => 'Ulangi Kata sandi harus diisi',
            'matches' => 'Kata Sandi Tidak Sama',
        ]);
        $this->output->set_header('Content-Type: application/json');
        if ($this->form_validation->run() == false) {
            $this->output->set_status_header(422);
            echo json_encode($this->form_validation->error_array(), JSON_NUMERIC_CHECK);
            exit();
        } else {
            $password = $this->input->post('password');
            $resp = ['error' => 1, 'message' => 'Password gagal diperbarui'];
            try {
                $userId = (int) $id;
                $this->Pengguna_model->changePassword($userId, $password);
                $resp['error'] = 0;
                $resp['message'] = 'Password sukses diperbarui';
                $this->output->set_status_header(200);
            } catch (\Exception $e) {
                $resp['message'] = $e->getMessage();
                $this->output->set_status_header(400);
            }
            echo json_encode($resp, JSON_NUMERIC_CHECK);
        }
    }

    public function resizeImg(string $filename)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = sprintf('%suploads/%s', FCPATH, $filename);
        $config['maintain_ratio'] = true;
        $config['width'] = 172;
        $config['height'] = 172;

        $this->load->library('image_lib', $config);
        if (!$this->image_lib->resize()) {
            return $this->image_lib->display_errors(null, null);
        }
        return true;
    }

    public function uploadPhotoProfile($id)
    {
        $config['upload_path'] = './uploads/'; // Folder untuk menyimpan foto
        $config['allowed_types'] = 'gif|jpg|png'; // Jenis file yang diperbolehkan
        $config['max_size'] = 2048; // Ukuran maksimum file (dalam KB)
        $fileName = $_FILES['file']['name'];
        $ext = strtolower($this->extractFileExt($fileName, true));
        $fname = $this->extractFileName($fileName);
        $fileName = $this->sanitizeFileName($fname);
        $config['file_name'] = uniqid() . '-' . $fileName . "{$ext}";
        $this->load->library('upload', $config);

        $this->output->set_header('Content-Type: application/json');
        $resp = ['error' => 1, 'message' => 'Upload photo profile gagal', 'filename' => ''];
        if ($this->upload->do_upload('file')) {
            $oldPhotoProfile = $this->getOldPhoto((int) $id);
            try {
                $photoName = $config['file_name'];
                $this->resizeImg($photoName);
                $this->fs()->chmod(sprintf('%suploads/%s', FCPATH, $photoName), 0755);
                $this->output->set_status_header(200);
                $this->db->where('id_pengguna', $id)->set('foto', $photoName)->update('pengguna');
                $resp = ['error' => 0, 'message' => 'Upload photo profile sukses', 'filename' => $photoName];
                $error = $this->db->error();
                if ((int) $error['code'] === 0) {
                    $this->deleteOldPhotoProfile($oldPhotoProfile);
                }
            } catch (\Exception $e) {
                $this->output->set_status_header(400);
                $resp['message'] = $e->getMessage();
            }
        } else {
            $this->output->set_status_header(400);
            $resp['message'] = $this->upload->display_errors(null, null);
        }
        echo json_encode($resp, JSON_NUMERIC_CHECK);
    }

    public function uploadCoverProfile($id)
    {
        $config['upload_path'] = './uploads/'; // Folder untuk menyimpan foto
        $config['allowed_types'] = 'gif|jpg|png'; // Jenis file yang diperbolehkan
        $config['max_size'] = 2048; // Ukuran maksimum file (dalam KB)
        $fileName = $_FILES['file']['name'];
        $ext = strtolower($this->extractFileExt($fileName, true));
        $fname = $this->extractFileName($fileName);
        $fileName = $this->sanitizeFileName($fname) . '-cover';
        $config['file_name'] = uniqid() . '-' . $fileName . ".{$ext}";
        $this->load->library('upload', $config);

        $this->output->set_header('Content-Type: application/json');
        $resp = ['error' => 1, 'message' => 'Upload photo profile gagal', 'filename' => ''];
        if ($this->upload->do_upload('file')) {
            try {
                $photoName = $this->upload->data('file_name');
                $this->resizeImg($photoName);
                $this->output->set_status_header(200);
                $this->db->where('id_pengguna', $id)->set('foto', $photoName)->update('pengguna');
                $resp = ['error' => 0, 'message' => 'Upload photo profile sukses', 'filename' => $photoName];
            } catch (\Exception $e) {
                $this->output->set_status_header(400);
                $resp['message'] = $e->getMessage();
            }
        } else {
            $this->output->set_status_header(400);
            $resp['message'] = $this->upload->display_errors(null, null);
        }
        echo json_encode($resp, JSON_NUMERIC_CHECK);
    }

    protected function deleteOldPhotoProfile(string $filename)
    {
        if (strlen($filename) < 1) {
            return false;
        }

        $realPath = sprintf('%s/uploads/%s', FCPATH, $filename);
        if (!file_exists($realPath)) {
            return false;
        }

        try {
            $this->fs()->remove($realPath);
            return true;
        } catch (\Symfony\Component\Filesystem\Exception\IOException $ex) {
            return false;
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('npwp', 'npwp', 'required|trim|regex_match[([0-9.-])]', [
            'required' => 'NPWP harus diisi',
            'regex_match' => 'NPWP harus berupa angka atau sesuai format',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[password_confirm]', [
            'required' => 'Kata sandi harus diisi',
            'min_length' => 'Kata sandi minimal 6 karakter',
            'matches' => 'Kata Sandi Tidak Sama',
        ]);
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|min_length[6]|matches[password]', [
            'required' => 'Tulis Ulangi Kata sandi harus diisi',
            'matches' => 'Kata Sandi Tidak Sama',
        ]);
        $this->form_validation->set_rules('no_telp', 'Nomor Whatsapp', 'required|min_length[9]', [
            'required' => 'Nomor Whatsapp harus diisi',
            'min_length' => 'Nomor Whatsapp minimal 9 digit',
        ]);

        $this->output->set_header('Content-Type: application/json');
        if ($this->form_validation->run() == false) {
            $this->output->set_status_header(422);
            echo json_encode($this->form_validation->error_array(), JSON_NUMERIC_CHECK);
        } else {
            $this->output->set_status_header(200);
        }
    }

    public function updateNpwp()
    {
        if ($this->session->userdata('user_data') == null) {
            redirect('login');
        }

        $this->load->library('user');
        $userId = (int) $this->session->user_data['id_pengguna'];
        $photo = $this->user->getPhotoProfile((int) $userId, $this->db);
        $data['title'] = 'Update Npwp';
        $data['userId'] = $userId;
        $data['photo'] = $photo;
        $data['isVerify'] = 0;
        $data['userStatus'] = (int) $this->session->user_data['status'];

        if ($this->input->is_ajax_request()) {
            $npwp = $this->input->post('npwp');
            $uid = $this->input->post('user_id');
            $this->form_validation->set_rules('npwp', 'NPWP', 'required|min_length[20]|regex_match[/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}\.[0-9]{1}-[0-9]{3}\.[0-9]{3}$/]', [
                'required' => 'Npwp harus diisi',
                'min_length' => 'NPWP harus 20 karakter.',
                'regex_match' => 'NPWP tidak valid.',
            ]);
            $this->form_validation->set_rules('user_id', 'ID User', 'required|numeric');
            $this->form_validation->set_data(['npwp' => $npwp, 'user_id' => $uid]);
            $this->output->set_content_type('application/json');

            $result = ['error_code' => 0, 'message' => 'Nomor NPWP sukses diupdate.', 'errors' => []];
            if ($this->form_validation->run() == false) {
                $this->output->set_status_header(422);
                $result['error_code'] = 1;
                $result['message'] = 'Nomor NPWP tidak dapat disimpan.';
                $result['errors'] = $this->form_validation->error_array();
                echo json_encode($result, JSON_NUMERIC_CHECK);
                exit();
            } else {
                $this->db->where('id_pengguna', $uid)->set('npwp', $npwp)->update('pengguna');
                $error = $this->db->error();
                if ((int) $error['code'] != 0) {
                    $result['error_code'] = 1;
                    $result['errors'] = $error['message'];
                }
                echo json_encode($result, JSON_NUMERIC_CHECK);
            }
            exit();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('profile_pengguna/templates/navbar', $data);
        $this->load->view('profile_pengguna/npwp', $data);
        $this->load->view('templates/footer');
    }
    
    public function getWilayahByName($nama){
	    $response = $this->WilayahModel->getWilayahByName($nama)->row();

	    $this->output
	      	 ->set_status_header(200)
	      	 ->set_content_type('application/json')
	      	 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	      	 ->_display();
	    exit;
  	}

    public function getListProvinsi()
    {
        $response = array(
            "total_count" => $this->WilayahModel->getJumlahListProvinsi($this->input->get("q")),
            "results" => $this->WilayahModel->getListProvinsi(
                $this->input->get("q"),
                $this->input->get("page") * $this->input->get("page_limit"),
                $this->input->get("page_limit")
            )
        );

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    public function getListKabupaten()
    {
        $response = array(
            "total_count" => $this->WilayahModel->getJumlahListKabupaten($this->input->get("prov"), $this->input->get("q")),
            "results" => $this->WilayahModel->getListKabupaten(
                $this->input->get("prov"),
                $this->input->get("q"),
                $this->input->get("page") * $this->input->get("page_limit"),
                $this->input->get("page_limit")
            )
        );

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }
}
