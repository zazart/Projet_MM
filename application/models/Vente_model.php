<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vente_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_vente($data) {
        return $this->db->insert('vente', $data);
    }

    public function get_ventes() {
        return $this->db->get('vente')->result_array();
    }

    public function get_all() {
        $year = 3 - date('Y');
        $sql = "
        SELECT 
            vente.id_vente,
            SUM(vente.prixtotal) AS prixtotal,
            date_part('year', vente.date_vente) AS year_vente,
            date_part('month', vente.date_vente) AS month_vente,
            produit.id_produit,
            produit.nom_produit,
            coalesce(SUM(panier.quantite),0) AS quantite 
        FROM
            vente 
        JOIN 
            panier ON vente.id_commande=panier.id_commande 
        JOIN
            commande ON panier.id_commande = commande.id_commande  
        RIGHT JOIN
            produit ON panier.id_produit=produit.id_produit 
        WHERE 
            date_part('year', vente.date_vente) > $year 
        GROUP BY 
            vente.id_vente,date_part('year',vente.date_vente),date_part('month', vente.date_vente),produit.id_produit,produit.nom_produit 
        ORDER BY date_part('year', vente.date_vente) asc, date_part('month', vente.date_vente) asc
        ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_last_year() {
        $year = date('Y');
        $sql = "
        SELECT 
            vente.id_vente,
            SUM(vente.prixtotal) AS prixtotal,
            date_part('year', vente.date_vente) AS year_vente,
            date_part('month', vente.date_vente) AS month_vente,
            produit.id_produit,
            produit.nom_produit,
            coalesce(SUM(panier.quantite),0) AS quantite 
        FROM
            vente 
        JOIN 
            panier ON vente.id_commande=panier.id_commande 
        JOIN
            commande ON panier.id_commande = commande.id_commande  
        RIGHT JOIN
            produit ON panier.id_produit=produit.id_produit 
        WHERE 
            date_part('year', vente.date_vente) < $year 
        GROUP BY 
            vente.id_vente,date_part('year',vente.date_vente),date_part('month', vente.date_vente),produit.id_produit,produit.nom_produit
        ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
?>
