<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Preferensi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPreferensiByIdUser($id)
    {
        // get all preferensi from id_pengguna with pengguna
        $this->db->select('preferensi.*, pengguna.nama, pengguna.email, pengguna.npwp, pengguna.kategori, pengguna.status');
        $this->db->from('preferensi');
        $this->db->join('pengguna', 'preferensi.id_pengguna = pengguna.id_pengguna');
        $this->db->where('preferensi.id_pengguna', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPreferensiById($id)
    {
        // get all preferensi from id_pengguna with pengguna
        $this->db->select('preferensi.*, pengguna.nama, pengguna.email, pengguna.npwp, pengguna.kategori, pengguna.status');
        $this->db->from('preferensi');
        $this->db->join('pengguna', 'preferensi.id_pengguna = pengguna.id_pengguna');
        $this->db->where('preferensi.id_pengguna', $id);
        // get last preferensi
        $this->db->order_by('preferensi.id_preferensi', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPreferensiByIdPref($id)
    {
        // get all preferensi from id_pengguna with pengguna
        $this->db->select('preferensi.*, pengguna.nama, pengguna.email, pengguna.npwp, pengguna.kategori, pengguna.status');
        $this->db->from('preferensi');
        $this->db->join('pengguna', 'preferensi.id_pengguna = pengguna.id_pengguna');
        $this->db->where('preferensi.id_preferensi', $id);
        // get last preferensi
        $this->db->order_by('preferensi.id_preferensi', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahPreferensi($data)
    {
        $this->db->insert('preferensi', $data);
        return $this->db->insert_id();
    }

    public function createPreferensi($data)
    {
        $this->db->insert('preferensi', $data);
        return $this->db->insert_id();
    }

    public function updatePreferensi($id, $data_new)
    {
        $this->db->where('id_pengguna', $id);
        return $this->db->update('preferensi', $data_new);
    }

    public function updatePreferensiByIdPref($id, $data_new)
    {
        // var_dump($data_new);
        $this->db->where('id_preferensi', $id);
        $this->db->update('preferensi', $data_new);
        return $this->db->affected_rows();
    }

    public function getAllPreferensi()
    {
        $this->db->select('preferensi.*, pengguna.nama, pengguna.email, pengguna.npwp, pengguna.kategori, pengguna.status');
        $this->db->from('preferensi');
        $this->db->join('pengguna', 'preferensi.id_pengguna = pengguna.id_pengguna');
        $query = $this->db->get();
        return $query->result_array();
        var_dump($query->result_array());
    }

    public function getPreferensiTender($lpse, $wilayah, $klpd, $jenisPengadaan, $hps, $kualifikasi)
    {
        $lpse = json_decode(str_replace('quot', '"', $lpse));
        $wilayah = json_decode(str_replace('&quot;', '', $wilayah), true);
        $klpd = json_decode(str_replace('&quot;', '', $klpd), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $jenisPengadaan), true);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $hps));
        $kualifikasi = explode(',', str_replace(['&quot;', '[', ']'], '', $kualifikasi));

        // filter tender from tabel lpse using id wilayah
        $this->db->select('tender.*, detail_tender.lokasi_pekerjaan, lpse.id_lpse, lpse.id_wilayah, lpse.id_kategori, jenis_tender.*, kategori_lpse.*, tender.status AS tender_status, lpse.status AS lpse_status');
        $this->db->from('tender');
        $this->db->join('lpse', 'tender.id_lpse = lpse.id_lpse');
        $this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
        $this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        $this->db->join('kategori_lpse', 'lpse.id_kategori = kategori_lpse.id_kategori');
        if ($lpse != null) {
            $this->db->where_in('tender.id_lpse', $lpse);
        }
        if ($wilayah != null) {
            $this->db->where_in('lpse.id_wilayah', $wilayah);
        }
        if ($klpd != null) {
            $this->db->where_in('lpse.id_kategori', $klpd);
        }
        if ($jenisPengadaan != null) {
            $this->db->where_in('tender.id_jenis', $jenisPengadaan);
        }
        if ($hps !== null) {
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
        if ($kualifikasi[0] !== null && $kualifikasi[0] !== "null") {
            $this->db->where_in('kualifikasi', $kualifikasi);
        }
        // group by id tender and order desc
        $this->db->group_by('tender.id_tender');
        $this->db->order_by('tender.id_tender', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tenderSearch($id, $keyword, $orderby)
    {
        $preferensi = $this->getPreferensiById($id);

        $lpse = json_decode(str_replace('quot', '"', $preferensi[0]['id_lpse']));
        $wilayah = json_decode(str_replace('&quot;', '', $preferensi[0]['id_wilayah']), true);
        $klpd = json_decode(str_replace('&quot;', '', $preferensi[0]['id_kategori_lpse']), true);
        $jenisPengadaan = json_decode(str_replace('&quot;', '', $preferensi[0]['id_jenis_tender']), true);
        $hps = explode(',', str_replace(['&quot;', '[', ']'], '', $preferensi[0]['nilai_hps']));
        $kualifikasi = explode(',', str_replace(['&quot;', '[', ']'], '', $preferensi[0]['kualifikasi']));
        $orderby = str_replace(['&quot;', '[', ']'], '', $orderby);

        // ------------------------------------------------
        $this->db->select('tender.*, detail_tender.lokasi_pekerjaan, lpse.id_lpse, lpse.id_wilayah, lpse.id_kategori, jenis_tender.*, kategori_lpse.*, tender.status AS tender_status, lpse.status AS lpse_status');
        $this->db->from('tender');
        $this->db->join('lpse', 'tender.id_lpse = lpse.id_lpse');
        $this->db->join('detail_tender', 'tender.id_tender = detail_tender.id_tender');
        $this->db->join('jenis_tender', 'tender.id_jenis = jenis_tender.id_jenis');
        $this->db->join('kategori_lpse', 'lpse.id_kategori = kategori_lpse.id_kategori');
        if ($keyword !== null) {
            $this->db->group_start();
            $this->db->like('kategori_lpse.nama_kategori', $keyword);
            $this->db->or_like('tender.nama_tender', $keyword);
            $this->db->group_end();
        }

        if ($lpse != null) {
            $this->db->where_in('tender.id_lpse', $lpse);
        }
        if ($wilayah != null) {
            $this->db->where_in('lpse.id_wilayah', $wilayah);
        }
        if ($klpd != null) {
            $this->db->where_in('lpse.id_kategori', $klpd);
        }
        if ($jenisPengadaan != null) {
            $this->db->where_in('tender.id_jenis', $jenisPengadaan);
        }
        if ($hps !== null) {
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
        if ($kualifikasi[0] !== null && $kualifikasi[0] !== "null") {
            $this->db->where_in('kualifikasi', $kualifikasi);
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
        $this->db->group_by('tender.id_tender');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function hapusPreferensi($id)
    {
        $this->db->where('id_preferensi', $id);
        return $this->db->delete('preferensi');
    }
}
