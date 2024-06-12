<!-- application/controllers/Presences.php -->
<?php
class Presences extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Presence_model');
    }

    public function index() {
        $data['presences'] = $this->Presence_model->get_presences();
        $data['title'] = 'Liste des Présences';

        $this->load->view('templates/header', $data);
        $this->load->view('presences/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($id_presence) {
        $data['presence'] = $this->Presence_model->get_presences($id_presence);

        if (empty($data['presence'])) {
            show_404();
        }

        $data['title'] = 'Détails de la Présence';

        $this->load->view('templates/header', $data);
        $this->load->view('presences/view', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->load->library('form_validation');

        $data['title'] = 'Ajouter une Présence';
        $data['employes'] = $this->Presence_model->get_employes();

        $this->form_validation->set_rules('id_employe', 'Employé', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('heure_arrivee', 'Heure d\'Arrivée', 'required');
        $this->form_validation->set_rules('heure_depart', 'Heure de Départ', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('presences/create', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'id_employe' => $this->input->post('id_employe'),
                'date' => $this->input->post('date'),
                'heure_arrivee' => $this->input->post('heure_arrivee'),
                'heure_depart' => $this->input->post('heure_depart')
            );

            $this->Presence_model->insert_presence($data);
            redirect('presences');
        }
    }

    public function edit($id_presence) {
        $this->load->library('form_validation');

        $data['presence'] = $this->Presence_model->get_presences($id_presence);
        $data['employes'] = $this->Presence_model->get_employes();

        if (empty($data['presence'])) {
            show_404();
        }

        $data['title'] = 'Modifier la Présence';

        $this->form_validation->set_rules('id_employe', 'Employé', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('heure_arrivee', 'Heure d\'Arrivée', 'required');
        $this->form_validation->set_rules('heure_depart', 'Heure de Départ', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('presences/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'id_employe' => $this->input->post('id_employe'),
                'date' => $this->input->post('date'),
                'heure_arrivee' => $this->input->post('heure_arrivee'),
                'heure_depart' => $this->input->post('heure_depart')
            );

            $this->Presence_model->update_presence($id_presence, $data);
            redirect('presences');
        }
    }

    public function delete($id_presence) {
        $this->Presence_model->delete_presence($id_presence);
        redirect('presences');
    }
}
?>
