<?php

spl_autoload_register();
include_once   'header.php';
include_once   '\classes\InviteForm.php'; 

error_reporting(0);
$form= new InviteForm;

if (!empty($_POST))
{
	$form->request();
}
include_once   '\templates\request.php'; 
?>
