<?php
    class MatierePremier_Model extends CI_Model{
        public function __construct() {
            $this->load->database();
        }
        public function get_matiere($id) {
            $query = $this->db->get_where('matierepremier', array('id_matierepremier' => $id));
            return $query->row_array();
        }

        public function get_all_matierepremier(){
            $query = $this->db->get('matierepremier');
            return $query->result_array();
        }

    }
?>