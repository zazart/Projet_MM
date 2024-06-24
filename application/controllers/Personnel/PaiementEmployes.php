<?php
// application/controllers/PaiementEmployes.php
class PaiementEmployes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Personnel/PaiementEmploye_model');
        $this->load->model('Personnel/Employe_model');
        $this->load->helper('url_helper');
        $this->load->library('form_validation');
    }

    public function create() {
        $data['employes'] = $this->PaiementEmploye_model->get_employes();

        // Définir les règles de validation
        $this->form_validation->set_rules('libelle', 'Libellé', 'required');
        $this->form_validation->set_rules('id_employe', 'Employé', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Si la validation échoue, afficher le formulaire à nouveau
            $data["etat"] = "personnel";
            $data["activer"] = "lien_payement";
            $data['contents'] = 'pages/Personnel/paiementEmployes/create';
            $this->load->view('templates/template', $data);
        } else {
            // Si la validation réussit, insérer les données dans la base de données
            $id_employe = $this->input->post('id_employe');
            $employe = $this->PaiementEmploye_model->get_employe_by_id($id_employe);
            $data = array(
                'dates' => date('Y-m-d'),
                'prix' => $employe['montant_salaire'],
                'libelle' => $this->input->post('libelle'),
                'id_employe' => $id_employe
            );

            $this->PaiementEmploye_model->insert_paiement_employe($data);

            redirect('Personnel/paiementemployes/create');
        }
    }
}
?>
