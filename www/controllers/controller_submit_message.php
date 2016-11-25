<?php

	// Запускаем сессию
	session_start();

	// Подключение файла, который содержит подключаемые модули
	require_once('../configuration_files/include_modules.php');

	if (isset($_SESSION['user_id'])) {

		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
			or die('Невозможно связаться с базой данных!');
	
		charset($dbc);


		$text_message = $_POST['text_message'];
		$id_interlocutor = $_POST['id_interlocutor'];


		$query = 'INSERT INTO message (id_user_from, id_user_to, text_message, date) 
				  VALUES (' . $_SESSION['user_id'] . ', ' . $id_interlocutor . ', "' . $text_message . '", NOW())';

		$result = mysqli_query($dbc, $query) 
			or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 
			

		// Вызываем функцию, которая переадресует на страницу, имя которой написано в параметре
		teleportation('../pages/write_personal_message.php?interlocutor=' . $id_interlocutor);
	}

?>