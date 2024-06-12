<?php
// application/models/Employe_model.php
class Depense_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    public function get_depenses($id_depense = FALSE){
        if ($id_depense === FALSE) {
            $query = $this->db->get('categorie');
            return $query->result_array();
        }
        $query = $this->db->get_where('categorie', array('id' => $id_categorie));
        return $query->row_array();
    }
}
?>