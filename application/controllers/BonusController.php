<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BonusController extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // $this->load->model('Bonus_model');
    }
    public function find_all(){
        $bonuses = $this->find_all();
        $this->output->set_content_type('application/json')->set_output(json_encode($bonuses));

    }
}
