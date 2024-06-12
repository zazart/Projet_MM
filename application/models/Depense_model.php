<?php
// application/models/Employe_model.php
class Depense_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    public function insert_depense($data) {
        return $this->db->insert('depenses', $data);
    }
}
?>