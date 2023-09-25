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

    public function getTimMarketing()
    {
        $this->db->select(['*']);
        $this->db->from('tim_marketing');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTimMarketingById($id)
    {
        $this->db->select(['*']);
        $this->db->from('tim_marketing');
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
        $this->db->delete('tim_marketing', ['id_tim' => $id]);
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
        $this->db->insert('pengguna', $data);
        return $this->db->affected_rows();
    }

    // Get profile field only from data_lead
    public function getProfile($id)
    {
        $this->db->select(['*']);
        $this->db->from('data_leads');
        // $this->db->where('id_lead', $id);
        //join pemenang_tender to get alamat
        $this->db->join('pemenang_tender', 'pemenang_tender.id_pemenang = data_leads.id_pemenang');
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

    public function getDataLeads($id_pengguna,$page_size,$page_number)
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
        LIMIT {$page_number},{$page_size}";

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
}
