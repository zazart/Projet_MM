<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Commande_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_commande($data)
    {
        return $this->db->insert('commande', $data);
    }

    public function get_commandes()
    {
        $this->db->select('commande.id_commande,commande.datecommande, client.nomglobal');
        $this->db->from('commande');
        $this->db->join('client', 'commande.id_client = client.id_client');
        $this->db->order_by("commande.datecommande", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_commande($id)
    {
        $this->db->where('id_commande', $id);
        return $this->db->delete('commande');
    }

    function find_by_id($id)
    {
        return $this->db->get_where('commande', array('id_commande' => $id))->row_array();
    }

    public function update_commande($id, $data)
    {
        $this->db->where('id_commande', $id);
        return $this->db->update('commande', $data);
    }

    public function get_commandes_sv() {
        $this->db->select('commande.*, client.id_client, client.nomglobal');
        $this->db->from('commande');
        $this->db->join('client', 'commande.id_client = client.id_client');
        $this->db->where('commande.id_commande NOT IN (SELECT id_commande FROM vente)', NULL, FALSE);
        $query = $this->db->get();
        return $query->result_array();
    }
}
