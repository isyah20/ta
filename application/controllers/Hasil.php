<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class Hasil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!get_cookie('id_pengguna')) {
            redirect('login');
        }

        $this->load->model('Hasil_model');
    }

    public function hasil()
    {
        $data['jumlah_kriteria'] = $this->Hasil_model->getNumKriteria();
        $data['jumlah_alternatif'] = $this->Hasil_model->getNumAlternatif();
        $data['ranking'] = $this->Hasil_model->getRanking();

        redirect('dashboard/supplier/spk');
    }
    public function load_hasil()
    {
        // Ambil data dari model atau proses lainnya
        $data['jumlah_kriteria'] = $this->Hasil_model->getNumKriteria();
        $data['jumlah_alternatif'] = $this->Hasil_model->getNumAlternatif();
        $data['ranking'] = $this->Hasil_model->getRanking();
        $data['nilai'] = array();

        for ($x = 0; $x < $data['jumlah_alternatif']; $x++) {
            $data['nilai'][$x] = 0;
            for ($y = 0; $y < $data['jumlah_kriteria']; $y++) {
                $id_alternatif = $this->Hasil_model->getAlternatifId($x);
                $id_kriteria = $this->Hasil_model->getKriteriaId($y);

                $pv_alternatif = $this->Hasil_model->getAlternatifPV($id_alternatif, $id_kriteria);
                $pv_kriteria = $this->Hasil_model->getKriteriaPV($id_kriteria);

                $data['nilai'][$x] += ($pv_alternatif * $pv_kriteria);
            }
        }

        redirect('dashboard/supplier/spk');
    }
}
