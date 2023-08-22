<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new Client([
    'base_uri' => $_SERVER['BASEURL'],
    'headers' => [
        'auth' => ['beetend', '76oZ8XuILKys5', 'Basic'],
    ],
]);

try {
    $resp = $client->request('GET', '/api/order/check-duedate', [
        'auth' => $client->getConfig('headers')['auth'],
    ]);
    echo 'Status Code: ', $resp->getStatusCode(), PHP_EOL;
    echo 'Body: ', $resp->getBody()->getContents(), PHP_EOL;
} catch (\Exception $ex) {
    echo $ex->getMessage(), PHP_EOL;
}
