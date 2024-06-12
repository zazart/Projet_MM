<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vente extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Vente_model');
        $this->load->model('Panier_model');
        $this->load->model('Commande_model');
        $this->load->model('Client_model');
    }

    public function index() {
        $data['ventes'] = $this->Vente_model->get_ventes();
        $this->load->view('vente_list', $data);
    }

    public function create() {
        $data['clients'] = $this->Client_model->get_clients();
        $this->load->view('vente_form', $data);
    }

    public function store() {
        $commande_data = array(
            'date_commande' => date('Y-m-d H:i:s'),
            'id_client' => $this->input->post('id_client')
        );
        $this->Commande_model->insert_commande($commande_data);
        $commande_id = $this->db->insert_id();

        $panier_data = array(
            'id_produit' => $this->input->post('idProduit'),
            'quantite' => $this->input->post('quantite'),
            'id_commande' => $commande_id
        );
        $this->Panier_model->insert_panier($panier_data);

        $vente_data = array(
            'livraison' => $this->input->post('livraison'),
            'prixtotal' => $this->input->post('prixTotal'),
            'id_commande' => $commande_id
        );
        $this->Vente_model->insert_vente($vente_data);

        redirect('vente');
    }
}
?>
