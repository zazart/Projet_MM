<?php
/**
 * @property CI_Loader $load
 * @property CI_Session $session
 */

class stock extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }  

    public function insertstock($nom,$date,$in,$out){
        $data = array(
            'matierepremier'=>$nom,
            'dates'=>$date,
            'QuantiteEntrant'=>$in,
            'QuantiteSortant'=>$out
        );
        $this->db->insert('Stock',$data);
        $this->session->set_flashdata('successfull','Stock inserted');
        redirect('MatierePremier/stockmatierepremier');
    }

    public function update_stock($id,$nom,$date,$in,$out){
        $data = array(
            'matierepremier'=>$nom,
            'dates'=>$date,
            'QuantiteEntrant'=>$in,
            'QuantiteSortant'=>$out
        );
        $this->db->where('id',$id);
        $this->db->update('stock',$data);
        redirect('MatierePremier/stockmatierepremier');
    }

    public function get_stock_data(){
        $this->db->select('stock.*, matierepremier.Nom as Nom'); 
        $this->db->from('stock');
        $this->db->join('matierepremier', 'Stock.MatierePremier = matierepremier.id', 'left');
    
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_stock($id){
        $query = $this->db->get_where('stock', array('id'=>$id));
        return $query->row_array();
    }

    public function delete_stock($id) {
        $this->db->delete('stock',array('id'=>$id));
    }
}
?>