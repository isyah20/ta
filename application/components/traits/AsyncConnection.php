<?php

declare(strict_types=1);
namespace App\components\traits;

use Amp\Mysql\{ConnectionConfig, Pool};

/**
 * AsyncConnection
 *
 * Trait untuk membantu mengekstrak informasi koneksi dan akun serta untuk
 * membuat async koneksi database.
 *
 * @author    Agus Susilo <smartgdi@gmail.com>
 */

trait AsyncConnection
{
    /**
     * Buat dan kembalian pool koneksi async dari objek $db
     */
    public static function getPool(): Pool
    {
        $host = $_SERVER['DB_HOST'];
        $username = $_SERVER['DB_USER'];
        $password = $_SERVER['DB_PASS'];
        $dbName = $_SERVER['DB_NAME'];
        $dbPort = $_SERVER['DB_PORT'] ?? 3306;

        $config = new ConnectionConfig($host, (int) $dbPort, $username, $password, $dbName);
        return \Amp\Mysql\pool($config);
    }
}
