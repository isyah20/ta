<?php

declare(strict_types=1);

/**
 * @author Agus Susilo
 */

function getMode(): string
{
    return $_SERVER['ENVIRONMENT'];
}

function isDev(): bool
{
    return getMode() == 'dev';
}

function isDevProd(): bool
{
    return getMode() == 'dev-prod';
}

function isProduction(): bool
{
    return getMode() == 'production';
}

function isDebug(): bool
{
    return isset($_SERVER['DEBUG']) ? (bool) $_SERVER['DEBUG'] : false;
}

function isSkipWhatsapp(): bool
{
    return isset($_SERVER['SKIP_WHATSAPP']) ? (bool) $_SERVER['SKIP_WHATSAPP'] : false;
}

function getBaseUrl(): string
{
    return isset($_SERVER['BASEURL']) ? $_SERVER['BASEURL'] : 'https://tenderplus.id';
}
