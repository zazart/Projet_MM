<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Collect_model extends CI_Model {
    function save ( $date, $qtt, $matiere, $collecteur) {
        $sql = "insert into collects (datecollect, qtt, id_matierpremier, id_collecteur) values (?,?,?,?)"; 
        $this->db->query($sql, array($date, $qtt, $matiere, $collecteur));
    }
    function find_by_id ( $id) {
        $sql = 'select c.id_collects,  c.id_collects, c.datecollect as dates,c.qtt ,c.id_collecteur, e.nom as collecteur, c.id_matierpremier , mp.nom as matiere from collects c ';
        $sql .= ' join matierpremier mp on mp.id_matierpremier = c.id_matierpremier';
        $sql .= ' join employe e on c.id_collecteur = e.id_employe  where c.id_collects = ? ';
        $query = $this->db->query($sql, array( $id));
        return $query->row_array();
    }
    function find_all () {
        $sql = 'select c.id_collects,  c.id_collects, c.datecollect as dates,c.qtt ,c.id_collecteur, e.nom as collecteur, c.id_matierpremier , mp.nom as matiere from collects c ';
        $sql .= ' join matierpremier mp on mp.id_matierpremier = c.id_matierpremier';
        $sql .= ' join employe e on c.id_collecteur = e.id_employe order by c.datecollect desc';

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