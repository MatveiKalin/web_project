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

 	/*if ( !((email.indexOf(".") > 0) && (email.indexOf("@") > 0)) || (/[^a-zA-Z0-9.@_-]/.test(email)) ) {
		$("#errorEmail").css("display", "inline");
		return "емэйл имеет неверный формат";
	}*/

	//echo strpos("123", "0");

	if ( !( strpos($email, ".") > 0  && strpos($email, "@") > 0 ) ||  preg_match("/[^a-zA-Z0-9.@_-]/", $email) ) {
		echo "Емэйл введен неверно" . "<br />";
	}

?>