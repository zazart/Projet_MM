<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CollectController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('collecteur/Collect_model');
        $this->load->model("collecteur/Collecteur_model");
    }

    public function insert_collect()
    {
        $data["title"] = "Insertion Collect";
        $data["contents"] = "pages/Collecteur/insert_collect";
        $data["etat"] = "collecteur";
        $data["activer"] = "lien_collect";
        $data["collectors"] = $this->Collecteur_model->get_collecteur();
        $data["matierepremiers"] = $this->Collect_model->get_matiere_premiere();
        $this->load->view("templates/template", $data);
    }

    public function getliste_collect()
    {
        $collects = $this->Collect_model->get_collect();
        $response = array(
            'success' => true,
            'message' => 'Collect ajouté avec succès.',
            'collects' => $collects
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function validation()
    {
        $this->form_validation->set_rules('collecteur', 'Collecteur', 'required', array('required' => 'Le champ collecteur est obligatoire'));
        $this->form_validation->set_rules('matiere', 'Matiere', 'required', array('required' => 'Le champ matiere premier est obligatoire'));
        $this->form_validation->set_rules('qtt', 'Qtt', 'required|numeric', array('required' => 'Le champ quantite est obligatoire', 'numeric' => 'Veuillez ne sélectionner que des chiffres'));
        $this->form_validation->set_rules('date', 'Date', 'required', array('required' => 'Le champ date de collect est obligatoire'));
    }

    public function update_collect($id)
    {
        $data["title"] = "Modifier Collect";
        $data["etat"] = "collecteur";
        $data["activer"] = "lien_collecteur";
        $data["contents"] = "pages/Collecteur/update_collect";
        $data["collectors"] = $this->Collecteur_model->get_collecteur();
        $data["matierepremiers"] = $this->Collect_model->get_matiere_premiere();
        $data["collect"] = $this->Collect_model->find_by_id($id);
        $this->load->view("templates/template", $data);
    }

    public function store()
    {
        $this->validation();
        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'collecteur' => form_error('collecteur'),
                'matiere' => form_error('matiere'),
                'qtt' => form_error('qtt'),
                'date' => form_error('date')
            );

            $response = array(
                'success' => false,
                'errors' => $errors
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $collect_data = array(
                'datecollect' => $this->input->post('date'),
                'qtt' => $this->input->post('qtt'),
                'id_employe' => $this->input->post('collecteur'),
                'id_matierepremier' => $this->input->post('matiere')
            );

            $this->Collect_model->save($collect_data);

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
                'collecteur' => form_error('collecteur'),
                'matiere' => form_error('matiere'),
                'qtt' => form_error('qtt'),
                'date' => form_error('date')
            );

            $response = array(
                'success' => false,
                'errors' => $errors
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $id = $this->input->post('id_collects');
            $collect_data = array(
                'datecollect' => $this->input->post('date'),
                'qtt' => $this->input->post('qtt'),
                'id_employe' => $this->input->post('collecteur'),
                'id_matierepremier' => $this->input->post('matiere')
            );

            $this->Collect_model->update_collect($id, $collect_data);

            $response = array(
                'success' => true,
                'message' => 'Collect modifié avec succès.',
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Collect_model->delete_collect($id);
        $response = array(
            'success' => true,
            'message' => 'Collect supprimer avec succès.'
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
