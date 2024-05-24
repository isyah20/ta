<?php

declare(strict_types=1);
namespace App\models\traits;

use Amp\Emitter;
use Amp\Mysql\Pool;

use function Amp\call;

trait Tender
{
    /**
     * Get daftar stat jumlah tender
     *
     * ```
     * $rows = yield $this->getListRecommendations($pool);
     * while (yield $rows->advance()) {
     *     // lakukan sesuatu dengan data $rows->getCurrent();
     * }
     * ```
     * @return Promise<Iterator>
     */
    public function getListStatByHps(Pool $pool, string $npwp, int $year, int $hpsStart = 0, int $hpsEnd = 0): \Amp\Promise
    {
        return call(function () use ($pool, $npwp, $year, $hpsStart, $hpsEnd) {
            $sql = 'SELECT SUBSTRING(paket.tanggal_pembuatan, 6, 2) AS MONTH, ';
            $sql .= '(SELECT COUNT(kode_tender) FROM `paket` WHERE `kode_tender` IN ';
            $sql .= '(SELECT `kode_tender` FROM `peserta_tender` WHERE `npwp` = :npwp) ';
            if ($hpsStart > 0 && $hpsEnd == 0) {
                $sql .= 'AND `nilai_hps_paket` < :hps_start AND YEAR(`tanggal_pembuatan`) = :created_year) AS count_tender ';
            } elseif ($hpsStart > 0 && $hpsEnd > 0) {
                $sql .= 'AND `nilai_hps_paket` >= :hps_start AND `nilai_hps_paket` >= :hps_end AND YEAR(`tanggal_pembuatan`) = :created_year) AS count_tender ';
            } elseif ($hpsStart == 0 && $hpsEnd > 0) {
                $sql .= 'AND `nilai_hps_paket` >= :hps_start AND YEAR(`tanggal_pembuatan`) = :created_year) AS count_tender ';
            }

            $sql .= 'FROM `peserta_tender` JOIN `paket` ON `paket`.`kode_tender` = `peserta_tender`.`kode_tender` WHERE `peserta_tender`.`npwp` = :npwp ';
            $sql .= 'AND YEAR(`tanggal_pembuatan`) = :created_year GROUP BY `paket`.`kode_tender`';
            $stmt = yield $pool->prepare($sql);
            $rows = yield $stmt->execute(['npwp' => $npwp, 'created_year' => $year, 'hps_start' => $hpsStart, 'hps_end' => $hpsEnd]);

            $emitter = new Emitter();
            while (yield $rows->advance()) {
                $emitter->emit($rows->getCurrent());
            }

            return $emitter->iterate();
        });
    }

    public function getPesertaTender(Pool $pool, string $npwp, int $lpseId, int $year = 0): \Amp\Promise
    {
        return call(function () use ($pool, $npwp, $lpseId, $year) {
            $sql = 'SELECT SUBSTRING(paket.tanggal_pembuatan, 6, 2) AS month, ';
            $sql .= 'SUBSTRING(paket.tanggal_pembuatan, 1, 4) AS year, COUNT(paket.kode_tender) AS count_tender ';
            $sql .= 'FROM peserta_tender LEFT JOIN paket ON paket.kode_tender = peserta_tender.kode_tender ';
            $sql .= 'WHERE peserta_tender.npwp = :npwp ';
            if ($year > 0) {
                $sql .= 'AND YEAR(`paket.tanggal_pembuatan`) = :created_year ';
            }
            $sql .= 'AND id_lpse = :lpse_id GROUP BY paket.kode_tender';
            $stmt = yield $pool->prepare($sql);
            $rows = yield $stmt->execute(['npwp' => $npwp, 'created_year' => $year, 'lpse_id' => $lpseId]);
            $emitter = new Emitter();
            while (yield $rows->advance()) {
                $emitter->emit($rows->getCurrent());
            }

            return $emitter->iterate();
        });
    }

    public function getCountTotal(int $lpseId = 0): int
    {
        $this->db->select('COUNT(kode_tender) AS total_tender');
        $this->db->from('paket');
        if ($lpseId > 0) {
            $this->db->where('id_lpse', $lpseId);
        }
        $query = $this->db->get();
        $row = $query->row();
        if ($row == null) {
            return 0;
        }
        return (int) $row->total_tender;
    }

    public function getCountByActive(int $lpseId = 0): int
    {
        // 2. Jumlah peserta tender
        $this->db->select("COUNT(peserta_tender.`kode_tender`) AS total_tender_active");
        $this->db->from("peserta_tender");
        $this->db->join("paket", "paket.`kode_tender` = peserta_tender.`kode_tender`");
        $this->db->where("peserta_tender.harga_penawaran != 0", null, false);
        $this->db->where("paket.status_tender NOT IN ('Tender Sudah Selesai','Selesai','Gagal', 'Seleksi Batal', 'Tender Gagal', 'Seleksi Gagal', 'Tender Batal')", null, false);
        if ($lpseId > 0) {
            $this->db->where('id_lpse', $lpseId);
        }
        $query = $this->db->get();
        $row = $query->row();
        if ($row == null) {
            return 0;
        }
        return (int) $row->total_tender_active;
    }

    public function getCountToday(int $lpseId = 0)
    {
        // 3. Jumlah tender by tanggal pembuatan
        $this->db->select('COUNT(kode_tender) AS total_tender');
        $this->db->from('paket');
        $this->db->where('tanggal_pembuatan = CURDATE()');
        if ($lpseId > 0) {
            $this->db->where('id_lpse', $lpseId);
        }
        $query = $this->db->get();
        $row = $query->row();
        if ($row == null) {
            return 0;
        }
        return (int) $row->total_tender;
    }

    // 1, 2, 3, 4, 7
    public function getCountByProcurementType(int $procType, int $lpseId = 0)
    {
        // 4. Jumlah jenis pengadaan 4
        $this->db->select("COUNT(jenis_pengadaan) AS total_tender");
        $this->db->from("paket");
        if ($procType > 0) {
            $this->db->where('jenis_pengadaan', sprintf('%d', $procType));
        }

        if ($lpseId > 0) {
            $this->db->where('id_lpse', $lpseId);
        }
        $query = $this->db->get();
        $row = $query->row();
        if ($row == null) {
            return 0;
        }
        return (int) $row->total_tender;
    }
}
