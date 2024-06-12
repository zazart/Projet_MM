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
        return $this->db->get('commande')->result_array();
    }
}
?>
