<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// application/controllers/Genres.php
class Genres extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Genre_model');
    }

    public function index() {
        $data['genres'] = $this->Genre_model->get_genres();
        $data['title'] = 'Liste des Genres';

        $this->load->view('templates/header', $data);
        $this->load->view('genres/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($id) {
        $data['genre'] = $this->Genre_model->get_genres($id);

        if (empty($data['genre'])) {
            show_404();
        }

        $data['title'] = $data['genre']['description'];

        $this->load->view('templates/header', $data);
        $this->load->view('genres/view', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->load->library('form_validation');

        $data['title'] = 'Créer un nouveau genre';

        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('genres/create');
            $this->load->view('templates/footer');
        } else {
            $description = $this->input->post('description');
            $this->Genre_model->insert_genre($description);
            redirect('genres');
        }
    }

    public function edit($id) {
        $this->load->library('form_validation');

        $data['genre'] = $this->Genre_model->get_genres($id);

        if (empty($data['genre'])) {
            show_404();
        }

        $data['title'] = 'Modifier le genre';

        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('genres/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $description = $this->input->post('description');
            $this->Genre_model->update_genre($id, $description);
            redirect('genres');
        }
    }

    public function delete($id) {
        $this->Genre_model->delete_genre($id);
        redirect('genres');
    }
}


?>