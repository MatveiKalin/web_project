<?php


class User
{
	
	function __construct() {
		
	}


	// Получить список собеседников
	function list_interlocutors($id_user) {

		// Подключаем модули
		require_once('../configuration_files/include_modules.php');

		// Подключаемся к БД
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
			or die('Невозможно связаться с базой данных!');
	
		charset($dbc);



		$masInterlocutor = array();



		$query = 'SELECT * FROM interlocutor WHERE id_user = ' . $id_user;

		$result = mysqli_query($dbc, $query) 
			or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 


		while ($row = mysqli_fetch_array($result)) {

			$query_interlocutor = 'SELECT id, url_avatar, name FROM user WHERE id = ' . $row['id_interlocutor'];

			$result_interlocutor = mysqli_query($dbc, $query_interlocutor) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 

			$row_interlocutor = mysqli_fetch_array($result_interlocutor);

			// Массив будет содержать ИД, Имя и адрес к фото пользователя
			$masInterlocutor[count($masInterlocutor)] = $row_interlocutor;

		}


		return $masInterlocutor;

	}



}


?>