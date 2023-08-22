<?php

declare(strict_types=1);
namespace App\components;

/**
 * @author Agus Susilo <smartgdi@gmail.com>
 */
class UserCategory
{
    public const ADMIN = 1;
    public const SRV_PROVIDER = 2;
    public const ASSOCIATION = 3;
    public const SUPPLIER = 4;

    public static function getNonAdmin(): array
    {
        return [static::SRV_PROVIDER, static::ASSOCIATION, static::SUPPLIER];
    }
}
