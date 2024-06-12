<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collecteur extends CI_Controller {
    public function index(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/index";
		$this->load->view("templates/template",$data);
    }
    
    public function insert_bonus(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/insert_bonus";
		$this->load->view("templates/template",$data);
    }
    public function list_Collecteur()  {
        $this->load->model("collecteur/Collecteur_model", 'collecteur');
        return $this->collecteur->find_all();
    }        
    public function insert_collect(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/insert_collect";
        $data["collectors"] = $this->list_Collecteur();
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
        $data["collectors"] = $this->list_Collecteur();
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