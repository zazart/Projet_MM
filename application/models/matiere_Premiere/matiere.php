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
        $this->db->insert("matierepremier",$data);
    }

    public function update_matiere($id,$nom){
        $data = array(
            'nom' => $nom
        );
        $this->db->where('id_matierepremier',$id);
        $this->db->update("matierepremier",$data);
    }

    public function get_matiere_data(){
        $query=$this->db->get('matierepremier');
        return $query->result_array();
    }

    public function get_matiere($id){
        $query = $this->db->get_where('matierepremier', array('id_matierepremier'=>$id));
        return $query->row_array();
    }

    public function delete_matiere($id) {
        $this->db->delete('collects',array('id_matierepremier'=>$id));
        $this->db->delete('stockmatierpremier',array('matierepremier'=>$id));
        $this->db->delete('production',array('matierepremier'=>$id));
        $this->db->delete('prixmatierepremier',array('matierpremier'=>$id));
        $this->db->delete('sourcematierepremier',array('matierpremier'=>$id));
        $this->db->delete('matierepremier',array('id_matierepremier'=>$id));
    }
} 

?>