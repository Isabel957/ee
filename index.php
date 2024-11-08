<?php
include("conf.php");
include('conf_brand.php');


//definimos vista
$view="index";

//Definimos la ubicación de Scarlet WItch :)
include(_TSCARLET."scarlet.php");

//Scarlet manifiestate
$scarlet=new scarlet(_TPATH,$view,$vars_template,"",$pwd_context);

//Scarlet haz la magia ;)
$scarlet->generate();
session_destroy();

?>
