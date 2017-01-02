<?php

	// Подключаем модули
	require_once('../configuration_files/include_modules.php');
	require_once('../models/User.class.php');
	require_once('../views/interlocutor/registered_users.php');
	require_once('../views/shared/shared_views.php');

	// Выводим верхнюю часть HTML-документа
 	top_html_doc_view();

 	// Выводим шапку сайта
 	header_view();

 	// Выводим левое меню
 	left_menu_view();


 	echo '<div id="main">';


	//if ($_GET['action'] == 'registered_users') {

		// ОБРАЩАЕМСЯ К МОДЕЛИ, которая извлечет из базы данных всех зарегистрированных пользователей
		$user = new User();
		$masUser = $user->list_registered_users(36);

		// ОБРАЩАЕМСЯ К ВИДУ, который выводит зарегистрированных пользователей
		registered_users_view($masUser);

	//}
		

	echo '</div>';

 	
 	// Выводим футер сайта
	footer_view();
	
	// Выводим нижнюю часть HTML-документа
	bottom_html_doc_view();

?>
