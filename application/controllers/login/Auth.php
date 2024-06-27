<?php
class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('login/user_model');
    }

    public function login() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('pages/login/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $users = $this->user_model->get_user($email);

            foreach($users as $user) {
                if ($user && $password == $user['mot_de_passe']) {
                    $this->session->set_userdata('user', $user);
                    redirect(base_url("/admin/dashbord"));
                    exit;
                }
            }
            $data['error'] = 'Invalid email or password';
            $this->load->view("pages/login/login",$data);
        }
    }

    public function logout() {
        $this->session->unset_userdata('user');
        redirect(base_url('/'));
    }
}