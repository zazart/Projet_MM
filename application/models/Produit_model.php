<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit_Model extends CI_Model{
    public function __construct() {
        
    }

    // utilisée dans Machine_Controller->index 
    public function get_all_produit() {
        $query = $this->db->get('produit');
        return $query->result_array();
    }

    public function delete_produit($id) {
        return $this->db->delete('produit', array('id_produit' => $id));
    }

    public function get_produit($id) {
        $query = $this->db->get_where('produit', array('id_produit' => $id));
        return $query->row_array();
    }

    public function update_produit($id, $data) {
        $this->db->where('id_produit', $id);
        return $this->db->update('produit', $data);
    }

    public function insert_produit($data) {
        return $this->db->insert('produit', $data);
    }
}
?>
