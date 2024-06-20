<?php
// application/models/Employe_model.php
class Employe_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_employes($id_employe = FALSE) {
        if ($id_employe === FALSE) {
            $now = date('Y-m-d'); // Obtenir la date actuelle au format YYYY-MM-DD

            $this->db->select('e.id_employe,e.nom, e.email, e.telephone,e.adresse, genre.description as genre_description, poste.nom as poste_nom');
            $this->db->from('employe as e');
            $this->db->join('genre', 'e.id_genre = genre.id_genre');
            $this->db->join('poste', 'e.id_poste = poste.id_poste');
            $this->db->where('e.embauche <', $now);
            $this->db->group_start();
            $this->db->where('e.debauche IS NULL');
            $this->db->or_where('e.debauche >', $now);
            $this->db->group_end();

            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('e.id_employe,e.nom, e.email, e.telephone,e.adresse, genre.description as genre_description, poste.nom as poste_nom');
        $this->db->from('employe as e');
        $this->db->join('genre', 'e.id_genre = genre.id_genre');
        $this->db->join('poste', 'e.id_poste = poste.id_poste');
        $this->db->where('e.id_employe', $id_employe);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function search_employes($criteria = array()) {
        $this->db->select('employe.*, genre.description as genre_description, poste.nom as poste_nom');
        $this->db->from('employe');
        $this->db->join('genre', 'employe.id_genre = genre.id_genre');
        $this->db->join('poste', 'employe.id_poste = poste.id_poste');

        // Appliquer les critères de recherche
        if (!empty($criteria['nom'])) {
            $this->db->like('employe.nom', $criteria['nom']);
        }
        if (!empty($criteria['email'])) {
            $this->db->like('employe.email', $criteria['email']);
        }
        if (!empty($criteria['telephone'])) {
            $this->db->like('employe.telephone', $criteria['telephone']);
        }
        if (!empty($criteria['adresse'])) {
            $this->db->like('employe.adresse', $criteria['adresse']);
        }
        if (!empty($criteria['id_genre'])) {
            $this->db->where('employe.id_genre', $criteria['id_genre']);
        }
        if (!empty($criteria['id_poste'])) {
            $this->db->where('employe.id_poste', $criteria['id_poste']);
        }
        if (!empty($criteria['embauche_before'])) {
            $this->db->where('employe.embauche <', $criteria['embauche_before']);
        }
        if (!empty($criteria['embauche_after'])) {
            $this->db->where('employe.embauche >', $criteria['embauche_after']);
        }
        if (!empty($criteria['debauche_before'])) {
            $this->db->where('employe.debauche <', $criteria['debauche_before']);
        }
        if (!empty($criteria['debauche_after'])) {
            $this->db->where('employe.debauche >', $criteria['debauche_after']);
        }
        if (isset($criteria['debauche_is_null'])) {
            $this->db->where('employe.debauche IS NULL', null, false);
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