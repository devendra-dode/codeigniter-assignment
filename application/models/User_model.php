<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function insert_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function email_exists($email)
    {
        return $this->db
            ->where('email', $email)
            ->count_all_results('users') > 0;
    }

    // 🔹 LOGIN HELPERS
    public function get_user_by_email($email)
    {
        return $this->db
            ->where('email', $email)
            ->get('users')
            ->row();
    }
}
