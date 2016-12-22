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


	$interlocutor = $_GET['interlocutor'];

?>

		<div id="main">
			<h2>Диалог</h2>

			<form action="../controllers/controller_submit_message.php" method="post">

				<textarea name="text_message" class="textarea_text"></textarea><br />

				<input type="hidden" name="id_interlocutor" value="<?php echo $interlocutor; ?>" />
			
				<input type="submit" name="submit_message" value="Отправить сообщение" /><br /><br />

			</form>


<?php

		/*$query = 'SELECT * FROM message WHERE id_user_from= ' . $_SESSION['user_id'] . ' AND id_user_to = ' . $interlocutor . ' UNION ' .
				 'SELECT * FROM message WHERE id_user_from= ' . $interlocutor . ' AND id_user_to = ' . $_SESSION['user_id'] ;*/


		$query = 'SELECT * FROM
					 (SELECT * FROM message WHERE id_user_from = ' . $_SESSION['user_id'] . ' AND id_user_to = ' . $interlocutor .'
					 UNION  
					 SELECT * FROM message WHERE id_user_from = ' . $interlocutor . ' AND id_user_to = ' . $_SESSION['user_id'] . ') as table1
				 ORDER BY date DESC';


		$result = mysqli_query($dbc, $query) 
			or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 

		if (mysqli_num_rows($result) != 0) {


			$query_interlocutor = 'SELECT * FROM user WHERE id = ' . $interlocutor;

			$result_interlocutor = mysqli_query($dbc, $query_interlocutor) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 

			$row_interlocutor = mysqli_fetch_array($result_interlocutor);



			while ($row = mysqli_fetch_array($result)) {

				/*if ($row['id_user_from'] == $_SESSION['user_id']) {
					echo '1!! '. $row['id_user_from'] . ' ' . $row['id_user_to'] . ' ' . $row['text_message'] . '<br />';
				}
				else {
					echo '2!! '. $row['id_user_from'] . ' ' . $row['id_user_to'] . ' ' . $row['text_message'] . '<br />';
				}*/

				if ($row['id_user_from'] == $_SESSION['user_id']) {
					echo '<div class="my_message block_mesaage">'. $row['id_user_from'] . ' ' . $row['id_user_to'] . ' ' . $row['text_message'] . '</div>';
					echo '<div class="clear"></div>';

					/*echo '<div class="my_message block_mesaage">';
						echo '<img src="' . $row[] . '" />';
					echo '</div>';*/


				}
				else {

					//$row_interlocutor['url_avatar'] .

					/*echo '<div class="interlocutor_message block_mesaage">'. $row['id_user_from'] . ' ' . $row['id_user_to'] . ' ' . $row['text_message'] . '</div>';
					echo '<div class="clear"></div>';*/


					echo '<div class="interlocutor_message block_mesaage">';
						echo '<img src="' . $row_interlocutor['url_avatar'] . '" height="70px" width="70px" />';
						echo '<div>' . $row_interlocutor['name'] . ' ' . $row_interlocutor['surname'] . $row['text_message'] . '</div>';
					echo '</div>';
				}

			}

		}

?>

		</div>
		
<?php
	print_bootom_root();
?>