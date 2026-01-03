<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dealer_model extends CI_Model {

    public function insert_dealer_details($data)
    {
        return $this->db->insert('dealer_details', $data);
    }

    public function get_by_user_id($user_id)
    {
        $this->db->select('
            u.id AS user_id,
            u.first_name,
            u.last_name,
            u.email,
            d.id AS dealer_id,
            d.zip,
            c.name AS city,
            s.name AS state,       
            c.id AS city_id,
            s.id AS state_id
        ');
        $this->db->from('users u');
        $this->db->join('dealer_details d', 'u.id = d.user_id', 'left');
        $this->db->join('states s', 'd.state_id = s.id', 'left');
        $this->db->join('cities c', 'd.city_id = c.id', 'left');
        $this->db->where('u.id', $user_id);

        return $this->db->get()->row();
    }


    public function update_dealer_details($user_id, $data)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->update('dealer_details', $data);
    }

    public function get_all_dealers($zip = null)
    {
        $this->db->select('
            u.id,
            u.first_name,
            u.last_name,
            u.email,
            c.name AS city,
            s.name AS state,
            d.zip
        ');
        $this->db->from('users u');
        $this->db->join('dealer_details d', 'u.id = d.user_id', 'left'); // LEFT JOIN
        $this->db->join('states s', 'd.state_id = s.id', 'left');        // LEFT JOIN
        $this->db->join('cities c', 'd.city_id = c.id', 'left');         // LEFT JOIN
        $this->db->where('u.role', 'dealer');

        if (!empty($zip)) {
            $this->db->where('d.zip', $zip);
        }

        return $this->db->get()->result();
    }

    private function _datatable_query($search = null, $zip = null)
    {
        $this->db->select('
            u.id,
            u.first_name,
            u.last_name,
            u.email,
            c.name AS city,
            s.name AS state,
            d.zip
        ');
        $this->db->from('users u');
        $this->db->join('dealer_details d', 'u.id = d.user_id', 'left');
        $this->db->join('states s', 'd.state_id = s.id', 'left');
        $this->db->join('cities c', 'd.city_id = c.id', 'left');
        $this->db->where('u.role', 'dealer');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('u.first_name', $search);
            $this->db->or_like('u.last_name', $search);
            $this->db->or_like('u.email', $search);
            $this->db->or_like('c.name', $search);
            $this->db->or_like('s.name', $search);
            $this->db->or_like('d.zip', $search);
            $this->db->group_end();
        }
    }

    public function get_datatable_dealers($start, $length, $search = null, $zip = null)
    {
        $this->_datatable_query($search, $zip);
        $this->db->limit($length, $start);
        return $this->db->get()->result();
    }

    public function count_all_dealers()
    {
        $this->db->from('users');
        $this->db->where('role', 'dealer');
        return $this->db->count_all_results();
    }

    public function count_filtered_dealers($search = null, $zip = null)
    {
        $this->_datatable_query($search, $zip);
        return $this->db->count_all_results();
    }


}
