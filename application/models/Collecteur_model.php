<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Collecteur_model extends CI_Model {
    function save ($nom,$contact, $adresse, $date, $genre) {
        $sql = "insert into Collecteur (nom , contact, adresse, dateDebuche, id_genre) values (?,?,?,?,?)"; 
        $this->db->query($sql, array($nom,$contact, $adresse, $date, $genre));
    }
    function find_all () {
        $query = $this->db->query('select * from Collecteur');
        return $query->result_array();
    }
}
