<?php
    class StockMatierePremier_Model extends CI_Model{
        public function __construct() {
            $this->load->database();
        }
    
        // utilisée dans Machine_Controller->index 
        public function get_all_stockmatierep() {
            $query = $this->db->get('stockmatierepremier');
            return $query->result_array();
        }
    
        public function delete_stockmatierep($id) {
            return $this->db->delete('stockmatierepremier', array('id_stockmatierepremier' => $id));
        }
    
        public function get_stockmatierep($id) {
            $query = $this->db->get_where('stockmatierepremier', array('id_stockmatierepremier' => $id));
            return $query->row_array();
        }
    
        public function update_stockmatierep($id, $data) {
            $this->db->where('id_stockmatierepremier', $id);
            return $this->db->update('stockmatierepremier', $data);
        }
    
        public function insert_stockmatierep($data) {
            return $this->db->insert('stockmatierepremier', $data);
        }

        public function get_stockmp_by_matierep($id_matiere) {
            $sql = "SELECT * FROM stockmatierepremier where matierepremier =" .$id_matiere;
            $query = $this->db->query($sql);
            return $query->result_array();
        }   

        public function get_stockmp_grby_matierep() {
            $sql = "SELECT * FROM stockmatierepremier group by matierepremier";
            $query = $this->db->query($sql);
            return $query->result_array();
        } 
    }
?>