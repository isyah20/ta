<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{
    // should add return
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function insert($data)
    {
        $this->db->insert('pembayaran', $data);
        $error = $this->db->error();
        return (int) $error['code'] == 0;
    }
}
