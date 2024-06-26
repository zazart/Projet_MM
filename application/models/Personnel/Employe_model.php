<?php
// application/models/Employe_model.php
class Employe_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_employes($id_employe = FALSE) {
        if ($id_employe === FALSE) {
            $now = date('Y-m-d'); // Obtenir la date actuelle au format YYYY-MM-DD

            $this->db->select('e.id_employe,  e.nom,e.email, e.telephone, poste.nom as poste_nom');
            $this->db->from('employe as e');
            $this->db->join('genre', 'e.id_genre = genre.id_genre');
            $this->db->join('poste', 'e.id_poste = poste.id_poste');
            $this->db->where('e.embauche <=', $now);
            $this->db->group_start();
            $this->db->where('e.debauche IS NULL');
            $this->db->or_where('e.debauche >=', $now);
            $this->db->group_end();

            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('e.id_employe, e.embauche, e.debauche, e.nom, e.email, e.telephone,e.adresse, genre.description as genre_description, poste.nom as poste_nom');
        $this->db->from('employe as e');
        $this->db->join('genre', 'e.id_genre = genre.id_genre');
        $this->db->join('poste', 'e.id_poste = poste.id_poste');
        $this->db->where('e.id_employe', $id_employe);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function search_employes($criteria = array()) {
        $this->db->select('e.id_employe,  e.nom,e.email, e.telephone, poste.nom as poste_nom');
        $this->db->from('employe as e');
        $this->db->join('genre', 'e.id_genre = genre.id_genre');
        $this->db->join('poste', 'e.id_poste = poste.id_poste');

         // Appliquer les critères de recherche
        if (!empty($criteria['nom'])) {
            $this->db->group_start();  // Open bracket
            $this->db->like('e.nom', $criteria['nom']);
            $this->db->or_like('e.email', $criteria['nom']);
            $this->db->group_end();  // Close bracket
        }
        if (!empty($criteria['debut_embauche'])) {
            $this->db->where('e.embauche >', $criteria['debut_embauche']);
        }
        if (!empty($criteria['fin_embauche'])) {
            $this->db->where('e.embauche <', $criteria['fin_embauche']);
        }
        if (!empty($criteria['id_genre'])) {
            $this->db->where('e.id_genre', $criteria['id_genre']);
        }
        if (!empty($criteria['id_poste'])) {
            $this->db->where('e.id_poste', $criteria['id_poste']);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_employe($data) {
        $this->db->insert('employe', $data);
        return $this->db->insert_id();
    }

    public function update_employe($id_employe, $data) {
        $this->db->where('id_employe', $id_employe);
        return $this->db->update('employe', $data);
    }

    public function delete_employe($id_employe) {
        return $this->db->delete('employe', array('id_employe' => $id_employe));
    }

    public function get_genres() {
        $query = $this->db->get('genre');
        return $query->result_array();
    }

    public function get_postes() {
        $query = $this->db->get('poste');
        return $query->result_array();
    }

    public function delete_profil_employe_by_employe($id_employe) {
        $this->db->where('id_personnel', $id_employe);
        $this->db->delete('profil');
    }
}
?>