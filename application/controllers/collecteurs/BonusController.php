<?php defined('BASEPATH') OR exit('No direct script access allowed');

class BonusController extends CI_Controller {
    public function __construct(){
        parent::__construct();
         $this->load->model('collecteur/Bonus_model');
    }
    public function find_all(){
        $bonuses = $this->Bonus_model->find_all();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($bonuses));
    }
    public function save(){
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric|greater_than[0]',
            array('required' => 'Le champ est obligatoire',
                'greater_than' => 'Le champ doit positif ',
                'numeric' => 'Le champ doit être un nombre'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $this->load->model("collecteur/Collecteur_model");
            $data["title"] = "Projet MM";
            $data["contents"]="pages/Collecteur/insert_bonus";
            $this->load->view("templates/template",$data);
        } else {
            $date = $this->input->post('date');
            $amount = $this->input->post('amount');
            $date = $date? $date: date('Y-m-d');
            $this->Bonus_model->save($date, $amount);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'success')));
            redirect('collecteur/insert_bonus');        
        }
    }
}
