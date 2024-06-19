<?php
// application/models/PaiementEmploye_model.php
class PaiementEmploye_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function insert_paiement_employe($data) {
        return $this->db->insert('paiementemploye', $data);
    }

    public function get_employes() {
        $this->db->select('employe.id_employe, employe.nom, poste.montant_salaire');
        $this->db->from('employe');
        $this->db->join('poste', 'employe.id_poste = poste.id_poste');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_employe_by_id($id_employe) {
        $this->db->select('employe.id_employe, employe.nom, poste.montant_salaire');
        $this->db->from('employe');
        $this->db->join('poste', 'employe.id_poste = poste.id_poste');
        $this->db->where('employe.id_employe', $id_employe);
        $query = $this->db->get();
        return $query->row_array();
    }
}
?>
