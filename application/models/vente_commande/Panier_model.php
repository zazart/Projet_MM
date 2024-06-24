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

    public function get_somme_prix($id_commande) {
        $paniers = $this->get_by_commande($id_commande);
        $somme = 0;
        foreach ($paniers as $panier) {
            $somme += $panier['quantite'] * $panier["prix_unitaire"];
        }
        return $somme;
    }

    public function get_by_commande($id_commande) {
        $this->db->select("panier.*, produit.nom_produit, produit.prix_unitaire");
        $this->db->from("panier");
        $this->db->join("produit", "panier.id_produit = produit.id_produit");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_panier($id) {
        $this->db->where('id_panier', $id);
        return $this->db->delete('panier');
    }
}
?>