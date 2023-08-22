<?php

declare(strict_types=1);

namespace App\components\traits;

use App\components\UserType;

/**
 * User
 *
 * @author    Agus Susilo <smartgdi@gmail.com>
 */

trait User
{
    // Cek apakah profile sudah lengkap atau belum. syarat lengkap yaitu nama, jenis_perusahaan dan no_telp harus isi.
    public function isProfileComplete(int $userId = 0): bool
    {
        $query = $this->db->select('nama, jenis_perusahaan, no_telp, kategori')->from('pengguna')->where('id_pengguna', $userId)->get();
        $row = $query->row();
        if ($row == null) {
            return false;
        }

        if (trim($row->nama) == '' || $row->jenis_perusahaan == null || $row->jenis_perusahaan == 0 || $row->no_telp == '' || $row->no_telp == null) {
            return false;
        }

        if ($row->kategori == 4 && (trim($row->nama) == '' || $row->no_telp == '' || $row->no_telp == null)) {
            return false;
        }
        return true;
    }

    public function getUserDuration(int $userId): int
    {
        $query = $this->db->select('tgl_notifikasi')->from('notifikasi_tender')->where('id_pengguna', $userId)
            ->order_by('tgl_notifikasi ASC')->limit(1)->get();
        $row = $query->row();
        if ($row == null) {
            return 7;
        }

        $notifDate = new \DateTimeImmutable($row->tgl_notifikasi);
        $now = new \DateTimeImmutable('now');
        $interval = $notifDate->diff($now);
        $duration = (int) $interval->d;
        return $duration > 7 ? 0 : $duration;
    }

    public function getOldPhoto(int $userId): ?string
    {
        $query = $this->db->select('foto')->from('pengguna')->where('id_pengguna', $userId)->limit(1)->get();
        $row = $query->row();
        if ($row == null) {
            return '';
        }
        return $row->foto;
    }

    public function getUserType(int $userId): int
    {
        $query = $this->db->select('status')->from('pengguna')->where('id_pengguna', $userId)->get();
        $row = $query->row();
        if ($row == null) {
            return UserType::FREE;
        }

        return (int) $row->status;
    }
}
