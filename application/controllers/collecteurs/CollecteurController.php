<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CollecteurController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('collecteur/Collecteur_model');
    }
    public function find_all(){
        $collecteur = $this->Collecteur_model->find_all();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($collecteur));
    }    
    public function edit (){
        $id = $this->input->get('id');       
        $data["collecteur"] = $this->Collecteur_model->find_by_id($id);
        $data["title"] = "Projet MM";
        $data["contents"]="pages/Collecteur/modify_collector";
        $this->load->view("templates/template",$data);
    }

    public function insert_collector(){
        $data["title"] = "Insertion Collecteur";
        $data["etat"] = "collecteur";
        $data["activer"] = "lien_collecteur";
		$data["contents"]="pages/Collecteur/insert_collector";
		$this->load->view("templates/template",$data);
    }

    public function liste(){
        $data["title"] = "Liste";
        $data["etat"] = "collecteur";
        $data["activer"] = "lien_liste";
		$data["contents"]="pages/Collecteur/liste";
		$this->load->view("templates/template",$data);
    }


    public function update() {
        $this->validation();
        if ($this->form_validation->run() == FALSE) {
            $this->edit();
        } else {
            $id = $this->input->post("id");
            $nom = $this->input->post('nom');
            $contact = $this->input->post('contact');
            $adresse = $this->input->post('adresse');
            $date = $this->input->post('date');
            $genre = $this->input->post('genre');
            $this->Collecteur_model->update($id, $nom,$contact,$adresse, $date, $genre);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'success')));

            redirect('collecteur/list_Collector');
        }
    }

    public function redirection(){
        $id = $this->input->post("id");
        $data["title"] = "Modifier Collecteur";
        $data["etat"] = "collecteur";
        $data["activer"] = "lien_collecteur";
		$data["contents"]="pages/Collecteur/modify_collector";
        $data["collecteur"]=$this->Collecteur_model->find_by_id($id);
		$this->load->view("templates/template",$data);
    }

public function validation() {
    $this->form_validation->set_rules('nom', 'Nom', 'required', array('required' => 'Le champ nom est obligatoire'));
    $this->form_validation->set_rules('contact', 'Contact', 'required|numeric', array('required' => 'Le champ contact est obligatoire', 'numeric' => 'Veuillez ne sélectionner que des chiffres'));
    $this->form_validation->set_rules('adresse', 'Adresse', 'required', array('required' => 'Le champ adresse est obligatoire'));
    $this->form_validation->set_rules('date', 'Date', 'required', array('required' => 'Le champ date est obligatoire'));
    $this->form_validation->set_rules('genre', 'Genre', 'required', array('required' => 'Le champ genre est obligatoire'));
}

public function save() {
    $this->validation();

    if ($this->form_validation->run() == FALSE) {
        $errors = array(
            'nom' => form_error('nom'),
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
        $collecteur_data = array(
            'nom' => $this->input->post('nom'),
            'contact' => $this->input->post('contact'),
            'adresse' => $this->input->post('adresse'),
            'datedebuche' => $this->input->post('date'),
            'id_genre' => $this->input->post('genre')
        );

        $this->Collecteur_model->save($collecteur_data);
        $collecteurs = $this->Collecteur_model->find_all();

        $response = array(
            'success' => true,
            'message' => 'Collecteur ajouté avec succès.',
            'collecteurs' => $collecteurs
        );

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}

}