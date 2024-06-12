<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panier_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_panier($data) {
        return $this->db->insert('panier', $data);
    }

    public function get_paniers() {
        return $this->db->get('panier')->result_array();
    }

    public function delete_panier($id) {
        $this->db->where('id', $id);
        return $this->db->delete('panier');
    }
}
?>
