<?php
namespace Library\Scrapping;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/scrapping/Lpse.php";
require APPPATH . "libraries/scrapping/ExtractSession.php";
require APPPATH . "libraries/scrapping/LpseTableParams.php";
require APPPATH . "libraries/scrapping/ApiRequestor.php";

class LpseTable extends Lpse
{
    public static function getTable($url_param, $params = [])
    {
        $base_hostname = preg_replace('/http:\/\/|https:\/\/|\/eproc4/', "", $url_param);
        $session = new ExtractSession();
        // print_r($base_hostname);
        // die();
        // if ($session == null) {
        // 	return null;
        // }
        $getSession = $session->getSession($url_param);
        if ($getSession != null && $getSession->datatables_token != null) {
            $param = new LpseTableParams();
            $param->setCustomParams(
                array_merge($params, ['authenticityToken' => $getSession->datatables_token])
            );
            $params = $param->getParamsTable();

            $paramGet = "";
            foreach ($params as $key => $value) {
                $paramGet .= "&" . $key . "=" . $value;
            }

            $url = $url_param . '/dt/lelang?draw=0&' . $paramGet;

            return ApiRequestor::get(
                $url,
                $base_hostname,
                $params,
                ['SPSE_SESSION' => $getSession->datatables_session]
            );
        } else {
            return null;
        }
    }
}
