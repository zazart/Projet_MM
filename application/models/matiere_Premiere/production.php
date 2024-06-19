<?php
/**
 * @property CI_Loader $load
 * @property CI_Session $session
 */

class production extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertproduction($stock,$qt,$date){
        $data = array(
            'Stock'=>$stock,
            'Quantite'=>$qt,
            'DateProduction'=>$date
        );
        $this->db->insert('Production',$data);
        $this->session->set_flashdata('successfull','Production inserted');
        redirect('MatierePremier/production');
    }

    public function update_production($id,$stock,$qt,$date){
        $data = array(
            'Stock'=>$stock,
            'Quantite'=>$qt,
            'DateProduction'=>$date
        );
        $this->db->where('id',$id);
        $this->db->update('Production',$data);
        redirect('MatierePremier/production');
    }

    public function get_produciton_data(){
        $this->db->select('Production.id as id, Production.Quantite as Quantite, Production.DateProduction as DateProduction, Stock.id as stock_id, Stock.Dates as stock_date, Stock.QuantiteEntrant, Stock.QuantiteSortant, MatierePremier.Nom as Nom');
        $this->db->from('Production');
        $this->db->join('Stock', 'Production.Stock = Stock.id');
        $this->db->join('MatierePremier', 'Stock.MatierePremier = MatierePremier.id');
        $query = $this->db->get();  
        return $query->result();
    }

    public function get_production($id){
        $query = $this->db->get_where('Production',array('id'=>$id));
        return $query->row_array();
    }

    public function delete_production($id){
        $this->db->delete('Production',array('id'=>$id));
    }
}

?>