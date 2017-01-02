<?php
	

	if (isset($_GET['login'])) {
		$login = $_GET['login'];

		if ($login == "") {
	 		echo "Не введен логин";
	 	}
	}


	if (isset($_GET['password'])) {
		$password = $_GET['password'];

		if ($password == "") {
	 		echo "Не введен пароль";
	 	}
	}


	if (isset($_GET['email'])) {
		$email = $_GET['email'];

		if ($email == "") {
	 		echo "Не введен емэйл";
	 	}
	}


	if (isset($_GET['errorValidate'])) {
		$email = $_GET['errorValidate'];

	 	if ( !( strpos($email, ".") > 0  && strpos($email, "@") > 0 ) ||  preg_match("/[^a-zA-Z0-9.@_-]/", $email) ) {
			echo "Емэйл введен неверно";
		}
	}

?>