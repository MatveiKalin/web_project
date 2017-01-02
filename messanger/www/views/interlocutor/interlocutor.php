<?php
	
	// Вид, который выводит собеседников
	function interlocutor_view($masInterlocutor) {

		echo '<h2>Собеседники</h2>';

		for ($i = 0; $i < count($masInterlocutor); $i++) {

			echo '<div class="conteiner_user">';

			for ($j = 0; $j < count($masInterlocutor[$i]); $j++) {

				if ($j == 0) {
					echo '<div class="conteiner_btn">';
						echo '<a href="write_personal_message.php?interlocutor=' . $masInterlocutor[$i][$j] . '">Написать сообщение</a>';
						echo '<a href="users_page.php?id_user=' .$masInterlocutor[$i][$j] . '">Просмотреть личные данные</a>';
					echo '</div>';
				}


				if ($j == 1) {
					if (is_file($masInterlocutor[$i][$j]) && filesize($masInterlocutor[$i][$j]) > 0) {
						echo '<img src="' . $masInterlocutor[$i][$j] . '" class="avatar" width="100" height="100" alt="Фотография пользователя" />';
					}
					else {
						echo '<img src="../img/defaultUserAvatar.png" class="avatar" width="100" height="100" alt="Отсутствует фотография пользователя" />';
					}
				}


				if ($j == 2) {
					echo '<div class="mini_info_interlocutor">';
						echo $masInterlocutor[$i][$j];
					echo '</div>';
				}

			}

			echo '</div>';
		}

	}

?>