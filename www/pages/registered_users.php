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


	$query = 'SELECT * FROM user';

	$result = mysqli_query($dbc, $query) 
		or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 


?>

		<div id="main">
			<h2>Зарегистрированные пользователи</h2>

<?php
			while ($row = mysqli_fetch_array($result)) {

				if ( ($_SESSION['user_id'] != $row['id']) && ($row['id'] != 1) ) {

					echo '<div class="conteiner_user">';

						if (is_file($row['url_avatar']) && filesize($row['url_avatar']) > 0) {
							echo '<img src="' . $row['url_avatar'] . '" width="100" height="100" alt="Фотография пользователя" />';
						}
						else {
							echo '<img src="../img/defaultUserAvatar.png" width="100" height="100" alt="Отсутствует фотография пользователя" />';
						}

						echo '<div class="conteiner_btn">';
							echo '<a href="../controllers/add_interlocutor.php?interlocutor=' . $row['id'] . '">Добавить в собеседники</a>';
							echo '<a href="users_page.php?id_user=' . $row['id'] . '">Просмотреть личные данные</a>';
						echo '</div>';

						echo '<div>';
							echo '<p>' . $row['name'] . ' ' . $row['surname'] . '</p>';
							echo '<p>' . $row['country'] . '</p>';
						echo '</div>';

					echo '</div>';

					echo '<div class="clear"></div>';
				}

			}
?>

			

			

		</div>
		
<?php
	print_bootom_root();
?>