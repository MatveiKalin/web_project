<?php
		
		session_start();

		// Подключение файла, который содержит подключаемые модули
		require_once('../configuration_files/connectvars.php');

		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
			or die('Невозможно связаться с базой данных!');
		
		// Используем кодировку "utf8"
		mysqli_query($dbc, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");



		// Проверка введенного имени пользователя
		function validateName($inputValue) {

			// Есть ли хотя бы одно число
			$template = "/\d+/";

			// Если текстовое поле для имени пусто, то показать ошибку на странице о том, что нужно ввести имя и убрать другую ошибку
			if ($inputValue == "") {
 				echo '<result>0</result>';
 				echo '<fieldid>name_error_empty</fieldid>';

 				echo '<result>1</result>';
 				echo '<fieldid>name_error_number</fieldid>';
 			}
 			else
 			// Если текстовое поле для имени не пусто и в имени есть хотя бы одно число, то показать ошибку на странице
 			if (preg_match($template, $inputValue) && $inputValue != "") {
 				echo '<result>0</result>';
 				echo '<fieldid>name_error_number</fieldid>';

 				echo '<result>1</result>';
 				echo '<fieldid>name_error_empty</fieldid>';
 			}
 			else
 			// Если текстовое поле для имени не пусто и в имени есть нет чисел, то убрать ошибку на странице
			if (!preg_match($template, $inputValue) && $inputValue != "") {
 				echo '<result>1</result>';
 				echo '<fieldid>name_error_number</fieldid>';

 				echo '<result>1</result>';
 				echo '<fieldid>name_error_empty</fieldid>';
 			}
		}



		// Проверка введенной фамилии пользователя
		function validateSecondName($inputValue) {

			// Есть ли хотя бы одно число
			$template = "/\d+/";

			// Если текстовое поле для фамилии пусто, то показать ошибку на странице о том, что нужно ввести фамилию и убрать другую ошибку
			if ($inputValue == "") {
 				echo '<result>0</result>';
 				echo '<fieldid>second_name_error_empty</fieldid>';

 				echo '<result>1</result>';
 				echo '<fieldid>second_name_error_number</fieldid>';
 			}
 			else
 			// Если текстовое поле для фамилии не пусто и в фамилии есть хотя бы одно число, то показать ошибку на странице
 			if (preg_match($template, $inputValue) && $inputValue != "") {
 				echo '<result>0</result>';
 				echo '<fieldid>second_name_error_number</fieldid>';

 				echo '<result>1</result>';
 				echo '<fieldid>second_name_error_empty</fieldid>';
 			}
 			else
 			// Если текстовое поле для фамилии не пусто и в фамилии есть нет чисел, то убрать ошибку на странице
			if (!preg_match($template, $inputValue) && $inputValue != "") {
 				echo '<result>1</result>';
 				echo '<fieldid>second_name_error_number</fieldid>';

 				echo '<result>1</result>';
 				echo '<fieldid>second_name_error_empty</fieldid>';
 			}

		}



		// Проверка введенного логина
		function validateLogin($inputValue, $dbc) {

			// Если текстовое поле для логина пустое, то вывести ошибку
 			if ($inputValue == "") {
 				echo '<result>0</result>';
 				echo '<fieldid>login_error_empty</fieldid>';	

 				echo '<result>1</result>';
				echo '<fieldid>login_error_exist</fieldid>';	
 			}
 			// Иначе текстовое поле для логина НЕ пустое
 			else {

				$query_check_login = 'SELECT * FROM user WHERE login = "' . htmlentities($inputValue) .  '" LIMIT 1';	
					
				$result_query_check_login = mysqli_query($dbc, $query_check_login) 
					or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных');

				// Если пользователь уже зарегистрирован с таким логином, то вывести ошибку
				if (mysqli_num_rows($result_query_check_login) == 1) {
					echo '<result>0</result>';
 					echo '<fieldid>login_error_exist</fieldid>';

 					echo '<result>1</result>';
 					echo '<fieldid>login_error_empty</fieldid>';
				}
				// Иначе, если пользователь НЕ зарегистрирован с таким логином, то ошибку спрятать
				else {
					echo '<result>1</result>';
 					echo '<fieldid>login_error_exist</fieldid>';

 					echo '<result>1</result>';
 					echo '<fieldid>login_error_empty</fieldid>';
				}
 				
 			}

		}


		// Функция стравнения паролей
		function comparePass($pass1, $pass2) {
			if ($pass1 == $pass2) {
				echo '<result>1</result>';	
				echo '<fieldid>password_error_unequals</fieldid>';
			} 
			else {
				echo '<result>0</result>';	
				echo '<fieldid>password_error_unequals</fieldid>';
			}
		}


		// Проверка введенного пароля
		function validatePassword($inputValue) {

 			if ($inputValue == "") {
 				echo '<result>0</result>';		
 			}
 			else {
 				$_SESSION['pass1'] = $inputValue;
 				echo '<result>1</result>';
 			}

 			echo '<fieldid>password_error_empty</fieldid>';

 			if (!empty($_SESSION['pass1']) && !empty($_SESSION['pass2'])) {
 				comparePass($_SESSION['pass1'], $_SESSION['pass2']);
 			}

		}

		// Проверка введенного подтвержадающего пароля
		function validatePassword2($inputValue) {

 			if ($inputValue == "") {
 				echo '<result>0</result>';		
 			}
 			else {
 				$_SESSION['pass2'] = $inputValue;
 				echo '<result>1</result>';
 			}

 			echo '<fieldid>password2_error_empty</fieldid>';

 			if (!empty($_SESSION['pass1']) && !empty($_SESSION['pass2'])) {
 				comparePass($_SESSION['pass1'], $_SESSION['pass2']);
 			}

		}


		// Проверка введенной электронной почты
		function validateEmail($inputValue, $dbc) {

			//
			//$template = "/[^a-zA-Z0-9.@_-]/";
			$template = "|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i";

			if ($inputValue == "") {
 				echo '<result>0</result>';
 				echo '<fieldid>e_mail_error_empty</fieldid>';

 				echo '<result>1</result>';
 				echo '<fieldid>e_mail_error_syntax</fieldid>';

 				echo '<result>1</result>';
 				echo '<fieldid>e_mail_error_exist</fieldid>';		
 			}
			else 
 			if (!preg_match($template, $inputValue) && $inputValue != "") {
 				echo '<result>0</result>';
 				echo '<fieldid>e_mail_error_syntax</fieldid>';

 				echo '<result>1</result>';
 				echo '<fieldid>e_mail_error_empty</fieldid>';

 				echo '<result>1</result>';
 				echo '<fieldid>e_mail_error_exist</fieldid>';
 			}
 			else
 			if ($inputValue != "") {
 				// Если пользователь ввел в форму регистрации уже содержащийся e-mail, то "забраковать" его регистрацию.
				$query_check_e_mail = 'SELECT * FROM user WHERE e_mail = "' . $inputValue .  '" LIMIT 1';	
					

				$result_query_check_e_mail = mysqli_query($dbc, $query_check_e_mail) 
					or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 

				if (mysqli_num_rows($result_query_check_e_mail) == 1) {
					echo '<result>0</result>';
 					echo '<fieldid>e_mail_error_exist</fieldid>';
				}
				else {
					echo '<result>1</result>';
 					echo '<fieldid>e_mail_error_exist</fieldid>';
				} 

				echo '<result>1</result>';
 				echo '<fieldid>e_mail_error_syntax</fieldid>';

 				echo '<result>1</result>';
 				echo '<fieldid>e_mail_error_empty</fieldid>';
 			}

		}


	// результаты будем отправлять в формате XML
	header('Content-Type: text/xml');

	// сгенерировать заголовок XML
	echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';

	// создать элемент <response>
	echo '<response>';

	//echo $_POST['inputValue'] . ' = ' . $_POST['fieldID'];

	switch ($_POST['fieldID']) {
		// проверить правильность имени пользователя
		case 'user_name_registration':
			validateName($_POST['inputValue']);
			break;

		// проверить правильность имени
		case 'second_name_registration':
			validateSecondName($_POST['inputValue']);
			break;

		// проверить, выбран ли пол
		case 'login_registration':
			validateLogin($_POST['inputValue'], $dbc);
			break;

		// проверить корректность месяца
		case 'password_registration':
			validatePassword($_POST['inputValue']);
			break;

		// проверить, правильно указан день рождения
		case 'repeat_password_registration':
			validatePassword2($_POST['inputValue']);
			break;

		// проверить, правильно ли указан год рождения
		case 'e_mail':
			validateEmail($_POST['inputValue'], $dbc);
			break;
	}


	// закрыть элемент <response>
	echo '</response>';

?>