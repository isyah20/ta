<?php

defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class Pengguna_model extends CI_Model
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function getAllPengguna()
    {
        $data = $this->client->request('GET', 'pengguna', $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getPenggunaById($id)
    {
        $data = $this->client->request('GET', "pengguna/$id", $this->client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }
    
    public function getProfilPengguna($id)
    {
        return $this->db->where('id_pengguna',$id)
                        ->get('pengguna');
    }
    
    public function getStatusPengguna($id)
    {
        return $this->db->select('status')->where('id_pengguna',$id)
                        ->get('pengguna');
    }
    
    public function getVerifikasiWA($no_wa)
    {
        return $this->db->select('otp,whatsapp_status,tgl_update')->where('no_telp',$no_wa)
                        ->order_by('whatsapp_status','desc')
                        ->get('pengguna');
    }
    
    public function simpanOTP($id_pengguna,$no_wa,$otp)
    {
        return $this->db->query("UPDATE pengguna SET no_telp='{$no_wa}',otp='{$otp}',tgl_update=CURRENT_TIMESTAMP WHERE id_pengguna={$id_pengguna}");
    }
    
    public function simpanVerifikasiWA($id_pengguna)
    {
        return $this->db->query("UPDATE pengguna SET otp='',whatsapp_status='1',tgl_update=CURRENT_TIMESTAMP WHERE id_pengguna={$id_pengguna}");
    }
    
    public function getPenggunaExpiredTrial()
    {
        return $this->db->query("SELECT notifikasi_tender.id_pengguna,nama,no_telp,email
                                 FROM notifikasi_tender,pengguna
                                 WHERE pengguna.id_pengguna=notifikasi_tender.id_pengguna AND status=2 AND DATEDIFF(CURRENT_TIMESTAMP, tgl_notifikasi) > 7
                                 GROUP BY id_pengguna");
    }
    
    public function expiredTrial($id_pengguna)
    {
        return $this->db->query("UPDATE pengguna SET pengguna.status='0',tgl_update=CURRENT_TIMESTAMP WHERE id_pengguna={$id_pengguna}");
    }

    public function tambahPengguna($data)
    {
        $data = $this->client->request('POST', 'pengguna/create', [
            'form_params' => $data,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
        // $data = json_decode($data->getBody()->getContents(), true);
        // return $data;
    }

    public function ubahPengguna($id, $data)
    {
        $data = $this->client->request('POST', "pengguna/update/$id", [
            'form_params' => $data,
            'auth' => $this->client->getConfig('headers')['auth'],
        ]);
    }

    public function hapusPengguna($id)
    {
        $data = $this->client->request('DELETE', "pengguna/delete/$id", $this->client->getConfig('headers'));
    }

    // Cek apakah profile sudah lengkap atau belum. syarat lengkap yaitu nama, jenis_perusahaan dan no_telp harus isi.
    public function isProfileComplete(int $userId = 0): bool
    {
        $query = $this->db->select('nama, jenis_perusahaan, no_telp')->from('pengguna')->where('id_pengguna', $userId)->get();
        $row = $query->row();
        if ($row == null) {
            return false;
        }

        if (trim($row->nama) == '' || $row->jenis_perusahaan == null || $row->jenis_perusahaan == 0 || $row->no_telp == '' || $row->no_telp == null) {
            return false;
        }
        return true;
    }
}
