<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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

    // Get total data leads
    public function getTotalDataLeads()
    {
        $this->db->select(['*']);
        $this->db->from('data_leads');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getCountDataLeads()
    {
        $this->db->select(['COUNT(data_leads.id_lead) AS jumlah']);
        $this->db->from('data_leads');
        $this->db->join('kontak_lead', 'data_leads.id_lead = kontak_lead.id_lead', 'left');
        $this->db->where('kontak_lead.id_lead IS NULL');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getDataLeads($id)
    {
        $sql = "SELECT
        data_leads.*,
        IFNULL(kontak_lead.nama, '') AS nama_kontak,
        IFNULL(kontak_lead.posisi, '') AS posisi,
        IFNULL(kontak_lead.no_telp, '') AS no_telp,
        IFNULL(kontak_lead.email, '') AS email,
        IFNULL(pemenang_tender.lokasi_pekerjaan, '') AS lokasi_pekerjaan,
        IFNULL(lpse.nama_lpse, '') AS nama_lpse,
        IFNULL(wilayah.wilayah, '') AS wilayah
    FROM data_leads
    LEFT JOIN (
        SELECT kontak_lead.*
        FROM kontak_lead
        INNER JOIN (
            SELECT id_lead, MIN(id_kontak) AS oldest
            FROM kontak_lead
            GROUP BY id_lead
        ) oldest_contacts ON kontak_lead.id_lead = oldest_contacts.id_lead
        AND kontak_lead.id_kontak = oldest_contacts.oldest
    ) kontak_lead ON data_leads.id_lead = kontak_lead.id_lead
    LEFT JOIN pemenang_tender ON data_leads.id_pemenang = pemenang_tender.id_pemenang
    LEFT JOIN lpse ON pemenang_tender.id_lpse = lpse.id_lpse
    LEFT JOIN wilayah ON lpse.id_wilayah = wilayah.id_wilayah
    WHERE data_leads.id_pengguna = " . $id . ";
    ";

        $query = $this->db->query($sql);

        return $query->result_array();
    }
}