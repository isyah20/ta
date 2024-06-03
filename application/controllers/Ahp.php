<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\models\Ahp_model;

class Ahp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ahp_model');
        $this->init(); 
    }
    public function my_method(){
        return true;
    }

    public function index()
    {
        $data['criteria'] = $this->Ahp_model->get_all_criteria();
        $data['alternatives'] = $this->Ahp_model->get_all_alternatives();
        $this->load->view('ahp_view', $data);
    }

    public function add_criteria()
    {
        $data = array(
            'kriteria' => $this->input->post('nama_kriteria'),
            'bobot' => $this->input->post('bobot')
        );
        $this->Ahp_model->add_criteria($data);
        redirect('ahp');
    }

    public function add_alternative()
    {
        $data = array(
            'riwayat_perusahaan' => $this->input->post('riwayat_perusahaan'),
            'riwayat_menang' => $this->input->post('riwayat_menang'),
            'lokasi_tender' => $this->input->post('lokasi_tender'),
            'nilai_hps' => $this->input->post('nilai_hps')
        );
        $this->Ahp_model->add_alternative($data);
        redirect('ahp');
    }

    public function calculate_ahp()
    {
        $criteria = $this->Ahp_model->get_all_criteria();
        $alternatives = $this->Ahp_model->get_all_alternatives();

        foreach ($alternatives as $alternative) {
            $total_score = 0;
            foreach ($criteria as $criterion) {
                $score = $this->Ahp_model->get_alternative_scores($alternative->id_alternatif, $criterion->id_kriteria)->score;
                $total_score += $score * $criterion->bobot;
            }

            $data = array(
                'id_alternatif' => $alternative->id_alternatif,
                'total_score' => $total_score,
                'calculated_at' => date('Y-m-d H:i:s')
            );
            $this->Ahp_model->add_result($data);
        }
        redirect('ahp/results');
    }
    public function get_results()
    {
        $results = $this->Ahp_model->get_results();
        echo json_encode($results);
    }

    public function view_results()
    {
        $data['results'] = $this->Ahp_model->get_results();
        $this->load->view('results_view', $data);
    }
}
// cek echo cek 


// class Ahp extends CI_Controller {

//     public function __construct() {
//         parent::__construct();
//         $this->load->model('Ahp_model');
//     }

//     public function index() {
//         $data['kriteria'] = $this->Ahp_model->get_kriteria();
//         $data['alternatif'] = $this->Ahp_model->get_alternatif();
//         $this->load->view('spk', $data);
//     }

//     public function hitung_ahp() {
//         $results = $this->Ahp_model->calculate_ahp();
//         echo json_encode($results);
//     }

//     public function simpan_kriteria() {
//         $data = [
//             'kriteria' => $this->input->post('nama_kriteria'),
//             'bobot' => $this->input->post('bobot')
//         ];
//         $this->Ahp_model->insert_kriteria($data);
//         redirect('ahp');
//     }

//     public function simpan_alternatif() {
//         $data = [
//             'nama' => $this->input->post('nama_alternatif'),
//             'riwayat_perusahaan' => $this->input->post('riwayat_perusahaan'),
//             'riwayat_menang' => $this->input->post('riwayat_menang'),
//             'lokasi' => $this->input->post('lokasi_tender'),
//             'hps' => $this->input->post('nilai_hps')
//         ];
//         $this->Ahp_model->insert_alternatif($data);
//         redirect('ahp');
//     }
// }
