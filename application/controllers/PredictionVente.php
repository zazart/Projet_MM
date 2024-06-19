<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PredictionVente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Vente_model');
        $this->load->library('regression');
    }

    public function train() {
        // Données  X: [year_vente,month_vente, id_produit]
        // Données  Y: [quantite] produit
        $resultats = $this->Vente_model->get_last_year();
        $data = [];
        $Y = [];
        foreach ($resultats as $row) {
            $data[] = [$row['month_vente'],$row['id_produit']];
            $Y[] = [$row['quantite']];
        }

        // print_r($data);
        // print_r($Y);

        // $data = [
        //     [2023, 12, 2],
        //     [2023, 12, 1],
        //     [2023, 10, 2],
        //     [2023, 10, 4],
        //     [2023, 10, 1],
        //     [2023, 11, 1],
        //     [2023, 11, 2],
        //     [2023, 11, 4],
        //     [2023, 10, 5],
        //     [2024, 10, 5],
        //     [2024, 10, 5],
        // ];
        // $Y = [
        //     [11],
        //     [10],
        //     [133],
        //     [137],
        //     [11],
        //     [11],
        //     [133],
        //     [14],
        //     [19]
        // ];
        
        // Entraîner le modèle et enregistrer les coefficients
        $filename = 'assets/predict_vente.txt';
        $coefficients = $this->regression->trainAndSave($data, $Y, $filename);

        echo "Modèle entraîné et coefficients enregistrés dans '$filename'.\n";
    }

    public function predict() {
        // Charger les coefficients depuis le fichier
        $filename = 'assets/predict_vente.txt';
        $year = $this->input->get('year_vente');
        $month = $this->input->get('month_vente');
        $id_produit = $this->input->get('id_produit');
        header('Content-Type: application/json');

        try {
            $coefficients = $this->regression->loadCoefficients($filename);

            // Données  X: [year_vente, month_vente, id_produit]
            // Données  Y: [quantite] produit
            $newData = [$month, $id_produit];
            $predictedSales = $this->regression->predict($newData, $coefficients);

            echo json_encode(array(
                'message'=> 'Prediction terminer',
                'resultat' => $predictedSales,
                'donnees' => $newData
            ));
        } catch (Exception $e) {
            echo json_encode(array(
                "erreur" => $e->getMessage()
            ));
        }
    }
}
