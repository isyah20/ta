<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AnggotaAsosiasi_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function tambahAnggota($data)
    {
        $this->db->insert('anggota_asosiasi', $data);
        return $this->db->insert_id();
    }

    public function hapusAnggota($id)
    {
        $this->db->where('id_anggota', $id);
        return $this->db->delete('anggota_asosiasi');
    }

    // public function getDataFilter($year)
    // {
    //     $this->db->select("(SELECT COUNT(id_pemenang)
    //         FROM pemenang JOIN tender ON tender.`id_tender` = pemenang.`id_tender`
    //         WHERE npwp = asosiasi.`npwp` AND CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = $year) AS menang,
    //         (SELECT COUNT(id_pemenang) FROM pemenang
    //         JOIN tender ON tender.`id_tender` = pemenang.`id_tender`
    //         WHERE pemenang.id_tender IN (SELECT id_tender FROM peserta_tender WHERE npwp = asosiasi.`npwp` AND harga_penawaran !=0)
    //         AND npwp != asosiasi.`npwp` AND CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = $year) AS kalah,
    //         (SELECT COUNT(peserta_tender.`id_tender`)
    //         FROM peserta_tender
    //         JOIN tender ON tender.`id_tender` = peserta_tender.`id_tender`
    //         WHERE peserta_tender.`npwp` = asosiasi.`npwp`
    //         AND peserta_tender.harga_penawaran != 0 AND CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = $year
    //         AND tender.status NOT IN ('Tender Sudah Selesai', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal','Gagal')) AS ikut,
    //         asosiasi.*");
    //     $this->db->from("asosiasi");
    //     $this->db->join("peserta_tender", "peserta_tender.`npwp` = asosiasi.`npwp`", "left");
    //     $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
    //     $this->db->group_by("asosiasi.`id_anggota`");
    //     // $this->db->limit(2, 0);
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    // public function getDataFilterhps($year)
    // {
    //     $this->db->select("asosiasi.`npwp`,
    //     ROUND((SUM(IF(asosiasi.`npwp`=peserta_tender.`npwp`,(((tender.`nilai_hps` - peserta_tender.`harga_penawaran`)*100) / tender.`nilai_hps`), 0 ))/COUNT(asosiasi.`npwp`=peserta_tender.`npwp`)),1)
    //     AS penurunan_hps, ((tender.`nilai_hps` - peserta_tender.`harga_penawaran`)*100) / tender.`nilai_hps` AS per_tender,
    //     SUM(IF(asosiasi.`npwp`=peserta_tender.`npwp`,(((tender.`nilai_hps` - peserta_tender.`harga_penawaran`)*100) / tender.`nilai_hps`), 0 )) AS total_persentase_per_npwp,
    //     COUNT(asosiasi.`npwp`=peserta_tender.`npwp`) AS total_tender_diikuti, tender.`nilai_hps` AS nilai_hps, CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) AS year_tender,
    //     CASE
    //     WHEN ROUND((SUM(IF(asosiasi.`npwp`=peserta_tender.`npwp`,(((tender.`nilai_hps` - peserta_tender.`harga_penawaran`)*100) / tender.`nilai_hps`), 0 ))/COUNT(asosiasi.`npwp`=peserta_tender.`npwp`)),1) > 0 THEN '1'
    //     WHEN ROUND((SUM(IF(asosiasi.`npwp`=peserta_tender.`npwp`,(((tender.`nilai_hps` - peserta_tender.`harga_penawaran`)*100) / tender.`nilai_hps`), 0 ))/COUNT(asosiasi.`npwp`=peserta_tender.`npwp`)),1) = 0 THEN '2'
    //     WHEN ROUND((SUM(IF(asosiasi.`npwp`=peserta_tender.`npwp`,(((tender.`nilai_hps` - peserta_tender.`harga_penawaran`)*100) / tender.`nilai_hps`), 0 ))/COUNT(asosiasi.`npwp`=peserta_tender.`npwp`)),1) < 0 THEN '3'
    //     ELSE '0'
    //     END AS stat");
    //     $this->db->from("asosiasi");
    //     $this->db->join("peserta_tender", "peserta_tender.`npwp` = asosiasi.`npwp`", "left");
    //     $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`", "left");
    //     $this->db->where("harga_penawaran != 0");
    //     $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = $year");
    //     $this->db->group_by("asosiasi.`npwp`");
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    public function getDataAsosiasi($limit, $start, $search, $count, $id_pengguna)
    {
        $this->db->select('count(id_pemenang)');
        $this->db->from('pemenang');
        $this->db->where('npwp = asosiasi.`npwp`');
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("tahun LIKE '$tahun'");
            }
        }
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("tender.id_lpse = '$lpse'");
            }
        }
        $menang = $this->db->get_compiled_select();

        $this->db->select("id_tender");
        $this->db->from("peserta_tender");
        $this->db->where("npwp = asosiasi.npwp");
        $this->db->where("harga_penawaran !=0");
        $id_tender = $this->db->get_compiled_select();

        $this->db->select('COUNT(id_pemenang)');
        $this->db->from('pemenang');
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        $this->db->where("pemenang.id_tender IN ($id_tender) ");
        $this->db->where("npwp != asosiasi.`npwp`");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("tahun LIKE '$tahun'");
            }
        }
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("tender.id_lpse = '$lpse'");
            }
        }
        $kalah = $this->db->get_compiled_select();

        $this->db->select('COUNT(peserta_tender.`id_tender`)');
        $this->db->from('peserta_tender');
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
        $this->db->where("peserta_tender.harga_penawaran != 0 ");
        $this->db->where("tender.status NOT IN ('Tender Sudah Selesai','Selesai','Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal')");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("tahun LIKE '$tahun'");
            }
        }
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        $ikut = $this->db->get_compiled_select();

        $this->db->select("ROUND((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`rata3`, 0))/COUNT(asosiasi.`npwp`=ratahps.`npwp`)),1)");
        $this->db->from("ratahps");
        $this->db->join("asosiasi", "ratahps.`npwp` = asosiasi.`npwp`");
        $this->db->group_by("asosiasi.npwp");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("tahun LIKE '$tahun'");
            }
        }
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        $penurunan_hps = $this->db->get_compiled_select();

        $this->db->select('asosiasi.*');
        $this->db->from('asosiasi');
        $this->db->select("($menang) AS menang");
        $this->db->select("($kalah) AS kalah");
        $this->db->select("($ikut) AS ikut");
        // $this->db->select("ROUND((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`rata3`, 0))/COUNT(asosiasi.`npwp`=ratahps.`npwp`)),1) AS penurunan_hps");
        $this->db->select("ROUND(((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`hasil`, 0))*100)/SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`nilai_hps`, 0))),1) AS penurunan_hps");
        $this->db->join("anggota_asosiasi", "anggota_asosiasi.npwp = asosiasi.npwp");
        $this->db->join("ratah", "ratahps.`npwp` = asosiasi.`npwp`", "left");
        $this->db->join("peserta_tender", "peserta_tender.`npwp` = asosiasi.`npwp`", "left");
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`", "left");
        $this->db->where("anggota_asosiasi.id_pengguna = $id_pengguna");
        $this->db->group_by("asosiasi.`id_anggota` ");
        if ($search['keyword'] != null) {
            $keyword = $search['keyword'];
            if ($keyword) {
                $this->db->where("nama_peserta LIKE '%$keyword%'");
            }
        }
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("ratahps.tahun LIKE '$tahun'");
            }
        }
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("ratahps.id_lpse = '$lpse'");
            }
        }
        if ($count) {
            return $this->db->count_all_results();
        } else {
            $this->db->limit($limit, $start);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
        }

        return [];
    }

    public function getdatadinamis($search, $id_pengguna)
    {
        //menang
        $this->db->select("COUNT(id_pemenang)");
        $this->db->from("pemenang");
        $this->db->where("npwp = asosiasi.`npwp`");
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
            }
        }
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("tender.id_lpse = '$lpse'");
            }
        }
        $sub_menang = $this->db->get_compiled_select();

        //total menang
        $this->db->select("SUM(($sub_menang))");
        $this->db->from("asosiasi");
        $total_menang = $this->db->get_compiled_select();

        //perusahaan dengan harga_penawaran !=0
        $this->db->select("peserta_tender.id_tender");
        $this->db->from("peserta_tender");
        $this->db->where("npwp = asosiasi.`npwp`");
        $this->db->where("harga_penawaran !=0");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        $this->db->join("tender", "peserta_tender.id_tender = tender.id_tender");
        $sub_kalah = $this->db->get_compiled_select();

        //kalah
        $this->db->select("COUNT(id_pemenang)");
        $this->db->from("pemenang");
        $this->db->where("pemenang.id_tender IN ($sub_kalah)");
        $this->db->where("npwp != asosiasi.`npwp`");
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
            }
        }
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("tender.id_lpse = '$lpse'");
            }
        }
        $kalah = $this->db->get_compiled_select();

        //total kalah
        $this->db->select("SUM(($kalah))");
        $this->db->from("asosiasi");
        $total_kalah = $this->db->get_compiled_select();

        //ikut
        $this->db->select('COUNT(peserta_tender.`id_tender`)');
        $this->db->from('peserta_tender');
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
        $this->db->where("peserta_tender.harga_penawaran != 0 ");
        $this->db->where("tender.status NOT IN ('Tender Sudah Selesai','Selesai','Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal')");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
            }
        }
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        $ikut = $this->db->get_compiled_select();

        //total kalah
        $this->db->select("SUM(($ikut))");
        $this->db->from("asosiasi");
        $total_ikut = $this->db->get_compiled_select();

        //total_ikut
        $this->db->select("COUNT(peserta_tender.`id_tender`)");
        $this->db->from("peserta_tender");
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
        $this->db->where("peserta_tender.harga_penawaran != 0 ");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '2021'");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
            }
        }
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        $sub_total_ikut = $this->db->get_compiled_select();

        //total_ikut_semua
        $this->db->select("SUM(($sub_total_ikut))");
        $this->db->from("asosiasi");
        $total_ikut_semua = $this->db->get_compiled_select();

        //ikut sekarang
        $this->db->select("COUNT(peserta_tender.`id_tender`)");
        $this->db->from("peserta_tender");
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
            }
        }
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        $sub_ikut_skrng = $this->db->get_compiled_select();

        //total ikut sekarang
        $this->db->select("SUM(($sub_ikut_skrng))");
        $this->db->from("asosiasi");
        $total_ikut_semua_sekarang = $this->db->get_compiled_select();

        //ikut tahun lalu
        $this->db->select("COUNT(peserta_tender.`id_tender`)");
        $this->db->from("peserta_tender");
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun-1'");
            }
        }
        if ($search['lpse']) {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("id_lpse = '$lpse'");
            }
        }
        $sub_ikut_skrng = $this->db->get_compiled_select();

        //total ikut tahun lalu
        $this->db->select("SUM(($sub_ikut_skrng))");
        $this->db->from("asosiasi");
        $total_ikut_semua_lalu = $this->db->get_compiled_select();

        //total naik ikut tahun terbaru
        $this->db->select("($total_ikut_semua_sekarang)-($total_ikut_semua_lalu)");
        $this->db->from("asosiasi");
        $total_naik_ikut = $this->db->get_compiled_select();

        // $this->db->select("ROUND((($total_naik_ikut)/($sub_ikut_skrng)),2)");
        // $this->db->from("asosiasi");
        // $persen_ikut = $this->db->get_compiled_select();
        // SELECT COUNT(id_pengguna) FROM asosiasi WHERE id_pengguna = 3230694
        // $this->db->select("COUNT(id_pengguna)");
        // $this->db->from("asosiasi");
        // $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // $total_anggota = $this->db->get_compiled_select();

        $this->db->select("*");
        $this->db->select("($total_menang) as total_menang");
        $this->db->select("($total_kalah) as total_kalah");
        $this->db->select("($total_ikut) as total_ikut");
        $this->db->select("($total_ikut_semua) as total_ikut_semua");
        // $this->db->select("(($total_menang)/(($total_menang)+($total_kalah)+($total_ikut))*100) as persen_menang");
        // $this->db->select("(($total_kalah)/(($total_menang)+($total_kalah)+($total_ikut))*100) as persen_kalah");
        // $this->db->select("(($total_ikut)/(($total_menang)+($total_kalah)+($total_ikut))*100) as persen_ikut");
        // $this->db->select("($total_ikut_semua)/($total_anggota) as rata_rata_ikut");
        // $this->db->select("($total_naik_ikut) as total_naik");
        // $this->db->select("ROUND((($total_naik_ikut)/($sub_ikut_skrng)),2) as persen");
        $this->db->from("asosiasi");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // $this->db->order_by("asosiasi.npwp");
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function getdatadinamisavg($search, $id_pengguna)
    // {
    //     //total_ikut
    //     $this->db->select("COUNT(peserta_tender.`id_tender`)");
    //     $this->db->from("peserta_tender");
    //     $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
    //     $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
    //     $this->db->where("peserta_tender.harga_penawaran != 0 ");
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     if ($search['tahun']) {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '$tahun'");
    //         }
    //     }
    //     $sub_total_ikut = $this->db->get_compiled_select();

    //     //total_ikut_semua
    //     $this->db->select("SUM(($sub_total_ikut))");
    //     $this->db->from("asosiasi");
    //     $total_ikut_semua = $this->db->get_compiled_select();

    //     //menang
    //     $this->db->select("COUNT(id_pemenang)");
    //     $this->db->from("pemenang");
    //     $this->db->where("npwp = asosiasi.`npwp`");
    //     $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     if ($search['tahun']) {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '$tahun'");
    //         }
    //     }
    //     $sub_menang = $this->db->get_compiled_select();

    //     //total menang
    //     $this->db->select("SUM(($sub_menang))");
    //     $this->db->from("asosiasi");
    //     $total_menang = $this->db->get_compiled_select();

    //     //perusahaan dengan harga_penawaran !=0
    //     $this->db->select("peserta_tender.id_tender");
    //     $this->db->from("peserta_tender");
    //     $this->db->where("npwp = asosiasi.`npwp`");
    //     $this->db->where("harga_penawaran !=0");
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     $this->db->join("tender", "peserta_tender.id_tender = tender.id_tender");
    //     $sub_kalah = $this->db->get_compiled_select();

    //     //kalah
    //     $this->db->select("COUNT(id_pemenang)");
    //     $this->db->from("pemenang");
    //     $this->db->where("pemenang.id_tender IN ($sub_kalah)");
    //     $this->db->where("npwp != asosiasi.`npwp`");
    //     $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
    //     if ($search['tahun']) {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '$tahun'");
    //         }
    //     }
    //     $kalah = $this->db->get_compiled_select();

    //     //total kalah
    //     $this->db->select("SUM(($kalah))");
    //     $this->db->from("asosiasi");
    //     $total_kalah = $this->db->get_compiled_select();

    //     $this->db->select("COUNT(id_pengguna)");
    //     $this->db->from("asosiasi");
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     $total_anggota = $this->db->get_compiled_select();

    //     // $this->db->select("COUNT(peserta_tender.`id_tender`)");
    //     // $this->db->from("peserta_tender");
    //     // $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
    //     // $this->db->where("peserta_tender.npwp = asosiasi.npwp");
    //     // $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = 2022");
    //     // $tahun_skrg = $this->db->get_compiled_select();

    //     // $this->db->select("COUNT(peserta_tender.`id_tender`)");
    //     // $this->db->from("peserta_tender");
    //     // $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
    //     // $this->db->where("peserta_tender.npwp = asosiasi.npwp");
    //     // $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = 2021");
    //     // $tahun_lalu = $this->db->get_compiled_select();

    //     $this->db->select("ROUND(((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`hasil`, 0))*100)/SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`nilai_hps`, 0))),1) AS penurunan_hps");
    //     $this->db->from('asosiasi');
    //     $this->db->join("anggota_asosiasi", "anggota_asosiasi.npwp = asosiasi.npwp");
    //     $this->db->join("ratahps", "ratahps.`npwp` = asosiasi.`npwp`", "left");
    //     $this->db->join("peserta_tender", "peserta_tender.`npwp` = asosiasi.`npwp`", "left");
    //     $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`", "left");
    //     $this->db->where("anggota_asosiasi.id_pengguna = $id_pengguna");
    //     $this->db->group_by("asosiasi.`id_anggota` ");
    //     if ($search['tahun'] != "") {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("ratahps.tahun = '$tahun'");
    //         }
    //     }
    //     $total_penurunan = $this->db->get_compiled_select();

    //     // $this->select;
    //     // SELECT SUM(`hasil`)
    //     // FROM ratahps
    //     // LEFT JOIN asosiasi ON ratahps.`npwp` = asosiasi.`npwp`
    //     // WHERE asosiasi.`id_pengguna`
    //     // $this->db->select("SUM(($tahun_skrg))-sum(($tahun_lalu))");
    //     // $this->db->from();
    //     $this->db->select("SUM(`hasil`)");
    //     $this->db->from('ratahps');
    //     $this->db->join('asosiasi', 'ratahps.npwp = asosiasi.npwp');
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     if ($search['tahun'] != "") {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("ratahps.tahun = '$tahun'");
    //         }
    //     }
    //     $total_penurunan = $this->db->get_compiled_select();
    //     // SELECT SUM(nilai_hps)
    //     // FROM ratahps
    //     // LEFT JOIN asosiasi ON ratahps.`npwp` = asosiasi.`npwp`
    //     // WHERE asosiasi.`id_pengguna` = 3230694
    //     $this->db->select('SUM(nilai_hps)');
    //     $this->db->from('ratahps');
    //     $this->db->join('asosiasi', 'ratahps.npwp = asosiasi.npwp');
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     if ($search['tahun'] != "") {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("ratahps.tahun = '$tahun'");
    //         }
    //     }
    //     $total_nilai_hps = $this->db->get_compiled_select();

    //     //PERSENAN MULAI DARI SINIIIIII//

    //     //total_ikut
    //     $this->db->select("COUNT(peserta_tender.`id_tender`)");
    //     $this->db->from("peserta_tender");
    //     $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
    //     $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
    //     $this->db->where("peserta_tender.harga_penawaran != 0 ");
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     // $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '2021'");
    //     if ($search['tahun'] != '') {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = ($tahun-1)");
    //         }
    //     } else {
    //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = (YEAR(NOW())-1)");
    //     }
    //     $sub_total_ikut_lalu = $this->db->get_compiled_select();

    //     //total_ikut_semua
    //     $this->db->select("SUM(($sub_total_ikut_lalu))");
    //     $this->db->from("asosiasi");
    //     $total_ikut_semua_lalu = $this->db->get_compiled_select();

    //     //total_ikut
    //     $this->db->select("COUNT(peserta_tender.`id_tender`)");
    //     $this->db->from("peserta_tender");
    //     $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
    //     $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
    //     $this->db->where("peserta_tender.harga_penawaran != 0 ");
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '2022'");
    //     if ($search['tahun'] != '') {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '$tahun'");
    //         }
    //     } else {
    //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = (YEAR(NOW()))");
    //     }
    //     $sub_total_ikut_skrg = $this->db->get_compiled_select();

    //     //total_ikut_semua
    //     $this->db->select("SUM(($sub_total_ikut_skrg))");
    //     $this->db->from("asosiasi");
    //     $total_ikut_semua_skrg = $this->db->get_compiled_select();

    //     //menang - tahun sekarang
    //     $this->db->select("COUNT(id_pemenang)");
    //     $this->db->from("pemenang");
    //     $this->db->where("npwp = asosiasi.`npwp`");
    //     $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '2022'");
    //     if ($search['tahun'] != '') {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '$tahun'");
    //         }
    //     } else {
    //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = (YEAR(NOW()))");
    //     }
    //     $sub_menang_skrg = $this->db->get_compiled_select();

    //     //total menang
    //     $this->db->select("SUM(($sub_menang_skrg))");
    //     $this->db->from("asosiasi");
    //     $total_menang_skrg = $this->db->get_compiled_select();

    //     //menang - tahun lalu
    //     $this->db->select("COUNT(id_pemenang)");
    //     $this->db->from("pemenang");
    //     $this->db->where("npwp = asosiasi.`npwp`");
    //     $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     // $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '2021'");
    //     if ($search['tahun'] != '') {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = ($tahun-1)");
    //         }
    //     } else {
    //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = (YEAR(NOW())-1)");
    //     }
    //     $sub_menang_lalu = $this->db->get_compiled_select();

    //     //total menang
    //     $this->db->select("SUM(($sub_menang_lalu))");
    //     $this->db->from("asosiasi");
    //     $total_menang_lalu = $this->db->get_compiled_select();

    //     //kalah - sekarang
    //     $this->db->select("COUNT(id_pemenang)");
    //     $this->db->from("pemenang");
    //     $this->db->where("pemenang.id_tender IN ($sub_kalah)");
    //     $this->db->where("npwp != asosiasi.`npwp`");
    //     $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
    //     $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '2022'");
    //     if ($search['tahun'] != '') {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '$tahun'");
    //         }
    //     } else {
    //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = (YEAR(NOW()))");
    //     }
    //     $kalah_skrg = $this->db->get_compiled_select();

    //     //total kalah
    //     $this->db->select("SUM(($kalah_skrg))");
    //     $this->db->from("asosiasi");
    //     $total_kalah_skrg = $this->db->get_compiled_select();

    //     //kalah - lalu
    //     $this->db->select("COUNT(id_pemenang)");
    //     $this->db->from("pemenang");
    //     $this->db->where("pemenang.id_tender IN ($sub_kalah)");
    //     $this->db->where("npwp != asosiasi.`npwp`");
    //     $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
    //     // $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '2021'");
    //     if ($search['tahun'] != '') {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = ($tahun-1)");
    //         }
    //     } else {
    //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = (YEAR(NOW())-1)");
    //     }
    //     $kalah_lalu = $this->db->get_compiled_select();

    //     //total kalah
    //     $this->db->select("SUM(($kalah_lalu))");
    //     $this->db->from("asosiasi");
    //     $total_kalah_lalu = $this->db->get_compiled_select();

    //     $this->db->select("SUM(`hasil`)");
    //     $this->db->from('ratahps');
    //     $this->db->join('asosiasi', 'ratahps.npwp = asosiasi.npwp');
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     // $this->db->where("ratahps.tahun = '2022'");
    //     if ($search['tahun'] != '') {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("ratahps.tahun = '$tahun'");
    //         }
    //     } else {
    //         $this->db->where("ratahps.tahun = (YEAR(NOW()))");
    //     }
    //     $total_penurunan_skrg = $this->db->get_compiled_select();
    //     // SELECT SUM(nilai_hps)
    //     // FROM ratahps
    //     // LEFT JOIN asosiasi ON ratahps.`npwp` = asosiasi.`npwp`
    //     // WHERE asosiasi.`id_pengguna` = 3230694
    //     $this->db->select('SUM(nilai_hps)');
    //     $this->db->from('ratahps');
    //     $this->db->join('asosiasi', 'ratahps.npwp = asosiasi.npwp');
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     $this->db->where("ratahps.tahun = '2022'");
    //     if ($search['tahun'] != '') {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("ratahps.tahun = '$tahun'");
    //         }
    //     } else {
    //         $this->db->where("ratahps.tahun = (YEAR(NOW()))");
    //     }
    //     $total_nilai_hps_skrg = $this->db->get_compiled_select();

    //     $this->db->select("SUM(`hasil`)");
    //     $this->db->from('ratahps');
    //     $this->db->join('asosiasi', 'ratahps.npwp = asosiasi.npwp');
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     // $this->db->where("ratahps.tahun = '2021'");
    //     if ($search['tahun'] != '') {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("ratahps.tahun = ($tahun-1)");
    //         }
    //     } else {
    //         $this->db->where("ratahps.tahun = (YEAR(NOW())-1)");
    //     }
    //     $total_penurunan_lalu = $this->db->get_compiled_select();
    //     // SELECT SUM(nilai_hps)
    //     // FROM ratahps
    //     // LEFT JOIN asosiasi ON ratahps.`npwp` = asosiasi.`npwp`
    //     // WHERE asosiasi.`id_pengguna` = 3230694
    //     $this->db->select('SUM(nilai_hps)');
    //     $this->db->from('ratahps');
    //     $this->db->join('asosiasi', 'ratahps.npwp = asosiasi.npwp');
    //     $this->db->where("asosiasi.id_pengguna = $id_pengguna");
    //     // $this->db->where("ratahps.tahun = '2021'");
    //     if ($search['tahun'] != "") {
    //         $tahun = $search['tahun'];
    //         if ($tahun) {
    //             $this->db->where("ratahps.tahun = ($tahun-1)");
    //         }
    //     } else {
    //         $this->db->where("ratahps.tahun = (YEAR(NOW())-1)");
    //     }
    //     $total_nilai_hps_lalu = $this->db->get_compiled_select();

    //     // $this->db->select("SUM(($tahun_skrg))");
    //     // // $this->db->form("asosiasi");
    //     // $tender_tahun_skrg = $this->db->get_compiled_select();

    //     // $this->db->select("SUM(($tahun_lalu))");
    //     // // $this->db->form("asosiasi");
    //     // $tender_tahun_lalu = $this->db->get_compiled_select();

    //     // $this->db->select("ROUND((($tender_tahun_skrg)-($tender_tahun_lalu)*100)/($tender_tahun_lalu),1)");
    //     // // $this->db->from("asosiasi");
    //     // $persen_ikut_tender = $this->db->get_compiled_select();
    //     $this->db->select("ROUND(($total_ikut_semua)/($total_anggota),1) as rata_ikut_tender");
    //     $this->db->select("ROUND(($total_menang)/($total_anggota),1) as rata_menang_tender");
    //     $this->db->select("ROUND(($total_kalah)/($total_anggota),1) as rata_kalah_tender");
    //     $this->db->select("ROUND((($total_penurunan)*100)/($total_nilai_hps),1) as rata_penurunan_hps");
    //     // $this->db->select("ROUND((($total_ikut_semua)-($total_ikut_semua_lalu)),1) as persen_ikut_tender");
    //     $this->db->select("ROUND(((($total_ikut_semua_skrg)-($total_ikut_semua_lalu))*100)/($total_ikut_semua_lalu),1) as persen_ikut_tender");
    //     $this->db->select("ROUND(((($total_menang_skrg)-($total_menang_lalu))*100)/($total_menang_lalu),1) as persen_menang_tender");
    //     $this->db->select("ROUND(((($total_kalah_skrg)-($total_kalah_lalu))*100)/($total_kalah_lalu),1) as persen_kalah_tender");
    //     // $this->db->select("(ROUND((($total_penurunan_lalu)*100)/($total_nilai_hps_lalu),1))+(ROUND((($total_penurunan_skrg)*100)/($total_nilai_hps_skrg),1))/2");
    //     $this->db->select("ROUND((ROUND((($total_penurunan_skrg)*100)/($total_nilai_hps_skrg),1)+ROUND((($total_penurunan_lalu)*100)/($total_nilai_hps_lalu),1))/2,1) as persen_penurunan_tender");
    //     // $this->db->select("(sum(($tahun_skrg))-sum(($tahun_lalu))) as total_ikut_tahun_ini");
    //     // $this->db->select("round((((sum(($tahun_skrg)))-(sum(($tahun_lalu))))*100)/sum(($tahun_lalu)),1) as persen_ikut_tender");
    //     // $this->db->select("round((((sum(($tahun_skrg)))+(sum(($tahun_lalu))))/2),1) as rata");
    //     $this->db->from("asosiasi");
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }
    public function getdatadinamisavg($search, $id_pengguna)
    {
        //total_ikut
        $this->db->select("COUNT(peserta_tender.`id_tender`)");
        $this->db->from("peserta_tender");
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
        $this->db->where("peserta_tender.harga_penawaran != 0 ");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
            }
        }
        $sub_total_ikut = $this->db->get_compiled_select();

        //total_ikut_semua
        $this->db->select("SUM(($sub_total_ikut))");
        $this->db->from("asosiasi");
        $total_ikut_semua = $this->db->get_compiled_select();

        //menang
        $this->db->select("COUNT(id_pemenang)");
        $this->db->from("pemenang");
        $this->db->where("npwp = asosiasi.`npwp`");
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
            }
        }
        $sub_menang = $this->db->get_compiled_select();

        //total menang
        $this->db->select("SUM(($sub_menang))");
        $this->db->from("asosiasi");
        $total_menang = $this->db->get_compiled_select();

        //perusahaan dengan harga_penawaran !=0
        $this->db->select("peserta_tender.id_tender");
        $this->db->from("peserta_tender");
        $this->db->where("npwp = asosiasi.`npwp`");
        $this->db->where("harga_penawaran !=0");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        $this->db->join("tender", "peserta_tender.id_tender = tender.id_tender");
        $sub_kalah = $this->db->get_compiled_select();

        //kalah
        $this->db->select("COUNT(id_pemenang)");
        $this->db->from("pemenang");
        $this->db->where("pemenang.id_tender IN ($sub_kalah)");
        $this->db->where("npwp != asosiasi.`npwp`");
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
            }
        }
        $kalah = $this->db->get_compiled_select();

        //total kalah
        $this->db->select("SUM(($kalah))");
        $this->db->from("asosiasi");
        $total_kalah = $this->db->get_compiled_select();

        $this->db->select("COUNT(id_pengguna)");
        $this->db->from("asosiasi");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        $total_anggota = $this->db->get_compiled_select();

        // $this->db->select("COUNT(peserta_tender.`id_tender`)");
        // $this->db->from("peserta_tender");
        // $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        // $this->db->where("peserta_tender.npwp = asosiasi.npwp");
        // $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = 2022");
        // $tahun_skrg = $this->db->get_compiled_select();

        // $this->db->select("COUNT(peserta_tender.`id_tender`)");
        // $this->db->from("peserta_tender");
        // $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        // $this->db->where("peserta_tender.npwp = asosiasi.npwp");
        // $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = 2021");
        // $tahun_lalu = $this->db->get_compiled_select();

        $this->db->select("ROUND(((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`hasil`, 0))*100)/SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`nilai_hps`, 0))),1) AS penurunan_hps");
        $this->db->from('asosiasi');
        $this->db->join("anggota_asosiasi", "anggota_asosiasi.npwp = asosiasi.npwp");
        $this->db->join("ratahps", "ratahps.`npwp` = asosiasi.`npwp`", "left");
        $this->db->join("peserta_tender", "peserta_tender.`npwp` = asosiasi.`npwp`", "left");
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`", "left");
        $this->db->where("anggota_asosiasi.id_pengguna = $id_pengguna");
        $this->db->group_by("asosiasi.`id_anggota` ");
        if ($search['tahun'] != "") {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("ratahps.tahun = '$tahun'");
            }
        }
        $total_penurunan = $this->db->get_compiled_select();

        // $this->select;
        // SELECT SUM(`hasil`)
        // FROM ratahps
        // LEFT JOIN asosiasi ON ratahps.`npwp` = asosiasi.`npwp`
        // WHERE asosiasi.`id_pengguna`
        // $this->db->select("SUM(($tahun_skrg))-sum(($tahun_lalu))");
        // $this->db->from();
        $this->db->select("SUM(`hasil`)");
        $this->db->from('ratahps');
        $this->db->join('asosiasi', 'ratahps.npwp = asosiasi.npwp');
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        if ($search['tahun'] != "") {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("ratahps.tahun = '$tahun'");
            }
        }
        $total_penurunan = $this->db->get_compiled_select();
        // SELECT SUM(nilai_hps)
        // FROM ratahps
        // LEFT JOIN asosiasi ON ratahps.`npwp` = asosiasi.`npwp`
        // WHERE asosiasi.`id_pengguna` = 3230694
        $this->db->select('SUM(nilai_hps)');
        $this->db->from('ratahps');
        $this->db->join('asosiasi', 'ratahps.npwp = asosiasi.npwp');
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        if ($search['tahun'] != "") {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("ratahps.tahun = '$tahun'");
            }
        }
        $total_nilai_hps = $this->db->get_compiled_select();

        //PERSENAN MULAI DARI SINIIIIII//

        //total_ikut
        $this->db->select("COUNT(peserta_tender.`id_tender`)");
        $this->db->from("peserta_tender");
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
        $this->db->where("peserta_tender.harga_penawaran != 0 ");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '2021'");
        if ($search['tahun'] != '') {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = ($tahun-1)");
            }
        } else {
            $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = (YEAR(NOW())-1)");
        }
        $sub_total_ikut_lalu = $this->db->get_compiled_select();

        //total_ikut_semua
        $this->db->select("SUM(($sub_total_ikut_lalu))");
        $this->db->from("asosiasi");
        $total_ikut_semua_lalu = $this->db->get_compiled_select();

        //total_ikut
        $this->db->select("COUNT(peserta_tender.`id_tender`)");
        $this->db->from("peserta_tender");
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
        $this->db->where("peserta_tender.harga_penawaran != 0 ");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '2022'");
        if ($search['tahun'] != '') {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
            }
        } else {
            $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = (YEAR(NOW()))");
        }
        $sub_total_ikut_skrg = $this->db->get_compiled_select();

        //total_ikut_semua
        $this->db->select("SUM(($sub_total_ikut_skrg))");
        $this->db->from("asosiasi");
        $total_ikut_semua_skrg = $this->db->get_compiled_select();

        //menang - tahun sekarang
        $this->db->select("COUNT(id_pemenang)");
        $this->db->from("pemenang");
        $this->db->where("npwp = asosiasi.`npwp`");
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '2022'");
        if ($search['tahun'] != '') {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
            }
        } else {
            $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = (YEAR(NOW()))");
        }
        $sub_menang_skrg = $this->db->get_compiled_select();

        //total menang
        $this->db->select("SUM(($sub_menang_skrg))");
        $this->db->from("asosiasi");
        $total_menang_skrg = $this->db->get_compiled_select();

        //menang - tahun lalu
        $this->db->select("COUNT(id_pemenang)");
        $this->db->from("pemenang");
        $this->db->where("npwp = asosiasi.`npwp`");
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '2021'");
        if ($search['tahun'] != '') {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = ($tahun-1)");
            }
        } else {
            $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = (YEAR(NOW())-1)");
        }
        $sub_menang_lalu = $this->db->get_compiled_select();

        //total menang
        $this->db->select("SUM(($sub_menang_lalu))");
        $this->db->from("asosiasi");
        $total_menang_lalu = $this->db->get_compiled_select();

        //kalah - sekarang
        $this->db->select("COUNT(id_pemenang)");
        $this->db->from("pemenang");
        $this->db->where("pemenang.id_tender IN ($sub_kalah)");
        $this->db->where("npwp != asosiasi.`npwp`");
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '2022'");
        if ($search['tahun'] != '') {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
            }
        } else {
            $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = (YEAR(NOW()))");
        }
        $kalah_skrg = $this->db->get_compiled_select();

        //total kalah
        $this->db->select("SUM(($kalah_skrg))");
        $this->db->from("asosiasi");
        $total_kalah_skrg = $this->db->get_compiled_select();

        //kalah - lalu
        $this->db->select("COUNT(id_pemenang)");
        $this->db->from("pemenang");
        $this->db->where("pemenang.id_tender IN ($sub_kalah)");
        $this->db->where("npwp != asosiasi.`npwp`");
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        // $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '2021'");
        if ($search['tahun'] != '') {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = ($tahun-1)");
            }
        } else {
            $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = (YEAR(NOW())-1)");
        }
        $kalah_lalu = $this->db->get_compiled_select();

        //total kalah
        $this->db->select("SUM(($kalah_lalu))");
        $this->db->from("asosiasi");
        $total_kalah_lalu = $this->db->get_compiled_select();

        $this->db->select("SUM(`hasil`)");
        $this->db->from('ratahps');
        $this->db->join('asosiasi', 'ratahps.npwp = asosiasi.npwp');
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // $this->db->where("ratahps.tahun = '2022'");
        if ($search['tahun'] != '') {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("ratahps.tahun = '$tahun'");
            }
        } else {
            $this->db->where("ratahps.tahun = (YEAR(NOW()))");
        }
        $total_penurunan_skrg = $this->db->get_compiled_select();
        // SELECT SUM(nilai_hps)
        // FROM ratahps
        // LEFT JOIN asosiasi ON ratahps.`npwp` = asosiasi.`npwp`
        // WHERE asosiasi.`id_pengguna` = 3230694
        $this->db->select('SUM(nilai_hps)');
        $this->db->from('ratahps');
        $this->db->join('asosiasi', 'ratahps.npwp = asosiasi.npwp');
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        $this->db->where("ratahps.tahun = '2022'");
        if ($search['tahun'] != '') {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("ratahps.tahun = '$tahun'");
            }
        } else {
            $this->db->where("ratahps.tahun = (YEAR(NOW()))");
        }
        $total_nilai_hps_skrg = $this->db->get_compiled_select();

        $this->db->select("SUM(`hasil`)");
        $this->db->from('ratahps');
        $this->db->join('asosiasi', 'ratahps.npwp = asosiasi.npwp');
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // $this->db->where("ratahps.tahun = '2021'");
        if ($search['tahun'] != '') {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("ratahps.tahun = ($tahun-1)");
            }
        } else {
            $this->db->where("ratahps.tahun = (YEAR(NOW())-1)");
        }
        $total_penurunan_lalu = $this->db->get_compiled_select();
        // SELECT SUM(nilai_hps)
        // FROM ratahps
        // LEFT JOIN asosiasi ON ratahps.`npwp` = asosiasi.`npwp`
        // WHERE asosiasi.`id_pengguna` = 3230694
        $this->db->select('SUM(nilai_hps)');
        $this->db->from('ratahps');
        $this->db->join('asosiasi', 'ratahps.npwp = asosiasi.npwp');
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // $this->db->where("ratahps.tahun = '2021'");
        if ($search['tahun'] != "") {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("ratahps.tahun = ($tahun-1)");
            }
        } else {
            $this->db->where("ratahps.tahun = (YEAR(NOW())-1)");
        }
        $total_nilai_hps_lalu = $this->db->get_compiled_select();

        // $this->db->select("SUM(($tahun_skrg))");
        // // $this->db->form("asosiasi");
        // $tender_tahun_skrg = $this->db->get_compiled_select();

        // $this->db->select("SUM(($tahun_lalu))");
        // // $this->db->form("asosiasi");
        // $tender_tahun_lalu = $this->db->get_compiled_select();

        // $this->db->select("ROUND((($tender_tahun_skrg)-($tender_tahun_lalu)*100)/($tender_tahun_lalu),1)");
        // // $this->db->from("asosiasi");
        // $persen_ikut_tender = $this->db->get_compiled_select();
        $this->db->select("ROUND(($total_ikut_semua)/($total_anggota),1) as rata_ikut_tender");
        $this->db->select("ROUND(($total_menang)/($total_anggota),1) as rata_menang_tender");
        $this->db->select("ROUND(($total_kalah)/($total_anggota),1) as rata_kalah_tender");
        $this->db->select("ROUND((($total_penurunan)*100)/($total_nilai_hps),1) as rata_penurunan_hps");
        // $this->db->select("ROUND((($total_ikut_semua)-($total_ikut_semua_lalu)),1) as persen_ikut_tender");
        $this->db->select("ROUND(((($total_ikut_semua_skrg)-($total_ikut_semua_lalu))*100)/($total_ikut_semua_lalu),1) as persen_ikut_tender");
        $this->db->select("ROUND(((($total_menang_skrg)-($total_menang_lalu))*100)/($total_menang_lalu),1) as persen_menang_tender");
        $this->db->select("ROUND(((($total_kalah_skrg)-($total_kalah_lalu))*100)/($total_kalah_lalu),1) as persen_kalah_tender");
        // $this->db->select("(ROUND((($total_penurunan_lalu)*100)/($total_nilai_hps_lalu),1))+(ROUND((($total_penurunan_skrg)*100)/($total_nilai_hps_skrg),1))/2");
        $this->db->select("ROUND((ROUND((($total_penurunan_skrg)*100)/($total_nilai_hps_skrg),1)+ROUND((($total_penurunan_lalu)*100)/($total_nilai_hps_lalu),1))/2,1) as persen_penurunan_tender");
        // $this->db->select("(sum(($tahun_skrg))-sum(($tahun_lalu))) as total_ikut_tahun_ini");
        // $this->db->select("round((((sum(($tahun_skrg)))-(sum(($tahun_lalu))))*100)/sum(($tahun_lalu)),1) as persen_ikut_tender");
        // $this->db->select("round((((sum(($tahun_skrg)))+(sum(($tahun_lalu))))/2),1) as rata");
        $this->db->from("asosiasi");
        $query = $this->db->get();
        return $query->result_array();
    }

    // get data in asosiasi where id pengguna is id pengguna in asosiasi
    public function getAsosiasiAnggota ($id_pengguna)
    {
        $this->db->select('*');
        $this->db->from('asosiasi');
        $this->db->where('id_pengguna', $id_pengguna);
        $query = $this->db->get();
        return $query->result_array();
    }

    // get data in anggota_asosiasi where id pengguna is id pengguna in asosiasi and then join peserta tender to get name of peserta using npwp
    public function getAnggotaAsosiasi ($id_pengguna)
    {

        //total_ikut
        // $this->db->select("COUNT(peserta_tender.`kode_tender`)");
        // $this->db->from("peserta_tender");
        // $this->db->join("paket", "paket.`kode_tender` = peserta_tender.`kode_tender`");
        // $this->db->where("peserta_tender.`npwp` = anggota_asosiasi.`npwp`");
        // $this->db->where("peserta_tender.harga_penawaran != 0 ");
        // $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // if ($search['tahun']) {
        //     $tahun = $search['tahun'];
        //     if ($tahun) {
        //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
        //     }
        // }
        // $sub_total_ikut = $this->db->get_compiled_select();

        //total_ikut_semua
        // $this->db->select("SUM(($sub_total_ikut))");
        // $this->db->from("asosiasi");
        // $total_ikut_semua = $this->db->get_compiled_select();

        //menang
        // $this->db->select("COUNT(id_pemenang)");
        // $this->db->from("pemenang");
        // $this->db->where("npwp = anggota_asosiasi.`npwp`");
        // $this->db->join("anggota_asosiasi", "pemenang.npwp = anggota_asosiasi.npwp");
        // $this->db->where("pemenang.`npwp` = anggota_asosiasi.`npwp`");
        // $this->db->join("tender", "pemenang.kode_tender = tender.kode_tender");
        // $this->db->join("asosiasi", "anggota_asosiasi.id_pengguna = asosiasi.id_pengguna");
        // $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // if ($search['tahun']) {
        //     $tahun = $search['tahun'];
        //     if ($tahun) {
        //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
        //     }
        // }
        // $sub_menang = $this->db->get_compiled_select();
        

        //total menang
        // $this->db->select("SUM(($sub_menang))");
        // $this->db->from("asosiasi");
        // $total_menang = $this->db->get_compiled_select();

        $this->db->select('count(id_pemenang)');
        $this->db->from('pemenang');
        $this->db->where('npwp = anggota_asosiasi.`npwp`');
        $this->db->join("paket", "pemenang.kode_tender = paket.kode_tender");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // if ($search['tahun']) {
        //     $tahun = $search['tahun'];
        //     if ($tahun) {
        //         $this->db->where("tahun LIKE '$tahun'");
        //     }
        // }
        // if ($search['lpse']) {
        //     $lpse = $search['lpse'];
        //     if ($lpse) {
        //         $this->db->where("tender.id_lpse = '$lpse'");
        //     }
        // }
        $menang = $this->db->get_compiled_select();

        //perusahaan dengan harga_penawaran !=0
        // $this->db->select("peserta_tender.kode_tender");
        // $this->db->from("peserta_tender");
        // $this->db->where("npwp = anggota_asosiasi.`npwp`");
        // $this->db->where("harga_penawaran !=0");
        // $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // $this->db->join("paket", "peserta_tender.kode_tender = paket.kode_tender");
        // $sub_kalah = $this->db->get_compiled_select();

        //kalah
        // $this->db->select("COUNT(id_pemenang)");
        // $this->db->from("pemenang");
        // $this->db->where("pemenang.kode_tender IN ($sub_kalah)");
        // $this->db->where("npwp != asosiasi.`npwp`");
        // $this->db->join("paket", "pemenang.kode_tender = paket.kode_tender");
        // if ($search['tahun']) {
        //     $tahun = $search['tahun'];
        //     if ($tahun) {
        //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
        //     }
        // }
        // if ($search['lpse']) {
        //     $lpse = $search['lpse'];
        //     if ($lpse) {
        //         $this->db->where("tender.id_lpse = '$lpse'");
        //     }
        // }
        // $kalah = $this->db->get_compiled_select();

        //total kalah
        // $this->db->select("SUM(($kalah))");
        // $this->db->from("asosiasi");
        // $total_kalah = $this->db->get_compiled_select();

        $this->db->select("kode_tender");
        $this->db->from("peserta_tender");
        $this->db->where("npwp = anggota_asosiasi.npwp");
        $this->db->where("harga_penawaran !=0");
        $id_tender = $this->db->get_compiled_select();

        $this->db->select('COUNT(id_pemenang)');
        $this->db->from('pemenang');
        $this->db->join("paket", "pemenang.kode_tender = paket.kode_tender");
        $this->db->where("pemenang.kode_tender IN ($id_tender) ");
        $this->db->where("npwp != anggota_asosiasi.`npwp`");
        // if ($search['tahun']) {
        //     $tahun = $search['tahun'];
        //     if ($tahun) {
        //         $this->db->where("tahun LIKE '$tahun'");
        //     }
        // }
        // if ($search['lpse']) {
        //     $lpse = $search['lpse'];
        //     if ($lpse) {
        //         $this->db->where("tender.id_lpse = '$lpse'");
        //     }
        // }
        $kalah = $this->db->get_compiled_select();

        $this->db->select('COUNT(peserta_tender.`kode_tender`)');
        $this->db->from('peserta_tender');
        $this->db->join("paket", "paket.`kode_tender` = peserta_tender.`kode_tender`");
        $this->db->where("peserta_tender.`npwp` = anggota_asosiasi.`npwp`");
        $this->db->where("peserta_tender.harga_penawaran != 0 ");
        $this->db->where("paket.status_tender NOT IN ('Tender Sudah Selesai','Selesai','Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal')");
        // if ($search['tahun']) {
        //     $tahun = $search['tahun'];
        //     if ($tahun) {
        //         $this->db->where("tahun LIKE '$tahun'");
        //     }
        // }
        // if ($search['lpse']) {
        //     $lpse = $search['lpse'];
        //     if ($lpse) {
        //         $this->db->where("id_lpse = '$lpse'");
        //     }
        // }
        $ikut = $this->db->get_compiled_select();



        $this->db->select('anggota_asosiasi.*, peserta.nama_peserta');
        $this->db->select("($ikut) as total_ikut");
        $this->db->select("($menang) as total_menang");
        $this->db->select("($kalah) as total_kalah");
        $this->db->from('anggota_asosiasi');
        $this->db->join('peserta', 'anggota_asosiasi.npwp = peserta.npwp');
        $this->db->join('asosiasi', 'anggota_asosiasi.id_pengguna = asosiasi.id_pengguna');
        $this->db->where('anggota_asosiasi.id_pengguna', $id_pengguna);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataCharts($id_pengguna) {
        //menang
        $this->db->select("COUNT(id_pemenang)");
        $this->db->from("pemenang");
        $this->db->where("npwp = asosiasi.`npwp`");
        $this->db->join("paket", "pemenang.kode_tender = paket.kode_tender");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // if ($search['tahun']) {
        //     $tahun = $search['tahun'];
        //     if ($tahun) {
        //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
        //     }
        // }
        // if ($search['lpse']) {
        //     $lpse = $search['lpse'];
        //     if ($lpse) {
        //         $this->db->where("tender.id_lpse = '$lpse'");
        //     }
        // }
        $sub_menang = $this->db->get_compiled_select();

        //total menang
        $this->db->select("SUM(($sub_menang))");
        $this->db->from("asosiasi");
        $total_menang = $this->db->get_compiled_select();

        //perusahaan dengan harga_penawaran !=0
        $this->db->select("peserta_tender.kode_tender");
        $this->db->from("peserta_tender");
        $this->db->where("npwp = asosiasi.`npwp`");
        $this->db->where("harga_penawaran !=0");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        $this->db->join("paket", "peserta_tender.kode_tender = paket.kode_tender");
        $sub_kalah = $this->db->get_compiled_select();

        //kalah
        $this->db->select("COUNT(id_pemenang)");
        $this->db->from("pemenang");
        $this->db->where("pemenang.kode_tender IN ($sub_kalah)");
        $this->db->where("npwp != asosiasi.`npwp`");
        $this->db->join("paket", "pemenang.kode_tender = paket.kode_tender");
        // if ($search['tahun']) {
        //     $tahun = $search['tahun'];
        //     if ($tahun) {
        //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
        //     }
        // }
        // if ($search['lpse']) {
        //     $lpse = $search['lpse'];
        //     if ($lpse) {
        //         $this->db->where("tender.id_lpse = '$lpse'");
        //     }
        // }
        $kalah = $this->db->get_compiled_select();

        //total kalah
        $this->db->select("SUM(($kalah))");
        $this->db->from("asosiasi");
        $total_kalah = $this->db->get_compiled_select();

        //ikut
        $this->db->select('COUNT(peserta_tender.`kode_tender`)');
        $this->db->from('peserta_tender');
        $this->db->join("paket", "paket.`kode_tender` = peserta_tender.`kode_tender`");
        $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
        $this->db->where("peserta_tender.harga_penawaran != 0 ");
        $this->db->where("paket.status_tender NOT IN ('Tender Sudah Selesai','Selesai','Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal')");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // if ($search['tahun']) {
        //     $tahun = $search['tahun'];
        //     if ($tahun) {
        //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
        //     }
        // }
        // if ($search['lpse']) {
        //     $lpse = $search['lpse'];
        //     if ($lpse) {
        //         $this->db->where("id_lpse = '$lpse'");
        //     }
        // }
        $ikut = $this->db->get_compiled_select();

        //total kalah
        $this->db->select("SUM(($ikut))");
        $this->db->from("asosiasi");
        $total_ikut = $this->db->get_compiled_select();

        //total_ikut
        $this->db->select("COUNT(peserta_tender.`kode_tender`)");
        $this->db->from("peserta_tender");
        $this->db->join("paket", "paket.`kode_tender` = peserta_tender.`kode_tender`");
        $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
        $this->db->where("peserta_tender.harga_penawaran != 0 ");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        // $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '2021'");
        // if ($search['tahun']) {
        //     $tahun = $search['tahun'];
        //     if ($tahun) {
        //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS DATE) = '$tahun'");
        //     }
        // }
        // if ($search['lpse']) {
        //     $lpse = $search['lpse'];
        //     if ($lpse) {
        //         $this->db->where("id_lpse = '$lpse'");
        //     }
        // }
        $sub_total_ikut = $this->db->get_compiled_select();

        //total_ikut_semua
        $this->db->select("SUM(($sub_total_ikut))");
        $this->db->from("asosiasi");
        $total_ikut_semua = $this->db->get_compiled_select();

        // $this->db->select("*");
        $this->db->select("($total_menang) as total_menang");
        $this->db->select("($total_kalah) as total_kalah");
        $this->db->select("($total_ikut) as total_ikut");
        $this->db->select("($total_ikut_semua) as total_ikut_semua");
        $this->db->from("asosiasi");
        $this->db->where("asosiasi.id_pengguna = $id_pengguna");
        $query = $this->db->get();
        return $query->result_array();
    }
}
