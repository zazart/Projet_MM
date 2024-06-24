<?php defined('BASEPATH') or exit('No direct script access allowed');

class Collecteur_model extends CI_Model
{
    function save($data)
    {
        $query = 'INSERT INTO employe (embauche, nom, email, telephone, adresse, id_genre, id_poste) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $this->db->query($query, array_values($data));
        return $this->db->affected_rows() > 0;
    }

    function get_collecteur()
    {
        $query = '	select e.id_employe,e.nom,g.description,e.email,e.telephone,e.adresse from employe as e join genre as g on e.id_genre = g.id_genre where e.id_poste=7';
        $result = $this->db->query($query);
        return $result->result_array();
    }


    function find_by_id($id)
    {
        return $this->db->get_where('employe', array('id_employe' => $id))->row_array();
    }

    public function update_collecteur($id, $data)
    {
        $this->db->where('id_employe', $id);
        return $this->db->update('employe', $data);
    }

    public function delete_collecteur($id)
    {
        $this->db->where('id_employe', $id);
        return $this->db->delete('employe');
    }
}
