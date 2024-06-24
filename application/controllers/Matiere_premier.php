<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Loader $load
 * @property matiere $matiere
 * @property prix_matiere $prix_matiere
 * @property source $source
 * @property source_matiere_premier $source_matiere_premier
 * @property stock $stock
 * @property production $production
 */
class Matiere_premier extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function matiere_premier_insert()
    {
        $data["title"]="Insertion de matiere Premiere";
        $data["contents"]="pages/matierePremiere/matiere_premier";
        $data["etat"]="matierePremiere";
        $data["activer"]="matiere_premiere";
        $this->load->view("templates/template",$data);
    }
    public function validation() {
        $this->form_validation->set_rules('matierepremier', 'nom', 'required', array('required' => 'Le champ nom est obligatoire'));
    }
    public function validation_Prix_insert(){
        $this->form_validation->set_rules('nom', 'nom', 'required', array('required' => 'Le champ nom est obligatoire'));
        $this->form_validation->set_rules('prix', 'prix', 'required', array('required' => 'Le champ prix est obligatoire'));
        $this->form_validation->set_rules('date', 'date', 'required', array('required' => 'Le champ date est obligatoire'));
    }
    
    public function validation_Source_insert(){
        $this->form_validation->set_rules('lieu', 'lieu', 'required', array('required' => 'Le champ nom est obligatoire'));

    }
    public function validation_Source_Matiere_Insert(){
        $this->form_validation->set_rules('nom', 'nom', 'required', array('required' => 'Le champ nom est obligatoire'));
        $this->form_validation->set_rules('date', 'date', 'required', array('required' => 'Le champ nom est obligatoire'));
        $this->form_validation->set_rules('source', 'source', 'required', array('required' => 'Le champ nom est obligatoire'));
        
    }
    public function create()
    {
        $this->validation();
        if($this->form_validation->run() == FALSE){
            $errors=array(
                'nom'=>form_error('nom')
            );
            $response=array(
                'success' => FALSE,
                'errors'=>$errors
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
        else{
            $this->load->model('matiere_Premiere/matiere');
            $id = $this->matiere->input->post('id');
            $nom = $this->matiere->input->post('matierepremier');
        if ($id) {
            $this->matiere->update_matiere($id,$nom);
        }else {
            $this->matiere->insertmatierepremier($nom);   
        }
        $response=array(
            'success' => true,
            'message' => 'Matiere Premiere ajoutée avec succès!',
        );
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
        
    }

    public function prixmatierepremier(){
        $this->load->model('matiere_Premiere/matiere');
        $data["title"]="insertion de prix des matières Premières";
        $data["contents"]="pages/matierePremiere/prix_matiere_premier";
        $data["etat"]="matierePremiere";
        $data["activer"]="prix_matiere_premier";
        $data['matiere_data']=$this->matiere->get_matiere_data();
        $this->load->view("templates/template",$data);
    }

    public function create_prix(){
        $this->validation_Prix_insert();
        if($this->form_validation->run() == FALSE){
            $errors=array(
                'nom'=>form_error('nom'),
                'date'=>form_error('date'),
                'prix'=>form_error('prix'),
            );
            $response=array(
                'success' => FALSE,
                'errors'=>$errors
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
        else{
            $this->load->model('matiere_premiere/prix_matiere');
            $id = $this->prix_matiere->input->post('id');
            $idmatierepremier = $this->prix_matiere->input->post('nom');
            $prix = $this->prix_matiere->input->post('prix');
            $date = $this->prix_matiere->input->post('date');
            if ($id) {
                $this->prix_matiere->update_prix_matiere($id,$idmatierepremier,$prix,$date);
            }else {
                $this->prix_matiere->insertprixmatierepremier($idmatierepremier,$prix,$date);
            }
        $response=array(
            'success' => true,
            'message' => 'Matiere Premiere ajoutée avec succès!',
        );
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
        
    }

    public function source(){
        $data["contents"]="pages/matierePremiere/source_insert";
        $data["title"]="insertion de nouvelle source";
        $data["etat"]="matierePremiere";
        $data["activer"]="source_insert";
        $this->load->view('templates/template',$data);
    }

    public function create_source(){
        $this->validation_Source_insert();
        if($this->form_validation->run() == FALSE){
            $errors=array(
                'source'=>form_error('lieu')
            );
            $response=array(
                'success' => FALSE,
                'errors'=>$errors
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
        else{
            $this->load->model('matiere_Premiere/source');
            $id = $this->source->input->post('id');
            $lieu = $this->source->input->post('lieu');

            if ($id) {
                    $this->source->update_source($id,$lieu);
             }else {
                     $this->source->insertsource($lieu);
            }
        $response=array(
            'success' => true,
            'message' => 'Matiere Premiere ajoutée avec succès!',
        );
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
        
    }

    public function sourcematierepremier(){
        $this->load->model('matiere_premiere/matiere');
        $this->load->model('matiere_premiere/source');

        $data["contents"]="pages/matierePremiere/source_matiere_premiere";
        $data["title"]="Source matiere Premiere";
        $data['matiere_data']=$this->matiere->get_matiere_data();
        $data['source_data']=$this->source->get_source_data();
        $data["etat"]="matierePremiere";
        $data["activer"]="source_matiere_premiere";
        $this->load->view('templates/template',$data);
    }

    public function create_source_matiere_premier() {
        $this->validation_Source_Matiere_Insert();
        if($this->form_validation->run() == FALSE){
            $errors=array(
                'nom'=>form_error('nom'),
                'date'=>form_error('date'),
                'source'=>form_error('source'),
            );
            $response=array(
                'success' => FALSE,
                'errors'=>$errors
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
        else{
            $this->load->model('matiere_Premiere/source_matiere_premier');
            $id = $this->source_matiere_premier->input->post('id');
            $matierepremier = $this->source_matiere_premier->input->post('nom');
            $date = $this->source_matiere_premier->input->post('date');
            $lieu = $this->source_matiere_premier->input->post('source');
    
            if ($id) {
                $this->source_matiere_premier->update_source_matiere_premier($id,$matierepremier,$date,$lieu);
            }else {
                $this->source_matiere_premier->insertsourcematierepremier($matierepremier,$date,$lieu);
            }
        $response=array(
            'success' => true,
            'message' => 'Matiere Premiere ajoutée avec succès!',
        );
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }

    }

    public function list_matiere() {
        $this->load->model('matiere_Premiere/matiere');
        $matiere=$this->matiere->get_matiere_data();

        $response = array(
            'success' => true,
            'matiere' => $matiere
        );

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));

    }

    public function edit_matier_permier($id) {
        $this->load->model('matiere_Premiere/matiere');
        $data['matiere'] = $this->matiere->get_matiere($id);
        $data["title"]="Modification de matiere Premiere";
        $data["contents"]="pages/matierePremiere/matiere_premier";
        $data["etat"]="matierePremiere";
        $data["activer"]="list_matiere_premier";
        $this->load->view("templates/template",$data);
    }

    public function drop_matier_permier() {
        $id=$this->input->post("id");
        $this->load->model('matiere_Premiere/matiere');
        $this->matiere->delete_matiere($id);
        echo json_encode(array('id' => $id));
    }

    public function edit_prix_matier_permier($id) {
        $this->load->model('matiere_Premiere/prix_matiere');
        $this->load->model('matiere_Premiere/matiere');

        $data["contents"]="pages/matierePremiere/prix_matiere_premier";
        $data["title"]= "prix matiere premiere setter";
        $data['prix_matiere'] = $this->prix_matiere->get_prix_matiere($id);
        $data['matiere_data'] = $this->matiere->get_matiere_data();
        $data["etat"]="matierePremiere";
        $data["activer"]="list_prix_matiere_premier";
        $this->load->view('templates/template',$data);
    }

    public function drop_prix_matier_permier() {
        $id=$this->input->post("id");
        $this->load->model('matiere_Premiere/prix_matiere');
        $this->prix_matiere->delete_matiere($id);
        echo json_encode(array('id' => $id));
    }

    public function list_prix_matiere() {
        $this->load->model('matiere_Premiere/prix_matiere');
        $prixlist=$this->prix_matiere->get_prix_matiere_data();
        $response=array(
            'success'=>true,
            'prixmatiere'   =>$prixlist
        );
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
    }

    public function list_source(){
        $this->load->model('matiere_Premiere/source');
        $source=$this->source->get_source_data();
        $response=array(
            'success'=>true,
            'source'=>$source
        );
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));

    }

    public function edit_source($id) {
        $this->load->model('matiere_Premiere/source');
        $data["contents"]="pages/matierePremiere/source_insert";
        $data["title"]="Setting source";
        $data['source']=$this->source->get_source($id);
        $data["etat"]="matierePremiere";    
        $data["activer"]="list_source";
        $this->load->view('templates/template',$data);
    }

    public function drop_source() {
        $id=$this->input->post("id");
        $this->load->model('matiere_Premiere/source');
        $this->source->delete_source($id);
    }

    public function list_source_matiere_premier() {
        $this->load->model('matiere_Premiere/source_matiere_premier');
        $sourcematiere=$this->source_matiere_premier->get_source_matiere_premiere_data();
        $response=array(
            'success'=>true,
            'source_matiere'=>$sourcematiere
        );
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
        
    }

    public function edit_source_matier_permier($id) {
        $this->load->model('matiere_Premiere/source_matiere_premier');
        $this->load->model('matiere_Premiere/matiere');
        $this->load->model('matiere_Premiere/source');
        
        $data['contents']="pages/matierePremiere/source_matiere_premiere";
        $data["title"]="setting source matiere premiere";
        $data['source_matiere_premier_data']=$this->source_matiere_premier->get_source_matiere_premiere($id);
        $data['matiere_data']=$this->matiere->get_matiere_data();
        $data['source_data']=$this->source->get_source_data();
        $data["etat"]="matierePremiere";
        $data["activer"]="list_source_matiere_premiere";
        $this->load->view('templates/template',$data);
    }

    public function drop_source_matier_permier() {
        $id=$this->input->post("id");
        $this->load->model('matiere_Premiere/source_matiere_premier');
        $this->source_matiere_premier->delete_source_matiere_premier($id);
    }


}