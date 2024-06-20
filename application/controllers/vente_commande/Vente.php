<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vente extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('vente_commande/Vente_model');
        $this->load->model('vente_commande/Panier_model');
        $this->load->model('vente_commande/Commande_model');
        $this->load->model('vente_commande/Client_model');
    }

    public function index() {
        $data['ventes'] = $this->Vente_model->get_ventes();
        $this->load->view('pages/vente/vente_list', $data);
    }

    public function insert_vente(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/vente/insert_vente";
        $data["etat"] = "vente_commande";
        $data["activer"] = "lien_vente";
		$this->load->view("templates/template",$data);
    }

    public function store() {
        $commande_id = $this->input->post('id_commande');
        $vente_data = array(
            'livraison' => $this->input->post('livraison'),
            'prixtotal' => $this->input->post('prixTotal'),
            'date_vente' => $this->input->post('date_vente'),
            'id_commande' => $commande_id
        );
        $this->Vente_model->insert_vente($vente_data);
        redirect('vente');
    }
    public function statistique() {
        $data["title"] = "Projet MM";
		$data["contents"]='pages/vente/vente_statistique';
        $data["etat"] = "vente_commande";
        $data["activer"] = "lien_statistique";
		$this->load->view("templates/template",$data);
    }

    public function data_statistique() {
        header('Content-Type: application/json');
        echo json_encode($this->Vente_model->get_all());
    }
}
?>
