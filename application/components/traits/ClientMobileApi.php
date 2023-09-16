<?php

declare(strict_types=1);

namespace App\components\traits;

use GuzzleHttp\Client;

trait ClientMobileApi
{
    private $clientMobile = null;

    public function initMobile()
    {
        $baseUrl = isset($_SERVER['BASEURL_API']) && trim($_SERVER['BASEURL_API']) != '' ? $_SERVER['BASEURL_API'] : base_url();
        $this->clientMobile = new Client([
            'base_uri' => $baseUrl . 'api-mobile/',
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
    }
}
