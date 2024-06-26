<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transformation_Controller extends CI_Controller {
    public function insert_machine(){
        $data["title"] = "Projet MM ";
		$data["contents"]="pages/Transformation/insert_machine";
		$this->load->view("templates/template",$data);
    }

    public function insert_etat_machine(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Transformation/insert_etat_machine";
		$this->load->view("templates/template",$data);
    }
    // liste_etat_machines
    public function insert_production(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Transformation/insert_production";
		$this->load->view("templates/template",$data);
    }

    public function insert_produit(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Transformation/insert_produit";
		$this->load->view("templates/template",$data);
    }

    public function liste_machines(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Transformation/liste_machines";
		$this->load->view("templates/template",$data);
    }

    public function liste_etat_machines(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Transformation/liste_etat_machines";
		$this->load->view("templates/template",$data);
    }
}