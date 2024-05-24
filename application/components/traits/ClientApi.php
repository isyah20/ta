<?php

declare(strict_types=1);
namespace App\components\traits;

use GuzzleHttp\Client;

trait ClientApi
{
    private $client = null;

    public function init()
    {
        $baseUrl = isset($_SERVER['BASEURL_API']) && trim($_SERVER['BASEURL_API']) != '' ? $_SERVER['BASEURL_API'] : base_url();
        $this->client = new Client([
            'base_uri' => $baseUrl . 'api/',
            'headers' => [
                'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
            ],
        ]);
    }
}
