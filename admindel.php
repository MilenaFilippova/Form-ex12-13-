<?php 
spl_autoload_register();//Регистрирует заданную функцию в качестве реализации метода
include_once   '/classes/InviteForm.php';
include_once   '/classes/Database.php';

$form= new InviteForm;
$form->del_in_bd();

<form action="admin.php">
	<p><input type="submit" value="Вернуться к файлам"></p>
</form>
?>
