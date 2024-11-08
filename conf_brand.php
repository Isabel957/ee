<?php

$dominio_actual = $_SERVER['HTTP_HOST'];

$dominio_actual =  str_replace('www.','',$dominio_actual);
// Utilizar un switch para seleccionar la configuración
switch ($dominio_actual) {

    case "visions.insureone.com":
            $vars_template['logo-header'] = 'vision-logo';
            $vars_template['phone-number'] = '800-472-2295';
            $mediacodes  = array( 
                array('media_code' => 'INONA-A-VIS-LP-E-11528',  'insurance' => 'A', 'product' => 'Auto Insurance' ) ,
                array('media_code' => 'INONA-H-VIS-LP-E-11529',  'insurance' => 'H', 'product' => 'Homeowners' ) ,
                array('media_code' => 'INONA-R-VIS-LP-E-11530',  'insurance' => 'R', 'product' => 'Renters Insurance' ) ,
                array('media_code' => 'INONA-CI-VIS-LP-E-11531',  'insurance' => 'CI', 'product' => 'Commercial Insurance' ) ,
                array('media_code' => 'INONA-O-VIS-LP-E-11532',  'insurance' => 'O', 'product' => 'Other' ) 

            );
    
            break;

        default:
        // var_dump($dominio_actual,$_SERVER['HTTP_HOST']);
        // die();
        break;
    }
