<?php
    require_once(ROOT . '/views/layouts/header.php');
    require_once(ROOT . '/views/layouts/left_menu.php'); 
?>

    <div id="main">
        <h1>Страница пользователя</h1>
        
        <?php   
        
            echo '<a href="' . $_SERVER['HTTP_REFERER'] . '" class="back"><< Назад</a><br /><br />';
        
            // Выводим информацию о зарегистрированном пользователе
            printInfoUserPage($registerUserMas);   
        ?>
        
    </div>

<?php
    require_once(ROOT . '/views/layouts/footer.php');
?>