<?php

	// Запускаем сессию
	session_start();

	// Подключение файла, который содержит подключаемые модули
	require_once('configuration_files/include_modules.php');

	if ($_SESSION['user_id']) {
		teleportation('view/my_page.php');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Обмен сообщениями</title>
	<link href="css/style.css" rel="stylesheet" />
	<script src="js/jquery-1.11.2.min.js"></script>
	<script src="js/switch_input_registration.js"></script>
	<script src="js/validate/validate_form_registraion.js"></script>
	<script src="js/validate/validate_form_input.js"></script>


	<script src="js/validate/validate_registration_AJAX.js"></script>


	<style>

		.none {
			display: none;
		}

		.block {
			display: block;
		}

		#message_registration_AJAX {
			position: absolute;
			top: -23px;
			right: 0;
			width: 400px;
			padding: 10px;
			border-left: 2px solid red;
			border-bottom: 2px solid red;
			border-bottom-left-radius: 10px; 
			background: pink;
		}

	</style>

</head>
<body>

	<div id="wrapper">
		
		<div id="container_forms">

			<div class="conatiner_switch">
				<div id="switch_input">Вход</div>
				<div id="switch_registration">Регистрация</div>					
			</div>

			<form action="controllers/loginController.php" method="post" id="container_input">

				<h4 class="name_page">Вход</h4>

				<label for="user_name_input">Логин или адрес электронной почты:</label><br />
				<input type="text" name="user_name_input" id="user_name_input" /><br /><br />

				<label for="password_input">Пароль:</label><br />
				<input type="password" name="password_input" id="password_input" /><br /><br />

				<input type="submit" name="input" id="input" value="Вход" />
			</form>
			

			<form action="controllers/registrationController.php" method="post" id="container_registration">

				<h4 class="name_page">Регистрация</h4>

				<label for="user_name_registration">Имя пользователя:</label><br />
				<input type="text" name="user_name_registration" id="user_name_registration" onblur="process(this.value, this.id)" /><br /><br />

				<label for="second_name_registration">Фамилия:</label><br />
				<input type="text" name="second_name_registration" id="second_name_registration" onblur="process(this.value, this.id)" /><br /><br />

				<label for="login_registration">Логин:</label><br />
				<input type="text" name="login_registration" id="login_registration" onblur="process(this.value, this.id)" /><br /><br />

				<label for="password_registration">Пароль:</label><br />
				<input type="password" name="password_registration" id="password_registration" onblur="process(this.value, this.id)" /><br /><br />

				<label for="repeat_password_registration">Подтвердите пароль:</label><br />
				<input type="password" name="repeat_password_registration" id="repeat_password_registration" onblur="process(this.value, this.id)" /><br /><br />

				<label for="e_mail">Электронная почта:</label><br />
				<input type="text" name="e_mail" id="e_mail" onblur="process(this.value, this.id)" /><br /><br />

				<input type="submit" name="registration" id="registration" value="Регистрация" />
			</form>

		</div>


		<div id="message_about_errors_input"></div>
		<div id="message_about_errors_registration"></div>
		<div id="message_registration_AJAX">
		
			<p id="name_error_empty" class="none">Имя не введено</p>
			<p id="name_error_number" class="none">Имя не должно содержать чисел</p>

			<p id="second_name_error_empty" class="none">Фамилия не введена</p>
			<p id="second_name_error_number" class="none">Фамилия не должна содержать чисел</p>

			<p id="login_error_empty" class="none">Логин не введен</p>
			<p id="login_error_exist" class="none">Введенный логин уже существует, введите другой логин</p>

			<p id="password_error_empty" class="none">Не введен пароль</p>

			<p id="password2_error_empty" class="none">Не введен подтверждающий пароль</p>
			<p id="password_error_unequals" class="none">Пароли не совпадают</p>

			<p id="e_mail_error_empty" class="none">Электронная почта не введена</p>
			<p id="e_mail_error_syntax" class="none">Введенная электронная почта введена неверно</p>
			<p id="e_mail_error_exist" class="none">Введенная электронная почта уже существует, введите другую электронную почту</p>
			
		</div>

	</div>

	<script src="js/connect_func.js" type="text/javascript"></script>

</body>	
</html>