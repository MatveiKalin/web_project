<?php

	// Подключаем модули
	require_once('../configuration_files/include_modules.php');
	require_once('../model/User.class.php');

	$user_name_registration = sanitizeMySQL($_POST['user_name_registration']);
	$second_name_registration = sanitizeMySQL($_POST['second_name_registration']);
	$login_registration = sanitizeMySQL($_POST['login_registration']);
	$password_registration = sanitizeMySQL(strtolower($_POST['password_registration']));
	$repeat_password_registration = sanitizeMySQL($_POST['repeat_password_registration']);
	$e_mail = sanitizeMySQL($_POST['e_mail']);


	$objUser = new User($user_name_registration, $second_name_registration, $login_registration, $password_registration, $repeat_password_registration, $e_mail);

	$objUser->registration();

?>