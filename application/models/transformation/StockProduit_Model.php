<?php
    class StockProduit_Model extends CI_Model{
        public function __construct() {
            $this->load->database();
        }
    
        // utilisée dans Machine_Controller->index 
        public function get_all_stockproduit() {
            $query = $this->db->get('stockproduit');
            return $query->result_array();
        }

        public function get_all_stockproduit2() {
            $sql = "
            SELECT sp.id_stockproduit ,p.nom_produit, sp.datestockproduit,
            sp.quantiteentrant, sp.quantitesortant 
            from stockproduit as sp join produit as p
            on sp.id_produit = p.id_produit";
            $query = $this->db->query($sql);

            return $query->result_array();
        }
    
        public function delete_stockproduit($id) {
            return $this->db->delete('stockproduit', array('id_stockproduit' => $id));
        }
    
        public function get_stockproduit($id) {
            $query = $this->db->get_where('stockproduit', array('id_stockproduit' => $id));
            return $query->row_array();
        }
    
        public function update_stockproduit($id, $data) {
            $this->db->where('id_stockproduit', $id);
            return $this->db->update('stockproduit', $data);
        }
    
        public function insert_stockproduit($data) {
            return $this->db->insert('stockproduit', $data);
        }

        public function get_stockproduit_actuel() {
            $sql ="
            SELECT 
                p.nom_produit,
                SUM(quantiteentrant - quantitesortant) AS stock_actuel,
                MAX(datestockproduit) AS datederniereproduction
            FROM 
                stockproduit as sp
            JOIN 
                produit as p
            ON sp.id_produit = p.id_produit
            GROUP BY 
                p.nom_produit";
            $query = $this->db->query($sql);

            return $query->result_array();
        }

        public function delete_stock_byproduit($id){
            return $this->db->delete('stockproduit', array('id_produit' => $id));
        }
    }
?>