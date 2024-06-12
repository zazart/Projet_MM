<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('vente_commande/Client_model');
    }

    public function index() {
        $data['clients'] = $this->Client_model->get_clients();
        $this->load->view('client/client_list', $data);
    }

    public function insert_client(){
        $data["title"] = "Projet MM";
		$data["contents"]="pages/client/insert_client";
		$this->load->view("templates/template",$data);
    }

    public function store() {
        $client_data = array(
            'nomglobal' => $this->input->post('nomGlobal'),
            'email' => $this->input->post('email'),
            'adresse' => $this->input->post('adresse')
        );
        $this->Client_model->insert_client($client_data);
        redirect('client');
    }

    public function edit($id) {
        $data['client'] = $this->Client_model->get_client_by_id($id);
        $this->load->view('client/client_edit_form', $data);
    }

    public function update($id) {
        $client_data = array(
            'nomglobal' => $this->input->post('nomGlobal'),
            'email' => $this->input->post('email'),
            'adresse' => $this->input->post('adresse')
        );
        $this->Client_model->update_client($id, $client_data);
        redirect('client');
    }

    public function delete($id) {
        $this->Client_model->delete_client($id);
        redirect('client');
    }
}
?>
