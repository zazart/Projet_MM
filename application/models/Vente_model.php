<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vente_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_vente($data) {
        return $this->db->insert('vente', $data);
    }

    public function get_ventes() {
        return $this->db->get('vente')->result_array();
    }
}
?>
