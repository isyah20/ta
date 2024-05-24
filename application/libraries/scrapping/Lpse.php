<?php
namespace Library\Scrapping;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . "libraries/scrapping/Response.php";

class Lpse implements Response
{
    public function getJson($source)
    {
        header('Content-type: application/json');
        return json_encode($source);
    }

    public function getArray($source)
    {
        $array = (array) $source;
        return $array;
    }
}
