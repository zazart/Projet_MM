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
}
