<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depense extends CI_Controller {
    // Access au formulaire d'insertion
    public function formulaire(){
        $this->load->model('Categorie_model');
        $this->load->model('ModeDePaiement_model');
        $data["contents"]="pages/depenses/formulaire-depense";
        $data["categories"] = $this->Categorie_model->get_categories();
        $data["modePaiements"] = $this->ModeDePaiement_model->get_mode_de_paiements();
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