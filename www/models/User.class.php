<?php


class User
{
	
	function __construct() {
		
	}


	// Получить список зарегистрированных пользователей
	function list_registered_users() {

		// Подключаем модули
		require_once('../configuration_files/include_modules.php');

		// Подключаемся к БД
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
			or die('Невозможно связаться с базой данных!');
	
		charset($dbc);



		$masUser = array();



		$query = 'SELECT id, url_avatar, name FROM user';

		$result = mysqli_query($dbc, $query) 
			or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 


		while ($row = mysqli_fetch_array($result)) {

			$masUser[count($masUser)] = $row;

		}


		return $masUser;

	}



}


?>