<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;
use App\components\UserType;

class ApiOrder extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
    }

    // Gunakan suffix _get untuk menggunakan request GET
    // Periksa tanggal berakhir paket dan update status order jadi 0 dan user status jadi 0.
    public function checkDueDate_get()
    {
        $resp = ['error' => 0, 'message' => 'User telah disesuaikan statusnya berdasar tanggal berakhirnya paket.'];
        $resp['data'] = $this->checkDueDate();
        $this->response($resp, RestController::HTTP_OK);
        exit();
    }

    protected function checkDueDate()
    {
        $query = $this->db->select('id_pengguna, id_order, DATE(tgl_berakhir) AS due_date')->from('order')->where('status', '1')->get();
        $rows = $query->result();
        $cntSuccess = 0;
        $cntFail = 0;
        $now = new \DateTime(date('Y-m-d'));
        foreach ($rows as $val) {
            $dueDate = new \DateTime($val->due_date);
            if (!($dueDate < $now)) {
                continue;
            }

            $resp = $this->updateStatusUser($val->id_pengguna, $val->id_order);
            if ($resp['error_code'] == 0) {
                $cntSuccess++;
            } else {
                $cntFail++;
            }
        }
        return sprintf('Status user dan order telah diupdate [%d sukses, %d gagal].', $cntSuccess, $cntFail);
    }

    protected function updateStatusUser(int $userId = 0, string $orderId)
    {
        $result = ['error_code' => 0, 'message' => '', 'errors' => []];
        $status = sprintf('%d', UserType::FREE);
        $erros = [];
        $this->db->where('id_pengguna', $userId)->set('status', $status)->update('pengguna');
        $error = $this->db->error();
        if ((int) $error['code'] != 0) {
            $result['error_code'] = 1;
            $erros[] = $error['message'];
            log_message('error', sprintf('Update status user dengan id %d gagal: %s', $userId, $error['message']));
        }

        $this->db->where('id_order', $orderId)->set('status', '0')->update('order');
        $error = $this->db->error();
        if ((int) $error['code'] != 0) {
            $result['error_code'] = 1;
            $erros[] = $error['message'];
            log_message('error', sprintf('Update status order dengan id %s gagal: %s', $orderId, $error['message']));
        }

        return $result;
    }
}
