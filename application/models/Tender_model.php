<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use Amp\Emitter;
use Amp\Mysql\Pool;

// use Amp\Loop;
use function Amp\call;

class Tender_model extends CI_Model
{
    use \App\components\traits\AsyncConnection;

    private $_client;

    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => base_url('api/'),
            'timeout' => 100.0,
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
    }

    public $interval_pemenang = 30;
    public $limit_notifikasi = 25;

    public function getStatistik()
    {
        $penyedia = $this->db->select('COUNT(*) AS total')->get('peserta')->row();
        $lpse = $this->db->select('COUNT(*) AS total')->get('lpse')->row();
        $tender = $this->db->select('COUNT(*) AS total')->get('paket')->row();

        $data = [
            'total_penyedia' => $penyedia->total,
            'total_lpse' => $lpse->total,
            'total_tender' => $tender->total
        ];

        return $data;
    }

    public function getTenderById($id)
    {
        $sql = "SELECT tender_terbaru.kode_tender,tender_terbaru.nama_tender,jenis_tender,nama_lpse,satuan_kerja,paket.lokasi_pekerjaan,tanggal_pembuatan,tahun_anggaran,ROUND(nilai_pagu_paket,0) AS nilai_pagu,ROUND(hps,0) AS nilai_hps,nama_tahap AS tahap_tender,peserta_tender,akhir_daftar,CONCAT(url,'/lelang/',tender_terbaru.kode_tender,'/pengumumanlelang') AS link_sumber
                FROM tender_terbaru
                INNER JOIN lpse ON tender_terbaru.id_lpse=lpse.id_lpse
                INNER JOIN jenis_tender ON tender_terbaru.jenis_pengadaan=jenis_tender.id_jenis
                LEFT JOIN paket ON tender_terbaru.kode_tender=paket.kode_tender
                LEFT JOIN tahap ON paket.tahap_tender_saat_ini=tahap.id_tahap
                WHERE tender_terbaru.kode_tender={$id}";

        return $this->db->query($sql);

        /*$select = "tender_terbaru.kode_tender, tender_terbaru.nama_tender, jenis_tender, ROUND(hps,0) AS hps, akhir_daftar, nama_lpse, foto, url, CONCAT(url, '/lelang/', tender_terbaru.kode_tender, '/pengumumanlelang') AS link_sumber, ";
        $select .= "DATEDIFF(CURRENT_DATE, tgl_update) AS update_hari, satuan_kerja, tanggal_pembuatan, tahun_anggaran, nilai_pagu_paket, peserta_tender, lokasi_pekerjaan, ";
        $select .= "nama_tahap AS current_step";
        $query = $this->db->select($select)
            ->from('tender_terbaru')
            ->join('paket', 'tender_terbaru.kode_tender = paket.kode_tender', 'left')
            ->join('lpse', 'tender_terbaru.id_lpse = lpse.id_lpse', 'left')
            ->join('jenis_tender', 'tender_terbaru.jenis_pengadaan = jenis_tender.id_jenis', 'left')
            ->join('tahap', 'paket.tahap_tender_saat_ini = tahap.id_tahap', 'left')
            ->where('tender_terbaru.kode_tender', $id)
            ->get();
        return $query->row();*/
    }

    public function getWinnerById($id)
    {
        $sql = "SELECT pemenang.kode_tender,npwp,nama_pemenang,CONCAT(pemenang.alamat,' ',kabupaten,' ',provinsi) AS alamat,pemenang.nama_tender,jenis_tender.jenis_tender,nama_lpse,satuan_kerja,pemenang.lokasi_pekerjaan,tanggal_pembuatan,tahun_anggaran,ROUND(nilai_hps,0) AS nilai_hps,ROUND(harga_penawaran,0) AS harga_penawaran,tgl_pemenang,CONCAT(url,'/evaluasi/',pemenang.kode_tender,'/pemenang') AS link_sumber
                FROM pemenang
                INNER JOIN lpse ON pemenang.id_lpse=lpse.id_lpse
                INNER JOIN jenis_tender ON pemenang.jenis_tender=jenis_tender.id_jenis
                LEFT JOIN paket ON pemenang.kode_tender=paket.kode_tender
                WHERE pemenang.kode_tender={$id}
                GROUP BY kode_tender";

        return $this->db->query($sql);
    }

    public function getPreferensiPengguna($id_pengguna)
    {
        return $this->db->query("SELECT IF(REPLACE(id_lpse,'|',',')<>'',REPLACE(id_lpse,'|',','),'0') AS id_lpse,IF(jenis_pengadaan<>'',jenis_pengadaan,'0') AS jenis_pengadaan FROM preferensi WHERE id_pengguna={$id_pengguna}")->row();
    }

    public function getPenggunaNotif()
    {
        $sql = "SELECT pengguna.id_pengguna,nama,no_telp,email,pengguna.status AS user_status,whatsapp_status FROM pengguna,preferensi,tender_terbaru
		        WHERE pengguna.kategori='2' AND pengguna.id_pengguna=preferensi.id_pengguna AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))
		        GROUP BY id_pengguna ORDER BY id_pengguna";

        return $this->db->query($sql);
    }

    public function getPenggunaSuplierNotif()
    {
        $sql = "SELECT pengguna.id_pengguna,nama,no_telp,email,pengguna.status AS user_status,whatsapp_status FROM pengguna,preferensi,pemenang
		        WHERE pengguna.kategori='4' AND pengguna.id_pengguna=preferensi.id_pengguna AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
		        GROUP BY id_pengguna ORDER BY id_pengguna";

        return $this->db->query($sql);
    }

    public function getPenggunaNotifByID($id_pengguna)
    {
        $sql = "SELECT id_pengguna,nama,no_telp,email,status AS user_status,whatsapp_status FROM pengguna WHERE id_pengguna={$id_pengguna}";

        return $this->db->query($sql);
    }

    public function getTenderTerbaru($id_pengguna, $jum_tender)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        $limit = $jum_tender > $this->limit_notifikasi ? "LIMIT {$this->limit_notifikasi}" : "";

        $sql = "SELECT kode_tender,nama_tender,ROUND(hps,0) AS hps,akhir_daftar,tender_terbaru.id_lpse,nama_lpse,url
                FROM preferensi,tender_terbaru,lpse
                WHERE id_pengguna={$id_pengguna} AND tender_terbaru.id_lpse=lpse.id_lpse AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))
                GROUP BY kode_tender
                ORDER BY id_lpse,akhir_daftar
                {$limit}";

        /*$sql = "SELECT kode_tender,nama_tender,hps,akhir_daftar,tender_terbaru.id_lpse,nama_lpse,url
                FROM preferensi,tender_terbaru,lpse
                WHERE id_pengguna={$id_pengguna} AND tender_terbaru.id_lpse=lpse.id_lpse AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))
                GROUP BY kode_tender
                ORDER BY id_lpse,akhir_daftar
                LIMIT {$this->limit_notifikasi}";*/

        return $this->db->query($sql);
    }

    public function getPemenangTerbaru($id_pengguna, $jum_tender)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        $limit = $jum_tender > $this->limit_notifikasi ? "LIMIT {$this->limit_notifikasi}" : "";

        $sql = "SELECT kode_tender,nama_pemenang,nama_tender,ROUND(harga_penawaran,0) AS harga_penawaran,pemenang.id_lpse,nama_lpse,url
                FROM preferensi,pemenang,lpse
                WHERE id_pengguna={$id_pengguna} AND pemenang.id_lpse=lpse.id_lpse AND preferensi.status='1' AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
                GROUP BY kode_tender
                ORDER BY id_lpse,tgl_pemenang DESC
                {$limit}";

        /*$sql = "SELECT kode_tender,nama_pemenang,nama_tender,harga_penawaran,pemenang.id_lpse,nama_lpse,url
                FROM preferensi,pemenang,lpse
                WHERE id_pengguna={$id_pengguna} AND pemenang.id_lpse=lpse.id_lpse AND preferensi.status='1' AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
                GROUP BY kode_tender
                ORDER BY id_lpse,tgl_pemenang DESC
                LIMIT {$this->limit_notifikasi}";*/

        return $this->db->query($sql);
    }

    /*public function getTenderTerbaru($id_pengguna = 0, $limit = 0)
    {
        $sql = "SELECT kode_tender, nama_tender, hps, akhir_daftar, tender_terbaru.id_lpse, nama_lpse, url, email
		        FROM pengguna,preferensi,tender_terbaru,lpse
		        WHERE pengguna.id_pengguna=preferensi.id_pengguna AND pengguna.id_pengguna={$id_pengguna} AND tender_terbaru.id_lpse=lpse.id_lpse AND preferensi.status='1' AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan REGEXP preferensi.jenis_pengadaan) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) AND akhir_daftar >= CURRENT_TIMESTAMP";
        $sql .= "ORDER BY tender_terbaru.id_lpse, tender_terbaru.akhir_daftar";
        if ($limit == 1) {
            $sql .= "LIMIT {$limit} ";
        }

        return $this->db->query($sql);
    }*/

    public function getJumlahTenderTerbaru($id_pengguna)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        $sql = "SELECT COUNT(kode_tender) AS jumlah FROM (SELECT kode_tender FROM preferensi,tender_terbaru
		        WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))) a";

        /*$sql = "SELECT COUNT(kode_tender) AS jumlah FROM (SELECT kode_tender FROM preferensi,tender_terbaru
		        WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))
		        LIMIT {$this->limit_notifikasi}) a";*/

        return $this->db->query($sql);
    }

    public function getJumlahPemenangTerbaru($id_pengguna)
    {
        // $preferensi = $this->getPreferensiPengguna($id_pengguna);

        $sql = "SELECT COUNT(kode_tender) AS jumlah FROM (SELECT kode_tender FROM preferensi,pemenang
                WHERE id_pengguna={$id_pengguna} AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))) a";

        /*$sql = "SELECT COUNT(kode_tender) AS jumlah FROM (SELECT kode_tender FROM preferensi,pemenang
                WHERE id_pengguna={$id_pengguna} AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
                LIMIT {$this->limit_notifikasi}) a";*/

        return $this->db->query($sql);
    }
    // public function getJumlahPemenangTerbaru($id_pengguna)
    // {
    //     $preferensi = $this->getPreferensiPengguna($id_pengguna);

    //     $sql = "SELECT COUNT(kode_tender) AS jumlah FROM (SELECT kode_tender FROM preferensi,pemenang
    //             WHERE id_pengguna={$id_pengguna} AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))) a";

    //     /*$sql = "SELECT COUNT(kode_tender) AS jumlah FROM (SELECT kode_tender FROM preferensi,pemenang
    //             WHERE id_pengguna={$id_pengguna} AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
    //             LIMIT {$this->limit_notifikasi}) a";*/

    //     return $this->db->query($sql);
    // }

    //katalog homepage
    public function getKatalogTenderTerbaru($page_number, $page_size)
    {
        $sql = "SELECT kode_tender,nama_tender,jenis_tender,ROUND(hps,0) AS hps,akhir_daftar,nama_lpse,foto,url,CONCAT(url,'/lelang/',kode_tender,'/pengumumanlelang') AS link_sumber,COALESCE(DATEDIFF(CURRENT_DATE,tgl_pembuatan),DATEDIFF(CURRENT_DATE,tgl_update)) AS update_hari
		        FROM tender_terbaru,lpse,jenis_tender
		        WHERE tender_terbaru.id_lpse=lpse.id_lpse AND tender_terbaru.jenis_pengadaan=jenis_tender.id_jenis AND akhir_daftar>=CURRENT_TIMESTAMP
		        ORDER BY akhir_daftar
		        LIMIT {$page_number},{$page_size}";

        // $sql = "SELECT kode_tender,nama_tender,jenis_tender,ROUND(hps,0) AS hps,akhir_daftar,nama_lpse,foto,CONCAT(url,'/lelang/',kode_tender,'/pengumumanlelang') AS link_sumber,COALESCE(DATEDIFF(CURRENT_DATE,tgl_pembuatan),DATEDIFF(CURRENT_DATE,tgl_update)) AS update_hari
        // FROM tender_terbaru,lpse,jenis_tender
        // WHERE tender_terbaru.id_lpse=lpse.id_lpse AND tender_terbaru.jenis_pengadaan=jenis_tender.id_jenis
        // ORDER BY akhir_daftar DESC
        // LIMIT {$page_number},{$page_size}";

        return $this->db->query($sql);
    }

    public function getKatalogTenderTerbaruByPengguna($id_pengguna, $jum_tender, $page_number, $page_size)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);
        $limit = $jum_tender > 10 ? "LIMIT {$page_number},{$page_size}" : "";

        $sql = "SELECT kode_tender,nama_tender,jenis_tender,ROUND(hps,0) AS hps,akhir_daftar,nama_lpse,lpse.foto,url,'' AS link_sumber,COALESCE(DATEDIFF(CURRENT_DATE,tgl_pembuatan),DATEDIFF(CURRENT_DATE,tender_terbaru.tgl_update)) AS update_hari
                FROM preferensi,tender_terbaru,lpse,jenis_tender
                WHERE id_pengguna={$id_pengguna} AND tender_terbaru.id_lpse=lpse.id_lpse AND tender_terbaru.jenis_pengadaan=jenis_tender.id_jenis AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))
                GROUP BY kode_tender
                ORDER BY akhir_daftar
                {$limit}";

        /*$sql = "SELECT kode_tender,nama_tender,jenis_tender,hps,akhir_daftar,nama_lpse,lpse.foto,url,'' AS link_sumber,DATEDIFF(CURRENT_DATE,tender_terbaru.tgl_update) AS update_hari
                FROM pengguna,preferensi,tender_terbaru,lpse,jenis_tender
                WHERE pengguna.id_pengguna=preferensi.id_pengguna AND pengguna.id_pengguna={$id_pengguna} AND tender_terbaru.id_lpse=lpse.id_lpse AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))
                GROUP BY kode_tender
                ORDER BY akhir_daftar
                LIMIT {$page_number},{$page_size}";*/
        // CONCAT(url,'/lelang/',kode_tender,'/pengumumanlelang')

        return $this->db->query($sql);
    }

    public function getKatalogTenderTerbaruByPengguna1($data)
    {
        $id_pengguna = $data['id_pengguna'];
        $page_size = $data['pageSize'];
        $page_number = ($data['pageNumber'] - 1) * $page_size;

        $preferensi = $this->getPreferensiPengguna($id_pengguna);
        // $jum_tender = $data['jum_tender'];
        // $limit = $jum_tender > 10 ? "LIMIT {$page_number},{$page_size}" : "";

        $kriteria = $order = '';
        $keyword = $data['keyword'];
        if ($keyword != '') $kriteria .= " AND (tender_terbaru.nama_tender LIKE '%{$keyword}%' OR tender_terbaru.kode_tender LIKE '%{$keyword}%')";

        $jenis_pengadaan = $data['jenis_pengadaan'];
        if ($jenis_pengadaan != '') $kriteria .= " AND tender_terbaru.jenis_pengadaan='{$jenis_pengadaan}'";

        $nilai_hps_awal = $data['nilai_hps_awal'];
        $nilai_hps_akhir = $data['nilai_hps_akhir'];
        if ($nilai_hps_akhir > 0) $kriteria .= " AND hps BETWEEN {$nilai_hps_awal} AND {$nilai_hps_akhir}";

        $prov = $data['prov'];
        if ($prov != '') $kriteria .= " AND CONCAT(LEFT(wilayah.id_wilayah,2),'00')={$prov}";

        $kab = $data['kab'];
        if ($kab != '') $kriteria .= " AND wilayah.id_wilayah={$kab}";

        $sort = $data['sort'];
        if ($sort == '1') $order = "hps ASC";
        else if ($sort == '2') $order = "hps DESC";
        else if ($sort == '3') $order = "akhir_daftar ASC";
        else if ($sort == '4') $order = "akhir_daftar DESC";

        $sql = "SELECT tender_terbaru.kode_tender,tender_terbaru.nama_tender,jenis_tender,ROUND(hps,0) AS hps,akhir_daftar,nama_lpse,lpse.foto,url,'' AS link_sumber,COALESCE(DATEDIFF(CURRENT_DATE,tgl_pembuatan),DATEDIFF(CURRENT_DATE,tender_terbaru.tgl_update)) AS update_hari
                FROM preferensi,tender_terbaru,lpse,jenis_tender,wilayah
                WHERE id_pengguna={$id_pengguna} AND tender_terbaru.id_lpse=lpse.id_lpse AND tender_terbaru.jenis_pengadaan=jenis_tender.id_jenis  AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP 
                -- AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) 
                -- AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) 
                -- AND IF(keyword='',tender_terbaru.nama_tender<>'',tender_terbaru.nama_tender REGEXP keyword) 
                -- AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) 
                -- AND CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1)))=wilayah {$kriteria}
                GROUP BY tender_terbaru.kode_tender
                ORDER BY {$order}";
        // LIMIT {$page_number},{$page_size}";
        // $sql = "SELECT tender_terbaru.kode_tender,tender_terbaru.nama_tender,jenis_tender,ROUND(hps,0) AS hps,akhir_daftar,nama_lpse,lpse.foto,url,'' AS link_sumber,COALESCE(DATEDIFF(CURRENT_DATE,tgl_pembuatan),DATEDIFF(CURRENT_DATE,tender_terbaru.tgl_update)) AS update_hari
        //         FROM preferensi,tender_terbaru,lpse,jenis_tender,paket,wilayah
        //         WHERE id_pengguna={$id_pengguna} AND tender_terbaru.id_lpse=lpse.id_lpse AND tender_terbaru.jenis_pengadaan=jenis_tender.id_jenis AND tender_terbaru.kode_tender=paket.kode_tender AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',tender_terbaru.nama_tender<>'',tender_terbaru.nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) AND CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1)))=wilayah {$kriteria}
        //         GROUP BY tender_terbaru.kode_tender
        //         ORDER BY {$order}
        //         LIMIT {$page_number},{$page_size}";

        return $this->db->query($sql);
    }

    public function getKatalogPemenangTerbaruByPengguna($id_pengguna, $jum_pemenang, $page_number, $page_size)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);
        $limit = $jum_pemenang > 10 ? "LIMIT {$page_number},{$page_size}" : "";

        $sql = "SELECT kode_tender,nama_pemenang,nama_tender,jenis_tender.jenis_tender,ROUND(harga_penawaran,0) AS harga_penawaran,nama_lpse,'' AS foto,url,'' AS link_sumber,COALESCE(DATEDIFF(CURRENT_DATE,tgl_pemenang),0) AS update_hari
                FROM preferensi,lpse,jenis_tender,pemenang
                WHERE id_pengguna={$id_pengguna} AND pemenang.id_lpse=lpse.id_lpse AND pemenang.jenis_tender=jenis_tender.id_jenis AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
                GROUP BY kode_tender,npwp
                ORDER BY tgl_pemenang DESC
                {$limit}";

        /*$sql = "SELECT kode_tender,nama_pemenang,nama_tender,jenis_tender.jenis_tender,harga_penawaran,nama_lpse,'' AS foto,url,'' AS link_sumber,DATEDIFF(CURRENT_DATE,tgl_pemenang) AS update_hari
                FROM preferensi,lpse,jenis_tender,pemenang
                WHERE id_pengguna={$id_pengguna} AND pemenang.id_lpse=lpse.id_lpse AND pemenang.jenis_tender=jenis_tender.id_jenis AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
                GROUP BY kode_tender,npwp
                ORDER BY tgl_pemenang DESC
                LIMIT {$page_number},{$page_size}";*/
        // CONCAT(url,'/evaluasi/',pemenang.kode_tender,'/pemenangberkontrak')

        return $this->db->query($sql);
    }

    public function getKatalogPemenangTerbaruByPengguna1($data)
    {
        $id_pengguna = $data['id_pengguna'];
        $page_size = $data['pageSize'];
        $page_number = ($data['pageNumber'] - 1) * $page_size;

        $preferensi = $this->getPreferensiPengguna($id_pengguna);
        // $jum_pemenang = $data['jum_pemenang'];
        // $limit = $jum_pemenang > 10 ? "LIMIT {$page_number},{$page_size}" : "";

        $kriteria = $order = '';
        $keyword = $data['keyword'];
        if ($keyword != '') $kriteria .= " AND (nama_tender LIKE '%{$keyword}%' OR nama_pemenang LIKE '%{$keyword}%')";

        $jenis_pengadaan = $data['jenis_pengadaan'];
        if ($jenis_pengadaan != '') $kriteria .= " AND pemenang.jenis_tender='{$jenis_pengadaan}'";

        $nilai_hps_awal = $data['nilai_hps_awal'];
        $nilai_hps_akhir = $data['nilai_hps_akhir'];
        if ($nilai_hps_akhir > 0) $kriteria .= " AND harga_penawaran BETWEEN {$nilai_hps_awal} AND {$nilai_hps_akhir}";

        $prov = $data['prov'];
        if ($prov != '') $kriteria .= " AND CONCAT(LEFT(wilayah.id_wilayah,2),'00')={$prov}";

        $kab = $data['kab'];
        if ($kab != '') $kriteria .= " AND wilayah.id_wilayah={$kab}";

        $sort = $data['sort'];
        if ($sort == '1') $order = "harga_penawaran ASC";
        else if ($sort == '2') $order = "harga_penawaran DESC";
        else if ($sort == '3') $order = "tgl_pemenang DESC";
        else if ($sort == '4') $order = "tgl_pemenang ASC";

        $sql = "SELECT id_pemenang,kode_tender,nama_pemenang,nama_tender,jenis_tender.jenis_tender,ROUND(harga_penawaran,0) AS harga_penawaran,nama_lpse,'' AS foto,url,'' AS link_sumber,COALESCE(DATEDIFF(CURRENT_DATE,tgl_pemenang),0) AS update_hari
                FROM preferensi,pemenang
                INNER JOIN lpse ON pemenang.id_lpse=lpse.id_lpse
                INNER JOIN jenis_tender ON pemenang.jenis_tender=jenis_tender.id_jenis
                LEFT JOIN wilayah ON CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1)))=wilayah
                WHERE id_pengguna={$id_pengguna} AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir)) {$kriteria}
                GROUP BY kode_tender,npwp
                ORDER BY {$order}
                LIMIT {$page_number},{$page_size}";

        // query to insert to table data leads from table pemenang pemenang that has field of id pemenang, nama perusahaan, npmwp
        // $sql2 = "INSERT INTO data_leads (id_pemenang, nama_perusahaan, npwp) SELECT id_pemenang, nama_pemenang, npwp FROM pemenang WHERE npmw NOT IN (SELECT npwp FROM data_leads)";
        $sql3 = "INSERT INTO data_leads (id_pemenang, nama_perusahaan, npwp) 
                SELECT id_pemenang, nama_pemenang, npwp
                FROM pemenang_tender
                WHERE npwp NOT IN (SELECT npwp FROM data_leads)
                AND DATE(tgl_pemenang) = CURRENT_DATE";

        $this->db->query($sql3);



        return $this->db->query($sql);
    }

    public function getJumKatalogTenderTerbaru()
    {
        $sql = "SELECT COUNT(kode_tender) AS jum_tender FROM tender_terbaru WHERE akhir_daftar>=CURRENT_TIMESTAMP";
        // $sql = "SELECT COUNT(kode_tender) AS jum_tender FROM tender_terbaru";

        return $this->db->query($sql);
    }

    public function getJumKatalogTenderTerbaruByPengguna($id_pengguna)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        $sql = "SELECT COUNT(kode_tender) AS jumlah FROM (SELECT kode_tender FROM preferensi,tender_terbaru
		        WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))
		        GROUP BY kode_tender) a";

        /*$sql = "SELECT COUNT(kode_tender) AS jumlah FROM pengguna,preferensi,tender_terbaru
		        WHERE pengguna.id_pengguna=preferensi.id_pengguna AND pengguna.id_pengguna={$id_pengguna} AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))";*/

        return $this->db->query($sql);
    }

    public function getJumKatalogTenderTerbaruByPengguna1($data)
    {
        $id_pengguna = $data['id_pengguna'];
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        $kriteria = '';
        $keyword = $data['keyword'];
        if ($keyword != '') $kriteria .= " AND (tender_terbaru.nama_tender LIKE '%{$keyword}%' OR tender_terbaru.kode_tender LIKE '%{$keyword}%')";

        $jenis_pengadaan = $data['jenis_pengadaan'];
        if ($jenis_pengadaan != '') $kriteria .= " AND tender_terbaru.jenis_pengadaan='{$jenis_pengadaan}'";

        $nilai_hps_awal = $data['nilai_hps_awal'];
        $nilai_hps_akhir = $data['nilai_hps_akhir'];
        if ($nilai_hps_akhir > 0) $kriteria .= " AND hps BETWEEN {$nilai_hps_awal} AND {$nilai_hps_akhir}";

        $prov = $data['prov'];
        if ($prov != '') $kriteria .= " AND CONCAT(LEFT(id_wilayah,2),'00')={$prov}";

        $kab = $data['kab'];
        if ($kab != '') $kriteria .= " AND id_wilayah={$kab}";

        $sql = "SELECT COUNT(kode_tender) AS jumlah FROM (SELECT tender_terbaru.kode_tender FROM preferensi,tender_terbaru,paket,wilayah
		        WHERE id_pengguna={$id_pengguna} AND tender_terbaru.kode_tender=paket.kode_tender AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',tender_terbaru.nama_tender<>'',tender_terbaru.nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) AND CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1)))=wilayah {$kriteria}
		        GROUP BY tender_terbaru.kode_tender) a";

        return $this->db->query($sql);
    }

    public function getJumKatalogPemenangTerbaruByPengguna($id_pengguna)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        $sql = "SELECT COUNT(kode_tender) AS jumlah FROM (SELECT kode_tender FROM preferensi,pemenang
                WHERE id_pengguna={$id_pengguna} AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
                GROUP BY kode_tender,npwp) a";

        /*$sql = "SELECT COUNT(kode_tender) AS jumlah FROM preferensi,pemenang
                WHERE id_pengguna={$id_pengguna} AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))";*/

        return $this->db->query($sql);
    }

    public function getJumKatalogPemenangTerbaruByPengguna1($data)
    {
        $id_pengguna = $data['id_pengguna'];
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        $kriteria = '';
        $keyword = $data['keyword'];
        if ($keyword != '') $kriteria .= " AND (nama_tender LIKE '%{$keyword}%' OR nama_pemenang LIKE '%{$keyword}%')";

        $jenis_pengadaan = $data['jenis_pengadaan'];
        if ($jenis_pengadaan != '') $kriteria .= " AND pemenang.jenis_tender='{$jenis_pengadaan}'";

        $nilai_hps_awal = $data['nilai_hps_awal'];
        $nilai_hps_akhir = $data['nilai_hps_akhir'];
        if ($nilai_hps_akhir > 0) $kriteria .= " AND harga_penawaran BETWEEN {$nilai_hps_awal} AND {$nilai_hps_akhir}";

        $prov = $data['prov'];
        if ($prov != '') $kriteria .= " AND CONCAT(LEFT(id_wilayah,2),'00')={$prov}";

        $kab = $data['kab'];
        if ($kab != '') $kriteria .= " AND id_wilayah={$kab}";

        $sql = "SELECT COUNT(kode_tender) AS jumlah FROM (SELECT kode_tender,id_wilayah
                FROM preferensi,pemenang
                LEFT JOIN wilayah ON CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(tender_terbaru.lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1)))=wilayah
                WHERE id_pengguna={$id_pengguna} AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir)) {$kriteria}
                GROUP BY kode_tender,npwp) a";

        return $this->db->query($sql);
    }

    public function simpanKirimNotif($id_pengguna, $jum_tender)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        $limit = $jum_tender > $this->limit_notifikasi ? "LIMIT {$this->limit_notifikasi}" : "";

        $sql = "INSERT INTO notifikasi_tender SELECT NULL,id_pengguna,kode_tender,CURRENT_TIMESTAMP
		        FROM preferensi,tender_terbaru
		        WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))
		        ORDER BY tender_terbaru.id_lpse,akhir_daftar
		        {$limit}";

        /*$sql = "INSERT INTO notifikasi_tender SELECT NULL,id_pengguna,kode_tender,CURRENT_TIMESTAMP
		        FROM preferensi,tender_terbaru
		        WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))
		        ORDER BY tender_terbaru.id_lpse,akhir_daftar
		        LIMIT {$this->limit_notifikasi}";*/

        return $this->db->query($sql);
    }

    public function simpanKirimNotifPemenang($id_pengguna, $jum_tender)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        $limit = $jum_tender > $this->limit_notifikasi ? "LIMIT {$this->limit_notifikasi}" : "";

        $sql = "INSERT INTO notifikasi_tender SELECT NULL,id_pengguna,kode_tender,CURRENT_TIMESTAMP
		        FROM preferensi,pemenang
		        WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
		        ORDER BY pemenang.id_lpse,tgl_pemenang DESC
		        {$limit}";

        /*$sql = "INSERT INTO notifikasi_tender SELECT NULL,id_pengguna,kode_tender,CURRENT_TIMESTAMP
		        FROM preferensi,pemenang
		        WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$id_pengguna} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender REGEXP REPLACE(preferensi.jenis_pengadaan,',','|')) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
		        ORDER BY pemenang.id_lpse,tgl_pemenang DESC
		        LIMIT {$this->limit_notifikasi}";*/

        return $this->db->query($sql);
    }

    /*public function getJumlahTenderTerbaru($id_pengguna)
    {
        $sql = "SELECT COUNT(kode_tender) AS jumlah FROM pengguna,preferensi,tender_terbaru
		        WHERE pengguna.id_pengguna=preferensi.id_pengguna AND pengguna.id_pengguna={$id_pengguna} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan REGEXP preferensi.jenis_pengadaan) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) AND akhir_daftar >= CURRENT_TIMESTAMP";

        return $this->db->query($sql);
    }*/

    public function getListLokasiPekerjaanTenderTerbaru($keyword, $id_pengguna, $jenis, $page, $limit)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        if ($jenis == '2') {
            $sql = "SELECT id_wilayah AS id,wilayah AS text,kategori
                    FROM
                        (SELECT id_wilayah,wilayah,'1' AS kategori
                        FROM wilayah,(SELECT CONCAT(LEFT(id_wilayah,2),'00') AS id_prov FROM wilayah,(SELECT CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(tender_terbaru.lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(tender_terbaru.lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1))) AS lokasi
                        FROM preferensi,tender_terbaru,paket WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',tender_terbaru.nama_tender<>'',tender_terbaru.nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) GROUP BY lokasi) a
                        WHERE wilayah=lokasi GROUP BY id_prov) a
                        WHERE id_wilayah=id_prov
                        
                        UNION
                        
                        SELECT id_wilayah,wilayah,'2' AS kategori
                        FROM wilayah,(SELECT CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(tender_terbaru.lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(tender_terbaru.lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1))) AS lokasi
                        FROM preferensi,tender_terbaru,paket WHERE id_pengguna={$id_pengguna}  AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',tender_terbaru.nama_tender<>'',tender_terbaru.nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) GROUP BY lokasi) a
                        WHERE wilayah=lokasi ORDER BY id_wilayah) a 
                    WHERE wilayah LIKE '%{$keyword}%'
                    LIMIT {$page},{$limit}";
        } else if ($jenis == '4') {
            $sql = "SELECT id_wilayah AS id,wilayah AS text,kategori
                    FROM
                        (SELECT id_wilayah,wilayah,'1' AS kategori
                        FROM wilayah,(SELECT CONCAT(LEFT(id_wilayah,2),'00') AS id_prov FROM wilayah,(SELECT CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(tender_terbaru.lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(tender_terbaru.lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1))) AS lokasi
                        FROM preferensi,pemenang WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir)) GROUP BY lokasi) a
                        WHERE wilayah=lokasi GROUP BY id_prov) a
                        WHERE id_wilayah=id_prov
                        
                        UNION
                        
                        SELECT id_wilayah,wilayah,'2' AS kategori
                        FROM wilayah,(SELECT CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(tender_terbaru.lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(tender_terbaru.lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1))) AS lokasi
                        FROM preferensi,pemenang WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir)) GROUP BY lokasi) a
                        WHERE wilayah=lokasi ORDER BY id_wilayah) a 
                    WHERE wilayah LIKE '%{$keyword}%'
                    LIMIT {$page},{$limit}";
        }

        return $this->db->query($sql)->result_array();
    }
    public function getListLokasiPekerjaan($keyword, $id_pengguna, $jenis, $page, $limit)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        if ($jenis == '2') {
            $sql = "SELECT id_wilayah AS id,wilayah AS text,kategori
                    FROM
                        (SELECT id_wilayah,wilayah,'1' AS kategori
                        FROM wilayah,(SELECT CONCAT(LEFT(id_wilayah,2),'00') AS id_prov FROM wilayah,(SELECT CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(tender_terbaru.lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(tender_terbaru.lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1))) AS lokasi
                        FROM preferensi,tender_terbaru,paket WHERE id_pengguna={$id_pengguna} AND tender_terbaru.kode_tender=paket.kode_tender AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',tender_terbaru.nama_tender<>'',tender_terbaru.nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) GROUP BY lokasi) a
                        WHERE wilayah=lokasi GROUP BY id_prov) a
                        WHERE id_wilayah=id_prov
                        
                        UNION
                        
                        SELECT id_wilayah,wilayah,'2' AS kategori
                        FROM wilayah,(SELECT CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1))) AS lokasi
                        FROM preferensi,tender_terbaru,paket WHERE id_pengguna={$id_pengguna} AND tender_terbaru.kode_tender=paket.kode_tender AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',tender_terbaru.nama_tender<>'',tender_terbaru.nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) GROUP BY lokasi) a
                        WHERE wilayah=lokasi ORDER BY id_wilayah) a 
                    WHERE wilayah LIKE '%{$keyword}%'
                    LIMIT {$page},{$limit}";
        } else if ($jenis == '4') {
            $sql = "SELECT id_wilayah AS id,wilayah AS text,kategori
                    FROM
                        (SELECT id_wilayah,wilayah,'1' AS kategori
                        FROM wilayah,(SELECT CONCAT(LEFT(id_wilayah,2),'00') AS id_prov FROM wilayah,(SELECT CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1))) AS lokasi
                        FROM preferensi,pemenang WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir)) GROUP BY lokasi) a
                        WHERE wilayah=lokasi GROUP BY id_prov) a
                        WHERE id_wilayah=id_prov
                        
                        UNION
                        
                        SELECT id_wilayah,wilayah,'2' AS kategori
                        FROM wilayah,(SELECT CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(tender_terbaru.lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1))) AS lokasi
                        FROM preferensi,pemenang WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir)) GROUP BY lokasi) a
                        WHERE wilayah=lokasi ORDER BY id_wilayah) a 
                    WHERE wilayah LIKE '%{$keyword}%'
                    LIMIT {$page},{$limit}";
        }

        return $this->db->query($sql)->result_array();
    }

    public function getJumlahListLokasiPekerjaan($keyword, $id_pengguna, $jenis)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        if ($jenis == '2') {
            $sql = "SELECT wilayah
                    FROM
                        (SELECT id_wilayah,wilayah,'1' AS kategori
                        FROM wilayah,(SELECT CONCAT(LEFT(id_wilayah,2),'00') AS id_prov FROM wilayah,(SELECT CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1))) AS lokasi
                        FROM preferensi,tender_terbaru,paket WHERE id_pengguna={$id_pengguna} AND tender_terbaru.kode_tender=paket.kode_tender AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',tender_terbaru.nama_tender<>'',tender_terbaru.nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) GROUP BY lokasi) a
                        WHERE wilayah=lokasi GROUP BY id_prov) a
                        WHERE id_wilayah=id_prov
                        
                        UNION
                        
                        SELECT id_wilayah,wilayah,'2' AS kategori
                        FROM wilayah,(SELECT CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1))) AS lokasi
                        FROM preferensi,tender_terbaru,paket WHERE id_pengguna={$id_pengguna} AND tender_terbaru.kode_tender=paket.kode_tender AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',tender_terbaru.nama_tender<>'',tender_terbaru.nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) GROUP BY lokasi) a
                        WHERE wilayah=lokasi ORDER BY id_wilayah) a 
                    WHERE wilayah LIKE '%{$keyword}%'";
        } else if ($jenis == '4') {
            $sql = "SELECT wilayah
                    FROM
                        (SELECT id_wilayah,wilayah,'1' AS kategori
                        FROM wilayah,(SELECT CONCAT(LEFT(id_wilayah,2),'00') AS id_prov FROM wilayah,(SELECT CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1))) AS lokasi
                        FROM preferensi,pemenang WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir)) GROUP BY lokasi) a
                        WHERE wilayah=lokasi GROUP BY id_prov) a
                        WHERE id_wilayah=id_prov
                        
                        UNION
                        
                        SELECT id_wilayah,wilayah,'2' AS kategori
                        FROM wilayah,(SELECT CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1))) AS lokasi
                        FROM preferensi,pemenang WHERE id_pengguna={$id_pengguna} AND preferensi.status='1' AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir)) GROUP BY lokasi) a
                        WHERE wilayah=lokasi ORDER BY id_wilayah) a 
                    WHERE wilayah LIKE '%{$keyword}%'";
        }

        return $this->db->query($sql)->num_rows();
    }

    public function getListJenisPengadaan($keyword, $id_pengguna, $jenis, $page, $limit)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        if ($jenis == '2') {
            $sql = "SELECT id_jenis AS id,jenis_tender AS text FROM preferensi,tender_terbaru,jenis_tender
                    WHERE id_pengguna={$id_pengguna} AND tender_terbaru.jenis_pengadaan=jenis_tender.id_jenis AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) AND jenis_tender LIKE '%{$keyword}%'
                    GROUP BY id_jenis
                    LIMIT {$page},{$limit}";
        } else if ($jenis == '4') {
            $sql = "SELECT id_jenis AS id,jenis_tender.jenis_tender AS text FROM preferensi,pemenang,jenis_tender
                    WHERE id_pengguna={$id_pengguna} AND pemenang.jenis_tender=jenis_tender.id_jenis AND preferensi.status='1' AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir)) AND jenis_tender.jenis_tender LIKE '%{$keyword}%'
                    GROUP BY id_jenis
                    LIMIT {$page},{$limit}";
        }

        return $this->db->query($sql)->result_array();
    }

    public function getJumlahListJenisPengadaan($keyword, $id_pengguna, $jenis)
    {
        $preferensi = $this->getPreferensiPengguna($id_pengguna);

        if ($jenis == '2') {
            $sql = "SELECT id_jenis FROM preferensi,tender_terbaru,jenis_tender
                    WHERE id_pengguna={$id_pengguna} AND tender_terbaru.jenis_pengadaan=jenis_tender.id_jenis AND preferensi.status='1' AND akhir_daftar>=CURRENT_TIMESTAMP AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) AND jenis_tender LIKE '%{$keyword}%'
                    GROUP BY id_jenis";
        } else if ($jenis == '4') {
            $sql = "SELECT id_jenis FROM preferensi,pemenang,jenis_tender
                    WHERE id_pengguna={$id_pengguna} AND pemenang.jenis_tender=jenis_tender.id_jenis AND preferensi.status='1' AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir)) AND jenis_tender.jenis_tender LIKE '%{$keyword}%'
                    GROUP BY id_jenis";
        }

        return $this->db->query($sql)->num_rows();
    }

    //----------

    public function getAllTender()
    {
        $data = $this->_client->request('GET', 'tender', $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function TrenHpsSekarang()
    {
        // $cr_lpse = $data['lpse'] != '' ? "AND id_lpse={$data['lpse']}" : "";
        // $cr_tahun = $data['tahun'] != ' ' ? "AND YEAR(tgl_pembuatan)={$data['tahun']}" : "AND YEAR(tgl_pembuatan)=YEAR(CURRENT_DATE)";

        $query = "SELECT SUM(tender.nilai_hps) AS trenhps FROM tender INNER JOIN `jenis_tender` ON
		`tender`.`id_jenis`=`jenis_tender`.`id_jenis` INNER  JOIN lpse ON tender.`id_lpse`=`lpse`.`id_lpse` LEFT JOIN wilayah
		ON `lpse`.`id_wilayah`=wilayah.`id_wilayah` WHERE `wilayah`.`id_wilayah`='3578' OR `jenis_tender`.`id_jenis`='2' OR `nilai_hps`>'0' 
		AND `nilai_hps`<='500000000'";

        return $this->db->query($query);
    }

    public function getPrefrensiNotif()
    {
        $query = "SELECT tender.`id_tender`, tender.`nama_tender`, `jenis_tender`.`jenis_tender`,`kategori_lpse`.`nama_kategori`, `tender`.`nilai_hps` FROM
		`tender` INNER JOIN `jenis_tender` ON tender.`id_jenis`=`jenis_tender`.`id_jenis` INNER JOIN `kategori_lpse` ON 
		`tender`.`kualifikasi`=`kategori_lpse`.`id_kategori` ORDER BY nilai_hps DESC";

        return $this->db->query($query)->row_array();
    }

    public function getTawaranRendah()
    {
        $query = "SELECT tender.id_tender, tender.`nama_tender`, tender.`nilai_hps`, `peserta_tender`.`harga_penawaran`, ROUND((tender.`nilai_hps` - `peserta_tender`.`harga_penawaran`) / `tender`.`nilai_hps` * 100, 2) AS 
		persentase_penurunan FROM `peserta_tender` INNER JOIN tender ON `peserta_tender`.`id_tender`=`tender`.`id_tender` 
		INNER JOIN `peserta` ON `peserta_tender`.`npwp`=`peserta`.`npwp`
		LEFT JOIN `lpse` ON tender.`id_lpse`=`lpse`.`id_lpse`
		 WHERE nama_peserta = 'PT. TRANSTELLAR INTI MITRA' OR lpse.`nama_lpse`='Kota Surabaya' OR YEAR(tender.`tgl_pembuatan`)='2022'";

        return $this->db->query($query)->result_array();
    }

    // function Preferensi_Noti(){

    // 	$query = "SELECT tender.`id_tender`, tender.`nama_tender`, `jenis_tender`.`jenis_tender`,`kategori_lpse`.`nama_kategori`, `tender`.`nilai_hps` FROM
    // 	`tender` INNER JOIN `jenis_tender` ON tender.`id_jenis`=`jenis_tender`.`id_jenis` INNER JOIN `kategori_lpse` ON
    // 	`tender`.`kualifikasi`=`kategori_lpse`.`id_kategori` ORDER BY nilai_hps DESC";

    // 	return $this->db->query($query)->row_array();

    // }

    public function getListTahun($keyword, $page, $limit)
    {
        $tahun = $this->db->query("SELECT MIN(YEAR(tgl_pembuatan)) AS min_tahun,YEAR(CURRENT_DATE)-MIN(YEAR(tgl_pembuatan)) AS selisih FROM tender")->row();

        $query = "";

        for ($i = 0; $i <= $tahun->selisih; $i++) {
            $thn = $tahun->min_tahun + $i;

            $union = ($i == 0) ? "" : " UNION";

            $query .= "{$union} SELECT {$thn} AS tahun";
        }

        return $this->db->query("SELECT tahun AS id, tahun AS text FROM ({$query}) a

	                             WHERE tahun LIKE '%{$keyword}%'

	                             ORDER BY tahun DESC LIMIT {$page},{$limit}")->result_array();
    }

    public function getJumlahListTahun($keyword)
    {
        $tahun = $this->db->query("SELECT MIN(YEAR(tgl_pembuatan)) AS min_tahun,YEAR(CURRENT_DATE)-MIN(YEAR(tgl_pembuatan)) AS selisih FROM tender")->row();

        $query = "";

        for ($i = 0; $i <= $tahun->selisih; $i++) {
            $thn = $tahun->min_tahun + $i;

            $union = ($i == 0) ? "" : " UNION";

            $query .= "{$union} SELECT {$thn} AS tahun";
        }

        return $this->db->query("SELECT tahun AS id, tahun AS text FROM ({$query}) a

	                             WHERE tahun LIKE '%{$keyword}%'

	                             ORDER BY tahun DESC")->num_rows();
    }

    public function getAllTenderLim($limit, $start)
    {
        $data = $this->_client->request('POST', 'tender-limit', [

            'form_params' => [

                'limit' => $limit,

                'start' => $start,

            ],

            'auth' => $this->_client->getConfig('headers')['auth'],

        ]);

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getAllTenderC()
    {
        $data = $this->_client->request('GET', 'tender-count', $this->_client->getConfig('headers'));

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getTenderDefault($orderby)
    {
        $data = $this->_client->request('POST', 'tender-default', [

            'form_params' => [

                'orderby' => $orderby,

            ],

            'auth' => $this->_client->getConfig('headers')['auth'],

        ]);

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getTenderDefaultLim($orderby, $limit, $start)
    {
        $data = $this->_client->request('POST', 'tender-default-limit', [

            'form_params' => [

                'limit' => $limit,

                'start' => $start,

                'orderby' => $orderby,

            ],

            'auth' => $this->_client->getConfig('headers')['auth'],

        ]);

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getTenderDefaultC($orderby)
    {
        $data = $this->_client->request('POST', 'tender-default-count', [

            'form_params' => [

                'orderby' => $orderby,

            ],

            'auth' => $this->_client->getConfig('headers')['auth'],

        ]);

        // $data = $this->_client->request('GET', 'tender-default-count');

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getSearchTender($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby)
    {
        $data = $this->_client->request('POST', 'tender/s', [

            'form_params' => [

                's' => $search,

                'keyword' => $keyword,

                'wilayah' => $wilayah,

                'klpd' => $klpd,

                'jenisPengadaan' => $jenisPengadaan,

                'hps' => $hps,

                'kualifikasi' => $kualifikasi,

                'tahun' => $tahun,

                'tahapan' => $tahapan,

                'orderby' => $orderby,

            ],

            'auth' => $this->_client->getConfig('headers')['auth'],

        ]);

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getSearchTenderLim($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby, $limit, $start)
    {
        $data = [];
        try {
            $resp = $this->_client->request('POST', 'tender/s-limit', [
                'form_params' => [
                    's' => $search,
                    'keyword' => $keyword,
                    'wilayah' => $wilayah,
                    'klpd' => $klpd,
                    'jenisPengadaan' => $jenisPengadaan,
                    'hps' => $hps,
                    'kualifikasi' => $kualifikasi,
                    'tahun' => $tahun,
                    'tahapan' => $tahapan,
                    'orderby' => $orderby,
                    'limit' => $limit,
                    'start' => $start,
                ],
                'auth' => $this->_client->getConfig('headers')['auth'],
            ]);
            if ($resp->getStatusCode() == 200) {
                $data = json_decode($resp->getBody()->getContents(), true);
            }
        } catch (\Exception $ex) {
        }

        return $data;
    }

    public function getSearchTenderC($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby)
    {
        $data = [];
        try {
            $resp = $this->_client->request('POST', 'tender/s-count', [
                'form_params' => [
                    's' => $search,
                    'keyword' => $keyword,
                    'wilayah' => $wilayah,
                    'klpd' => $klpd,
                    'jenisPengadaan' => $jenisPengadaan,
                    'hps' => $hps,
                    'kualifikasi' => $kualifikasi,
                    'tahun' => $tahun,
                    'tahapan' => $tahapan,
                    'orderby' => $orderby,
                ],
                'auth' => $this->_client->getConfig('headers')['auth'],
            ]);

            if ($resp->getStatusCode() == 200) {
                $data = json_decode($resp->getBody()->getContents(), true);
            }
        } catch (\Exception $ex) {
        }

        return $data;
    }

    // public function getTenderPerMonth()

    // {

    // 	$this->db->select('COUNT(id_tender) as jumlah_tender, tender.tgl_pembuatan as bulan');

    // 	$this->db->from('tender');

    // 	$this->db->group_by('DATE_FORMAT(tgl_pembuatan, "%m")');

    // 	$query = $this->db->get();

    // 	return $query->result_array();

    // }

    public function getHpsPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    {
        // var_dump($tahun);

        $data = $this->_client->request('POST', 'tender/s-getHpsPerMonth', [

            'form_params' => [

                'klpd' => $klpd,

                'jenisPengadaan' => $jenisPengadaan,

                'hps' => $hps,

                'tahun' => $tahun,

            ],

            'auth' => $this->_client->getConfig('headers')['auth'],

        ]);

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getTenderSelesaiPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    {
        // var_dump($klpd);

        $data = $this->_client->request('POST', 'tender/s-getSelesaiPerMonth', [

            'form_params' => [

                'klpd' => $klpd,

                'jenisPengadaan' => $jenisPengadaan,

                'hps' => $hps,

                'tahun' => $tahun,

            ],

            'auth' => $this->_client->getConfig('headers')['auth'],

        ]);

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getTenderUlangPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    {
        // var_dump($klpd);

        $data = $this->_client->request('POST', 'tender/s-getUlangPerMonth', [

            'form_params' => [

                'klpd' => $klpd,

                'jenisPengadaan' => $jenisPengadaan,

                'hps' => $hps,

                'tahun' => $tahun,

            ],

            'auth' => $this->_client->getConfig('headers')['auth'],

        ]);

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getTenderGagalPerMonth($klpd, $jenisPengadaan, $hps, $tahun)
    {
        // var_dump($klpd);

        $data = $this->_client->request('POST', 'tender/s-getGagalPerMonth', [

            'form_params' => [

                'klpd' => $klpd,

                'jenisPengadaan' => $jenisPengadaan,

                'hps' => $hps,

                'tahun' => $tahun,

            ],

            'auth' => $this->_client->getConfig('headers')['auth'],

        ]);

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getForecastingTender($klpd, $jenisPengadaan, $hps, $tahun)
    {
        // var_dump($klpd);

        $data = $this->_client->request('POST', 'tender/s-forecastingTender', [

            'form_params' => [

                'klpd' => $klpd,

                'jenisPengadaan' => $jenisPengadaan,

                'hps' => $hps,

                'tahun' => $tahun,

            ],

            'auth' => $this->_client->getConfig('headers')['auth'],

        ]);

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    /*public function getTenderById($id)
    {
        $data = $this->_client->request('GET', "tender/$id", $this->_client->getConfig('headers'));

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }*/

    // public function getTenderBaru()

    // {

    // 	$data = $this->_client->request('GET', 'tender/cek-tender-baru');

    // 	$data = json_decode($data->getBody()->getContents(), true);

    // 	return $data;

    // }

    // public function getPreferensiTenderBaru()

    // {

    // 	$data = $this->_client->request('GET', 'tender/preferensi-tender-baru');

    // 	$data = json_decode($data->getBody()->getContents(), true);

    // 	return $data;

    // }

    public function getSPNotifikasiTenderBaru()
    {
        $data = $this->_client->request('GET', 'tender/sp-notifikasi-tender-baru');

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getNotifikasiTenderBaru()
    {
        $data = $this->_client->request('GET', 'tender/notifikasi-tender-baru');

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getNotifikasiTenderBaruByKeyword()
    {
        $data = $this->_client->request('GET', 'tender/notifikasi-tender-baru-by-keyword');

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getNotifikasiTenderBaruDashboardUser()
    {
        $data = $this->_client->request('GET', 'tender/notifikasi-tender-baru-dashboard-user');

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function tambahTender($data)
    {
        $data = $this->_client->request('POST', 'tender/create', [

            'form_params' => $data,

            'auth' => $this->_client->getConfig('headers')['auth'],

        ]);

        // $data = json_decode($data->getBody()->getContents(), true);

        // return $data;
    }

    public function ubahTender($id, $data)
    {
        $data = $this->_client->request('PUT', "tender/update/$id", [

            'form_params' => $data,

            'auth' => $this->_client->getConfig('headers')['auth'],

        ]);
    }

    public function hapusTender($id)
    {
        $data = $this->_client->request('DELETE', "tender/delete/$id", $this->_client->getConfig('headers'));
    }

    public $table = 'paket';

    public $column_order = ['id_tender', 'id_lpse', 'id_jenis', 'nama_tender', 'niali_hps', 'nilai_kontrak'];

    public $order = ['id_tender', 'id_lpse', 'id_jenis', 'nama_tender', 'niali_hps', 'nilai_kontrak'];

    // private function _get_data_query_default()

    // {

    // 	$this->db->from($this->table);

    // 	if (isset($_POST['search']['value'])) {

    // 		$this->db->like('id_tender', $_POST['search']['value']);

    // 		$this->db->or_like('id_lpse', $_POST['search']['value']);

    // 		$this->db->or_like('id_jenis', $_POST['search']['value']);

    // 		$this->db->or_like('nama_tender', $_POST['search']['value']);

    // 		$this->db->or_like('nilai_hps', $_POST['search']['value']);

    // 		$this->db->or_like('nilai_kontrak', $_POST['search']['value']);

    // 	}

    // 	if (isset($_POST['order'])) {

    // 		$this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

    // 	} else {

    // 		$this->db->order_by('id_tender', 'ASC');

    // 	}

    // }

    // public function getDataTableDefault()

    // {

    // 	$this->_get_data_query_default();

    // 	if ($_POST['length'] != -1) {

    // 		$this->db->limit($_POST['length'], $_POST['start']);

    // 	}

    // 	$query = $this->db->get();

    // 	return $query->result();

    // }

    // public function count_filtered_data_default()

    // {

    // 	$this->_get_data_query();

    // 	$query = $this->db->get();

    // 	return $query->num_rows();

    // }

    // public function count_all_data_default()

    // {

    // 	$this->db->from($this->table);

    // 	return $this->db->count_all_results();

    // }

    // FIXME: banyak kolom yang tidak terpetakan karena dipindah ke table paket
    private function _get_data_query()
    {
        $this->db->from($this->table);

        if (isset($_POST['search']['value'])) {
            $this->db->like('kode_tender', $_POST['search']['value']);

            $this->db->or_like('id_lpse', $_POST['search']['value']);

            // $this->db->or_like('id_jenis', $_POST['search']['value']);

            $this->db->or_like('nama_tender', $_POST['search']['value']);

            $this->db->or_like('nilai_hps_paket', $_POST['search']['value']);

            // $this->db->or_like('nilai_kontrak', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('kode_tender', 'ASC');
        }
    }

    public function getDataTable()
    {
        $this->_get_data_query();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();

        return $query->result();
    }

    public function count_filtered_data()
    {
        $this->_get_data_query();

        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_all_data()
    {
        $this->db->from($this->table);

        return $this->db->count_all_results();
    }

    //model datatable

    private function _get_data_query_default($orderby)
    {
        $tahap = [];

        $tahap['notIn'] = ['Tender Selesai', 'Tender Gagal', 'Tender Ulang', 'Tender Batal'];

        $this->db->select('tender.id_tender AS id_tender, tender.nama_tender AS nama_tender, tender.metode_pemilihan AS metode_pemilihan,

		tender.nilai_hps AS nilai_hps, detail_tender.lokasi_pekerjaan AS lokasi_pekerjaan, 

		jenis_tender.jenis_tender AS jenis_tender, tender.status AS tender_status');

        $this->db->from('tender');

        $this->db->join('(SELECT detail_tender.id_tender, detail_tender.lokasi_pekerjaan FROM detail_tender) detail_tender', 'tender.id_tender = detail_tender.id_tender');

        $this->db->join('(SELECT jenis_tender.id_jenis, jenis_tender.jenis_tender FROM jenis_tender) jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');

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

    public function getTabelTender($datatable)
    {
        $columns = implode(', ', $datatable['col-display']);

        //$sumber = $this->input->post('sumber');

        $data = $this->input->post();

        $orderby = $data['cariOrderBy'];

        $sql = "";

        if ($data['cari'] === '' && $data['cariWilayah'] === "[]" && $data['cariKLPD'] === "[]" && $data['cariJenisPengadaan'] === "[]" && $data['cariHPS'] === "[]" && $data['cariKualifikasi'] === "[]" && $data['cariTahun'] === "[]" && $data['cariTahapan'] === "[]") {
            $sql .= "SELECT nama_lpse, tender.id_tender,tender.id_duplikat,nama_tender,CONCAT(lokasi_pekerjaan,IF(kab_pekerjaan<>'',CONCAT(', ',kab_pekerjaan),''),IF(prov_pekerjaan<>'',CONCAT(', ',prov_pekerjaan),'')) AS lokasi_pekerjaan,jenis_tender,metode_pemilihan, tender.status,nilai_hps 

            FROM tender,detail_tender,jenis_tender, lpse 

            WHERE tender.id_tender=detail_tender.id_tender AND tender.id_jenis=jenis_tender.id_jenis AND tender.id_lpse=lpse.id_lpse AND (tender.status NOT LIKE '%selesai%' AND tender.status NOT LIKE '%batal%' AND tender.status NOT LIKE '%gagal%' AND tender.status NOT LIKE '%ulang%')";
        } else {
            $sql = "SELECT nama_lpse, tender.id_tender,tender.id_duplikat,nama_tender,CONCAT(lokasi_pekerjaan,IF(kab_pekerjaan<>'',CONCAT(', ',kab_pekerjaan),''),IF(prov_pekerjaan<>'',CONCAT(', ',prov_pekerjaan),'')) AS lokasi_pekerjaan,jenis_tender,metode_pemilihan, tender.status,nilai_hps 

            FROM tender,detail_tender,jenis_tender,lpse 

            WHERE tender.id_tender=detail_tender.id_tender AND tender.id_jenis=jenis_tender.id_jenis AND tender.id_lpse=lpse.id_lpse AND (tender.status NOT LIKE '%selesai%' AND tender.status NOT LIKE '%batal%' AND tender.status NOT LIKE '%gagal%' AND tender.status NOT LIKE '%ulang%')";
        }

        $where = "";

        if ($data['cari'] === '' && $data['cariWilayah'] === "[]" && $data['cariKLPD'] === "[]" && $data['cariJenisPengadaan'] === "[]" && $data['cariHPS'] === "[]" && $data['cariKualifikasi'] === "[]" && $data['cariTahun'] === "[]" && $data['cariTahapan'] === "[]" && $data['cariTender'] === "[]") {
            $where = "";

            $wherenya = "";
        } else {
            $wherenya = "ada";

            $search = $data['cari'];

            $keyword = json_decode(str_replace('&quot;', '', '["null"]'), true);

            $wilayah = json_decode(str_replace('&quot;', '', $data['cariWilayah']), true);

            $klpd = json_decode(str_replace('&quot;', '', $data['cariKLPD']), true);

            $jenisPengadaan = json_decode(str_replace('&quot;', '', $data['cariJenisPengadaan']), true);

            $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $data['cariHPS']));

            $kualifikasi = explode(',', str_replace(['&quot;', '[', ']'], '', $data['cariKualifikasi']));

            $tahun = json_decode(str_replace('&quot;', '', $data['cariTahun']), true);

            $tahapan = json_decode(str_replace('&quot;', '', $data['cariTahapan']), true);

            $urut = json_decode(str_replace('&quot;', '', $data['cariTender']), true);

            $urutHPS = json_decode(str_replace('&quot;', '', $data['cariHPSUrut']), true);

            if ($search !== "") {
                if ($wherenya === '') {
                    $where .= "(nama_tender LIKE '" . $search . "' OR nama_lpse LIKE '" . $search . "')";
                } else {
                    $where .= " AND ( nama_lpse LIKE '%" . $search . "%' OR nama_tender LIKE '%" . $search . "%' )";
                }
            }

            if ($keyword[0] !== "null") {
                for ($i = 0; $i < count($keyword); $i++) {
                    if ($wherenya === '') {
                        $where .= "(nama_tender IN (" . implode(',', $keyword) . ") OR nama_lpse IN (" . implode(',', $keyword) . "))";
                    } else {
                        $where .= " AND (nama_tender IN (" . implode(',', $keyword) . ") OR nama_lpse IN (" . implode(',', $keyword) . "))";
                    }

                    if ($i > 0) {
                        if ($wherenya === '') {
                            $where .= "(nama_tender IN (" . implode(',', $keyword) . ") OR nama_lpse IN (" . implode(',', $keyword) . "))";
                        } else {
                            $where .= " AND (nama_tender IN (" . implode(',', $keyword) . ") OR nama_lpse IN (" . implode(',', $keyword) . "))";
                        }
                    }
                }
            }

            if ($klpd) {
                $where .= " AND tender.id_lpse IN(" . implode(',', $klpd) . ")";
            }

            if ($jenisPengadaan) {
                $where .= " AND tender.id_jenis IN(" . implode(',', $jenisPengadaan) . ")";
            }

            if ($hps) {
                // cek jika data hanya satu

                $i = 0;

                if (count($hps) == 1) {
                    // code... untuk satu pilihan hps

                    // cek jenis hps

                    if (strpbrk($hps[$i], "/")) {
                        $str = explode("/", $hps[$i]);

                        $where .= " AND nilai_hps > " . substr($str[0], 1);

                        $where .= " AND nilai_hps < " . (int) $str[1];
                    } else {
                        $str = explode("than", $hps[$i]);

                        if (count($str) > 1) {
                            if ($str[0] === '"less') {
                                $where .= " AND nilai_hps < " . (int) $str[1];
                            } else {
                                $where .= " AND nilai_hps > " . (int) $str[1];
                            }
                        }
                    }
                } else {
                    // code... lebih dari satu pilihan hps

                    $where .= " AND (";

                    // cek jenis hps

                    for ($i = 0; $i < count($hps); $i++) {
                        if (strpbrk($hps[$i], "/")) {
                            $str = explode("/", $hps[$i]);

                            $where .= " nilai_hps BETWEEN " . substr($str[0], 1) . " AND " . (int) $str[1];
                        } else {
                            $str = explode("than", $hps[$i]);

                            if (count($str) > 1) {
                                if ($str[0] === '"less') {
                                    $where .= " nilai_hps < " . (int) $str[1];
                                } else {
                                    $where .= " nilai_hps > " . (int) $str[1];
                                }
                            }
                        }

                        $where .= " OR";
                    };

                    $where = substr($where, 0, -2);

                    $where .= ")";
                }
            }

            if ($wilayah) {
                // Mengambil id_lpse yang berada pada suatu wilayah

                $idLPSEWilayah = $this->db->where_in('id_wilayah', $wilayah)->get('lpse')->result_array();

                if ($idLPSEWilayah) {
                    $id_lpseWil = [];

                    foreach ($idLPSEWilayah as $idLPSE) {
                        $id_lpseWil[] = $idLPSE['id_lpse'];
                    }

                    $where .= " AND tender.id_lpse IN(" . implode(',', $id_lpseWil) . ")";
                }
            }

            if ($tahapan) {
                // get tahapan from database

                $nama_tahapan = $this->db->where_in('id_tahapan', $tahapan)->get('tahapan')->result_array();

                // get nama_tahapan

                if ($nama_tahapan) {
                    $val_nama = [];

                    foreach ($nama_tahapan as $key => $value) {
                        $val_nama[] = '"' . $value['nama_tahapan'] . '"';
                    }

                    $gabung = implode(',', $val_nama);

                    $where .= " AND tender.status IN(" . $gabung . ")";
                }
            }

            if ($kualifikasi[0] !== "" && $kualifikasi[0] !== "[]") {
                // menggabungkan array menjadi string

                $gabung = implode(',', $kualifikasi);

                // menghapus karakter petik

                // "1","2" menjadi 1,2

                $replace = str_replace('"', '', $gabung);

                $where .= " AND tender.kualifikasi IN (" . $replace . ")";
            }

            if ($tahun) {
                $where .= " AND DATE_FORMAT(tgl_pembuatan, '%Y') IN(" . implode(',', $tahun) . ")";
            }

            if ($urut) {
                if ($urut == '1') {
                    $where .= " ORDER BY nama_tender ASC";
                } else {
                    $where .= " ORDER BY nama_tender DESC";
                }
            }

            if ($urutHPS) {
                if ($urutHPS == '1') {
                    $where .= " ORDER BY nilai_hps ASC";
                } else {
                    $where .= " ORDER BY nilai_hps DESC";
                }
            }
        }

        if ($wherenya != "") {
            $sql .= $where;
        }

        $columnd = $datatable['col-display'];

        $count_c = count($columnd);

        $data = $this->db->query($sql);

        $total_data = $data->num_rows();

        $total_filter = $data->num_rows();

        $data->free_result();

        //$sql .= " ORDER BY {$columnd[($datatable['order'][0]['column'])-1]} {$datatable['order'][0]['dir']}";

        $start = $datatable['start'];

        $length = $datatable['length'];

        $sql .= " LIMIT {$start}, {$length}";

        $data = $this->db->query($sql);

        $option['draw'] = $datatable['draw'];

        $option['recordsTotal'] = $total_data;

        $option['recordsFiltered'] = $total_filter;

        $option['data'] = [];

        foreach ($data->result() as $row) {
            $data = [];

            for ($i = 0; $i < $count_c; $i++) {
                // var_dump($columnd[$i]);

                $field = $columnd[$i];

                $idDuplikat = $columnd[1];

                $namaTender = $columnd[2];

                if ($i == 1) {
                } elseif ($i == 2) {
                    $data[] = '<a class="p-0" style="font-weight: 500; color:#694747;" href="' . base_url() . "tender/" . $row->$idDuplikat . '">' . $row->$field . '</a>';
                } elseif ($i == 6) {
                    $data[] = '<a class="m-0 p-0 text-body" id="click-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="modalJadwal(' . $row->$idDuplikat . ', ' . $row->$namaTender . ')">' .

                        $row->$field .

                        '</a>';
                } elseif ($i == 7) {
                    $data[] = "Rp " . number_format($row->$field, 0, ",", ".");
                } else {
                    $data[] = $row->$field;
                }
            }

            $option['data'][] = $data;
        }

        return print_r(json_encode($option));
    }

    public function getTabelFilter($datatable)
    {
        $columns = implode(', ', $datatable['col-display']);

        // $columns = str_replace("urut", "if(id_kategori='',@urut := @urut+1,'') as urut", $columns);

        $proyek = $this->input->post('cariOrderBy');

        // $profil_proyek = $this->RABModel->getProfilProyek($proyek);

        // $jasa = $profil_proyek->jasa_kontraktor;

        // $pajak = $profil_proyek->pajak;

        $sql_rab =

            "

		tender

		JOIN (SELECT detail_tender.id_tender, detail_tender.lokasi_pekerjaan FROM detail_tender) detail_tender ON tender.id_tender = detail_tender.id_tender

		JOIN (SELECT jenis_tender.id_jenis, jenis_tender.jenis_tender FROM jenis_tender) jenis_tender ON tender.id_jenis = jenis_tender.id_jenis

		JOIN (SELECT tahapan.id_tahapan, tahapan.nama_tahapan FROM tahapan) tahapan ON tender.status = tahapan.nama_tahapan

		";

        $sql = "SELECT {$columns} FROM {$sql_rab},(SELECT @urut:=0) t";

        // $sql = $this->_get_data_query_default($proyek);

        // $this->_get_data_query_default($proyek);

        // $data = $this->db->query($sql);

        // // $query = $this->db->get();

        // $total_data = $data->num_rows();

        // var_dump($data);

        // die();

        // $data->free_result();

        $columnd = $datatable['col-display'];

        $count_c = count($columnd);

        // $search = $datatable['search']['value'];

        $where =

            "

		tender.status NOT IN ('Tender Selesai', 'Tender Gagal', 'Tender Ulang', 'Tender Batal') AND

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

		END

		";

        // if ($search != '') {

        // 	for ($i=0; $i < $count_c ; $i++) {

        // 			if ($columnd[$i] != 'urut') {

        // 				$where .= $columnd[$i] .' LIKE "%'. $search .'%"';

        // 				if ($i < $count_c - 2) $where .= ' OR ';

        // 			}

        // 	}

        // }

        if ($where != '') {
            $sql .= " WHERE " . $where;
        }

        $data = $this->db->query($sql);

        $total_filter = $data->num_rows();

        $data->free_result();

        // $sql .= " ORDER BY lv1,lv2,lv3";

        // $this->_get_data_query_default($proyek);

        $start = $datatable['start'];

        $length = $datatable['length'];

        if ($length != -1) {
            $sql .= " LIMIT {$start}, {$length}";
        }

        $data = $this->db->query($sql);

        $option['draw'] = $datatable['draw'];

        // $option['recordsTotal']    = $total_data;

        $option['recordsTotal'] = $total_filter;

        $option['recordsFiltered'] = $total_filter;

        $option['data'] = [];

        // $option['data'][] 		   = $data->result();

        // var_dump($option);

        // die();

        foreach ($data->result() as $row) {
            $data = [];

            $data[] = '<div class="col-kode text-start">' . $row->id_tender . '</div>';

            $data[] = '<div class="col-nama text-start">' .

                '<div class="mb-2 p-0">' .

                '<a class="p-0" style="font-weight: 500; color:#694747;" href="' . base_url("tender/$row->id_tender") . '">' . $row->nama_tender . '</a>' .

                '</div>' .

                '<div class="row" style="color:#694747;">' .

                '<p class="col-1">' .

                '<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">' .

                '<path d="M12.4219 7.0625C12.4219 10.5781 7.5 13.8594 7.5 13.8594C7.5 13.8594 2.57812 10.5781 2.57812 7.0625C2.57812 5.75714 3.09668 4.50524 4.01971 3.58221C4.94274 2.65918 6.19464 2.14063 7.5 2.14062C8.80536 2.14063 10.0573 2.65918 10.9803 3.58221C11.9033 4.50524 12.4219 5.75714 12.4219 7.0625V7.0625Z" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />' .

                '<path d="M7.5 8.23438C8.14721 8.23438 8.67188 7.70971 8.67188 7.0625C8.67188 6.41529 8.14721 5.89062 7.5 5.89062C6.85279 5.89062 6.32812 6.41529 6.32812 7.0625C6.32812 7.70971 6.85279 8.23438 7.5 8.23438Z" fill="#BF0C0C" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />' .

                '</svg>' .

                '</p>' .

                '<p class="col-10 p-0">' .

                $row->lokasi_pekerjaan .

                '</p>' .

                '</div>' .

                '</div>';

            $data[] = '<div class="col-jenis text-start">' .

                '<p class="mb-2" style="font-weight: 500;">' . $row->jenis_tender . '</p>' .

                '<p>' . $row->metode_pemilihan . '</p>' .

                '</div>';

            $data[] = '<div class="col-klpd text-start" style="font-weight: 500;">' .

                '<a class="m-0 p-0 text-body" id="click-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="modalJadwal(' . $row->id_tender . ', ' . $row->nama_tender . ')">' .

                $row->tender_status .

                '</a>' .

                '</div>';

            $data[] = '<div class="col-hps text-start">' .

                '<h6 style="font-weight: 700;color:#139728;">' . "Rp. " . number_format($row->nilai_hps, 0, ',', '.') . '</h6>' .

                '</div>';

            // for ($i=0; $i < $count_c; $i++) {

            // 	if ($i == 6 || $i == 7 || $i == 9 || $i == 11 || $i == 12) $data[] = "Rp ".number_format($row->$columnd[$i], 2, ",", ".");

            // 	else $data[] = $row->$columnd[$i];

            // }

            // $nama_pekerjaan = str_replace('"', "#", str_replace("'", "&#039;", $data[13]));

            // $arr_urut = explode(".",$data[0]);

            // if (count($arr_urut) == 1) {

            // 	$data[] = "<div class='btn-group'>".

            // 				"<button type='button' class='btn btn-default btn-xs btn-aksi-item-icon' id='tambah_pekerjaan_kategori' title='Tambah Pekerjaan' onclick='tampilTambahItem(\"".$data[1]."\",\"".$data[0]."\",\"".$nama_pekerjaan."\")'><i class='fa fa-plus-circle'></i></button>".

            // 				"<button type='button' class='btn btn-default btn-xs btn-aksi-item-icon' id='hapus_pekerjaan_kategori' title='Hapus Semua Pekerjaan' onclick='konfirmasiHapusRAB(\"".$data[1]."\",\"".$nama_pekerjaan."\",1)'><i class='fa fa-trash'></i></button>".

            // 			"</div>";

            // } else if (count($arr_urut) == 2 && $data[14] == '0') {

            // 	$data[] = "<div class='btn-group'></div>";

            // } else if (count($arr_urut) == 2 && $data[14] == '1') {

            // 	$data[] = "<div class='btn-group'>".

            // 				"<button type='button' class='btn btn-default btn-xs btn-aksi-item-icon' id='tambah_pekerjaan_kategori' title='Tambah Sub Pekerjaan' onclick='tampilTambahItem(\"".$data[1]."\",\"".$data[0]."\",\"".$nama_pekerjaan."\")'><i class='fa fa-plus-circle'></i></button>".

            // 				"<button type='button' class='btn btn-default btn-xs btn-aksi-item-icon' id='copy_pekerjaan_kategori' title='Copy Pekerjaan' onclick='copyKategoriPekerjaan(\"".$data[1]."\",\"".$data[0]."\")'><i class='fa fa-copy'></i></button>".

            // 				"<button type='button' class='btn btn-default btn-xs btn-aksi-item-icon' id='hapus_pekerjaan_kategori' title='Hapus Pekerjaan' onclick='konfirmasiHapusRAB(\"".$data[1]."\",\"".$nama_pekerjaan."\",2)'><i class='fa fa-trash'></i></button>".

            // 			"</div>";

            // } else {

            // 	$data[] = "<button type='button' class='btn btn-default btn-xs btn-aksi-item-icon aksi-item-sub' title='Lainnya'><i class='fa fa-bars'></i></button>";

            // }

            $option['data'][] = $data;
        }

        return print_r(json_encode($option));
    }

    public function getTotalNewestTender(): int
    {
        $timestamp = date('Y-m-d H:i:s');
        $this->db->select('COUNT(*) AS total_tender');
        $this->db->from('tender_terbaru');
        $this->db->join('lpse', 'tender_terbaru.id_lpse = lpse.id_lpse', 'left');
        $this->db->join('jenis_tender', 'tender_terbaru.jenis_pengadaan = jenis_tender.id_jenis', 'left');
        $this->db->where('akhir_daftar >=', $timestamp);
        $this->db->order_by('akhir_daftar');
        $row = $this->db->get()->row();
        if ($row == null) {
            return 0;
        }
        return (int) $row->total_tender;
    }

    //data tender terbaru card
    public function get_tender_by_lpse_id($lpse_id)
    {
        $this->db->select('nama_tender, nilai_hps');
        $this->db->from('tender');
        $this->db->where('id_lpse', $lpse_id);
        $query = $this->db->get();
        return $query->result();
    }

    // public function getData()
    // {
    // 	$this->db->select('tender.`id_tender`, tender.`nama_tender`, detail_tender.`lokasi_pekerjaan`, jenis_tender.`jenis_tender`, tender.`nilai_hps`');
    // 	$this->db->from('tender');
    // 	$this->db->join('detail_tender', 'tender.`id_tender` = detail_tender.`id_tender`', 'inner');
    // 	$this->db->join('jenis_tender', 'tender.`id_jenis` = jenis_tender.`id_jenis`', 'inner');
    // 	$this->db->join('jadwal', 'tender.`id_tender` = jadwal.`id_tender`', 'inner');
    // 	$this->db->join('tahapan', 'jadwal.`id_tahapan` = tahapan.`id_tahapan`', 'left');
    // 	$this->db->where('tahapan.`id_tahapan`', '1');
    // 	$this->db->group_by('tender.`id_tender`');
    // 	$query = $this->db->get();
    // 	return $query->result();
    // }

    /*public function simpanKirimNotif(?int $userId = 0)
    {
        if ($userId == 0 || $userId = null) {
            return;
        }

        $sql = "INSERT INTO notifikasi_tender SELECT NULL, pengguna.id_pengguna, kode_tender, CURRENT_TIMESTAMP FROM pengguna, preferensi,tender_terbaru ";
        $sql .= "WHERE pengguna.id_pengguna = preferensi.id_pengguna AND pengguna.id_pengguna=%d AND CAST(preferensi.status AS UNSIGNED INTEGER) = 1 ";
        $sql .= "AND tender_terbaru.akhir_daftar >= CURRENT_TIMESTAMP AND kode_tender NOT IN ";
        $sql .= "(SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna = %d GROUP BY kode_tender) ";
        $sql .= "AND (IF(preferensi.id_lpse = '', tender_terbaru.id_lpse <> '', tender_terbaru.id_lpse REGEXP preferensi.id_lpse) ";
        $sql .= "AND IF(preferensi.jenis_pengadaan='', tender_terbaru.jenis_pengadaan<>'', tender_terbaru.jenis_pengadaan REGEXP preferensi.jenis_pengadaan) ";
        $sql .= "AND IF(keyword='', nama_tender<>'', nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0, hps<>'', hps BETWEEN nilai_hps_awal AND nilai_hps_akhir)) ";
        $sql .= "ORDER BY tender_terbaru.id_lpse,akhir_daftar";
        if ($userId < 1) {
            return;
        }
        $sql = sprintf($sql, $userId, $userId);
        // $sql = "INSERT INTO notifikasi_tender SELECT NULL,pengguna.id_pengguna,kode_tender,CURRENT_TIMESTAMP
        //   FROM pengguna,preferensi,tender_terbaru
        // WHERE pengguna.id_pengguna=preferensi.id_pengguna AND pengguna.id_pengguna={$userId} AND preferensi.status='1' AND tender_terbaru.akhir_daftar >= CURRENT_TIMESTAMP
        // AND kode_tender NOT IN (SELECT kode_tender FROM notifikasi_tender WHERE id_pengguna={$userId} GROUP BY kode_tender) AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan REGEXP preferensi.jenis_pengadaan) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))
        //   ORDER BY tender_terbaru.id_lpse,akhir_daftar";
        try {
            return $this->db->query($sql);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }*/

    protected function extractLpseId(string $listId): array
    {
        if (empty($listId)) {
            return [];
        }

        if (stripos($listId, '|') === false) {
            return [intval($listId)];
        }

        $result = explode('|', $listId);
        $result = array_map(fn ($item) => trim($item), $result);
        $result = array_map(fn ($item) => intval($item), $result);
        return $result;
    }

    protected function extractKeyword(string $keyword): array
    {
        if (empty($keyword)) {
            return [];
        }

        if (strpos($keyword, '|') === false) {
            return [$keyword];
        }

        $result = array_map('trim', explode('|', $keyword));
        $result = array_filter($result, fn ($item) => !empty($item));
        return $result;
    }

    protected function extractTenderType(string $types): array
    {
        if (empty($types)) {
            return [];
        }

        if (strpos($types, ',') === false) {
            return [$types];
        }

        $result = array_map('trim', explode(',', $types));
        $result = array_filter($result, fn ($item) => !empty($item));
        return $result;
    }

    /**
     * @return array|int jika tidak ada data maka akan mengembalikan array kosong.
     */
    public function getListKatalogTenderTerbaru($preferensi, $pageNumber, $pageSize, bool $returnTotal = false)
    {
        if ($pageNumber < 0 && !$returnTotal) {
            $pageNumber = 0;
        }

        $offset = $pageSize < 1 ? 0 : ($pageNumber - 1) * $pageSize;
        $keywords = isset($preferensi['keyword']) ? $this->extractKeyword($preferensi['keyword']) : [];
        $listLpseId = isset($preferensi['id_lpse']) ? $this->extractLpseId($preferensi['id_lpse']) : [];
        $jenisPengadaan = isset($preferensi['jenis_pengadaan']) && $preferensi['jenis_pengadaan'] != '' ? $this->extractTenderType($preferensi['jenis_pengadaan']) : [];
        $hpsStart = isset($preferensi['nilai_hps_awal']) ? (int) $preferensi['nilai_hps_awal'] : 0;
        $hpsEnd = isset($preferensi['nilai_hps_akhir']) ? (float) $preferensi['nilai_hps_akhir'] : 0;

        if ($returnTotal) {
            $this->db->select('COUNT(kode_tender) AS total_items');
        } else {
            $this->db->select("kode_tender,nama_tender,jenis_tender,ROUND(hps,0) AS hps,akhir_daftar,nama_lpse,foto,url,CONCAT(url,'/lelang/',kode_tender,'/pengumumanlelang') AS link_sumber,DATEDIFF(CURRENT_DATE,tgl_update) AS update_hari");
        }
        $this->db->from('tender_terbaru, lpse, jenis_tender')
            ->where('tender_terbaru.id_lpse = lpse.id_lpse AND tender_terbaru.jenis_pengadaan=jenis_tender.id_jenis')
            ->where('akhir_daftar >=', date('Y-m-d H:i:s'));
        if (count($keywords) > 0) {
            $this->db->group_start();
            foreach ($keywords as $keyword) {
                $this->db->or_like('nama_tender', $keyword);
            }
            $this->db->group_end();
        }

        if (count($listLpseId) > 0) {
            $this->db->where_in('tender_terbaru.id_lpse', $listLpseId);
        }

        if (count($jenisPengadaan) > 0) {
            $this->db->group_start();
            foreach ($jenisPengadaan as $val) {
                $this->db->or_where('jenis_pengadaan', $val);
            }
            $this->db->group_end();
        }

        if (($hpsStart >= 0 && $hpsEnd > 0) && $hpsStart < $hpsEnd) {
            $this->db->group_start();
            $this->db->where('hps >=', $hpsStart);
            $this->db->where('hps <=', $hpsEnd);
            $this->db->group_end();
        }

        $this->db->order_by('akhir_daftar');
        if (!$returnTotal) {
            $this->db->limit($pageSize, $offset);
        }

        $query = $this->db->get();
        if ($returnTotal) {
            $row = $query->row();
            return $row->total_items;
        }
        return $query->result_array();
    }

    /**
     * Get daftar stat jumlah tender
     *
     * ```
     * $rows = yield $this->getListRecommendations($pool);
     * while (yield $rows->advance()) {
     *     // lakukan sesuatu dengan data $rows->getCurrent();
     * }
     * ```
     * @return Promise<Iterator>
     */
    public function getListStatByHps(Pool $pool, string $npwp, int $year, int $hpsStart = 0, int $hpsEnd = 0): \Amp\Promise
    {
        return call(function () use ($pool, $npwp, $year, $hpsStart, $hpsEnd) {
            $sql = 'SELECT SUBSTRING(paket.tanggal_pembuatan, 6, 2) AS MONTH, ';
            $sql .= '(SELECT COUNT(kode_tender) FROM `paket` WHERE `kode_tender` IN ';
            $sql .= '(SELECT `kode_tender` FROM `peserta_tender` WHERE `npwp` = :npwp) ';
            if ($hpsStart > 0 && $hpsEnd == 0) {
                $sql .= 'AND `nilai_hps_paket` < :hps_start AND YEAR(`tanggal_pembuatan`) = :created_year) AS range1 ';
            } elseif ($hpsStart > 0 && $hpsEnd > 0) {
                $sql .= 'AND `nilai_hps_paket` >= :hps_start AND `nilai_hps_paket` >= :hps_end AND YEAR(`tanggal_pembuatan`) = :created_year) AS range1 ';
            }

            $sql .= 'FROM `peserta_tender` JOIN `paket` ON `paket`.`kode_tender` = `peserta_tender`.`kode_tender` WHERE `peserta_tender`.`npwp` = :npwp ';
            $sql .= 'AND YEAR(`tanggal_pembuatan`) = :created_year GROUP BY `paket`.`kode_tender`';
            $stmt = yield $pool->prepare($sql);
            $rows = yield $stmt->execute(['npwp' => $npwp, 'created_year' => $year, 'hps_start' => $hpsStart, 'hps_end' => $hpsEnd]);

            $emitter = new Emitter();
            while (yield $rows->advance()) {
                $row = $rows->getCurrent();
                $emitter->emit($row);
            }

            return $emitter->iterate();
        });
    }
}
