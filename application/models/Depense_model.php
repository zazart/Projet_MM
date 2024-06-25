<?php
// application/models/Depense_model.php
class Depense_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Function to insert data into the Depense table
    public function insert_depense($data) {
        return $this->db->insert('depense', $data);
    }

    // Function to get all categories
    public function get_categories() {
        $query = $this->db->get('sub_comptes');
        return $query->result_array();
    }

    // Function to get all depense
    public function get_depense() {
        $query = $this->db->get('v_depense_info');
        return $query->result_array();
    }

    // Function to get all categories
    public function get_pcg() {
        $query = $this->db->get('pcg');
        return $query->result_array();
    }

    public function get_subcomptes_by_pcg($pcg_id) {
        $this->db->where('idpcg', $pcg_id);
        $query = $this->db->get('sub_comptes');
        return $query->result_array();
    }


    public function get_depense_by_id($id) {
        $this->db->where('id_depense', $id);
        $query = $this->db->get('v_depense');
        return $query->result_array();
    }



    // Function to get all modes of payment
    public function get_modes_de_paiement() {
        $query = $this->db->get('modedepaiement'); // Make sure table name is correct
        return $query->result_array();
    }
        // Function to generate PCG (assuming it's to generate categories/sub-comptes)
    public function generatePcg() {
            // Step 1: Clear existing data
           
            $this->db->empty_table('sub_comptes');
            $this->db->empty_table('pcg');
    
            // Step 2: Insert data from pcg.csv into pcg table
            $pcg_file = 'base/pcg.csv';  // Adjust the file path accordingly
            if (($handle = fopen($pcg_file, 'r')) !== FALSE) {
                fgetcsv($handle); // Skip header row
                while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
                    if (count($data) == 3) {  // Ensure correct number of columns
                        $pcg_data = array(
                            'id_pcg' => $data[0],  // Adjust the indexes according to the structure of your csv file
                            'intitule' => $data[1],
                            'nom' => $data[2]
                        );
                        $this->db->insert('pcg', $pcg_data);
                    }
                }
                fclose($handle);
            }
    
            // Step 3: Insert data from sub_comptes.csv into sub_comptes table
            $sub_comptes_file = 'base/sub_comptes.csv';  // Adjust the file path accordingly
            if (($handle = fopen($sub_comptes_file, 'r')) !== FALSE) {
                fgetcsv($handle); // Skip header row
                while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
                    if (count($data) == 4) {  // Ensure correct number of columns
                        $sub_comptes_data = array(
                            'id_sub_comptes' => $data[0],  // Adjust the indexes according to the structure of your csv file
                            'intitule' => $data[1],
                            'description' => $data[2],
                            'idpcg' => $data[3]
                        );
                        $this->db->insert('sub_comptes', $sub_comptes_data);
                    }
                }
                fclose($handle);
            }
    
            return true;
        }

    public function update_depense($id, $data) {
        $this->db->where('id_depense', $id);
        return $this->db->update('depense', $data);
    }
    
    // Function to delete a depense
    public function delete_depense($id) {
            $this->db->where('id', $id);
            return $this->db->delete('depense');
    }

    

}
?>
