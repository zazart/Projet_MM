<?php 
class Machine_Controller extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('transformation/Machine_Model');
        $this->load->model('transformation/Statut_Model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $data = $this->Machine_Model->get_all_machine();
        $response = array(
            'success' => true,
            'machine' => $data
        );

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
    }
    

    public function view_insertion_machine() {
        $data["title"] = "Machine";
		$data["contents"]="pages/Transformation/insert-machine";
        $data["etat"]="transformation";
        $data["activer"]="machine_insert";
        $this->load->view('templates/template',$data);
    }

    public function validation_update_machine($id) {
        $this->form_validation->set_rules('nom_machine', 'Nom', 'required');
        $this->form_validation->set_rules('fonction', 'Fonction', 'required');
        $this->form_validation->set_rules('date_achat', 'Date Achat', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['machine'] = $this->Machine_Model->get_machine($id);
            $data["title"] = "Machine";
            $data["etat"]="transformation";
            $data["activer"]="machine_insert";
            $data["contents"]="pages/Transformation/insert-machine";
            $this->load->view('templates/template',$data);
        } else {
            $date1 = $this->input->post('date');
            $date12 = date('Y-m-d', strtotime($date1));
            $data = array(
                'nom_machine' => $this->input->post('machine'),
                'fonction' => $this->input->post('fonction'),
                'date_achat' => $date12
            );

            if ($this->Machine_Model->update_machine($id, $data)) {
                redirect('transformation/machine_controller');
            } else {
                $data['machine'] = $this->Machine_Model->get_machine($id);
                $data["title"] = "Machine";
                $data["etat"]="transformation";
                $data["activer"]="machine_insert";
                $data["contents"]="pages/Transformation/insert-machine";
                $this->load->view('templates/template',$data);
            }
        }
    }

    public function setValidation(){
        $this->form_validation->set_rules('machine', 'machine', 'required',array('required'=>'le nom de la machine ne doit pas être vide'));
        $this->form_validation->set_rules('fonction', 'fonction', 'required',array('required'=>'la fonction de la machine ne doit pas être vide'));
        $this->form_validation->set_rules('date', 'date', 'required',array('required'=>'la date de la machine ne doit pas être vide'));
    }
    public function validation_insert_machine() {
       $this->setValidation();
        if ($this->form_validation->run() == FALSE) {
            $errors=array(
                'machine'=> form_error('machine'),
                'fonction'=> form_error('fonction'),
                'date'=> form_error('date')
            );
            $response=array(
                'success' => FALSE,
                'errors'=>$errors
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            
        } else {
            $date1 = $this->input->post('date');
            $date12 = date('Y-m-d', strtotime($date1));
            $id=$this->input->post('id');
            $data = array(
                'nom_machine' => $this->input->post('machine'),
                'fonction' => $this->input->post('fonction'),
                'date_achat' => $date12
            );
            if($id){
                $this->Machine_Model->update_machine($id, $data);
                $response=array(
                    'success' => true,
                    'message' => 'Machine mise à jour avec succès!',
                );
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                
            }
            else{
                if ($this->Machine_Model->insert_machine($data)) {
                    $response=array(
                        'success' => true,
                        'message' => 'Machine ajoutée avec succès!',
                    );
                    $this->output
                            ->set_content_type('application/json')
                            ->set_output(json_encode($response));
                    
                } else {
                    $data["title"] = "Machine";
                    $data["contents"]="pages/Transformation/insert-machine";
                    $data["etat"]="transformation";
                    $data["activer"]="machine_insert";
                    $this->load->view('templates/template',$data);
                }
            }
        }
    }

    public function validation_delete_machine(){
        $id=$this->input->post('id');
        $this->Statut_Model->delete_statut_bymachine($id);
        $this->Machine_Model->delete_machine($id);
        redirect('transformation/machine_controller');
    }

    public function search_by_date() {
        $date1 = $this->input->post('date_debut');
        $date2 = $this->input->post('date_fin');
        $date11 = date('Y-m-d', strtotime($date1));
        $date22 = date('Y-m-d', strtotime($date2));
    
        // Vérifiez les différentes conditions d'entrée
        if (!empty($date1) && !empty($date2)) {
            // Si les deux dates sont entrées
            $data['machines'] = $this->Machine_Model->get_machine_by_date($date1, $date2);
        } elseif (!empty($date1)) {
            // Si seule la date de début est entrée
            $data['machines'] = $this->Machine_Model->get_machines_after_date($date1);
        } elseif (!empty($date2)) {
            // Si seule la date de fin est entrée
            $data['machines'] = $this->Machine_Model->get_machines_before_date($date2);
        } else {
            // Si aucune date n'est entrée, retournez toutes les machines
            $data['machines'] = $this->Machine_Model->get_all_machine();
        }
    
        $this->load->view('transformation/recherche-machine', $data);
    }
    
}
?>