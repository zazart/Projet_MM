<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transformation_Controller extends CI_Controller {
    public function insert_machine(){
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Projet MM ";
		$data["contents"]="pages/Transformation/insert_machine";
		$this->load->view("templates/template",$data);
    }

    public function insert_etat_machine(){
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Transformation/insert_etat_machine";
		$this->load->view("templates/template",$data);
    }
    // liste_etat_machines
    public function insert_production(){
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Transformation/insert_production";
		$this->load->view("templates/template",$data);
    }

    public function insert_produit(){
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Transformation/insert_produit";
		$this->load->view("templates/template",$data);
    }

    public function liste_machines(){
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Transformation/liste_machines";
		$this->load->view("templates/template",$data);
    }

    public function liste_etat_machines(){
        $user = $this->session->userdata('user');
        $data["user"] = $user;
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Transformation/liste_etat_machines";
		$this->load->view("templates/template",$data);
    }
}