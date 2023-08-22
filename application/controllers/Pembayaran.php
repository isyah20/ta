<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Midtrans\Config;
use Midtrans\Notification;
use App\components\UserType;

class Pembayaran extends CI_Controller
{
    use \App\components\traits\FileSystem;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Promo_model');
        $this->load->model('PaketPembelian_model');
        $this->load->model('Pembayaran_model');
        $this->load->model('Order_model');
        $this->load->model('api/Pengguna_model', 'Pengguna_model');
    }

    public function cekpromo($data)
    {
        // 		parse_str(file_get_contents('php://input'), $data);
        $response = $this->Promo_model->getData($data)->row();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    public function ceknpwp()
    {
        if (!$this->session->userdata('user_data')) {
            redirect('login');
        }

        $response = $this->Pengguna_model->getnpwp($this->session->user_data['id_pengguna'])->row();

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    public function updateProfil($id)
    {
        if (!$this->session->userdata('user_data')) {
            redirect('login');
        }
        // parse_str(file_get_contents('php://input'), $data);
        // $data['id_pengguna'] = $this->session->user_data['id_pengguna'];

        $response = $this->Pengguna_model->updateProfil($data);

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    public function paketPembelian()
    {
        $paket = $this->PaketPembelian_model->getAllData();
        $responseData = [
            'message' => 'Success',
            'data' => $paket,
        ];

        $jsonResponse = json_encode($responseData);
        echo $jsonResponse;
    }

    public function create()
    {
        if (!$this->session->userdata('user_data')) {
            redirect('login');
        }
        parse_str(file_get_contents('php://input'), $data);
        $result = json_decode($data['result']);
        $detail_order = json_decode($data['detail_order']);
        // $dueDate = date('Y-m-d', strtotime('+'.$data["durasi_bulan"].' months', strtotime(date('Y-m-d'))));
        // $params = [
        //     'purchaseDate' => (new \DateTime('now'))->format('d F Y'),
        //     'dueDate' => $dueDate,
        //     'name' => '',
        //     'totalPayment' => 0,
        //     'payBeforeData' => '10-10-2023',
        //     'bankName' => '',
        //     'vaNumber' => '',
        //     'paymentInstructionUrl' => '',
        //     'srvProviderCode' => '',
        //     'paymentCode' => '',
        // ];

        $data_order = [
            "id_order" => $result->order_id,
            // "durasi" => $data["durasi_bulan"],
            "id_pengguna" => $this->session->user_data['id_pengguna'],
            "ppn" => $data["ppn"],
            "diskon" => $data["diskon"],
            "total_harga" => $data["total"],
            "kode_promo" => $data["kode_promo"],
            "status" => '0',
            "tgl_berakhir" => date('Y-m-d', strtotime('+' . $data["durasi_bulan"] . ' months', strtotime(date('Y-m-d')))),
            "tgl_order" => date('Y-m-d'),
        ];

        $data_detail = [];
        for ($i = 0; $i < count($detail_order); $i++) {
            $data_detail[] = [
                'id_order' => $result->order_id,
                'id_paket_pembelian' => $detail_order[$i],
            ];
        }

        $data_pembayaran = [
            "snap_token" => $data["token"],
            "id_order" => $result->order_id,
            "total_bayar" => $data["total"],
            "jenis_pembayaran" => $result->payment_type,
            "kode_status" => $result->status_code,
            "url_slip" => $result->pdf_url,
            "status_pesan" => $result->transaction_status,
            "transaction_id" => $result->transaction_id,
            "tgl_pembayaran" => date('Y-m-d H:i:s'),
        ];

        if ($result->payment_type == 'bank_transfer') {
            // bca, bni, bri
            if (isset($result->va_numbers)) {
                $data_pembayaran += [
                    'bank' => $result->va_numbers[0]->bank,
                    'nomor_va' => $result->va_numbers[0]->va_number,
                ];
            } else {
                // permata
                $data_pembayaran += [
                    'bank' => 'permata',
                    'nomor_va' => $result->permata_va_number,
                ];
            }
        } elseif ($result->payment_type == 'echannel') {
            // mandiri
            $data_pembayaran += [
                'bank' => 'mandiri',
                'bill_key' => $result->bill_key,
                'biller_code' => $result->biller_code,
            ];
        } elseif ($result->payment_type == 'qris') {
            $data_pembayaran += [
                'bank' => $result->acquirer,
            ];
            $data_pembayaran["url_slip"] = $result->action[0]->url;
        } elseif ($result->payment_type == 'gopay') {
            $data_pembayaran += [
                'bank' => $result->payment_type,
            ];
            $data_pembayaran["url_slip"] = $result->action[0]->url;
        }

        if ($result->status_code == '200') {
            $data_order["status"] = '1';
            if ($data["kode_promo"] != '' || $data["kode_promo"] != null) {
                $this->Promo_model->updateKuota($data["kode_promo"]);
            }
        }

        // $this->sendEmailTagihanPembayaran($params);
        $this->Pembayaran_model->insert($data_pembayaran);
        $error = $this->Order_model->insert($data_order);
        ['code' => $code, 'message' => $message] = $error;
        if ((int) $code != 0) {
            log_message('error', $message);
        }

        $error = $this->Order_model->insert_detail($data_detail);
        ['code' => $code, 'message' => $message] = $error;
        if ((int) $code != 0) {
            log_message('error', $message);
        }
    }

    public function sendEmailTagihanPembayaran(array $data = [])
    {
        $this->load->library('email');
        $config = [];
        $config['charset'] = 'utf-8';
        $config['useragent'] = 'Codeigniter';
        $config['protocol'] = "smtp";
        $config['mailtype'] = "html";
        $config['smtp_host'] = "srv42.niagahoster.com"; //pengaturan smtp
        $config['smtp_port'] = "465";
        $config['smtp_timeout'] = "60";
        $config['smtp_user'] = "payment@tenderplus.id"; // isi dengan email
        $config['smtp_pass'] = "C%87SfcjjaHb*te"; // isi dengan password
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['smtp_crypto'] = "ssl"; //pengaturan smtp
        $config['wordwrap'] = true;

        $this->email->initialize($config);
        //konfigurasi pengiriman
        $this->email->from('support@tenderplus.id', 'Tender Plus');
        $this->email->to($this->input->post('email'));
        $this->email->subject("Tagihan Akun Premium");
        $message = $this->load->view('payment/email-tagihan', $data, true);
        if (isDev()) {
            $filename = sprintf('email-tagihan-%s-%s.html', $this->sanitizeFileName($data['email'], true, false, ['-', '@', '.']), date('Ymd-His'));
            file_put_contents(sprintf('%s/temp/email/%s', FCPATH, $filename), $message);
            return true;
        }
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        }
        return false;
    }

    public function checkOrder($id)
    {
        parse_str(file_get_contents('php://input'), $data);
        $this->form_validation->set_rules('list_pkg_id[]', 'Paket Id', 'required');
        $this->form_validation->set_data($data);
        $this->output->set_content_type('application/json');
        if ($this->form_validation->run() == false) {
            $this->output->set_status_header(422);
            $result = $this->form_validation->error_array();
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        }

        $params = [];
        $query = $this->db->select('o.id_order, o.id_pengguna, od.id_paket_pembelian, pb.status_pesan')
            ->from('order AS o')
            ->join('order_detail AS od', 'o.id_order = od.id_order', 'left')
            ->join('pembayaran AS pb', 'o.id_order = pb.id_order', 'left')
            ->where('o.id_pengguna', $id)
            ->where('pb.status_pesan', 'pending')
            ->get();
        $rows = $query->result_array();
        // foreach ($rows as $val) {
        //     $this->groupOrders($params, $val);
        // }
        //
        $result = ['error_code' => 0, 'message' => 'Tidak ada pesanan dengan paket yang sama'];
        // $find = array_filter($params, fn($item) => $item['pkg_id'] == $data['list_pkg_id']);
        $this->output->set_content_type('application/json');
        if (count($rows) > 0) {
            $result['error_code'] = 1;
            $result['message'] = 'Terdapat pesanan dengan paket yang sama masih pending.';
            $this->output->set_status_header(500);
            echo json_encode($result, JSON_NUMERIC_CHECK);
            exit();
        }

        $this->output->set_status_header(200);
        echo json_encode($result, JSON_NUMERIC_CHECK);
        exit();
    }

    protected function groupOrders(array &$params, array $order = [])
    {
        if (empty($params)) {
            $params[] = ['order_id' => $order['id_order'], 'user_id' => $order['id_pengguna'], 'pkg_id' => [$order['id_paket_pembelian']]];
        } else {
            $row = array_filter($params, fn ($item) => $item['order_id'] == $order['id_order'] && $item['user_id'] == $order['id_pengguna']);
            if (empty($row)) {
                $params[] = ['order_id' => $order['id_order'], 'user_id' => $order['id_pengguna'], 'pkg_id' => [$order['id_paket_pembelian']]];
            } else {
                [$keys] = array_keys($row);
                $data = $row[$keys];
                $listPkgId = $data['pkg_id'];
                $listPkgId[] = $order['id_paket_pembelian'];
                $data['pkg_id'] = $listPkgId;
                $index = null;
                foreach ($params as $paramIndex => $item) {
                    ['order_id' => $orderId, 'user_id' => $userId, 'pkg_id' => $pkgId] = $item;
                    if ($orderId == $data['order_id'] && $userId == $data['user_id']) {
                        $index = $paramIndex;
                        break;
                    }
                }

                if ($index != null) {
                    $params[$index] = $data;
                }
            }
        }
    }

    // Callback untuk midtrans
    // https://github.com/Midtrans/midtrans-php/blob/master/examples/notification-handler.php
    // https://docs.midtrans.com/docs/https-notification-webhooks
    public function notification()
    {
        Config::$isProduction = true;
        Config::$serverKey = $_SERVER['MIDTRANS_SERVER_KEY'];

        $notif = null;
        try {
            $notif = new Notification();
        } catch (\Exception $ex) {
            exit($ex->getMessage());
        }

        // TODO: handle duplikasi order_id
        $resp = $notif->getResponse();
        $transaction = $resp->transaction_status;
        $paymentType = $resp->payment_type;
        $orderId = $resp->order_id;
        $fraud = $resp->fraud_status;
        log_message('error', print_r($resp, true));
        $data = [
            'order_id' => $resp->order_id,
            'transaction_id' => $resp->transaction_id,
            'status_code' => $resp->status_code,
            'transaction_status' => $transaction,
        ];

        if ($transaction == 'capture') {
            if ($paymentType == 'credit_card') {
                if ($fraud == 'challenge') {
                } else {
                    $this->updatePayment($data, true);
                }
            }
        } elseif ($transaction == 'settlement') {
            $this->updatePayment($data, true);
        } elseif ($transaction == 'pending') {
            $this->updatePayment($data);
        } elseif ($transaction == 'deny') {
            $this->updatePayment($data);
        } elseif ($transaction == 'expire') {
            $this->updatePayment($data);
        } elseif ($transaction == 'cancel') {
            $this->updatePayment($data);
        }
    }

    protected function updatePayment(array $data = [], bool $upgradeToPremium = false)
    {
        $this->db->where('id_order', $data['order_id'])
            ->where('transaction_id', $data['transaction_id'])
            ->set(['status_pesan' => $data['transaction_status'], 'kode_status' => $data['status_code']])
            ->update('pembayaran');
        $error = $this->db->error();
        if ((int) $error['code'] != 0) {
            log_message('error', $error['message']);
            return;
        }

        if (!$upgradeToPremium) {
            return;
        }

        $query = $this->db->select('id_pengguna')->from('order')->where('id_order', $data['order_id'])->get();
        $row = $query->row();
        if ($row == null) {
            return;
        }

        $this->db->where('id_order', $data['order_id'])->set('status', '1')->update('order');
        $error = $this->db->error();
        ['code' => $code, 'message' => $msg] = $error;
        if ((int) $code != 0) {
            log_message('error', 'Update status order ke 1 gagal: ' . $msg);
        }

        $this->upgradeUserToPremium((int) $row->id_pengguna);
    }

    protected function upgradeUserToPremium(int $userId = 0)
    {
        if ($userId <= 0) {
            return false;
        }
        $userPaid = sprintf('%s', UserType::PAID);
        $this->db->set('status', $userPaid)->where('id_pengguna', $userId)->update('pengguna');
        $error = $this->db->error();
        ['code' => $code, 'message' => $msg] = $error;
        if ((int) $code != 0) {
            log_message('error', 'Upgrad user ke premium gagal: ' . $msg);
        }

        return $code == 0;
    }
}
