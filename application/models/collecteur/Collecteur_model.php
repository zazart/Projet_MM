<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Collecteur_model extends CI_Model {
    function save($data) {
        return $this->db->insert('collecteur', $data);
    }
    function find_all () {
        return $this->db->get('collecteur')->result_array();
    }

    function update($id, $data) {
        $this->db->where('id_collecteur', $id);
        return $this->db->update('collecteur', $data);
    }

    function find_by_id ($id) {
        return $this->db->get_where('collecteur', array('id_collecteur' => $id))->row_array();
    }


}
