<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Paket_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPaket()
    {
        $tahun_yang_dicari = date("Y");
        $this->db->where("id_lpse = 11 AND YEAR(tanggal_pembuatan) = '$tahun_yang_dicari'");
        $query = $this->db->get_where('paket');
        return $query->result_array();
    }

    public function getPaketById($id)
    {
        $query = $this->db->get_where('paket', ['id_paket' => $id]);
        return $query->row();
    }

    public function getHpsPerMonth($klpd, $jenisPengadaan, $tahun)
    {
        $this->db->select(["tanggal_pembuatan", "nilai_hps_paket"]);
        $this->db->where("YEAR(tanggal_pembuatan) = $tahun");
        if ($klpd != 0 && $klpd != null) {
            $this->db->join('lpse', 'lpse.id_lpse = paket.id_lpse');
            $this->db->where("paket.id_lpse = $klpd");
        }
        if ($jenisPengadaan != 0 && $jenisPengadaan != null) {
            $this->db->join('tender_terbaru', 'tender_terbaru.id_lpse = paket.id_lpse');
            $this->db->where("tender_terbaru.jenis_pengadaan = $jenisPengadaan");
        }
        $this->db->from('paket');
        $db = clone $this->db;
        $query = $this->db->get();
        //return $db->get_compiled_select();
        return $query->result_array();
    }

    // Halaman Know Your Market
    // public function getHpsPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    // {
    //     // 'SELECT SUM(nilai_hps), DATE_FORMAT(tgl_pembuatan, '%Y') AS tahun, DATE_FORMAT(tgl_pembuatan, '%m') AS bulan
    //     // FROM tender
    //     // WHERE id_lpse = 10
    //     // GROUP BY DATE_FORMAT(tgl_pembuatan, '%Y-%m')';
    //     $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
    //     $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
    //     $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
    //     $tahun = json_decode(str_replace('&quot;', '', $tahun), true);
    //     // var_dump($hps);

    //     // $cekStatusNotSelesai = ['Evaluasi Ulang', 'Seleksi Ulang', 'Tender Gagal', 'Tender Gagal, Tender Ulang', 'Tender Batal'];

    //     $this->db->select(["SUM(nilai_hps) as jumlah_hps", "COUNT(id_tender) as jumlah_tender", "DATE_FORMAT(tgl_pembuatan, '%m') AS bulan"]);
    //     $this->db->from('tender');
    //     // $this->db->where_not_in('status', $cekStatusNotSelesai);

    //     if ($klpd !== null) {
    //         $this->db->where_in('id_lpse', $klpd);
    //     }
    //     if ($jenisPengadaan !== null) {
    //         $this->db->where_in('id_jenis', $jenisPengadaan);
    //     }
    //     if ($hps[0] !== "null") {
    //         if ($hps[0] === '2') {
    //             $this->db->where("nilai_hps <", 500000000);
    //         } elseif ($hps[0] === '3') {
    //             $this->db->where("nilai_hps >", 1000000000);
    //             $this->db->where("nilai_hps <", 10000000000);
    //         } elseif ($hps[0] === '4') {
    //             $this->db->where("nilai_hps >", 10000000000);
    //             $this->db->where("nilai_hps <", 100000000000);
    //         } elseif ($hps[0] === '5') {
    //             $this->db->where("nilai_hps >", 100000000000);
    //         }
    //         // for ($i = 0; $i < count($hps); $i++) {
    //         // 	if (strpbrk($hps[$i], "/")) {
    //         // 		$str = explode("/", $hps[$i]);
    //         // 		$this->db->where("nilai_hps >", (int)$str[0]);
    //         // 		$this->db->where("nilai_hps <", (int)$str[1]);
    //         // 	} else {
    //         // 		$str = explode("than", $hps[$i]);
    //         // 		if (count($str) > 1) {
    //         // 			if ($str[0] === "less") {
    //         // 				$this->db->where("nilai_hps <", (int)$str[1]);
    //         // 			} else {
    //         // 				$this->db->where("nilai_hps >", (int)$str[1]);
    //         // 			}
    //         // 		}
    //         // 	}
    //         // }
    //     }
    //     if ($tahun !== null) {
    //         $this->db->where_in('DATE_FORMAT(tgl_pembuatan, "%Y")', $tahun);
    //     }
    //     $this->db->group_by('DATE_FORMAT(tgl_pembuatan, "%m")');
    //     $this->db->order_by('bulan');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }
}
