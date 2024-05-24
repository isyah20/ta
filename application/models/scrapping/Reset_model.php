<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reset_model extends CI_Model
{
    public function getResetKey($reset_key)
    {
        // $pengguna = $this->db->get('pengguna');
        // return $pengguna;

        // $query = $this->db->get('pengguna');
        // $query = $this->db->get_where('pengguna', 'reset_key');
        // return $query->result_array();

        return $this->db->get_where('pengguna', ['reset_key' => $reset_key])->row_array();
    }

    public function update_reset_key($email, $reset_key)
    {
        $this->db->where('email', $email);

        $data = ['reset_key' => $reset_key];
        $this->db->update('pengguna', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function reset_password($reset_key, $password)
    {
        $this->db->where('reset_key', $reset_key);

        $data = ['password' => $password];
        $this->db->update('pengguna', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function check_reset_key($reset_key)
    {
        $this->db->where('reset_key', $reset_key);
        $this->db->from('pengguna');
        return $this->db->count_all_results();
    }
}
