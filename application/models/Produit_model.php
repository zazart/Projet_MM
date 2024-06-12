<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_produits() {
        return $this->db->get('produit')->result_array();
    }
}
?>
