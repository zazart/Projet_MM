<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// application/controllers/Employes.php
class Employes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Employe_model');
    }

    public function index() {
        $data['employes'] = $this->Employe_model->get_employes();
        $data['title'] = 'Liste des Employés';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/Personnel/employes/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($id_employe) {
        $data['employe'] = $this->Employe_model->get_employes($id_employe);

        if (empty($data['employe'])) {
            show_404();
        }

        $data['title'] = 'Détails de l\'Employé';

        $this->load->view('templates/header', $data);
        $this->load->view('employes/view', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->load->library('form_validation');

        $data['title'] = 'Créer un nouvel Employé';
        $data['genres'] = $this->Employe_model->get_genres();
        $data['postes'] = $this->Employe_model->get_postes();

        $this->form_validation->set_rules('embauche', 'Date d\'Embauche', 'required');
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('telephone', 'Numéro de Téléphone', 'required');
        $this->form_validation->set_rules('adresse', 'Adresse', 'required');
        $this->form_validation->set_rules('id_genre', 'Genre', 'required');
        $this->form_validation->set_rules('id_poste', 'Poste', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('pages/Personnel/employes/_create', $data);
            $this->load->view('templates/footer');
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
            $this->Employe_model->insert_employe($data);
            redirect('employes');
        }
    }

    public function edit($id_employe) {
        $this->load->library('form_validation');

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
            $this->load->view('templates/header', $data);
            $this->load->view('employes/edit', $data);
            $this->load->view('templates/footer');
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
            redirect('employes');
        }
    }

    public function delete($id_employe) {
        $this->Employe_model->delete_employe($id_employe);
        redirect('employes');
    }
}
?>