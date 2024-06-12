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
    public function save(){
        $this->form_validation->set_rules('nom', 'nom', 'required',
            array('required' => 'Le champ est obligatoire'            )
        );
        $this->form_validation->set_rules('contact', 'contact', 'required|numeric',
            array('required' => 'Le champ est obligatoire',
                    'numeric' => 'Veuillez ne selectionner que des chiffres'         
        ));
        $this->form_validation->set_rules('adresse', 'adresse', 'required',
            array('required' => 'Le champ est obligatoire'            )
        );
        $this->form_validation->set_rules('date', 'date', 'required',
            array('required' => 'Le champ est obligatoire'            )
        );
        $this->form_validation->set_rules('genre', 'genre', 'required',
            array('required' => 'Le champ est obligatoire'            )
        );
        if ($this->form_validation->run() == FALSE) {
            $data["title"] = "Projet MM";
            $data["contents"]="pages/Collecteur/insert_collecteur";
            $this->load->view("templates/template",$data);
        } else {
            $nom = $this->input->post('nom');
            $contact = $this->input->post('contact');
            $adresse = $this->input->post('adresse');
            $date = $this->input->post('date');
            $genre = $this->input->post('genre');
            $this->Collecteur_model->save($nom,$contact,$adresse, $date, $genre);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'success')));

            redirect('collecteur/insert_collect');
        }
        
        
    }
}