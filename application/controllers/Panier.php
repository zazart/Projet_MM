<?php
class Panier extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Produit_model');
        $this->load->model('Panier_model');
    }   

    public function list($id_commande) {
        $data["paniers"] = $this->Panier_model->get_by_commande($id_commande);
        $this->load->view("panier/panier_list", $data);
    }
}
?>