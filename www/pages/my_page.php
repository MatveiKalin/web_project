<?php

	// Запускаем сессию
	session_start();

	// Подключение файла, который содержит подключаемые модули
	require_once('../configuration_files/include_modules.php');

	print_head_pages();

	print_left_menu();


	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
		or die('Невозможно связаться с базой данных!');
	
	charset($dbc);


	define('GW_UPLOADPATH', '../img/users_avatar');


	$query = 'SELECT * FROM user WHERE id = ' . $_SESSION['user_id'];

	$result = mysqli_query($dbc, $query) 
		or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 

	$row = mysqli_fetch_array($result);

?>

		<div id="main">
			<h2>Моя страница</h2>

			<a href="change_personal_data.php" class="btn_change_personal_data">Изменить личные данные</a>

<?php
			echo '<label class="bold">Меня зовут: </label>' . $row['name'] . ' ' .  $row['surname'] . '<br /><br />';
?>

			<label class="bold">Фотография:</label><br />
<?php
			if (is_file($row['url_avatar']) && filesize($row['url_avatar']) > 0) {
				echo '<img src="' . $row['url_avatar'] . '" width="150" height="150" alt="Фотография пользователя" /><br /><br />';
			}
			else {
				echo '<img src="../img/defaultUserAvatar.png" width="150" height="150" alt="Фотография пользователя" /><br /><br />';
			}



			echo '<label class="bold">Дата рождения: </label>';
			if (!empty($row['day_birthday']) && !empty($row['month_birthday']) && !empty($row['year_birthday']) ) {
				echo $row['day_birthday'] . ' ' . $row['month_birthday']. ' ' . $row['year_birthday'] . '<br /><br />';
			}
			else {
				echo 'Отсутствует информация<br /><br />';
			}


			echo '<label class="bold">Страна: </label>';
			if (!empty($row['country'])) {
				echo $row['country'] . '<br /><br />';
			}
			else {
				echo 'Отсутствует информация<br /><br />';
			}

			echo '<label class="bold">О себе: </label>';
			if (!empty($row['about_me'])) {
				echo $row['about_me'] . '<br /><br />';
			}
			else {
				echo 'Отсутствует информация<br /><br />';
			}

			/*<label class="bold">Дата рождения: </label>23.08.xx<br /><br />

			<label class="bold">Страна: </label>Россия<br /><br />

			<label class="bold">Город: </label>Пермь<br /><br />

			<label class="bold">О себе: </label>Это тайная информация.<br />	*/

?>					
		</div>
		
<?php
	print_bootom_root();
?>