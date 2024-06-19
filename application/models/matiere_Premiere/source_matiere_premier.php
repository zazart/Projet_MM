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
        $sql="CREATE OR replace view source_matierpremier as select sourcematierepremier.* , matierpremier.nom as nom from sourcematierepremier join matierpremier on sourcematierepremier.id_2=matierpremier.id";
        $this->db->simple_query($sql);
        $this->db->select('source_matierpremier.*, source.lieu as lieu');
        $this->db->from('source_matierpremier');
        $this->db->join('source','source_matierpremier.id_1=source.id');
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