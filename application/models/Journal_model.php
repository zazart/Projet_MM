<?php
// application/models/Journal_model.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        parent::__construct();
        // Inclure FPDF
        require_once APPPATH . 'libraries/fpdf185/fpdf.php';
    }

    public function getJournal($month, $year)
    {
        $query = $this->db->query("SELECT * FROM generate_journal($month, $year);");
        $results = $query->result();

        // Convertir les données en ISO-8859-1 (Latin-1)
        array_walk_recursive($results, function(&$item, $key) {
            if (is_string($item)) {
                $item = utf8_decode($item);
            }
        });

        return $results;
    }

    public function generatePdf($month, $year)
    {
        // Obtenir les données du journal
        $journal = $this->getJournal($month, $year);
    
        // Initialiser le PDF
        $pdf = new FPDF();
        $header = array('Date', utf8_decode('Numéro de Compte'), utf8_decode('Libellé'), utf8_decode('Débit'), utf8_decode('Crédit'));
    
        // Ajouter une page
        $pdf->AddPage();
    
        // Titre
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Journal des transactions '.$month.'/'.$year, 0, 1, 'C');
        $pdf->Ln(10);
    
        // En-têtes
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(200, 220, 255);
        $w = array(30, 30, 80, 25, 25);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }
        $pdf->Ln();
    
        // Données
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(255, 255, 255);
        $fill = false;
        foreach ($journal as $row) {
            $pdf->Cell($w[0], 6,utf8_decode( $row->transaction_date), 'LR', 0, 'L', $fill);
            $pdf->Cell($w[1], 6, utf8_decode($row->account_number), 'LR', 0, 'L', $fill);
            $pdf->Cell($w[2], 6, utf8_decode($row->libelle), 'LR', 0, 'L', $fill);
            $pdf->Cell($w[3], 6, number_format($row->debit, 2, ',', ' '), 'LR', 0, 'R', $fill);
            $pdf->Cell($w[4], 6, number_format($row->credit, 2, ',', ' '), 'LR', 0, 'R', $fill);
            $pdf->Ln();
            $fill = !$fill;
        }
        // Ligne de clôture
        $pdf->Cell(array_sum($w), 0, '', 'T');
    
        // Sauvegarder le PDF dans le répertoire uploads
        $uploadDir = FCPATH. 'uploads';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $pdfFilePath = $uploadDir. '/journal_'.$month.'_'.$year.'.pdf';
        $pdf->Output($pdfFilePath, 'F');
    
        return $pdfFilePath;
    }

}
?>
