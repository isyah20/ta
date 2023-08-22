<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowd');

/**
 * @author Agus Susilo
 */

class User
{
    public function getPhotoProfile(int $userId, $db): ?string
    {
        if ($userId < 1) {
            return null;
        }

        $row = $db->select('foto')->where('id_pengguna', $userId)->get('pengguna')->row();
        if ($row == null) {
            return null;
        }
        return $row->foto;
    }
}
