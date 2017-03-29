<?php
    require_once(ROOT . '/views/layouts/header.php');
    require_once(ROOT . '/views/layouts/left_menu.php'); 
?>

    <div id="main">
        <h1>Моя страница</h1>

        <?php 
            echo '<a href="changePersonalData/' . $_SESSION['user_id'] . '" class="btn_change_personal_data">Изменить личные данные</a>';
            
            // Выводим информацию о пользователе
            printInfoUserPage($userMas);        
        ?>

    </div>
		
<?php
    require_once(ROOT . '/views/layouts/footer.php');
?>