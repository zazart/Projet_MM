<?php 
    // application/controllers/Journal.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Journal_model');
        $this->load->helper('url');
    }

    public function index()
    {
        // Get month and year from URL parameters or default to current month and year
        $month = intval($this->input->get('month')) ?: date('m');
        $year = intval($this->input->get('year')) ?: date('Y');

        $data['journal'] = $this->Journal_model->getJournal($month, $year);
        $data['month'] = $month;
        $data['year'] = $year;

        // Load the template view with the contents view
        $data['contents'] = 'pages/depenses/journal_view'; // Contents view
        // Activation de lien
        $data['etat'] = 'depense';
        $data['activer'] = 'lien_journal';
        $this->load->view('templates/template', $data);
    }

    public function previous()
    {
        $month = intval($this->input->get('month')) ?: date('m');
        $year = intval($this->input->get('year')) ?: date('Y');

        // Calculate previous month and year
        if ($month == 1) {
            $prevMonth = 12;
            $prevYear = $year - 1;
        } else {
            $prevMonth = $month - 1;
            $prevYear = $year;
        }

        redirect('journal/index?month=' . $prevMonth . '&year=' . $prevYear);
    }

    public function next()
    {
        $month = intval($this->input->get('month')) ?: date('m');
        $year = intval($this->input->get('year')) ?: date('Y');

        // Calculate next month and year
        if ($month == 12) {
            $nextMonth = 1;
            $nextYear = $year + 1;
        } else {
            $nextMonth = $month + 1;
            $nextYear = $year;
        }
        redirect('journal/index?month=' . $nextMonth . '&year=' . $nextYear);
    }

    public function generatePdf()
    {
        $month = intval($this->input->get('month')) ?: date('m');
        $year = intval($this->input->get('year')) ?: date('Y');

        // Generate PDF
        $pdfFilePath = $this->Journal_model->generatePdf($month, $year);

        //Redirect to the generated PDF file
        redirect(base_url('uploads\journal_' . $month . '_' . $year . '.pdf'));
    }
}

?>