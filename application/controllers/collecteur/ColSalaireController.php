<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ColSalaireController extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Col_Salaire_model');
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
            echo json_encode(array('error'=> validation_errors()));
        } else {
            $collecteur = $this->input->post('collecteur');
            $amount = $this->input->post('prix');
            $date = $this->input->post('date');
            $this->Col_Salaire_model->save($date, $amount, $collecteur);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'success')));
        }
    }
    public function find_all() {
        $data = $this->Col_Salaire_model->find_all();
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
    }

}