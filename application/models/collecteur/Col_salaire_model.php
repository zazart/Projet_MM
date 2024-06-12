<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Col_salaire_model extends CI_Model {

    function save($date, $rix,$collecteur) {
        $query = 'insert into salaireCollecteur (dates, prix, id_collecteur) values (?,?,?) ';
        $this->db->query($query, array($date, $rix, $collecteur));
    }
    function find_all() {
        $sql = "select  sa.*, c.nom from salairecollecteur sa ";
        $sql .= "join Collecteur c on c.id_collecteur  = sa.id_collecteur;";
        $query =  $this->db->query($sql);
        return $query->result_array();
    }


}