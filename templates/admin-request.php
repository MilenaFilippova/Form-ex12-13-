<!DOCTYPE HTML> 
<html> 
<head> 
	<meta charset="utf-8"> 
	<title>Test_Form</title> 
</head> 
<body> 
	<h2 align="center">Регистрации: </h2>
	<form action="admindel.php" method="POST"> 
		<?php
			$form->getRows_from_bd();
		?>
	<p><input type="submit" value="Удалить данные"></p> 
	</form>  
	<p><a href="/../index.php">Вернутся к форме</a></p>
</body> 
</html>