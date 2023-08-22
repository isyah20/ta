<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Promo_model extends CI_Model
{
    // should add return
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function getData($data)
    {
        return $this->db
            ->from('promo')
            ->where('kode_promo', $data)
            ->get();
    }
}
