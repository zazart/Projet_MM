<?php 
class Statut_Controller extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('transformation/Statut_Model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['statuts'] = $this->Statut_Model->get_statut_actuel();
        $data["title"] = "Etat Machine";
		$data["contents"]="pages/Transformation/liste_etat_machines";
        $this->load->view('templates/template', $data);
    }

    public function view_insertion_statut() {
        $data['machines'] = $this->Statut_Model->get_all_machine();
        $data["title"] = "Etat Machine";
		$data["contents"]="pages/Transformation/insert_etat_machine";
        $this->load->view('templates/template',$data);
    }

    public function validation_update_statut($id_statut) {
        $this->form_validation->set_rules('id_machine', 'Nom machine', 'required');
        $this->form_validation->set_rules('date_verification', 'Date de la verification', 'required');
        $this->form_validation->set_rules('statut', 'Statut', 'required');
        $this->form_validation->set_rules('descri', 'Description de son Etat', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['statut'] = $this->Statut_Model->get_statut($id_statut);
            $data['machines'] = $this->Statut_Model->get_all_machine(); 
            $data["title"] = "Etat Machine";
            $data["contents"]="pages/Transformation/insert_etat_machine";
            $this->load->view('templates/template', $data);
        } else {
            $date1 = $this->input->post('date_verification');
            $date12 = date('Y-m-d', strtotime($date1));
            $data = array(
                'id_machine' => $this->input->post('id_machine'),
                'date_verification' => $date12,
                'statut' => $this->input->post('statut'),
                'descri' => $this->input->post('descri')
            );

            if ($this->Statut_Model->update_statut($id_statut, $data)) {
                redirect('transformation/statut_controller');
            } else {
                $data['statut'] = $this->Machine_Model->get_machine($id_statut);
                $data['machines'] = $this->Statut_Model->get_all_machine(); 
                $data["title"] = "Etat Machine";
                $data["contents"]="pages/Transformation/insert_etat_machine";
                $this->load->view('templates/template',$data);
            }
        }
    }

    public function validation_insert_statut() {
        $this->form_validation->set_rules('id_machine', 'Nom machine', 'required');
        $this->form_validation->set_rules('date_verification', 'Date verification', 'required');
        $this->form_validation->set_rules('statut', 'Statut', 'required');
        $this->form_validation->set_rules('descri', 'Description de son Etat', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data["title"] = "Etat Machine";
            $data["contents"]="pages/Transformation/insert_etat_machine";
            $this->load->view('templates/template',$data);
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
                redirect('transformation/statut_controller');
            } else {
                $data["title"] = "Etat Machine";
                $data["contents"]="pages/Transformation/insert_etat_machine";
                $this->load->view('templates/template',$data);
            }
        }
    }

    public function validation_delete_statut($id){
        $this->Statut_Model->delete_statut($id);
        redirect('transformation/statut_controller');
    }

}
?>