<?php
// application/models/TypeProfil_model.php
class TypeProfil_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_types_profil() {
        $query = $this->db->get('typeprofil');
        return $query->result_array();
    }
}
?>
