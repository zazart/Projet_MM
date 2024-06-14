<?php
// application/models/Employe_model.php
class Employe_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_employes($id_employe = FALSE) {
        if ($id_employe === FALSE) {
            $this->db->select('employe.*, genre.description as genre_description, poste.nom as poste_nom');
            $this->db->from('employe');
            $this->db->join('genre', 'employe.id_genre = genre.id');
            $this->db->join('poste', 'employe.id_poste = poste.id_poste');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('employe.*, genre.description as genre_description, poste.nom as poste_nom');
        $this->db->from('employe');
        $this->db->join('genre', 'employe.id_genre = genre.id');
        $this->db->join('poste', 'employe.id_poste = poste.id_poste');
        $this->db->where('employe.id_employe', $id_employe);
        $query = $this->db->get();
        return $query->row_array();
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