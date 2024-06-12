<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function bonus(){
        $this->load->view('bonus');
    } 
    public function index(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/home";
		$this->load->view("templates/template",$data);
    }
}
