<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hasil_model');
    }

}
