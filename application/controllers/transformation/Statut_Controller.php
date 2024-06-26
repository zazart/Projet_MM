<?php 
class Statut_Controller extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('transformation/Statut_Model');
        $this->load->model('transformation/Machine_Model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $data = $this->Statut_Model->get_statut_actuel();
        $response = array(
            'success' => true,
            'status' => $data
        );

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
    
    }

    public function view_insertion_statut() {
        $data['machines'] = $this->Statut_Model->get_all_machine();
        $data["title"] = "Etat Machine";
        $data["etat"]="transformation";
        $data["activer"]="etat_machine_insert";
		$data["contents"]="pages/Transformation/insert-etat-machine";
        $this->load->view('templates/template',$data);
    }

    public function statutValidation(){
        $this->form_validation->set_rules('id_machine', 'id_machine', 'required',array('required'=>"le nom de la machine ne doit pas etre vide"));
        $this->form_validation->set_rules('date_verification', 'date_verification', 'required',array('required'=>"la date ne doit pas etre vide"));
        $this->form_validation->set_rules('statut', 'statut', 'required',array('required'=>"le statut ne doit pas être vide"));
        $this->form_validation->set_rules('descri', 'descri', 'required',array('required'=>"la description ne doit pas etre vide"));
    }
    public function validation_update_statut($id_statut) {
        $this->statutValidation();
        if ($this->form_validation->run() == FALSE) {
            $errors=array(
                'machine'=>form_error('id_machine'),
                'date'=>form_error('date_verification'),
                'statut'=>form_error('statut'),
                'desc'=>form_error('descri')
            );
            $response=array(
                'success' => FALSE,
                'errors'=>$errors
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
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
                    $response=array(
                    'success' => true,
                    'message' => 'Etat machine ajoutée avec succès!',
             );
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            } else {
                $data['statut'] = $this->Machine_Model->get_machine($id_statut);
                $data['machines'] = $this->Statut_Model->get_all_machine(); 
                $data["title"] = "Etat Machine";
                $data["etat"]="transformation";
                $data["activer"]="etat_machine_insert";
                $data["contents"]="pages/Transformation/insert-etat-machine";
                $this->load->view('templates/template',$data);
            }
        }
    }
    public function edit_etat($id_statut){
                $id= $this->Statut_Model->get_machine_statut($id_statut);
                $data['statut'] = $this->Machine_Model->get_machine_join($id["id_machine"])[0];
                $data['machines'] = $this->Statut_Model->get_all_machine(); 
                $data["title"] = "Etat Machine";
                $data["etat"]="transformation";
                $data["activer"]="etat_machine_insert";
                $data["contents"]="pages/Transformation/insert-etat-machine";
                $this->load->view('templates/template',$data);
    }
    public function validation_insert_statut() {
        $this->statutValidation();
        if ($this->form_validation->run() == FALSE) {
            $errors=array(
                'machine'=>form_error('id_machine'),
                'date'=>form_error('date_verification'),
                'statut'=>form_error('statut'),
                'desc'=>form_error('descri')
            );
            $response=array(
                'success' => FALSE,
                'errors'=>$errors
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $date1 = $this->input->post('date_verification');
            $date12 = date('Y-m-d', strtotime($date1));
            $id=$this->input->post('id');
            $data = array(
                'id_machine' => $this->input->post('id_machine'),
                'date_verification' => $date12,
                'statut' => $this->input->post('statut'),
                'descri' => $this->input->post('descri')
            );
            if($id){
                $this->Statut_Model->update_statut($id, $data);
                $response=array(
                    'success' => true,
                    'message' => 'Etat machine mise a jour avec succès!',
                );
                $this->output
                     ->set_content_type('application/json')
                    ->set_output(json_encode($response));
            }
            else{
                $this->Statut_Model->insert_statut($data);
                $response=array(
                    'success' => true,
                    'message' => 'Etat machine ajoutée avec succès!',
                );
                $this->output
                     ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                }
            
        }
    }

    public function validation_delete_statut(){
        $id=$this->input->post('id');
        $this->Statut_Model->delete_statut($id);
        redirect('transformation/statut_controller');
    }

}
?>