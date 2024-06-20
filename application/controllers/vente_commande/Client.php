<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('vente_commande/Client_model');
    }

    public function index()
    {
        $data['clients'] = $this->Client_model->get_clients();
        $this->load->view('client/client_list', $data);
    }

    public function insert_client()
    {
        $data["title"] = "Insertion Client";
        $data["contents"] = "pages/client/insert_client";
        $data["etat"] = "vente_commande";
        $data["activer"] = "lien_client";
        $this->load->view("templates/template", $data);
    }

    public function getliste_client()
    {
        $clients = $this->Client_model->get_clients();
        $response = array(
            'success' => true,
            'message' => 'Client ajouté avec succès.',
            'clients' => $clients
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function validation()
    {
        $this->form_validation->set_rules('nomGlobal', 'NomGlobal', 'required', array('required' => 'Le champ username est obligatoire'));
        $this->form_validation->set_rules('adresse', 'Adresse', 'required', array('required' => 'Le champ adresse est obligatoire'));
        $this->form_validation->set_rules('email', 'Email', 'required', array('required' => 'Le champ email est obligatoire'));
    }

    public function store()
    {
        $this->validation();

        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'nomGlobal' => form_error('nomGlobal'),
                'adresse' => form_error('adresse'),
                'email' => form_error('email')
            );

            $response = array(
                'success' => false,
                'errors' => $errors
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $client_data = array(
                'nomglobal' => $this->input->post('nomGlobal'),
                'email' => $this->input->post('email'),
                'adresse' => $this->input->post('adresse')
            );
            $this->Client_model->insert_client($client_data);
            $response = array(
                'success' => true,
                'message' => 'Client ajouté avec succès.'
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function edit($id)
    {
        $data['client'] = $this->Client_model->get_client_by_id($id);
        $this->load->view('client/client_edit_form', $data);
    }

    public function update($id)
    {
        $client_data = array(
            'nomglobal' => $this->input->post('nomGlobal'),
            'email' => $this->input->post('email'),
            'adresse' => $this->input->post('adresse')
        );
        $this->Client_model->update_client($id, $client_data);
        redirect('client');
    }

    public function delete($id)
    {
        $this->Client_model->delete_client($id);
        redirect('client');
    }
}