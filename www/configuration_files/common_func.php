<?php

	// Функция, задающая кодировку
	function charset($varConnect) {

		// Используем кодировку "utf8"
		mysqli_query($varConnect, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");

	} 


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

	} 

?>

