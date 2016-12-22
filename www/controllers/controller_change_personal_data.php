<?php

	// Запускаем сессию
	session_start();

	// Подключение файла, который содержит подключаемые модули
	require_once('../configuration_files/include_modules.php');

	define('GW_UPLOADPATH', '../img/users_avatar/');

	if (isset($_POST['change_personal_data'])) {

		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
			or die('Невозможно связаться с базой данных!');
	
		charset($dbc);


		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$day_birthday = $_POST['day_birthday'];
		$month_birthday = $_POST['month_birthday'];
		$year_birthday = $_POST['year_birthday'];
		$country = $_POST['country'];
		$about_me = $_POST['about_me'];

		$photo = $_FILES['photo']['name'];

		$target = GW_UPLOADPATH . $photo;

		// Если была выбрана фотография
		if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
		
			$query = 'UPDATE user SET name="' . $name . '", surname="' . $surname . '", day_birthday=' . $day_birthday . ', month_birthday="' . $month_birthday . '", year_birthday="' . $year_birthday . '", country="' . $country . '", url_avatar="' . $target . '", about_me="' . $about_me . '" WHERE id = ' . $_SESSION['user_id'];

		}
		else {
			$query = 'UPDATE user SET name="' . $name . '", surname="' . $surname . '", day_birthday=' . $day_birthday . ', month_birthday="' . $month_birthday . '", year_birthday="' . $year_birthday . '", country="' . $country . '", about_me="' . $about_me . '" WHERE id = ' . $_SESSION['user_id'];
		}

		$result = mysqli_query($dbc, $query) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 

		// Вызываем функцию, которая переадресует на страницу, имя которой написано в параметре
		teleportation('../view/my_page.php');
	}

?>