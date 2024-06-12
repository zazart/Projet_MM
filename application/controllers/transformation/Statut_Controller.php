<?php 
class Statut_Controller extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('Statut_Model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['statuts'] = $this->Statut_Model->get_statut_actuel();
        $this->load->view('liste-statut', $data);
    }

    public function view_insertion_statut() {
        $data['machines'] = $this->Statut_Model->get_all_machine();
        $this->load->view('insertion-statut', $data);
    }

    public function validation_update_statut($id) {
        // $this->form_validation->set_rules('nom_machine', 'Nom', 'required');
        // $this->form_validation->set_rules('fonction', 'Fonction', 'required');
        // $this->form_validation->set_rules('date_achat', 'Date Achat', 'required');

        // if ($this->form_validation->run() === FALSE) {
        //     $data['machine'] = $this->Machine_Model->get_machine($id);
        //     $this->load->view('insertion-statut', $data);
        // } else {
        //     $date1 = $this->input->post('date_achat');
        //     $date12 = date('Y-m-d', strtotime($date1));
        //     $data = array(
        //         'nom_machine' => $this->input->post('nom_machine'),
        //         'fonction' => $this->input->post('fonction'),
        //         'date_achat' => $date12
        //     );

        //     if ($this->Machine_Model->update_machine($id, $data)) {
        //         redirect('statut_controller');
        //     } else {
        //         $data['machine'] = $this->Machine_Model->get_machine($id);
        //         $this->load->view('insertion-statut', $data);
        //     }
        // }
    }

    public function validation_insert_statut() {
        $this->form_validation->set_rules('id_machine', 'Nom machine', 'required');
        $this->form_validation->set_rules('date_verification', 'Date verification', 'required');
        $this->form_validation->set_rules('statut', 'Statut', 'required');
        $this->form_validation->set_rules('descri', 'Description de son Etat', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('insertion-statut');
        } else {
            $date1 = $this->input->post('date_verification');
            $date12 = date('Y-m-d', strtotime($date1));
            $data = array(
                'id_machine' => $this->input->post('id_machine'),
                'date_verification' => $date12,
                'statut' => $this->input->post('statut'),
                'descri' => $this->input->post('descri')
            );

            if ($this->Statut_Model->insert_statut($data)) {
                redirect('statut_controller');
            } else {
                $this->load->view('insertion-statut');
            }
        }
    }

    public function validation_delete_statut($id){
        $this->Statut_Model->delete_statut($id);
        redirect('statut_controller');
    }

}
?>
