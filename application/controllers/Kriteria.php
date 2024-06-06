<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class Kriteria extends CI_Controller
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
        $this->load->model('Kriteria_model');
        $this->init();
    }

    public function getKriteria()
    {
        $data = $this->Kriteria_model->get_criteria(); // Mengambil data kriteria dari model
        $json_data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json_data);
    }

    public function add_kriteria()
    {
        $kriteria = $this->input->post('kriteria');
        $bobot = $this->input->post('bobot');

        // Debugging: Cek nilai input
        echo "Nama Kriteria: " . $kriteria . "<br>";
        echo "Bobot: " . $bobot . "<br>";

        $data = [
            'kriteria' => $kriteria,
            'bobot' => $bobot
        ];

        // Debugging: Cek data array
        echo "<pre>";
        print_r($data);
        echo "</pre>";

        if ($this->Kriteria_model->add_criteria($data)) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to add criteria.']);
        }
    }

    public function updateKriteria($id)
    {
        // Mengambil data dari formulir
        $kriteria = $this->input->post('kriteria');
        $bobot = $this->input->post('bobot');

        $data = array(
            'nama' => $kriteria,
            'bobot' => $bobot
        );

        $this->Kriteria_model->updateKriteria($id, $data); // Panggil method updateKriteria pada model

        // Redirect atau tampilkan pesan sukses
        redirect('suplier/spk');
    }

    public function delete_kriteria($id)
    {
        $this->Kriteria_model->delete_kriteria($id); // Panggil method hapusKriteria pada model

        // Redirect atau tampilkan pesan sukses
        redirect('suplier/spk');
    }
}
