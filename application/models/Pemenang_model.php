<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Pemenang_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => base_url('api/'),
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
    }

    public function getSummaryMenang($data)
    {
        $cr_lpse = $data['lpse'] != '' ? "AND id_lpse={$data['lpse']}" : "";
        $cr_tahun = $data['tahun'] != '' ? "AND YEAR(tgl_pembuatan)={$data['tahun']}" : "AND YEAR(tgl_pembuatan)=YEAR(CURRENT_DATE)";

        $sql = "SELECT ikut,menang,(ikut-menang) AS kalah FROM
		        (SELECT COUNT(peserta_tender.kode_tender) AS ikut FROM peserta_tender,tender
		        WHERE peserta_tender.kode_tender=tender.id_tender AND npwp='{$data['npwp']}' {$cr_lpse} {$cr_tahun}) a,
		        (SELECT COUNT(pemenang.kode_tender) AS menang FROM pemenang,(SELECT peserta_tender.kode_tender FROM peserta_tender,tender
		        WHERE peserta_tender.kode_tender=tender.id_tender AND npwp='{$data['npwp']}' {$cr_lpse} {$cr_tahun} GROUP BY id_tender) a WHERE pemenang.kode_tender=a.kode_tender AND npwp='{$data['npwp']}') b";

        return $this->db->query($sql);
    }

    public function getAllPemenang()
    {
        $data = $this->_client->request('GET', 'pemenang', $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getAllPemenangbyId()
    {
        $data = $this->_client->request('GET', 'pemenangbyid', $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getSearchLpse($lpse)
    {
        $data = $this->_client->request('POST', 'pemenangbyid/', [
            'form_params' => [
                'lpse' => $lpse,
            ],
            'auth' => $this->_client->getConfig('headers')['auth'],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getPemenangById($id)
    {
        $data = $this->_client->request('GET', "pemenang/$id", $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function tambahPemenang($data)
    {
        $data = $this->_client->request('POST', 'pemenang/create', [
            'form_params' => $data,
            'auth' => $this->_client->getConfig('headers')['auth'],
        ]);
        // $data = json_decode($data->getBody()->getContents(), true);
        // return $data;
    }

    public function ubahPemenang($id, $data)
    {
        $data = $this->_client->request('PUT', "pemenang/update/$id", [
            'form_params' => $data,
            'auth' => $this->_client->getConfig('headers')['auth'],
        ]);
    }

    public function hapusPemenang($id)
    {
        $data = $this->_client->request('DELETE', "pemenang/delete/$id", $this->_client->getConfig('headers'));
    }

    // custom get data
    public $table = 'pemenang';
    public $column_order = ['id_pemenang', 'id_tender', 'npwp', 'harga_negosiasi', 'harga_kontrak'];
    public $order = ['id_pemenang', 'id_tender', 'npwp', 'harga_negosiasi', 'harga_kontrak'];

    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('id_pemenang', $_POST['search']['value']);
            $this->db->or_like('id_tender', $_POST['search']['value']);
            $this->db->or_like('npwp', $_POST['search']['value']);
            $this->db->or_like('harga_negosiasi', $_POST['search']['value']);
            $this->db->or_like('harga_kontrak', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_pemenang', 'ASC');
        }
    }

    public function getDataPemenang()
    {
        $this->_get_data_query();
        // var_dump($this->_get_data_query());
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

    public function getPemenangPerMonthByLpse($klpd, $jenisPengadaan, $hps, $tahun)
    {
        $data = $this->_client->request('POST', 'pemenang/perMonthByLpse', [
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
    // public function getPemenangPerMonth()
    // {
    //     $this->db->select('COUNT(id_pemenang) as jumlah_pemenang, tender.tgl_pembuatan as bulan');
    //     $this->db->from('pemenang');
    //     $this->db->join('tender', 'pemenang.id_tender = tender.id_tender');
    //     $this->db->group_by('DATE_FORMAT(tender.tgl_pembuatan, "%m%y")');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    public function fetch_data($limit, $start)
    {
        $this->db->select('pemenang.*, pemenang.npwp as npwp_peserta, tender.nama_tender,tender.id_lpse,tender.nilai_hps, peserta.*');
        $this->db->from('pemenang');
        $this->db->join('peserta', 'pemenang.npwp = peserta.npwp');
        $this->db->join('tender', 'pemenang.id_tender = tender.id_tender');
        // $this->db->where_in('tender.id_lpse', $id);
        $this->db->order_by('id_pemenang', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query;
    }

    public function getdata($limit, $start)
    {
        // $this->db->select('*');
        // $this->db->from('supplier_list');
        $this->db->select('COUNT(peserta_tender.`id_tender`)');
        $this->db->from('peserta_tender');
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.`npwp` = pemenang.npwp");
        $this->db->where("peserta_tender.harga_penawaran != 0 ");
        $this->db->where("tender.status NOT IN ('Tender Sudah Selesai','Selesai','Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal')");
        $ikut = $this->db->get_compiled_select();

        $this->db->select('pemenang.npwp');
        $this->db->from('pemenang');
        $this->db->join("peserta", "`pemenang`.`npwp` = `peserta`.`npwp`");
        $this->db->join("tender", "`pemenang`.`id_tender` = `tender`.`id_tender`");
        $this->db->join("jadwal", "pemenang.`id_tender` = jadwal.`id_tender`");
        $this->db->where("DATEDIFF(CURDATE(),jadwal.`tgl_mulai`) <= 7 AND DATEDIFF(CURDATE(),jadwal.`tgl_mulai`) >= 0");
        $menang_npwp = $this->db->get_compiled_select();

        //         SELECT COUNT(id_pemenang) FROM pemenang JOIN tender ON pemenang.`id_tender` = tender.`id_tender`
        // WHERE npwp = peserta_tender.`npwp`
        $this->db->select('count(pemenang.id_tender)');
        $this->db->from('pemenang');
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        $this->db->join("peserta_tender", "peserta_tender.npwp = pemenang.npwp");
        $this->db->where("pemenang.npwp = peserta_tender.npwp");
        $menang = $this->db->get_compiled_select();

        $this->db->select('COUNT(id_pemenang)');
        $this->db->from('pemenang');
        $this->db->join("tender", "pemenang.id_tender = tender.id_tender");
        // $this->db->where("pemenang.id_tender IN ($id_tender) ");
        $this->db->where("npwp != pemenang.`npwp`");
        $kalah = $this->db->get_compiled_select();

        $this->db->select("`pemenang`.*, `pemenang`.`npwp` AS  `npwp_peserta`, `tender`.`nama_tender`,`tender`.`id_jenis`, `tender`.`id_lpse`,`tender`.`nilai_hps`, `peserta`.`nama_peserta`,peserta.`alamat`, peserta.`email`, peserta.`no_telp` , jadwal.`id_tahapan`,jadwal.`tgl_mulai`");
        $this->db->select("($ikut) as ikut");
        $this->db->select("0 as menang");
        $this->db->select("($kalah) as kalah");
        $this->db->from("pemenang");
        $this->db->join("peserta", "`pemenang`.`npwp` = `peserta`.`npwp`");
        $this->db->join("tender", "`pemenang`.`id_tender` = `tender`.`id_tender`");
        $this->db->join("jadwal", "pemenang.`id_ten` = jadwal.`id_tender`");
        $this->db->where("DATEDIFF(CURDATE(),jadwal.`tgl_mulai`) <= 7 AND DATEDIFF(CURDATE(),jadwal.`tgl_mulai`) >= 0");
        $this->db->where("jadwal.`id_tahapan`", 12);
        // $this->db->where("id_lpse", $id);
        $this->db->limit($limit, $start);
        return $this->db->get();
    }

    public function getdata_id($limit, $start, $id)
    {
        $id = str_replace(['"', '[', '/', ']'], '', $id);
        // $this->db->select('*');
        // $this->db->from('supplier_list');
        $this->db->select("`pemenang`.*, `pemenang`.`npwp` AS  `npwp_peserta`, `tender`.`nama_tender`,`tender`.`id_jenis`, `tender`.`id_lpse`,`tender`.`nilai_hps`, `peserta`.`nama_peserta`,peserta.`alamat`, peserta.`email`, peserta.`no_telp` , jadwal.`id_tahapan`,jadwal.`tgl_mulai`");
        $this->db->from("pemenang");
        $this->db->join("peserta", "`pemenang`.`npwp` = `peserta`.`npwp`");
        $this->db->join("tender", "`pemenang`.`id_tender` = `tender`.`id_tender`");
        $this->db->join("jadwal", "pemenang.`id_tender` = jadwal.`id_tender`");
        $this->db->where("DATEDIFF(CURDATE(),jadwal.`tgl_mulai`) <= 7 AND DATEDIFF(CURDATE(),jadwal.`tgl_mulai`) >= 0");
        $this->db->where("jadwal.`id_tahapan`", 12);
        $this->db->where("`tender`.`id_lpse`", $id);
        $this->db->limit($limit, $start);
        return $this->db->get();
    }

    public function counttotaltender()
    {
        $this->db->select('COUNT(id_pemenang) AS COUNT');
        $this->db->from('pemenang');
        return $this->db->get()->row_array();
    }

    public function getAllPemenangbyLpse($limit, $start, $id)
    {
        $id = json_decode(str_replace('&quot;', '', $id), true);
        // var_dump($id);
        $this->db->select('pemenang.*, pemenang.npwp as npwp_peserta, tender.nama_tender,tender.id_lpse,tender.nilai_hps, peserta.*');
        $this->db->from('pemenang');
        $this->db->join('peserta', 'pemenang.npwp = peserta.npwp');
        $this->db->join('tender', 'pemenang.id_tender = tender.id_tender');
        $this->db->where_in('tender.id_lpse', $id);
        $this->db->order_by('id_pemenang', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query;
    }

    public function getAllPemenangbyIdTahapan()
    {
        $data = $this->_client->request('GET', 'pemenangbyidtahapan');
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getPemenangbyIdTahapanLim($limit, $start)
    {
        $data = $this->_client->request('POST', 'pemenangbyidtahapanlim', [
            'form_params' => [
                'limit' => $limit,
                'start' => $start,
            ],
        ]);
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getAllData_jml()
    {
        $data = $this->_client->request('GET', 'total_data', $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }
}
