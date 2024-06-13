<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// application/controllers/Postes.php
class Postes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Poste_model');
    }

    public function index() {
        $data['postes'] = $this->Poste_model->get_postes();
        $data['title'] = 'Liste des Postes';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/Personnel/postes/liste', $data);
        $this->load->view('templates/footer');
    }

    public function view($id_poste) {
        $data['poste'] = $this->Poste_model->get_postes($id_poste);

        if (empty($data['poste'])) {
            show_404();
        }

        $data['title'] = $data['poste']['nom'];

        $this->load->view('templates/header', $data);
        $this->load->view('pages/Personnel/postes/view', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->load->library('form_validation');

        $data['title'] = 'Créer un nouveau poste';

        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('montant_salaire', 'Salaire', 'required');
        $this->form_validation->set_rules('duree_travail', 'Durée de Travail', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('pages/Personnel/postes/create');
            $this->load->view('templates/footer');
        } else {
            $nom = $this->input->post('nom');
            $montant_salaire = $this->input->post('montant_salaire');
            $duree_travail = $this->input->post('duree_travail');
            $this->Poste_model->insert_poste($nom, $montant_salaire, $duree_travail);
            redirect('postes');
        }
    }

    public function edit($id_poste) {
        $this->load->library('form_validation');

        $data['poste'] = $this->Poste_model->get_postes($id_poste);

        if (empty($data['poste'])) {
            show_404();
        }

        $data['title'] = 'Modifier le poste';

        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('montant_salaire', 'Salaire', 'required');
        $this->form_validation->set_rules('duree_travail', 'Durée de Travail', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('pages/Personnel/postes/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $nom = $this->input->post('nom');
            $montant_salaire = $this->input->post('montant_salaire');
            $duree_travail = $this->input->post('duree_travail');
            $this->Poste_model->update_poste($id_poste, $nom, $montant_salaire, $duree_travail);
            redirect('postes');
        }
    }

    public function delete($id_poste) {
        $this->Poste_model->delete_poste($id_poste);
        redirect('postes');
    }
}
?>