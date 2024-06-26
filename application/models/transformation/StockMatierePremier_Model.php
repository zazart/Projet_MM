<?php
    class StockMatierePremier_Model extends CI_Model{
        public function __construct() {
            $this->load->database();
        }
    
        // utilisée dans Machine_Controller->index 
        public function get_all_stockmatierep() {
            $query = $this->db->get('stockmatierpremier');
            return $query->result_array();
        }
    
        public function delete_stockmatierep($id) {
            return $this->db->delete('stockmatierpremier', array('id_stockmatierpremier' => $id));
        }
    
        public function get_stockmatierep($id) {
            $query = $this->db->get_where('stockmatierpremier', array('id_stockmatierpremier' => $id));
            return $query->row_array();
        }
    
        public function update_stockmatierep($id, $data) {
            $this->db->where('id_stockmatierpremier', $id);
            return $this->db->update('stockmatierpremier', $data);
        }
    
        public function insert_stockmatierep($data) {
            return $this->db->insert('stockmatierpremier', $data);
        }

        public function get_stockmp_by_matierep($id_matiere) {
            $sql = "SELECT * FROM stockmatierpremier where matierepremier =" .$id_matiere;
            $query = $this->db->query($sql);
            return $query->result_array();
        }   

        public function get_stockmp_grby_matierep() {
            $sql = "SELECT * FROM stockmatierpremier group by matierepremier";
            $query = $this->db->query($sql);
            return $query->result_array();
        } 
    }
?>