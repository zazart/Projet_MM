<?php
/**
 * @property CI_Loader $load
 * @property CI_Session $session
 */
class source extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }  

    function insertsource($lieu){
        $data = array(
            "lieu" => $lieu
        );
        $this->db->insert('source',$data);
    }

    function update_source($id,$lieu){
        $data = array(
            'lieu' => $lieu
        );
        $this->db->where('id_source',$id);
        $this->db->update('source',$data);
    }

    function get_source_data(){
        $query=$this->db->get('source');
        return $query->result_array();
    }

    public function get_source($id){
        $query = $this->db->get_where('source', array('id_source'=>$id));
        return $query->row_array();
    }

    public function delete_source($id) {
        $this->db->delete('sourcematierepremier',array("source"=>$id));
        $this->db->delete('source',array('id_source'=>$id));
    }
}

?>