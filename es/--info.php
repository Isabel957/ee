<?php
include("conf.php");

//definimos vista
switch ($_GET["page"]) {
	case 'error':
		$view="error";
		break;
	case 'thanks':
		$view="thanks";
		break;
	default:
		$view="index";
		break;
}


//Definimos la ubicación de Scarlet WItch :)
include(_TSCARLET."scarlet.php");

//Scarlet manifiestate
$scarlet=new scarlet(_TPATH,$view,$vars_template);
$scarlet->path_refs="../".$scarlet->path_refs;
//Scarlet haz la magia ;)
$scarlet->generate();

$scarlet->getInfo();