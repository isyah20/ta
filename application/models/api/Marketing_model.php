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

    public function getKatalogPemenangTerbaruByPengguna1($data)
    {
        $id_pengguna = $data['id_pengguna'];
        $page_size = $data['pageSize'];
        $page_number = ($data['pageNumber'] - 1) * $page_size;

        $kriteria = $order = '';
        $keyword = $data['keyword'];
        if ($keyword != '') $kriteria .= " AND (nama_tender LIKE '%{$keyword}%' OR nama_pemenang LIKE '%{$keyword}%')";

        $sort = $data['sort'];
        if ($sort == '1') $order = "harga_penawaran ASC";
        else if ($sort == '2') $order = "harga_penawaran DESC";
        else if ($sort == '3') $order = "tgl_pemenang DESC";
        else if ($sort == '4') $order = "tgl_pemenang ASC";

        $sql = "SELECT kode_tender,nama_pemenang,nama_tender,jenis_tender.jenis_tender,ROUND(harga_penawaran,0) AS harga_penawaran,nama_lpse,'' AS foto,url,'' AS link_sumber,COALESCE(DATEDIFF(CURRENT_DATE,tgl_pemenang),0) AS update_hari
                FROM preferensi,pemenang
                INNER JOIN lpse ON pemenang.id_lpse=lpse.id_lpse
                INNER JOIN jenis_tender ON pemenang.jenis_tender=jenis_tender.id_jenis
                LEFT JOIN wilayah ON CONCAT(REPLACE(REPLACE(TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 2), '(', -1)),')',''),'.',''),' ',TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(lokasi_pekerjaan, ' - ', 3), ' - ', -1), '(', 1), '(', -1)))=wilayah
                WHERE id_pengguna={$id_pengguna} AND DATEDIFF(CURRENT_DATE,tgl_pemenang) <= {$this->interval_pemenang} AND preferensi.status='1' AND (IF(preferensi.id_lpse='',pemenang.id_lpse<>'',pemenang.id_lpse IN ({$preferensi->id_lpse})) AND IF(preferensi.jenis_pengadaan='',pemenang.jenis_tender<>'',pemenang.jenis_tender IN ({$preferensi->jenis_pengadaan})) AND IF(keyword='',nama_tender<>'',nama_tender REGEXP keyword) AND IF(nilai_hps_awal=0 AND nilai_hps_akhir=0,harga_penawaran<>'',harga_penawaran BETWEEN nilai_hps_awal AND nilai_hps_akhir)) {$kriteria}
                GROUP BY kode_tender,npwp
                ORDER BY {$order}
                LIMIT {$page_number},{$page_size}";
                
                return $this->db->query($sql);
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