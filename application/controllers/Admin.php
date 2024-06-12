<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function index(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/login";
		$this->load->view("templates/template",$data);
    }
}
