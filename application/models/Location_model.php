<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends CI_Model {

    public function get_states()
    {
        return $this->db
            ->order_by('name','ASC')
            ->get('states')
            ->result();
    }

    public function get_cities_by_state($state_id)
    {
        return $this->db
            ->where('state_id', $state_id)
            ->order_by('name','ASC')
            ->get('cities')
            ->result();
    }
}
