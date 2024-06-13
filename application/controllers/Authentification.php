<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Controller that handles the authentification, every other controllers should extends this
class User extends CI_Controller {
    function __construct(){
        parent::__construct();

        // Check if there's an existing session, if not, redirect to index
        if(!$this->session->userdata('admin') || !$this->session->userdata('collecteur')){
            redirect(base_url());
        }  
    }

    
}