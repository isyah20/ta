<?php

defined('BASEPATH') or exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class MidtransController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $params = ['server_key' => 'Mid-server-IyvIoqjmcD6xfhXdnzENgc8V', 'production' => true];
        // $params = array('server_key' => 'Mid-server-IyvIoqjmcD6xfhXdnzENgc8V', 'production' => true);
        $this->load->library(['midtrans', 'veritrans']);
        $this->midtrans->config($params);
        $this->veritrans->config($params);
    }

    public function GenerateSnap()
    {
        parse_str(file_get_contents('php://input'), $data);
        // $id_pengguna = get_cookie('id_pengguna');
        $transaction = [
            'order_id' => rand(),
            'gross_amount' => intval($data['total']),
        ];

        $customers = [
            'first_name' => $data['nama_pengguna'],
            'email' => $data['email'],
        ];
        $transaction_data = [
            'transaction_details' => $transaction,
            'customer_details' => $customers,
        ];
        //print_r($transaction_data);
        $snapToken = $this->midtrans->getSnapToken($transaction_data);
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($snapToken, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }
}
