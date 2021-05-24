<?php

//echo $config->base_url;
require_once("../classes/Template.php");
$template = new Template();
if(isset($_GET)){
$func = $_GET['action'];
$template->$func();
}




?>