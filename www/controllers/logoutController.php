<?php

	// Подключаем модули
	require_once('../configuration_files/include_modules.php');
	require_once('../model/User.class.php');

	$objUser = new User('', '', '', '', '', '');

	$objUser->logout();
	
?>