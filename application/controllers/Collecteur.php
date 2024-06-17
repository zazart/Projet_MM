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
    public function list_bonus(){
        $this->load->model("collecteur/Bonus_model", 'bonus');
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/list_bonus";
        $data["bonus"]=$this->bonus->find_all();
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
    public function list_collect(){
        $this->load->model("collecteur/Collect_model", 'collect');
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/list_collect";
        $data["collects"] = $this->collect->find_all();
		$this->load->view("templates/template",$data);
    }
    
    public function insert_collector(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/insert_collector";
		$this->load->view("templates/template",$data);
    }
    public function list_collector(){
        $data["collector"] = $this->list_Collecteur();
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/list_collector";
		$this->load->view("templates/template",$data);
    }
    
    public function insert_salary(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/insert_salary";
        $data["collectors"] = $this->list_Collecteur();
		$this->load->view("templates/template",$data);
    }
    public function list_salary(){
        $this->load->model("collecteur/Col_salaire_model", 'salary');
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/list_salary";
        $data["salary"] = $this->salary->find_all();
		$this->load->view("templates/template",$data);
    }
    
    public function payement(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/payement";
        $data["collectors"] = $this->list_Collecteur();
		$this->load->view("templates/template",$data);
    }
    public function list_payement(){
        $this->load->model("collecteur/PaiementCollecteur_model", 'paiement');
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/list_payement";
        $data["paiement"] = $this->paiement->find_all();
		$this->load->view("templates/template",$data);
    }
    
    public function state(){
        $this->load->model("collecteur/etat_model", 'etat');
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Collecteur/state";
        $prediction = array(2002,230,6000); /// prediction
        $data['etat'] = $this->etat->etat_general(date("Y"), $prediction);
        // var_dump($data['etat']);
		$this->load->view("templates/template",$data);
    }
}