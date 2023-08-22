<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reset_model extends CI_Model
{
    public function getResetKey($reset_key, $email)
    {
        $this->db->select('pengguna.email, pengguna.reset_key, pengguna.expire_key');
        $this->db->from('pengguna');
        $this->db->where('reset_key', $reset_key);
        $this->db->where('email', $email);
        $query = $this->db->get()->row_array();
        if (!empty($query)) {
            return $query;
        } else {
            return false;
        }
    }

    public function update_reset_key($email, $reset_key)
    {
        $this->db->where('email', $email);
        $this->db->where('is_active', 1);
        $data = ['reset_key' => $reset_key, 'expire_key' => 0];
        $this->db->update('pengguna', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function reset_password($reset_key, $password, $expire_key)
    {
        $this->db->where('reset_key', $reset_key);

        $data = ['password' => $password, 'expire_key' => $expire_key];
        $this->db->update('pengguna', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function check_reset_key($reset_key, $email)
    {
        $this->db->where('reset_key', $reset_key);
        $this->db->where('email', $email);
        $this->db->from('pengguna');
        return $this->db->count_all_results();
    }
}
