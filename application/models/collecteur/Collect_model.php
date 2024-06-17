<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Collect_model extends CI_Model {
    function save ( $data) {
        return $this->db->insert('collects', $data);
    }
    function find_by_id ( $id) {
        $sql = 'select c.id_collects,  c.id_collects, c.datecollect as dates,c.qtt ,c.id_collecteur, e.nom as collecteur, c.id_matierpremier , mp.nom as matiere from collects c ';
        $sql .= ' join matierpremier mp on mp.id_matierpremier = c.id_matierpremier';
        $sql .= ' join employe e on c.id_collecteur = e.id_employe  where c.id_collects = ? ';
        $query = $this->db->query($sql, array( $id));
        return $query->row_array();
    }
    function find_all () {
        $sql = 'select c.id_collects,c.qtt, e.nom as collecteur, mp.nom as matiere from collects c ';
        $sql .= ' join matierpremier mp on mp.id_matierpremier = c.id_matierpremier';
        $sql .= ' join collecteur e on c.id_collecteur = e.id_collecteur';

        $query = $this->db->query($sql);
        return $query->result_array();
    }
    function update ($id,$date, $qtt, $matiere, $collecteur){
        $sql = "update collects set datecollect = ?, qtt = ?, id_matierpremier = ?, id_collecteur = ?  where id_collects = ?"; 
        $this->db->query($sql, array($date, $qtt, $matiere, $collecteur, $id));
    }
    
    function delete($id ){
        $sql = "delete from collects where id_collect= ?";
        $this->db->query($sql,array( $id));
    }


}

?>