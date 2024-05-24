<?php

declare(strict_types=1);
namespace App\models\traits;

use Amp\Emitter;

// use Amp\Mysql\Pool;

// use function Amp\call;

/**
 * Wilayah trait
 *
 * @author Agus Susilo <smartgdi@gmail.com>
 */
trait Wilayah
{
    public function getProvinces(): array
    {
        $query = $this->db->select('*')->from('wilayah AS w')
            ->where('w.`id_wilayah` >=', 1000)
            ->where('SUBSTR(CAST(w.`id_wilayah` AS CHAR), 3, 2) = "00"')
            ->order_by('w.id_wilayah ASC')
            ->get();
        return $query->result();
    }

    public function getCities(int $provinceId)
    {
        $provId = sprintf('%d', $provinceId);
        $head = substr($provId, 0, 2);
        $this->db->save_queries = false;
        $query = $this->db->select('*')->from('wilayah AS w')
            ->where('w.`id_wilayah` >=', 1000)
            ->where('SUBSTR(CAST(w.`id_wilayah` AS CHAR), 1, 2) =', $head)
            ->where('w.`id_wilayah` <>', $provinceId)
            ->order_by('w.wilayah ASC')
            ->get();
        return $query->result();
    }

    // public function getAsyncCities(Pool $pool, int $provinceId = 0): \Amp\Promise
    // {
    //     $provId = sprintf('%d', $provinceId);
    //     $head = substr($provId, 0, 2);
    //     return call(function () use ($pool, $provinceId, $head) {
    //         $sql = 'SELECT * FROM wilayah AS w WHERE w.id_wilayah >= 1000 AND ';
    //         $sql .= 'SUBSTR(CAST(w.`id_wilayah` AS CHAR), 1, 2) = :code AND w.`id_wilayah` <> :prov_id ORDER BY w.wilayah ASC';
    //         $stmt = yield $pool->prepare($sql);
    //         $rows = yield $stmt->execute(['code' => $head, 'prov_id' => $provinceId]);
    //
    //         $result = [];
    //         while (yield $rows->advance()) {
    //             $result[] = $rows->getCurrent();
    //         }
    //
    //         return $result;
    //     });
    // }
}
