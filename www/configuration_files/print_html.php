<?php
	
	// Выводим верхнюю часть HTML-страницы для файлов которые располагаются в папке "pages"
	function print_head_pages() {

?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>Обмен сообщениями</title>
			<link href="../css/style.css" rel="stylesheet" />
		</head>
		<body>
			<div id="wrapper">
				
				<div id="header">
					<h2>Обмен сообщениями</h2>
					<a href="../controllers/logout.php" id="out">Выход из учетной записи</a>
				</div>
			
<?php
	} // Конец функции "print_head_pages()"


	// Функция, задающая кодировку
	function charset($varConnect) {

		// Используем кодировку "utf8"
		mysqli_query($varConnect, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");

	} // Конец функции "charset()"


	// Функция print_left_menu() выводит HTML-код левого меню сайта для страниц.
	function print_left_menu() {
	
?>		
		<div id="left_menu">
			<ul>
				<li><a href="my_page.php">Моя страница</a></li>
				<li><a href="registered_users.php">Зарегистрированные пользователи</a></li>
				<li><a href="interlocutor.php">Собеседники</a></li>
				<li><a href="common.php">Общий чат</a></li>
			</ul>
		</div>
		
<?php

	} // Конец функции "print_left_menu()"



	// Выводим нижнюю часть HTML-страницы
	function print_bootom_root() {

?>	
		<div id="footer">Группа РИС-14-1б</div>

		</div>
	</body>	
	</html>
<?php

	} // Конец функции "print_bootom_root()"

	

	// Функция teleportation($name_page) переадресует на страницу, имя которой написано в параметр функции
	function teleportation($name_page) {

		// Присваиваем в переменную адрес главной страницы
		$page = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $name_page;

		// Если в адресе страницы появиться символ "\", то в браузере Mozilla Firefox
		// не будет загружаться данная страница, поэтому находим этот символ "\" и
		// удаляем его
		$page = str_replace('\\', '', $page);

		// Заголовок, который переадресует браузер на главную страницу
		// с сообщением о том, что имя и пароль введены не верно
		header('Location: ' . $page);

		// JavaScript - код, который преадресует на ту страницу, имя которой написано в параметр функции (Он сработает, если "header" не сможет переадресовать)
		echo '<script language="JavaScript">';
			echo 'window.location.href = "' . $name_page . '"';
		echo '</script>';

	} // Конец функции "teleportation($name_page)"

?>

