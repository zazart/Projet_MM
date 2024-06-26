<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata("user") == null) {
            redirect(base_url("login/auth/login"));
        }
    }

    public function index(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/home";
        $data["etat"] = "";
        $data["activer"] = "";
		$this->load->view("templates/template",$data);
    }
}
?>