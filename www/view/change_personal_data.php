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

	$query = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

	$result = mysqli_query($dbc, $query)
		or die('Невозможно выполнить запрос');

	$row = mysqli_fetch_array($result);

?>

		<div id="main">
			<h2>Изменение личных данных</h2>

			
			<form enctype="multipart/form-data" method="post" action="../controllers/controller_change_personal_data.php">

				<label class="bold">Мое имя: </label><br />
				<input type="text" name="name" value="<?php echo $row['name']; ?>" /><br /><br />

				<label class="bold">Моя фамилия: </label><br />
				<input type="text" name="surname" value="<?php echo $row['surname']; ?>" /><br /><br />

				<label class="bold">Фотография:</label><br />

<?php
				

				if (is_file($row['url_avatar']) && filesize($row['url_avatar']) > 0) {
					echo '<img src="' . $row['url_avatar'] . '" width="150" height="150" alt="Фотография пользователя" /><br /><br />';
				}
				else {
					echo '<img src="../img/defaultUserAvatar.png" width="150" height="150" alt="Фотография пользователя" /><br /><br />';
				}

				echo '<input type="file" id="photo" name="photo" /><br /><br />';



				echo '<label class="bold">День рождения: </label><br />';
				echo '<select name="day_birthday">';

					for ($i = 1; $i < 31; $i++) { 

						if ($row['day_birthday'] == $i) {
							echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
						}
						else {
							echo '<option value="' . $i . '">' . $i . '</option>';
						}

					}

				echo '</select><br /><br />';



				$month = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'); 
				echo '<label class="bold">Месяц рождения: </label><br />';
				echo '<select name="month_birthday">';

					foreach ($month as $key => $value) {

						if ($row['month_birthday'] == $value) {
							echo '<option value="' . $value . '" selected="selected">' . $value . '</option>';
						}
						else {
							echo '<option value="' . $value . '">' . $value . '</option>';
						}

					}

				echo '</select><br /><br />';



				echo '<label class="bold">Год рождения: </label><br />';
				$query_year = 'SELECT * FROM year';

				$result_year = mysqli_query($dbc, $query_year)
					or die('Невозможно выполнить запрос');

				echo '<select name="year_birthday">';

				/*while ($row = mysqli_fetch_array($result_year)) {
					echo '<option value="' . $row['year'] . '">' . $row['year'] . '</option>';				
				}*/

				while ($row_year = mysqli_fetch_array($result_year)) {

					if ($row_year['year'] == $row['year_birthday']) {
						echo '<option value="' . $row_year['year'] . '" selected="selected">' . $row_year['year'] . '</option>';	
					}	
					else {
						echo '<option value="' . $row_year['year'] . '">' . $row_year['year'] . '</option>';	
					}	

				}

				echo '</select><br /><br />';



				echo '<label class="bold">Страна: </label><br />';
				$query_country = 'SELECT * FROM country';

				$result_country = mysqli_query($dbc, $query_country)
					or die('Невозможно выполнить запрос');

				echo '<select name="country">';

				/*while ($row = mysqli_fetch_array($result_year)) {
					echo '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';				
				}*/

				while ($row_country = mysqli_fetch_array($result_country)) {
					if ($row_country['Name'] == $row['country']) {
						echo '<option value="' . $row_country['Name'] . '" selected="selected">' . $row_country['Name'] . '</option>';	
					}	
					else {
						echo '<option value="' . $row_country['Name'] . '">' . $row_country['Name'] . '</option>';	
					}		
				}

				echo '</select><br /><br />';



				/*echo '<label class="bold">Город: </label><br />';
				echo '<select name="country">';
					echo '<option>Москва</option>';
					echo '<option>Санкт-Петербург</option>';
					echo '<option>Пермь</option>';
				echo '</select><br /><br />';*/


				echo '<label class="bold">О себе: </label><br />';
				echo '<textarea class="textarea_text" name="about_me">' . $row['about_me'] . '</textarea><br />';
?>					
				<input type="submit" name="change_personal_data" class="btn_change btn" value="Изменить" />

			</form>
				
		</div>
		
<?php
	print_bootom_root();
?>