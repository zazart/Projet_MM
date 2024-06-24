<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depense extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Depense_model');
        $this->load->helper(array('form', 'url'));
        // $this->load->library('session');
    }

    // Access to the insertion form
    public function formulaire() {
        if($this->Depense_model->get_pcg() == null){
            $this->Depense_model->generatePcg();
        }
        $data["categories"] = $this->Depense_model->get_categories();
        // $data["categories"] = [];
        $data["modes_de_paiement"] = $this->Depense_model->get_modes_de_paiement();
        // $data["modes_de_paiement"] = [];
        $data["pcg"]= $this->Depense_model->get_pcg();
        // $data["pcg"]= [];
        $data["contents"] = "pages/depenses/formulaire-depense";
        // Activation de lien
        $data['etat'] = 'depense';
        $data['activer'] = 'formulaire_depense';
        $this->load->view("templates/template", $data);
    }

    // Method to fetch subcomptes based on selected PCG
    public function get_subcomptes($pcg_id) {
        $subcomptes = $this->Depense_model->get_subcomptes_by_pcg($pcg_id);
        $response = array(
            'success' => true,
            'message' => 'Recuperation des categorie par idPcg',
            'categories' => $subcomptes
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    
    public function listDepense(){
        $data['depenses'] = $this->Depense_model->get_depense();
        $data["contents"] = "pages/depenses/liste-depense";
        // Activation de lien
        $data['etat'] = 'depense';
        $data['activer'] = 'list_depense';
        $this->load->view("templates/template", $data);
    }
    public function getListDepenses(){
        $response = array(
            'success' => true,
            'depenses' => $this->Depense_model->get_depense()
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }


    // Handle the form submission and insert data into the Depense table
    public function create() {
        $data = array(
            'description' => $this->input->post('description'),
            'montant' =>  $this->input->post('montant'),
            'datedepense' =>  $this->input->post('dateDepense'),
            'justificatif' =>  $this->input->post('justification'),
            'id_modepaiment' => $this->input->post('id_ModePaiment'),
            'id_sub_comptes' => $this->input->post('id_Categorie')
        );
        // Handle file upload for justificatif
        if (!empty($_FILES['justificatif']['name'])) {
            $upload = $this->upload_file('justificatif');
            if ($upload['status']) {
                $data['justificatif'] = file_get_contents($upload['file_path']);
            } else {
                // Handle file upload error
                // $this->session->set_flashdata('error', $upload['error']);
               
                redirect('depense/formulaire');
            }
        }
        $response = array(
            'success' => false
        );
        if ($this->Depense_model->insert_depense($data)) {
            // echo ("ok be");
            $response = array(
                'success' => true,
                'message' => 'Client ajouté avec succès.',
                'depenses' => $this->Depense_model->get_depense()
            );
            // $this->session->set_flashdata('success', 'Dépense insérée avec succès.');
        } else {
            // echo("tsia");
            // $this->session->set_flashdata('error', 'Échec de l\'insertion de la dépense.');
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    // File upload handling
    private function upload_file($field_name) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($field_name)) {
            $file_data = $this->upload->data();
            return array('status' => true, 'file_path' => $file_data['full_path']);
        } else {
            return array('status' => false, 'error' => $this->upload->display_errors());
        }
    }
    public function journal() {
        redirect("journal/index");
    }

    // Access to the grand livre list
    public function grandLivre() {
        $data["contents"] = "pages/depenses/grand-livre";
        // Activation de lien
        $data['etat'] = 'depense';
        $data['activer'] = 'lien_grandLivre';
        $this->load->view("templates/template", $data);
    }

}
?>
