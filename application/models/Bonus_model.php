<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Bonus_model extends CI_Model {

    function save ($id, $date, $amount) {

        //$query = $this->db->querry('insert into Bonus values (default,?,?,?)');
       


    }
    function findAll () {
        $query = $this->db->query('select * from Bonus');
        return $query->result_array();
    }


}

?>