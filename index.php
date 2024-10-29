<?php
include('./inc/vista.inc.php');
$auntenticado=validaAutenticacion();
if($auntenticado=="SIP")
	{
	$vista=isset($_GET["view"]) ? $_GET["view"] : "home";
	if(file_exists($vista.'Controller.php'))
		{	
		include ($vista.'Controller.php');
		}
	else include('errorController.php'); 
	}
else {
	include('loginController.php');
}
?>
