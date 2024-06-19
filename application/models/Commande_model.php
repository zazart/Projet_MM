<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commande_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_commande($data) {
        return $this->db->insert('commande', $data);
    }

    public function get_commandes() {
        $this->db->select('commande.*, client.nomglobal');
        $this->db->from('commande');
        $this->db->join('client', 'commande.id_client = client.id_client');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_commandes_sv() {
        $this->db->select('commande.*, client.id as id_client, client.nomglobal');
        $this->db->from('commande');
        $this->db->join('client', 'commande.id_client = client.id');
        $this->db->where('commande.id NOT IN (SELECT id_commande FROM vente)', NULL, FALSE);
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>
