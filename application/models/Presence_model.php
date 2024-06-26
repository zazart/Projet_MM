<!-- application/models/Presence_model.php -->
<?php
class Presence_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_presences($id_presence = FALSE) {
        if ($id_presence === FALSE) {
            $this->db->select('presence.*, employe.email');
            $this->db->from('presence');
            $this->db->join('employe', 'presence.id_employe = employe.id_employe');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('presence.*, employe.email');
        $this->db->from('presence');
        $this->db->join('employe', 'presence.id_employe = employe.id_employe');
        $this->db->where('id_presence', $id_presence);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function insert_presence($data) {
        return $this->db->insert('presence', $data);
    }

    public function update_presence($id_presence, $data) {
        $this->db->where('id_presence', $id_presence);
        return $this->db->update('presence', $data);
    }

    public function delete_presence($id_presence) {
        $this->db->where('id_presence', $id_presence);
        return $this->db->delete('presence');
    }

    public function get_employes() {
        $query = $this->db->get('employe');
        return $query->result_array();
    }
}
?>
