<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class PaiementCollecteur_model extends CI_Model {

    function save ($collecteur,$type,$date)  {
        if ($type == 1) $this->save_salaire($collecteur);
        if ($type == 2) $this->save_bonus($collecteur, $date);
    }
    function find_all () {
        $query = $this->db->query('select * from paiementCollecteur');
        return $query->result_array();
    }
    function save_salaire ($collecteur) {
        $query = $this->db->query('select * from get_last_salary(?)',array($collecteur));
        $salaire =  $query->row_array()['prix'];
        
        $this->db->query('insert into paiementCollecteur (prix, dates, id_collecteur, libelle) values (?,?,?,?) ',
                array($salaire,date('Y-m-d'), $collecteur,'salaire'));

    }
    function save_bonus ($collecteur, $date) {
        $query = $this->db->query('select * from get_last_bonus()');
        $bonus =  $query->row_array()['amount'];
        $dateTime = new DateTime($date);
        $annne = $dateTime->format('Y');
        $query2 = $this->db->query('select * from get_sum_collect (?,?)', array($collecteur,$annne));
        $qtt =  $query2->row_array()['qtt'];
        echo $qtt;
        $this->db->query('insert into paiementCollecteur (prix, dates, id_collecteur, libelle) values (?,?,?,?) ',
                array($bonus*$qtt,date('Y-m-d'), $collecteur,'bonus'));
    }

}