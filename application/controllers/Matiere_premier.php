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
        $this->load->view("templates/template",$data);
    }

    public function create()
    {
        $this->load->model('matiere_Premiere/matiere');
        $id = $this->matiere->input->post('id');
        $nom = $this->matiere->input->post('matierepremier');
        if ($id) {
            $this->matiere->update_matiere($id,$nom);
        }else {
            $this->matiere->insertmatierepremier($nom);   
        }
    }

    public function prixmatierepremier(){
        $this->load->model('matiere');
        $data['matiere_data']=$this->matiere->get_matiere_data();
        $this->load->view('Users/prix_matiere_premier',$data);
    }

    public function create_prix(){
        $this->load->model('prix_matiere');
        $id = $this->prix_matiere->input->post('id');
        $idmatierepremier = $this->prix_matiere->input->post('nom');
        $prix = $this->prix_matiere->input->post('prix');
        $date = $this->prix_matiere->input->post('date');

        if ($id) {
            $this->prix_matiere->update_prix_matiere($id,$idmatierepremier,$prix,$date);
            $this->session->set_flashdata('success', 'Prix Matière mise à jour avec succès.');
        }else {
            $this->prix_matiere->insertprixmatierepremier($idmatierepremier,$prix,$date);
        }
    }

    public function source(){
        $this->load->view('Users/source');
    }

    public function create_source(){
        $this->load->model('source');

        $id = $this->source->input->post('id');
        $lieu = $this->source->input->post('lieu');

        if ($id) {
            $this->source->update_source($id,$lieu);
            $this->session->set_flashdata('success', 'Source mise à jour avec succès.');
        }else {
            $this->source->insertsource($lieu);
        }
    }

    public function sourcematierepremier(){
        $this->load->model('matiere');
        $data['matiere_data']=$this->matiere->get_matiere_data();
        $this->load->model('source');
        $data['source_data']=$this->source->get_source_data();
        $this->load->view('Users/source_matiere_premier',$data);
    }

    public function create_source_matiere_premier() {
        $this->load->model('source_matiere_premier');
        $id = $this->source_matiere_premier->input->post('id');
        $matierepremier = $this->source_matiere_premier->input->post('nom');
        $date = $this->source_matiere_premier->input->post('date');
        $lieu = $this->source_matiere_premier->input->post('source');

        if ($id) {
            $this->source_matiere_premier->update_source_matiere_premier($id,$matierepremier,$date,$lieu);
            $this->session->set_flashdata('success', 'Source Matiere Premier mise à jour avec succès.');
        }else {
            $this->source_matiere_premier->insertsourcematierepremier($matierepremier,$date,$lieu);
        }
    }

    public function list_matiere() {
        $this->load->model('matiere_Premiere/matiere');
        $data['matiere_data']=$this->matiere->get_matiere_data();
        $data["title"]="Insertion de matiere Premiere";
        $data["contents"]="pages/matierePremiere/list_matiere_premier";
        $this->load->view("templates/template",$data);
    }

    public function edit_matier_permier($id) {
        $this->load->model('matiere_Premiere/matiere');
        $data['matiere'] = $this->matiere->get_matiere($id);
        $data["title"]="Modification de matiere Premiere";
        $data["contents"]="pages/matierePremiere/matiere_premier";
        $this->load->view("templates/template",$data);
    }

    public function drop_matier_permier($id) {
        $this->load->model('matiere_Premiere/matiere');
        $this->matiere->delete_matiere($id);
        redirect('Matiere_premier/list_matiere');
    }

    public function edit_prix_matier_permier($id) {
        $this->load->model('prix_matiere');
        $data['prix_matiere'] = $this->prix_matiere->get_prix_matiere($id);
        $this->load->model('matiere');
        $data['matiere_data'] = $this->matiere->get_matiere_data();
        $this->load->view('Users/prix_matiere_premier',$data);
    }

    public function drop_prix_matier_permier($id) {
        $this->load->model('prix_matiere');
        $this->prix_matiere->delete_matiere($id);
        redirect('MatierePremier/list_prix_matiere');
    }

    public function list_prix_matiere() {
        $this->load->model('prix_matiere');
        $data['prix_matiere_data']=$this->prix_matiere->get_prix_matiere_data();
        $this->load->view('Users/list_prix_matiere_premier',$data);
    }

    public function list_source(){
        $this->load->model('source');
        $data['source']=$this->source->get_source_data();
        $this->load->view('Users/list_source',$data);
    }

    public function edit_source($id) {
        $this->load->model('source');
        $data['source']=$this->source->get_source($id);
        $this->load->view('Users/source',$data);
    }

    public function drop_source($id) {
        $this->load->model('source');
        $this->source->delete_source($id);
        redirect('MatierePremier/list_source');
    }

    public function list_source_matiere_premier() {
        $this->load->model('source_matiere_premier');
        $data['source_matiere_premier']=$this->source_matiere_premier->get_source_matiere_premiere_data();
        $this->load->view('Users/list_source_matiere_premier',$data);
    }

    public function edit_source_matier_permier($id) {
        $this->load->model('source_matiere_premier');
        $data['source_matiere_premier_data']=$this->source_matiere_premier->get_source_matiere_premiere($id);
        $this->load->model('matiere');
        $data['matiere_data']=$this->matiere->get_matiere_data();
        $this->load->model('source');
        $data['source_data']=$this->source->get_source_data();
        $this->load->view('Users/source_matiere_premier',$data);
    }

    public function drop_source_matier_permier($id) {
        $this->load->model('source_matiere_premier');
        $this->source_matiere_premier->delete_source_matiere_premier($id);
        redirect('MatierePremier/list_source_matiere_premier');
    }

    public function stockmatierepremier(){
        $this->load->model('matiere');
        $data['matiere_data']=$this->matiere->get_matiere_data();
        $this->load->view('Users/stock',$data);
    }

    public function create_stock(){
        $this->load->model('stock');
        $id=$this->stock->input->post('id');
        $nom=$this->stock->input->post('nom');
        $date=$this->stock->input->post('date');
        $in=$this->stock->input->post('inqtt');
        $out=$this->stock->input->post('outqtt');

        if ($id) {
            $this->stock->update_stock($id,$nom,$date,$in,$out);
            $this->session->set_flashdata('success', 'Stock mise à jour avec succès.');
        }else {
            $this->stock->insertstock($nom,$date,$in,$out);
        }
    }

    public function list_stock_matiere_premier(){
        $this->load->model('stock');
        $data['stock_data']=$this->stock->get_stock_data();
        $this->load->view('Users/list_stock',$data);
    }

    public function edit_stock($id){
        $this->load->model('stock');
        $data['stock_data']=$this->stock->get_stock($id);
        $this->load->model('matiere');
        $data['matiere_data']=$this->matiere->get_matiere_data();
        $this->load->view('Users/stock',$data);
    }

    public function drop_stock($id){
        $this->load->model('stock');
        $this->stock->delete_stock($id);
        redirect('MatierePremier/list_stock_matiere_premier');
    }

    public function production(){
        $this->load->model('stock');
        $data['stock_data']=$this->stock->get_stock_data();
        $this->load->view('Users/production',$data);
    }

    public function create_production(){
        $this->load->model('production');
        $id=$this->production->input->post('id');
        $stock=$this->production->input->post('stock');
        $qt=$this->production->input->post('quantite');
        $date=$this->production->input->post('date');

        if ($id) {
            $this->production->update_production($id,$stock,$qt,$date);
            $this->session->set_flashdata('success', 'Production mise à jour avec succès.');
        }else {
            $this->production->insertproduction($stock,$qt,$date);
        }
    } 

    public function list_production(){
        $this->load->model('production');
        $data['production_data']=$this->production->get_produciton_data();
        $this->load->view('Users/list_production',$data);
    }

    public function edit_production($id){
        $this->load->model('production');
        $data['production_data']=$this->production->get_production($id);
        $this->load->model('stock');
        $data['stock_data']=$this->stock->get_stock_data();
        $this->load->view('Users/production',$data);
    }

    public function drop_production($id){
        $this->load->model('production');
        $this->production->delete_production($id);
        redirect('MatierePremier/list_production');
    }
}