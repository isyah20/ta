<?php

declare(strict_types=1);

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;
use App\models\traits\Tender;

class ApiTenderSupplier extends RestController
{
    use Tender;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Tender_model');
    }

    public function totalTender_get()
    {
        $lpseId = $this->get('lpse_id', true);
        if ($lpseId == null) {
            $lpseId = 0;
        }
        $res = $this->getCountTotal((int) $lpseId);
        $this->response(['total' => (int) $res], RestController::HTTP_OK);
    }

    public function totalTenderActive_get()
    {
        $lpseId = $this->get('lpse_id', true);
        if ($lpseId == null) {
            $lpseId = 0;
        }
        $res = $this->getCountByActive((int) $lpseId);
        $this->response(['total' => (int) $res], RestController::HTTP_OK);
    }

    public function totalTenderToday_get()
    {
        $lpseId = $this->get('lpse_id', true);
        if ($lpseId == null) {
            $lpseId = 0;
        }
        $res = $this->getCountToday((int) $lpseId);
        $this->response(['total' => (int) $res], RestController::HTTP_OK);
    }

    public function totalTenderByProcurementType_get()
    {
        $lpseId = $this->get('lpse_id', true);
        $procType = $this->get('procurement_type', true);
        if ($lpseId == null) {
            $lpseId = 0;
        }

        if ($procType == null) {
            $procType = 0;
        }
        $res = $this->getCountByProcurementType((int) $procType, (int) $lpseId);
        $this->response(['total' => $res], RestController::HTTP_OK);
    }

    // Get daftar pemenang tender sesuai preferensi pengguna dan filter pengguna
    public function getWinnerTenderByFilters_post(int $userId)
    {
        $data = json_decode($this->input->raw_input_stream, true);
        $pageSize = $_GET['per_page'] ?? 10;
        $pageNumber = $_GET['page'] ?? 0;
        $totalItem = $this->getWinnerTenderByFilters($userId, (int) $pageSize, (int) $pageNumber, $data, true);
        if (count($totalItem) > 0) {
            $totalItem = $totalItem[0]['total'];
        }
        $result = $this->getWinnerTenderByFilters($userId, (int) $pageSize, (int) $pageNumber, $data);
        $this->response(['items' => $result, 'total_items' => $totalItem], RestController::HTTP_OK);
    }

    private function getUserPref(int $userId)
    {
        $query = $this->db->select('*')->from('preferensi')->where('id_pengguna', $userId)->get();
        return $query->result();
    }

    /**
     * List pemenang tender sesuai preferensi user
     */
    private function getWinnerTenderByFilters(
        int $userId = 0,
        int $pageSize = 20,
        int $pageNumber = 0,
        array $filters = [],
        bool $returnCount = false,
        array $orders = ['pk.tanggal_pembuatan DESC']
    ): array {
        if ($userId == 0) {
            return [];
        }

        $offset = $pageSize < 1 ? 0 : ($pageNumber - 1) * $pageSize;
        $userPref = $this->getUserPref($userId);
        if ($returnCount) {
            $this->db->select('COUNT(p.id_pemenang) AS total');
        } else {
            $this->db->select('pst.nama_peserta, pst.alamat, p.kode_tender, p.harga_kontrak, p.id_pemenang, pk.nama_tender, DATEDIFF(CURRENT_DATE, j.tgl_akhir) AS last_update, lp.nama_lpse, lp.url');
        }

        $this->db->from('pemenang AS p')
            ->join('paket AS pk', 'p.kode_tender = pk.kode_tender', 'left')
            ->join('lpse AS lp', 'pk.id_lpse = lp.id_lpse', 'left')
            ->join('peserta pst', 'p.npwp = pst.npwp', 'left')
            ->join('jadwal AS j', 'p.kode_tender = j.kode_tender', 'left')
            ->where('p.`harga_kontrak` >', 0)
            ->where('p.kode_tender = j.kode_tender')
            ->where('YEAR(pk.tanggal_pembuatan) >=', 2023);

        $cond = [];
        if (isset($filters['company_name']) && !empty($filters['company_name'])) {
            $cond['pst.nama_peserta'] = $filters['company_name'];
        }

        if (isset($filters['tender_name']) && !empty($filters['tender_name'])) {
            $cond['pk.nama_tender'] = $filters['tender_name'];
        }

        if (isset($filters['procurement_type']) && !empty($filters['procurement_type'])) {
            $this->db->where_in('pk.jenis_pengadaan', join(',', $filters['procurement_type']));
        }

        $priceStart = $filters['contract_start'] ?? 0;
        $priceEnd = $filters['contract_end'] ?? 0;
        if ((float) $priceStart >= 0 && $priceEnd > 0 && $priceStart < $priceEnd) {
            $this->db->group_start()
                ->where('p.harga_kontrak >=', $priceStart)
                ->where('p.harga_kontrak <=', $priceEnd)
                ->group_end();
        }

        $contractDateStart = $filters['contract_date_start'] ?? 0;
        $contractDateEnd = $filters['contract_date_end'] ?? 0;
        if ($contractDateStart < $contractDateEnd) {
            $this->db->group_start()
                ->where('DATE(j.tgl_akhir) >=', $contractDateStart)
                ->where('DATE(j.tgl_akhir) <=', $contractDateEnd)
                ->group_end();
        }

        if (count($cond) > 0) {
            $this->db->like($cond);
        }

        $keywords = [];
        if (!empty($userPref->keyword) && strpos($userPref->keyword, '|') !== false) {
            $keywords = explode('|', $userPref->keyword);
        } elseif (!empty($userPref->keyword) && strpos($userPref->keyword, '|') === false) {
            $keywords = [$userPref->keyword];
        }

        if ($keywords) {
            $this->db->like('pk.nama_tender', $keywords);
        }

        $lpseId = [];
        if (!empty($userPref->id_lpse) && strpos($userPref->id_lpse, '|') !== false) {
            $lpseId = explode('|', $userPref->id_lpse);
        } elseif (!empty($userPref->id_lpse) && strpos($userPref->id_lpse, '|') === false) {
            $lpseId = [$userPref->id_lpse];
        }

        if ($lpseId) {
            $this->db->where_in('pk.id_lpse', $lpseId);
        }

        $procType = [];
        if (!empty($userPref->jenis_pengadaan) && strpos($userPref->jenis_pengadaan, ',') !== false) {
            $procType = explode(',', $userPref->jenis_pengadaan);
        } elseif (!empty($userPref->jenis_pengadaan) && strpos($userPref->jenis_pengadaan, ',') === false) {
            $procType = [$userPref->jenis_pengadaan];
        }

        if ($procType) {
            $this->db->where_in('pk.jenis_pengadaan', $procType);
        }

        $hpsStart = !empty($userPref->nilai_hps_awal) ? $userPref->nilai_hps_awal : 0;
        $hpsEnd = !empty($userPref->nilai_hps_akhir) ? $userPref->nilai_hps_akhir : 0;
        if ((float) $hpsStart >= 0 && $hpsEnd > 0 && $hpsStart < $hpsEnd) {
            $this->db->group_start()
                ->where('pk.nilai_hps_paket >=', $hpsStart)
                ->where('pk.nilai_hps_paket <=', $hpsEnd)
                ->group_end();
        }

        $this->db->group_by('p.kode_tender');
        if (count($orders) > 0) {
            $this->db->order_by(join(', ', $orders));
        }

        if (!$returnCount) {
            $this->db->limit($pageSize, $offset);
        }

        if ($returnCount) {
            $subQuery = $this->db->get_compiled_select();
            $query = $this->db->select('COUNT(*) AS total')->from(sprintf('(%s) AS squery', $subQuery));
            return $query->get()->result_array();
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    // Kirim notifikasi pemenang tender
    public function sendNotifWinnerTender()
    {

    }
}
