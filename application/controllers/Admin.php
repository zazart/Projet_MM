<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Bonus_model');
    }
    // public function index(){
    //     $bonuses = $this->Bonus_model->find_all();
    //     var_dump($bonuses);

    // }
}
