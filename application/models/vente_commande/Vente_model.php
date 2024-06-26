<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vente_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("transformation/stockproduit_model");
        $this->load->model("vente_commande/panier_model");
        $this->load->database();
    }

    public function insert_vente($data)
    {
        $commandes = $this->panier_model->get_panier_by_commande($data['id_commande']);
        foreach ($commandes as $commande) {
            $stock = array(
                'id_produit' => $commande['id_produit'],
                'quantiteentrant' => 0,
                'quantitesortant' => $commande['quantite'],
                'datestockproduit' => $data['date_vente']
            );
            $this->stockproduit_model->insert_stockproduit($stock);
        }
        return $this->db->insert('vente', $data);
    }

    public function get_vente_by_id($id)
    {
        return $this->db->get_where('vente', array('id_vente' => $id))->row_array();
    }

    public function delete_vente($id)
    {
        $this->db->where('id_vente', $id);
        return $this->db->delete('vente');
    }

    public function update_vente($id, $data)
    {
        $this->db->where('id_vente', $id);
        return $this->db->update('vente', $data);
    }

    public function get_ventes()
    {
        return $this->db->get('vente')->result_array();
    }

    public function get_all($debut = null, $fin = null)
    {
        $year = 3 - date('Y');
        $condition = "1 = 1 ";
        if (isset($debut) && !empty($debut)) {
            $condition .= " AND vente.date_vente > $debut";
        }
        if (isset($fin) && !empty($fin)) {
            $condition .= " AND vente.date_vente < $fin";
        }

        $sql = "
        SELECT 
            vente.id_vente,
            SUM(vente.prixtotal) AS prixtotal,
            date_part('year', vente.date_vente) AS year_vente,
            date_part('month', vente.date_vente) AS month_vente,
            produit.id_produit,
            produit.nom_produit,
            coalesce(SUM(panier.quantite), 0) AS quantite 
        FROM
            vente 
        JOIN 
            panier ON vente.id_commande=panier.id_commande 
        JOIN
            commande ON panier.id_commande = commande.id_commande  
        RIGHT JOIN
            produit ON panier.id_produit=produit.id_produit 
        WHERE 
            $condition 
        GROUP BY 
            vente.id_vente,date_part('year',vente.date_vente),date_part('month', vente.date_vente),produit.id_produit,produit.nom_produit 
        ORDER BY date_part('year', vente.date_vente) asc, date_part('month', vente.date_vente) asc
        ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_last_year()
    {
        $year = date('Y');
        $sql = "
        SELECT 
            vente.id_vente,
            SUM(vente.prixtotal) AS prixtotal,
            date_part('year', vente.date_vente) AS year_vente,
            date_part('month', vente.date_vente) AS month_vente,
            produit.id_produit,
            produit.nom_produit,
            coalesce(SUM(panier.quantite), 0) AS quantite 
        FROM
            vente 
        JOIN 
            panier ON vente.id_commande=panier.id_commande 
        JOIN
            commande ON panier.id_commande = commande.id_commande  
        JOIN
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
