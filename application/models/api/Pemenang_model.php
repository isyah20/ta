<?php

use Google\Service\CloudSearch\Resource\Query;

defined('BASEPATH') or exit('No direct script access allowed');

class Pemenang_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPemenang()
    {
        $query = $this->db->get('pemenang');
        return $query->result_array();
    }

    public function getPemenangById($id)
    {
        $query = $this->db->get_where('pemenang', ['id_pemenang' => $id]);
        return $query->result_array();
    }
    public function getPemenangByIdTender($id)
    {
        $this->db->select('*');
        $this->db->from('pemenang');
        $this->db->where('pemenang.id_tender', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPemenangByNPWP($npwp)
    {
        $query = $this->db->get_where('pemenang', ['npwp' => $npwp]);
        return $query->row();
    }

    public function tambahPemenang($data)
    {
        $this->db->insert('pemenang', $data);
        return $this->db->insert_id();
    }

    public function ubahPemenang($id, $data_new)
    {
        $this->db->where('id_pemenang', $id);
        $this->db->update('pemenang', $data_new);
        return $this->db->affected_rows();
    }

    public function hapusPemenang($id)
    {
        $this->db->where('id_pemenang', $id);
        return $this->db->delete('pemenang');
    }

    public function getAllPemenangbyLpse($id)
    {
        $id = json_decode(str_replace('&quot;', '', $id), true);
        // var_dump($id);
        $this->db->select('pemenang.*, pemenang.npwp as npwp_peserta, tender.nama_tender,tender.id_lpse,tender.nilai_hps, peserta.*');
        $this->db->from('pemenang');
        $this->db->join('peserta', 'pemenang.npwp = peserta.npwp');
        $this->db->join('tender', 'pemenang.id_tender = tender.id_tender');
        $this->db->where_in('tender.id_lpse', $id);
        $this->db->group_by('pemenang.npwp');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllPemenangbyLpseA()
    {
        $this->db->select('pemenang.*, pemenang.npwp as npwp_peserta, tender.nama_tender,tender.id_lpse,tender.nilai_hps, peserta.*');
        $this->db->from('pemenang');
        $this->db->join('peserta', 'pemenang.npwp = peserta.npwp');
        $this->db->join('tender', 'pemenang.id_tender = tender.id_tender');
        $this->db->group_by('pemenang.npwp');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllPemenangbyIdTahapan()
    {
        // $this->db->select('id_tender, id_peserta, tgl_mulai, npwp, nama_peserta, alamat, kelurahan, kecamatan,kabupaten,provinsi,kode_klu,klu,no_telp,email,nilai_hps,nama_tender,id_lpse,id_tahapan');
        // $this->db->from('view_supplier_jadwal');
        // $this->db->where("DATEDIFF(tgl_mulai,'2021-06-21 08:00:00') <= 7 AND DATEDIFF(tgl_mulai,'2021-06-21 08:00:00') >= 0 AND id_tahapan = '12'");
        $this->db->select('*');
        $this->db->from('supplier_jadwal');
        // $this->db->limit(3, 0);
        // $this->db->select("`pemenang`.*, `pemenang`.`npwp` AS  `npwp_peserta`, `tender`.`nama_tender`, `tender`.`id_lpse`,`tender`.`nilai_hps`, `peserta`.`nama_peserta`,peserta.`alamat`, peserta.`email`, peserta.`no_telp` , jadwal.`id_tahapan`,jadwal.`tgl_mulai`");
        // $this->db->from("pemenang");
        // $this->db->join("peserta", "`pemenang`.`npwp` = `peserta`.`npwp`");
        // $this->db->join("tender", "`pemenang`.`id_tender` = `tender`.`id_tender`");
        // $this->db->join("jadwal", "pemenang.`id_tender` = jadwal.`id_tender`");
        // $this->db->where("DATEDIFF(tgl_mulai,'2021-06-21 08:00:00') <= 7 AND DATEDIFF(tgl_mulai,'2021-06-21 08:00:00') >= 0 AND id_tahapan = '12'");
        return $this->db->get()->result_array();
    }

    public function id_jenistender()
    {
        $this->db->select("id_jenis, COUNT(id_jenis) AS jumlah");
        $this->db->from("tender");
        $this->db->group_by("id_jenis");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPemenangbyIdTahapanLim($limit, $start)
    {
        // $this->db->select('id_tender, id_peserta, tgl_mulai, npwp, nama_peserta, alamat, kelurahan, kecamatan,kabupaten,provinsi,kode_klu,klu,no_telp,email,nilai_hps,nama_tender,id_lpse,id_tahapan');
        // $this->db->from('view_supplier_jadwal');
        // $this->db->where("DATEDIFF(tgl_mulai,'2021-06-21 08:00:00') <= 7 AND DATEDIFF(tgl_mulai,'2021-06-21 08:00:00') >= 0 AND id_tahapan = '12'");
        // var_dump($limit);
        $this->db->select('*');
        $this->db->from('supplier_list');
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
        // var_dump($this->db->get()->result_array());
    }

    public function getAllPemenangbyIdTahapanID()
    {
        $this->db->select('*');
        $this->db->from('pemenang');
        $this->db->union();
        $this->db->join('peserta', 'pemenang.npwp = peserta.npwp');
        $this->db->join('tender', 'pemenang.id_tender = tender.id_tender');
        $this->db->join('jadwal', 'pemenang.id_tender = jadwal.id_tender');
        // $this->db->where('jadwal.id_tahapan', $id_tahapan);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Know Your Market
    public function getPemenangPerMonthByLpse($klpd, $jenisPengadaan, $hps, $tahun)
    {
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);

        $this->db->select('COUNT(pemenang.id_pemenang) as jumlah_pemenang, DATE_FORMAT(tender.tgl_pembuatan, "%m") as bulan, tender.id_lpse as id_lpse');
        $this->db->from('pemenang');
        $this->db->join('tender', 'pemenang.id_tender = tender.id_tender');
        if ($klpd !== null) {
            $this->db->where_in('id_lpse', $klpd);
        }
        if ($jenisPengadaan !== null) {
            $this->db->where_in('id_jenis', $jenisPengadaan);
        }
        if ($hps !== null) {
            for ($i = 0; $i < count($hps); $i++) {
                if (strpbrk($hps[$i], "/")) {
                    $str = explode("/", $hps[$i]);
                    $this->db->where("nilai_hps >", (int) $str[0]);
                    $this->db->where("nilai_hps <", (int) $str[1]);
                } else {
                    $str = explode("than", $hps[$i]);
                    if (count($str) > 1) {
                        if ($str[0] === "less") {
                            $this->db->where("nilai_hps <", (int) $str[1]);
                        } else {
                            $this->db->where("nilai_hps >", (int) $str[1]);
                        }
                    }
                }
            }
        }
        if ($tahun !== null) {
            $this->db->where_in('DATE_FORMAT(tgl_pembuatan, "%Y")', $tahun);
        }
        $this->db->group_by('DATE_FORMAT(tender.tgl_pembuatan, "%m")');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPemenangTotal()
    {
        // SELECT COUNT(id_tender) FROM tender
        $this->db->select('COUNT(id_tender)');
        $this->db->from('tender');
        // $this->db->where('npwp', $npwp, null, false);
        $totalall = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_pemenang)');
        // $this->db->from('supplier_jadwal');
        // $total_sub = $this->db->get_compiled_select();

        $this->db->select("COUNT(peserta_tender.`id_tender`)");
        $this->db->from("peserta_tender");
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.harga_penawaran != 0", null, false);
        $this->db->where("tender.status NOT IN ('Tender Sudah Selesai','Selesai','Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal')", null, false);
        $aktif = $this->db->get_compiled_select();

        $this->db->select('COUNT(id_tender)');
        $this->db->from('tender');
        $this->db->where('tgl_pembuatan = CURDATE()');
        $total_today = $this->db->get_compiled_select();

        // $this->db->select('COUNT(DATEDIFF(CURDATE(),tgl_mulai))');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('DATEDIFF(CURDATE(),tgl_mulai) = 0');
        // $total_today = $this->db->get_compiled_select();

        $this->db->select("COUNT(id_jenis)");
        $this->db->from("tender");
        $this->db->where("id_jenis = 4");
        $kat_1 = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_kategori)');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('id_kategori = 4');
        // $kat_1 = $this->db->get_compiled_select();

        $this->db->select("COUNT(id_jenis)");
        $this->db->from("tender");
        $this->db->where("id_jenis = 1");
        $kat_2 = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_kategori)');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('id_kategori = 1');
        // $kat_2 = $this->db->get_compiled_select();

        $this->db->select("COUNT(id_jenis)");
        $this->db->from("tender");
        $this->db->where("id_jenis = 7");
        $kat_3 = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_kategori)');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('id_kategori = 7');
        // $kat_3 = $this->db->get_compiled_select();

        $this->db->select("COUNT(id_jenis)");
        $this->db->from("tender");
        $this->db->where("id_jenis = 2");
        $kat_4 = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_kategori)');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('id_kategori = 2');
        // $kat_4 = $this->db->get_compiled_select();

        $this->db->select("COUNT(id_jenis)");
        $this->db->from("tender");
        $this->db->where("id_jenis = 3");
        $kat_5 = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_kategori)');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('id_kategori = 3');
        // $kat_5 = $this->db->get_compiled_select();

        // $this->db->select('COUNT(id_kategori)');
        // $this->db->from('supplier_jadwal');
        // $this->db->where('id_kategori = ');
        // $kat_6 = $this->db->get_compiled_select();

        // $this->db->select('*');
        $this->db->select("($totalall) as totalall");
        // $this->db->select("($total_sub) as total_sub");
        $this->db->select("($total_today) as today");
        $this->db->select("($aktif) as aktif");
        $this->db->select("($kat_1) as kat_1");
        $this->db->select("($kat_2) as kat_2");
        $this->db->select("($kat_3) as kat_3");
        $this->db->select("($kat_4) as kat_4");
        $this->db->select("($kat_5) as kat_5");
        // $this->db->select("($kat_1) as kat_1");
        $this->db->select('COUNT(id_pemenang) AS total');
        $this->db->from('pemenang');
        // $this->db->join('tender', 'tender.id_tender = peserta_tender.id_tender');
        // $this->db->where('peserta_tender.npwp', $npwp);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getdatadinamis($search)
    {
        //menang
        $this->db->select("COUNT(id_pemenang)");
        $this->db->from("pemenang");
        $this->db->where("npwp = asosiasi.`npwp`");
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '$tahun'");
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
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '$tahun'");
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
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '$tahun'");
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
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '$tahun'");
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
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '$tahun'");
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
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = '$tahun-1'");
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

        $this->db->select("*");
        $this->db->select("($total_menang) as total_menang");
        $this->db->select("($total_kalah) as total_kalah");
        $this->db->select("($total_ikut) as total_ikut");
        $this->db->select("($total_ikut_semua) as total_ikut_semua");
        // $this->db->select("($total_naik_ikut) as total_naik");
        // $this->db->select("ROUND((($total_naik_ikut)/($sub_ikut_skrng)),2) as persen");
        $this->db->from("asosiasi");
        // $this->db->order_by("asosiasi.npwp");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getdatadinamisavg($search)
    {
        $this->db->select("COUNT(peserta_tender.`id_tender`)");
        $this->db->from("peserta_tender");
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.npwp = asosiasi.npwp");
        $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = 2022");
        // if ($search['tahun']) {
        //     $tahun = $search['tahun'];
        //     if ($tahun) {
        //         $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = 2022");
        //     }
        // }
        // if ($search['lpse']) {
        //     $lpse = $search['lpse'];
        //     if ($lpse) {
        //         $this->db->where("id_lpse = '$lpse'");
        //     }
        // }
        $tahun_skrg = $this->db->get_compiled_select();

        $this->db->select("COUNT(peserta_tender.`id_tender`)");
        $this->db->from("peserta_tender");
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.npwp = asosiasi.npwp");
        $this->db->where("CAST(SUBSTRING(tender.tgl_pembuatan, 1, 4)AS INT) = 2021");
        $tahun_lalu = $this->db->get_compiled_select();

        // $this->db->select("SUM(($tahun_skrg))-sum(($tahun_lalu))");
        // $this->db->from();

        // $this->db->select("SUM(($tahun_skrg))");
        // // $this->db->form("asosiasi");
        // $tender_tahun_skrg = $this->db->get_compiled_select();

        // $this->db->select("SUM(($tahun_lalu))");
        // // $this->db->form("asosiasi");
        // $tender_tahun_lalu = $this->db->get_compiled_select();

        // $this->db->select("ROUND((($tender_tahun_skrg)-($tender_tahun_lalu)*100)/($tender_tahun_lalu),1)");
        // // $this->db->from("asosiasi");
        // $persen_ikut_tender = $this->db->get_compiled_select();

        $this->db->select("(sum(($tahun_skrg))-sum(($tahun_lalu))) as total_ikut_tahun_ini");
        $this->db->select("round((((sum(($tahun_skrg)))-(sum(($tahun_lalu))))*100)/sum(($tahun_lalu)),1) as persen_ikut_tender");
        $this->db->select("round((((sum(($tahun_skrg)))+(sum(($tahun_lalu))))/2),1) as rata_ikut_tender");
        $this->db->from("asosiasi");
        $query = $this->db->get();
        return $query->result_array();
    }
}
