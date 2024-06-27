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
        $this->load->model('vente_commande/Produit_model');
    }

    public function update_commande($id)
    {
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Modifier Client";
        $data["contents"] = "pages/commande/update_commande";
        $data["etat"] = "vente_commande";
        $data["activer"] = "lien_commande";
        $data["clients"] = $this->Client_model->get_clients();
        $data["produits"] = $this->Produit_model->get_all_produit();
        $data["commandes"] = $this->Commande_model->find_by_id($id);
        $data["paniers"] = $this->Panier_model->get_panier_by_commande($id);
        $this->load->view("templates/template", $data);
    }

    public function insert_commande()
    {
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Insertion commande";
        $data["contents"] = "pages/commande/insert_commande";
        $data["etat"] = "vente_commande";
        $data["clients"] = $this->Client_model->get_clients();
        $data["produits"] = $this->Produit_model->get_all_produit();
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
            $response = array(
                'success' => true,
                'message' => 'Commande ajouté avec succès.'
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
            $id = $this->input->post('id_commande');
            $commande_data = array(
                'datecommande' => $this->input->post('datecommande'),
                'id_client' => $this->input->post('client')
            );
            $this->Commande_model->update_commande($id, $commande_data);

            $this->Panier_model->delete_panier($id);
            $produits = $this->input->post('produits');
            $quantites = $this->input->post('quantites');
            foreach ($produits as $index => $produit_id) {
                $panier_data = array(
                    'id_produit' => $produit_id,
                    'quantite' => $quantites[$index],
                    'id_commande' => $id
                );
                $this->Panier_model->insert_panier($panier_data);
            }
            $response = array(
                'success' => true,
                'message' => 'Commande ajouté avec succès.'
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Panier_model->delete_panier($id);
        $this->Commande_model->delete_commande($id);
        $response = array(
            'success' => true,
            'message' => 'Commande supprimer avec succès.'
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function find_by_panier()
    {
        $id = $this->input->post('id');
        $paniers = $this->Panier_model->get_panier_by_commande($id);
        $response = array(
            'success' => true,
            'message' => 'Panier récuperer avec succès.',
            'paniers' => $paniers
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
