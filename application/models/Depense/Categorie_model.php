<?php
// application/models/Employe_model.php
class Categorie_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    public function get_categories($id_categorie = FALSE)  {
        if ($id_categorie === FALSE) {
            $query = $this->db->get('categorie');
            return $query->result_array();
        }
        $query = $this->db->get_where('categorie', array('id' => $id_categorie));
        return $query->row_array();
    }
}
?>