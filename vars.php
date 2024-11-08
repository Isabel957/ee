<?php
if(!session_id()) 
{
    session_start(); 
} 

$vars_template=array(
"page-title"=>"Vision - LP",
"header-h1"=>"Vision - LP",
"page-description"=>"",
"url-rater"=>"/save.php",
"form-lp"=>"/form-lp",
"office-routing"=>"",
// "media-code"=>"FWYTX-A-GO-LP-S-01833",
"phone-number"=>"800-472-2295",
"campaing-id"=>"",
"agency-code"=>"",
"short-form"=>"0",
"back"=>"../",
"zipcode" => $_SESSION['zipcode'],
"type_insurance" => $_SESSION['type_insurance'],
"city" => $_SESSION['city'],
);
$folder="PT008";
$vars_page=array();
?>
