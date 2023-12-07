<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PesertaTenderModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPesertaTender()
    {
        $query = $this->db->get('peserta_tender');

        return $query->result_array();
    }

    public function getPesertaTenderById($id)
    {
        $this->db->select('*');
        $this->db->from('peserta_tender');
        $this->db->where('peserta_tender.id_peserta_tender', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPesertaTenderByIdTender($id)
    {
        $this->db->select('peserta_tender.*, peserta.nama_peserta, pemenang.harga_kontrak');
        $this->db->from('peserta_tender');
        $this->db->join('peserta', 'peserta.npwp = peserta_tender.npwp', 'left');
        $this->db->join("(SELECT npwp, harga_kontrak FROM pemenang WHERE pemenang.kode_tender = $id) pemenang", 'pemenang.npwp = peserta_tender.npwp', 'left');
        $this->db->where('peserta_tender.kode_tender', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCountPesertaTenderByIdTender($id)
    {
        $sql = "SELECT COUNT(*) AS peserta FROM peserta_tender WHERE id_tender = ?";
        $query = $this->db->query($sql, $id);
        $row = $query->row();
        return $row->peserta;
    }

    public function getTenderById($id)
    {
        $query = $this->db->get_where('id_tender', ['id_tender' => $id]);

        return $query->row();
    }

    // public function getPesertaTenderById($id)
    // {
    // 	$query = $this->db->get_where('peserta_tender', ['id_peserta_tender' => $id]);

    // 	return $query->row();
    // }

    public function getPesertaTenderMonthly($npwp)
    {
        $this->db->select('*');
        $this->db->from('peserta_tender');
        $this->db->select('CAST(SUBSTRING(paket.tanggal_pembuatan, 6, 2)as DATE) as month');
        $this->db->select('count(paket.kode_tender) as count');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where('peserta_tender.npwp', $npwp);
        $this->db->group_by('month');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPesertaTenderAnnual($npwp)
    {
        $this->db->select('*');
        $this->db->from('peserta_tender');
        $this->db->select('CAST(SUBSTRING(paket.tanggal_pembuatan, 6, 2)as DATE) as month');
        $this->db->select('count(paket.kode_tender) as count');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where('peserta_tender.npwp', $npwp);
        $this->db->group_by('paket.kode_tender');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPesertaTenderFilter($data)
    {
        $klpd = $data['id_lpse'];
        $tahun = $data['tahun'];
        // $klpd = json_decode(str_replace('&quot;', '', $data['id_lpse']), true);
        // $tahun = json_decode(str_replace('&quot;', '', $data['tahun']), true);

        // print_r($tahun);
        // print_r($klpd);
        // $tahun = 2022;
        // $data['npwp'] = '02.750.385.3-013.000';

        $this->db->select('*');
        // $this->db->select('CAST(SUBSTRING(paket.tanggal_pembuatan, 6, 2) AS DATE) AS month');
        // $this->db->select('CAST(SUBSTRING(paket.tanggal_pembuatan, 1, 4) AS DATE) AS year');
        $this->db->select('count(paket.kode_tender) AS count');
        $this->db->from('peserta_tender');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where('peserta_tender.npwp', $data['npwp']);
        if ($tahun != null) {
            $this->db->where('YEAR(paket.tanggal_pembuatan)', $tahun);
        }
        if ($klpd != null) {
            $this->db->where('id_lpse', $klpd);
        }
        // $this->db->where_in('id_lpse', $klpd);
        $this->db->group_by('paket.kode_tender');
        $query = $this->db->get();
        // var_dump($query->result_array());
        return $query->result_array();
    }

    public function getPesertaPemenangTenderFilter($data)
    {
        $this->db->select('*');
        $this->db->select("CASE WHEN pemenang.npwp = peserta_tender.npwp THEN 'true' ELSE 'false' END AS status_pemenang");
        $this->db->select('SUBSTRING(paket.tanggal_pembuatan, 6, 2) AS month');
        $this->db->select('SUBSTRING(paket.tanggal_pembuatan, 1, 4) AS year');
        $this->db->from('peserta_tender');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->join('pemenang', 'pemenang.kode_tender = peserta_tender.kode_tender');
        if (!empty($data['npwp'])) {
            $this->db->where('peserta_tender.npwp', $data['npwp']);
        }
        if (!empty($data['tahun'])) {
            $this->db->where('YEAR(paket.tanggal_pembuatan)', $data['tahun']);
        }
        if (!empty($data['id_lpse'])) {
            $this->db->where('paket.id_lpse', $data['id_lpse']);
        }
        $query = $this->db->get();
        return $query->result_array();
        // var_dump($data['tahun'], $query->result_array());
    }
    public function getJumlahTenderFilter($data)
    {
        $this->db->select('kode_tender');
        $this->db->distinct();
        // $this->db->select("CASE WHEN pemenang.npwp = peserta_tender.npwp THEN 'true' ELSE 'false' END AS status_pemenang");
        // $this->db->select('SUBSTRING(paket.tanggal_pembuatan, 6, 2) AS month');
        // $this->db->select('SUBSTRING(paket.tanggal_pembuatan, 1, 4) AS year');
        $this->db->from('paket');
        // $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        // $this->db->join('pemenang', 'pemenang.kode_tender = peserta_tender.kode_tender');
        // if (!empty($data['npwp'])) {
        //     $this->db->where('peserta_tender.npwp', $data['npwp']);
        // }
        if (!empty($data['tahun'])) {
            $this->db->where('YEAR(paket.tanggal_pembuatan)', $data['tahun']);
        }
        if (!empty($data['id_lpse'])) {
            $this->db->where('paket.id_lpse', $data['id_lpse']);
        }
        $query = $this->db->get();
        return $query->num_rows();
        // var_dump($data['tahun'], $query->result_array());
    }
    // public function getPesertaTenderFilter($data)
    // {
    //     // $data = [
    //     //     'npwp' => '01.882.135.5-027.000',
    //     // ];
    // 	// $klpd = '713';
    // 	// $tahun = 2021;

    // 	$this->db->select('*');
    // 	$this->db->select('SUBSTRING(paket.tanggal_pembuatan, 6, 2) as month');
    // 	$this->db->select('SUBSTRING(paket.tanggal_pembuatan, 1, 4) as year');
    // 	$this->db->select('count(paket.kode_tender) as count');
    // 	$this->db->from('peserta_tender');
    // 	$this->db->join('paket', 'paket.kode_tender = peserta_paket.kode_tender');
    // 	$this->db->where('peserta_tender.npwp', $data['npwp']);
    // 	if ($data['tahun'] != null) {
    // 		$this->db->where("YEAR(`tgl_pembuatan`) = $data[tahun] ", NULL, FALSE);
    // 	}
    // 	$this->db->where_in('id_lpse', $data['klpd']);
    // 	$this->db->group_by('paket.kode_tender');
    // 	// $query = json_encode($this->db->get()->result());
    // 	$query = $this->db->get()->result();
    //     return $query;
    // 	// echo($query);

    // }

    public function getPesertaTenderFilterKlpd($data)
    {
        $klpd = json_decode(str_replace('&quot;', '', $data['klpd']), true);

        $this->db->select('*');
        $this->db->from('peserta_tender');
        $this->db->select('CAST(SUBSTRING(paket.tanggal_pembuatan, 6, 2)as DATE) as month');
        $this->db->select('count(paket.kode_tender) as count');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.id_tender');
        $this->db->where('peserta_tender.npwp', $data['npwp']);
        $this->db->where_in('paket.id_lpse', $klpd);
        $this->db->group_by('paket.kode_tender');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPesertaCompetitor($data)
    {
        $status = ['Tender Sudah Selesai', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal', 'Gagal', 'Selesai'];
        $npwp = $data['npwp'];

        // $this->db->select('id_tender');
        // $this->db->from('peserta_tender');
        // $this->db->where('npwp', $npwp, null, false);
        // $this->db->where("peserta_tender.harga_penawaran != 0", NULL, FALSE);
        // $sub1 = $this->db->get_compiled_select();

        // $this->db->select('peserta_tender.npwp');
        // $this->db->from('peserta_tender');
        // // $this->db->join('paket', 'paket.kode_tender = peserta_tender.id_tender');
        // // $this->db->where("peserta_tender.id_tender IN ($sub1)", NULL, FALSE);
        // // $this->db->where("peserta_tender.harga_penawaran != 0", NULL, FALSE);
        // $this->db->where("peserta_tender.npwp != ($npwp)", NULL, FALSE);
        // // $this->db->where_not_in('paket.status', $status);
        // $this->db->group_by('peserta_tender.npwp');
        // $sub2 = $this->db->get_compiled_select();

        $this->db->select('*');
        $this->db->from('peserta');
        // $this->db->where("`npwp` IN ($sub2)", NULL, FALSE);
        $this->db->where_not_in('npwp', $npwp, null, false);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPesertaTendertotal($npwp)
    {
        $status = ['Tender Sudah Selesai', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal', 'Gagal', 'Selesai'];

        $this->db->select('COUNT(id_pemenang)');
        $this->db->from('pemenang');
        $this->db->where('npwp', $npwp, null, false);
        $menang = $this->db->get_compiled_select();

        $this->db->select('kode_tender');
        $this->db->from('peserta_tender');
        $this->db->where('npwp', $npwp);
        $this->db->where("`harga_penawaran` != 0", null, false);
        $sub_kalah = $this->db->get_compiled_select();

        $this->db->select('COUNT(id_pemenang)');
        $this->db->from('pemenang');
        // $this->db->join('paket', 'paket.kode_tender = peserta_tender.id_tender');
        $this->db->where("`kode_tender` IN ($sub_kalah)", null, false);
        $this->db->where("`npwp` != ($npwp)", null, false);
        // $this->db->where("YEAR(paket.tanggal_pembuatan) = ($tahun)", NULL, FALSE);
        $kalah = $this->db->get_compiled_select();

        $this->db->select('COUNT(peserta_tender.kode_tender)');
        $this->db->from('peserta_tender');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where("peserta_tender.npwp = ($npwp)", null, false);
        $this->db->where("peserta_tender.harga_penawaran != 0", null, false);
        // $this->db->where("`paket`.`status` NOT IN ($status)", NULL, FALSE);
        $this->db->where_not_in('paket.status_tender', $status);
        $ikut = $this->db->get_compiled_select();

        $this->db->select('*');
        $this->db->select("($menang) as menang");
        $this->db->select("($kalah) as kalah");
        $this->db->select("($ikut) as ikut");
        $this->db->select(' COUNT(peserta_tender.kode_tender) AS total');
        $this->db->from('peserta_tender');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where('peserta_tender.npwp', $npwp);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getJumlahMenangKlpd(?string $tahun = null, ?string $npwp = null,  ?string $klpd)
    {
        $this->db->select('COUNT(id_pemenang)');
        $this->db->from('pemenang');
        $this->db->join('paket', 'paket.kode_tender = pemenang.kode_tender');
        $this->db->where('npwp', $npwp, null, false);
        if ($klpd != null) {
            $this->db->where_in('id_lpse', $klpd);
        }
        if ($tahun != null) {
            $this->db->where("YEAR(`paket`.`tanggal_pembuatan`) = ($tahun)", null, false);
        }

        return $this->db->get_compiled_select();
    }

    public function getPesertaTenderFilterAkumulasi($data)
    {
        $klpd = json_decode(str_replace('&quot;', '', $data['klpd']), true);
        $npwp = $data['npwp'];
        $tahun = json_decode(str_replace('&quot;', '', $data['tahun']), true);
        $status = ['Tender Sudah Selesai', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal', 'Gagal', 'Selesai'];

        $this->db->select('COUNT(id_pemenang)');
        $this->db->from('pemenang');
        $this->db->join('paket', 'paket.kode_tender = pemenang.kode_tender');
        $this->db->where('npwp', $npwp, null, false);
        $this->db->where_in('id_lpse', $klpd);
        if ($tahun != null) {
            $this->db->where("YEAR(`paket`.`tanggal_pembuatan`) = ($tahun)", null, false);
        }
        $menang_klpd = $this->db->get_compiled_select();

        $this->db->select('COUNT(id_pemenang)');
        $this->db->from('pemenang');
        $this->db->join('paket', 'paket.kode_tender = pemenang.kode_tender');
        $this->db->where('npwp', $npwp, null, false);
        $this->db->where_in('id_lpse', $klpd);
        if ($tahun != null) {
            $this->db->where("YEAR(`paket`.`tanggal_pembuatan`) = ($tahun)", null, false);
        }
        $menang = $this->db->get_compiled_select();

        $this->db->select('kode_tender');
        $this->db->from('peserta_tender');
        $this->db->where('npwp', $npwp);
        $this->db->where("`harga_penawaran` != 0", null, false);
        $sub_kalah = $this->db->get_compiled_select();

        $this->db->select('COUNT(pemenang.id_pemenang)');
        $this->db->from('pemenang');
        $this->db->join('paket', 'paket.kode_tender = pemenang.kode_tender');
        $this->db->where("paket.kode_tender IN ($sub_kalah)", null, false);
        // $this->db->where("`npwp` != ($npwp)", NULL, FALSE);
        $this->db->where_not_in('npwp', $npwp, null, false);
        $this->db->where_in('id_lpse', $klpd);
        if ($tahun != null) {
            $this->db->where("YEAR(`paket`.`tanggal_pembuatan`) = ($tahun)", null, false);
        }
        $kalah = $this->db->get_compiled_select();

        $this->db->select('COUNT(peserta_tender.kode_tender)');
        $this->db->from('peserta_tender');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where('npwp', $npwp, null, false);
        $this->db->where("peserta_tender.harga_penawaran != 0", null, false);
        $this->db->where_in('paket.id_lpse', $klpd);
        $this->db->where_not_in('paket.status_tender', $status);
        if ($tahun != null) {
            $this->db->where("YEAR(`paket`.`tanggal_pembuatan`) = ($tahun)", null, false);
        }
        $ikut = $this->db->get_compiled_select();

        $this->db->select('COUNT(peserta_tender.kode_tender)');
        $this->db->from('peserta_tender');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where('npwp', $npwp, null, false);
        $this->db->where_in('id_lpse', $klpd);
        if ($tahun != null) {
            $this->db->where("YEAR(`paket`.`tanggal_pembuatan`) = ($tahun)", null, false);
        }
        $total = $this->db->get_compiled_select();

        // $this->db->select('*');
        $this->db->select("($menang) as menang");
        $this->db->select("($menang_klpd) as menang_klpd");
        $this->db->select("($kalah) as kalah");
        $this->db->select("($ikut) as ikut");
        $this->db->select("($total) as total");
        $this->db->from('peserta_tender');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where('peserta_tender.npwp', $npwp);
        $this->db->group_by('peserta_tender.npwp');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPesertaTenderFilterPenurunan($data)
    {
        $klpd = json_decode(str_replace('&quot;', '', $data['klpd']), true);
        $tahun = json_decode(str_replace('&quot;', '', $data['tahun']), true);

        $this->db->select('ROUND(((paket.nilai_hps_paket - peserta_tender.harga_penawaran)/paket.nilai_hps_paket * 100), 2) as penurunan');
        $this->db->select('paket.kode_tender, paket.nama_tender, paket.nilai_hps_paket, peserta_tender.harga_penawaran, paket.tanggal_pembuatan');
        $this->db->from('paket');
        $this->db->join('peserta_tender', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where('peserta_tender.npwp', $data['npwp'], null, false);
        $this->db->where("peserta_tender.harga_penawaran != 0", null, false);
        $this->db->where_in('paket.id_lpse', $klpd);
        if ($tahun != null) {
            $this->db->where("YEAR(`paket.tanggal_pembuatan`) = ($tahun)", null, false);
        }
        $this->db->order_by('penurunan', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPesertaTenderFilterHps($data)
    {
        $klpd = json_decode(str_replace('&quot;', '', $data['klpd']), true);
        $tahun = json_decode(str_replace('&quot;', '', $data['tahun']), true);

        $this->db->select('kode_tender');
        $this->db->from('peserta_tender');
        $this->db->where('npwp', $data['npwp'], null, false);
        $sub = $this->db->get_compiled_select();

        $this->db->select('count(kode_tender)');
        $this->db->from('paket');
        $this->db->where("`kode_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps_paket` < 500000000", null, false);
        $this->db->where("YEAR(`tanggal_pembuatan`) = ($tahun)", null, false);
        $range1 = $this->db->get_compiled_select();

        $this->db->select('count(kode_tender)');
        $this->db->from('paket');
        $this->db->where("`kode_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps_paket` >= 500000000", null, false);
        $this->db->where("`nilai_hps_paket` < 1000000000", null, false);
        $this->db->where("YEAR(`tanggal_pembuatan`) = ($tahun)", null, false);
        $range2 = $this->db->get_compiled_select();

        $this->db->select('count(kode_tender)');
        $this->db->from('paket');
        $this->db->where("`kode_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps_paket` >= 1000000000", null, false);
        $this->db->where("`nilai_hps_paket` < 10000000000", null, false);
        $this->db->where("YEAR(`tanggal_pembuatan`) = ($tahun)", null, false);
        $range3 = $this->db->get_compiled_select();

        $this->db->select('count(kode_tender)');
        $this->db->from('paket');
        $this->db->where("`kode_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps_paket` >= 10000000000", null, false);
        $this->db->where("`nilai_hps_paket` < 100000000000", null, false);
        $this->db->where("YEAR(`tanggal_pembuatan`) = ($tahun)", null, false);
        $range4 = $this->db->get_compiled_select();

        $this->db->select('count(kode_tender)');
        $this->db->from('paket');
        $this->db->where("`kode_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps_paket` >= 100000000000", null, false);
        $this->db->where("YEAR(`tanggal_pembuatan`) = ($tahun)", null, false);
        $range5 = $this->db->get_compiled_select();

        $this->db->select('CAST(SUBSTRING(paket.tanggal_pembuatan, 6, 2)as DATE) as month');
        $this->db->from('peserta_tender');
        $this->db->select("($range1) as range1");
        $this->db->select("($range2) as range2");
        $this->db->select("($range3) as range3");
        $this->db->select("($range4) as range4");
        $this->db->select("($range5) as range5");
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where('peserta_tender.npwp', $data['npwp']);
        if ($tahun != null) {
            $this->db->where("YEAR(`tanggal_pembuatan`) = ($tahun)", null, false);
        }
        $this->db->where_in('paket.id_lpse', $klpd);
        $this->db->group_by('paket.kode_tender', 'desc');
        $db = clone $this->db;
        log_message('error', $db->get_compiled_select());
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPesertaTenderHps($npwp)
    {
        $this->db->select('kode_tender');
        $this->db->from('peserta_tender');
        $this->db->where('npwp', $npwp, null, false);
        $sub = $this->db->get_compiled_select();

        $this->db->select('count(kode_tender)');
        $this->db->from('paket');
        $this->db->where("`kode_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps_paket` < 500000000", null, false);
        $range1 = $this->db->get_compiled_select();

        $this->db->select('count(kode_tender)');
        $this->db->from('paket');
        $this->db->where("`kode_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps_paket` >= 500000000", null, false);
        $this->db->where("`nilai_hps_paket` < 1000000000", null, false);
        $range2 = $this->db->get_compiled_select();

        $this->db->select('count(kode_tender)');
        $this->db->from('paket');
        $this->db->where("`kode_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps_paket` >= 1000000000", null, false);
        $this->db->where("`nilai_hps_paket` < 10000000000", null, false);
        $range3 = $this->db->get_compiled_select();

        $this->db->select('count(kode_tender)');
        $this->db->from('paket');
        $this->db->where("`kode_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps_paket` >= 10000000000", null, false);
        $this->db->where("`nilai_hps_paket` < 100000000000", null, false);
        $range4 = $this->db->get_compiled_select();

        $this->db->select('count(kode_tender)');
        $this->db->from('paket');
        $this->db->where("`kode_tender` IN ($sub)", null, false);
        $this->db->where("`nilai_hps_paket` >= 100000000000", null, false);
        $range5 = $this->db->get_compiled_select();

        $this->db->select('*');
        $this->db->from('peserta_tender');
        $this->db->select('CAST(SUBSTRING(paket.tanggal_pembuatan, 6, 2)as DATE) as month');
        // $this->db->select("($range1) as range1");
        // $this->db->select("($range2) as range2");
        // $this->db->select("($range3) as range3");
        // $this->db->select("($range4) as range4");
        // $this->db->select("($range5) as range5");
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->where('peserta_tender.npwp', $npwp);
        $this->db->group_by('paket.kode_tender', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPesertaTenderKlpd($npwp)
    {
        $this->db->select('peserta_tender.* ,paket.*, lpse.latitude, lpse.longitude, lpse.nama_lpse');
        $this->db->from('peserta_tender');
        $this->db->select('CAST(SUBSTRING(paket.tanggal_pembuatan, 6, 2)as DATE) as month');
        $this->db->select('count(paket.kode_tender) as count');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender');
        $this->db->join('lpse', 'paket.id_lpse = lpse.id_lpse');
        $this->db->where('peserta_tender.npwp', $npwp);
        $this->db->group_by('month');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahPesertaTender($data)
    {
        $this->db->insert('peserta_tender', $data);

        return $this->db->insert_id();
    }

    public function ubahPesertaTender($id, $new_data)
    {
        $this->db->where('id_peserta_tender', $id);

        return $this->db->update('peserta_tender', $new_data);
    }

    public function hapusPesertaTender($id)
    {
        $this->db->where('id_peserta_tender', $id);

        return $this->db->delete('peserta_tender');
    }

    // Halaman Know Your Market
    public function getPesertaTenderByLpse($klpd, $jenisPengadaan, $hps, $tahun)
    {
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);

        $this->db->select(['lp.id_lpse', 'pk.tanggal_pembuatan']);
        $this->db->from('lpse lp');
        $this->db->join('paket pk', 'pk.id_lpse = lp.id_lpse');
        $this->db->join('peserta_tender ps', 'ps.kode_tender = pk.kode_tender');
        if ($tahun !== null) {
            $this->db->where("YEAR(tanggal_pembuatan)", $tahun);
        }
        $this->db->group_by('lp.id_lpse');
        $this->db->order_by('lp.id_lpse', 'asc');
        $db = clone $this->db;
        $query = $this->db->get();
        //return $db->get_compiled_select();
        return $query->result_array();
    }

    public function getPemenangByTahun($tahun)
    {
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);

        $this->db->select('COUNT(*) as pemenang');
        $this->db->from('pemenang t');
        $this->db->join('peserta_tender pt', 'pt.kode_tender = t.kode_tender');
        $this->db->join('pengguna pn', 'pn.npwp = pt.npwp');
        $this->db->join('paket pk', 'pk.kode_tender = pt.kode_tender');
        $this->db->where("t.harga_kontrak > 0");
        if ($tahun !== null) {
            $this->db->where("YEAR(tanggal_pembuatan)", $tahun);
        }
        $this->db->group_by('YEAR(tanggal_pembuatan)');
        $db = clone $this->db;
        $query = $this->db->get();
        //return $db->get_compiled_select();
        return $query->result_array();
    }

    public function getPenawarByTahun($tahun)
    {
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);

        $this->db->select('COUNT(*) as penawar');
        $this->db->from('pemenang t');
        $this->db->join('peserta_tender pt', 'pt.kode_tender = t.kode_tender');
        $this->db->join('pengguna pn', 'pn.npwp = pt.npwp');
        $this->db->join('paket pk', 'pk.kode_tender = pt.kode_tender');
        $this->db->where("t.harga_negosiasi > 0");
        if ($tahun !== null) {
            $this->db->where("YEAR(tanggal_pembuatan)", $tahun);
        }
        $this->db->group_by('YEAR(tanggal_pembuatan)');
        $db = clone $this->db;
        $query = $this->db->get();
        //return $db->get_compiled_select();
        return $query->result_array();
    }

    public function getPesertaByTahun($tahun)
    {
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);

        $this->db->select('COUNT(*) as peserta');
        $this->db->from('pemenang t');
        $this->db->join('peserta_tender pt', 'pt.kode_tender = t.kode_tender');
        $this->db->join('pengguna pn', 'pn.npwp = pt.npwp');
        $this->db->join('paket pk', 'pk.kode_tender = pt.kode_tender');
        if ($tahun !== null) {
            $this->db->where("YEAR(tanggal_pembuatan)", $tahun);
        }
        $this->db->group_by('YEAR(tanggal_pembuatan)');
        $db = clone $this->db;
        $query = $this->db->get();
        //return $db->get_compiled_select();
        return $query->result_array();
    }

    public function getPesertaMenawarPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    {
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);

        $this->db->select(['COUNT(npwp) as jumlah_peserta', 'DATE_FORMAT(paket.tanggal_pembuatan, "%m") as bulan']);
        $this->db->from('peserta_tender');
        $this->db->join('paket', 'peserta_tender.kode_tender = paket.kode_tender');
        $this->db->where('peserta_tender.harga_penawaran !=', 0);
        if ($klpd !== null) {
            $this->db->where_in('id_lpse', $klpd);
        }
        if ($jenisPengadaan !== null) {
            $this->db->where_in('jenis_pengadaan', $jenisPengadaan);
        }
        if ($hps[0] !== "null") {
            if ($hps[0] === '2') {
                $this->db->where("nilai_hps_paket <", 500000000);
            } elseif ($hps[0] === '3') {
                $this->db->where("nilai_hps_paket >", 1000000000);
                $this->db->where("nilai_hps_paket <", 10000000000);
            } elseif ($hps[0] === '4') {
                $this->db->where("nilai_hps_paket >", 10000000000);
                $this->db->where("nilai_hps_paket <", 100000000000);
            } elseif ($hps[0] === '5') {
                $this->db->where("nilai_hps_paket >", 100000000000);
            }
            // for ($i = 0; $i < count($hps); $i++) {
            // 	if (strpbrk($hps[$i], "/")) {
            // 		$str = explode("/", $hps[$i]);
            // 		$this->db->where("nilai_hps >", (int)$str[0]);
            // 		$this->db->where("nilai_hps <", (int)$str[1]);
            // 	} else {
            // 		$str = explode("than", $hps[$i]);
            // 		if (count($str) > 1) {
            // 			if ($str[0] === "less") {
            // 				$this->db->where("nilai_hps <", (int)$str[1]);
            // 			} else {
            // 				$this->db->where("nilai_hps >", (int)$str[1]);
            // 			}
            // 		}
            // 	}
            // }
        }
        if ($tahun !== null) {
            $this->db->where_in('DATE_FORMAT(tanggal_pembuatan, "%Y")', $tahun);
        }
        $this->db->group_by('DATE_FORMAT(paket.tanggal_pembuatan, "%m")');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPesertaMendaftarPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    {
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);

        $this->db->select(['COUNT(npwp) as jumlah_peserta', 'DATE_FORMAT(paket.tanggal_pembuatan, "%m") as bulan']);
        $this->db->from('peserta_tender');
        $this->db->join('paket', 'peserta_tender.kode_tender = paket.kode_tender');
        $this->db->where('peserta_tender.harga_penawaran =', 0);
        if ($klpd !== null) {
            $this->db->where_in('id_lpse', $klpd);
        }
        if ($jenisPengadaan !== null) {
            $this->db->where_in('jenis_pengadaan', $jenisPengadaan);
        }
        if ($hps[0] !== "null") {
            if ($hps[0] === '2') {
                $this->db->where("nilai_hps_paket <", 500000000);
            } elseif ($hps[0] === '3') {
                $this->db->where("nilai_hps_paket >", 1000000000);
                $this->db->where("nilai_hps_paket <", 10000000000);
            } elseif ($hps[0] === '4') {
                $this->db->where("nilai_hps_paket >", 10000000000);
                $this->db->where("nilai_hps_paket <", 100000000000);
            } elseif ($hps[0] === '5') {
                $this->db->where("nilai_hps_paket >", 100000000000);
            }
            // for ($i = 0; $i < count($hps); $i++) {
            // 	if (strpbrk($hps[$i], "/")) {
            // 		$str = explode("/", $hps[$i]);
            // 		$this->db->where("nilai_hps >", (int)$str[0]);
            // 		$this->db->where("nilai_hps <", (int)$str[1]);
            // 	} else {
            // 		$str = explode("than", $hps[$i]);
            // 		if (count($str) > 1) {
            // 			if ($str[0] === "less") {
            // 				$this->db->where("nilai_hps <", (int)$str[1]);
            // 			} else {
            // 				$this->db->where("nilai_hps >", (int)$str[1]);
            // 			}
            // 		}
            // 	}
            // }
        }
        if ($tahun !== null) {
            $this->db->where_in('DATE_FORMAT(tanggall_pembuatan, "%Y")', $tahun);
        }
        $this->db->group_by('DATE_FORMAT(paket.tanggall_pembuatan, "%m")');
        $query = $this->db->get();
        return $query->result_array();
    }

    // data menang, kalah, ikut 
    public function getDataTenderFilter($npwp, $id_lpse, $tahun)
    {
        $this->db->select('peserta_tender.*, paket.nilai_hps_paket, paket.nama_tender, pemenang.nilai_hps');
        $this->db->select('SUBSTRING(paket.tanggal_pembuatan, 6, 2) AS month');
        $this->db->select('SUBSTRING(paket.tanggal_pembuatan, 1, 4) AS year');
        $this->db->select("CASE
            WHEN pemenang.kode_tender IS NOT NULL AND pemenang.npwp = peserta_tender.npwp THEN 'menang'
            WHEN pemenang.kode_tender IS NULL AND paket.status_tender NOT IN ('Tender Sudah Selesai', 'Selesai') THEN 'ikut'
            WHEN pemenang.kode_tender IS NOT NULL AND pemenang.npwp != peserta_tender.npwp THEN 'kalah'
            ELSE NULL
        END AS status_peserta");
        $this->db->from('peserta_tender');
        $this->db->join('pemenang', 'pemenang.kode_tender = peserta_tender.kode_tender', 'left');
        $this->db->join('paket', 'paket.kode_tender = peserta_tender.kode_tender', 'left');
        $this->db->where_not_in('paket.status_tender', ['Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal']);
        $this->db->where('peserta_tender.npwp', $npwp);
        $this->db->where('peserta_tender.harga_penawaran !=', 0);

        if ($tahun != '') {
            $this->db->where('YEAR(paket.tanggal_pembuatan)', $tahun);
        }
        if ($id_lpse != '') {
            $this->db->where('id_lpse', $id_lpse);
        }

        $result = $this->db->order_by('paket.tanggal_pembuatan', 'DESC')
            ->get()
            ->result_array();

        return $result;
    }
}
