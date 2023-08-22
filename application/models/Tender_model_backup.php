<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Tender_model extends CI_Model
{
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

    public function getPenggunaNotif()
    {
        $sql = "SELECT pengguna.id_pengguna,nama,no_telp FROM pengguna,preferensi,tender_terbaru
		        WHERE pengguna.id_pengguna=preferensi.id_pengguna AND preferensi.status='1' AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan REGEXP preferensi.jenis_pengadaan) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))
		        GROUP BY id_pengguna ORDER BY id_pengguna";

        return $this->db->query($sql);
    }

    public function getTenderTerbaru($id_pengguna)
    {
        $sql = "SELECT kode_tender,nama_tender,hps,akhir_daftar,tender_terbaru.id_lpse,nama_lpse,url
		        FROM pengguna,preferensi,tender_terbaru,lpse
		        WHERE pengguna.id_pengguna=preferensi.id_pengguna AND pengguna.id_pengguna={$id_pengguna} AND tender_terbaru.id_lpse=lpse.id_lpse AND preferensi.status='1' AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan REGEXP preferensi.jenis_pengadaan) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))
		        ORDER BY tender_terbaru.id_lpse,akhir_daftar";

        return $this->db->query($sql);
    }

    public function getJumlahTenderTerbaru($id_pengguna)
    {
        $sql = "SELECT COUNT(kode_tender) AS jumlah FROM pengguna,preferensi,tender_terbaru
		        WHERE pengguna.id_pengguna=preferensi.id_pengguna AND pengguna.id_pengguna={$id_pengguna} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',tender_terbaru.id_lpse<>'',tender_terbaru.id_lpse REGEXP preferensi.id_lpse) AND IF(preferensi.jenis_pengadaan='',tender_terbaru.jenis_pengadaan<>'',tender_terbaru.jenis_pengadaan REGEXP preferensi.jenis_pengadaan) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,hps<>'',hps BETWEEN nilai_hps_awal AND nilai_hps_akhir))";

        return $this->db->query($sql);
    }

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
        $data = $this->_client->request('POST', 'tender/s-limit', [

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

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

    public function getSearchTenderC($search, $keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby)
    {
        $data = $this->_client->request('POST', 'tender/s-count', [

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

    public function getTenderById($id)
    {
        $data = $this->_client->request('GET', "tender/$id", $this->_client->getConfig('headers'));

        $data = json_decode($data->getBody()->getContents(), true);

        return $data;
    }

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

    public $table = 'tender';

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

    private function _get_data_query()
    {
        $this->db->from($this->table);

        if (isset($_POST['search']['value'])) {
            $this->db->like('id_tender', $_POST['search']['value']);

            $this->db->or_like('id_lpse', $_POST['search']['value']);

            $this->db->or_like('id_jenis', $_POST['search']['value']);

            $this->db->or_like('nama_tender', $_POST['search']['value']);

            $this->db->or_like('nilai_hps', $_POST['search']['value']);

            $this->db->or_like('nilai_kontrak', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_tender', 'ASC');
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

    // =

    public function getdatastatistik()
    {
        $this->db->select('count(*) as total_tender');

        $this->db->from('tender');

        $total_tender = $this->db->get()->result();

        $this->db->select('count(*) as total_rup');

        $this->db->from('rup');

        $total_rup = $this->db->get()->result();

        // $this->db->select("*");

        $this->db->select('count(*) as total_lpse');

        $this->db->from('lpse');

        $total_lpse = $this->db->get()->result();

        $data = [

            'total_tender' => $total_tender,

            'total_rup' => $total_rup,

            'total_lpse' => $total_lpse,

        ];

        return $data;
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
}
