<?php defined('BASEPATH') or exit('No direct script access allowed');

class BonusController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('collecteur/Bonus_model');
    }

    public function insert_bonus()
    {
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Insertion Bonus";
        $data["contents"] = "pages/Collecteur/insert_bonus";
        $data["etat"] = "collecteur";
        $data["activer"] = "lien_bonus";
        $this->load->view("templates/template", $data);
    }

    public function getliste_bonus()
    {
        $bonus = $this->Bonus_model->find_all();
        $response = array(
            'success' => true,
            'message' => 'Bonus ajouté avec succès.',
            'bonus' => $bonus
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function validation()
    {
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric', array('required' => 'Le champ montant est obligatoire', 'numeric' => 'Veuillez ne sélectionner que des chiffres'));
        $this->form_validation->set_rules('date', 'Date', 'required', array('required' => 'Le champ date de bonus est obligatoire'));
    }

    public function update_bonus($id)
    {
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Modifier Bonus";
        $data["etat"] = "collecteur";
        $data["activer"] = "lien_bonus";
        $data["contents"] = "pages/Collecteur/update_bonus";
        $data["bonus"] = $this->Bonus_model->find_by_id($id);
        $this->load->view("templates/template", $data);
    }

    public function store()
    {
        $this->validation();
        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'amount' => form_error('amount'),
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
            $bonus_data = array(
                'datedebut' => $this->input->post('date'),
                'amount' => $this->input->post('amount')
            );

            $this->Bonus_model->save($bonus_data);

            $response = array(
                'success' => true,
                'message' => 'Bonus ajouté avec succès.',
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
                'amount' => form_error('amount'),
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
            $id = $this->input->post('id_bonus');
            $bonus_data = array(
                'datedebut' => $this->input->post('date'),
                'amount' => $this->input->post('amount')
            );

            $this->Bonus_model->update_bonus($id, $bonus_data);

            $response = array(
                'success' => true,
                'message' => 'Bonus modifié avec succès.',
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Bonus_model->delete_bonus($id);
        $response = array(
            'success' => true,
            'message' => 'Bonus supprimer avec succès.'
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
