<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

use function PHPUnit\Framework\isEmpty;

class Tender_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('tanggal');
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => base_url(),
            // You can set any number of default request options.
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
    }

    public function getRecentKodeTender()
    {
        $this->db->select('id_tender');
        $this->db->order_by('id_tender', 'DESC')->limit(1);
        $query = $this->db->get('tender');
        $row = $query->row();
        if ($row) {
            return $row->id_tender;
        } else {
            return null;
        }
    }

    public function getRecentKodeTenderByLPSE($id_lpse)
    {
        $this->db->select('id_tender');
        $this->db->order_by('id_tender', 'DESC')->limit(1);
        $this->db->where('id_lpse', $id_lpse);
        $query = $this->db->get('tender');
        $row = $query->row();
        if ($row) {
            return $row->id_tender;
        } else {
            return null;
        }
    }

    public function getTenderByKodeTender($kode_tender)
    {
        $this->db->where('id_tender', $kode_tender);
        $query = $this->db->get('tender');
        $row = $query->row();
        if ($row) {
            return $row->id_tender;
        } else {
            return null;
        }
    }

    public function getKodeTender()
    {
        $this->db->select(['tender.id_tender', 'lpse.url']);
        $this->db->join('lpse', 'tender.id_lpse = lpse.id_lpse');
        $this->db->from('tender');
        $query = $this->db->get();
        // $query = $this->db->get('tender');
        return $query->result_array();
    }

    public function getAllTender()
    {
        $this->db->select(['*']);
        $this->db->from('tender');
        $this->db->order_by('tender.tgl_pembuatan', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllTenderLim($limit, $start)
    {
        $this->db->select(['tender.*', 'detail_tender.lokasi_pekerjaan', 'jenis_tender.jenis_tender', 'tender.status AS tender_status']);
        $this->db->from('tender');
        $this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
        // $this->db->join('lpse', 'tender.id_lpse = lpse.id_lpse');
        $this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        // $this->db->join('kategori_lpse', 'lpse.id_kategori = kategori_lpse.id_kategori');
        // $this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
        // $this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
        $this->db->order_by('tender.tgl_pembuatan', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllTenderC()
    {
        $this->db->select(['tender.*', 'detail_tender.lokasi_pekerjaan', 'jenis_tender.jenis_tender', 'tender.status AS tender_status']);
        $this->db->from('tender');
        $this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
        // $this->db->join('lpse', 'tender.id_lpse = lpse.id_lpse');
        $this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        // $this->db->join('kategori_lpse', 'lpse.id_kategori = kategori_lpse.id_kategori');
        // $this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
        // $this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
        $this->db->order_by('tender.tgl_pembuatan', 'desc');
        $query = $this->db->get();
        return $query->num_rows();
    }

    // public function getTenderDefault($orderby)
    // {
    // 	$tahap = [];
    // 	$tahap['pengadaanBarang'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['pekerjaanKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['jasaKonsultansiBadanUsahaNonKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
    // 	$tahap['jasaKonsultansiBadanUsahaKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
    // 	$tahap['jasaKonsultansiPeroranganNonKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['jasaKonsultansiPeroranganKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['jasaLainnya'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['pekerjaanKonstruksiTerintegrasi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];

    // 	$orderby = json_decode(str_replace('&quot;', '', $orderby), true);

    // 	$this->db->select(['tenO.*', 'detail_tender.*', 'jtO.*', 'tenO.status AS tender_status']);
    // 	$this->db->from('tender tenO');
    // 	$this->db->join('hasil_evaluasi', 'tenO.id_tender = hasil_evaluasi.id_tender', 'left');
    // 	$this->db->join('detail_tender', 'tenO.id_tender = detail_tender.id_tender');
    // 	$this->db->join('jenis_tender jtO', 'tenO.id_jenis = jtO.id_jenis');
    // 	$this->db->group_start();
    // 	$this->db->where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Pengadaan Barang" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['pengadaanBarang']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Pekerjaan Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['pekerjaanKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Non Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaKonsultansiBadanUsahaNonKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaKonsultansiBadanUsahaKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Non Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaKonsultansiPeroranganNonKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaKonsultansiPeroranganKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Lainnya" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaLainnya']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Pekerjaan Konstruksi Terintegrasi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['pekerjaanKonstruksiTerintegrasi']);
    // 	$this->db->group_end();
    // 	$this->db->group_by('tenO.id_tender');
    // 	// $this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
    // 	// $this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
    //     if ($orderby !== null) {
    // 		// Nama Tender
    // 		if ($orderby[0] == 1) {
    // 			$this->db->order_by('tenO.nama_tender', 'asc');
    // 		} else if ($orderby[0] == 2) {
    // 			$this->db->order_by('tenO.nama_tender', 'desc');
    // 		}
    // 		// Jenis Pengadaan
    // 		if ($orderby[1] == 1) {
    // 			$this->db->order_by('jO.jenis_tender', 'asc');
    // 		} else if ($orderby[1] == 2) {
    // 			$this->db->order_by('jO.jenis_tender', 'desc');
    // 		}
    // 		// tahapan
    // 		if ($orderby[2] == 1) {
    // 			$this->db->order_by('tender_status', 'asc');
    // 		} else if ($orderby[2] == 2) {
    // 			$this->db->order_by('tender_status', 'desc');
    // 		}
    // 		// hps
    // 		if ($orderby[3] == 1) {
    // 			$this->db->order_by('nilai_hps', 'asc');
    // 		} else if ($orderby[3] == 2) {
    // 			$this->db->order_by('nilai_hps', 'desc');
    // 		}
    // 	} else {
    // 		$this->db->order_by('tenO.tgl_pembuatan', 'desc');
    // 	}
    // 	$query = $this->db->get();
    // 	return $query->result_array();
    // }

    // public function getTenderDefaultLim($orderby,$limit,$start)
    // {
    // 	$tahap = [];
    // 	$tahap['pengadaanBarang'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['pekerjaanKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['jasaKonsultansiBadanUsahaNonKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
    // 	$tahap['jasaKonsultansiBadanUsahaKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
    // 	$tahap['jasaKonsultansiPeroranganNonKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['jasaKonsultansiPeroranganKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['jasaLainnya'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['pekerjaanKonstruksiTerintegrasi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];

    // 	$orderby = json_decode(str_replace('&quot;', '', $orderby), true);

    // 	$this->db->select(['tenO.*', 'detail_tender.*', 'jO.*', 'tenO.status AS tender_status']);
    // 	$this->db->from('tender tenO');
    // 	$this->db->join('hasil_evaluasi', 'tenO.id_tender = hasil_evaluasi.id_tender', 'left');
    // 	$this->db->join('detail_tender', 'tenO.id_tender = detail_tender.id_tender');
    // 	$this->db->join('jenis_tender jO', 'tenO.id_jenis = jO.id_jenis');
    // 	$this->db->group_start();
    // 	$this->db->where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Pengadaan Barang" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['pengadaanBarang']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Pekerjaan Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['pekerjaanKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Non Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaKonsultansiBadanUsahaNonKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaKonsultansiBadanUsahaKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Non Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaKonsultansiPeroranganNonKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaKonsultansiPeroranganKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Lainnya" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaLainnya']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Pekerjaan Konstruksi Terintegrasi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['pekerjaanKonstruksiTerintegrasi']);
    // 	$this->db->group_end();
    // 	$this->db->group_by('tenO.id_tender');
    // 	// $this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
    // 	// $this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
    // 	if ($orderby !== null) {
    // 		// Nama Tender
    // 		if ($orderby[0] == 1) {
    // 			$this->db->order_by('tenO.nama_tender', 'asc');
    // 		} else if ($orderby[0] == 2) {
    // 			$this->db->order_by('tenO.nama_tender', 'desc');
    // 		}
    // 		// Jenis Pengadaan
    // 		if ($orderby[1] == 1) {
    // 			$this->db->order_by('jO.jenis_tender', 'asc');
    // 		} else if ($orderby[1] == 2) {
    // 			$this->db->order_by('jO.jenis_tender', 'desc');
    // 		}
    // 		// tahapan
    // 		if ($orderby[2] == 1) {
    // 			$this->db->order_by('tender_status', 'asc');
    // 		} else if ($orderby[2] == 2) {
    // 			$this->db->order_by('tender_status', 'desc');
    // 		}
    // 		// hps
    // 		if ($orderby[3] == 1) {
    // 			$this->db->order_by('nilai_hps', 'asc');
    // 		} else if ($orderby[3] == 2) {
    // 			$this->db->order_by('nilai_hps', 'desc');
    // 		}
    // 	} else {
    // 		$this->db->order_by('tenO.tgl_pembuatan', 'desc');
    // 	}
    // 	$this->db->limit($limit, $start);
    // 	$query = $this->db->get();
    // 	return $query->result_array();
    // }

    // public function getTenderDefaultC($orderby)
    // {
    // 	$tahap = [];
    // 	$tahap['pengadaanBarang'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['pekerjaanKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['jasaKonsultansiBadanUsahaNonKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
    // 	$tahap['jasaKonsultansiBadanUsahaKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
    // 	$tahap['jasaKonsultansiPeroranganNonKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['jasaKonsultansiPeroranganKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['jasaLainnya'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
    // 	$tahap['pekerjaanKonstruksiTerintegrasi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];

    // 	$orderby = json_decode(str_replace('&quot;', '', $orderby), true);

    // 	$this->db->select(['tenO.*', 'detail_tender.*', 'jO.*', 'tenO.status AS tender_status']);
    // 	$this->db->from('tender tenO');
    // 	$this->db->join('hasil_evaluasi', 'tenO.id_tender = hasil_evaluasi.id_tender', 'left');
    // 	$this->db->join('detail_tender', 'tenO.id_tender = detail_tender.id_tender');
    // 	$this->db->join('jenis_tender jO', 'tenO.id_jenis = jO.id_jenis');
    // 	$this->db->group_start();
    // 	$this->db->where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Pengadaan Barang" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['pengadaanBarang']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Pekerjaan Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['pekerjaanKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Non Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaKonsultansiBadanUsahaNonKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaKonsultansiBadanUsahaKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Non Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaKonsultansiPeroranganNonKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Konstruksi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaKonsultansiPeroranganKonstruksi']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Jasa Lainnya" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['jasaLainnya']);
    // 	$this->db->or_where_in('(SELECT tender.status
    // 						FROM tender
    // 						JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
    // 						WHERE jenis_tender LIKE "Pekerjaan Konstruksi Terintegrasi" AND tender.id_tender = tenO.id_tender)'
    // 						, $tahap['pekerjaanKonstruksiTerintegrasi']);
    // 	$this->db->group_end();
    // 	$this->db->group_by('tenO.id_tender');
    // 	// $this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
    // 	// $this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
    //     if ($orderby !== null) {
    // 		// Nama Tender
    // 		if ($orderby[0] == 1) {
    // 			$this->db->order_by('tenO.nama_tender', 'asc');
    // 		} else if ($orderby[0] == 2) {
    // 			$this->db->order_by('tenO.nama_tender', 'desc');
    // 		}
    // 		// Jenis Pengadaan
    // 		if ($orderby[1] == 1) {
    // 			$this->db->order_by('jO.jenis_tender', 'asc');
    // 		} else if ($orderby[1] == 2) {
    // 			$this->db->order_by('jO.jenis_tender', 'desc');
    // 		}
    // 		// tahapan
    // 		if ($orderby[2] == 1) {
    // 			$this->db->order_by('tender_status', 'asc');
    // 		} else if ($orderby[2] == 2) {
    // 			$this->db->order_by('tender_status', 'desc');
    // 		}
    // 		// hps
    // 		if ($orderby[3] == 1) {
    // 			$this->db->order_by('nilai_hps', 'asc');
    // 		} else if ($orderby[3] == 2) {
    // 			$this->db->order_by('nilai_hps', 'desc');
    // 		}
    // 	} else {
    // 		$this->db->order_by('tenO.tgl_pembuatan', 'desc');
    // 	}
    // 	$query = $this->db->get();
    // 	return $query->num_rows();
    // }

    public function getTenderDefault($orderby)
    {
        $tahap = [];
        $tahap['pengadaanBarang'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['pekerjaanKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['jasaKonsultansiBadanUsahaNonKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
        $tahap['jasaKonsultansiBadanUsahaKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
        $tahap['jasaKonsultansiPeroranganNonKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['jasaKonsultansiPeroranganKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['jasaLainnya'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['pekerjaanKonstruksiTerintegrasi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['notIn'] = ['Tender Selesai', 'Tender Gagal', 'Tender Ulang', 'Tender Batal'];

        $orderby = json_decode(str_replace('&quot;', '', $orderby), true);

        // $this->db->select(['*']);
        // $this->db->from('tender_default');
        $this->db->select('tender.id_tender AS id_tender, tender.nama_tender AS nama_tender, tender.metode_pemilihan AS metode_pemilihan,
		tender.nilai_hps AS nilai_hps, detail_tender.lokasi_pekerjaan AS lokasi_pekerjaan, 
		jenis_tender.jenis_tender AS jenis_tender, tender.status AS tender_status');
        $this->db->from('tender');
        $this->db->join('(SELECT detail_tender.id_tender, detail_tender.lokasi_pekerjaan FROM detail_tender) detail_tender', 'tender.id_tender = detail_tender.id_tender');
        $this->db->join('(SELECT jenis_tender.id_jenis, jenis_tender.jenis_tender FROM jenis_tender) jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        $this->db->join('(SELECT tahapan.id_tahapan, tahapan.nama_tahapan FROM tahapan) tahapan', 'tender.status = tahapan.nama_tahapan');
        // $this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
        // $this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        // $this->db->join('tahapan', 'tender.status = tahapan.nama_tahapan');
        $this->db->where_not_in("tender.status", $tahap['notIn']);
        $this->db->group_start();
        $this->db->where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Pengadaan Barang" AND tender.id_tender = tender_list.id_tender)',
            $tahap['pengadaanBarang']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Pekerjaan Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['pekerjaanKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Non Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaKonsultansiBadanUsahaNonKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaKonsultansiBadanUsahaKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Non Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaKonsultansiPeroranganNonKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaKonsultansiPeroranganKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Lainnya" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaLainnya']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Pekerjaan Konstruksi Terintegrasi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['pekerjaanKonstruksiTerintegrasi']
        );
        $this->db->group_end();
        // $this->db->group_start();
        // $this->db->where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Pengadaan Barang" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['pengadaanBarang']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Pekerjaan Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['pekerjaanKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Non Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaKonsultansiBadanUsahaNonKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaKonsultansiBadanUsahaKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Non Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaKonsultansiPeroranganNonKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaKonsultansiPeroranganKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Lainnya" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaLainnya']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Pekerjaan Konstruksi Terintegrasi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['pekerjaanKonstruksiTerintegrasi']);
        // $this->db->group_end();
        $this->db->group_by('tender.id_tender');
        // $this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
        // $this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
        if ($orderby !== null) {
            // Nama Tender
            if ($orderby[0] == 1) {
                $this->db->order_by('tender.nama_tender', 'asc');
                $query = $this->db->get();
                return $query->result_array();
            } elseif ($orderby[0] == 2) {
                $this->db->order_by('tender.nama_tender', 'desc');
                $query = $this->db->get();
                return $query->result_array();
            } elseif // // Jenis Pengadaan
            // if ($orderby[1] == 1) {
            // 	$this->db->order_by('jenis_tender', 'asc');
            // 	$query = $this->db->get();
            //	return $query->result_array();
            // } else if ($orderby[1] == 2) {
            // 	$this->db->order_by('jenis_tender', 'desc');
            //	$query = $this->db->get();
            //	return $query->result_array();
            // } else
            // // tahapan
            // if ($orderby[2] == 1) {
            // 	$this->db->order_by('tender_status', 'asc');
            // 	$query = $this->db->get();
            //	return $query->result_array();
            // } else if ($orderby[2] == 2) {
            // 	$this->db->order_by('tender_status', 'desc');
            //	$query = $this->db->get();
            //	return $query->result_array();
            // } else
            // hps
            ($orderby[3] == 1) {
                $this->db->order_by('nilai_hps', 'asc');
                $query = $this->db->get();
                return $query->result_array();
            } elseif ($orderby[3] == 2) {
                $this->db->order_by('nilai_hps', 'desc');
                $query = $this->db->get();
                return $query->result_array();
            }
        } else {
            $this->db->order_by('tender.tgl_pembuatan', 'desc');
            $query = $this->db->get();
            return $query->result_array();
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTenderDefaultLim($orderby, $limit, $start)
    {
        $tahap = [];
        $tahap['pengadaanBarang'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['pekerjaanKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['jasaKonsultansiBadanUsahaNonKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
        $tahap['jasaKonsultansiBadanUsahaKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
        $tahap['jasaKonsultansiPeroranganNonKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['jasaKonsultansiPeroranganKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['jasaLainnya'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['pekerjaanKonstruksiTerintegrasi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['notIn'] = ['Tender Selesai', 'Tender Gagal', 'Tender Ulang', 'Tender Batal'];

        $orderby = json_decode(str_replace('&quot;', '', $orderby), true);

        // $this->db->select(['*']);
        // $this->db->from('tender_default');
        $this->db->select('tender.id_tender AS id_tender, tender.nama_tender AS nama_tender, tender.metode_pemilihan AS metode_pemilihan,
		tender.nilai_hps AS nilai_hps, detail_tender.lokasi_pekerjaan AS lokasi_pekerjaan, 
		jenis_tender.jenis_tender AS jenis_tender, tender.status AS tender_status');
        $this->db->from('tender');
        $this->db->join('(SELECT detail_tender.id_tender, detail_tender.lokasi_pekerjaan FROM detail_tender) detail_tender', 'tender.id_tender = detail_tender.id_tender');
        $this->db->join('(SELECT jenis_tender.id_jenis, jenis_tender.jenis_tender FROM jenis_tender) jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        $this->db->join('(SELECT tahapan.id_tahapan, tahapan.nama_tahapan FROM tahapan) tahapan', 'tender.status = tahapan.nama_tahapan');
        // $this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
        // $this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        // $this->db->join('tahapan', 'tender.status = tahapan.nama_tahapan');
        $this->db->where_not_in("tender.status", $tahap['notIn']);
        $this->db->group_start();
        $this->db->where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Pengadaan Barang" AND tender.id_tender = tender_list.id_tender)',
            $tahap['pengadaanBarang']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Pekerjaan Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['pekerjaanKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Non Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaKonsultansiBadanUsahaNonKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaKonsultansiBadanUsahaKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Non Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaKonsultansiPeroranganNonKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaKonsultansiPeroranganKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Lainnya" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaLainnya']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Pekerjaan Konstruksi Terintegrasi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['pekerjaanKonstruksiTerintegrasi']
        );
        $this->db->group_end();
        // $this->db->group_start();
        // $this->db->where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Pengadaan Barang" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['pengadaanBarang']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Pekerjaan Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['pekerjaanKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Non Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaKonsultansiBadanUsahaNonKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaKonsultansiBadanUsahaKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Non Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaKonsultansiPeroranganNonKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaKonsultansiPeroranganKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Lainnya" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaLainnya']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Pekerjaan Konstruksi Terintegrasi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['pekerjaanKonstruksiTerintegrasi']);
        // $this->db->group_end();
        $this->db->group_by('tender.id_tender');
        // $this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
        // $this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
        if ($orderby !== null) {
            // Nama Tender
            if ($orderby[0] == 1) {
                $this->db->order_by('tender.nama_tender', 'asc');
                $this->db->limit($limit, $start);
                $query = $this->db->get();
                return $query->result_array();
            // return print_r(json_encode($query->result_array()));
            } elseif ($orderby[0] == 2) {
                $this->db->order_by('tender.nama_tender', 'desc');
                $this->db->limit($limit, $start);
                $query = $this->db->get();
                return $query->result_array();
                // return print_r(json_encode($query->result_array()));
            } elseif // // Jenis Pengadaan
                // if ($orderby[1] == 1) {
                // 	$this->db->order_by('jenis_tender', 'asc');
                //  $this->db->limit($limit, $start);
                // 	$query = $this->db->get();
                // return $query->result_array();
                // return print_r(json_encode($query->result_array()));
                // } else if ($orderby[1] == 2) {
                // 	$this->db->order_by('jenis_tender', 'desc');
                //  $this->db->limit($limit, $start);
                //	$query = $this->db->get();
                // return $query->result_array();
                // return print_r(json_encode($query->result_array()));
                // } else
                // // tahapan
                // if ($orderby[2] == 1) {
                // 	$this->db->order_by('tender_status', 'asc');
                //  $this->db->limit($limit, $start);
                // 	$query = $this->db->get();
                // return $query->result_array();
                // return print_r(json_encode($query->result_array()));
                // } else if ($orderby[2] == 2) {
                // 	$this->db->order_by('tender_status', 'desc');
                //  $this->db->limit($limit, $start);
                //	$query = $this->db->get();
                // return $query->result_array();
                // return print_r(json_encode($query->result_array()));
                // } else
                // hps
            ($orderby[3] == 1) {
                $this->db->order_by('nilai_hps', 'asc');
                $this->db->limit($limit, $start);
                $query = $this->db->get();
                return $query->result_array();
            // return print_r(json_encode($query->result_array()));
            } elseif ($orderby[3] == 2) {
                $this->db->order_by('nilai_hps', 'desc');
                $this->db->limit($limit, $start);
                $query = $this->db->get();
                return $query->result_array();
                // return print_r(json_encode($query->result_array()));
            }
        } else {
            $this->db->order_by('tender.tgl_pembuatan', 'desc');
            $this->db->limit($limit, $start);
            $query = $this->db->get();
            return $query->result_array();
            // return print_r(json_encode($query->result_array()));
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
        // return print_r(json_encode($query->result_array()));
    }

    public function getTenderDefaultC($orderby)
    {
        $tahap = [];
        $tahap['pengadaanBarang'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahapPengadaanBarang = implode(',', $tahap['pengadaanBarang']);
        $tahap['pekerjaanKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahapPekerjaanKonstruksi = implode(',', $tahap['pekerjaanKonstruksi']);
        $tahap['jasaKonsultansiBadanUsahaNonKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
        $tahap['jasaKonsultansiBadanUsahaKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
        $tahap['jasaKonsultansiPeroranganNonKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['jasaKonsultansiPeroranganKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['jasaLainnya'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['pekerjaanKonstruksiTerintegrasi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['notIn'] = ['Tender Selesai', 'Tender Gagal', 'Tender Ulang', 'Tender Batal'];

        $orderby = json_decode(str_replace('&quot;', '', $orderby), true);

        // $this->db->select('tender_status');
        // $this->db->from('tender_list');
        // $this->db->where('jenis_tender LIKE', "Pengadaan Barang");
        // $this->db->where('id_tender =', 'id_tender');
        // $_1 = $this->db->get_compiled_select();
        // var_dump($_1);

        $this->db->select('tender.id_tender AS id_tender, tender.nama_tender AS nama_tender, tender.metode_pemilihan AS metode_pemilihan,
		tender.nilai_hps AS nilai_hps, detail_tender.lokasi_pekerjaan AS lokasi_pekerjaan, 
		jenis_tender.jenis_tender AS jenis_tender, tender.status AS tender_status');
        $this->db->from('tender');
        $this->db->join('(SELECT detail_tender.id_tender, detail_tender.lokasi_pekerjaan FROM detail_tender) detail_tender', 'tender.id_tender = detail_tender.id_tender');
        $this->db->join('(SELECT jenis_tender.id_jenis, jenis_tender.jenis_tender FROM jenis_tender) jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        $this->db->join('(SELECT tahapan.id_tahapan, tahapan.nama_tahapan FROM tahapan) tahapan', 'tender.status = tahapan.nama_tahapan');
        // $this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
        // $this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        // $this->db->join('tahapan', 'tender.status = tahapan.nama_tahapan');
        $this->db->where_not_in("tender.status", $tahap['notIn']);
        // $this->db->where("
        // CASE WHEN jenis_tender.jenis_tender = 'Pengadaan Barang' THEN tender.status IN ($tahapPengadaanBarang)
        // 	 WHEN jenis_tender.jenis_tender = 'Pekerjaan Konstruksi' THEN tender.status IN ($tahapPengadaanBarang)
        // 	 ELSE 'not now'
        // END");
        $this->db->group_start();
        $this->db->where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Pengadaan Barang" AND tender.id_tender = tender_list.id_tender)',
            $tahap['pengadaanBarang']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Pekerjaan Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['pekerjaanKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Non Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaKonsultansiBadanUsahaNonKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaKonsultansiBadanUsahaKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Non Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaKonsultansiPeroranganNonKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Konstruksi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaKonsultansiPeroranganKonstruksi']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Jasa Lainnya" AND tender.id_tender = tender_list.id_tender)',
            $tahap['jasaLainnya']
        );
        $this->db->or_where_in(
            '(SELECT tender.status
							FROM tender 
							JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis 
							WHERE jenis_tender LIKE "Pekerjaan Konstruksi Terintegrasi" AND tender.id_tender = tender_list.id_tender)',
            $tahap['pekerjaanKonstruksiTerintegrasi']
        );
        $this->db->group_end();
        // $this->db->where_in("IF (jenis_tender.jenis_tender = 'Pengadaan Barang')
        // 						tender.status;
        // 					ELSE IF
        // 						PRINT 'x > 0 and x >= y';", $tahap['pengadaanBarang']);
        // $this->db->where("
        // 	IF (jenis_tender.jenis_tender LIKE 'Pengadaan Barang')
        // 	tender.status
        // 	ELSE
        // 	PRINT 'ELSE STATEMENT: CONDITION IS FALSE'
        // ");

        // $this->db->group_start();
        // $this->db->where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Pengadaan Barang" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['pengadaanBarang']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Pekerjaan Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['pekerjaanKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Non Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaKonsultansiBadanUsahaNonKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Konsultansi BadanUsaha Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaKonsultansiBadanUsahaKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Non Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaKonsultansiPeroranganNonKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Konsultansi Perorangan Konstruksi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaKonsultansiPeroranganKonstruksi']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Jasa Lainnya" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['jasaLainnya']);
        // $this->db->or_where_in('(SELECT tender.status
        // 					FROM tender
        // 					JOIN jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // 					WHERE jenis_tender LIKE "Pekerjaan Konstruksi Terintegrasi" AND tender.id_tender = tender_default.id_tender)'
        // 					, $tahap['pekerjaanKonstruksiTerintegrasi']);
        // // $this->db->where_in($_1, $tahap['pengadaanBarang']);
        // // $this->db->or_where_in('(SELECT tl.tender_status
        // // 					FROM tender_list tl
        // // 					JOIN jenis_tender ON tl.id_jenis = jenis_tender.id_jenis
        // // 					WHERE tl.jenis_tender LIKE "Pekerjaan Konstruksi" AND tl.id_tender = tender_list.id_tender)'
        // // 					, $tahap['pekerjaanKonstruksi']);
        // // $this->db->or_where_in('(SELECT tl.tender_status
        // // 					FROM tender_list tl
        // // 					JOIN jenis_tender ON tl.id_jenis = jenis_tender.id_jenis
        // // 					WHERE tl.jenis_tender LIKE "Jasa Konsultansi BadanUsaha Non Konstruksi" AND tl.id_tender = tender_list.id_tender)'
        // // 					, $tahap['jasaKonsultansiBadanUsahaNonKonstruksi']);
        // // $this->db->or_where_in('(SELECT tl.tender_status
        // // 					FROM tender_list tl
        // // 					JOIN jenis_tender ON tl.id_jenis = jenis_tender.id_jenis
        // // 					WHERE tl.jenis_tender LIKE "Jasa Konsultansi BadanUsaha Konstruksi" AND tl.id_tender = tender_list.id_tender)'
        // // 					, $tahap['jasaKonsultansiBadanUsahaKonstruksi']);
        // // $this->db->or_where_in('(SELECT tl.tender_status
        // // 					FROM tender_list tl
        // // 					JOIN jenis_tender ON tl.id_jenis = jenis_tender.id_jenis
        // // 					WHERE tl.jenis_tender LIKE "Jasa Konsultansi Perorangan Non Konstruksi" AND tl.id_tender = tender_list.id_tender)'
        // // 					, $tahap['jasaKonsultansiPeroranganNonKonstruksi']);
        // // $this->db->or_where_in('(SELECT tl.tender_status
        // // 					FROM tender_list tl
        // // 					JOIN jenis_tender ON tl.id_jenis = jenis_tender.id_jenis
        // // 					WHERE tl.jenis_tender LIKE "Jasa Konsultansi Perorangan Konstruksi" AND tl.id_tender = tender_list.id_tender)'
        // // 					, $tahap['jasaKonsultansiPeroranganKonstruksi']);
        // // $this->db->or_where_in('(SELECT tl.tender_status
        // // 					FROM tender_list tl
        // // 					JOIN jenis_tender ON tl.id_jenis = jenis_tender.id_jenis
        // // 					WHERE tl.jenis_tender LIKE "Jasa Lainnya" AND tl.id_tender = tender_list.id_tender)'
        // // 					, $tahap['jasaLainnya']);
        // // $this->db->or_where_in('(SELECT tl.tender_status
        // // 					FROM tender_list tl
        // // 					JOIN jenis_tender ON tl.id_jenis = jenis_tender.id_jenis
        // // 					WHERE tl.jenis_tender LIKE "Pekerjaan Konstruksi Terintegrasi" AND tl.id_tender = tender_list.id_tender)'
        // // 					, $tahap['pekerjaanKonstruksiTerintegrasi']);
        // $this->db->group_end();
        $this->db->group_by('tender.id_tender');
        // $this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
        // $this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
        // if ($orderby !== null) {
        // 	// Nama Tender
        // 	if ($orderby[0] == 1) {
        // 		$this->db->order_by('tender_list.nama_tender', 'asc');
        // 		$query = $this->db->get();
        // 		return $query->num_rows();
        // 	} else if ($orderby[0] == 2) {
        // 		$this->db->order_by('tender_list.nama_tender', 'desc');
        // 		$query = $this->db->get();
        // 		return $query->num_rows();
        // 	} else
        // 	// // Jenis Pengadaan
        // 	// if ($orderby[1] == 1) {
        // 	// 	$this->db->order_by('jenis_tender', 'asc');
        // 	// 	$query = $this->db->get();
        // 	//	return $query->num_rows();
        // 	// } else if ($orderby[1] == 2) {
        // 	// 	$this->db->order_by('jenis_tender', 'desc');
        // 	//	$query = $this->db->get();
        // 	//	return $query->num_rows();
        // 	// } else
        // 	// // tahapan
        // 	// if ($orderby[2] == 1) {
        // 	// 	$this->db->order_by('tender_status', 'asc');
        // 	// 	$query = $this->db->get();
        // 	//	return $query->num_rows();
        // 	// } else if ($orderby[2] == 2) {
        // 	// 	$this->db->order_by('tender_status', 'desc');
        // 	//	$query = $this->db->get();
        // 	//	return $query->num_rows();
        // 	// } else
        // 	// hps
        // 	if ($orderby[3] == 1) {
        // 		$this->db->order_by('nilai_hps', 'asc');
        // 		$query = $this->db->get();
        // 		return $query->num_rows();
        // 	} else if ($orderby[3] == 2) {
        // 		$this->db->order_by('nilai_hps', 'desc');
        // 		$query = $this->db->get();
        // 		return $query->num_rows();
        // 	}
        // } else {
        // 	$this->db->order_by('tender_list.tgl_pembuatan', 'desc');
        // 	$query = $this->db->get();
        // 	return $query->num_rows();
        // }
        $query = $this->db->get();
        return $query->num_rows();
        // return print_r(json_encode($query->num_rows()));
    }

    public $table = 'tender';
    public $column_order = ['id_tender', 'id_lpse', 'id_jenis', 'nama_tender', 'niali_hps', 'nilai_kontrak'];
    public $order = ['id_tender', 'id_lpse', 'id_jenis', 'nama_tender', 'niali_hps', 'nilai_kontrak'];

    private function _get_data_query_default($orderby)
    {
        $tahap = [];
        // $tahap['pengadaanBarang'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        // // $tahapPengadaanBarang = implode(',', $tahap['pengadaanBarang']);
        // $tahap['pekerjaanKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        // // $tahapPekerjaanKonstruksi = implode(',', $tahap['pekerjaanKonstruksi']);
        // $tahap['jasaKonsultansiBadanUsahaNonKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
        // $tahap['jasaKonsultansiBadanUsahaKonstruksi'] = ['Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi'];
        // $tahap['jasaKonsultansiPeroranganNonKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        // $tahap['jasaKonsultansiPeroranganKonstruksi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        // $tahap['jasaLainnya'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        // $tahap['pekerjaanKonstruksiTerintegrasi'] = ['Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran'];
        $tahap['notIn'] = ['Tender Selesai', 'Tender Gagal', 'Tender Ulang', 'Tender Batal'];

        $orderby = json_decode(str_replace('&quot;', '', $orderby), true);

        $this->db->select('tender.id_tender AS id_tender, tender.nama_tender AS nama_tender, tender.metode_pemilihan AS metode_pemilihan,
		tender.nilai_hps AS nilai_hps, detail_tender.lokasi_pekerjaan AS lokasi_pekerjaan, 
		jenis_tender.jenis_tender AS jenis_tender, tender.status AS tender_status');
        $this->db->from('tender');
        $this->db->join('(SELECT detail_tender.id_tender, detail_tender.lokasi_pekerjaan FROM detail_tender) detail_tender', 'tender.id_tender = detail_tender.id_tender');
        $this->db->join('(SELECT jenis_tender.id_jenis, jenis_tender.jenis_tender FROM jenis_tender) jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        // $this->db->join('(SELECT tahapan.id_tahapan, tahapan.nama_tahapan FROM tahapan) tahapan', 'tender.status = tahapan.nama_tahapan');
        $this->db->where_not_in("tender.status", $tahap['notIn']);
        $this->db->where("
		CASE
			WHEN jenis_tender.jenis_tender='Pengadaan Barang' THEN 
				tender.status IN ('Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran')
			WHEN jenis_tender.jenis_tender='Pekerjaan Konstruksi' THEN 
				tender.status IN ('Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran')
			WHEN jenis_tender.jenis_tender='Jasa Konsultansi BadanUsaha Non Konstruksi' THEN 
				tender.status IN ('Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi')
			WHEN jenis_tender.jenis_tender='Jasa Konsultansi BadanUsaha Konstruksi' THEN 
				tender.status IN ('Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi')
			WHEN jenis_tender.jenis_tender='Jasa Konsultansi Perorangan Non Konstruksi' THEN 
				tender.status IN ('Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran')
			WHEN jenis_tender.jenis_tender='Jasa Konsultansi Perorangan Konstruksi' THEN 
				tender.status IN ('Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran')
			WHEN jenis_tender.jenis_tender='Jasa Lainnya' THEN 
				tender.status IN ('Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran')
			ELSE
				tender.status IN ('Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran')
		END");
        // $this->db->group_start();
        // $this->db->where_in("IF (jenis_tender.jenis_tender = 'Pengadaan Barang' , tender.status, tender.status)", $tahap['pengadaanBarang']);
        // $this->db->or_where_in("IF (jenis_tender.jenis_tender = 'Pekerjaan Konstruksi' , tender.status, tender.status)", $tahap['pekerjaanKonstruksi']);
        // $this->db->or_where_in("IF (jenis_tender.jenis_tender = 'Jasa Konsultansi BadanUsaha Non Konstruksi' , tender.status, tender.status)", $tahap['jasaKonsultansiBadanUsahaNonKonstruksi']);
        // $this->db->or_where_in("IF (jenis_tender.jenis_tender = 'Jasa Konsultansi BadanUsaha Konstruksi' , tender.status, tender.status)", $tahap['jasaKonsultansiBadanUsahaKonstruksi']);
        // $this->db->or_where_in("IF (jenis_tender.jenis_tender = 'Jasa Konsultansi Perorangan Non Konstruksi' , tender.status, tender.status)", $tahap['jasaKonsultansiPeroranganNonKonstruksi']);
        // $this->db->or_where_in("IF (jenis_tender.jenis_tender = 'Jasa Konsultansi Perorangan Konstruksi' , tender.status, tender.status)", $tahap['jasaKonsultansiPeroranganKonstruksi']);
        // $this->db->or_where_in("IF (jenis_tender.jenis_tender = 'Jasa Lainnya' , tender.status, tender.status)", $tahap['jasaLainnya']);
        // $this->db->or_where_in("IF (jenis_tender.jenis_tender = 'Pekerjaan Konstruksi Terintegrasi' , tender.status, tender.status)", $tahap['pekerjaanKonstruksiTerintegrasi']);
        // $this->db->group_end();
        // $sqlDefault = "
        // SELECT tender.id_tender AS id_tender, tender.nama_tender AS nama_tender, tender.metode_pemilihan AS metode_pemilihan,
        // 	tender.nilai_hps AS nilai_hps, detail_tender.lokasi_pekerjaan AS lokasi_pekerjaan,
        // 	jenis_tender.jenis_tender AS jenis_tender, tender.status AS tender_status
        // FROM tender
        // JOIN (SELECT detail_tender.id_tender, detail_tender.lokasi_pekerjaan FROM detail_tender) detail_tender ON tender.id_tender = detail_tender.id_tender
        // JOIN (SELECT jenis_tender.id_jenis, jenis_tender.jenis_tender FROM jenis_tender) jenis_tender ON tender.id_jenis = jenis_tender.id_jenis
        // WHERE tender.status NOT IN ('Tender Selesai', 'Tender Gagal', 'Tender Ulang', 'Tender Batal') AND
        // CASE
        // 	WHEN jenis_tender.jenis_tender='Pengadaan Barang' THEN
        // 		tender.status IN ('Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran')
        // 	WHEN jenis_tender.jenis_tender='Pekerjaan Konstruksi' THEN
        // 		tender.status IN ('Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran')
        // 	WHEN jenis_tender.jenis_tender='Jasa Konsultansi BadanUsaha Non Konstruksi' THEN
        // 		tender.status IN ('Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi')
        // 	WHEN jenis_tender.jenis_tender='Jasa Konsultansi BadanUsaha Konstruksi' THEN
        // 		tender.status IN ('Pengumuman Prakualifikasi', 'Download Dokumen Kualifikasi', 'Penjelasan Dokumen Prakualifikasi', 'Kirim Persyaratan Kualifikasi')
        // 	WHEN jenis_tender.jenis_tender='Jasa Konsultansi Perorangan Non Konstruksi' THEN
        // 		tender.status IN ('Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran')
        // 	WHEN jenis_tender.jenis_tender='Jasa Konsultansi Perorangan Konstruksi' THEN
        // 		tender.status IN ('Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran')
        // 	WHEN jenis_tender.jenis_tender='Jasa Lainnya' THEN
        // 		tender.status IN ('Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran')
        // 	ELSE
        // 		tender.status IN ('Pengumuman Pascakualifikasi', 'Download Dokumen Pemilihan', 'Pemberian Penjelasan', 'Upload Dokumen Penawaran')
        // END
        // ";
        // $this->db->query($sqlDefault);
        // var_dump($sqlDefault);
        if ($orderby !== null) {
            // Nama Tender
            if ($orderby[0] == 1) {
                $this->db->order_by('tender.nama_tender', 'asc');
            // return print_r(json_encode($query->result_array()));
            } elseif ($orderby[0] == 2) {
                $this->db->order_by('tender.nama_tender', 'desc');
            // return print_r(json_encode($query->result_array()));
            } elseif ($orderby[3] == 1) {
                $this->db->order_by('nilai_hps', 'asc');
            // return print_r(json_encode($query->result_array()));
            } elseif ($orderby[3] == 2) {
                $this->db->order_by('nilai_hps', 'desc');
                // return print_r(json_encode($query->result_array()));
            }
        } else {
            $this->db->order_by('tender.tgl_pembuatan', 'desc');
            // return print_r(json_encode($query->result_array()));
        }
    }

    public function getDataTableDefault($orderby, $limit, $start)
    {
        // $this->_count_all_query_default($orderby);
        // $recordTotal = $total->result();
        // var_dump($recordTotal);
        // die();

        // var_dump(count($this->_get_data_query_default($orderby)));
        $this->_get_data_query_default($orderby);
        if ($limit != -1) {
            $this->db->limit($limit, $start);
        }
        $data = $this->db->get();
        var_dump($data);
        die();
        $total = $this->Tender_model->count_all_data_default($orderby);
        $output = [
            // "draw" => $_POST['draw'],
            // "recordsTotal" => $data->num_rows(),
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $data->result(),
        ];
        // return $data->result();
        return $output;
        // print_r ($output);
        // die();
        // return json_encode($query->result());
    }

    // public function count_filtered_data_default($orderby)
    // {
    // 	$this->_get_data_query($orderby);
    // 	$query = $this->db->get();
    // 	return $query->num_rows();
    // }

    public function count_all_data_default($orderby)
    {
        $this->_get_data_query_default($orderby);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_data_query_filter($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby)
    {
        $wilayah = json_decode(str_replace('&quot;', '', $wilayah), true);
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $kualifikasi = explode(',', str_replace(['&quot;', '[', ']'], '', $kualifikasi));
        $keyword = explode(',', str_replace(['&quot;', '[', ']'], '', $keyword));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);
        $tahapan = json_decode(str_replace('&quot;', '', $tahapan), true);
        $orderby = json_decode(str_replace('&quot;', '', $orderby), true);
        // $orderby = str_replace(['&quot;', '[', ']'], '', $orderby);
        // var_dump($orderby);

        // Mengambil id_lpse yang berada pada suatu wilayah
        $idLPSEWilayah = $this->db->where_in('id_wilayah', $wilayah)->get('lpse')->result_array();
        $id_lpseWil = [];
        if (count($idLPSEWilayah) > 0) {
            $id_lpseWil = [];
            foreach ($idLPSEWilayah as $idLPSE) {
                $id_lpseWil[] = $idLPSE['id_lpse'];
            }
        } else {
            $id_lpseWil = 'null';
        }
        // ------------------------------------------------

        $this->db->select('tender.id_tender AS id_tender, tender.nama_tender AS nama_tender, tender.metode_pemilihan AS metode_pemilihan,
		tender.nilai_hps AS nilai_hps, detail_tender.lokasi_pekerjaan AS lokasi_pekerjaan, 
		jenis_tender.jenis_tender AS jenis_tender, tender.status AS tender_status');
        $this->db->from('tender');
        $this->db->join('(SELECT detail_tender.id_tender, detail_tender.lokasi_pekerjaan FROM detail_tender) detail_tender', 'tender.id_tender = detail_tender.id_tender');
        $this->db->join('(SELECT jenis_tender.id_jenis, jenis_tender.jenis_tender FROM jenis_tender) jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        $this->db->join('(SELECT tahapan.id_tahapan, tahapan.nama_tahapan FROM tahapan) tahapan', 'tender.status = tahapan.nama_tahapan');

        if ($tahapan !== null) {
            $this->db->where_in('id_tahapan', $tahapan);
        }
        if ($search !== "") {
            $this->db->group_start();
            $this->db->like('nama_tender', $search);
            $this->db->or_like('nama_lpse', $search);
            $this->db->group_end();
        }
        if ($keyword[0] !== "null") {
            $this->db->where_in('nama_tender', $keyword);
            $this->db->or_where_in('nama_lpse', $keyword);
            for ($i = 0; $i < count($keyword); $i++) {
                $this->db->group_start();
                $this->db->where("nama_tender =", $keyword[$i]);
                $this->db->or_where("nama_tender =", $keyword[$i]);
                $this->db->group_end();
                if ($i > 0) {
                    $this->db->group_start();
                    $this->db->where("nama_tender =", $keyword[$i]);
                    $this->db->or_where("nama_tender =", $keyword[$i]);
                    $this->db->group_end();
                }
            }
        }
        // if ($keyword !== "") {
        // 	$this->db->group_start();
        // 	// $this->db->like('kategori_lpse.nama_kategori', $keyword);
        // 	// $this->db->or_like('tender.nama_tender', $keyword);
        // 	$this->db->where_in('nama_tender', $keyword);
        // 	$this->db->or_where_in('nama_lpse', $keyword);
        // 	// $this->db->like('nama_tender', $keyword);
        // 	// $this->db->or_like('nama_lpse', $keyword);
        // 	$this->db->group_end();
        // }
        if ($wilayah !== null) {
            $this->db->where_in('id_lpse', $id_lpseWil);
        }
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
        if ($kualifikasi[0] !== "" && $kualifikasi[0] !== "null") {
            for ($i = 0; $i < count($kualifikasi); $i++) {
                $this->db->where("kualifikasi =", $kualifikasi[$i]);
                if ($i > 0) {
                    $this->db->or_where("kualifikasi =", $kualifikasi[$i]);
                }
            }
        }
        if ($tahun !== null) {
            $this->db->where_in('DATE_FORMAT(tgl_pembuatan, "%Y")', $tahun);
        }
        if ($orderby !== null) {
            // Nama Tender
            if ($orderby[0] == 1) {
                $this->db->order_by('tender_list.nama_tender', 'asc');
            } elseif ($orderby[0] == 2) {
                $this->db->order_by('tender_list.nama_tender', 'desc');
            } elseif // // Jenis Pengadaan
            // if ($orderby[1] == 1) {
            // 	$this->db->order_by('jenis_tender', 'asc');
            // } else if ($orderby[1] == 2) {
            // 	$this->db->order_by('jenis_tender', 'desc');
            // } else
            // // tahapan
            // if ($orderby[2] == 1) {
            // 	$this->db->order_by('tender_status', 'asc');
            // } else if ($orderby[2] == 2) {
            // 	$this->db->order_by('tender_status', 'desc');
            // } else
            // hps
            ($orderby[3] == 1) {
                $this->db->order_by('nilai_hps', 'asc');
            } elseif ($orderby[3] == 2) {
                $this->db->order_by('nilai_hps', 'desc');
            }
        } else {
            $this->db->order_by('tender_list.tgl_pembuatan', 'desc');
        }
    }

    public function getDataTableFilter($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby, $limit, $start)
    {
        // $this->_count_all_query_default($orderby);
        // $total = $this->db->get();
        // $recordTotal = $total->result();
        // var_dump($recordTotal);
        // die();

        // var_dump(count($this->_get_data_query_default($orderby)));
        $this->_get_data_query_filter($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby);
        if ($limit != -1) {
            $this->db->limit($limit, $start);
        }
        $data = $this->db->get();
        // var_dump($data);
        // die();
        $output = [
            // "draw" => $_POST['draw'],
            // "recordsTotal" => $data->num_rows(),
            // "recordsTotal" => $data->num_rows(),
            // "recordsFiltered" => $this->Tender_model->count_filtered_data(),
            "data" => $data->result(),
        ];
        // return $data->result();
        return $output;
        // return json_encode($query->result());
    }

    // public function getSearchTender($keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby)
    // {
    // 	$wilayah = json_decode(str_replace('&quot;', '', $wilayah), true);
    // 	$klpd = json_decode(str_replace('&quot;', '', $klpd), true);
    // 	$jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
    // 	// $hps = str_replace(['&quot;', '[', ']'],'',$hps);
    // 	$hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
    // 	$kualifikasi = explode(',', str_replace(['&quot;', '[', ']'], '', $kualifikasi));
    // 	$tahun = json_decode(str_replace('&quot;', '', $tahun), true);
    // 	$tahapan = json_decode(str_replace('&quot;', '', $tahapan), true);
    // 	$orderby = json_decode(str_replace('&quot;', '', $orderby), true);
    // 	// $orderby = str_replace(['&quot;', '[', ']'], '', $orderby);
    // 	// var_dump($orderby);

    // 	// Mengambil id_lpse yang berada pada suatu wilayah
    // 	$idLPSEWilayah = $this->db->where_in('id_wilayah', $wilayah)->get('lpse')->result_array();
    // 	$id_lpseWil = [];
    // 	if (count($idLPSEWilayah) > 0) {
    // 		$id_lpseWil = [];
    // 		foreach ($idLPSEWilayah as $idLPSE) {
    // 			$id_lpseWil[] = $idLPSE['id_lpse'];
    // 		}
    // 	} else {
    // 		$id_lpseWil = 'null';
    // 	}
    // 	// ------------------------------------------------

    // 	// // Mengambil id_lpse yang berada pada suatu kategori
    // 	// $idLPSEKlpd = $this->db->where_in('id_kategori', $klpd)->get('lpse')->result_array();
    // 	// $id_lpseKlpd = [];
    // 	// if(count($idLPSEKlpd)>0){
    // 	// 	$id_lpseKlpd = [];
    // 	// 	foreach ($idLPSEKlpd as $idLPSE) {
    // 	// 		$id_lpseKlpd[] = $idLPSE['id_lpse'];
    // 	// 	}
    // 	// } else {
    // 	// 	$id_lpseKlpd = 'null';
    // 	// }
    // 	// // ------------------------------------------------

    // 	$this->db->select(['*', 'tender.status AS tender_status', 'lpse.status AS lpse_status']);
    // 	$this->db->from('tender');
    // 	$this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
    // 	$this->db->join('lpse', 'tender.id_lpse = lpse.id_lpse');
    // 	$this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
    // 	$this->db->join('kategori_lpse', 'lpse.id_kategori = kategori_lpse.id_kategori');
    // 	// $this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
    // 	// $this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
    // 	// var_dump($kualifikasi[0]);
    // 	if ($tahapan !== null) {
    // 		// var_dump("cek");
    // 		$this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
    // 		$this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
    // 		$this->db->where_in('tahapan.id_tahapan', $tahapan);
    // 	}
    // 	if ($keyword !== "") {
    // 		$this->db->group_start();
    // 		// $this->db->like('kategori_lpse.nama_kategori', $keyword);
    // 		// $this->db->or_like('tender.nama_tender', $keyword);
    // 		$this->db->like('tender.nama_tender', $keyword);
    // 		$this->db->or_like('lpse.nama_lpse', $keyword);
    // 		$this->db->group_end();
    // 	}
    // 	if ($wilayah !== null) {
    // 		$this->db->where_in('tender.id_lpse', $id_lpseWil);
    // 	}
    // 	if ($klpd !== null) {
    // 		$this->db->where_in('tender.id_lpse', $klpd);
    // 	}
    // 	if ($jenisPengadaan !== null) {
    // 		$this->db->where_in('tender.id_jenis', $jenisPengadaan);
    // 	}
    // 	if ($hps !== null) {
    // 		for ($i = 0; $i < count($hps); $i++) {
    // 			if (strpbrk($hps[$i], "/")) {
    // 				$str = explode("/", $hps[$i]);
    // 				$this->db->where("tender.nilai_hps >", (int)$str[0]);
    // 				$this->db->where("tender.nilai_hps <", (int)$str[1]);
    // 			} else {
    // 				$str = explode("than", $hps[$i]);
    // 				if (count($str) > 1) {
    // 					if ($str[0] === "less") {
    // 						$this->db->where("tender.nilai_hps <", (int)$str[1]);
    // 					} else {
    // 						$this->db->where("tender.nilai_hps >", (int)$str[1]);
    // 					}
    // 				}
    // 			}
    // 		}
    // 	}
    // 	if ($kualifikasi[0] !== "" && $kualifikasi[0] !== "null") {
    // 		for ($i = 0; $i < count($kualifikasi); $i++) {
    // 			$this->db->where("tender.kualifikasi =", $kualifikasi[$i]);
    // 			if ($i > 0) {
    // 				$this->db->or_where("tender.kualifikasi =", $kualifikasi[$i]);
    // 			}
    // 		}
    // 	}
    // 	if ($tahun !== null) {
    // 		$this->db->where_in('tender.tahun_anggaran', $tahun);
    // 	}
    // 	if ($orderby !== null) {
    // 		// Nama Tender
    // 		if ($orderby[0] == 1) {
    // 			$this->db->order_by('tender.nama_tender', 'asc');
    // 		} else if ($orderby[0] == 2) {
    // 			$this->db->order_by('tender.nama_tender', 'desc');
    // 		}
    // 		// Jenis Pengadaan
    // 		if ($orderby[1] == 1) {
    // 			$this->db->order_by('jenis_tender', 'asc');
    // 		} else if ($orderby[1] == 2) {
    // 			$this->db->order_by('jenis_tender', 'desc');
    // 		}
    // 		// // tahapan
    // 		// if ($orderby[2] == 1) {
    // 		// 	$this->db->order_by('jenis_tender', 'asc');
    // 		// } else if ($orderby[2] == 2) {
    // 		// 	$this->db->order_by('jenis_tender', 'desc');
    // 		// }
    // 		// hps
    // 		if ($orderby[3] == 1) {
    // 			$this->db->order_by('nilai_hps', 'asc');
    // 		} else if ($orderby[3] == 2) {
    // 			$this->db->order_by('nilai_hps', 'desc');
    // 		}
    // 	} else {
    // 		$this->db->order_by('tender.tgl_pembuatan', 'desc');
    // 	}
    // 	// $this->db->order_by('id_tender', 'asc');
    // 	$query = $this->db->get();
    // 	return $query->result_array();
    // }

    // public function getSearchTenderLim($keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby, $limit, $start)
    // {
    // 	$wilayah = json_decode(str_replace('&quot;', '', $wilayah), true);
    // 	$klpd = json_decode(str_replace('&quot;', '', $klpd), true);
    // 	$jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
    // 	// $hps = str_replace(['&quot;', '[', ']'],'',$hps);
    // 	$hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
    // 	$kualifikasi = explode(',', str_replace(['&quot;', '[', ']'], '', $kualifikasi));
    // 	$tahun = json_decode(str_replace('&quot;', '', $tahun), true);
    // 	$tahapan = json_decode(str_replace('&quot;', '', $tahapan), true);
    // 	$orderby = json_decode(str_replace('&quot;', '', $orderby), true);
    // 	// var_dump($orderby);

    // 	// Mengambil id_lpse yang berada pada suatu wilayah
    // 	$idLPSEWilayah = $this->db->where_in('id_wilayah', $wilayah)->get('lpse')->result_array();
    // 	$id_lpseWil = [];
    // 	if (count($idLPSEWilayah) > 0) {
    // 		$id_lpseWil = [];
    // 		foreach ($idLPSEWilayah as $idLPSE) {
    // 			$id_lpseWil[] = $idLPSE['id_lpse'];
    // 		}
    // 	} else {
    // 		$id_lpseWil = 'null';
    // 	}
    // 	// ------------------------------------------------

    // 	// // Mengambil id_lpse yang berada pada suatu kategori
    // 	// $idLPSEKlpd = $this->db->where_in('id_kategori', $klpd)->get('lpse')->result_array();
    // 	// if(count($idLPSEKlpd)>0){
    // 	// 	$id_lpseKlpd = [];
    // 	// 	foreach ($idLPSEKlpd as $idLPSE) {
    // 	// 		$id_lpseKlpd[] = $idLPSE['id_lpse'];
    // 	// 	}
    // 	// } else {
    // 	// 	$id_lpseKlpd = 'null';
    // 	// }
    // 	// // ------------------------------------------------

    // 	$this->db->select(['*', 'tender.status AS tender_status', 'lpse.status AS lpse_status']);
    // 	$this->db->from('tender');
    // 	$this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
    // 	$this->db->join('lpse', 'tender.id_lpse = lpse.id_lpse');
    // 	$this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
    // 	$this->db->join('kategori_lpse', 'lpse.id_kategori = kategori_lpse.id_kategori');
    // 	// $this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
    // 	// $this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
    // 	// var_dump($kualifikasi[0]);
    // 	if ($tahapan !== null) {
    // 		// var_dump("cek");
    // 		$this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
    // 		$this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
    // 		$this->db->where_in('tahapan.id_tahapan', $tahapan);
    // 	}
    // 	if ($keyword !== "") {
    // 		$this->db->group_start();
    // 		// $this->db->like('kategori_lpse.nama_kategori', $keyword);
    // 		// $this->db->or_like('tender.nama_tender', $keyword);
    // 		$this->db->like('tender.nama_tender', $keyword);
    // 		$this->db->or_like('lpse.nama_lpse', $keyword);
    // 		$this->db->group_end();
    // 	}
    // 	if ($wilayah !== null) {
    // 		$this->db->where_in('tender.id_lpse', $id_lpseWil);
    // 	}
    // 	if ($klpd !== null) {
    // 		$this->db->where_in('tender.id_lpse', $klpd);
    // 	}
    // 	if ($jenisPengadaan !== null) {
    // 		$this->db->where_in('tender.id_jenis', $jenisPengadaan);
    // 	}
    // 	if ($hps !== null) {
    // 		for ($i = 0; $i < count($hps); $i++) {
    // 			if (strpbrk($hps[$i], "/")) {
    // 				$str = explode("/", $hps[$i]);
    // 				$this->db->where("tender.nilai_hps >", (int)$str[0]);
    // 				$this->db->where("tender.nilai_hps <", (int)$str[1]);
    // 			} else {
    // 				$str = explode("than", $hps[$i]);
    // 				if (count($str) > 1) {
    // 					if ($str[0] === "less") {
    // 						$this->db->where("tender.nilai_hps <", (int)$str[1]);
    // 					} else {
    // 						$this->db->where("tender.nilai_hps >", (int)$str[1]);
    // 					}
    // 				}
    // 			}
    // 		}
    // 	}
    // 	if ($kualifikasi[0] !== "" && $kualifikasi[0] !== "null") {
    // 		$this->db->where_in('kualifikasi', $kualifikasi);
    // 	}
    // 	if ($tahun !== null) {
    // 		$this->db->where_in('tender.tahun_anggaran', $tahun);
    // 	}
    // 	if ($orderby !== null) {
    // 		// Nama Tender
    // 		if ($orderby[0] == 1) {
    // 			$this->db->order_by('tender.nama_tender', 'asc');
    // 		} else if ($orderby[0] == 2) {
    // 			$this->db->order_by('tender.nama_tender', 'desc');
    // 		}
    // 		// Jenis Pengadaan
    // 		if ($orderby[1] == 1) {
    // 			$this->db->order_by('jenis_tender', 'asc');
    // 		} else if ($orderby[1] == 2) {
    // 			$this->db->order_by('jenis_tender', 'desc');
    // 		}
    // 		// // tahapan
    // 		// if ($orderby[2] == 1) {
    // 		// 	$this->db->order_by('jenis_tender', 'asc');
    // 		// } else if ($orderby[2] == 2) {
    // 		// 	$this->db->order_by('jenis_tender', 'desc');
    // 		// }
    // 		// hps
    // 		if ($orderby[3] == 1) {
    // 			$this->db->order_by('nilai_hps', 'asc');
    // 		} else if ($orderby[3] == 2) {
    // 			$this->db->order_by('nilai_hps', 'desc');
    // 		}
    // 	} else {
    // 		$this->db->order_by('tender.tgl_pembuatan', 'desc');
    // 	}
    // 	// $this->db->order_by('id_tender', 'asc');
    // 	$this->db->limit($limit, $start);
    // 	$query = $this->db->get();
    // 	return $query->result_array();
    // }

    // public function getSearchTenderC($keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby)
    // {
    // 	$wilayah = json_decode(str_replace('&quot;', '', $wilayah), true);
    // 	$klpd = json_decode(str_replace('&quot;', '', $klpd), true);
    // 	$jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
    // 	// $hps = str_replace(['&quot;', '[', ']'],'',$hps);
    // 	$hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
    // 	$kualifikasi = explode(',', str_replace(['&quot;', '[', ']'], '', $kualifikasi));
    // 	$tahun = json_decode(str_replace('&quot;', '', $tahun), true);
    // 	$tahapan = json_decode(str_replace('&quot;', '', $tahapan), true);
    // 	$orderby = json_decode(str_replace('&quot;', '', $orderby), true);
    // 	// var_dump($orderby);

    // 	// Mengambil id_lpse yang berada pada suatu wilayah
    // 	$idLPSEWilayah = $this->db->where_in('id_wilayah', $wilayah)->get('lpse')->result_array();
    // 	if (count($idLPSEWilayah) > 0) {
    // 		$id_lpseWil = [];
    // 		foreach ($idLPSEWilayah as $idLPSE) {
    // 			$id_lpseWil[] = $idLPSE['id_lpse'];
    // 		}
    // 	} else {
    // 		$id_lpseWil = 'null';
    // 	}
    // 	// ------------------------------------------------

    // 	// // Mengambil id_lpse yang berada pada suatu kategori
    // 	// $idLPSEKlpd = $this->db->where_in('id_kategori', $klpd)->get('lpse')->result_array();
    // 	// $id_lpseKlpd = [];
    // 	// if(count($idLPSEKlpd)>0){
    // 	// 	$id_lpseKlpd = [];
    // 	// 	foreach ($idLPSEKlpd as $idLPSE) {
    // 	// 		$id_lpseKlpd[] = $idLPSE['id_lpse'];
    // 	// 	}
    // 	// } else {
    // 	// 	$id_lpseKlpd = 'null';
    // 	// }
    // 	// // ------------------------------------------------

    // 	$this->db->select(['*', 'tender.status AS tender_status', 'lpse.status AS lpse_status']);
    // 	$this->db->from('tender');
    // 	$this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
    // 	$this->db->join('lpse', 'tender.id_lpse = lpse.id_lpse');
    // 	$this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
    // 	$this->db->join('kategori_lpse', 'lpse.id_kategori = kategori_lpse.id_kategori');
    // 	// $this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
    // 	// $this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
    // 	// var_dump($kualifikasi[0]);
    // 	if ($tahapan !== null) {
    // 		// var_dump("cek");
    // 		$this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
    // 		$this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
    // 		$this->db->where_in('tahapan.id_tahapan', $tahapan);
    // 	}
    // 	if ($keyword !== "") {
    // 		$this->db->group_start();
    // 		// $this->db->like('kategori_lpse.nama_kategori', $keyword);
    // 		// $this->db->or_like('tender.nama_tender', $keyword);
    // 		$this->db->like('tender.nama_tender', $keyword);
    // 		$this->db->or_like('lpse.nama_lpse', $keyword);
    // 		$this->db->group_end();
    // 	}
    // 	if ($wilayah !== null) {
    // 		$this->db->where_in('tender.id_lpse', $id_lpseWil);
    // 	}
    // 	if ($klpd !== null) {
    // 		$this->db->where_in('tender.id_lpse', $klpd);
    // 	}
    // 	if ($jenisPengadaan !== null) {
    // 		$this->db->where_in('tender.id_jenis', $jenisPengadaan);
    // 	}
    // 	if ($hps !== null) {
    // 		for ($i = 0; $i < count($hps); $i++) {
    // 			if (strpbrk($hps[$i], "/")) {
    // 				$str = explode("/", $hps[$i]);
    // 				$this->db->where("tender.nilai_hps >", (int)$str[0]);
    // 				$this->db->where("tender.nilai_hps <", (int)$str[1]);
    // 			} else {
    // 				$str = explode("than", $hps[$i]);
    // 				if (count($str) > 1) {
    // 					if ($str[0] === "less") {
    // 						$this->db->where("tender.nilai_hps <", (int)$str[1]);
    // 					} else {
    // 						$this->db->where("tender.nilai_hps >", (int)$str[1]);
    // 					}
    // 				}
    // 			}
    // 		}
    // 	}
    // 	if ($kualifikasi[0] !== "" && $kualifikasi[0] !== "null") {
    // 		$this->db->where_in('kualifikasi', $kualifikasi);
    // 	}
    // 	if ($tahun !== null) {
    // 		$this->db->where_in('tender.tahun_anggaran', $tahun);
    // 	}
    // 	if ($orderby !== null) {
    // 		// Nama Tender
    // 		if ($orderby[0] == 1) {
    // 			$this->db->order_by('tender.nama_tender', 'asc');
    // 		} else if ($orderby[0] == 2) {
    // 			$this->db->order_by('tender.nama_tender', 'desc');
    // 		}
    // 		// Jenis Pengadaan
    // 		if ($orderby[1] == 1) {
    // 			$this->db->order_by('jenis_tender', 'asc');
    // 		} else if ($orderby[1] == 2) {
    // 			$this->db->order_by('jenis_tender', 'desc');
    // 		}
    // 		// // tahapan
    // 		// if ($orderby[2] == 1) {
    // 		// 	$this->db->order_by('jenis_tender', 'asc');
    // 		// } else if ($orderby[2] == 2) {
    // 		// 	$this->db->order_by('jenis_tender', 'desc');
    // 		// }
    // 		// hps
    // 		if ($orderby[3] == 1) {
    // 			$this->db->order_by('nilai_hps', 'asc');
    // 		} else if ($orderby[3] == 2) {
    // 			$this->db->order_by('nilai_hps', 'desc');
    // 		}
    // 	} else {
    // 		$this->db->order_by('tender.tgl_pembuatan', 'desc');
    // 	}
    // 	// $this->db->order_by('id_tender', 'asc');
    // 	$query = $this->db->get();
    // 	return $query->num_rows();
    // }

    public function getSearchTender($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby)
    {
        $wilayah = json_decode(str_replace('&quot;', '', $wilayah), true);
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $kualifikasi = explode(',', str_replace(['&quot;', '[', ']'], '', $kualifikasi));
        $keyword = explode(',', str_replace(['&quot;', '[', ']'], '', $keyword));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);
        $tahapan = json_decode(str_replace('&quot;', '', $tahapan), true);
        $orderby = json_decode(str_replace('&quot;', '', $orderby), true);
        // $orderby = str_replace(['&quot;', '[', ']'], '', $orderby);
        // var_dump($orderby);

        // Mengambil id_lpse yang berada pada suatu wilayah
        $idLPSEWilayah = $this->db->where_in('id_wilayah', $wilayah)->get('lpse')->result_array();
        $id_lpseWil = [];
        if (count($idLPSEWilayah) > 0) {
            $id_lpseWil = [];
            foreach ($idLPSEWilayah as $idLPSE) {
                $id_lpseWil[] = $idLPSE['id_lpse'];
            }
        } else {
            $id_lpseWil = 'null';
        }
        // ------------------------------------------------

        // // Mengambil id_lpse yang berada pada suatu kategori
        // $idLPSEKlpd = $this->db->where_in('id_kategori', $klpd)->get('lpse')->result_array();
        // $id_lpseKlpd = [];
        // if(count($idLPSEKlpd)>0){
        // 	$id_lpseKlpd = [];
        // 	foreach ($idLPSEKlpd as $idLPSE) {
        // 		$id_lpseKlpd[] = $idLPSE['id_lpse'];
        // 	}
        // } else {
        // 	$id_lpseKlpd = 'null';
        // }
        // // ------------------------------------------------

        $this->db->select(['*']);
        $this->db->from('tender_list');

        if ($tahapan !== null) {
            $this->db->where_in('id_tahapan', $tahapan);
        }
        if ($search !== "") {
            $this->db->group_start();
            $this->db->like('nama_tender', $search);
            $this->db->or_like('nama_lpse', $search);
            $this->db->group_end();
        }
        if ($keyword[0] !== "null") {
            $this->db->where_in('nama_tender', $keyword);
            $this->db->or_where_in('nama_lpse', $keyword);
            for ($i = 0; $i < count($keyword); $i++) {
                $this->db->group_start();
                $this->db->where("nama_tender =", $keyword[$i]);
                $this->db->or_where("nama_tender =", $keyword[$i]);
                $this->db->group_end();
                if ($i > 0) {
                    $this->db->group_start();
                    $this->db->where("nama_tender =", $keyword[$i]);
                    $this->db->or_where("nama_tender =", $keyword[$i]);
                    $this->db->group_end();
                }
            }
        }
        // if ($keyword !== "") {
        // 	$this->db->group_start();
        // 	// $this->db->like('kategori_lpse.nama_kategori', $keyword);
        // 	// $this->db->or_like('tender.nama_tender', $keyword);
        // 	$this->db->where_in('nama_tender', $keyword);
        // 	$this->db->or_where_in('nama_lpse', $keyword);
        // 	// $this->db->like('nama_tender', $keyword);
        // 	// $this->db->or_like('nama_lpse', $keyword);
        // 	$this->db->group_end();
        // }
        if ($wilayah !== null) {
            $this->db->where_in('id_lpse', $id_lpseWil);
        }
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
        if ($kualifikasi[0] !== "" && $kualifikasi[0] !== "null") {
            for ($i = 0; $i < count($kualifikasi); $i++) {
                $this->db->where("kualifikasi =", $kualifikasi[$i]);
                if ($i > 0) {
                    $this->db->or_where("kualifikasi =", $kualifikasi[$i]);
                }
            }
        }
        if ($tahun !== null) {
            $this->db->where_in('DATE_FORMAT(tgl_pembuatan, "%Y")', $tahun);
        }
        if ($orderby !== null) {
            // Nama Tender
            if ($orderby[0] == 1) {
                $this->db->order_by('tender_list.nama_tender', 'asc');
                $query = $this->db->get();
                return $query->result_array();
            } elseif ($orderby[0] == 2) {
                $this->db->order_by('tender_list.nama_tender', 'desc');
                $query = $this->db->get();
                return $query->result_array();
            } elseif // // Jenis Pengadaan
            // if ($orderby[1] == 1) {
            // 	$this->db->order_by('jenis_tender', 'asc');
            // 	$query = $this->db->get();
            //	return $query->result_array();
            // } else if ($orderby[1] == 2) {
            // 	$this->db->order_by('jenis_tender', 'desc');
            //	$query = $this->db->get();
            //	return $query->result_array();
            // } else
            // // tahapan
            // if ($orderby[2] == 1) {
            // 	$this->db->order_by('tender_status', 'asc');
            // 	$query = $this->db->get();
            //	return $query->result_array();
            // } else if ($orderby[2] == 2) {
            // 	$this->db->order_by('tender_status', 'desc');
            //	$query = $this->db->get();
            //	return $query->result_array();
            // } else
            // hps
            ($orderby[3] == 1) {
                $this->db->order_by('nilai_hps', 'asc');
                $query = $this->db->get();
                return $query->result_array();
            } elseif ($orderby[3] == 2) {
                $this->db->order_by('nilai_hps', 'desc');
                $query = $this->db->get();
                return $query->result_array();
            }
        } else {
            $this->db->order_by('tender_list.tgl_pembuatan', 'desc');
            $query = $this->db->get();
            return $query->result_array();
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSearchTenderLim($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby, $limit, $start)
    {
        $wilayah = json_decode(str_replace('&quot;', '', $wilayah), true);
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $kualifikasi = explode(',', str_replace(['&quot;', '[', ']'], '', $kualifikasi));
        $keyword = explode(',', str_replace(['&quot;', '[', ']'], '', $keyword));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);
        $tahapan = json_decode(str_replace('&quot;', '', $tahapan), true);
        $orderby = json_decode(str_replace('&quot;', '', $orderby), true);
        // var_dump($orderby);

        // Mengambil id_lpse yang berada pada suatu wilayah
        $idLPSEWilayah = $this->db->where_in('id_wilayah', $wilayah)->get('lpse')->result_array();
        $id_lpseWil = [];
        if (count($idLPSEWilayah) > 0) {
            $id_lpseWil = [];
            foreach ($idLPSEWilayah as $idLPSE) {
                $id_lpseWil[] = $idLPSE['id_lpse'];
            }
        } else {
            $id_lpseWil = 'null';
        }
        // ------------------------------------------------

        // // Mengambil id_lpse yang berada pada suatu kategori
        // $idLPSEKlpd = $this->db->where_in('id_kategori', $klpd)->get('lpse')->result_array();
        // if(count($idLPSEKlpd)>0){
        // 	$id_lpseKlpd = [];
        // 	foreach ($idLPSEKlpd as $idLPSE) {
        // 		$id_lpseKlpd[] = $idLPSE['id_lpse'];
        // 	}
        // } else {
        // 	$id_lpseKlpd = 'null';
        // }
        // // ------------------------------------------------

        $this->db->select(['*']);
        $this->db->from('tender_list');

        if ($tahapan !== null) {
            $this->db->where_in('id_tahapan', $tahapan);
        }
        if ($search !== "") {
            $this->db->group_start();
            $this->db->like('nama_tender', $search);
            $this->db->or_like('nama_lpse', $search);
            $this->db->group_end();
        }
        if ($keyword[0] !== "null") {
            $this->db->where_in('nama_tender', $keyword);
            $this->db->or_where_in('nama_lpse', $keyword);
            for ($i = 0; $i < count($keyword); $i++) {
                $this->db->group_start();
                $this->db->where("nama_tender =", $keyword[$i]);
                $this->db->or_where("nama_tender =", $keyword[$i]);
                $this->db->group_end();
                if ($i > 0) {
                    $this->db->group_start();
                    $this->db->where("nama_tender =", $keyword[$i]);
                    $this->db->or_where("nama_tender =", $keyword[$i]);
                    $this->db->group_end();
                }
            }
        }
        // if ($keyword !== "") {
        // 	$this->db->group_start();
        // 	// $this->db->like('kategori_lpse.nama_kategori', $keyword);
        // 	// $this->db->or_like('tender.nama_tender', $keyword);
        // 	$this->db->where_in('nama_tender', $keyword);
        // 	$this->db->or_where_in('nama_lpse', $keyword);
        // 	// $this->db->like('nama_tender', $keyword);
        // 	// $this->db->or_like('nama_lpse', $keyword);
        // 	$this->db->group_end();
        // }
        if ($wilayah !== null) {
            $this->db->where_in('id_lpse', $id_lpseWil);
        }
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
        if ($kualifikasi[0] !== "" && $kualifikasi[0] !== "null") {
            $this->db->where_in('kualifikasi', $kualifikasi);
        }
        if ($tahun !== null) {
            $this->db->where_in('DATE_FORMAT(tgl_pembuatan, "%Y")', $tahun);
        }
        if ($orderby !== null) {
            // Nama Tender
            if ($orderby[0] == 1) {
                $this->db->order_by('tender_list.nama_tender', 'asc');
                $this->db->limit($limit, $start);
                $query = $this->db->get();
                return $query->result_array();
            } elseif ($orderby[0] == 2) {
                $this->db->order_by('tender_list.nama_tender', 'desc');
                $this->db->limit($limit, $start);
                $query = $this->db->get();
                return $query->result_array();
            } elseif // // Jenis Pengadaan
            // if ($orderby[1] == 1) {
            // 	$this->db->order_by('jenis_tender', 'asc');
            //  $this->db->limit($limit, $start);
            // 	$query = $this->db->get();
            //	return $query->result_array();
            // } else if ($orderby[1] == 2) {
            // 	$this->db->order_by('jenis_tender', 'desc');
            //  $this->db->limit($limit, $start);
            //	$query = $this->db->get();
            //	return $query->result_array();
            // } else
            // // tahapan
            // if ($orderby[2] == 1) {
            // 	$this->db->order_by('tender_status', 'asc');
            //  $this->db->limit($limit, $start);
            // 	$query = $this->db->get();
            //	return $query->result_array();
            // } else if ($orderby[2] == 2) {
            // 	$this->db->order_by('tender_status', 'desc');
            //  $this->db->limit($limit, $start);
            //	$query = $this->db->get();
            //	return $query->result_array();
            // } else
            // hps
            ($orderby[3] == 1) {
                $this->db->order_by('nilai_hps', 'asc');
                $this->db->limit($limit, $start);
                $query = $this->db->get();
                return $query->result_array();
            } elseif ($orderby[3] == 2) {
                $this->db->order_by('nilai_hps', 'desc');
                $this->db->limit($limit, $start);
                $query = $this->db->get();
                return $query->result_array();
            }
        } else {
            $this->db->order_by('tender_list.tgl_pembuatan', 'desc');
            $this->db->limit($limit, $start);
            $query = $this->db->get();
            return $query->result_array();
        }
        // $this->db->order_by('id_tender', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSearchTenderC($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby)
    {
        // $keyword = json_decode(str_replace('&quot;', '', $keyword), true);
        $wilayah = json_decode(str_replace('&quot;', '', $wilayah), true);
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $kualifikasi = explode(',', str_replace(['&quot;', '[', ']'], '', $kualifikasi));
        $keyword = explode(',', str_replace(['&quot;', '[', ']'], '', $keyword));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);
        $tahapan = json_decode(str_replace('&quot;', '', $tahapan), true);
        $orderby = json_decode(str_replace('&quot;', '', $orderby), true);
        // var_dump($keyword);
        // var_dump(json_decode($keyword));

        // Mengambil id_lpse yang berada pada suatu wilayah
        $idLPSEWilayah = $this->db->where_in('id_wilayah', $wilayah)->get('lpse')->result_array();
        if (count($idLPSEWilayah) > 0) {
            $id_lpseWil = [];
            foreach ($idLPSEWilayah as $idLPSE) {
                $id_lpseWil[] = $idLPSE['id_lpse'];
            }
        } else {
            $id_lpseWil = 'null';
        }
        // ------------------------------------------------

        // // Mengambil id_lpse yang berada pada suatu kategori
        // $idLPSEKlpd = $this->db->where_in('id_kategori', $klpd)->get('lpse')->result_array();
        // $id_lpseKlpd = [];
        // if(count($idLPSEKlpd)>0){
        // 	$id_lpseKlpd = [];
        // 	foreach ($idLPSEKlpd as $idLPSE) {
        // 		$id_lpseKlpd[] = $idLPSE['id_lpse'];
        // 	}
        // } else {
        // 	$id_lpseKlpd = 'null';
        // }
        // // ------------------------------------------------

        $this->db->select(['*']);
        $this->db->from('tender_list');

        if ($tahapan !== null) {
            $this->db->where_in('id_tahapan', $tahapan);
        }
        if ($search !== "") {
            $this->db->group_start();
            $this->db->like('nama_tender', $search);
            $this->db->or_like('nama_lpse', $search);
            $this->db->group_end();
        }
        if ($keyword[0] !== "null") {
            $this->db->where_in('nama_tender', $keyword);
            $this->db->or_where_in('nama_lpse', $keyword);
            for ($i = 0; $i < count($keyword); $i++) {
                $this->db->group_start();
                $this->db->where("nama_tender =", $keyword[$i]);
                $this->db->or_where("nama_tender =", $keyword[$i]);
                $this->db->group_end();
                if ($i > 0) {
                    $this->db->group_start();
                    $this->db->where("nama_tender =", $keyword[$i]);
                    $this->db->or_where("nama_tender =", $keyword[$i]);
                    $this->db->group_end();
                }
            }
        }
        // if ($keyword !== "") {
        // 	$this->db->group_start();
        // 	// $this->db->like('kategori_lpse.nama_kategori', $keyword);
        // 	// $this->db->or_like('tender.nama_tender', $keyword);
        // 	$this->db->where_in('nama_tender', $keyword);
        // 	$this->db->or_where_in('nama_lpse', $keyword);
        // 	// $this->db->like('nama_tender', $keyword);
        // 	// $this->db->or_like('nama_lpse', $keyword);
        // 	$this->db->group_end();
        // }
        if ($wilayah !== null) {
            $this->db->where_in('id_lpse', $id_lpseWil);
        }
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
        if ($kualifikasi[0] !== "" && $kualifikasi[0] !== "null") {
            $this->db->where_in('kualifikasi', $kualifikasi);
        }
        if ($tahun !== null) {
            $this->db->where_in('DATE_FORMAT(tgl_pembuatan, "%Y")', $tahun);
        }
        if ($orderby !== null) {
            // Nama Tender
            if ($orderby[0] == 1) {
                $this->db->order_by('tender_list.nama_tender', 'asc');
                $query = $this->db->get();
                return $query->num_rows();
            } elseif ($orderby[0] == 2) {
                $this->db->order_by('tender_list.nama_tender', 'desc');
                $query = $this->db->get();
                return $query->num_rows();
            } elseif // // Jenis Pengadaan
            // if ($orderby[1] == 1) {
            // 	$this->db->order_by('jenis_tender', 'asc');
            // 	$query = $this->db->get();
            //	return $query->num_rows();
            // } else if ($orderby[1] == 2) {
            // 	$this->db->order_by('jenis_tender', 'desc');
            //	$query = $this->db->get();
            //	return $query->num_rows();
            // } else
            // // tahapan
            // if ($orderby[2] == 1) {
            // 	$this->db->order_by('tender_status', 'asc');
            // 	$query = $this->db->get();
            //	return $query->num_rows();
            // } else if ($orderby[2] == 2) {
            // 	$this->db->order_by('tender_status', 'desc');
            //	$query = $this->db->get();
            //	return $query->num_rows();
            // } else
            // hps
            ($orderby[3] == 1) {
                $this->db->order_by('nilai_hps', 'asc');
                $query = $this->db->get();
                return $query->num_rows();
            } elseif ($orderby[3] == 2) {
                $this->db->order_by('nilai_hps', 'desc');
                $query = $this->db->get();
                return $query->num_rows();
            }
        } else {
            $this->db->order_by('tender_list.tgl_pembuatan', 'desc');
            $query = $this->db->get();
            return $query->num_rows();
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTenderById($id)
    {
        $this->db->where('id_tender', $id);
        $query = $this->db->get('tender');
        return $query->row_array();
    }

    // public function checkNewTender()
    // {
    // 	$this->load->helper('date');

    // 	$this->db->select(['id_tender', 'nama_tender']);
    // 	$this->db->from('tender');
    // 	$this->db->where('tgl_pembuatan BETWEEN "' . date('Y-m-d') . '" - INTERVAL 24 HOUR AND "' . date('Y-m-d') . '"');
    // 	$query = $this->db->get();
    // 	return $query->result_array();
    // }

    // public function preferenceNewTender()
    // {
    // 	$this->load->helper('date');

    // 	$this->db->select(['tender.id_tender', 'tender.nama_tender', 'preferensi.id_pengguna', 'pengguna.nama', 'pengguna.email', 'tender.id_lpse', 'lpse.nama_lpse', 'lpse.id_kategori', 'kategori_lpse.nama_kategori']);
    // 	$this->db->from('tender');
    // 	$this->db->join('preferensi', 'tender.id_lpse IN (preferensi.id_lpse)');
    // 	$this->db->join('pengguna', 'pengguna.id_pengguna = preferensi.id_pengguna');
    // 	$this->db->join('lpse', 'lpse.id_lpse = tender.id_lpse');
    // 	$this->db->join('kategori_lpse', 'kategori_lpse.id_kategori = lpse.id_kategori');
    // 	$this->db->where('tgl_pembuatan BETWEEN "' . date('Y-m-d') . '" - INTERVAL 24 HOUR AND "' . date('Y-m-d') . '"');
    // 	$query = $this->db->get();
    // 	return $query->result_array();
    // }

    public function getTenderNotif2()
    {
        // $this->load->helper('date');

        $this->db->select(['tender_terbaru.id', 'tender_terbaru.nama_tender', 'tender_terbaru.id_lpse', 'lpse.nama_lpse', 'lpse.id_kategori', 'kategori_lpse.nama_kategori']);
        $this->db->from('tender_terbaru');
        // $this->db->join('preferensi', 'tender_terbaru.id_lpse IN (preferensi.id_lpse)');
        // $this->db->join('pengguna', 'pengguna.id_pengguna = preferensi.id_pengguna');
        $this->db->join('lpse', 'lpse.id_lpse = tender_terbaru.id_lpse');
        $this->db->join('kategori_lpse', 'kategori_lpse.id_kategori = lpse.id_kategori');
        $this->db->where('tgl_pembuatan BETWEEN "' . date('Y-m-d') . '" - INTERVAL 24 HOUR AND "' . date('Y-m-d') . '"');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTenderNotif()
    {
        $this->db->select([
            'tender_terbaru.id',
            'tender_terbaru.nama_tender',
            'GROUP_CONCAT(DISTINCT REPLACE(preferensi.id_lpse, "|", ", ") ORDER BY preferensi.id_pengguna ASC) AS id_lpse_list',
            'pengguna.nama',
            'pengguna.email',
            'tender_terbaru.id_lpse',
            'lpse.nama_lpse',
            'lpse.id_kategori',
            'kategori_lpse.nama_kategori'
        ]);
        $this->db->from('tender_terbaru');
        $this->db->join('preferensi', 'FIND_IN_SET(tender_terbaru.id_lpse, REPLACE(preferensi.id_lpse, "|", ",")) > 0');
        $this->db->join('pengguna', 'pengguna.id_pengguna = preferensi.id_pengguna');
        $this->db->join('lpse', 'lpse.id_lpse = tender_terbaru.id_lpse');
        $this->db->join('kategori_lpse', 'kategori_lpse.id_kategori = lpse.id_kategori');
        $this->db->where('tender_terbaru.tgl_pembuatan BETWEEN DATE_SUB(CURRENT_DATE(), INTERVAL 24 HOUR) AND CURRENT_DATE()');
        $this->db->group_by([
            'tender_terbaru.id',
            'tender_terbaru.nama_tender',
            'pengguna.nama',
            'pengguna.email',
            'tender_terbaru.id_lpse',
            'lpse.nama_lpse',
            'lpse.id_kategori',
            'kategori_lpse.nama_kategori'
        ]);
        
        $query = $this->db->get();
        return $query->result_array();
        
    }

    public function spNewTenderNotification()
    {
        $query = $this->db->query("CALL splitStringAndProcess((SELECT GROUP_CONCAT(id_lpse) FROM preferensi WHERE status = 1), ',')");
        $res = $query->result_array();

        $query->next_result();
        $query->free_result();

        return $res;
    }

    public function newTenderNotification()
    {
        $this->load->helper('date');

        $response = $this->client->request('GET', 'api/tender/sp-notifikasi-tender-baru', $this->client->getConfig('headers'));
        $lpse = json_decode($response->getBody()->getContents(), true);

        $datanew = [];
        foreach ($lpse['data'] as $key => $value) {
            $datanew[] = $value['vals'];
        }

        $dataneww = json_encode($datanew);
        $newImplode = str_replace(['[', ']'], '', $dataneww);

        $this->db->select(['paket.kod_tender', 'paket.nama_tender', 'pengguna.nama', 'pengguna.email', 'pengguna.no_telp',
            'detail_tender.lokasi_pekerjaan', 'lpse.nama_lpse', 'paket.kualifikasi_usaha', 'paket.nilai_hps_paket', 'paket.tahun_anggaran',
            'jenis_tender.jenis_tender', 'detail_tender.nilai_pagu', 'tender.metode_evaluasi', 'paket.tanggal_pembuatan', ]);
        $this->db->from('lpse');
        $this->db->join('preferensi', 'lpse.id_kategori IN (' . $newImplode . ')');
        $this->db->join('pengguna', 'pengguna.id_pengguna = preferensi.id_pengguna');
        $this->db->join('paket', 'paket.id_lpse = lpse.id_lpse');
        $this->db->join('kategori_lpse', 'kategori_lpse.id_kategori = preferensi.id_kategori_lpse');
        $this->db->join('detail_tender', 'detail_tender.id_tender = tender.id_tender');
        $this->db->join('jenis_tender', 'jenis_tender.id_jenis = tender.id_jenis');
        $this->db->where('status_preferensi = 1 AND tgl_pembuatan BETWEEN "' . date('Y-m-d') . '" - INTERVAL 24 HOUR AND "' . date('Y-m-d') . '"');
        $this->db->order_by('paket.tanggal_pembuatan', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function newTenderNotificationByKeyword()
    {
        $this->load->helper('date');

        $response = $this->client->request('GET', 'api/tender/sp-notifikasi-tender-baru', $this->client->getConfig('headers'));
        $lpse = json_decode($response->getBody()->getContents(), true);

        $datanew = [];
        foreach ($lpse["data"] as $key => $value) {
            $datanew[] = $value["vals"];
        }

        $dataneww = json_encode($datanew);
        $newImplode = str_replace(['[', ']'], '', $dataneww);

        $this->db->select(['tender.id_tender', 'tender.nama_tender', 'pengguna.nama', 'pengguna.email', 'pengguna.no_telp', 'detail_tender.lokasi_pekerjaan', 'lpse.nama_lpse', 'tender.kualifikasi', 'tender.nilai_hps', 'tender.tahun_anggaran', 'jenis_tender.jenis_tender', 'detail_tender.nilai_pagu', 'tender.metode_evaluasi', 'tender.tgl_pembuatan']);
        $this->db->from('lpse');
        $this->db->join('preferensi', 'lpse.id_kategori IN (' . $newImplode . ')');
        $this->db->join('pengguna', 'pengguna.id_pengguna = preferensi.id_pengguna');
        $this->db->join('tender', 'tender.id_lpse = lpse.id_lpse');
        $this->db->join('kategori_lpse', 'kategori_lpse.id_kategori = preferensi.id_kategori_lpse');
        $this->db->join('detail_tender', 'detail_tender.id_tender = tender.id_tender');
        $this->db->join('jenis_tender', 'jenis_tender.id_jenis = tender.id_jenis');
        $this->db->where('status_preferensi = 1 AND tender.nama_tender REGEXP (REPLACE(REPLACE(keyword, " ", "|"), ",", "|")) AND tgl_pembuatan BETWEEN "' . date('Y-m-d') . '" - INTERVAL 24 HOUR AND "' . date('Y-m-d') . '"');
        $this->db->order_by('tender.tgl_pembuatan', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function newTenderNotificationDashboardUser()
    {
        $this->load->helper('date');

        $response = $this->client->request('GET', 'api/tender/sp-notifikasi-tender-baru', $this->client->getConfig('headers'));
        $lpse = json_decode($response->getBody()->getContents(), true);

        $datanew = [];
        foreach ($lpse["data"] as $key => $value) {
            $datanew[] = $value["vals"];
        }

        $dataneww = json_encode($datanew);
        $newImplode = str_replace(['[', ']'], '', $dataneww);

        $this->db->select(['tender.id_tender', 'tender.nama_tender', 'pengguna.nama', 'pengguna.email', 'pengguna.no_telp', 'detail_tender.lokasi_pekerjaan', 'lpse.nama_lpse', 'tender.kualifikasi', 'tender.nilai_hps', 'tender.tahun_anggaran', 'jenis_tender.jenis_tender', 'detail_tender.nilai_pagu', 'tender.metode_evaluasi', 'tender.tgl_pembuatan']);
        $this->db->from('lpse');
        $this->db->join('preferensi', 'lpse.id_kategori IN (' . $newImplode . ')');
        $this->db->join('pengguna', 'pengguna.id_pengguna = preferensi.id_pengguna');
        $this->db->join('tender', 'tender.id_lpse = lpse.id_lpse');
        $this->db->join('kategori_lpse', 'kategori_lpse.id_kategori = preferensi.id_kategori_lpse');
        $this->db->join('detail_tender', 'detail_tender.id_tender = tender.id_tender');
        $this->db->join('jenis_tender', 'jenis_tender.id_jenis = tender.id_jenis');
        $this->db->where('status_preferensi = 1 AND tender.nama_tender REGEXP (REPLACE(REPLACE(keyword, " ", "|"), ",", "|")) AND tgl_pembuatan BETWEEN "' . date('Y-m-d') . '" - INTERVAL 24 HOUR AND "' . date('Y-m-d') . '"');
        $this->db->group_by('lpse.id_lpse');
        $this->db->order_by('tender.tgl_pembuatan', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function newBlacklistNotification()
    {
        $this->load->helper('date');

        $this->db->select(['tender.id_tender', 'tender.nama_tender', 'pengguna.email', 'detail_tender.lokasi_pekerjaan', 'lpse.nama_lpse', 'tender.kualifikasi', 'tender.nilai_hps', 'tender.tahun_anggaran', 'jenis_tender.jenis_tender', 'detail_tender.nilai_pagu', 'tender.metode_evaluasi']);
        $this->db->from('lpse');
        $this->db->join('preferensi', 'lpse.id_kategori IN (SELECT * FROM temp_string)');
        $this->db->join('pengguna', 'pengguna.id_pengguna = preferensi.id_pengguna');
        $this->db->join('tender', 'tender.id_lpse = lpse.id_lpse');
        $this->db->join('kategori_lpse', 'kategori_lpse.id_kategori = preferensi.id_kategori_lpse');
        $this->db->join('detail_tender', 'detail_tender.id_tender = tender.id_tender');
        $this->db->join('jenis_tender', 'jenis_tender.id_jenis = tender.id_jenis');
        $this->db->where('status_preferensi = 1 AND tgl_pembuatan BETWEEN "' . date('Y-m-d') . '" - INTERVAL 24 HOUR AND "' . date('Y-m-d') . '"');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahTender($data)
    {
        $this->db->insert('tender', $data);
        return $this->db->affected_rows();
    }

    public function ubahTender($id, $data)
    {
        $this->db->where('id_tender', $id);
        $this->db->update('tender', $data);
        return $this->db->affected_rows();
    }

    public function hapusTender($id)
    {
        $this->db->where('id_tender', $id);
        $this->db->delete('tender');
        return $this->db->affected_rows();
    }

    // Halaman Know Your Market
    public function getHpsPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    {
        // 'SELECT SUM(nilai_hps), DATE_FORMAT(tgl_pembuatan, '%Y') AS tahun, DATE_FORMAT(tgl_pembuatan, '%m') AS bulan
        // FROM tender
        // WHERE id_lpse = 10
        // GROUP BY DATE_FORMAT(tgl_pembuatan, '%Y-%m')';
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);
        // var_dump($hps);

        // $cekStatusNotSelesai = ['Evaluasi Ulang', 'Seleksi Ulang', 'Tender Gagal', 'Tender Gagal, Tender Ulang', 'Tender Batal'];

        $this->db->select(["SUM(nilai_hps) as jumlah_hps", "COUNT(id_tender) as jumlah_tender", "DATE_FORMAT(tgl_pembuatan, '%m') AS bulan"]);
        $this->db->from('tender');
        // $this->db->where_not_in('status', $cekStatusNotSelesai);

        if ($klpd !== null) {
            $this->db->where_in('id_lpse', $klpd);
        }
        if ($jenisPengadaan !== null) {
            $this->db->where_in('id_jenis', $jenisPengadaan);
        }
        if ($hps[0] !== "null") {
            if ($hps[0] === '2') {
                $this->db->where("nilai_hps <", 500000000);
            } elseif ($hps[0] === '3') {
                $this->db->where("nilai_hps >", 1000000000);
                $this->db->where("nilai_hps <", 10000000000);
            } elseif ($hps[0] === '4') {
                $this->db->where("nilai_hps >", 10000000000);
                $this->db->where("nilai_hps <", 100000000000);
            } elseif ($hps[0] === '5') {
                $this->db->where("nilai_hps >", 100000000000);
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
            $this->db->where_in('DATE_FORMAT(tgl_pembuatan, "%Y")', $tahun);
        }
        $this->db->group_by('DATE_FORMAT(tgl_pembuatan, "%m")');
        $this->db->order_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTenderSelesaiPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    {
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);
        // var_dump($klpd);

        $cekStatusNotSelesai = ['Evaluasi Ulang', 'Seleksi Ulang', 'Tender Gagal', 'Tender Gagal, Tender Ulang', 'Tender Batal'];

        $this->db->select(['COUNT(id_tender) as jumlah_tender', 'SUM(nilai_hps) as jumlah_hps', 'DATE_FORMAT(tender.tgl_pembuatan, "%m") as bulan']);
        $this->db->from('tender');
        if ($klpd !== null) {
            $this->db->where_in('id_lpse', $klpd);
        }
        if ($jenisPengadaan !== null) {
            $this->db->where_in('id_jenis', $jenisPengadaan);
        }
        if ($hps[0] !== "null") {
            if ($hps[0] === '2') {
                $this->db->where("nilai_hps <", 500000000);
            } elseif ($hps[0] === '3') {
                $this->db->where("nilai_hps >", 1000000000);
                $this->db->where("nilai_hps <", 10000000000);
            } elseif ($hps[0] === '4') {
                $this->db->where("nilai_hps >", 10000000000);
                $this->db->where("nilai_hps <", 100000000000);
            } elseif ($hps[0] === '5') {
                $this->db->where("nilai_hps >", 100000000000);
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
            $this->db->where_in('DATE_FORMAT(tgl_pembuatan, "%Y")', $tahun);
        }
        $this->db->where_not_in('status', $cekStatusNotSelesai);
        $this->db->group_by('DATE_FORMAT(tgl_pembuatan, "%m")');
        $this->db->order_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTenderUlangPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    {
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);
        // var_dump($klpd);

        $cekStatusUlang = ['Evaluasi Ulang', 'Seleksi Ulang'];

        $this->db->select(['COUNT(id_tender) as jumlah_tender', 'SUM(nilai_hps) as jumlah_hps', 'DATE_FORMAT(tender.tgl_pembuatan, "%m") as bulan']);
        $this->db->from('tender');
        if ($klpd !== null) {
            $this->db->where_in('id_lpse', $klpd);
        }
        if ($jenisPengadaan !== null) {
            $this->db->where_in('id_jenis', $jenisPengadaan);
        }
        if ($hps[0] !== "null") {
            if ($hps[0] === '2') {
                $this->db->where("nilai_hps <", 500000000);
            } elseif ($hps[0] === '3') {
                $this->db->where("nilai_hps >", 1000000000);
                $this->db->where("nilai_hps <", 10000000000);
            } elseif ($hps[0] === '4') {
                $this->db->where("nilai_hps >", 10000000000);
                $this->db->where("nilai_hps <", 100000000000);
            } elseif ($hps[0] === '5') {
                $this->db->where("nilai_hps >", 100000000000);
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
            $this->db->where_in('DATE_FORMAT(tgl_pembuatan, "%Y")', $tahun);
        }
        $this->db->where_in('status', $cekStatusUlang);
        $this->db->group_by('DATE_FORMAT(tgl_pembuatan, "%m")');
        $this->db->order_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTenderGagalPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    {
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);
        // var_dump($klpd);

        $cekStatusGagal = ['Tender Gagal', 'Tender Gagal, Tender Ulang', 'Tender Batal'];

        $this->db->select(['COUNT(id_tender) as jumlah_tender', 'SUM(nilai_hps) as jumlah_hps', 'DATE_FORMAT(tender.tgl_pembuatan, "%m") as bulan']);
        $this->db->from('tender');
        if ($klpd !== null) {
            $this->db->where_in('id_lpse', $klpd);
        }
        if ($jenisPengadaan !== null) {
            $this->db->where_in('id_jenis', $jenisPengadaan);
        }
        if ($hps[0] !== "null") {
            if ($hps[0] === '2') {
                $this->db->where("nilai_hps <", 500000000);
            } elseif ($hps[0] === '3') {
                $this->db->where("nilai_hps >", 1000000000);
                $this->db->where("nilai_hps <", 10000000000);
            } elseif ($hps[0] === '4') {
                $this->db->where("nilai_hps >", 10000000000);
                $this->db->where("nilai_hps <", 100000000000);
            } elseif ($hps[0] === '5') {
                $this->db->where("nilai_hps >", 100000000000);
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
            $this->db->where_in('DATE_FORMAT(tgl_pembuatan, "%Y")', $tahun);
        }
        $this->db->where_in('status', $cekStatusGagal);
        $this->db->group_by('DATE_FORMAT(tgl_pembuatan, "%m")');
        $this->db->order_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function getForecastingHps($klpd, $jenisPengadaan, $hps, $tahun)
    // {
    // 	$klpd = json_decode(str_replace('&quot;', '', $klpd), true);
    // 	$jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
    // 	$hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
    // 	$tahun = json_decode(str_replace('&quot;', '', $tahun), true);

    // 	$cekStatusNotSelesai = ['Evaluasi Ulang', 'Seleksi Ulang', 'Tender Gagal', 'Tender Gagal, Tender Ulang', 'Tender Batal'];

    // 	$this->db->select(["SUM(nilai_hps) as jumlah_hps", "COUNT(id_tender) as jumlah_tender", "DATE_FORMAT(tgl_pembuatan, '%m') AS bulan"]);
    // 	$this->db->from('tender');
    // 	$this->db->where_not_in('status', $cekStatusNotSelesai);

    // 	if ($klpd !== null) {
    // 		$this->db->where_in('id_lpse', $klpd);
    // 	}
    // 	if ($jenisPengadaan !== null) {
    // 		$this->db->where_in('id_jenis', $jenisPengadaan);
    // 	}
    // 	if ($hps !== null) {
    // 		for ($i = 0; $i < count($hps); $i++) {
    // 			if (strpbrk($hps[$i], "/")) {
    // 				$str = explode("/", $hps[$i]);
    // 				$this->db->where("nilai_hps >", (int)$str[0]);
    // 				$this->db->where("nilai_hps <", (int)$str[1]);
    // 			} else {
    // 				$str = explode("than", $hps[$i]);
    // 				if (count($str) > 1) {
    // 					if ($str[0] === "less") {
    // 						$this->db->where("nilai_hps <", (int)$str[1]);
    // 					} else {
    // 						$this->db->where("nilai_hps >", (int)$str[1]);
    // 					}
    // 				}
    // 			}
    // 		}
    // 	}
    // 	if ($tahun !== null) {
    // 		$this->db->where_in('DATE_FORMAT(tgl_pembuatan, "%Y")', $tahun);
    // 	}
    // 	$this->db->group_by('DATE_FORMAT(tgl_pembuatan, "%m")');
    // 	$this->db->order_by('bulan');
    // 	$query = $this->db->get();
    // 	return $query->result_array();
    // }

    public function getForecastingTender($klpd, $jenisPengadaan, $hps, $tahun)
    {
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);
        // var_dump($klpd);

        // $cekStatusGagal = ['Tender Gagal', 'Tender Gagal, Tender Ulang', 'Tender Batal'];

        $this->db->select(['COUNT(id_tender) as jumlah_tender', 'DATE_FORMAT(tender.tgl_pembuatan, "%m") as bulan']);
        $this->db->from('tender');
        if ($klpd !== null) {
            $this->db->where_in('id_lpse', $klpd);
        }
        if ($jenisPengadaan !== null) {
            $this->db->where_in('id_jenis', $jenisPengadaan);
        }
        if ($hps[0] !== "null") {
            if ($hps[0] === '2') {
                $this->db->where("nilai_hps <", 500000000);
            } elseif ($hps[0] === '3') {
                $this->db->where("nilai_hps >", 1000000000);
                $this->db->where("nilai_hps <", 10000000000);
            } elseif ($hps[0] === '4') {
                $this->db->where("nilai_hps >", 10000000000);
                $this->db->where("nilai_hps <", 100000000000);
            } elseif ($hps[0] === '5') {
                $this->db->where("nilai_hps >", 100000000000);
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
            $this->db->where_in('DATE_FORMAT(tgl_pembuatan, "%Y")', $tahun);
        }
        // $this->db->where_in('status', $cekStatusGagal);
        $this->db->group_by('DATE_FORMAT(tgl_pembuatan, "%m")');
        $this->db->order_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getdatastatistik()
    {
        $this->db->select('count(id_tender)');
        $this->db->from('tender');
        $total_tender = $this->db->get_compiled_select();

        $this->db->select('count(id_rup)');
        $this->db->from('rup');
        $total_rup = $this->db->get_compiled_select();

        // $this->db->select("*");
        $this->db->select("($total_tender) as total_tender");
        $this->db->select("($total_rup) as total_rup");
        $this->db->select('count(id_lpse) as total_lpse');
        $this->db->from('lpse');
        $query = $this->db->get();
        return $query->result_array();
    }
}
