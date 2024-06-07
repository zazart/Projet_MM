<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    function isnull ($value, $name){
        if ($value === null) {
            return true;   
        }else{
            return array($name => 'Le champ '.$name.' est obligatoire');
        }
    }
?>