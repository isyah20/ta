<?php

declare(strict_types=1);
namespace App\components;

/**
 * @author Agus Susilo <smartgdi@gmail.com>
 */
class CompanyType
{
    public const ENT_BUSINESS_CONSULTANT = 1;
    public const PERSONAL_CONSULTANT = 2;
    public const CONTRACTOR = 3;
    private static $listType = [
        1 => 'Konsultan Badan Usaha',
        2 => 'Konsultan Perorangan',
        3 => 'Kontraktor',
    ];

    public static function getListOfType(): array
    {
        return static::$listType;
    }

    public static function getById(int $id): string
    {
        if ($id >= 1 && $id <= 3) {
            return static::$listType[$id];
        }
        return '';
    }
}
