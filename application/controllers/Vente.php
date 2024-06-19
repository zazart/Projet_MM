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
        $this->load->view('vente/vente_list', $data);
    }

    public function create() {
        $data['commandes'] = $this->Commande_model->get_commandes_sv();
        $this->load->view('vente/vente_form', $data);
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
        $this->load->view('vente/vente_statistique');
    }

    public function data_statistique() {
        header('Content-Type: application/json');
        echo json_encode($this->Vente_model->get_all());
    }
}
?>
