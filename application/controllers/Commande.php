<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commande extends CI_Controller {
    public function insert_commande(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/Commande/insert_commande";
		$this->load->view("templates/template",$data);
    }
}