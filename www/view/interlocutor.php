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


	//$query = 'SELECT * FROM user';

	$query = 'SELECT * FROM interlocutor WHERE id_user = ' . $_SESSION['user_id'];


	$result = mysqli_query($dbc, $query) 
		or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 


?>

		<div id="main">
			<h2>Собеседники</h2>

<?php
			while ($row = mysqli_fetch_array($result)) {

				$query_interlocutor = 'SELECT * FROM user WHERE id = ' . $row['id_interlocutor'];

				$result_interlocutor = mysqli_query($dbc, $query_interlocutor) 
					or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 

				$row_interlocutor = mysqli_fetch_array($result_interlocutor);


				echo '<div class="conteiner_user">';

					if (is_file($row_interlocutor['url_avatar']) && filesize($row_interlocutor['url_avatar']) > 0) {
						echo '<img src="' . $row_interlocutor['url_avatar'] . '" width="100" height="100" alt="Фотография пользователя" />';
					}
					else {
						echo '<img src="../img/defaultUserAvatar.png" width="100" height="100" alt="Отсутствует фотография пользователя" />';
					}

					echo '<div class="conteiner_btn">';
						echo '<a href="write_personal_message.php?interlocutor=' . $row_interlocutor['id'] . '">Написать сообщение</a>';
						echo '<a href="users_page.php?id_user=' . $row_interlocutor['id'] . '">Просмотреть личные данные</a>';
					echo '</div>';

					echo '<div>';
						echo '<p>' . $row_interlocutor['name'] . ' ' . $row_interlocutor['surname'] . '</p>';
						echo '<p>' . $row_interlocutor['country'] . '</p>';
					echo '</div>';

				echo '</div>';

				echo '<div class="clear"></div>';

			}
?>

		</div>
		
<?php
	print_bootom_root();
?>