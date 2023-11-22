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
    
    public function getLeadsByTim($id_pengguna, $page_size, $page_number) {
        $this->db->select('data_leads.*, kontak_lead.nama, kontak_lead.posisi, kontak_lead.no_telp, kontak_lead.email, plot_tim.status, plot_tim.jadwal, plot_tim.catatan');
        $this->db->select('COUNT(history_marketing.id_lead) AS jumlah_history');
        $this->db->from('data_leads');
        $this->db->join('plot_tim', 'data_leads.id_lead = plot_tim.id_lead');
        $this->db->join('tim_marketing', 'plot_tim.id_tim = tim_marketing.id_tim');
        $this->db->join('kontak_lead', 'data_leads.id_lead = kontak_lead.id_lead', 'left');
        $this->db->join('history_marketing', 'data_leads.id_lead = history_marketing.id_lead', 'left');
        $this->db->where('tim_marketing.id_pengguna', $id_pengguna);
        $this->db->group_by('data_leads.id_lead, kontak_lead.id_kontak, plot_tim.status, plot_tim.jadwal, plot_tim.catatan');
        $this->db->limit($page_size, $page_number);
    
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function getTotalLeadsByTim($id)
    {
        $this->db->select('COUNT(pt.id_lead) AS total');
        $this->db->from('plot_tim pt');
        $this->db->join('tim_marketing tm', 'pt.id_tim = tm.id_tim');
        $this->db->where('tm.id_pengguna', $id);
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function getLeadsByTimFiltered($id_pengguna, $nama_perusahaan, $status)
    {
        $this->db->select('data_leads.*,  kontak_lead.nama, kontak_lead.posisi, kontak_lead.no_telp, kontak_lead.email, plot_tim.status, plot_tim.jadwal, plot_tim.catatan');
        $this->db->select('COUNT(history_marketing.id_lead) AS jumlah_history');
        $this->db->from('data_leads');
        $this->db->join('plot_tim', 'data_leads.id_lead = plot_tim.id_lead');
        $this->db->join('tim_marketing', 'plot_tim.id_tim = tim_marketing.id_tim');
        $this->db->join('kontak_lead', 'data_leads.id_lead = kontak_lead.id_lead', 'left');
        $this->db->join('history_marketing', 'data_leads.id_lead = history_marketing.id_lead', 'left');
        $this->db->where('tim_marketing.id_pengguna', $id_pengguna);
        $this->db->group_by('data_leads.id_lead, kontak_lead.id_kontak, status, jadwal, catatan');

        if (!empty($nama_perusahaan)) {
            $this->db->where('LOWER(data_leads.nama_perusahaan) LIKE', 'LOWER(\'%' . $this->db->escape_like_str($nama_perusahaan) . '%\')', false);
            //$this->db->like('data_leads.nama_perusahaan', $nama_perusahaan);
        }
        if (!empty($status)) {
            $this->db->like('plot_tim.status', $status);
        }
        
        $query = $this->db->get();

        return $query->result();
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
        $this->db->order_by('id_history', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTotalPlotEachTim($id_supplier) {
        $this->db->select('pm.nama AS nama, pm.alamat AS alamat, COUNT(pt.id_tim) AS jumlah_plot');
        $this->db->from('tim_marketing tm');
        $this->db->join('pengguna pm', 'tm.id_pengguna = pm.id_pengguna');
        $this->db->join('plot_tim pt', 'tm.id_tim = pt.id_tim', 'left');
        $this->db->where('tm.id_supplier', $id_supplier);
        $this->db->group_by('tm.id_tim');

        $query = $this->db->get();
        return $query->result();
    }
    
    public function getTotalStatusPlotTim($id_supplier) {
        $this->db->select('dl.id_pengguna, pt.status, COUNT(*) as jumlah_status');
        $this->db->from('plot_tim pt');
        $this->db->join('data_leads dl', 'pt.id_lead = dl.id_lead');
        $this->db->where('dl.id_pengguna', $id_supplier);
        $this->db->group_by('pt.status');

        $query = $this->db->get();
        return $query->result();
    }
}