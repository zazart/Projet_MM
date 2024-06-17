<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commande extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('vente_commande/Commande_model');
        $this->load->model('vente_commande/Client_model');
        $this->load->model('vente_commande/Panier_model');
    }
    public function index() {
        redirect("/commande/list");
    }

    public function insert_commande(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/commande/insert_commande";
        $data["etat"] = "vente_commande";
        $data["activer"] = "lien_commande";
		$this->load->view("templates/template",$data);
    }

    public function store() {
        $commande_data = array(
            'datecommande' => $this->input->post('date'),
            'id_client' => $this->input->post('id_client')
        );
        $this->Commande_model->insert_commande($commande_data);
        $commande_id = $this->db->insert_id();

        $produits = $this->input->post('produits');
        $quantites = $this->input->post('quantites');
        foreach ($produits as $index => $produit_id) {
            $panier_data = array(
                'id_produit' => $produit_id,
                'quantite' => $quantites[$index],
                'id_commande' => $commande_id
            );
            $this->Panier_model->insert_panier($panier_data);
        }

        redirect('commande/list');
    }

    public function list() {
        $data['commandes'] = $this->Commande_model->get_commandes();
        $this->load->view('commande/commande_list', $data);
    }
}
?>
