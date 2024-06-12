<?php

// application/models/Genre_model.php
class Genre_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_genres($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('genre');
            return $query->result_array();
        }

        $query = $this->db->get_where('genre', array('id' => $id));
        return $query->row_array();
    }

    public function insert_genre($description) {
        $data = array(
            'description' => $description
        );

        return $this->db->insert('genre', $data);
    }

    public function update_genre($id, $description) {
        $data = array(
            'description' => $description
        );

        $this->db->where('id', $id);
        return $this->db->update('genre', $data);
    }

    public function delete_genre($id) {
        return $this->db->delete('genre', array('id' => $id));
    }
}


?>