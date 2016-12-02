<?php

/*
* Описание: Данный файл содержит функции, которые "обезвреживают" данные, введенные пользователем.
*
* Автор: Матвей Калин.
*
* Дата создания файла: 13.12.2013.
* 
* Дата последнего изменения: 13.12.2013.
*/

function sanitizeString($var) {

	if (get_magic_quotes_gpc()) {
		
		// Избавляемся от нежелательных слэш-символов, кторые экранируют символы
		$var = stripslashes($var);
	
	}
	
	// Избавляемся от любого HTML-кода, например тег <b>, заменяется &lt; b &gt
	$var = htmlentities($var);
	
	// Избавляемся полность от введенного HTML
	$var = strip_tags($var);
	
	// Выводим стерилизованную переменную
	return $var;

}

function sanitizeMySQL($var) {

	$var = mysql_real_escape_string($var);
	
	$var = sanitizeString($var);
	
	// Выводим стерилизованную переменную
	return $var;

}

?>