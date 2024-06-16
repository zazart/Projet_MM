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
            "id_2"=>$matierepremier,
            "dateprelevement"=>$date,
            "id_1"=>$source
        );
        $this->db->insert('sourcematierepremier',$data);
        redirect('Matiere_Premier/sourcematierepremier');
    }

    function update_source_matiere_premier($id,$matierepremier,$date,$lieu){
        $data = array(
            "id_2"=>$matierepremier,
            "dateprelevement"=>$date,
            "id_1"=>$lieu
        );
        $this->db->where('id',$id);
        $this->db->update('sourcematierepremier',$data);
        redirect('Matiere_Premier/sourcematierepremier');
    }

    function get_source_matiere_premiere_data(){
        $this->db->select('sourcematierepremier.*,matierpremier.nom as nom, source.lieu as lieu');
        $this->db->from('sourcematierepremier');
        $this->db->join('source','sourcematierepremier.id_ 1= source.id');
        $this->db->join('matierpremier','sourcematierepremier.id_2 = matierpremier.id');

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