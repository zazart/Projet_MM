<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Collect_model extends CI_Model {
    function save ( $date, $qtt, $matiere, $collecteur) {
        $sql = "insert into collects (datecollect, qtt, id_matierpremier, id_collecteur) values (?,?,?,?)"; 
        $this->db->query($sql, array($date, $qtt, $matiere, $collecteur));
    }
    function find_all () {
        $query = 'select  c.id_collects, c.datecollect as dates,c.qtt ,c.id_collecteur, col.nom as collecteur,c.id_matierpremier as id_matiere , mp.nom as matiere from collects c';
        $query .= ' join matierpremier mp on mp.id_matierpremier = c.id_matierpremier';
        $query .= ' join collecteur col on c.id_collecteur = col.id_collecteur';

        $query = $this->db->query($query);
        return $query->result_array();
    }
    function update ($id,$date, $qtt, $matiere, $collecteur){
        $sql = "update collects set datecollect = ?, qtt = ?, id_matierpremier = ?, id_collecteur = ?  where id_collects = ?"; 
        $this->db->query($sql, array($date, $qtt, $matiere, $collecteur, $id));
    }


}

?>