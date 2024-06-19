<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CollectController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('collecteur/Collect_model');
        $this->load->model("collecteur/Collecteur_model", 'collecteur');
    }
    public function find_all(){
        $data = $this->Collect_model->find_all();
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
    } 
    public function edit(){
        $id = $this->input->get('id');
        $data['collect'] = $this->Collect_model->find_by_id($id);
        $data["title"] = "Projet MM";
        $data["contents"]="pages/Collecteur/modify_collect";
        $data["collectors"] = $this->collecteur->find_all();
        $this->load->view("templates/template",$data);
    }

    public function insert_collect(){
        $data["title"] = "Insertion Collect";
		$data["contents"]="pages/Collecteur/insert_collect";
        $data["etat"] = "collecteur";
        $data["activer"] = "lien_collect";
        $data["collectors"]=$this->collecteur->find_all();
		$this->load->view("templates/template",$data);
    }

    public function update () {
        $this->validation();
        if ($this->form_validation->run() == FALSE) {
            $this->edit();
        } else {
            $id = $this->input->post('id');
            $matiere = $this->input->post('matiere');
            $qtt = $this->input->post('qtt');
            $collecteur = $this->input->post('collecteur');
            $date = $this->input->post('date');
            $date = $date? $date: date('Y-m-d');
            $this->Collect_model->update($id, $date, $qtt, $matiere, $collecteur);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'success')));
            redirect('collecteur/list_collect');
        }
    }


    public function save(){
        $this->validation();

        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'collecteur' => form_error('collecteur'),
                'matiere' => form_error('matiere'),
                'qtt' => form_error('qtt')
            );
    
            $response = array(
                'success' => false,
                'errors' => $errors
            );
    
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $collect_data = array(
                'id_collecteur' => $this->input->post('collecteur'),
                'id_matierpremier' => $this->input->post('matiere'),
                'qtt' => $this->input->post('qtt')
            );
    
            $this->Collect_model->save($collect_data);
            $collects = $this->Collect_model->find_all();
    
            $response = array(
                'success' => true,
                'message' => 'Collect ajouté avec succès.',
                'collects' => $collects
            );
    
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }


    public function validation () {
        $this->form_validation->set_rules('matiere', 'matiere', 'required',
                array('required' => 'Le champ %s est obligatoire')
        );
        $this->form_validation->set_rules('qtt', 'qtt', 'required|numeric|greater_than[0]',
            array('required' => 'Le champ quantite est obligatoire',
                    'numeric' => 'Veuillez ne selectionner que des chiffres',
                    'greater_than' => 'Le champ quantite doit positif '
        ));
        $this->form_validation->set_rules('collecteur', 'collecteur', 'required',
            array('required' => 'Le champ %s est obligatoire' )
        );
    }
}
