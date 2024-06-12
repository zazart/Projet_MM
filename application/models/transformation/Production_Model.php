<?php
    class Production_Model extends CI_Model{
        public function __construct() {
            $this->load->database();
        }
    
        // utilisée dans Machine_Controller->index 
        public function get_all_production() {
            $query = $this->db->get('production');
            return $query->result_array();
        }
    
        public function delete_production($id) {
            return $this->db->delete('production', array('id_production' => $id));
        }
    
        public function get_production($id) {
            $query = $this->db->get_where('production', array('id_production' => $id));
            return $query->row_array();
        }
    
        public function update_production($id, $data) {
            $this->db->where('id_production', $id);
            return $this->db->update('production', $data);
        }
    
        public function insert_production($data) {
            return $this->db->insert('production', $data);
        }
    }
?>
