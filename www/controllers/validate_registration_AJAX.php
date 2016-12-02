<?php

	session_start();

	// Подключение файла, который содержит подключаемые модули
	require_once('../configuration_files/connectvars.php');
	require_once('../configuration_files/sanitize.php');

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
		or die('Невозможно связаться с базой данных!');
	
	// Используем кодировку "utf8"
	mysqli_query($dbc, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");




	// Проверка введенного имени пользователя
	function validateName($xml, $inputValue, $sorts) {

		// Есть ли хотя бы одно число
		$template = "/\d+/";

		// Если текстовое поле для имени пусто, то показать ошибку на странице о том, что нужно ввести имя и убрать другую ошибку
		if ($inputValue == "") {
			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('0')); // 0 - означает, что поле пустое (то есть ноль это ошибка)
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('name_error_empty'));


			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1')); // 1 - означает, что поле НЕ пустое (нет ошибки)
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('name_error_number'));
		}
		else
		// Если текстовое поле для имени не пусто и в имени есть хотя бы одно число, то показать ошибку на странице
		if (preg_match($template, $inputValue)) {
			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('0'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('name_error_number'));

			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('name_error_empty'));

		}
		else
		// Если текстовое поле для имени не пусто и в имени есть нет чисел, то убрать ошибку на странице
		if (!preg_match($template, $inputValue)) {
			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('name_error_number'));


			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('name_error_empty'));
		}
	}



	// Проверка введенной фамилии пользователя
	function validateSecondName($xml, $inputValue, $sorts) {

		// Есть ли хотя бы одно число
		$template = "/\d+/";

		// Если текстовое поле для фамилии пусто, то показать ошибку на странице о том, что нужно ввести фамилию и убрать другую ошибку
		if ($inputValue == "") {
			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('0'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('second_name_error_empty'));

			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('second_name_error_number'));
		}
		else
		// Если текстовое поле для фамилии не пусто и в фамилии есть хотя бы одно число, то показать ошибку на странице
		if (preg_match($template, $inputValue)) {
			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('0'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('second_name_error_number'));

			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('second_name_error_empty'));

		}
		else
		// Если текстовое поле для фамилии не пусто и в фамилии есть нет чисел, то убрать ошибку на странице
		if (!preg_match($template, $inputValue)/* && $inputValue != ""*/) {
			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('second_name_error_number'));

			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('second_name_error_empty'));

		}
	}



	// Проверка введенного логина
	function validateLogin($xml, $inputValue, $sorts, $dbc) {

		// Если текстовое поле для логина пустое, то вывести ошибку
		if ($inputValue == "") {
			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('0'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('login_error_empty'));

			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('login_error_exist'));
		}
		// Иначе текстовое поле для логина НЕ пустое
		else {

			$query_check_login = 'SELECT * FROM user WHERE login = "' . htmlentities($inputValue) .  '" LIMIT 1';	
				
			$result_query_check_login = mysqli_query($dbc, $query_check_login) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных');

			// Если пользователь уже зарегистрирован с таким логином, то вывести ошибку
			if (mysqli_num_rows($result_query_check_login) == 1) {
				$sort = $sorts->appendChild($xml->createElement('resp'));
					$price = $sort->appendChild($xml->createElement('result'));
					$price->appendChild($xml->createTextNode('0'));
					$name = $sort->appendChild($xml->createElement('fieldid'));
					$name->appendChild($xml->createTextNode('login_error_exist'));

				$sort = $sorts->appendChild($xml->createElement('resp'));
					$price = $sort->appendChild($xml->createElement('result'));
					$price->appendChild($xml->createTextNode('1'));
					$name = $sort->appendChild($xml->createElement('fieldid'));
					$name->appendChild($xml->createTextNode('login_error_empty'));

			}
			// Иначе, если пользователь НЕ зарегистрирован с таким логином, то ошибку спрятать
			else {
				$sort = $sorts->appendChild($xml->createElement('resp'));
					$price = $sort->appendChild($xml->createElement('result'));
					$price->appendChild($xml->createTextNode('1'));
					$name = $sort->appendChild($xml->createElement('fieldid'));
					$name->appendChild($xml->createTextNode('login_error_exist'));

				$sort = $sorts->appendChild($xml->createElement('resp'));
					$price = $sort->appendChild($xml->createElement('result'));
					$price->appendChild($xml->createTextNode('1'));
					$name = $sort->appendChild($xml->createElement('fieldid'));
					$name->appendChild($xml->createTextNode('login_error_empty'));
			}
			
		}

	}



	// Функция стравнения паролей
	function comparePass($xml, $pass1, $pass2, $sorts) {
		if ($pass1 == $pass2) {
			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('password_error_unequals'));
		} 
		else {
			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('0'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('password_error_unequals'));
		}
	}


	// Проверка введенного пароля
	function validatePassword($xml, $inputValue, $sorts) {

		$sort = $sorts->appendChild($xml->createElement('resp'));
				
		if ($inputValue == "") {
			$price = $sort->appendChild($xml->createElement('result'));
			$price->appendChild($xml->createTextNode('0'));		
		}
		else {
			$_SESSION['pass1'] = $inputValue;
			$price = $sort->appendChild($xml->createElement('result'));
			$price->appendChild($xml->createTextNode('1'));	
		}

		$name = $sort->appendChild($xml->createElement('fieldid'));
		$name->appendChild($xml->createTextNode('password_error_empty'));

		if (!empty($_SESSION['pass1']) && !empty($_SESSION['pass2'])) {
			comparePass($xml, $_SESSION['pass1'], $_SESSION['pass2'], $sorts);
		}

	}



	// Проверка введенного подтвержадающего пароля
	function validatePassword2($xml, $inputValue, $sorts) {

		$sort = $sorts->appendChild($xml->createElement('resp'));

		if ($inputValue == "") {
			$price = $sort->appendChild($xml->createElement('result'));
			$price->appendChild($xml->createTextNode('0'));				
		}
		else {
			$_SESSION['pass2'] = $inputValue;
			$price = $sort->appendChild($xml->createElement('result'));
			$price->appendChild($xml->createTextNode('1'));	
		}

		$name = $sort->appendChild($xml->createElement('fieldid'));
		$name->appendChild($xml->createTextNode('password2_error_empty'));

		if (!empty($_SESSION['pass1']) && !empty($_SESSION['pass2'])) {
			comparePass($xml, $_SESSION['pass1'], $_SESSION['pass2'], $sorts);
		}

	}



	// Проверка введенной электронной почты
	function validateEmail($xml, $inputValue, $sorts, $dbc) {

		$template = "|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i";

		if ($inputValue == "") {
			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('0'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('e_mail_error_empty'));

			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('e_mail_error_syntax'));

			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('e_mail_error_exist'));
		}
		else 
		if (!preg_match($template, $inputValue)/* && $inputValue != ""*/) {
			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('0'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('e_mail_error_syntax'));

			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('e_mail_error_empty'));

			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('e_mail_error_exist'));
		}
		else
		if ($inputValue != "") {

			// Если пользователь ввел в форму регистрации уже содержащийся e-mail, то "забраковать" его регистрацию.
			$query_check_e_mail = 'SELECT * FROM user WHERE e_mail = "' . $inputValue .  '" LIMIT 1';	
				

			$result_query_check_e_mail = mysqli_query($dbc, $query_check_e_mail) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 

			

			if (mysqli_num_rows($result_query_check_e_mail) == 1) {
				$sort = $sorts->appendChild($xml->createElement('resp'));
					$price = $sort->appendChild($xml->createElement('result'));
					$price->appendChild($xml->createTextNode('0'));
					$name = $sort->appendChild($xml->createElement('fieldid'));
					$name->appendChild($xml->createTextNode('e_mail_error_exist'));
			}
			else {
				$sort = $sorts->appendChild($xml->createElement('resp'));
					$price = $sort->appendChild($xml->createElement('result'));
					$price->appendChild($xml->createTextNode('1'));
					$name = $sort->appendChild($xml->createElement('fieldid'));
					$name->appendChild($xml->createTextNode('e_mail_error_exist'));
			} 

			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('e_mail_error_syntax'));

			$sort = $sorts->appendChild($xml->createElement('resp'));
				$price = $sort->appendChild($xml->createElement('result'));
				$price->appendChild($xml->createTextNode('1'));
				$name = $sort->appendChild($xml->createElement('fieldid'));
				$name->appendChild($xml->createTextNode('e_mail_error_empty'));

		}

	}


	// СОЗДАНИЕ И СОХРАНЕНИЕ ФАЙЛА XML

		$xml = new DomDocument('1.0','utf-8');

		$sorts = $xml->appendChild($xml->createElement('response'));
		//validateName($xml, $_POST['inputValue'], $sorts);
		
		switch ($_POST['fieldID']) {
			// проверить правильность имени пользователя
			case 'user_name_registration':
				validateName($xml, sanitizeMySQL($_POST['inputValue']), $sorts);
				break;

			// проверить правильность фамилии
			case 'second_name_registration':
				validateSecondName($xml, sanitizeMySQL($_POST['inputValue']), $sorts);
				break;

			// проверить правильность логина
			case 'login_registration':
				validateLogin($xml, sanitizeMySQL($_POST['inputValue']), $sorts, $dbc);
				break;

			// проверить правильность пароля
			case 'password_registration':
				validatePassword($xml, sanitizeMySQL($_POST['inputValue']), $sorts);
				break;

			// проверить правильность подтверждающего пароля 
			case 'repeat_password_registration':
				validatePassword2($xml, sanitizeMySQL($_POST['inputValue']), $sorts);
				break;

			// проверить, правильно ли указана электронная почта
			case 'e_mail':
				validateEmail($xml, sanitizeMySQL($_POST['inputValue']), $sorts, $dbc);
				break;
		}

		// Сохранение XML в файл
		$xml->save('errors.xml');

	// КОНЕЦ СОЗДАНИЯ И СОХРАНЕНИЕ ФАЙЛА XML




	// ЗАГРУЖАЕМ ФАЙЛ XML И ВЫВОДИМ ЕГО

		// результаты будем отправлять в формате XML
		header('Content-Type: text/xml');

		// сгенерировать заголовок XML
		echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';

		// создать элемент <response>
		echo '<response>';

			$xml2 = simplexml_load_file("errors.xml");
			
			foreach ($xml2->resp as $resp){
				echo '<result>' . $resp->result . '</result>   <fieldid>'. $resp->fieldid .'</fieldid>';
			}

		echo '</response>';

	// КОНЕЦ ЗАГРУЗКИ ФАЙЛА XML И ЕГО ВЫВОДА
 
?>