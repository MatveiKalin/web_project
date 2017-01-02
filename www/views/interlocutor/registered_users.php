<?php
	
	// Вид, который выводит собеседников
	function registered_users_view($masUser) {

		echo '<h2>Зарегистрированные пользователи</h2>';

		for ($i = 0; $i < count($masUser); $i++) {

			echo '<div class="conteiner_user">';

			for ($j = 0; $j < count($masUser[$i]); $j++) {

				if ($j == 0) {
					echo '<div class="conteiner_btn">';
						echo '<a href="#?interlocutor=' .  $masUser[$i][$j] . '">Добавить в собеседники</a>';
						echo '<a href="#?id_user=' . $masUser[$i][$j] . '">Просмотреть личные данные</a>';
					echo '</div>';
				}


				if ($j == 1) {
					if (is_file($masUser[$i][$j]) && filesize($masUser[$i][$j]) > 0) {
						echo '<img src="' . $masUser[$i][$j] . '" class="avatar" width="100" height="100" alt="Фотография пользователя" />';
					}
					else {
						echo '<img src="../img/defaultUserAvatar.png" class="avatar" width="100" height="100" alt="Отсутствует фотография пользователя" />';
					}
				}


				if ($j == 2) {
					echo '<div class="mini_info_interlocutor">';
						echo $masUser[$i][$j];
					echo '</div>';
				}

			}

			echo '</div>';
		}

	}

?>