<?php
    class Machine_Model extends CI_Model{
        public function __construct() {
            $this->load->database();
        }
    
        // utilisée dans Machine_Controller->index 
        public function get_all_machine() {
            $query = $this->db->get('machine');
            return $query->result_array();
        }
    
        public function delete_machine($id) {
            return $this->db->delete('machine', array('id_machine' => $id));
        }
    
        public function get_machine($id) {
            $query = $this->db->get_where('machine', array('id_machine' => $id));
            return $query->row_array();
        }
    
        public function update_machine($id, $data) {
            $this->db->where('id_machine', $id);
            return $this->db->update('machine', $data);
        }
    
        public function insert_machine($data) {
            return $this->db->insert('machine', $data);
        }

        public function get_machine_by_date($date1, $date2) {
            $this->db->where('date_achat >=', $date1);
            $this->db->where('date_achat <=', $date2);
            $query = $this->db->get('machine');
            return $query->result_array();
        }

        // Fonction pour obtenir les machines après une date spécifique
        public function get_machines_after_date($date) {
            $this->db->where('date_achat >=', $date);
            $query = $this->db->get('machines');
            return $query->result_array();
        }

        // Fonction pour obtenir les machines avant une date spécifique
        public function get_machines_before_date($date) {
            $this->db->where('date_achat <=', $date);
            $query = $this->db->get('machines');
            return $query->result_array();
        }
    }
?>
