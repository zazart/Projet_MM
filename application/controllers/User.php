<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function checkLogin()
    {
        $username = $this->input->post('email');
        $mdp = $this->input->post('mot_de_passe');

        // Check if the user exists
        $user = $this->User_Model->checkLogin($username);

        if ($user == null || $user['mdp'] != sha1($mdp)) {
            // Redirect to login page
            $this->load->view('');
        } else {
            // Set user session, correspondig to the type of its profile
            // Still should retrieve it from the database
            $this->session->set_userdata($user['type_profil'], $user);

            // Redirect to home page
            redirect('');
        }
    }
}