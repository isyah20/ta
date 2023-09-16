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
        $id_pengguna = $this->get('id');
        $email = $this->get('email');


        if (isset($id_pengguna)) {
            $resultPengguna = $this->Pengguna_model->getPenggunaById($id_pengguna);
        } else if (isset($email)) {
            $resultPengguna = $this->Pengguna_model->getByEmail($email);
        } else {
            $resultPengguna = $this->Pengguna_model->getAllPengguna();
        }

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
                'token' => random_string('alnum', 25),
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

    public function update_post($id_pengguna)
    {
        $compType = $this->post('jenis_perusahaan');
        if ($compType == null || (int) $compType < 1) {
            $compType = 2;
        }

        $data_new = [
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'alamat' => $this->post('alamat'),
            'npwp' => $this->post('npwp'),
            'no_telp' => $this->post('no_telp'),
            'tgl_update' => date('Y-m-d H:i:s'),
            'jenis_perusahaan' => $compType,
        ];

        $checkPengguna = $this->Pengguna_model->getPenggunaById($id_pengguna);
        if (null == $checkPengguna) {
            $this->response([
                'status' => true,
                'message' => "Pengguna tidak ditemukan!",
            ], RestController::HTTP_NOT_FOUND);
        }

        $resultPengguna = $this->Pengguna_model->ubahPengguna($id_pengguna, $data_new);
        if ($resultPengguna) {
            $this->response([
                'status' => true,
                'message' => 'Pengguna berhasil diupdate!',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal mengupdate data!',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function destroy_delete($id_pengguna)
    {
        $resultPengguna = $this->Pengguna_model->hapusPengguna($id_pengguna);

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
