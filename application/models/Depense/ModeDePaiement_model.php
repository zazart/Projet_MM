<?php
// application/models/Employe_model.php
class ModeDePaiement_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    public function get_mode_de_paiements($id_paiement = FALSE)  {
        if ($id_paiement === FALSE) {
            $query = $this->db->get('modedepaiement');
            return $query->result_array();
        }
        $query = $this->db->get_where('modedepaiement', array('id' => $id_paiement));
        return $query->row_array();
    }
}
?>