<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ahp_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ahp_model');
    }
    public function get_all_criteria()
    {
        return $this->db->get('data_kriteria')->result();
    }

    public function get_all_alternatives()
    {
        return $this->db->get('data_alternatif')->result();
    }

    public function get_alternative_scores($alternative_id, $kriteria_id)
    {
        return $this->db->where('id_alternatif', $alternative_id)
            ->where('id_kriteria', $kriteria_id)
            ->get('nilai_alternatif')->row();
    }

    public function add_criteria($data)
    {
        return $this->db->insert('data_kriteria', $data);
    }

    public function add_alternative($data)
    {
        return $this->db->insert('data_alternatif', $data);
    }

    public function add_alternative_score($data)
    {
        return $this->db->insert('nilai_alternatif', $data);
    }

    public function update_criteria($id, $data)
    {
        return $this->db->where('id_kriteria', $id)->update('data_kriteria', $data);
    }

    public function update_alternative($id, $data)
    {
        return $this->db->where('id_alternatif', $id)->update('data_alternatif', $data);
    }

    public function delete_criteria($id)
    {
        return $this->db->where('id_kriteria', $id)->delete('data_kriteria');
    }

    public function delete_alternative($id)
    {
        return $this->db->where('id_alternatif', $id)->delete('data_alternatif');
    }

    public function add_result($data)
    {
        return $this->db->insert('result', $data);
    }

    public function get_results()
    {
        return $this->db->get('result')->result();
    }

    public function calculate_scores()
    {
        // Data Alternatif (dummy data)
        $alternatives = [
            ['nama' => 'PT ABC', 'riwayat_perusahaan' => 10, 'riwayat_menang' => 5, 'lokasi' => 'Malang', 'hps' => 100000000],
            ['nama' => 'PT DEF', 'riwayat_perusahaan' => 5, 'riwayat_menang' => 3, 'lokasi' => 'Surabaya', 'hps' => 150000000],
            ['nama' => 'PT GHI', 'riwayat_perusahaan' => 8, 'riwayat_menang' => 4, 'lokasi' => 'Bandung', 'hps' => 120000000]
        ];

        // Bobot Kriteria
        $weights = [
            'riwayat_perusahaan' => 0.1,
            'riwayat_menang' => 0.1,
            'lokasi' => 0.3,
            'hps' => 0.5
        ];

        // Hitung nilai total setiap alternatif
        $scores = [];
        foreach ($alternatives as $alternative) {
            $total_score = 0;
            foreach ($weights as $key => $weight) {
                $total_score += $alternative[$key] * $weight;
            }
            $scores[] = [
                'nama' => $alternative['nama'],
                'score' => $total_score
            ];
        }

        return $scores;
    }

    public function sort_scores($scores)
    {
        // Urutkan nilai total dari yang paling besar ke yang paling kecil
        usort($scores, function ($a, $b) {
            return $b['score'] - $a['score'];
        });
        return $scores;
    }
}


// class Ahp_model extends CI_Model {

//     public function get_kriteria() {
//         $query = $this->db->get('kriteria');
//         return $query->result();
//     }

//     public function get_alternatif() {
//         $query = $this->db->get('alternatif');
//         return $query->result();
//     }

//     public function insert_kriteria($data) {
//         return $this->db->insert('kriteria', $data);
//     }

//     public function insert_alternatif($data) {
//         return $this->db->insert('alternatif', $data);
//     }

//     public function calculate_ahp() {
//         $kriteria = $this->get_kriteria();
//         $alternatif = $this->get_alternatif();

//         $results = [];

//         foreach ($alternatif as $alt) {
//             $total_score = 0;

//             foreach ($kriteria as $krit) {
//                 $value = 0;
//                 switch ($krit->kriteria) {
//                     case 'Riwayat Perusahaan':
//                         $value = $alt->riwayat_perusahaan;
//                         break;
//                     case 'Riwayat Menang':
//                         $value = $alt->riwayat_menang;
//                         break;
//                     case 'Lokasi Tender':
//                         $value = $alt->lokasi === 'malang' ? 30 : ($alt->lokasi === 'surabaya' ? 20 : 10);
//                         break;
//                     case 'Nilai HPS':
//                         $value = $alt->hps;
//                         break;
//                 }
//                 $total_score += $value * ($krit->bobot / 100);
//             }

//             $results[] = [
//                 'nama' => $alt->nama,
//                 'score' => $total_score
//             ];
//         }

//         usort($results, function($a, $b) {
//             return $b['score'] <=> $a['score'];
//         });

//         return $results;
//     }
// }

