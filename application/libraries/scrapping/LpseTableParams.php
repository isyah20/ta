<?php
namespace Library\Scrapping;

defined('BASEPATH') or exit('No direct script access allowed');

use Exception;

class LpseTableParams
{
    public $customParams;

    public function setCustomParams($param)
    {
        $this->customParams = $param;
    }

    public function getParamsTable()
    {
        $paramsTable = [
            'columns[0][data]' => 0,
            'columns[0][name]' => '',
            'columns[0][searchable]' => true,
            'columns[0][orderable]' => true,
            'columns[0][search][value]' => '',
            'columns[0][search][regex]' => false,
            'columns[1][data]' => 1,
            'columns[1][name]' => '',
            'columns[1][searchable]' => true,
            'columns[1][orderable]' => true,
            'columns[1][search][value]' => '',
            'columns[1][search][regex]' => false,
            'columns[2][data]' => 2,
            'columns[2][name]' => '',
            'columns[2][searchable]' => true,
            'columns[2][orderable]' => true,
            'columns[2][search][value]' => '',
            'columns[2][search][regex]' => false,
            'columns[3][data]' => 3,
            'columns[3][name]' => '',
            'columns[3][searchable]' => false,
            'columns[3][orderable]' => false,
            'columns[3][search][value]' => '',
            'columns[3][search][regex]' => false,
            'columns[4][data]' => 4,
            'columns[4][name]' => '',
            'columns[4][searchable]' => true,
            'columns[4][orderable]' => true,
            'columns[4][search][value]' => '',
            'columns[4][search][regex]' => false,
            'order[0][column]' => 0,
            'order[0][dir]' => 'desc',
            'search[regex]' => false,
        ];

        $paramsTable = array_merge($paramsTable, $this->customParams);

        return $paramsTable;
    }
}
