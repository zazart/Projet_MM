<?php
/**
 * @property CI_Loader $load
 */
class prix_matiere extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertprixmatierepremier($idmatiere,$prix,$date){

        $data = array(
            'matierpremier'=>$idmatiere,
            'prix'=>$prix,
            'dateprix'=>$date
        );
        $this->db->insert('prixmatierepremier',$data);
    }

    public function update_prix_matiere($id,$idmatierepremier,$prix,$date) {
        $data = array(
            'matierpremier'=>$idmatierepremier,
            'prix'=>$prix,
            'dateprix'=>$date
        );

        $this->db->where('id_prixmatierepremier',$id);
        $this->db->update('prixmatierepremier',$data);
    }

    public function get_prix_matiere_data(){
        $this->db->select('prixmatierepremier.*,matierepremier.nom as nom'); 
        $this->db->from('prixmatierepremier');
        $this->db->join('matierepremier', 'prixmatierepremier.matierpremier = matierepremier.id_matierepremier');
    
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function get_prix_matiere($id){
        $query = $this->db->get_where('prixmatierepremier', array('id_prixmatierepremier'=>$id));
        return $query->row_array();
    }

    public function delete_matiere($id) {
        $this->db->delete('prixmatierepremier',array('id_prixmatierepremier'=>$id));
    }
}

?>