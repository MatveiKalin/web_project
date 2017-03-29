<?php

    // Функция teleportation($name_page) переадресует на страницу, имя которой написано в параметр функции
    function teleportation($name_page) {
            // Присваиваем в переменную адрес главной страницы
            $page = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $name_page;

            // Если в адресе страницы появиться символ "\", то в браузере Mozilla Firefox
            // не будет загружаться данная страница, поэтому находим этот символ "\" и
            // удаляем его
            $page = str_replace('\\', '', $page);

            // Заголовок, который переадресует браузер на главную страницу
            // с сообщением о том, что имя и пароль введены не верно
            header('Location: ' . $page);

            // JavaScript - код, который преадресует на ту страницу, имя которой написано в параметр функции (Он сработает, если "header" не сможет переадресовать)
            echo '<script language="JavaScript">';
                    echo 'window.location.href = "' . $name_page . '"';
            echo '</script>';
    } // Конец функции "teleportation($name_page)"
    
    
    // Функция, которая выводит данные на личной странице пользователей
    function printInfoUserPage($registerUserMas) {
        echo '<label class="bold">Меня зовут: </label>' . $registerUserMas['name'] . ' ' .  $registerUserMas['surname'] . '<br /><br />';
        echo '<label class="bold">Фотография:</label><br />';

        // Фото
        if (is_file($registerUserMas['url_avatar']) && filesize($registerUserMas['url_avatar']) > 0) {
            echo '<img src="../../' . $registerUserMas['url_avatar'] . '" width="150" height="150" alt="Фотография пользователя" /><br /><br />';
        }
        else {
            echo '<img src="/template/img/defaultUserAvatar.png" width="150" height="150" alt="Фотография пользователя" /><br /><br />';
        }

        // Дата рождения
        echo '<label class="bold">Дата рождения: </label>';
        if (!empty($registerUserMas['day_birthday']) || !empty($registerUserMas['month_birthday']) || !empty($registerUserMas['year_birthday']) ) {
            if ($registerUserMas['day_birthday'] != 0) {
                echo $registerUserMas['day_birthday'] . ' ';
            }

            if ($registerUserMas['month_birthday'] != "") {
                echo $registerUserMas['month_birthday']. ' ';
            }

            if ($registerUserMas['year_birthday'] != 0) {
                echo $registerUserMas['year_birthday'];
            }

            echo '<br /><br />';
        }
        else {
            echo 'Отсутствует информация<br /><br />';
        }

        // Страна проживания
        echo '<label class="bold">Страна проживания: </label>';
        if (!empty($registerUserMas['country'])) {
            echo $registerUserMas['country'] . '<br /><br />';
        }
        else {
            echo 'Отсутствует информация<br /><br />';
        }

        // Город проживания
        echo '<label class="bold">Город проживания: </label>';
        if (!empty($registerUserMas['city'])) {
            echo $registerUserMas['city'] . '<br /><br />';
        }
        else {
            echo 'Отсутствует информация<br /><br />';
        }

        // О себе
        echo '<label class="bold">О себе: </label>';
        if (!empty($registerUserMas['about_me'])) {
            echo $registerUserMas['about_me'] . '<br /><br />';
        }
        else {
            echo 'Отсутствует информация<br /><br />';
        }
    } 

?>

