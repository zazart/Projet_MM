<?php
    class Produit_Model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }
    
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
    
        public function get_produit_by_nom($nom) {
            $query = $this->db->get_where('produit', array('nom_produit' => $nom));
            return $query->row_array();
        }
    
        public function update_produit($id, $data) {
            $this->db->where('id_produit', $id);
            return $this->db->update('produit', $data);
        }
    
        public function insert_produit_simple($data) {
            return $this->db->insert('produit', $data);
        }
    
        public function nom_existe($nom_matierepremiere) {
            $suffixe = 'huile de ' . $nom_matierepremiere;
            $this->db->select('id_produit');
            $this->db->from('produit');
            $this->db->where('nom_produit', $suffixe);
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    
        public function insert_produit($data) {
            if (!$this->nom_existe($data['nom_produit'])) {
                $data['prix_unitaire'] = 0;
            }
            return $this->db->insert('produit', $data);
        }
    }
    
?>