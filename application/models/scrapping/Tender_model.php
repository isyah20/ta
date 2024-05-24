<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Tender_model extends CI_Model
{
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

    public function getRecentTenderOfLPSE($id_lpse)
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

    public function getCountTenderOfLPSE($id_lpse)
    {
        $this->db->where('id_lpse', $id_lpse);
        $this->db->where('tahun_anggaran', date("Y"));
        $this->db->group_start();
        $this->db->where('tahun_anggaran', date("Y"));
        $this->db->or_where('tahun_anggaran', date("Y") + 1);
        $this->db->group_end();
        $query = $this->db->get('tender');
        return $query->num_rows();
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
    public function getStatusTender($id_tender)
    {
        $this->db->select('status');
        $this->db->where('id_tender', $id_tender);
        $query = $this->db->get('tender');
        $row = $query->row();
        if ($row) {
            return $row->status;
        } else {
            return null;
        }
    }
    public function getTenderByKodeTender($kode_tender)
    {
        $this->db->where('id_tender', $kode_tender);
        $this->db->order_by('id_tender', 'DESC')->limit(1);
        $query = $this->db->get('tender');
        $row = $query->row();
        if ($row) {
            return [
                "id_tender" => $row->id_tender,
                "id_duplikat" => $row->id_duplikat,
                "id_lpse" => $row->id_lpse,
            ];
        } else {
            return null;
        }
    }

    public function getKodeTender()
    {
        $this->db->select(['tender.id_tender', 'tender.id_duplikat', 'tender.id_lpse', 'lpse.url']);
        $this->db->join('lpse', 'tender.id_lpse = lpse.id_lpse');
        $this->db->from('tender');
        $query = $this->db->get();
        // $query = $this->db->get('tender');
        return $query->result_array();
    }

    // public function getKodeTenderWithoutJoin()
    // {
    // 	$this->db->select('id_tender');
    // 	$this->db->order_by('id_tender', 'ASC');
    // 	$query = $this->db->get('tender');
    // 	return $query->result_array();
    // }

    public function getAllTender(array $sort = null)
    {
        $this->db->select('*');
        $this->db->from('tender');
        $this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
        $this->db->join('lpse', 'tender.id_lpse = lpse.id_lpse');
        $this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        if ($sort != null) {
            foreach ($sort as $data) {
                $this->db->order_by($data["target"], $data["sort"]);
            }
        }
        $query = $this->db->get();
        // $query = $this->db->get('tender');
        return $query->result_array();
    }

    public function getSearchTender($keyword, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi, $tahun, $tahapan, $orderby)
    {
        $wilayah = json_decode(str_replace('&quot;', '', $wilayah), true);
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        // $hps = str_replace(['&quot;', '[', ']'],'',$hps);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $kualifikasi = explode(',', str_replace(['&quot;', '[', ']'], '', $kualifikasi));
        $tahun = json_decode(str_replace('&quot;', '', $tahun), true);
        $tahapan = json_decode(str_replace('&quot;', '', $tahapan), true);
        $orderby = str_replace(['&quot;', '[', ']'], '', $orderby);
        // var_dump($orderby);

        // Mengambil id_lpse yang berada pada suatu wilayah
        $idLPSEWilayah = $this->db->where_in('id_wilayah', $wilayah)->get('lpse')->result_array();
        $id_lpseWil = [];
        foreach ($idLPSEWilayah as $idLPSE) {
            $id_lpseWil[] = $idLPSE['id_lpse'];
        }
        // ------------------------------------------------

        // Mengambil id_lpse yang berada pada suatu kategori
        $idLPSEKlpd = $this->db->where_in('id_kategori', $klpd)->get('lpse')->result_array();
        $id_lpseKlpd = [];
        foreach ($idLPSEKlpd as $idLPSE) {
            $id_lpseKlpd[] = $idLPSE['id_lpse'];
        }
        // ------------------------------------------------

        $this->db->select(['*', 'tender.status AS tender_status', 'lpse.status AS lpse_status']);
        $this->db->from('tender');
        $this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
        $this->db->join('lpse', 'tender.id_lpse = lpse.id_lpse');
        $this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        $this->db->join('kategori_lpse', 'lpse.id_kategori = kategori_lpse.id_kategori');
        $this->db->join('(SELECT MAX(id_jadwal), id_jadwal, id_tender FROM jadwal GROUP BY id_tender) jadwal', 'jadwal.id_tender = tender.id_tender');
        $this->db->join('(SELECT id_jadwal, id_tahapan FROM jadwal) tahapan', 'jadwal.id_jadwal = tahapan.id_jadwal');
        if ($keyword !== "") {
            $this->db->group_start();
            $this->db->like('kategori_lpse.nama_kategori', $keyword);
            $this->db->or_like('tender.nama_tender', $keyword);
            $this->db->group_end();
        }
        if ($wilayah !== "") {
            $this->db->where_in('tender.id_lpse', $id_lpseWil);
        }
        if ($klpd !== "") {
            $this->db->where_in('tender.id_lpse', $id_lpseKlpd);
        }
        if ($jenisPengadaan !== "") {
            $this->db->where_in('tender.id_jenis', $jenisPengadaan);
        }
        if ($hps !== "") {
            for ($i = 0; $i < count($hps); $i++) {
                if (strpbrk($hps[$i], "/")) {
                    $str = explode("/", $hps[$i]);
                    $this->db->where("tender.nilai_hps >", (int) $str[0]);
                    $this->db->where("tender.nilai_hps <", (int) $str[1]);
                } else {
                    $str = explode("than", $hps[$i]);
                    if (count($str) > 1) {
                        if ($str[0] === "less") {
                            $this->db->where("tender.nilai_hps <", (int) $str[1]);
                        } else {
                            $this->db->where("tender.nilai_hps >", (int) $str[1]);
                        }
                    }
                }
            }
        }
        if ($kualifikasi[0] !== "" && $kualifikasi[0] !== "null") {
            $this->db->where_in('kualifikasi', $kualifikasi);
        }
        if ($tahun !== "") {
            $this->db->where_in('tender.tahun_anggaran', $tahun);
        }
        if ($tahapan !== "") {
            $this->db->where_in('tahapan.id_tahapan', $tahapan);
        }
        if ($orderby !== "") {
            if ($orderby === "nama1") {
                $this->db->order_by('tender.nama_tender', 'asc');
            } elseif ($orderby === "nama2") {
                $this->db->order_by('tender.nama_tender', 'desc');
            } elseif ($orderby === "jenis1") {
                $this->db->order_by('jenis_tender', 'asc');
            } elseif ($orderby === "jenis2") {
                $this->db->order_by('jenis_tender', 'desc');
            } elseif ($orderby === "klpd1") {
                $this->db->order_by('nama_kategori', 'asc');
            } elseif ($orderby === "klpd2") {
                $this->db->order_by('nama_kategori', 'desc');
            } elseif ($orderby === "hps1") {
                $this->db->order_by('tender.nilai_hps', 'asc');
            } elseif ($orderby === "hps2") {
                $this->db->order_by('tender.nilai_hps', 'desc');
            }
        } else {
            $this->db->order_by('tender.tgl_pembuatan', 'desc');
        }
        // $this->db->order_by('id_tender', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTenderById($id)
    {
        $this->db->where('id_tender', $id);
        $query = $this->db->get('tender');
        return $query->row_array();
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

    public function updateStatus($id, $status, $id_lpse)
    {
        $this->db->set('status', $status);
        $this->db->where('id_tender', $id);
        $this->db->where('id_lpse', $id_lpse);
        $this->db->update('tender');
        return $this->db->affected_rows();
    }
}
