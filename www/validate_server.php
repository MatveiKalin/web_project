<?php

 	$login = $_POST['login'];
 	$pass = $_POST['pass'];
 	$email = $_POST['email'];

 	if ($login == "") {
 		echo "Не введен логин" . "<br />";
 	}

 	if ($pass == ""){
 		echo "Не введен пароль" . "<br />";
 	}

 	if ($email == ""){
 		echo "Не введен емэйл" . "<br />";
 	}

	if ( !( strpos($email, ".") > 0  && strpos($email, "@") > 0 ) ||  preg_match("/[^a-zA-Z0-9.@_-]/", $email) ) {
		echo "Емэйл введен неверно" . "<br />";
	}

?>