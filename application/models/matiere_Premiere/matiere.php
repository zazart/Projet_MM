<?php
/**
 * @property CI_Loader $load
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
        redirect('Matiere_premier/matiere_premier_insert');
    }

    public function update_matiere($id,$nom){
        $data = array(
            'nom' => $nom
        );
        $this->db->where('id',$id);
        $this->db->update("matierpremier",$data);
        redirect('Matiere_premier/matiere_premier_insert');
    }

    public function get_matiere_data(){
        $query=$this->db->get('matierpremier');
        return $query->result_array();
    }

    public function get_matiere($id){
        $query = $this->db->get_where('matierpremier', array('id'=>$id));
        return $query->row_array();
    }

    public function delete_matiere($id) {
        $this->db->delete('matierpremier',array('id'=>$id));
    }
} 

?>