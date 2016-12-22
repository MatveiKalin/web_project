<?php


class User
{
	public $name;
	public $surname;
	public $login;
	public $password;
	public $password2;
	public $e_mail;
	

	function __construct($arg_name, $arg_surname, $arg_login, $arg_password, $arg_password2, $arg_e_mail)
	{
		// Запускаем сессию
		session_start();

		$this->name = $arg_name;
		$this->surname = $arg_surname;
		$this->login = $arg_login;
		$this->password = $arg_password;
		$this->password2 = $arg_password2;
		$this->e_mail = $arg_e_mail;
	}



	function login() {

		// Подключаем модули
		require_once('../configuration_files/include_modules.php');
		
		// Если была нажата кнопка "Вход", то ...
		if (isset($_POST['input'])) {
			
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
				or die(mysqli_error() . 'Невозможно подключиться к базе данных');

			charset($dbc);


	
			$query_login = "SELECT * FROM user WHERE login = '$this->login' AND password = SHA('$this->password')";
			$query_e_mail = "SELECT * FROM user WHERE e_mail = '$this->login' AND password = SHA('$this->password')";				
			

			$result_login = mysqli_query($dbc, $query_login) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 

			$result_e_mail = mysqli_query($dbc, $query_e_mail) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 
				

			if (mysqli_num_rows($result_login) == 1) {
			
				$row = mysqli_fetch_array($result_login);
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['surname'] = $row['surname'];

				echo $_SESSION['user_id'];

				mysqli_close($dbc);

				// ... переходим на страницу администратора
				teleportation('../view/my_page.php');

			}
			else 
			if (mysqli_num_rows($result_e_mail) == 1){
				$row = mysqli_fetch_array($result_e_mail);
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['surname'] = $row['surname'];

				echo $_SESSION['user_id'];

				mysqli_close($dbc);

				// ... переходим на страницу администратора
				teleportation('../view/my_page.php');
			}
			else {
				// Вызываем функцию, которая переадресует на страницу, имя которой написано в параметре
				teleportation('../index.php');
			}		
						
		}
	}



	function registration() {


		// Подключаем модули
		require_once('../configuration_files/include_modules.php');


		// Если была нажата кнопка "Зарегистрироваться", то ...
		if (isset($_POST['registration'])) {
		
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
				or die(mysqli_error() . 'Невозможно подключиться к базе данных');

			charset($dbc);



			// Если пользователь ввел подтверждающий пароль не такой какой нужно запретить регистрацию
			if ($this->password != $this->password2) {
				echo '<p class="warning">Пароли не совадают</p>';
				exit();
			}

																							
			// Если пользователь ввел в форму регистрации уже содержащийся e-mail, то "забраковать" его регистрацию.
			$query_check_e_mail = 'SELECT * FROM user WHERE e_mail = "' . $this->e_mail .  '" LIMIT 1';	
				

			$result_query_check_e_mail = mysqli_query($dbc, $query_check_e_mail) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 	


			// Если пользователь ввел в форму регистрации уже содержащийся login, то "забраковать" его регистрацию.
			$query_check_login = 'SELECT * FROM user WHERE login = "' . $this->login .  '" LIMIT 1';	
				
			$result_query_check_login = mysqli_query($dbc, $query_check_login) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 


			// Проверка на совпадение login
			if (mysqli_num_rows($result_query_check_login) == 1) {
				echo '<p class="warning">Извините, такой пользователь уже существует, c введенным Вами логином</p>';
			}
			else
			// Проверка на совпадение e_mail
			if (mysqli_num_rows($result_query_check_e_mail) == 1) {
				echo '<p class="warning">Извините, такой пользователь уже существует, c введенным Вами e-mail</p>';
			}
			// Если таких пользователей нет в базе данных, то успешно зарегистрировать пользователя
			else {

				$query = "INSERT INTO user (name, surname, login, password, e_mail, date_registration) 
						  VALUES ('$this->name', '$this->surname', '$this->login', SHA('$this->password'), '$this->e_mail', NOW())";			
				
				mysqli_query($dbc, $query) 
					or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных, при регистрации пользователя'); 
					

				// После регистрации необходимо у нового зарегистрированного пользователя записать в сессию идентификатор пользователя
				charset($dbc);
				
				$query = "SELECT * FROM user WHERE name = '$this->name' AND surname = '$this->surname' AND 
													login = '$this->login' AND password = SHA('$this->password') AND e_mail = '$this->e_mail'";	
				
				$result = mysqli_query($dbc, $query) 
					or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 
				
				if (mysqli_num_rows($result) == 1) {
					
					$row = mysqli_fetch_array($result);
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['surname'] = $row['surname'];
					
				}
				
				mysqli_close($dbc);
				
				// Вызываем функцию, которая переадресует на страницу, имя которой написано в параметре
				teleportation('../view/my_page.php');

			}

		}
	}


	function addInterlocutor($id_interlocutor) {

		// Подключение файла, который содержит подключаемые модули
		require_once('../configuration_files/include_modules.php');

		if (isset($_SESSION['user_id'])) {

			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
				or die('Невозможно связаться с базой данных!');
		
			charset($dbc);


			//$id_interlocutor = $interlocutor;


			$query = 'INSERT INTO interlocutor (id_user, id_interlocutor) VALUES (' . $_SESSION['user_id'] . ', ' . $id_interlocutor . ')';

			$result = mysqli_query($dbc, $query) 
				or die(mysqli_error() . 'Невозможно выполнить запрос к базе данных'); 
				

			// Вызываем функцию, которая переадресует на страницу, имя которой написано в параметре
			teleportation('../view/registered_users.php');

		}
	}


	function logout() {

		// Если пользователь вошел в приложение и нажал на ссылку
		// "Выйти из приложения", то ...
		if (isset($_SESSION['user_id'])) {
			
			// ... удаляем переменные сессии, присваивая суперглобальному массиву
			// пустой массив
			$_SESSION = array();
			
			// Удаление сессии
			session_destroy();
			
			// Вызываем функцию, которая переадресует на страницу, имя которой написано в параметре
			teleportation('../index.php');
			
		}

	}

}


?>