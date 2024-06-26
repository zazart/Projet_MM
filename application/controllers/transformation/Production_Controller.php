<?php 
class Production_Controller extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('transformation/Production_Model');
        $this->load->model('transformation/StockMatierePremier_Model');
        $this->load->model('transformation/Produit_Model');
        $this->load->model('transformation/StockProduit_Model');
        $this->load->model('transformation/MatierePremier_Model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $data= $this->Production_Model->get_all_production();
        $response = array(
            'success' => true,
            'detail' => $data
        );

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
    }

    public function view_insertion_production() {
        $data['matierepremiers'] = $this->MatierePremier_Model->get_all_matierepremier();
        $data["title"] = "Production";
        $data["etat"]="transformation";
        $data["activer"]="production_insert";
		$data["contents"]="pages/Transformation/insert-production";
		$this->load->view("templates/template",$data);
        // $this->load->view('transformation/insertion-statut', $data);
    }

    function validationProduction(){
        $this->form_validation->set_rules('id_matierep', 'id_matierep', 'required',array('required'=>'le choix de la matière premiere ne doit pas être vide'));
        $this->form_validation->set_rules('quantitebrut', '', 'required',array('required'=>'la quantité brûte ne doit pas être vide'));
        $this->form_validation->set_rules('quantite_produite', 'quantite_produite', 'required',array('required'=>'la quantite produite ne doit pas être vide'));
        $this->form_validation->set_rules('date_prod', 'date_prod', 'required',array('required'=>'la date ne doit pas être vide'));
    }
    public function validation_insert_production() {
           
        $this->validationProduction();
        if ($this->form_validation->run() == FALSE) {
            $errors=array(
                'date'=>form_error('date_prod'),
                'matiere'=>form_error('id_matierep'),
                'in_qtt'=>form_error('quantitebrut'),
                'out_qtt'=>form_error('quantite_produite'), 
            );
            $response=array(
                'success' => FALSE,
                'errors'=>$errors
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $data = array(
                'matierepremier' => $this->input->post('id_matierep'),
                'quantitebrut' => $this->input->post('quantitebrut'),
                'quantiteproduit' => $this->input->post('quantite_produite'),
                'dateproduction' => $this->input->post('date_prod')
            );

            if ($this->Production_Model->insert_production($data)) {
                $id_matierep = $this->input->post('id_matierep');
                $date_prod = $this->input->post('date_prod');
                $quantite_utilise = $this->input->post('quantitebrut');
                $quantite_prod = $this->input->post('quantite_produite');
                //insertion dans stockmatierepremier
                //mamoaka avy ao amin'ny stockmatierepremier
                $data2 = array(
                    'matierepremier' => $id_matierep,
                    'dates' => $date_prod,
                    'in_qtt' => 0.00,
                    'out_qtt' => $quantite_utilise
                );
                $this->StockMatierePremier_Model->insert_stockmatierep($data2);

                //insertion dans table produit si ce matierepremier n'existe pas encore 
                //dans la table des produits
                $matiere = $this->MatierePremier_Model->get_matiere($id_matierep);
                $nom_matierepremier = $matiere['nom']; 
                if($this->Produit_Model->nom_existe($nom_matierepremier) == false){
                    //inserte dans produit si cela n'existe pas encore
                    $data_produit = array(
                        'nom_produit' => 'huile de ' . $nom_matierepremier,
                        'prix_unitaire' => 0.00
                    );
                    // Insérer le produit
                    $this->Produit_Model->insert_produit_simple($data_produit);
                } 

                $suffixe = 'huile de '. $nom_matierepremier;
                //insertion dans stockproduit
                //mampiditra ao amin'ny stockproduit
                $produit_stockena = $this->Produit_Model->get_produit_by_nom($suffixe);
                $id_produit = $produit_stockena['id_produit'];
                $data_stockprod = array(
                    'datestockproduit' => $date_prod,
                    'quantiteentrant' => $quantite_prod,
                    'quantitesortant' => 0.00,
                    'id_produit' => $id_produit
                );
                $this->StockProduit_Model->insert_stockproduit($data_stockprod);
                
                // envoi du seccess
                $response=array(
                    'success' => true,
                    'message' => 'Production ajoutée avec succès!',
                );
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));                
            } else {
                $data['matierepremiers'] = $this->MatierePremier_Model->get_all_matierepremier();
                $data["title"] = "Production";
                $data["etat"]="transformation";
                $data["activer"]="production_insert";
                $data["contents"]="pages/Transformation/insert-production";
                $this->load->view("templates/template",$data);
            }
        }
    }

    public function validation_delete_production($id){
        $this->Production_Model->delete_production($id);
        redirect('transformation/production_controller');
    }


    public function data_production() {
        $year = $this->input->get("year");
        $data = $this->Production_Model->get_all_production_saison($year);
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json; charset=utf-8')
        ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
        exit;
    }

    public function statistique() {
        $data["title"] = "Statistique | Production";
        $data["etat"]="transformation";
        $data["activer"]="statistique_production";
        $data["contents"]="pages/Transformation/statistique-production";
        $this->load->view("templates/template",$data);
    }

    //liste production
    //update production
    //supprimer 


}
?>