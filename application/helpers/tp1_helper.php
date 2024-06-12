<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    function getMonetaire($chiffre){
        $nombre = number_format($chiffre,0,""," ");
        return $nombre;
    }
?>