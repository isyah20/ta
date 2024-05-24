<?php

declare(strict_types=1);
namespace App\models\traits;

/**
 * Supplier trait
 *
 * @author Agus Susilo <smartgdi@gmail.com>
 */
trait Supplier
{
    public function sendTenderWinnerNotification()
    {
        $query = $this->db->select('email')->from('pengguna')->limit(5)->get();
        $rows = $query->result();
        foreach ($rows as $row) {
            echo $row->email, PHP_EOL;
        }
    }

    /**
     * Get daftar penerima notif pemenang tender terbaru.
     */
    public function getListTendeWinnerReceiver(): array
    {
        $sql = <<<SQL
            SELECT u.id_pengguna, u.nama, u.no_telp, u.email, u.status AS user_status FROM pengguna AS u,
            preferensi AS pr, pemenang AS p, paket AS pk  
            WHERE 
            u.id_pengguna = pr.id_pengguna AND 
            p.`kode_tender` = pk.`kode_tender` AND 
            p.`harga_kontrak` > 0 AND 
            pr.status='1' AND 
            (
            IF(pr.id_lpse='', pk.id_lpse <> '', pk.id_lpse REGEXP pr.id_lpse) AND 
            IF(pr.jenis_pengadaan='',pk.jenis_pengadaan<>'', pk.jenis_pengadaan REGEXP pr.jenis_pengadaan) AND 
            IF(pr.keyword='', pk.nama_tender <> '', pk.nama_tender REGEXP keyword) AND 
            IF(pr.nilai_hps_awal = 0 AND pr.nilai_hps_akhir = 0, pk.`nilai_hps_paket` <> '', pk.`nilai_hps_paket` BETWEEN pr.nilai_hps_awal AND pr.nilai_hps_akhir)
            ) 
            AND pk.tanggal_pembuatan >= CURDATE() 
            GROUP BY u.id_pengguna ORDER BY u.id_pengguna;
            SQL;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getListWinnerTender(int $userId = 0, int $limit = 0): array
    {
        if ($userId == 0) {
            return [];
        }

        $sql = <<<SQL
            SELECT u.nama, u.alamat FROM pengguna AS u, preferensi AS pr, paket AS pk, lpse AS lp 
            WHERE 
            u.id_pengguna = pr.id_pengguna AND 
            u.id_pengguna = ? AND 
            pk.id_lpse = lp.id_lpse AND 
            pr.status = '1' AND 
            (
                IF(pr.id_lpse = '', pk.id_lpse <> '', pk.id_lpse REGEXP pr.id_lpse) AND 
                IF(pr.jenis_pengadaan = '', pk.jenis_pengadaan <> '', pk.jenis_pengadaan REGEXP pr.jenis_pengadaan) AND 
                IF(pr.keyword = '', pk.nama_tender <> '', pk.nama_tender REGEXP pr.keyword) AND 
                IF(pr.nilai_hps_awal = 0 AND pr.nilai_hps_akhir = 0, pk.nilai_hps_paket <> '', pk.nilai_hps_paket BETWEEN pr.nilai_hps_awal AND pr.nilai_hps_akhir)
            )
            ORDER BY tender_terbaru.id_lpse, tender_terbaru.akhir_daftar
            SQL;
        if ($limit == 1) {
            $sql .= "LIMIT {$limit} ";
        }

        $query = $this->db->query($sql, [$userId]);
        return $query->result();
    }

    private function getUserPref(int $userId)
    {
        $query = $this->db->select('*')->from('preferensi')->where('id_pengguna', $userId)->get();
        return $query->result();
    }

    /**
     * List pemenang tender sesuai preferensi user
     */
    public function getWinnerTenderByFilters(
        int $userId = 0,
        int $pageSize = 20,
        int $pageNumber = 0,
        array $filters = [],
        array $orders = ['pk.tanggal_pembuatan DESC']
    ): array {
        if ($userId == 0) {
            return [];
        }

        $userPref = $this->getUserPref($userId);

        $this->db->select('pst.nama_peserta, pst.alamat')->from('pemenang AS p')
            ->join('paket AS pk', 'p.kode_tender = pk.kode_tender', 'left')
            ->join('peserta pst', 'p.npwp = pst.npwp', 'left')
            ->join('jadwal AS j', 'p.kode_tender = j.kode_tender', 'left')
            ->where('p.`harga_kontrak` >', 0)
            ->where('p.kode_tender = j.kode_tender')
            ->where('YEAR(pk.tanggal_pembuatan) >=', 2023);

        $cond = [];
        if (isset($filters['company_name']) && !empty($filters['company_name'])) {
            $cond['u.nama'] = $filters['company_name'];
        }

        if (isset($filters['tender_name']) && !empty($filters['tender_name'])) {
            $cond['pk.nama_tender'] = $filters['tender_name'];
        }

        if (isset($filters['procurement_type']) && !empty($filters['procurement_type'])) {
            $this->db->where_in('pk.jenis_pengadaan', join(',', $filters['procurement_type']));
        }

        if (isset($filters['lpse_id']) && !empty($filters['lpse_id'])) {
            $this->db->where('pk.id_lpse', $filters['lpse_id']);
        }

        $priceStart = $filters['contract_start'] ?? 0;
        $priceEnd = $filters['contract_end'] ?? 0;
        if ((float) $priceStart >= 0 && $priceEnd > 0 && $priceStart < $priceEnd) {
            $this->db->group_start()
                ->where('p.harga_kontrak >=', $priceStart)
                ->where('p.harga_kontrak <=', $priceEnd)
                ->group_end();
        }

        if (count($cond) > 0) {
            $this->db->like($cond);
        }

        $this->db->group_by('p.kode_tender');
        if (count($orders) > 0) {
            $this->db->order_by(join(', ', $orders));
        }

        $query = $this->db->limit($pageSize, $pageNumber)->get();
        return $query->result_array();
    }
}
