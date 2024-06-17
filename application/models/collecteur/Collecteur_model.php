<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Collecteur_model extends CI_Model {
    function save ($nom,$contact, $adresse, $date, $genre) {
        $sql = "insert into employe (nom , telephone, adresse, embauche, id_genre, id_poste) values (?,?,?,?,?,?)"; 
        $this->db->query($sql, array($nom,$contact, $adresse, $date, $genre, 7));
    }
    function find_all () {
        $query = $this->db->query('select  *, e.nom as noms from employe e join poste p on p.id_poste = e.id_poste  where p.nom = \'Collecteur\' ');
        return $query->result_array();
    }

    function update($id, $nom,$contact, $adresse, $date, $genre) {
        $sql = "update employe set nom = ? , telephone = ?, adresse = ?, embauche = ? , id_genre = ?  where id_employe = ? ";
        $this->db->query($sql, array($nom,$contact, $adresse, $date, $genre,$id ));
    }

    function find_by_id ($id) {
        $sql = 'select  *, e.nom as noms from employe e join poste p on p.id_poste = e.id_poste  where p.nom =\'Collecteur\' and e.id_employe = ? ';
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }


}
