<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ColSalaireController extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('collecteur/Col_Salaire_model');
    }
    public function getSalaire(){
        
    }
    public function save(){
        $this->form_validation->set_rules('prix', 'prix', 'required|numeric|greater_than[0]',
            array('required' => 'Le champ est obligatoire',
                'greater_than' => 'Le champ doit positif ',
                'numeric' => 'Le champ doit être un nombre')
            );
        $this->form_validation->set_rules('collecteur','collecteur','required',
            array('required'=> 'Le champ est obligatoire'));
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->model("collecteur/Collecteur_model", 'collecteur');
            $data["title"] = "Projet MM";
            $data["contents"]="pages/Collecteur/insert_salary";
            $data["collectors"] =  $this->collecteur->find_all();
            $this->load->view("templates/template",$data);
        } else {
            $collecteur = $this->input->post('collecteur');
            $amount = $this->input->post('prix');
            $date = $this->input->post('date');
            $date = $date? $date: date('Y-m-d');
            $this->Col_Salaire_model->save($date, $amount, $collecteur);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'success')));
            redirect("collecteur/insert_salary");
        }
    }
    public function find_all() {
        $data = $this->Col_Salaire_model->find_all();
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
    }

}