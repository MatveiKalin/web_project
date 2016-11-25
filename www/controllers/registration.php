<?php

	// Запускаем сессию
	session_start();
	
	// Подключаем модули
	require_once('../configuration_files/include_modules.php');
	
	// Если была нажата кнопка "Зарегистрироваться", то ...
	if (isset($_POST['registration'])) {
	
		// ... проверить введены ли в текстовые все текстовые поля в регистрационной форме
		if (
				!empty($_POST['user_name_registration']) && 
				!empty($_POST['second_name_registration']) && 
				!empty($_POST['login_registration'])  && 
				!empty($_POST['password_registration']) && 
				!empty($_POST['repeat_password_registration']) && 
				!empty($_POST['e_mail']) 
		) {
		
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
				or die(mysqli_error() . 'Невозможно подключиться к базе данных');

			charset($dbc);

			$user_name_registration = sanitizeMySQL($_POST['user_name_registration']);
			$second_name_registration = sanitizeMySQL($_POST['second_name_registration']);
			$login_registration = sanitizeMySQL($_POST['login_registration']);
			$password_registration = sanitizeMySQL(strtolower($_POST['password_registration']));
			$repeat_password_registration = sanitizeMySQL($_POST['repeat_password_registration']);
			$e_mail = sanitizeMySQL($_POST['e_mail']);


			/*$user_name_registration = $_POST['user_name_registration'];
			$second_name_registration = $_POST['second_name_registration'];
			$login_registration = $_POST['login_registration'];
			$password_registration = $_POST['password_registration'];
			$repeat_password_registration = $_POST['repeat_password_registration'];
			$e_mail = $_POST['e_mail'];*/


			// Если пользователь ввел подтверждающий пароль не такой какой нужно запретить регистрацию
			if ($password_registration != $repeat_password_registration) {
				echo '<p class="warning">Пароли не совадают</p>';
				exit();
			}

																	 
												
			// Если пользователь ввел в форму регистрации уже содержащийся e-mail, то "забраковать" его регистрацию.
			$query_check_e_mail = 'SELECT * FROM user WHERE e_mail = "' . $e_mail .  '" LIMIT 1';	
				

			$result_query_check_e_mail = mysqli_query($dbc, $query_check_e_mail) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 	


			// Если пользователь ввел в форму регистрации уже содержащийся login, то "забраковать" его регистрацию.
			$query_check_login = 'SELECT * FROM user WHERE login = "' . $login_registration .  '" LIMIT 1';	
				
			$result_query_check_login = mysqli_query($dbc, $query_check_login) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 


			// Проверка на совпадение login
			if (mysqli_num_rows($result_query_check_login) == 1) {
				echo '<p class="warning">Извините, такой пользователь уже существует, c введенным Вами логином</p>';
			}
			else
			// Проверка на совпадение e_mail
			if (mysqli_num_rows($result_query_check_e_mail) == 1) {
				echo '<p class="warning">Извините, такой пользователь уже существует, c введенным Вами e-mail</p>';
			}
			// Если таких пользователей нет в базе данных, то успешно зарегистрировать пользователя
			else {
				
				$query = "INSERT INTO user (name, surname, login, password, e_mail, date_registration) 
						  VALUES ('$user_name_registration', '$second_name_registration', '$login_registration', SHA('$password_registration'), '$e_mail', NOW())";			
				
				mysqli_query($dbc, $query) 
					or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных, при регистрации пользователя'); 
					

				// После регистрации необходимо у нового зарегистрированного пользователя записать в сессию идентификатор пользователя
				charset($dbc);
				
				$query = "SELECT * FROM user WHERE name = '$user_name_registration' AND surname = '$second_name_registration' AND 
													login = '$login_registration' AND password = SHA('$password_registration') AND e_mail = '$e_mail'";	
				
				$result = mysqli_query($dbc, $query) 
					or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 
				
				if (mysqli_num_rows($result) == 1) {
					
					$row = mysqli_fetch_array($result);
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['surname'] = $row['surname'];
					
				}
				
				mysqli_close($dbc);
				
				// Вызываем функцию, которая переадресует на страницу, имя которой написано в параметре
				teleportation('../pages/my_page.php');

			}
		}
		else {
			echo '<p class="warning">Были заполнены не все текстовые поля при регистрации.</p>';

			/*echo $_POST['user_name_registration'] . "<br />";
			echo $_POST['second_name_registration'] . "<br />";
			echo $_POST['login_registration'] . "<br />";
			echo $_POST['password_registration'] . "<br />";
			echo $_POST['repeat_password_registration'] . "<br />";
			echo $_POST['e_mail'];*/
		}
	}
	
?>