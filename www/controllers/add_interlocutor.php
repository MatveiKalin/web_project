<?php

	// Запускаем сессию
	session_start();

	// Подключение файла, который содержит подключаемые модули
	require_once('../configuration_files/include_modules.php');

	if (isset($_SESSION['user_id'])) {

		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
			or die('Невозможно связаться с базой данных!');
	
		charset($dbc);


		$id_interlocutor = $_GET['interlocutor'];


		$query = 'INSERT INTO interlocutor (id_user, id_interlocutor) VALUES (' . $_SESSION['user_id'] . ', ' . $id_interlocutor . ')';

		$result = mysqli_query($dbc, $query) 
			or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 
			

		// Вызываем функцию, которая переадресует на страницу, имя которой написано в параметре
		teleportation('../pages/registered_users.php');
	}

?>