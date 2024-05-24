<?php

declare(strict_types=1);
defined('BASEPATH') or exit('No direct script access allowd');

/**
 * @author Agus Susilo
 */

class user_helper extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function hello()
    {
        echo 'hello world';
        exit();
    }
}
