<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Marketing_model extends CI_Model {

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

    // Get * field status, jadwal, and catatan from table plot_tim then join table kontak lead to get no telp then join to table tim marketing to get id pengguna
    public function getPlotTim($id)
    {
        $this->db->select(['*']);
        $this->db->from('plot_tim');
        $this->db->join('kontak_lead', 'plot_tim.id_lead = kontak_lead.id_lead');
        $this->db->join('tim_marketing', 'plot_tim.id_tim = tim_marketing.id_tim');
        // ambil data dari plot tim berdasarkan id pengguna yang login di tim marketing
        $this->db->where('tim_marketing.id_pengguna', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    // update field status, jadwal, and catatan from table plot_tim
    public function updatePlotTim($data, $id)
    {
        $this->db->update('plot_tim', $data, ['id_plot' => $id]);
        return $this->db->affected_rows();
    }
    
    public function getLeadsByTim($id){
        $this->db->select('data_leads.*,  kontak_lead.nama, kontak_lead.posisi, kontak_lead.no_telp, kontak_lead.email, plot_tim.status, plot_tim.jadwal, plot_tim.catatan');
        $this->db->select('COUNT(history_marketing.id_lead) AS jumlah_history');
        $this->db->from('data_leads');
        $this->db->join('plot_tim', 'data_leads.id_lead = plot_tim.id_lead');
        $this->db->join('tim_marketing', 'plot_tim.id_tim = tim_marketing.id_tim');
        $this->db->join('kontak_lead', 'data_leads.id_lead = kontak_lead.id_lead', 'left');
        $this->db->join('history_marketing', 'data_leads.id_lead = history_marketing.id_lead', 'left');
        $this->db->where('tim_marketing.id_pengguna', $id);
        $this->db->group_by('data_leads.id_lead, kontak_lead.id_kontak, status, jadwal, catatan');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getKontakLeadById($id){
        $this->db->select('*');
        $this->db->from('kontak_lead');
        $this->db->where('id_lead', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getHistoryMarketing($id){
        $this->db->select('*');
        $this->db->from('history_marketing');
        $this->db->where('id_lead', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}