<?php
class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_user($email) {
        $sql = "
        SELECT 
            profil.id_profil, profil.email, profil.mot_de_passe, profil.id_personnel, typeprofil.libelle as type_profil 
        FROM 
            profil 
        JOIN 
            typeprofil ON profil.type_profil = typeprofil.id_typeprofil 
        WHERE 
            profil.email = '$email'
        ";
        $query=$this->db->query($sql);
        return $query->result_array();
    }
}