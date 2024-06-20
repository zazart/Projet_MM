<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_client($data) {
        return $this->db->insert('client', $data);
    }

    public function get_clients() {
        return $this->db->get('client')->result_array();
    }

    public function get_client_by_id($id) {
        return $this->db->get_where('client', array('id_client' => $id))->row_array();
    }

    public function update_client($id, $data) {
        $this->db->where('id_client', $id);
        return $this->db->update('client', $data);
    }

    public function delete_client($id) {
        $this->db->where('id_client', $id);
        return $this->db->delete('client');
    }
}
?>