<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// application/controllers/Employes.php
class Employes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Personnel/Employe_model');
        $this->load->model('Personnel/Profil_model'); // Charger le modèle Profil
        $this->load->model('Personnel/TypeProfil_model'); // Charger le modèle TypeProfil
        $this->load->model('Personnel/Genre_model'); 
        $this->load->model('Personnel/Poste_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['employes'] = $this->Employe_model->get_employes();
        $data['title'] = 'Liste des Employés';

        $data["etat"] = "personnel";
        $data["activer"] = "lien_employes";
        $data["contents"]="pages/Personnel/employes/liste";
        $this->load->view("templates/template",$data);
    }

    public function get_liste() {
        $employes = $this->Employe_model->get_employes();
        $response = array(
            'success' => true,
            'employes' => $employes
        );

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
        
    }

    public function view($id_employe) {
        $data['employe'] = $this->Employe_model->get_employes($id_employe);

        if (empty($data['employe'])) {
            show_404();
        }
        $data['title'] = 'Détails de l\'Employé';

        $data["etat"] = "personnel";
        $data["activer"] = "_";
        $data["contents"]="pages/Personnel/employes/view";
        $this->load->view("templates/template",$data);
        
    }

    public function insert_employes() {            
        $data['title'] = 'Créer un nouvel Employé';
        $data['genres'] = $this->Employe_model->get_genres();
        $data['postes'] = $this->Employe_model->get_postes();
        $data['types_profil'] = $this->TypeProfil_model->get_types_profil();

        $data["etat"] = "personnel";
        $data["activer"] = "lien_employes_create";
        $data['contents'] = 'pages/Personnel/employes/create';
        $this->load->view('templates/template', $data);
    }

    public function create() {

        $this->form_validation->set_rules('embauche', 'Date d\'Embauche', 'required');
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Mot de passe', 'required');
        $this->form_validation->set_rules('telephone', 'Numéro de Téléphone', 'required');
        $this->form_validation->set_rules('adresse', 'Adresse', 'required');
        $this->form_validation->set_rules('id_genre', 'Genre', 'required');
        $this->form_validation->set_rules('id_poste', 'Poste', 'required');

        if ($this->form_validation->run() === FALSE) {
            $errors = array(
                'embauche' => form_error('embauche'),
                'nom' => form_error('nom'),
                'email' => form_error('email'),
                'password' => form_error('password'),
                'telephone' => form_error('telephone'),
                'adresse' => form_error('adresse'),
                'id_genre' => form_error('id_genre'),
                'id_poste' => form_error('id_poste'),
                'type_profil' => form_error('type_profil')
            );
            $response = array(
                'success' => false,
                'errors' => $errors
            );
    
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));

        } else {
            $debauche = $this->input->post('debauche');
            $employes_data = array(
                'embauche' => $this->input->post('embauche'),
                'debauche' => $debauche ? $debauche : NULL,
                'nom' => $this->input->post('nom'),
                'email' => $this->input->post('email'),
                'telephone' => $this->input->post('telephone'),
                'adresse' => $this->input->post('adresse'),
                'id_genre' => $this->input->post('id_genre'),
                'id_poste' => $this->input->post('id_poste')
            );
            $id_employe = $this->Employe_model->insert_employe($employes_data);


            // Insérer dans la table Profil
            $email = $this->input->post('email');
            $mot_de_passe = $this->input->post('password');
            $type_profil = $this->input->post('type_profil');

            $this->Profil_model->insert_profil($email, $mot_de_passe, $id_employe, $type_profil); 

            $response = array(
                'success' => true,
                'message' => 'Employé ajouté avec succès.'
            );

    
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function edit($id_employe) {

        $data['employe'] = $this->Employe_model->get_employes($id_employe);
        $data['genres'] = $this->Employe_model->get_genres();
        $data['postes'] = $this->Employe_model->get_postes();

        if (empty($data['employe'])) {
            show_404();
        }

        $data['title'] = 'Modifier l\'Employé';

        $this->form_validation->set_rules('embauche', 'Date d\'Embauche', 'required');
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('telephone', 'Numéro de Téléphone', 'required');
        $this->form_validation->set_rules('adresse', 'Adresse', 'required');
        $this->form_validation->set_rules('id_genre', 'Genre', 'required');
        $this->form_validation->set_rules('id_poste', 'Poste', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data["etat"] = "personnel";
            $data["activer"] = "lien_employes_create";
            $data["contents"]="pages/Personnel/employes/edit";
            $this->load->view("templates/template",$data);
        } else {
            $debauche = $this->input->post('debauche');
            $data = array(
                'embauche' => $this->input->post('embauche'),
                'debauche' => $debauche ? $debauche : NULL,
                'nom' => $this->input->post('nom'),
                'email' => $this->input->post('email'),
                'telephone' => $this->input->post('telephone'),
                'adresse' => $this->input->post('adresse'),
                'id_genre' => $this->input->post('id_genre'),
                'id_poste' => $this->input->post('id_poste')
            );
            $this->Employe_model->update_employe($id_employe, $data);
            
            $response = array(
                'success' => true,
                'message' => 'Employé modifié avec succès.',
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function delete($id_employe) {
        $this->Employe_model->delete_profil_employe_by_employe($id_employe);
        $this->Employe_model->delete_employe($id_employe);
        redirect('Personnel/employes');
    }


    public function form() {
        $data['title'] = 'Recherche des employés';

        $data["etat"] = "personnel";
        $data["activer"] = "lien_employes_create";
        $data['contents']='pages/Personnel/employes/search';
        $data['genres']=$this->Genre_model->get_genres();
        $data['postes']=$this->Poste_model->get_postes();
        $this->load->view('templates/template', $data);
    }

    public function search() {
        // Récupérer les critères de recherche à partir du formulaire de recherche
        $criteria = array(
            'debut_embauche' => $this->input->post('debut_embauche'),
            'fin_embauche' => $this->input->post('fin_embauche'),
            'nom' => $this->input->post('nom'),
            'id_genre' => $this->input->post('id_genre'),
            'id_poste' => $this->input->post('id_poste')
        );

        // // Supprimer les critères vides
        $criteria = array_filter($criteria);ù

        $employes = $this -> Employe_model->search_employes($criteria);
        $response = array(
            'success' => true,
            'message' => 'Employé ajouté avec succès.',
            'employes' => $employes
        );

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
    }
}
?>