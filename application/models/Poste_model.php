<?php
// application/models/Poste_model.php
class Poste_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_postes($id_poste = FALSE) {
        if ($id_poste === FALSE) {
            $query = $this->db->get('poste');
            return $query->result_array();
        }

        $query = $this->db->get_where('poste', array('id_poste' => $id_poste));
        return $query->row_array();
    }

    public function insert_poste($nom, $montant_salaire, $duree_travail) {
        $data = array(
            'nom' => $nom,
            'montant_salaire' => $montant_salaire,
            'duree_travail' => $duree_travail
        );

        return $this->db->insert('poste', $data);
    }

    public function update_poste($id_poste, $nom, $montant_salaire, $duree_travail) {
        $data = array(
            'nom' => $nom,
            'montant_salaire' => $montant_salaire,
            'duree_travail' => $duree_travail
        );

        $this->db->where('id_poste', $id_poste);
        return $this->db->update('poste', $data);
    }

    public function delete_poste($id_poste) {
        return $this->db->delete('poste', array('id_poste' => $id_poste));
    }
}
?>