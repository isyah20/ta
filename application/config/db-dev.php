<?php

defined('BASEPATH') or exit('No direct script access allowed');

return [
    'dsn' => '',
    'hostname' => $_SERVER['DB_HOST'],
    'username' => $_SERVER['DB_USER'],
    'password' => $_SERVER['DB_PASS'],
    'database' => $_SERVER['DB_NAME'],
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => false,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => false,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => false,
    'compress' => false,
    'stricton' => false,
    'failover' => [],
    'save_queries' => true,
];
