<?php 
spl_autoload_register();
include_once   '/classes/InviteForm.php';
include_once   '/classes/Database.php';

$form= new InviteForm;
$form->del_in_bd();

<form action="admin.php">
	<p><input type="submit" value="Вернуться к файлам"></p>
</form>
?>
