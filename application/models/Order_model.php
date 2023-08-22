<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    /**
     * @return array int `code`, string `message`
     */
    public function insert($data)
    {
        $this->db->insert('order', $data);
        return $this->db->error();
    }

    /**
     * @return array int `code`, string `message`
     */
    public function insert_detail($data)
    {
        $this->db->insert_batch('order_detail', $data);
        return $this->db->error();
    }

    public function find($id)
    {
        return $this->db
            ->select('order.*, pengguna.nama, pengguna.email')
            ->join('pengguna', 'pengguna.id_pengguna = order.id_pengguna')
            ->where('id_order', $id)
            ->get('order');
    }
}
