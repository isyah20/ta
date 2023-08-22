<?php
namespace Library\Scrapping;

defined('BASEPATH') or exit('No direct script access allowed');

interface Response
{
    public function getJson($source);
    public function getArray($source);
}
