<?php
include("conf.php");
include('conf_brand.php');

if(!session_id()) 
{
    session_start(); 
} 

if(isset($_REQUEST['zipcode'])){
    $_SESSION['type_insurance'] = $_REQUEST['productType'];
    $_SESSION['zipcode'] = $_REQUEST['zipcode'];
    $vars_template['type_insurance'] = $_REQUEST['productType']; 
    $vars_template['zipcode'] = $_REQUEST['zipcode']; 

    $zipcode = ($_REQUEST['zipcode']) ? filter_var($_REQUEST['zipcode'], FILTER_SANITIZE_STRING) : '';
    if (isset($_REQUEST['zipcode'])) {
        
        $url = 'http://www.confiejarvis.com/thor/get/' . $_REQUEST['zipcode'];
        $data = json_decode(file_get_contents($url));
        if (isset($data->data->City)) {
            $_SESSION['city'] = $data->data->City . ', ' . $data->data->State;
            $vars_template['city'] = $_SESSION['city'] ;
        }
    }
    
}


if(!isset($_SESSION['type_insurance'])){
    header("location: /"); 
}
//Definir name product

   if ($_SERVER['REQUEST_URI'] === '/form-lp' && !isset($_SESSION['type_insurance'])) {
        header("Location: /");
        exit;
    } else {
        global $mediacodes; // Define mediacodes como global
        $t_product = $_SESSION['type_insurance'];
        foreach($mediacodes as $code) {
            if($code['insurance'] === $t_product) {
                $_SESSION['product_name'] = $code['product'];
                break;
            }
        }
        global $vars_template;
        $vars_template['product-name'] = $_SESSION['product_name'];
    }

//definimos vista
$view="webform-general";

//Definimos la ubicación de Scarlet WItch :)
include(_TSCARLET."scarlet.php");

//Scarlet manifiestate
$scarlet=new scarlet(_TPATH,$view,$vars_template,"",$pwd_context);

//Scarlet haz la magia ;)
$scarlet->generate();




?>
