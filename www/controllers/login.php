<?php

/*
* Описание: Данный файл содержит код, который позволяет войти пользователю в свой профиль
*
* Разработал: Матвей Калин.
*
* Дата создания: 27.03.2015.
*
* Дата последнего изменения: 28.03.2015.
*/
	
	// Запускаем сессию
	session_start();
	
	// Подключаем модули
	require_once('../configuration_files/include_modules.php');
	
	// Если была нажата кнопка "Вход", то ...
	if (isset($_POST['input'])) {
		
		// ... проверить введены ли в текстовые все текстовые поля в регистрационной форме
		if (!empty($_POST['user_name_input']) && !empty($_POST['password_input'])) {
		
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
				or die(mysqli_error() . 'Невозможно подключиться к базе данных');

			charset($dbc);


			$login_or_email = sanitizeMySQL($_POST['user_name_input']);
			$password = sanitizeMySQL($_POST['password_input']);
			
			
			$query_login = "SELECT * FROM user WHERE login = '$login_or_email' AND password = SHA('$password')";
			$query_e_mail = "SELECT * FROM user WHERE e_mail = '$login_or_email' AND password = SHA('$password')";				
			

			$result_login = mysqli_query($dbc, $query_login) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 

			$result_e_mail = mysqli_query($dbc, $query_e_mail) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 
				

			if (mysqli_num_rows($result_login) == 1) {
			
				$row = mysqli_fetch_array($result_login);
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['surname'] = $row['surname'];

				echo $_SESSION['user_id'];

				mysqli_close($dbc);

				// ... переходим на страницу администратора
				teleportation('../pages/my_page.php');

			}
			else 
			if (mysqli_num_rows($result_e_mail) == 1){
				$row = mysqli_fetch_array($result_e_mail);
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['surname'] = $row['surname'];

				echo $_SESSION['user_id'];

				mysqli_close($dbc);

				// ... переходим на страницу администратора
				teleportation('../pages/my_page.php');
			}
			else {
				// Вызываем функцию, которая переадресует на страницу, имя которой написано в параметре
				teleportation('../index.php');
			}		
		}
		else {
			 
			// Вызываем функцию, которая переадресует на страницу, имя которой написано в параметре
			//teleportation('../index.php');

		}
					
	}

?>