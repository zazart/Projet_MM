<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CollecteurController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Collecteur_model');
    }
    public function find_all(){
        $collecteur = $this->Collecteur_model->find_all();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($collecteur));
    }
    public function save(){
        
    }
}