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
        $data['productions'] = $this->Production_Model->get_all_production();
        $data["title"] = "Production";
		$data["contents"]="pages/Transformation/liste_production";
		$this->load->view("templates/template",$data);
    }

    public function view_insertion_production() {
        $data['matierepremiers'] = $this->MatierePremier_Model->get_all_matierepremier();
        $data["title"] = "Production";
		$data["contents"]="pages/Transformation/insert_production";
		$this->load->view("templates/template",$data);
        // $this->load->view('transformation/insertion-statut', $data);
    }

    public function validation_update_production($id_statut) {
        $this->form_validation->set_rules('id_matierep', 'Matiere premiere', 'required');
        $this->form_validation->set_rules('quantiteburt', 'Quantite à produire', 'required');
        $this->form_validation->set_rules('quantite_produite', 'Quantite produite', 'required');
        $this->form_validation->set_rules('date_prod', 'Date de production', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['statut'] = $this->Production_Model->get_machine($id_statut);
            $this->load->view('transformation/insertion-statut', $data);
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
                $data['statut'] = $this->Production_Model->get_machine($id_statut);
                $this->load->view('transformation/insertion-statut', $data);
            }
        }
    }

    public function validation_insert_production() {
        $this->form_validation->set_rules('id_matierep', 'Matiere premiere', 'required');
        $this->form_validation->set_rules('quantitebrut', 'Quantite à produire', 'required');
        $this->form_validation->set_rules('quantite_produite', 'Quantite produite', 'required');
        $this->form_validation->set_rules('date_prod', 'Date de production', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['matierepremiers'] = $this->MatierePremier_Model->get_all_matierepremier();
            $data["title"] = "Production";
            $data["contents"]="pages/Transformation/insert_production";
            $this->load->view("templates/template",$data);
        } else {
            $data = array(
                'matierepremier' => $this->input->post('id_matierep'),
                'quantitebrut' => $this->input->post('quantitebrut'),
                'quantiteproduit' => $this->input->post('quantiteproduit'),
                'date_prod' => $this->input->post('dateproduction')
            );

            if ($this->Production_Model->insert_production($data)) {
                $id_matierep = $this->input->post('id_matierep');
                $date_prod = $this->input->post('dateproduction');
                $quantite_prod = $this->input->post('quantitebrut');
                //insertion dans stockmatierepremier
                $data2 = array(
                    'matierepremier' => $id_matierep,
                    'dates' => $date_prod,
                    'quantiteentrant' => 0.00,
                    'quantitesortant' => $quantite_prod
                );
                $this->StockMatierePremier_Model->insert_stockmatierepremier($data2);

                //insertion dans table produit si ce matierepremier n'existe pas encore 
                //dans la table des produits
                $nom_matierepremier = $this->MatierePremier_Model->get_matiere($id_matierep);
                if(!$this->Produit_Model->nom_existe($nom_matierepremier)){
                    //inserte dans produit si cela n'existe pas encore
                    $data_produit = array(
                        'nom_produit' => 'huile de ' . $nom_matierepremier,
                        'prix_unitaire' => 0.00
                    );
                    // Insérer le produit
                    return $this->db->insert('produit', $data_produit);
                } 

                $suffixe = 'huile de '. $nom_matierepremier;
                //insertion dans stockproduit
                $produit_stockena = $this->Produit_Model->get_produit_by_nom($suffixe);
                $id_produit = $produit_stockena['id_produit'];
                $data_stockprod = array(
                    'datestockproduit' => $date_prod,
                    'quantiteentrant' => $quantite_prod,
                    'quantitesortant' => 0.00,
                    'id_produit' => $id_produit
                );
                $this->StockProduit_Model->insert_stockproduit($data_stockprod);
                
                // Compléter la transaction
                $this->db->trans_complete();

                // Redirection si tout est correct
                if ($this->db->trans_status() === FALSE) {
                    // Quelque chose a échoué, rollback et affiche une erreur
                    $data['matierepremiers'] = $this->MatierePremier_Model->get_all_matierepremier();
                    $data["title"] = "Production";
                    $data["contents"] = "pages/Transformation/insert_production";
                    $this->load->view("templates/template", $data);
                } else {
                    // Redirection vers quand toutes les insertions sont effectuées
                    redirect('transformation/production_controller');
                }
            } else {
                $data['matierepremiers'] = $this->MatierePremier_Model->get_all_matierepremier();
                $data["title"] = "Production";
                $data["contents"]="pages/Transformation/insert_production";
                $this->load->view("templates/template",$data);
            }
        }
    }

    public function validation_delete_statut($id){
        $this->Production_Model->delete_statut($id);
        redirect('transformation/statut_controller');
    }

    //liste production
    //update production
    //supprimer 

}
?>