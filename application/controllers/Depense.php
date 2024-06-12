<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depense extends CI_Controller {
    // Access au formulaire d'insertion
    public function formulaire(){
        $data["contents"]="pages/depenses/formulaire-depense";
		$this->load->view("templates/template",$data);
    }

    // Access au liste de journal
    public function journal(){
        $data["contents"]="pages/depenses/journal";
		$this->load->view("templates/template",$data);
    }

    // Access au liste de journal
    public function grandLivre(){
        $data["contents"]="pages/depenses/grand-livre";
		$this->load->view("templates/template",$data);
    }
}