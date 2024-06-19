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
            'id_matierpremier'=>$idmatiere,
            'prix'=>$prix,
            'dateprix'=>$date
        );
        $this->db->insert('prixmatierepremier',$data);
        redirect('Matiere_Premier/prixmatierepremier');
    }

    public function update_prix_matiere($id,$idmatierepremier,$prix,$date) {
        $data = array(
            'id_matierpremier'=>$idmatierepremier,
            'prix'=>$prix,
            'dateprix'=>$date
        );

        $this->db->where('id',$id);
        $this->db->update('prixmatierepremier',$data);
        redirect('Matiere_Premier/prixmatierepremier');
    }

    public function get_prix_matiere_data(){
        $this->db->select('prixmatierepremier.*, matierpremier.nom'); 
        $this->db->from('prixmatierepremier');
        $this->db->join('matierpremier', 'prixmatierepremier.id_matierpremier = matierpremier.id', 'left');
    
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function get_prix_matiere($id){
        $query = $this->db->get_where('prixmatierepremier', array('id'=>$id));
        return $query->row_array();
    }

    public function delete_matiere($id) {
        $this->db->delete('prixmatierepremier',array('id'=>$id));
    }
}

?>