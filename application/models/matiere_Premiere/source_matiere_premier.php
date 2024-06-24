<?php

/**
 * @property CI_Loader $load
 * @property CI_Session $session
 */
class source_matiere_premier extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insertsourcematierepremier($matierepremier, $date, $source)
    {
        $data = array(
            "matierpremier" => $matierepremier,
            "dateprelevement" => $date,
            "source" => $source
        );
        $this->db->insert('sourcematierepremier', $data);
    }

    function update_source_matiere_premier($id, $matierepremier, $date, $lieu)
    {
        $data = array(
            "matierpremier" => $matierepremier,
            "dateprelevement" => $date,
            "source" => $lieu
        );
        $this->db->where('id_sourcematierepremier', $id);
        $this->db->update('sourcematierepremier', $data);
    }

    function get_source_matiere_premiere_data()
    {
        $sql = "CREATE OR replace view source_matierpremier as select sourcematierepremier.* , matierepremier.nom as nom from sourcematierepremier join matierepremier on sourcematierepremier.matierpremier=matierepremier.id_matierepremier";
        $this->db->simple_query($sql);
        $this->db->select('source_matierpremier.id_sourcematierepremier,source_matierpremier.dateprelevement,matierepremier.nom, source.lieu as lieu');
        $this->db->from('source_matierpremier');
        $this->db->join('source', 'source_matierpremier.source=source.id_source');
        $this->db->join('matierepremier', 'matierepremier.id_matierepremier=source_matierpremier.matierpremier');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_source_matiere_premiere($id)
    {
        $query = $this->db->get_where('sourcematierepremier', array('id_sourcematierepremier' => $id));
        return $query->row_array();
    }

    function delete_source_matiere_premier($id)
    {
        $this->db->delete('sourcematierepremier', array('id_sourcematierepremier' => $id));
    }
}
