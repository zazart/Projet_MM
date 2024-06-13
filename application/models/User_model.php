<?php
class Presence_model extends CI_Model {
    public function __construct(){}

    public function checkLogin($email){
        $pseudo="'".$email."'";
        $sql = "SELECT Profil.id, Profil.email Profil.mot_de_passe, Profil.id_personnel, TypeProfil.libelle as type_profil";
        $sql .= "FROM Profil JOIN TypeProfil ON Profil.type_profil = TypeProfil.id ";
        $sql .= "WHERE Profil.email = ".$email;
        $query=$this->db->query($sql);
        $res=null;
        foreach($query->result_array() as $r) {
            $res=$r;
        }
        return $res;
    }
}