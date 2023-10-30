<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Analytic_model extends CI_Model {

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

    // public $interval_pemenang = 30;

    public function getPreferensiPengguna($id_pengguna)
    {
        return $this->db->query("SELECT IF(REPLACE(id_lpse,'|',',')<>'',REPLACE(id_lpse,'|',','),'0') AS id_lpse,IF(jenis_pengadaan<>'',jenis_pengadaan,'0') AS jenis_pengadaan FROM preferensi WHERE id_pengguna={$id_pengguna}")->row();
    }

    // Get nama peserta dari tabel peserta dan jumlah ikut tender dari tabel peserta tender dengan menyamakan npwp di tabel peserta_tender dan peserta
    public function getPesertaTender($data)
    {
        $id_pengguna = $data['id_pengguna'];
        $page_size = $data['pageSize'];
        $page_number = ($data['pageNumber'] - 1) * $page_size;

        $preferensi = $this->getPreferensiPengguna($id_pengguna);
        $kriteria = $order = '';
        $keyword = $data['keyword'];

        if ($keyword) {
            $kriteria = "AND nama_peserta LIKE '%{$keyword}%'";
        }

        if ($preferensi) {
            $id_lpse = $preferensi->id_lpse;
            $jenis_pengadaan = $preferensi->jenis_pengadaan;
            $kriteria .= " AND id_lpse IN ({$id_lpse}) AND jenis_pengadaan IN ({$jenis_pengadaan})";
        }

        // $this->db->select('p.nama_peserta AS NamaPeserta, COUNT(pt.kode_tender) AS CountTenders');
        // $this->db->from('peserta p');
        // $this->db->join('peserta_tender_copy pt', 'p.npwp = pt.npwp', 'left');
        // $this->db->group_by('p.npwp, p.nama_peserta');
        // $this->db->order_by('CountTenders', 'DESC');
        // $this->db->limit($page_size, $page_number);

        // $query = $this->db->get();
        // return $query->result();

        $query = "SELECT p.nama_peserta AS NamaPeserta, COUNT(pt.kode_tender) AS CountTenders
        FROM peserta p, preferensi
        LEFT JOIN peserta_tender_copy pt
        ON p.npwp = pt.npwp
        WHERE preferensi.id_pengguna={$id_pengguna} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
        GROUP BY p.npwp, p.nama_peserta
        ORDER BY CountTenders DESC
        LIMIT {$page_number},{$page_size}";

        return $this->db->query($query);
    }

    // Get jumlah pemenang tender from table pemenang group by months
    public function getWinner($id_pengguna) {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        $sql = "SELECT
        COUNT(id_pemenang) AS jumlah_pemenang, MONTHNAME(tgl_pemenang) AS bulan
        FROM pemenang, preferensi
        WHERE preferensi.id_pengguna={$id_pengguna} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
        GROUP BY MONTHNAME(tgl_pemenang)
        ORDER BY bulan DESC";

        return $this->db->query($sql);
    }

    public function getPesertaMendaftar($id_pengguna) {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        $sql = "SELECT
        COUNT(DISTINCT peserta_tender_copy.npwp) AS jumlah_peserta, MONTHNAME(tgl_tender) AS bulan
        FROM peserta_tender_copy, preferensi
        WHERE preferensi.id_pengguna={$id_pengguna} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',peserta_tender_copy.id_lpse<>'',peserta_tender_copy.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',peserta_tender_copy.jenis_tender<>'',peserta_tender_copy.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
        GROUP BY MONTHNAME(tgl_tender)
        ORDER BY bulan DESC";

        return $this->db->query($sql);
    }    
}