<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PaketPembelian_model extends CI_Model
{
    // should add retutn
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPaketPembelian()
    {
        $query = $this->db->get('paket_pembelian');
        return $query->result_array();
    }
}
