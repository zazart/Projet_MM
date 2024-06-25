<?php defined('BASEPATH') or exit('No direct script access allowed');

class CollecteurController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('collecteur/Collecteur_model');
    }

    public function insert_collector()
    {
        $data["title"] = "Insertion Collecteur";
        $data["etat"] = "collecteur";
        $data["activer"] = "lien_collecteur";
        $data["contents"] = "pages/Collecteur/insert_collector";
        $this->load->view("templates/template", $data);
    }

    public function getliste_collecteurs()
    {
        $collecteurs = $this->Collecteur_model->get_collecteur();
        $response = array(
            'success' => true,
            'message' => 'Collecteur ajouté avec succès.',
            'collecteurs' => $collecteurs
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function update_collecteur($id)
    {
        $data["title"] = "Modifier Collecteur";
        $data["etat"] = "collecteur";
        $data["activer"] = "lien_collecteur";
        $data["contents"] = "pages/Collecteur/update_collecteur";
        $data["collecteur"] = $this->Collecteur_model->find_by_id($id);
        $this->load->view("templates/template", $data);
    }

    public function validation()
    {
        $this->form_validation->set_rules('nom', 'Nom', 'required', array('required' => 'Le champ nom est obligatoire'));
        $this->form_validation->set_rules('email', 'Email', 'required', array('required' => 'Le champ email est obligatoire'));
        $this->form_validation->set_rules('contact', 'Contact', 'required|numeric', array('required' => 'Le champ contact est obligatoire', 'numeric' => 'Veuillez ne sélectionner que des chiffres'));
        $this->form_validation->set_rules('adresse', 'Adresse', 'required', array('required' => 'Le champ adresse est obligatoire'));
        $this->form_validation->set_rules('date', 'Date', 'required', array('required' => 'Le champ date est obligatoire'));
        $this->form_validation->set_rules('genre', 'Genre', 'required', array('required' => 'Le champ genre est obligatoire'));
    }

    public function store()
    {
        $this->validation();

        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'nom' => form_error('nom'),
                'email' => form_error('email'),
                'contact' => form_error('contact'),
                'adresse' => form_error('adresse'),
                'date' => form_error('date'),
                'genre' => form_error('genre')
            );

            $response = array(
                'success' => false,
                'errors' => $errors
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $poste = 7;
            $collecteur_data = array(
                'embauche' => $this->input->post('date'),
                'nom' => $this->input->post('nom'),
                'email' => $this->input->post('email'),
                'telephone' => $this->input->post('contact'),
                'adresse' => $this->input->post('adresse'),
                'id_genre' => $this->input->post('genre'),
                'id_poste' => $poste
            );

            $this->Collecteur_model->save($collecteur_data);

            $response = array(
                'success' => true,
                'message' => 'Collecteur ajouté avec succès.',
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
                'nom' => form_error('nom'),
                'email' => form_error('email'),
                'contact' => form_error('contact'),
                'adresse' => form_error('adresse'),
                'date' => form_error('date'),
                'genre' => form_error('genre')
            );

            $response = array(
                'success' => false,
                'errors' => $errors
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $id = $this->input->post('id_employe');
            $poste = 7;
            $collecteur_data = array(
                'embauche' => $this->input->post('date'),
                'nom' => $this->input->post('nom'),
                'email' => $this->input->post('email'),
                'telephone' => $this->input->post('contact'),
                'adresse' => $this->input->post('adresse'),
                'id_genre' => $this->input->post('genre'),
                'id_poste' => $poste
            );

            $this->Collecteur_model->update_collecteur($id, $collecteur_data);

            $response = array(
                'success' => true,
                'message' => 'Collecteur ajouté avec succès.',
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Collecteur_model->delete_collecteur($id);
        $response = array(
            'success' => true,
            'message' => 'Collecteur supprimer avec succès.'
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
