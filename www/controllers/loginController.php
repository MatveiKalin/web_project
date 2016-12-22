<?php

	// Подключаем модули
	require_once('../configuration_files/include_modules.php');
	require_once('../model/User.class.php');

	$login_or_email = sanitizeMySQL($_POST['user_name_input']);
	$password = sanitizeMySQL($_POST['password_input']);

	$objUser = new User('', '', $login_or_email, $password, '', '');

	$objUser->login();

?>