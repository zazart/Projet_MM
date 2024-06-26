<?php
    class Statut_Model extends CI_Model{
        public function __construct() {
            $this->load->database();
        }
    
        // utilisée dans Machine_Controller->index 
        public function get_all_machine() {
            $query = $this->db->get('machine');
            return $query->result_array();
        }

        public function get_all_statut() {
            $query = $this->db->get('stat_machine');
            return $query->result_array();
        }
    
        public function delete_statut($id) {
            return $this->db->delete('stat_machine', array('id_stat' => $id));
        }
    
        public function get_statut($id) {
            $query = $this->db->get_where('stat_machine', array('id_stat' => $id));
            return $query->row_array();
        }
    
        public function update_statut($id, $data) {
            $this->db->where('id_stat', $id);
            return $this->db->update('stat_machine', $data);
        }
    
        public function insert_statut($data) {
            return $this->db->insert('stat_machine', $data);
        }

        public function get_machine($id) {
            $query = $this->db->get_where('machine', array('id_machine' => $id));
            return $query->row_array();
        }
        public function get_machine_statut($idstatut) {
            $query = $this->db->get_where('stat_machine', array('id_stat' => $idstatut));
            return $query->row_array();
        }
        // Nouvelle méthode pour obtenir les statuts les plus récents pour chaque machine
        public function get_statut_actuel() {
            $sql = "
            SELECT sm.id_stat, sm.id_machine, m.nom_machine, sm.date_verification, sm.statut, sm.descri
            FROM stat_machine sm
            INNER JOIN (
                SELECT id_machine, MAX(date_verification) AS max_date
                FROM stat_machine
                GROUP BY id_machine
            ) latest ON sm.id_machine = latest.id_machine AND sm.date_verification = latest.max_date
            INNER JOIN machine m ON sm.id_machine = m.id_machine";

            $query = $this->db->query($sql);
            return $query->result_array();
        }

        public function delete_statut_bymachine($id) {
            return $this->db->delete('stat_machine', array('id_machine' => $id));
        }

    }
?>
