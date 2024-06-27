<?php 
class Produit_Controller extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('transformation/Produit_Model');
        $this->load->model('transformation/StockProduit_Model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Produit";
        $data["etat"]="transformation";
        $data["activer"]="produit_dispo";
		$data["contents"]="pages/Transformation/liste-produit";
		$this->load->view("templates/template",$data);
    }

    public function produitsData(){
        $response = array (
            'success'   =>      true,
            'produits'  =>      $this->Produit_Model->get_all_produit()
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function validation_update_produit($id_produit) {
        $this->form_validation->set_rules('prix_unitaire', 'Prix unitaire', 'required');

        if ($this->form_validation->run() === FALSE) {
            $user = $this->session->userdata('user');
            $data["user"] = $user;
            $data['produit'] = $this->Produit_Model->get_produit($id_produit);
            $data["title"] = "Produit";
            $data["etat"]="transformation";
            $data["activer"]="produit_dispo";
		    $data["contents"]="pages/Transformation/update-produit";
            $this->load->view('templates/template', $data);
        } else {
            $idp = $this->input->post('id_produit');
            $data = array(
                'nom_produit' => $this->input->post('nom_produit'),
                'prix_unitaire' => $this->input->post('prix_unitaire')
            );

            if ($this->Produit_Model->update_produit($id_produit, $data)) {
                redirect('transformation/produit_controller');
            } else {
                $user = $this->session->userdata('user');
                $data["user"] = $user;
                $data['produit'] = $this->Produit_Model->get_produit($id_produit);
                $data["title"] = "Produit";
                $data["etat"]="transformation";
                $data["activer"]="produit_dispo";
		        $data["contents"]="pages/Transformation/update-produit";
                $this->load->view('templates/template', $data);
            }
        }
    }

    public function validation_delete_produit(){
        $id = $this->input->post('id');
        $this->StockProduit_Model->delete_stock_byproduit($id);
        $this->Produit_Model->delete_produit($id);
        $response = array(
            'success' => true,
            'message' => 'Produit supprimer avec succès.'
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
?>