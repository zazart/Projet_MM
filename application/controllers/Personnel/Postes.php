<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// application/controllers/Postes.php
class Postes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Personnel/Poste_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['postes'] = $this->Poste_model->get_postes();
        $data['title'] = 'Liste des Postes';
        $data["etat"] = "personnel";
        $data["activer"] = "lien_postes";
        $data['contents'] = 'pages/Personnel/postes/liste';
        $this->load->view('templates/template', $data);
    }


    public function get_liste() {
        $employes = $this->Poste_model->get_postes();
        $response = array(
            'success' => true,
            'message' => 'Employé ajouté avec succès.',
            'employes' => $employes
        );

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
        
    }

    public function view($id_poste) {
        $data['poste'] = $this->Poste_model->get_postes($id_poste);

        if (empty($data['poste'])) {
            show_404();
        }

        $data['title'] = $data['poste']['nom'];

        $data["etat"] = "personnel";
        $data["activer"] = "lien_postes_create";
        $data['contents'] = 'pages/Personnel/postes/view';
        $this->load->view('templates/template', $data);
    }

    public function insert_postes() {            
        $data['title'] = 'Créer un nouveau poste';
        // $data['types_profil'] = $this->TypeProfil_model->get_types_profil();
        $data["etat"] = "personnel";
        $data["activer"] = "lien_postes_create";
        $data['contents'] = 'pages/Personnel/postes/create';
        $this->load->view('templates/template', $data);
    }

    public function create() {
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('montant_salaire', 'Salaire', 'required');

        if ($this->form_validation->run() === FALSE) {
            $errors = array(
                'nom' => form_error('nom'),
                'montant_salaire' => form_error('montant_salaire')
            );
            $response = array(
                'success' => false,
                'errors' => $errors
            );
    
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $date_debut = date('Y-m-d'); // Définir sur la date actuelle
            $nom = $this->input->post('nom');
            $montant_salaire = $this->input->post('montant_salaire');
            $id_poste = $this->Poste_model->insert_poste($nom, $montant_salaire);
            // Insérer le salaire
            $data_salaire = array(
                'id_poste' => $id_poste,
                'date_debut' => $date_debut,
                'montant_salaire' => $this->input->post('montant_salaire')
            );
            $this->Poste_model->insert_salaire($data_salaire);
            $response = array(
                'success' => true,
                'message' => 'Poste ajouté avec succès.'
            );

    
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function edit($id_poste) {
        $data['poste'] = $this->Poste_model->get_postes($id_poste);

        if (empty($data['poste'])) {
            show_404();
        }

        $data['title'] = 'Modifier le poste';

        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('montant_salaire', 'Salaire', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data["etat"] = "personnel";
            $data["activer"] = "lien_postes_create";
            $data["contents"]="pages/Personnel/postes/edit";
            $this->load->view("templates/template",$data);
        } else {
            $nom = $this->input->post('nom');
            $montant_salaire = $this->input->post('montant_salaire');
            $this->Poste_model->update_poste($id_poste, $nom, $montant_salaire);
            $date_debut = date('Y-m-d');
            // Insérer le salaire
            $data_salaire = array(
                'id_poste' => $id_poste,
                'date_debut' => $date_debut,
                'montant_salaire' => $this->input->post('montant_salaire')
            );
            $this->Poste_model->insert_salaire($data_salaire);

            $response = array(
                'success' => true,
                'message' => 'Poste modifié avec succès.',
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }

    }

    public function delete() {
        $id = $this->input->post('id');
        // Supprimer les salaires associés à ce poste
        $this->Poste_model->delete_salaire_by_poste($id);
        $this->Poste_model->delete_employe_by_poste($id);

        // Supprimer le poste
        $this->Poste_model->delete_poste($id);

        $response = array(
            'success' => true,
            'message' => 'Poste supprimer avec succès.'
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
?>