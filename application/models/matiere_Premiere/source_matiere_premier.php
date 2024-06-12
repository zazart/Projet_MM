<?php
/**
 * @property CI_Loader $load
 * @property CI_Session $session
 */
class source_matiere_premier extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insertsourcematierepremier($matierepremier,$date,$source){
        $data = array(
            "MatierePremier"=>$matierepremier,
            "DatePrelevement"=>$date,
            "Source"=>$source
        );
        $this->db->insert('SourceMatierePremier',$data);
        $this->session->set_flashdata('successfull','Source Matiere Premier inserted');
        redirect('MatierePremier/sourcematierepremier');
    }

    function update_source_matiere_premier($id,$matierepremier,$date,$lieu){
        $data = array(
            "MatierePremier"=>$matierepremier,
            "DatePrelevement"=>$date,
            "Source"=>$lieu
        );
        $this->db->where('id',$id);
        $this->db->update('sourcematierepremier',$data);
        redirect('MatierePremier/sourcematierepremier');
    }

    function get_source_matiere_premiere_data(){
        $this->db->select('sourcematierepremier.*,matierepremier.nom as nom, source.lieu as lieu');
        $this->db->from('sourcematierepremier');
        $this->db->join('matierepremier','sourcematierepremier.matierepremier = matierepremier.id','left');
        $this->db->join('source','sourcematierepremier.source = source.id','left');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_source_matiere_premiere($id){
        $query = $this->db->get_where('sourcematierepremier', array('id'=>$id));
        return $query->row_array();
    }

    function delete_source_matiere_premier($id)
    {
        $this->db->delete('sourcematierepremier',array('id'=>$id));
    }
}

?>