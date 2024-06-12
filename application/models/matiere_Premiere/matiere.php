<?php
/**
 * @property CI_Loader $load
 * @property CI_Session $session
 */

class matiere extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }  

    public function insertmatierepremier($nom){

        $data = array(
            'nom' => $nom
        );
        $this->db->insert("matierpremier",$data);
        $this->session->set_flashdata('successfull','Matiere Premier inserted');
        redirect('Matiere_premier/matierepremier');
    }

    public function update_matiere($id,$nom){
        $data = array(
            'nom' => $nom
        );
        $this->db->where('id',$id);
        $this->db->update("matierpremier",$data);
        redirect('MatierePremier/matierepremier');
    }

    public function get_matiere_data(){
        $query=$this->db->get('matierepremier');
        return $query->result_array();
    }

    public function get_matiere($id){
        $query = $this->db->get_where('matierepremier', array('id'=>$id));
        return $query->row_array();
    }

    public function delete_matiere($id) {
        $this->db->delete('matierepremier',array('id'=>$id));
    }
} 

?>