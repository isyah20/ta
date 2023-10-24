<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Supplier_api extends CI_Model
{

    private $_client;
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

    public function getTimMarketing($id_supplier)
    {
        // $this->db->select(['*']);
        $this->db->select('tim_marketing.*, pengguna.nama AS nama_tim, pengguna.email, pengguna.no_telp, pengguna.alamat');
        $this->db->from('tim_marketing');
        $this->db->join('pengguna', 'pengguna.id_pengguna = tim_marketing.id_pengguna');
        $this->db->where('id_supplier', $id_supplier);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTimMarketingById($id)
    {
        $this->db->select('tim_marketing.*, pengguna.nama AS nama_tim, pengguna.email, pengguna.no_telp, pengguna.alamat');
        $this->db->from('tim_marketing');
        $this->db->join('pengguna', 'pengguna.id_pengguna = tim_marketing.id_pengguna');
        $this->db->where('id_tim', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getTimMarketingByNama($nama)
    {
        $this->db->select(['*']);
        $this->db->from('tim_marketing');
        $this->db->where('nama', $nama);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function createTimMarketing($data)
    {
        $this->db->insert('tim_marketing', $data);
        return $this->db->affected_rows();
    }

    public function updateTimMarketing($data, $id)
    {
        $this->db->update('tim_marketing', $data, ['id_tim' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteTimMarketing($id)
    {
        $this->db->select('tim_marketing.*');
        $this->db->from('tim_marketing');
        $this->db->where('id_tim', $id);
        $query = $this->db->get();
        $id_pengguna = $query->row_array()['id_pengguna'];
        $this->db->delete('tim_marketing', ['id_tim' => $id]);
        $this->db->delete('pengguna', ['id_pengguna' => $id_pengguna]);
        return $this->db->affected_rows();
    }

    public function insertPlotting($data)
    {
        $this->db->insert('plot_tim', $data);
        return $this->db->affected_rows();
    }

    public function updatePlotting($data, $id)
    {
        $this->db->update('plot_tim', $data, ['id_plot' => $id]);
        return $this->db->affected_rows();
    }

    public function deletePlotting($id)
    {
        $this->db->delete('plot_tim', ['id_plot' => $id]);
        return $this->db->affected_rows();
    }

    // Insert the same Tim to table pengguna
    public function insertTimToPengguna($data)
    {
        $result =  $this->db->insert('pengguna', $data);
        // return $this->db->affected_rows();
        $inserted_id = $this->db->insert_id();
        $data = [
            'status' => $result,
            'id_pengguna' => $inserted_id
        ];
        return $data;
    }
    // Update the same Tim to table pengguna
    public function updateTimPengguna($data, $id)
    {
        $this->db->update('pengguna', $data, ['id_pengguna' => $id]);
        return $this->db->affected_rows();
    }


    // Get profile field only from data_lead
    public function getProfile($id)
    {
        $this->db->select(['*']);
        $this->db->from('data_leads');
        // $this->db->where('id_lead', $id);
        //join pemenang_tender to get alamat
        $this->db->join('pemenang', 'pemenang.id_pemenang = data_leads.id_pemenang');
        $this->db->where('data_leads.id_lead', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // insert into field profile
    public function insertProfile($data, $id)
    {
        $this->db->update('data_leads', $data, ['id_lead' => $id]);
        return $this->db->affected_rows();
    }

    // update field profile in data_lead
    public function updateProfile($data, $id)
    {
        $this->db->update('data_leads', $data, ['id_lead' => $id]);
        return $this->db->affected_rows();
    }

    // Get from kontak_lead by id_lead
    public function getContact($id)
    {
        $this->db->select(['*']);
        $this->db->from('kontak_lead');
        $this->db->where('id_lead', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get from kontak_lead by id_kontak
    public function getContactById($id)
    {
        $this->db->select(['*']);
        $this->db->from('kontak_lead');
        $this->db->where('id_kontak', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Insert into kontak_lead
    public function insertContact($data)
    {
        $this->db->insert('kontak_lead', $data);
        return $this->db->affected_rows();
    }

    // Update kontak_lead
    public function updateContact($data, $id)
    {
        $this->db->update('kontak_lead', $data, ['id_kontak' => $id]);
        return $this->db->affected_rows();
    }

    // Delete kontak_lead
    public function deleteContact($id)
    {
        $this->db->delete('kontak_lead', ['id_kontak' => $id]);
        return $this->db->affected_rows();
    }

    //Get pemenang by npwp
    public function getPemenangByNPWP($npwp)
    {
        $this->db->select('pemenang.*, jenis_tender.jenis_tender AS jenis_pengadaan, YEAR(tgl_pemenang) AS tahun');
        $this->db->from('pemenang');
        $this->db->join('jenis_tender', 'pemenang.jenis_tender = jenis_tender.id_jenis', 'LEFT');
        $this->db->where('npwp', $npwp);
        $query = $this->db->get();
        return $query->result();
    }
    //Get pemenang filter
    public function getPemenangFilter($npwp, $lokasi, $jenis, $penawaran_awal, $penawaran_akhir, $tahun)
    {
        $this->db->select('pemenang.*, jenis_tender.jenis_tender AS jenis_pengadaan, YEAR(pemenang.tgl_pemenang) AS tahun');
        $this->db->from('pemenang');
        $this->db->join('jenis_tender', 'pemenang.jenis_tender = jenis_tender.id_jenis', 'LEFT');
        $this->db->where('npwp', $npwp);
        if (!empty($jenis)) {
            $this->db->where('jenis_tender.jenis_tender', $jenis);
        }
        if (!empty($lokasi)) {
            $this->db->like('lokasi_pekerjaan', $lokasi);
        }
        if (!empty($penawaran_awal)) {
            $this->db->where('harga_penawaran >=', $penawaran_awal);
        }
        if (!empty($penawaran_akhir)) {
            $this->db->where('harga_penawaran <=', $penawaran_akhir);
        }
        if (!empty($tahun)) {
            $this->db->where('YEAR(pemenang.tgl_pemenang)', $tahun);
        }
        $query = $this->db->get();

        return $query->result();
    }

    public function getDataLeads($id_pengguna, $page_size, $page_number)
    {

        $sql = "SELECT
        data_leads.id_lead AS id,
        id_pengguna,
        nama_perusahaan,
        data_leads.npwp,
        profil,
        pemenang.*,
        kontak_lead.*,
        COUNT(kontak_lead.id_kontak) AS jumlah_kontak
        FROM
            data_leads
        LEFT JOIN
            pemenang ON data_leads.id_pemenang = pemenang.id_pemenang
        LEFT JOIN
            kontak_lead ON data_leads.id_lead = kontak_lead.id_lead
        WHERE
            data_leads.id_pengguna = $id_pengguna
        GROUP BY
            data_leads.id_lead
        ORDER BY
            id DESC
        LIMIT {$page_number},{$page_size}";

        return $this->db->query($sql);
    }

    public function getCRMLeads($id_pengguna)
    {

        $sql = "SELECT
        data_leads.id_lead,
        data_leads.id_pengguna,
        data_leads.nama_perusahaan,
        data_leads.npwp,
        data_leads.profil,
        pemenang.*,
        tim_marketing.id_tim,
        IFNULL(pemenang.lokasi_pekerjaan, '') AS lokasi_pekerjaan,
        IFNULL(lpse.nama_lpse, '') AS nama_lpse,
        IFNULL(wilayah.wilayah, '') AS wilayah
    FROM
        data_leads
    LEFT JOIN
        pemenang ON data_leads.id_pemenang = pemenang.id_pemenang
    LEFT JOIN 
        lpse ON pemenang.id_lpse = lpse.id_lpse
    LEFT JOIN 
        wilayah ON lpse.id_wilayah = wilayah.id_wilayah
    JOIN
        tim_marketing ON tim_marketing.id_supplier = data_leads.id_pengguna
    WHERE
        data_leads.id_pengguna = {$id_pengguna}
AND (data_leads.id_lead NOT IN (SELECT id_lead FROM plot_tim) OR data_leads.id_lead IN (SELECT id_lead FROM plot_tim WHERE id_tim = 0))
    GROUP BY
        data_leads.id_lead;
    ";

        return $this->db->query($sql);
    }
    public function countCRMLeads($id_pengguna)
    {

        $sql = "SELECT COUNT(DISTINCT data_leads.id_lead) AS jumlah
        FROM data_leads
        LEFT JOIN pemenang ON data_leads.id_pemenang = pemenang.id_pemenang
        LEFT JOIN lpse ON pemenang.id_lpse = lpse.id_lpse
        LEFT JOIN wilayah ON lpse.id_wilayah = wilayah.id_wilayah
        JOIN tim_marketing ON tim_marketing.id_supplier = data_leads.id_pengguna
        WHERE data_leads.id_pengguna = {$id_pengguna}
        AND (data_leads.id_lead NOT IN (SELECT id_lead FROM plot_tim) OR data_leads.id_lead IN (SELECT id_lead FROM plot_tim WHERE id_tim = 0));";

        return $this->db->query($sql);
    }

    // Get total data leads
    public function getTotalDataLeads($id_pengguna)
    {
        $this->db->select('COUNT(*) as total');
        $this->db->from('data_leads');
        $this->db->where('id_pengguna', $id_pengguna);
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function getCountDataLeads($id_pengguna)
    {
        $this->db->select(['COUNT(data_leads.id_lead) AS jumlah']);
        $this->db->from('data_leads');
        $this->db->join('kontak_lead', 'data_leads.id_lead = kontak_lead.id_lead', 'left');
        $this->db->where('kontak_lead.id_lead IS NULL');
        $this->db->where('data_leads.id_pengguna', $id_pengguna);
        $query = $this->db->get();
        return $query->row_array();
    }

    // public function getJumlahPemenangTender($id_pengguna)
    // {
    //     $this->db->select(['COUNT(pemenang.id_pemenang) AS jumlah']);
    //     $this->db->from('pemenang');
    //     $this->db->join('data_leads', 'pemenang.id_pemenang = data_leads.id_pemenang', 'left');
    //     $this->db->where('data_leads.id_pengguna', $id_pengguna);
    //     $query = $this->db->get();
    //     return $query->row_array();
    // }

    public function getJumlahPemenangTender($id_pengguna)
    {
        $preferensi = $this->Tender_model->getPreferensiPengguna($id_pengguna);
        // $sql = "SELECT COUNT(DISTINCT npwp) as jumlah_pemenang_terbaru FROM pemenang WHERE DATE(tgl_pemenang)=DATE(NOW());";
        // $sql = "SELECT 
        // COUNT(DISTINCT CASE WHEN DATE(tgl_pemenang) = DATE(NOW()) THEN npwp ELSE NULL END) AS total_today,
        // COUNT(DISTINCT CASE WHEN YEAR(tgl_pemenang) = YEAR(NOW()) AND MONTH(tgl_pemenang) = MONTH(NOW()) THEN npwp ELSE NULL END) AS total_month,
        // COUNT(DISTINCT CASE WHEN YEAR(tgl_pemenang) = YEAR(NOW()) THEN npwp ELSE NULL END) AS total_year
        // FROM preferensi, pemenang p
        // WHERE preferensi.id_pengguna={$id_pengguna} AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',p.id_lpse<>'',p.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',p.jenis_tender<>'',p.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir))
        // ";

        $this->db->select('
        COUNT(DISTINCT CASE WHEN DATE(tgl_pemenang) = DATE(NOW()) THEN npwp ELSE NULL END) AS total_today,
        COUNT(DISTINCT CASE WHEN YEAR(tgl_pemenang) = YEAR(NOW()) AND MONTH(tgl_pemenang) = MONTH(NOW()) THEN npwp ELSE NULL END) AS total_month,
        COUNT(DISTINCT CASE WHEN YEAR(tgl_pemenang) = YEAR(NOW()) THEN npwp ELSE NULL END) AS total_year
        ');

        $this->db->from('preferensi');
        $this->db->join('pemenang p', 'preferensi.id_pengguna = p.id_pengguna', 'INNER');
        $this->db->where('DATEDIFF(CURRENT_DATE, tgl_pemenang) <=', $this->interval_pemenang);
        $this->db->where('preferensi.status', '1');
        $this->db->where('IF(preferensi.id_lpse = "", p.id_lpse <> "", p.id_lpse IN (' . $preferensi->id_lpse . '))');
        $this->db->where('IF(preferensi.jenis_pengadaan = "", p.jenis_tender <> "", p.jenis_tender IN (' . $preferensi->jenis_pengadaan . '))');
        $this->db->where('IF(keyword = "", nama_tender <> "", nama_tender REGEXP keyword)');
        $this->db->where('IF(nilai_hps_awal = 0 AND nilai_hps_akhir = 0, harga_penawaran <> "", harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir)');

        $query = $this->db->get();
        return $query->row_array();
    }
}
