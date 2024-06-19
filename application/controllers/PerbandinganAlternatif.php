<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class PerbandinganAlternatif extends CI_Controller
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
        $this->load->model('PerbandinganAlternatif_model');
        $this->load->model('Kriteria_model');
        $this->init();
    }

    public function tabel()
    {
        $id_kriteria = $this->input->post('id_kriteria');
        $data['data_kriteria'] = $this->PerbandinganAlternatif_model->getKriteria($id_kriteria);
        $data['data_alternatif'] = $this->PerbandinganAlternatif_model->getAlternatif();
        $data['jumlah_alternatif'] = $this->PerbandinganAlternatif_model->getNumAlternatif();
        $data['skala_perbandingan'] = $this->db->get('skala_perbandingan')->result_array();

        $this->load->view('templates/header');
        $this->load->view('perbandingan_alternatif/tabel_perbandingan', $data);
        $this->load->view('templates/footer');
    }

    public function proses()
    {
        $id_kriteria = $this->input->post('id_kriteria');
        $n = $this->PerbandinganAlternatif_model->getNumAlternatif();
        $matrik = array();
        $urut = 0;

        for ($x = 0; $x <= ($n - 2); $x++) {
            for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                $urut++;
                $pilih = "pilih" . $urut;
                $bobot = "bobot" . $urut;
                if ($this->input->post($pilih) == 1) {
                    $matrik[$x][$y] = $this->input->post($bobot);
                    $matrik[$y][$x] = 1 / $this->input->post($bobot);
                } else {
                    $matrik[$x][$y] = 1 / $this->input->post($bobot);
                    $matrik[$y][$x] = $this->input->post($bobot);
                }
            }
        }

        for ($i = 0; $i <= ($n - 1); $i++) {
            $matrik[$i][$i] = 1;
        }

        $jmlmpb = array();
        $jmlmnk = array();
        for ($i = 0; $i <= ($n - 1); $i++) {
            $jmlmpb[$i] = 0;
            $jmlmnk[$i] = 0;
        }

        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $value = $matrik[$x][$y];
                $jmlmpb[$y] += $value;
            }
        }

        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
                $value = $matrikb[$x][$y];
                $jmlmnk[$x] += $value;
            }

            $pv[$x] = $jmlmnk[$x] / $n;
        }

        $eigenVektor = $this->getEigenVector($pv, $matrik, $n);
        $consIndex = $this->getConsIndex($eigenVektor, $pv, $n);
        $consRatio = $this->getConsRatio($consIndex, $n);

        $data = array(
            'n' => $n,
            'matrik' => $matrik,
            'jmlmpb' => $jmlmpb,
            'jmlmnk' => $jmlmnk,
            'matrikb' => $matrikb,
            'pv' => $pv,
            'eigenVektor' => $eigenVektor,
            'consIndex' => $consIndex,
            'consRatio' => $consRatio,
            'data_kriteria' => $this->PerbandinganAlternatif_model->getKriteria($id_kriteria)
        );

        echo json_encode($data);
    }

    private function getEigenVector($pv, $matrik, $n)
    {
        $eigenVektor = array();
        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $matrik[$i][$j] * $pv[$j];
            }
            $eigenVektor[$i] = $sum;
        }
        return $eigenVektor;
    }

    private function getConsIndex($eigenVektor, $pv, $n)
    {
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum += $eigenVektor[$i] / $pv[$i];
        }
        $lambda_max = $sum / $n;
        $consIndex = ($lambda_max - $n) / ($n - 1);
        return $consIndex;
    }

    private function getConsRatio($consIndex, $n)
    {
        $RI = array(
            1 => 0.00, 2 => 0.00, 3 => 0.58, 4 => 0.90,
            5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41,
            9 => 1.45, 10 => 1.49
        );
        $consRatio = $consIndex / $RI[$n];
        return $consRatio;
    }

}
