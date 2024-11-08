<?php
include("conf.php");
include('conf_brand.php');

//definimos vista
$view="thanks";

//Definimos la ubicación de Scarlet WItch :)
include(_TSCARLET."scarlet.php");

//Scarlet manifiestate
$scarlet=new scarlet(_TPATH,$view,$vars_template,"",$pwd_context);

$scarlet->path_refs="../".$scarlet->path_refs;
//Scarlet haz la magia ;)
$scarlet->generate();
