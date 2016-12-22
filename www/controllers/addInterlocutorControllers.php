<?php

	require_once('../configuration_files/include_modules.php');
	require_once('../model/User.class.php');

	$id_interlocutor = $_GET['interlocutor'];

	$objUser = new User('', '', '', '', '', '');

	$objUser->addInterlocutor($id_interlocutor);

?>