<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Bonus_model extends CI_Model {
    function save ( $date, $amount) {
        $sql = "insert into Bonus (datedebut , amount) values (?,?)"; 
        $this->db->query($sql, array($date, $amount));
    }
    function find_all () {
        $query = $this->db->query('select * from Bonus');
        return $query->result_array();
    }


}

?>