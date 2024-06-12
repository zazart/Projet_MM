<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PredictionVente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('regression');
    }

    public function train() {
        // Données d'exemple : [jours, autre_variable] et ventes
        $data = [
            [1, 50, 150],
            [2, 60, 200],
            [3, 55, 170],
            [4, 65, 220],
            [5, 58, 180],
            [6, 63, 190]
        ];

        // Entraîner le modèle et enregistrer les coefficients
        $filename = 'coefficients.txt';
        $coefficients = $this->regression->trainAndSave($data, $filename);

        echo "Modèle entraîné et coefficients enregistrés dans '$filename'.\n";
    }

    public function predict() {
        // Charger les coefficients depuis le fichier
        $filename = 'coefficients.txt';
        try {
            $coefficients = $this->regression->loadCoefficients($filename);

            // Prédire les ventes pour [7, 62]
            $newData = [7, 62];
            $predictedSales = $this->regression->predict($newData, $coefficients);

            echo "Prévision des ventes pour les nouvelles données : " . $predictedSales . "\n";
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage() . "\n";
        }
    }
}
