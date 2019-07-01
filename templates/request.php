<!DOCTYPE html>
<html>
<head>
	<title>Авторизация</title>
</head>
<body>
	<h1 align="left">Введите данные в форму</h1>
	<form action="<?= $_SERVER['REQUEST_URI'];?>" method="POST">
		<label> Имя*</label>
		<br>
		<input placeholder="Имя" name="name" value="<?= isset($_POST['name']) ? $_POST['name']:''?>"><?php echo $form->errors_print('name') ?>
		<br>
		
		<br>
		<label> Фамилия: *</label>
		<br>
		<input placeholder="Фамилия" name="lastname" value="<?= isset($_POST['lastname']) ? $_POST['lastname']:''?>" required><?php echo $form->errors_print('lastname') ?>
		<br>
		
		<br>
		<label> Возраст: </label>
		<br>
		<input placeholder="Возраст" name="age" value="<?= isset($_POST['age']) ? $_POST['age']:''?>"><?php echo $form->errors_print('age') ?>
		<br>
		
		<br>
		<label> E-mail:* </label>
		<br>
		<input placeholder="Эл.адрес" name="email" value="<?= isset($_POST['email']) ? $_POST['email']:''?>" required><?php echo $form->errors_print('email') ?>
		<br>
		
		<br>
		<label> Город </label>
		<br>
		<select name="city">
			<option value="irk">Иркутск</option>
			<option value="ang">Ангарск</option>
			<option value="she">Шелехов</option>
			<option value="bra">Братск</option>
			<option value="msk">Москва</option>
			<option value="eka">Екатиренбург</option>
		</select> 
		<br>
		
		
		<br>
		<label> Телефон: </label>
		<br>
		<input placeholder="Телефон" name="phone" value="<?= isset($_POST['phone']) ? $_POST['phone']:''?>" required><?php echo $form->errors_print('phone') ?>
		<br>
		
		<br>
		<label>Выберете тематику конференции</label>
		<br>
		<select name="tema"> 
			<optgroup label="Тема"> 
				<option value="Bus" name="Bus">Бизнес</option> 
				<option value="Tex" name="Tex">Технологии</option>
				<option value="RM" name="RM">Реклама и Маркетинг</option>
			</optgroup> 
		</select>
		<br>
		
		<br>
		<label>Выберете способ оплаты</label>
		<br>
		<select name="pay"> 
			<optgroup label="Оплата"> 
				<option value="WM" name="WM">WebMoney</option> 
				<option value="YA" name="YA">Yandex.money</option>
				<option value="PP" name="PP">PayPal</option>
				<option value="CC" name="CC">Credit card</option>
			</optgroup> 
		</select>
		<br>
		
		<br>
		<label> Хотите получать рассылку о конференции? </label>
		<br>
		<select name="agree"> 
			<optgroup label="Согласие"> 
				<option value="yes" name="yes">Да</option> 
				<option value="no" name="no">Нет</option>
			</optgroup> 
		</select>
		
	<p><input type="submit" value="Отправить"></p>
	</form>

	<form action="admin.php">
		<p><input type="submit" value="Админ"></p>
	</form>

</body>
</html>