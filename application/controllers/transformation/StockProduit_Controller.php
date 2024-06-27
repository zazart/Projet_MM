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
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Stock Produit";
        $data["etat"]="transformation";
        $data["activer"]="mouvement_stock";
		$data["contents"]="pages/Transformation/liste-mouvement-stockproduit";
		$this->load->view("templates/template",$data);
    }

    public function view_stockproduit_actuel() {
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Stock Produit";
        $data["etat"]="transformation";
        $data["activer"]="etat_stock";
		$data["contents"]="pages/Transformation/liste-etat-stockproduit";
		$this->load->view("templates/template",$data);
    }
    public function  getStockProsuits(){
        $response = array (
            'success'   =>      true,
            'produits'  =>     $this->StockProduit_Model->get_stockproduit_actuel()
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function  getStockProsuitsMouvements(){
        $response = array (
            'success'   =>      true,
            'produits'  =>     $this->StockProduit_Model->get_all_stockproduit2()
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function validation_update_mouvementstock($id_stockproduitt) {
        $this->form_validation->set_rules('id_produit', 'Nom Produit', 'required');
        $this->form_validation->set_rules('quantietentrant', 'Quantite Entrant', 'required');
        $this->form_validation->set_rules('quantietsortant', 'Quantite Sortant', 'required');
        $this->form_validation->set_rules('datestock', 'Date Stockage', 'required');

        if ($this->form_validation->run() === FALSE) {
            $user = $this->session->userdata('user');
            $data["user"] = $user;
            $data['stockproduit'] = $this->StockProduit_Model->get_stockproduit($id_stockproduitt);
            $data['produits'] = $this->Produit_Model->get_all_produit();
            $data["title"] = "Stock Produit";
            $data["etat"]="transformation";
            $data["activer"]="etat_stock";
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
                $user = $this->session->userdata('user');
                $data["user"] = $user;
                $data['stockproduit'] = $this->StockProduit_Model->get_stockproduit($id_stockproduitt);
                $data['produits'] = $this->Produit_Model->get_all_produit();
                $data["title"] = "Stock Produit";
                $data["etat"]="transformation";
                $data["activer"]="etat_stock";
                $data["contents"]="pages/Transformation/update-stockproduit";
                $this->load->view('templates/template', $data);
            }
        }
    }

    public function validation_delete_mouvementstock(){
        $id = $this->input->post('id');
        $this->StockProduit_Model->delete_stockproduit($id);
        $response = array(
            'success' => true,
            'message' => 'Mouvement de stock supprimer avec succès.'
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
?>