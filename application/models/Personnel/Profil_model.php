<?php
// application/models/Profil_model.php
class Profil_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function insert_profil($data) {
        return $this->db->insert('profil', $data);
    }
}
?>
