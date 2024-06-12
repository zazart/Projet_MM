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
            "Lieu" => $lieu
        );
        $this->db->insert('Source',$data);
        $this->session->set_flashdata('successfull','Source inserted');
        redirect('MatierePremier/source');
    }

    function update_source($id,$lieu){
        $data = array(
            'Lieu' => $lieu
        );
        $this->db->where($id);
        $this->db->update('source',$data);
        redirect('MatierePremier/source');
    }

    function get_source_data(){
        $query=$this->db->get('source');
        return $query->result_array();
    }

    public function get_source($id){
        $query = $this->db->get_where('source', array('id'=>$id));
        return $query->row_array();
    }

    public function delete_source($id) {
        $this->db->delete('source',array('id'=>$id));
    }
}

?>