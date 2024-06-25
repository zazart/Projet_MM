<?php 
class StockProduit_Controller extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('transformation/StockProduit_Model');
        $this->load->model('transformation/Produit_Model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['mouvementstocks'] = $this->StockProduit_Model->get_all_stockproduit2();
        $data["title"] = "Stock Produit";
		$data["contents"]="pages/Transformation/liste-mouvement-stockproduit";
		$this->load->view("templates/template",$data);
    }

    public function view_stockproduit_actuel() {
        $data['stockactuels'] = $this->StockProduit_Model->get_stockproduit_actuel();
        $data["title"] = "Stock Produit";
		$data["contents"]="pages/Transformation/liste-etat-stockproduit";
		$this->load->view("templates/template",$data);
    }

    public function validation_update_mouvementstock($id_stockproduitt) {
        $this->form_validation->set_rules('id_produit', 'Nom Produit', 'required');
        $this->form_validation->set_rules('quantietentrant', 'Quantite Entrant', 'required');
        $this->form_validation->set_rules('quantietsortant', 'Quantite Sortant', 'required');
        $this->form_validation->set_rules('datestock', 'Date Stockage', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['stockproduit'] = $this->StockProduit_Model->get_stockproduit($id_stockproduitt);
            $data['produits'] = $this->Produit_Model->get_all_produit();
            $data["title"] = "Stock Produit";
		    $data["contents"]="pages/Transformation/update-stockproduit";
            $this->load->view('templates/template', $data);
        } else {
            $data = array(
                'id_produit' => $this->input->post('id_produit'),
                'quantiteentrant' => $this->input->post('quantietentrant'),
                'quantitesortant' => $this->input->post('quantietsortant'),
                'datestockproduit' => $this->input->post('datestock')
            );

            if ($this->StockProduit_Model->update_stockproduit($id_stockproduitt, $data)) {
                redirect('transformation/stockproduit_controller');
            } else {
                $data['stockproduit'] = $this->StockProduit_Model->get_stockproduit($id_stockproduitt);
                $data['produits'] = $this->Produit_Model->get_all_produit();
                $data["title"] = "Stock Produit";
                $data["contents"]="pages/Transformation/update-stockproduit";
                $this->load->view('templates/template', $data);
            }
        }
    }

    public function validation_delete_mouvementstock($id){
        $this->StockProduit_Model->delete_stockproduit($id);

        redirect('transformation/stockproduit_controller');
    }
}
?>