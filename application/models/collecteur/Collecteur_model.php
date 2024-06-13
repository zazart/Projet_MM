<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Collecteur_model extends CI_Model {
    function save ($nom,$contact, $adresse, $date, $genre) {
        $sql = "insert into employe (nom , telephone, adresse, embauche, id_genre, id_poste) values (?,?,?,?,?,?)"; 
        $this->db->query($sql, array($nom,$contact, $adresse, $date, $genre, 7));
    }
    function find_all () {
        $query = $this->db->query('select  * from employe where id_poste = 7');
        return $query->result_array();
    }
}
