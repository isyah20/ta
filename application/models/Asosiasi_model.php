<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Asosiasi_model extends CI_Model
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

    public function getAll()
    {
        $data = $this->_client->request('GET', 'asosiasi', $this->_client->getConfig('headers'));
        $data = json_decode($data->getBody()->getContents(), true);
        return $data;
    }

    public function getAllfilterData()
    {
        $filter = $this->_client->request('GET', 'asosiasifilter', $this->_client->getConfig('headers'));
        $filter = json_decode($filter->getBody()->getContents(), true);
        return $filter;
    }

    public function getAllfilterhpsData()
    {
        $hps = $this->_client->request('GET', 'asosiasifilterhps', $this->_client->getConfig('headers'));
        $hps = json_decode($hps->getBody()->getContents(), true);
        return $hps;
    }

    public function gettestingdata()
    {
        $hps = $this->_client->request('GET', 'testing_penurunan', $this->_client->getConfig('headers'));
        $hps = json_decode($hps->getBody()->getContents(), true);
        return $hps;
    }

    public function getbylpse()
    {
        $hps = $this->_client->request('GET', 'testing_penurunan', $this->_client->getConfig('headers'));
        $hps = json_decode($hps->getBody()->getContents(), true);
        return $hps;
    }

    public function getbylpse1()
    {
        $hps = $this->_client->request('GET', 'testing_penurunan', $this->_client->getConfig('headers'));
        $hps = json_decode($hps->getBody()->getContents(), true);
        return $hps;
    }

    public function tambahanggota($data)
    {
        $data = $this->_client->request('POST', 'asosiasi/create', [
            'form_params' => $data,
            'auth' => $this->_client->getConfig('headers')['auth'],
        ]);
        // $data = json_decode($data->getBody()->getContents(), true);
        // return $data;
    }
    public function hapusanggota($id)
    {
        $data = $this->_client->request('DELETE', "asosiasi/destroy/$id", $this->_client->getConfig('headers'));
    }

    public function getTabelDefault($datatable, $search, $id_pengguna, $orderby)
    {
        // $data = $this->input->post();
        $this->db->select('count(id_pemenang)');
        $this->db->from('pemenang');
        $this->db->where('npwp = asosiasi.`npwp`');
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

        $this->db->select('COUNT(peserta_tender.`id_tender`)');
        $this->db->from('peserta_tender');
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`");
        $this->db->where("peserta_tender.`npwp` = asosiasi.`npwp`");
        $this->db->where("peserta_tender.harga_penawaran != 0 ");
        $this->db->where("tender.status NOT IN ('Tender Sudah Selesai','Selesai','Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal')");
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

        $this->db->select("ROUND((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`rata3`, 0))/COUNT(asosiasi.`npwp`=ratahps.`npwp`)),1)");
        $this->db->from("ratahps");
        $this->db->join("asosiasi", "ratahps.`npwp` = asosiasi.`npwp`");
        $this->db->group_by("asosiasi.npwp");
        if ($search['tahun']) {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("tahun = '$tahun'");
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
        $this->db->join("ratahps", "ratahps.`npwp` = asosiasi.`npwp`", "left");
        $this->db->join("peserta_tender", "peserta_tender.`npwp` = asosiasi.`npwp`", "left");
        $this->db->join("tender", "tender.`id_tender` = peserta_tender.`id_tender`", "left");
        $this->db->where("anggota_asosiasi.id_pengguna = $id_pengguna");
        $this->db->group_by("asosiasi.`id_anggota` ");
        if ($search['keyword'] != "") {
            $keyword = $search['keyword'];
            if ($keyword) {
                $this->db->where("nama_peserta LIKE '%$keyword%'");
            }
        }
        if ($search['tahun'] != "") {
            $tahun = $search['tahun'];
            if ($tahun) {
                $this->db->where("ratahps.tahun LIKE '$tahun'");
            }
        }
        if ($search['lpse'] != "") {
            $lpse = $search['lpse'];
            if ($lpse) {
                $this->db->where("ratahps.id_lpse = '$lpse'");
            }
        }
        if ($orderby != null) {
            if ($orderby === "nama1") {
                $this->db->order_by('asosiasi.nama_peserta', 'asc');
            } elseif ($orderby === "nama2") {
                $this->db->order_by('asosiasi.nama_peserta', 'desc');
            } elseif ($orderby === "ikut1") {
                $this->db->order_by("($ikut) asc");
            } elseif ($orderby === "ikut2") {
                $this->db->order_by("($ikut) desc");
            } elseif ($orderby === "menang1") {
                $this->db->order_by("($menang)", "asc");
            } elseif ($orderby === "menang2") {
                $this->db->order_by("($menang)", "desc");
            } elseif ($orderby === "kalah1") {
                $this->db->order_by("($kalah)", "asc");
            } elseif ($orderby === "kalah2") {
                $this->db->order_by("($kalah)", "desc");
            } elseif ($orderby === "penurunan1") {
                $this->db->order_by('(ROUND(((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`hasil`, 0))*100)/SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`nilai_hps`, 0))),1)) asc');
            } elseif ($orderby === "penurunan2") {
                $this->db->order_by('(ROUND(((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`hasil`, 0))*100)/SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, ratahps.`nilai_hps`, 0))),1)) desc');
            } else {
                $this->db->order_by('asosiasi.nama_peserta', 'asc');
            }
        }
        $asosiasi = $this->db->get_compiled_select();
        // if ($count) {
        //     return $this->db->count_all_results();
        // } else {
        //     $this->db->limit($limit, $start);
        //     $query = $this->db->get();

        //     if ($query->num_rows() > 0) {
        //         return $query->result_array();
        //     }
        // }
        // if ($data['search_key'] === '' && $data['lpse'] === "[]" && $data['tahun'] === "[]") {
        //     $datatable['col-display'] = array(
        //         '`asosiasi`.*',
        //         '(SELECT COUNT(id_pemenang) FROM `pemenang`
        //         JOIN `tender` ON `pemenang`.`id_tender` = `tender`.`id_tender` WHERE `npwp` = `asosiasi`.`npwp`) AS menang',
        //         '(SELECT COUNT(id_pemenang)
        //         FROM `pemenang` JOIN `tender` ON `pemenang`.`id_tender` = `tender`.`id_tender`
        //         WHERE pemenang.id_tender IN (SELECT `id_tender` FROM `peserta_tender`
        //         WHERE `npwp` = `asosiasi`.`npwp` AND `harga_penawaran` != 0) AND `npwp` != `asosiasi`.`npwp`) AS kalah',
        //         "(SELECT COUNT(peserta_tender.`id_tender`) FROM `peserta_tender`
        //         JOIN `tender` ON tender.`id_tender` = peserta_tender.`id_tender`
        //         WHERE `peserta_tender`.`npwp` = `asosiasi`.`npwp` AND `peserta_tender`.`harga_penawaran` != 0
        //         AND `tender`.`status` NOT IN ('Tender Sudah Selesai', 'Selesai', 'Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal'))
        //         AS ikut",
        //         'ROUND(((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, `ratahps`.`hasil`, 0))*100)/SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, `ratahps`.`nilai_hps`, 0)))
        //         , 1) AS penurunan_hps ',
        //     );
        // } else if ($data['search_key'] === '' && $data['lpse'] === "[]") { //isi Tahun
        //     $datatable['col-display'] = array(
        //         '`asosiasi`.*', 'ini salah',
        //         '(SELECT COUNT(id_pemenang) FROM `pemenang`
        //         JOIN `tender` ON `pemenang`.`id_tender` = `tender`.`id_tender` WHERE `npwp` = `asosiasi`.`npwp`) AS menang',
        //         '(SELECT COUNT(id_pemenang)
        //         FROM `pemenang` JOIN `tender` ON `pemenang`.`id_tender` = `tender`.`id_tender`
        //         WHERE pemenang.id_tender IN (SELECT `id_tender` FROM `peserta_tender`
        //         WHERE `npwp` = `asosiasi`.`npwp` AND `harga_penawaran` != 0) AND `npwp` != `asosiasi`.`npwp`) AS kalah',
        //         "(SELECT COUNT(peserta_tender.`id_tender`) FROM `peserta_tender`
        //         JOIN `tender` ON tender.`id_tender` = peserta_tender.`id_tender`
        //         WHERE `peserta_tender`.`npwp` = `asosiasi`.`npwp` AND `peserta_tender`.`harga_penawaran` != 0
        //         AND `tender`.`status` NOT IN ('Tender Sudah Selesai', 'Selesai', 'Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal'))
        //         AS ikut",
        //         'ROUND(((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, `ratahps`.`hasil`, 0))*100)/SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, `ratahps`.`nilai_hps`, 0)))
        //         , 1) AS penurunan_hps ',
        //     );
        // } else if ($data['search_key'] === '' && $data['tahun'] === "[]") { //isi lpse
        //     $datatable['col-display'] = array(
        //         '`asosiasi`.*', 'ini juga',
        //         '(SELECT COUNT(id_pemenang) FROM `pemenang`
        //         JOIN `tender` ON `pemenang`.`id_tender` = `tender`.`id_tender` WHERE `npwp` = `asosiasi`.`npwp`) AS menang',
        //         '(SELECT COUNT(id_pemenang)
        //         FROM `pemenang` JOIN `tender` ON `pemenang`.`id_tender` = `tender`.`id_tender`
        //         WHERE pemenang.id_tender IN (SELECT `id_tender` FROM `peserta_tender`
        //         WHERE `npwp` = `asosiasi`.`npwp` AND `harga_penawaran` != 0) AND `npwp` != `asosiasi`.`npwp`) AS kalah',
        //         "(SELECT COUNT(peserta_tender.`id_tender`) FROM `peserta_tender`
        //         JOIN `tender` ON tender.`id_tender` = peserta_tender.`id_tender`
        //         WHERE `peserta_tender`.`npwp` = `asosiasi`.`npwp` AND `peserta_tender`.`harga_penawaran` != 0
        //         AND `tender`.`status` NOT IN ('Tender Sudah Selesai', 'Selesai', 'Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal'))
        //         AS ikut",
        //         'ROUND(((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, `ratahps`.`hasil`, 0))*100)/SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, `ratahps`.`nilai_hps`, 0)))
        //         , 1) AS penurunan_hps ',
        //     );
        // } else if ($data['search_key'] === '') { //isi Tahun
        //     $datatable['col-display'] = array(
        //         '`asosiasi`.*', 'wow ini juga',
        //         '(SELECT COUNT(id_pemenang) FROM `pemenang`
        //         JOIN `tender` ON `pemenang`.`id_tender` = `tender`.`id_tender` WHERE `npwp` = `asosiasi`.`npwp`) AS menang',
        //         '(SELECT COUNT(id_pemenang)
        //         FROM `pemenang` JOIN `tender` ON `pemenang`.`id_tender` = `tender`.`id_tender`
        //         WHERE pemenang.id_tender IN (SELECT `id_tender` FROM `peserta_tender`
        //         WHERE `npwp` = `asosiasi`.`npwp` AND `harga_penawaran` != 0) AND `npwp` != `asosiasi`.`npwp`) AS kalah',
        //         "(SELECT COUNT(peserta_tender.`id_tender`) FROM `peserta_tender`
        //         JOIN `tender` ON tender.`id_tender` = peserta_tender.`id_tender`
        //         WHERE `peserta_tender`.`npwp` = `asosiasi`.`npwp` AND `peserta_tender`.`harga_penawaran` != 0
        //         AND `tender`.`status` NOT IN ('Tender Sudah Selesai', 'Selesai', 'Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal'))
        //         AS ikut",
        //         'ROUND(((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, `ratahps`.`hasil`, 0))*100)/SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, `ratahps`.`nilai_hps`, 0)))
        //         , 1) AS penurunan_hps ',
        //     );
        // }
        // $datatable['col-display'] = array(
        //     '`asosiasi`.*',
        //     '(SELECT COUNT(id_pemenang) FROM `pemenang`
        //     JOIN `tender` ON `pemenang`.`id_tender` = `tender`.`id_tender`
        //     WHERE `npwp` = `asosiasi`.`npwp`) AS menang',
        //     '(SELECT COUNT(id_pemenang)
        //     FROM `pemenang` JOIN `tender` ON `pemenang`.`id_tender` = `tender`.`id_tender`
        //     WHERE pemenang.id_tender IN (SELECT `id_tender` FROM `peserta_tender`
        //     WHERE `npwp` = `asosiasi`.`npwp` AND `harga_penawaran` != 0) AND `npwp` != `asosiasi`.`npwp`) AS kalah',
        //     "(SELECT COUNT(peserta_tender.`id_tender`) FROM `peserta_tender`
        //     JOIN `tender` ON tender.`id_tender` = peserta_tender.`id_tender`
        //     WHERE `peserta_tender`.`npwp` = `asosiasi`.`npwp` AND `peserta_tender`.`harga_penawaran` != 0
        //     AND `tender`.`status` NOT IN ('Tender Sudah Selesai', 'Selesai', 'Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal'))
        //     AS ikut",
        //     'ROUND(((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, `ratahps`.`hasil`, 0))*100)/SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, `ratahps`.`nilai_hps`, 0)))
        //     , 1) AS penurunan_hps ',
        // 'detail_tender.lokasi_pekerjaan AS lokasi_pekerjaan',
        // 'jenis_tender.jenis_tender AS jenis_tender',
        // 'tender.status AS tender_status',
        // );
        // $columns = implode(', ', $datatable['col-display']);
        // // var_dump($data)
        // $sql_asosiasi = "";
        // if ($data['search_key'] === '' && $data['lpse'] === "[]" && $data['tahun'] === "[]") {
        //     $sql_asosiasi .=
        //         "
        // 	asosiasi
        //     JOIN `anggota_asosiasi` ON `anggota_asosiasi`.`npwp` = `asosiasi`.`npwp`
        //     LEFT JOIN `ratahps` ON ratahps.`npwp` = asosiasi.`npwp`
        //     LEFT JOIN `peserta_tender` ON peserta_tender.`npwp` = asosiasi.`npwp`
        //     LEFT JOIN `tender` ON tender.`id_tender` = peserta_tender.`id_tender`
        // 	";
        // } else {
        //     $sql_asosiasi .=
        //         "
        //         asosiasi
        //         JOIN `anggota_asosiasi` ON `anggota_asosiasi`.`npwp` = `asosiasi`.`npwp`
        //         LEFT JOIN `ratahps` ON ratahps.`npwp` = asosiasi.`npwp`
        //         LEFT JOIN `peserta_tender` ON peserta_tender.`npwp` = asosiasi.`npwp`
        //         LEFT JOIN `tender` ON tender.`id_tender` = peserta_tender.`id_tender`
        // 	";
        //     // $columns .= '`asosiasi`.*,
        //     // (SELECT COUNT(id_pemenang) FROM `pemenang`
        //     // JOIN `tender` ON `pemenang`.`id_tender` = `tender`.`id_tender`
        //     // WHERE `npwp` = `asosiasi`.`npwp`) AS menang,
        //     // (SELECT COUNT(id_pemenang)
        //     // FROM `pemenang` JOIN `tender` ON `pemenang`.`id_tender` = `tender`.`id_tender`
        //     // WHERE pemenang.id_tender IN (SELECT `id_tender` FROM `peserta_tender`
        //     // WHERE `npwp` = `asosiasi`.`npwp` AND `harga_penawaran` != 0) AND `npwp` != `asosiasi`.`npwp`) AS kalah,
        //     // "(SELECT COUNT(peserta_tender.`id_tender`) FROM `peserta_tender`
        //     // JOIN `tender` ON tender.`id_tender` = peserta_tender.`id_tender`
        //     // WHERE `peserta_tender`.`npwp` = `asosiasi`.`npwp` AND `peserta_tender`.`harga_penawaran` != 0
        //     // AND `tender`.`status` NOT IN ("Tender Sudah Selesai", "Selesai", "Gagal", "Seleksi Batal", "Tender Gagal", "Seleksi Gagal", "Tender Batal"))
        //     // AS ikut",
        //     // ROUND(((SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, `ratahps`.`hasil`, 0))*100)/SUM(IF(asosiasi.`npwp`=ratahps.`npwp`, `ratahps`.`nilai_hps`, 0)))
        //     // , 1) AS penurunan_hps';
        // }
        // $sql  = "SELECT {$columns} FROM {$sql_asosiasi}";
        // $columnd = $datatable['col-display'];
        // $count_c = count($columnd);
        // $where = '';
        // // var_dump($sql);
        // if ($data['search_key'] === '' && $data['lpse'] === "[]" && $data['tahun'] === "[]") {
        //     $where =
        //         "
        //         `anggota_asosiasi`.`id_pengguna` = 3230694
        // 	";
        //     // var_dump($where);
        // } else {
        //     $search = $data['search_key'];
        //     // var_dump($search);
        //     // $search_key = json_decode(str_replace('&quot;', '', '["null"]'), true);
        //     $lpse = json_decode(str_replace('&quot;', '', $data['lpse']), true);
        //     $tahun = json_decode(str_replace('&quot;', '', $data['tahun']), true);
        //     if ($search !== "") {
        //         if ($where === '') {
        //             $where .= ("nama_peserta LIKE '%$search%'");
        //         } else {
        //             $where .= ("nama_peserta LIKE '%$search%'");
        //         }
        //     }
        //     if ($lpse !== []) {
        //         if ($where === '') {
        //             $where .= "ratahps.id_lpse = $lpse";
        //         } else
        //             $where .= " AND ratahps.id_lpse = $lpse";
        //     } else {
        //         if ($where === '') {
        //             $where .= "";
        //         } else
        //             $where .= "";
        //     }
        //     if ($tahun !== []) {
        //         if ($where === '') {
        //             $where .= "ratahps.tahun = $tahun ";
        //         } else
        //             $where .= " ratahps.tahun =$tahun";
        //     }
        // }

        // if ($where != '') {
        //     $sql .= " WHERE " . $where . " GROUP BY `asosiasi`.`id_anggota`";
        // }
        $data = $this->db->query($asosiasi);
        $total_filter = $data->num_rows();
        // var_dump($total_filter);
        $data->free_result();
        $start = $datatable['start'];
        $length = $datatable['length'];
        if ($length != -1) {
            $asosiasi .= " LIMIT {$start}, {$length}";
        }
        $data = $this->db->query($asosiasi);
        $option['draw'] = $datatable['draw'];
        $option['recordsTotal'] = $total_filter;
        $option['recordsFiltered'] = $total_filter;
        $option['data'] = [];
        $n = 1;
        // $n++;
        foreach ($data->result() as $row) {
            // var_dump($row);
            $data = [];
            $data[] = '<div class="text-center col-kode text1 mx-1">' . $n++ . '</div>';
            if ($row->penurunan_hps < 0) {
                $data[] = '<div><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row->id_anggota . '" class="col-nama text2 mx-1 p-0">' . $row->nama_peserta . '</a>
            <div class="modal fade showProfile" id="exampleModal' . $row->id_anggota . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img style="width: 100%;" src="' . base_url("assets/img/background_modal.png") . '" alt="">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="border_img">
                                <img style="width: 110px; height: 110px; " src="' . base_url("assets/img/profile_popup.png") . '" alt="">
                            </div>
                            <div class="container text_nama mt-5 pt-1">
                                <h3>' . $row->nama_peserta . '</h3>
                                <p>' . $row->provinsi . ', Indonesia</p>
                                <div class="d-flex justify-content-center text-center">
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>' . $row->ikut . '</h4>
                                        <p class="description">Ikut Tender</p>
                                    </div>
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>' . $row->menang . '</h4>
                                        <p class="description">Menang</p>
                                    </div>
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>' . $row->kalah . '</h4>
                                        <p class="description">Kalah</p>
                                    </div>
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>
                                            <iconify-icon inline icon="gg:arrow-long-up"></iconify-icon> ' . $row->penurunan_hps . '%
                                        </h4>
                                        <p class="description">Penurunan HPS</p>
                                    </div>
                                </div>
                                <div class="d-flex p-2 text_detail">
                                    <div class="col-lg">
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:call" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Nomor Telpon</h3>
                                                <p>' . $row->no_telp . '</p>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="mdi:email" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Email</h3>
                                                <p>' . $row->email . '</p>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:assignment-ind" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Kartu Tanda Anggota</h3>
                                                <p>-</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:assignment" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>NPWP</h3>
                                                <p>' . $row->npwp . '</p>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:location-on" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Alamat</h3>
                                                <p>' . $row->alamat . '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
            } elseif ($row->penurunan_hps > 0) {
                $data[] = '<div><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row->id_anggota . '" class="col-nama text2 mx-1 p-0">' . $row->nama_peserta . '</a>
            <div class="modal fade showProfile" id="exampleModal' . $row->id_anggota . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img style="width: 100%;" src="' . base_url("assets/img/background_modal.png") . '" alt="">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="border_img">
                                <img style="width: 110px; height: 110px; " src="' . base_url("assets/img/profile_popup.png") . '" alt="">
                            </div>
                            <div class="container text_nama mt-5 pt-1">
                                <h3>' . $row->nama_peserta . '</h3>
                                <p>' . $row->provinsi . ', Indonesia</p>
                                <div class="d-flex justify-content-center text-center">
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>' . $row->ikut . '</h4>
                                        <p class="description">Ikut Tender</p>
                                    </div>
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>' . $row->menang . '</h4>
                                        <p class="description">Menang</p>
                                    </div>
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>' . $row->kalah . '</h4>
                                        <p class="description">Kalah</p>
                                    </div>
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>
                                            <iconify-icon inline icon="gg:arrow-long-down"></iconify-icon> ' . $row->penurunan_hps . '%
                                        </h4>
                                        <p class="description">Penurunan HPS</p>
                                    </div>
                                </div>
                                <div class="d-flex p-2 text_detail">
                                    <div class="col-lg">
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:call" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Nomor Telpon</h3>
                                                <p>' . $row->no_telp . '</p>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="mdi:email" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Email</h3>
                                                <p>' . $row->email . '</p>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:assignment-ind" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Kartu Tanda Anggota</h3>
                                                <p>-</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:assignment" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>NPWP</h3>
                                                <p>' . $row->npwp . '</p>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:location-on" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Alamat</h3>
                                                <p>' . $row->alamat . '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
            } else {
                $data[] = '<div><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row->id_anggota . '" class="col-nama text2 mx-1 p-0">' . $row->nama_peserta . '</a>
            <div class="modal fade showProfile" id="exampleModal' . $row->id_anggota . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img style="width: 100%;" src="' . base_url("assets/img/background_modal.png") . '" alt="">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="border_img">
                                <img style="width: 110px; height: 110px; " src="' . base_url("assets/img/profile_popup.png") . '" alt="">
                            </div>
                            <div class="container text_nama mt-5 pt-1">
                                <h3>' . $row->nama_peserta . '</h3>
                                <p>' . $row->provinsi . ', Indonesia</p>
                                <div class="d-flex justify-content-center text-center">
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>' . $row->ikut . '</h4>
                                        <p class="description">Ikut Tender</p>
                                    </div>
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>' . $row->menang . '</h4>
                                        <p class="description">Menang</p>
                                    </div>
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>' . $row->kalah . '</h4>
                                        <p class="description">Kalah</p>
                                    </div>
                                    <div class="col-lg m-2 chart-bg">
                                        <h4>
                                            -%
                                        </h4>
                                        <p class="description">Penurunan HPS</p>
                                    </div>
                                </div>
                                <div class="d-flex p-2 text_detail">
                                    <div class="col-lg">
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:call" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Nomor Telpon</h3>
                                                <p>' . $row->no_telp . '</p>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="mdi:email" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Email</h3>
                                                <p>' . $row->email . '</p>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:assignment-ind" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Kartu Tanda Anggota</h3>
                                                <p>-</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:assignment" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>NPWP</h3>
                                                <p>' . $row->npwp . '</p>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2">
                                            <div class="p-2 align-self-center">
                                                <iconify-icon inline icon="material-symbols:location-on" style="color: #d21b1b;"></iconify-icon>
                                            </div>
                                            <div>
                                                <h3>Alamat</h3>
                                                <p>' . $row->alamat . '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
            };
            $data[] = '<div class="col-jenis text3 mx-1">' . $row->ikut . '</div>';
            $data[] = '<div class="col-klpd text4 mx-1">' . $row->menang . '</div>';
            $data[] = '<div class="col-hps text5 mx-1">' . $row->kalah . '</div>';
            if ($row->penurunan_hps < 0) {
                $data[] = '<div class="col-hps text4 mx-1" style="color:red"><iconify-icon inline icon="ic:baseline-arrow-upward" style="color: red;" width="20" height="20" ></iconify-icon>' . $row->penurunan_hps . '%</div>';
            } elseif ($row->penurunan_hps > 0) {
                $data[] = '<div class="col-hps text4 mx-1"><iconify-icon inline icon="ic:baseline-arrow-downward" style="color: #059669;" width="20" height="20"></iconify-icon>' . $row->penurunan_hps . '%</div>';
            } else {
                $data[] = '<div class="col-hps text4 mx-1" style="color:black">-</div>';
            }
            // $data[] = $row->penurunan_hps;
            $option['data'][] = $data;
        }
        // $n++;
        return print_r(json_encode($option));
    }

    public function data_anggota($anggota, $search, $id_pengguna)
    {
        $this->db->select('anggota_asosiasi.* , peserta.nama_peserta');
        $this->db->from('anggota_asosiasi');
        $this->db->join('peserta', 'anggota_asosiasi.npwp = peserta.npwp');
        $this->db->where("anggota_asosiasi.id_pengguna = $id_pengguna");
        if ($search['keyword'] != "") {
            $keyword = $search['keyword'];
            if ($keyword) {
                $this->db->where("nama_peserta LIKE '%$keyword%'");
            }
        }
        $anggota_asosiasi = $this->db->get_compiled_select();

        $data = $this->db->query($anggota_asosiasi);
        $total_filter = $data->num_rows();
        // var_dump($total_filter);
        $data->free_result();
        $start = $anggota['start'];
        $length = $anggota['length'];
        if ($length != -1) {
            $anggota_asosiasi .= " LIMIT {$start}, {$length}";
        }
        $data = $this->db->query($anggota_asosiasi);
        $option['draw'] = $anggota['draw'];
        $option['recordsTotal'] = $total_filter;
        $option['recordsFiltered'] = $total_filter;
        $option['data'] = [];
        $n = 1;
        // $n++;
        foreach ($data->result() as $row) {
            // var_dump($row);
            $data = [];
            //     $data[] = '<div class="d-flex justify-content-between">
            //     <div class="d-flex">
            //         <p>' . $n++ . '</p>
            //         <p>' . $row->nama_peserta . '</p>
            //     </div>
            // </div>';
            $data[] = '<p>' . $n++ . '</p>';
            $data[] = '<p style="margin-bottom:0px; margin-top:1rem;">' . $row->nama_peserta . '</p><p>NPWP : ' . $row->npwp . '</p>';
            $data[] = '<a class="button_delete_anggota"><button style="background:none; border:none"><iconify-icon inline icon="mdi:trash-can-outline" style="color: #cf0000;" height="30px" width="30px"></iconify-icon></button></a>';
            $option['data'][] = $data; //href="' . base_url('remove/anggota/') . '' . $row->id_anggota . '"
        }
        // $n++;
        return print_r(json_encode($option));
    }

    public function getAnggotaAssot()
    {
        $sql = "SELECT peserta.`nama_peserta`,  COUNT(tender.`id_tender`) AS ikut_tender, COUNT(pemenang.`npwp`) AS menang,
       COUNT(`peserta_tender`.`npwp`) AS kalah, ROUND((tender.`nilai_hps` - `peserta_tender`.`harga_penawaran`) / `tender`.`nilai_hps` * 100, 2) AS 
       penurunan
       FROM `peserta` INNER JOIN `anggota_asosiasi` ON peserta.`npwp`=`anggota_asosiasi`.`npwp` 
       LEFT JOIN `pemenang` ON `peserta`.`npwp`=`pemenang`.`npwp`
       INNER JOIN `peserta_tender` ON `peserta`.`npwp`=`peserta_tender`.`npwp` LEFT JOIN tender ON 
       `peserta_tender`.`id_tender`=`tender`.`id_tender` LEFT JOIN lpse ON
       tender.`id_lpse`=`lpse`.`id_lpse`
        WHERE pemenang.`npwp` IS NULL GROUP BY `peserta`.`npwp`";

        return $this->db->query($sql);
    }

    public function notifikasi($id_pengguna)
    {
        $sebulansebelumnya = date('Y-m-d', strtotime('-30 days', strtotime(date('Y-m-d'))));
        $sql = "SELECT notifikasi.*, p.nama_peserta FROM `notifikasi` JOIN anggota_asosiasi aa ON notifikasi.npwp = aa.npwp JOIN peserta p ON notifikasi.npwp = p.npwp WHERE aa.id_pengguna = $id_pengguna AND notifikasi.waktu_notif >= '$sebulansebelumnya' ORDER BY notifikasi.waktu_notif DESC, notifikasi.id_notifikasi DESC;";
        return $this->db->query($sql)->result_array();
    }
}
