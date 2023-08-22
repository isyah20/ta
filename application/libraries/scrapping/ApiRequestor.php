<?php
namespace Library\Scrapping;

defined('BASEPATH') or exit('No direct script access allowed');

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class ApiRequestor
{
    public static function get($url, $base_hostname, $params = [], $session = false)
    {
        // preg_match('/((https?|http))?/', $url, $split_url);
        // $method = $split_url[0] == 'https' ? 'POST' : 'GET';
        // return self::remoteCall($url, $base_hostname, $method, $params, $session);
        return self::remoteCall($url, $base_hostname, 'GET', $params, $session);
    }

    public static function remoteCall($url, $base_hostname, $method = 'GET', $params = [], $session = false)
    {
        // print_r($method);
        // die();
        $cookie = array_merge($session, []);
        $cookieJar = CookieJar::fromArray($cookie ? $cookie : [], $base_hostname);

        $client = new Client([
            'allow_redirects' => false,
            'verify' => false,
            'cookies' => $cookieJar,
        ]);

        try {
            $res = $client->request('GET', $url);
        } catch (ClientException $e) {
            $res = $client->request('POST', $url);
        } catch (BadResponseException $e) {
            return null;
        } catch (ConnectException $c) {
            return null;
        } catch (RequestException $c) {
            return null;
        }
        /* 	echo "<br />";
        highlight_string("<?php\n\$cookieJar =\n" . var_export((string) $res->getBody(), true) . ";\n?>");
        die(); */
        $contents = (string) $res->getBody();
        $contents = json_decode($contents);
        if ($contents->data == null) {
            return null;
        }

        // usort($contents->data, fn ($a, $b) => $a[0] <=> $b[0]);
        $keys = array_column($contents->data, 0);
        array_multisort($keys, SORT_DESC, $contents->data);

        return $contents;
    }
}
