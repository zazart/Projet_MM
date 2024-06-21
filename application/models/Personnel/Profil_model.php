<?php
// application/models/Profil_model.php
class Profil_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function insert_profil($email, $mdp, $id_personnel, $type_profil) {
        $sql = "insert into profil(email, mot_de_passe, id_personnel, type_profil) values (?, ?, ?, ?)";
        $this->db->query($sql, array($email, $mdp, $id_personnel, $type_profil));
    }
}
?>
