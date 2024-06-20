<?php
defined('BASEPATH') or exit('No direct script access allowed');

use App\components\traits\ClientApi;

class PerbandinganAlternatif extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!get_cookie('id_pengguna')) {
            redirect('login');
        }

        $this->load->model('PerbandinganAlternatif_model');
        $this->load->model('PerbandinganKriteria_model');
        $this->load->model('Kriteria_model');
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
        // Jumlah Kriteria
        $n = $this->PerbandinganKriteria_model->getNumKriteria();

        if ($n == 0) {
            $response = array(
                'status' => 'error',
                'message' => 'Jumlah kriteria tidak boleh nol.'
            );
            echo json_encode($response);
            return;
        }

        $matrik = array();
        $urut = 0;

        // Memetakan nilai dalam bentuk matrik
        for ($x = 0; $x < $n; $x++) {
            for ($y = $x + 1; $y < $n; $y++) {
                $urut++;
                $pilih = "pilih" . $urut;
                $bobot = "bobot" . $urut;
                $bobot_value = $this->input->post($bobot);
                if ($bobot_value == 0) {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Nilai bobot tidak boleh nol.'
                    );
                    echo json_encode($response);
                    return;
                }
                if ($this->input->post($pilih) == 1) {
                    $matrik[$x][$y] = $bobot_value;
                    $matrik[$y][$x] = 1 / $bobot_value;
                } else {
                    $matrik[$x][$y] = 1 / $bobot_value;
                    $matrik[$y][$x] = $bobot_value;
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

        // Tambahkan data intermediate sebelum pembagian
        $response_intermediate = array(
            'status' => 'intermediate',
            'data' => array(
                'n' => $n,
                'matrik' => $matrik,
                'jmlmpb' => $jmlmpb,
            )
        );
        echo json_encode($response_intermediate);
        return;

        $matrikb = array();
        for ($x = 0; $x < $n; $x++) {
            for ($y = 0; $y < $n; $y++) {
                if ($jmlmpb[$y] == 0) {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Jumlah kolom kriteria tidak boleh nol.'
                    );
                    echo json_encode($response);
                    return;
                }
                $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
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

        $response = array(
            'status' => 'success',
            'data' => array(
                'n' => $n,
                'matrik' => $matrik,
                'jmlmpb' => $jmlmpb,
                'jmlmnk' => $jmlmnk,
                'matrikb' => $matrikb,
                'pv' => $pv,
                'eigenVektor' => $eigenVektor,
                'consIndex' => $consIndex,
                'consRatio' => $consRatio
            )
        );

        echo json_encode($response);
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
