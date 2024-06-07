<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depenses extends CI_Controller {
    public function formulaire(){
        $data["contents"]="pages/depenses/formulaire-depense";
		$this->load->view("templates/depenses",$data);
    }
}