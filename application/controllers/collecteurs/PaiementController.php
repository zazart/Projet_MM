<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PaiementController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('collecteur/PaiementCollecteur_model','paiement');
    }
    public function find_all() {
        $data  = $this->paiement->find_all();
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));

    }

    public function save() {
        $this->form_validation->set_rules('collecteur', 'collecteur', 'required',
            array('required' => 'Le champ est obligatoire' )
        );
        $this->form_validation->set_rules('type', 'type', 'required',
            array('required' => 'Le champ est obligatoire' )
        );
        if ($this->form_validation->run() == FALSE) {
            $this->load->model("collecteur/Collecteur_model", 'collecteur');
            $data["title"] = "Projet MM";
            $data["contents"]="pages/Collecteur/payement";
            $data["collectors"] = $this->collecteur->find_all();
            $this->load->view("templates/template",$data);
        } else {
            $collecteur = $this->input->post('collecteur');
            $type = $this->input->post('type');
            $date = $this->input->post('date');
            $date = ($date) ? $date : date('Y-m-d'); 
            $this->paiement->save($collecteur,$type, $date);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'success')));
            redirect("collecteur/payement");
        }

    }

}