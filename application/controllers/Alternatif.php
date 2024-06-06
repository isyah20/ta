<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class Alternatif extends CI_Controller
{
    use ClientApi;

    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('user_data') && $this->session->userdata('user_data')['kategori'] != 4) {
        if (!get_cookie('id_pengguna')) {
            redirect('login');
        }

        // $this->load->library('input');
        $this->load->model('Alternatif_model');
        $this->init();
    }

    public function getAlternatif()
    {
        $data = $this->Alternatif_model->get_alternatives(); // Mengambil data kriteria dari model
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }

    public function add_alternatif()
    {
        $nama_perusahaan = $this->input->post('nama_perusahaan');
        $riwayat_perusahaan = $this->input->post('riwayat_perusahaan');
        $riwayat_menang = $this->input->post('riwayat_menang');
        $lokasi_tender = $this->input->post('lokasi_tender');
        $nilai_hps = $this->input->post('nilai_hps');

        // Debugging: Cek nilai input
        echo "Nama Perusahaan: " . $nama_perusahaan . "<br>";
        echo "Riwayat Perusahaan: " . $riwayat_perusahaan . "<br>";
        echo "Riwayat Menang: " . $riwayat_menang . "<br>";
        echo "Lokasi Tender: " . $lokasi_tender . "<br>";
        echo "Nilai HPS: " . $nilai_hps . "<br>";

        $data = [
            'nama_perusahaan' => $nama_perusahaan,
            'riwayat_perusahaan' => $riwayat_perusahaan,
            'riwayat_menang' => $riwayat_menang,
            'lokasi_tender' => $lokasi_tender,
            'nilai_hps' => $nilai_hps
        ];

        // Debugging: Cek data array
        echo "<pre>";
        print_r($data);
        echo "</pre>";

        if ($this->Alternatif_model->add_alternatif($data)) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to add alternatif.']);
        }
        /* // Fetch current kriteria count from the database
        $this->load->model('Alternatif_model');
        $currentAlternatifCount = $this->Alternatif_model->get_alternatives();

        if ($currentAlternatifCount >= 3) {
            // Return error response if kriteria count exceeds the limit
            $response = array('message' => 'Jumlah kriteria tidak boleh lebih dari 3');
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode($response));
            return;
        } */
    }

}
