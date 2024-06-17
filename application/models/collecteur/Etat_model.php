<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Etat_model extends CI_Model {
    function get_etat ( $annee) {
        $sql = "SELECT c.Id_MatierPremier, m.nom ,SUM(c.qtt) AS total FROM Collects c ";
        $sql .= " join matierpremier m on m.id_matierpremier = c.id_matierpremier ";
        $sql .= " WHERE EXTRACT(YEAR FROM c.DateCollect) = ? ";
        $sql .= " GROUP BY c.Id_MatierPremier, m.nom "; 
        $query = $this->db->query($sql, array($annee));
        return $query->result_array();
    }
    function etat_general ($annee, $prediction)  {
        $actuel = $this->get_etat($annee);
        for ($i=0; $i < count($prediction); $i++) { 
            $actuel[$i]['pourcentage'] = ($actuel[$i]['total'] >= $prediction[$i]) ? 100 :  intval(($actuel[$i]['total']/$prediction[$i])*100);
        }
        
        // information sur le total
        $total_actuel = array();
        for ($i= 0; $i < count($actuel); $i++) {
            $total_actuel[$i] = ($actuel[$i]['total'] >= $prediction[$i]) ?  $prediction[$i] : $actuel[$i]['total'];
        }
        
        $i = count($prediction);
        echo  array_sum($prediction)."</br>".array_sum(array_column($actuel,'pourcentage'));
        $actuel [$i]['nom'] = "Total";
        $actuel [$i]["pourcentage"] = intval((array_sum($total_actuel) / array_sum($prediction))*100 );
        // echo array_sum(array_column($actuel,'total'))/ array_sum($prediction);
        // echo  (int) (array_sum(array_column($actuel,'total')) / array_sum($prediction))*100;

        return $actuel;
    }
}

?>