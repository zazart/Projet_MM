<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collecteur extends CI_Controller {
    public function index(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/index";
		$this->load->view("templates/template",$data);
    }
    
    public function insert_bonus(){
        $this->load->model("collecteur/Collecteur_model");
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/insert_bonus";
        // $data["collecteurs"] = $this->Collecteur_model->find_all();
		$this->load->view("templates/template",$data);

    }
    
    public function insert_collect(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/insert_collect";
		$this->load->view("templates/template",$data);
    }
    
    public function insert_collector(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/insert_collector";
		$this->load->view("templates/template",$data);
    }
    
    public function insert_salary(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/insert_salary";
		$this->load->view("templates/template",$data);
    }
    
    public function payement(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/payement";
		$this->load->view("templates/template",$data);
    }
    
    public function state(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/state";
		$this->load->view("templates/template",$data);
    }
}