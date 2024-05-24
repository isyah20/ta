<?php
namespace Library\Scrapping;

defined('BASEPATH') or exit('No direct script access allowed');

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class ExtractSession
{
    public function getSession($base_url)
    {
        $client = new \GuzzleHttp\Client([
            'verify' => false,
            'cookies' => true,
        ]);

        // $client->request('GET', $base_url . '/lelang');
        // print_r($base_url . '/lelang');
        // die();
        try {
            $client->request('GET', $base_url . '/lelang');
        } catch (BadResponseException $e) {
            return null;
        } catch (ConnectException $c) {
            return null;
        } catch (RequestException $c) {
            return null;
        }
        $cookieJar = $client->getConfig('cookies');
        $arr = $cookieJar->toArray();
        $extractCookie = $arr[1]['Value'];
        $cookie = (object) [
            'datatables_session' => $extractCookie,
            'datatables_token' => substr($extractCookie, 47, 40),
        ];

        return $cookie;
    }
}
