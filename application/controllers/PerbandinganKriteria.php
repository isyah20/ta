<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class PerbandinganKriteria extends CI_Controller
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
        $this->load->model('PerbandinganKriteria_model');
        $this->init();
    }

    public function simpan()
    {
        $data = $this->input->post('comparison');

        foreach ($data as $comparison) {
            $id_kriteria1 = $comparison['id_kriteria1'];
            $id_kriteria2 = $comparison['id_kriteria2'];
            $nilai = $comparison['nilai'];

            $this->PerbandinganKriteria_model->insertPerbandinganKriteria($id_kriteria1, $id_kriteria2, $nilai);
        }

        echo json_encode(['status' => 'success']);
    }

    /* public function save_comparison()
    {
        $data = $this->input->post();
        $result = $this->PerbandinganKriteria_model->save_comparison_data($data);

        echo json_encode($result);
    } */

    /* public function index()
    {

        $data['data'] = $this->model->get_criteria();
        $data['jumlah'] = $this->model->getNumKriteria();
        $data['skala_perbandingan'] = $this->db->get('tb_skala_perbandingan')->result_array();

        $this->load->view('templates/header');
        $this->load->view('perbandingan_kriteria/index', $data);
        $this->load->view('templates/footer');
    } */

    public function proses()
    {
        // Jumlah Kriteria
        $n = $this->PerbandinganKriteria_model->getNumKriteria();

        $matrik = array();
        $urut = 0;

        // Memetakan nilai dalam bentuk matrik
        for ($x = 0; $x < $n; $x++) {
            for ($y = $x + 1; $y < $n; $y++) {
                $urut++;
                $pilih = "pilih" . $urut;
                $bobot = "bobot" . $urut;

                // Ambil nilai dari input post, pastikan tidak nol
                $nilai = $this->input->post($bobot);
                if ($nilai == 0) {
                    // Atur nilai default jika input post bernilai nol
                    $nilai = 0.0001; // Contoh nilai kecil yang tidak nol
                }

                if ($this->input->post($pilih) == 1) {
                    $matrik[$x][$y] = $nilai;
                    $matrik[$y][$x] = 1 / $nilai;
                } else {
                    $matrik[$x][$y] = 1 / $nilai;
                    $matrik[$y][$x] = $nilai;
                }

                $id_kriteria1 = $this->PerbandinganKriteria_model->getKriteriaId($x);
                $id_kriteria2 = $this->PerbandinganKriteria_model->getKriteriaId($y);

                $jumlahPerbandingan = $this->PerbandinganKriteria_model->getNumPerbandinganKriteria($id_kriteria1, $id_kriteria2);
                if ($jumlahPerbandingan == 0) {
                    $this->PerbandinganKriteria_model->insertPerbandinganKriteria($id_kriteria1, $id_kriteria2, $matrik[$x][$y]);
                } else {
                    $this->PerbandinganKriteria_model->updatePerbandinganKriteria($id_kriteria1, $id_kriteria2, $matrik[$x][$y]);
                }
            }
        }

        // Diagonal -> bernilai 1
        for ($i = 0; $i < $n; $i++) {
            $matrik[$i][$i] = 1;
        }

        $jmlmpb = array_fill(0, $n, 0);
        $jmlmnk = array_fill(0, $n, 0);

        // Menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
        for ($x = 0; $x < $n; $x++) {
            for ($y = 0; $y < $n; $y++) {
                $jmlmpb[$y] += $matrik[$x][$y];
            }
        }

        $matrikb = array();
        for ($x = 0; $x < $n; $x++) {
            for ($y = 0; $y < $n; $y++) {
                if ($jmlmpb[$y] != 0) { // Pastikan pembaginya tidak nol
                    $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
                } else {
                    $matrikb[$x][$y] = 0; // Atau atur nilai default
                }
                $jmlmnk[$x] += $matrikb[$x][$y];
            }

            $pv[$x] = $jmlmnk[$x] / $n;
            $id_kriteria = $this->PerbandinganKriteria_model->getKriteriaId($x);
            $jumlahPV = $this->PerbandinganKriteria_model->getNumWithIdKriteriaPV($id_kriteria);
            if ($jumlahPV == 0) {
                $this->PerbandinganKriteria_model->insertKriteriaPV($id_kriteria, $pv[$x]);
            } else {
                $this->PerbandinganKriteria_model->updateKriteriaPV($id_kriteria, $pv[$x]);
            }
        }

        $eigenVektor = $this->getEigenVector($matrik, $pv, $n);
        $consIndex = $this->getConsIndex($matrik, $pv, $n);
        $consRatio = $this->getConsRatio($consIndex, $n);

        $data['n'] = $n;
        $data['matrik'] = $matrik;
        $data['jmlmpb'] = $jmlmpb;
        $data['jmlmnk'] = $jmlmnk;
        $data['matrikb'] = $matrikb;
        $data['pv'] = $pv;
        $data['eigenVektor'] = $eigenVektor;
        $data['consIndex'] = $consIndex;
        $data['consRatio'] = $consRatio;

        // Load view dan kirimkan data
        $this->load->view('dashboard/supplier/spk', $data);
    }


    private function getEigenVector($matrik, $pv, $n)
    {
        $eigenVector = array();
        for ($i = 0; $i < $n; $i++) {
            $eigenVector[$i] = 0;
            for ($j = 0; $j < $n; $j++) {
                $eigenVector[$i] += $matrik[$i][$j] * $pv[$j];
            }
        }
        return $eigenVector;
    }

    private function getConsIndex($matrik, $pv, $n)
    {
        $eigenVector = $this->getEigenVector($matrik, $pv, $n);
        $lambdaMax = array_sum($eigenVector) / $n;
        $consIndex = ($lambdaMax - $n) / ($n - 1);
        return $consIndex;
    }

    private function getConsRatio($consIndex, $n)
    {
        $ir = [0, 0, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45];
        $consRatio = $consIndex / $ir[$n];
        return $consRatio;
    }


}
