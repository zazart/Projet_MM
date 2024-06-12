<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CollectController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('collecteur/Collect_model');
    }
    public function find_all(){
        $data = $this->Collect_model->find_all();
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
    } 

    public function update () {
        $this->validation();
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('error'=> validation_errors()));
        } else {
            $id = $this->input->post('id');
            $matiere = $this->input->post('matiere');
            $qtt = $this->input->post('qtt');
            $collecteur = $this->input->post('collecteur');
            $date = $this->input->post('date');
            $this->Collect_model->update($id, $date, $qtt, $matiere, $collecteur);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'success')));
        }
    }
    public function save(){
        $this->validation();
        if ($this->form_validation->run() == FALSE) {
            $this->load->model("collecteur/Collecteur_model", 'collecteur');
            $data["title"] = "Projet MM";
            $data["contents"]="pages/Collecteur/insert_collect";
            $data["collectors"] = $this->collecteur->find_all();
            $this->load->view("templates/template",$data);
        } else {
            $matiere = $this->input->post('matiere');
            $qtt = $this->input->post('qtt');
            $collecteur = $this->input->post('collecteur');
            $date = $this->input->post('date');
            $date = $date? $date: date('Y-m-d');
            $this->Collect_model->save($date, $qtt, $matiere, $collecteur);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'success')));
                echo json_encode(array('message' => 'success'));
            redirect('collecteur/insert_collect');
        }
    }
public function validation () {
    $this->form_validation->set_rules('matiere', 'matiere', 'required',
            array('required' => 'Le champ %s est obligatoire')
    );
    $this->form_validation->set_rules('qtt', 'qtt', 'required|numeric|greater_than[0]',
        array('required' => 'Le champ %s est obligatoire',
                'numeric' => 'Veuillez ne selectionner que des chiffres',
                'greater_than' => 'Le champ %s doit positif '
    ));
    // $this->form_validation->set_rules('date', 'date', 'required',
    //     array('required' => 'Le champ %s est obligatoire'            )
    // );
    $this->form_validation->set_rules('collecteur', 'collecteur', 'required',
        array('required' => 'Le champ %s est obligatoire' )
    );
}
}
