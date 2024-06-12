<?php
/**
 * @property CI_Loader $load
 * @property CI_Session $session
 */
class prix_matiere extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertprixmatierepremier($idmatiere,$prix,$date){

        $data = array(
            'MatierPremier'=>$idmatiere,
            'Prix'=>$prix,
            'DatePrix'=>$date
        );
        $this->db->insert('PrixMatierePremier',$data);
        $this->session->set_flashdata('successfull','Matiere Premier inserted');
        redirect('MatierePremier/prixmatierepremier');
    }

    public function update_prix_matiere($id,$idmatierepremier,$prix,$date) {
        $data = array(
            'MatierPremier'=>$idmatierepremier,
            'Prix'=>$prix,
            'DatePrix'=>$date
        );

        $this->db->where('id',$id);
        $this->db->update('prixmatierepremier',$data);
        redirect('MatierePremier/prixmatierepremier');
    }

    public function get_prix_matiere_data(){
        $this->db->select('prixmatierepremier.*, matierepremier.Nom'); 
        $this->db->from('prixmatierepremier');
        $this->db->join('matierepremier', 'prixmatierepremier.MatierPremier = matierepremier.id', 'left');
    
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