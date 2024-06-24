<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Commande extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('vente_commande/Commande_model');
        $this->load->model('vente_commande/Client_model');
        $this->load->model('vente_commande/Panier_model');
    }

    public function insert_commande()
    {
        $data["title"] = "Projet MM";
        $data["contents"] = "pages/commande/insert_commande";
        $data["etat"] = "vente_commande";
        $data["clients"] = $this->Client_model->get_clients();
        $data["activer"] = "lien_commande";
        $this->load->view("templates/template", $data);
    }

    public function getliste_commande()
    {
        $commandes = $this->Commande_model->get_commandes();
        $response = array(
            'success' => true,
            'message' => 'Commande ajouté avec succès.',
            'commandes' => $commandes
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function validation()
    {
        $this->form_validation->set_rules('datecommande', 'Datecommande', 'required', array('required' => 'Le champ date de commande est obligatoire'));
        $this->form_validation->set_rules('client', 'Client', 'required', array('required' => 'Le champ client est obligatoire'));
    }

    public function store()
    {
        $this->validation();

        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'datecommande' => form_error('datecommande'),
                'client' => form_error('client')
            );

            $response = array(
                'success' => false,
                'errors' => $errors
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $commande_data = array(
                'datecommande' => $this->input->post('datecommande'),
                'id_client' => $this->input->post('client')
            );
            $this->Commande_model->insert_commande($commande_data);
            $response = array(
                'success' => true,
                'message' => 'Commande ajouté avec succès.'
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }
}
