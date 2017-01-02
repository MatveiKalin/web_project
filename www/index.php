<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Обмен сообщениями</title>
	<script src="js/jquery-1.11.2.min.js"></script>
	<!--<script src="js/validate.js"></script>-->
	<link href="css/style.css" rel="stylesheet" />
</head> 
<body>

	<form id="input" method="post" action="validate_server.php">
		<label for="login">
			Имя пользователя
		</label>
		<input type="text" id="login" value="" name="login" />
		<br />

		<label for="password">
			Пароль
		</label>
		<input type="password" id="password" value="" name="pass"  />
		<span id="emptyPass">
			Пароль не введен
		</span>
		<br />

		<label for="email">
			Email
		</label>
		<input type="text" id="email" value="" name="email" />
		<span id="emptyEmail">
			Емэейл не введен
		</span>
		<span id="errorEmail">
			Емэйл введен не верно
		</span>
		<br />


		<input type="submit" name="submit" />

	</form>




	<script type="text/javascript">
		document.getElementById('input').onsubmit = validation;
	</script>

</body>	
</html>