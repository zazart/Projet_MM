<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vente extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('vente_commande/Vente_model');
        $this->load->model('vente_commande/Panier_model');
        $this->load->model('vente_commande/Commande_model');
        $this->load->model('vente_commande/Client_model');
    }

    public function insert_vente()
    {
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Insertion vente";
        $data["contents"] = "pages/vente/insert_vente";
        $data["etat"] = "vente_commande";
        $data["activer"] = "lien_vente";
        $data["commandes"] = $this->Commande_model->get_commandes_sv();
        $this->load->view("templates/template", $data);
    }

    public function update_vente($id)
    {
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Modifier vente";
        $data["contents"] = "pages/vente/update_vente";
        $data["etat"] = "vente_commande";
        $data["activer"] = "lien_vente";
        $data["commandes"] = $this->Commande_model->get_commandes();
        $data["vente"] = $this->Vente_model->get_vente_by_id($id);
        $this->load->view("templates/template", $data);
    }

    public function validation()
    {
        $this->form_validation->set_rules('livraison', 'Livraison', 'required', array('required' => 'Le champ livraison est obligatoire'));
        $this->form_validation->set_rules('prixtotal', 'Prixtotal', 'required|numeric', array('required' => 'Le champ prix total est obligatoire', 'numeric' => 'Veuillez ne sélectionner que des chiffres'));
        $this->form_validation->set_rules('date_vente', 'Date_vente', 'required', array('required' => 'Le champ date vente est obligatoire'));
        $this->form_validation->set_rules('commande', 'Commande', 'required', array('required' => 'Le champ commande est obligatoire'));
    }

    public function store()
    {
        $this->validation();
        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'livraison' => form_error('livraison'),
                'prixtotal' => form_error('prixtotal'),
                'date_vente' => form_error('date_vente'),
                'commande' => form_error('commande')
            );

            $response = array(
                'success' => false,
                'errors' => $errors
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $vente_data = array(
                'livraison' => $this->input->post('livraison'),
                'date_vente' => $this->input->post('date_vente'),
                'prixtotal' => $this->input->post('prixtotal'),
                'id_commande' => $this->input->post('commande')
            );
            $this->Vente_model->insert_vente($vente_data);
            $response = array(
                'success' => true,
                'message' => 'Vente ajouté avec succès.'
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function storeupdate()
    {
        $this->validation();
        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'livraison' => form_error('livraison'),
                'prixtotal' => form_error('prixtotal'),
                'date_vente' => form_error('date_vente'),
                'commande' => form_error('commande')
            );

            $response = array(
                'success' => false,
                'errors' => $errors
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $id = $this->input->post('id_vente');
            $vente_data = array(
                'livraison' => $this->input->post('livraison'),
                'date_vente' => $this->input->post('date_vente'),
                'prixtotal' => $this->input->post('prixtotal'),
                'id_commande' => $this->input->post('commande')
            );
            $this->Vente_model->update_vente($id, $vente_data);
            $response = array(
                'success' => true,
                'message' => 'Vente modifié avec succès.'
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function getliste_vente()
    {
        $ventes = $this->Vente_model->get_ventes();
        $response = array(
            'success' => true,
            'message' => 'Vente ajouté avec succès.',
            'ventes' => $ventes
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }


    public function statistique()
    {
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Projet MM";
        $data["contents"] = 'pages/vente/vente_statistique';
        $data["etat"] = "vente_commande";
        $data["activer"] = "lien_statistique";
        $this->load->view("templates/template", $data);
    }

    public function data_statistique()
    {
        $debut = $this->input->get("debut");
        $fin = $this->input->get("fin");
        $data = $this->Vente_model->get_all($debut, $fin);
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json; charset=utf-8')
        ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
        exit;
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Vente_model->delete_vente($id);
        $response = array(
            'success' => true,
            'message' => 'Vente supprimer avec succès.'
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}