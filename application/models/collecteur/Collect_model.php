<?php defined('BASEPATH') or exit('No direct script access allowed');

class Collect_model extends CI_Model
{
    function save($data)
    {
        return $this->db->insert('collects', $data);
    }

    function get_collect()
    {
        $query = 'select c.id_collects, c.datecollect, c.qtt, e.nom as nomCollecteur, mp.nom from collects c join matierepremier mp on mp.id_matierepremier = c.id_matierepremier join employe e on c.id_employe = e.id_employe';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    function find_by_id($id)
    {
        return $this->db->get_where('collects', array('id_collects' => $id))->row_array();
    }

    function delete_collect($id)
    {
        $this->db->where('id_collects', $id);
        return $this->db->delete('collects');
    }

    public function update_collect($id, $data)
    {
        $this->db->where('id_collects', $id);
        return $this->db->update('collects', $data);
    }

    function get_matiere_premiere()
    {
        $query = 'select * from matierepremier';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function search_collects($criteria = array()) {
        $this->db->select('collects.*, employe.nom as nom_employe, matierepremier.nom as nom_matierepremier');
        $this->db->from('collects');
        $this->db->join('employe', 'collects.id_employe = employe.id_employe');
        $this->db->join('matierepremier', 'matierepremier.id_matierepremier = collects.id_matierepremier');

        if (!empty($criteria['id_employe'])) {
            $this->db->where('collects.id_employe', $criteria['id_employe']);
        }
    
        if (!empty($criteria['date_start'])) {
            $this->db->where('collects.datecollect >=', $criteria['date_start']);
        }
        if (!empty($criteria['date_end'])) {
            $this->db->where('collects.datecollect <=', $criteria['date_end']);
        }
    
        if (!empty($criteria['Id_MatierePremier'])) {
            $this->db->where('collects.Id_MatierePremier', $criteria['Id_MatierePremier']);
        }
    
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
