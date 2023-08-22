<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'vendor/autoload.php';

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Pengguna_model');
    }

    public function getToken()
    {
        $this->output->set_header('Content-Type: application/json');
        echo json_encode([], JSON_NUMERIC_CHECK);
    }
    
    public function getProfilPengguna($id) {
        $response = $this->Pengguna_model->getProfilPengguna($id)->row();

	    $this->output
	      	 ->set_status_header(200)
	      	 ->set_content_type('application/json')
	      	 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	      	 ->_display();
	    exit;
    }
    
    public function getVerifikasiWA($no_wa) {
        $response = $this->Pengguna_model->getVerifikasiWA($no_wa)->row();

	    $this->output
	      	 ->set_status_header(200)
	      	 ->set_content_type('application/json')
	      	 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	      	 ->_display();
	    exit;
    }
    
    public function kirimOTP()
    {
        $no_wa = $this->input->post('no_wa');
        $data = $this->Pengguna_model->getVerifikasiWA($no_wa)->row();
        $time = date('Y-m-d H:i:s');
        $tgl_update = $data != null ? $data->tgl_update : $time;
        $otp_wa = $data != null ? $data->otp : '';
        $limitTime = date('Y-m-d H:i:s', strtotime($tgl_update . ' +3 minutes'));
        
        if ($otp_wa == '' || ($otp_wa != '' && $time > $limitTime)) {
            $id_pengguna = get_cookie('id_pengguna');
            $nama = $this->input->post('nama');
            $otp = strval(rand(1000, 9999));
        
            $pesan = "Halo *{$nama}*,\n\nBerikut adalah kode OTP untuk verifikasi nomor WhatsApp di akun TenderPlus Anda:\n\n*{$otp}*\n\n*) Kode OTP berlaku selama 3 menit, mohon jaga kerahasiaan kode OTP Anda!";
            
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
            
            $response = curl_exec($curl);
            $result = json_decode($response);
            if ($result->status) $this->Pengguna_model->simpanOTP($id_pengguna,$no_wa,$otp);
            curl_close($curl);
        } else $result = array('send_otp' => false);
        
        $this->output
	         ->set_status_header(200)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($result, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
    }
        
    public function verifyWA()
    {
        $no_wa = $this->input->post('no_wa');
        $otp = $this->input->post('otp');
        
        $data = $this->Pengguna_model->getVerifikasiWA($no_wa)->row();
        $time = date('Y-m-d H:i:s');
        $limitTime = date('Y-m-d H:i:s', strtotime($data->tgl_update . ' +3 minutes'));
        
        if ($data->otp == $otp && $time <= $limitTime) {
            $id_pengguna = get_cookie('id_pengguna');
            $this->Pengguna_model->simpanVerifikasiWA($id_pengguna);
            $response = array('verified' => true);
        } else $response = array('verified' => false);
        
        $this->output
	         ->set_status_header(200)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
    }
    
    public function expiredTrial()
    {
        $notifikasi = $this->Pengguna_model->getPenggunaExpiredTrial()->result();
        foreach ($notifikasi as $penerima) {
            $no_wa = substr($penerima->no_telp,0,1) == '0' ? '62'.substr($penerima->no_telp,1,strlen($penerima->no_telp)-1) : $penerima->no_telp;
            $baseUrl = base_url();
            
            $pesan = "Halo *{$penerima->nama}*,\n\nAkun Anda saat ini telah memasuki berakhirnya masa uji coba TenderPlus.\nSilakan upgrade akun Anda ke paket premium untuk tetap dapat menikmati seluruh fitur powerful yang disediakan!\n\n{$baseUrl}pricing_plan";
            
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
                                                    
            $response = curl_exec($curl);
            
            /*$data = [
                'name' => $penerima->nama,
                'count_tender' => $jum_tender->jumlah,
                'email' => $penerima->email,
                'tenders' => $tenders,
                'isUserPremium' => TRUE,
                'isUserTrial' => FALSE,
                'isUserFree' => FALSE,
                'footnoteTrial' => ''
            ];
            
            $this->sendEmail($data);*/
            
            $result = json_decode($response);
            if ($result->status) $this->Pengguna_model->expiredTrial($penerima->id_pengguna);
                                                    
            curl_close($curl);
            echo $response;
        }
    }
}
