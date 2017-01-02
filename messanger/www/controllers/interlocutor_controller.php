<?php

	// Подключаем модули
	require_once('../configuration_files/include_modules.php');
	require_once('../models/User.class.php');
	require_once('../views/interlocutor/interlocutor.php');
	require_once('../views/shared/shared_views.php');

	// Выводим верхнюю часть HTML-документа
 	top_html_doc_view();

 	// Выводим шапку сайта
 	header_view();

 	// Выводим левое меню
 	left_menu_view();


 	echo '<div id="main">';


	//if ($_GET['action'] == 'list_interlocutors') {

		// ОБРАЩАЕМСЯ К МОДЕЛИ, которая измлечет из базы данных собеседников текущего польщователя
		$user = new User();
		$masInterlocutor = $user->list_interlocutors(36);

		// ОБРАЩАЕМСЯ К ВИДУ, который выводит собеседников
		interlocutor_view($masInterlocutor);

	//}
		

	echo '</div>';

 	
	footer_view();
	
	// Выводим нижнюю часть HTML-документа
	bottom_html_doc_view();

?>
