<?php 
    // Если пользователь уже зашел в свою учетную запись, 
    // то перенаправить его на свою страницу 
    if (isset($_SESSION['user_id'])) {
        teleportation('user/' . $_SESSION['user_id']);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Обмен сообщениями</title>
    <link href="<?php echo '../template/css/style.css'; ?>" rel="stylesheet" />

    <script src="../template/js/jquery-1.11.2.min.js"></script>
    <script src="../template/js/switch_input_registration.js"></script>
    
</head>
<body>

    <div id="wrapper">
        
        <!--Показ ошибок-->
        <?php if (isset($errorsMas) && is_array($errorsMas)): ?>
            <ul>
            <?php foreach ($errorsMas as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </ul>
         <?php endif; ?> 
         <!--Конец показа ошибок-->
         
        <div id="container_forms">

            <div class="conatiner_switch">
                <div id="switch_input">Вход</div>
                <div id="switch_registration">Регистрация</div>					
            </div>

            <form action="#" method="post" id="container_input">

                <h4 class="name_page">Вход</h4>

                <label for="user_name_input">Логин или адрес электронной почты:</label><br />
                <input type="text" name="login_email_input" id="login_email_input" /><br />

                <label for="password_input">Пароль:</label><br />
                <input type="password" name="password_input" id="password_input" /><br />

                <input type="submit" name="input" id="input" value="Вход" />
            </form>


            <form action="#" method="post" id="container_registration">

                <h4 class="name_page">Регистрация</h4>

                <label for="user_name_registration">Имя пользователя:</label><br />
                <input type="text" name="user_name_registration" id="user_name_registration" value="<?php echo $name; ?>"/><br />

                <label for="second_name_registration">Фамилия:</label><br />
                <input type="text" name="second_name_registration" id="second_name_registration" value="<?php echo $secondName; ?>" /><br />

                <label for="login_registration">Логин:</label><br />
                <input type="text" name="login_registration" id="login_registration" value="<?php echo $login; ?>" /><br />

                <label for="password_registration">Пароль:</label><br />
                <input type="password" name="password_registration" id="password_registration" value="" /><br /> 

                <label for="repeat_password_registration">Подтвердите пароль:</label><br />
                <input type="password" name="repeat_password_registration" id="repeat_password_registration" value="" /><br /> 

                <label for="e_mail">Электронная почта:</label><br />
                <input type="text" name="e_mail" id="e_mail" value="<?php echo $email; ?>" /><br /> 

                <input type="submit" name="registration" id="registration" value="Регистрация" />
            </form>

        </div>

    </div>

</body>	
</html>