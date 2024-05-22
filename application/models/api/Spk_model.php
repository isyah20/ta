<?php

defined('BASEPATH') or exit('No direct script access allowed');

// class Spk_model extends CI_Model
// {

//     public function __construct()
//     {
//         parent::__construct();
//         // Load helper, library, atau lakukan konfigurasi lain yang diperlukan
//     }

//     // Method untuk mendapatkan data kriteria dari database
//     public function getDataKriteria()
//     {
//         // Implementasikan query untuk mendapatkan data kriteria dari database
//         $this->db->select('*');
//         $this->db->from('kriteria');
//         $query = $this->db->get();
//         return $query->result_array();
//     }

//     // Method untuk menambahkan kriteria baru
//     public function tambahKriteria($data)
//     {
//         // Implementasikan query untuk menambahkan kriteria baru ke dalam database
//         $this->db->insert('kriteria', $data);
//         return $this->db->affected_rows();
//     }

//     // Method untuk mengupdate kriteria berdasarkan id
//     public function updateKriteria($id, $data)
//     {
//         // Implementasikan query untuk mengupdate kriteria berdasarkan id
//         $this->db->where('id_kriteria', $id);
//         $this->db->update('kriteria', $data);
//         return $this->db->affected_rows();
//     }

//     // Method untuk menghapus kriteria berdasarkan id
//     public function hapusKriteria($id)
//     {
//         // Implementasikan query untuk menghapus kriteria berdasarkan id
//         $this->db->where('id_kriteria', $id);
//         $this->db->delete('kriteria');
//         return $this->db->affected_rows();
//     }
//     public function get_kriteria()
//     {
//         $query = $this->db->get('kriteria');
//         return $query->result();
//     }

//     public function get_alternatif()
//     {
//         $query = $this->db->get('alternatif');
//         return $query->result();
//     }

//     public function insert_kriteria($data)
//     {
//         return $this->db->insert('kriteria', $data);
//     }

//     public function insert_alternatif($data)
//     {
//         return $this->db->insert('alternatif', $data);
//     }

//     public function calculate_ahp()
//     {
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

//         usort($results, function ($a, $b) {
//             return $b['score'] <=> $a['score'];
//         });

//         return $results;
//     }

// }
