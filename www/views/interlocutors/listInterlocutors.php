<?php
    require_once(ROOT . '/views/layouts/header.php');
    require_once(ROOT . '/views/layouts/left_menu.php'); 
?>

    <div id="main">
        <h1>Собеседники</h1>
        
        <?php foreach ($interlocutorMas as $interlocutor): ?>
            
            <div class="conteiner_user">
                <?php
                    if (is_file($interlocutor['url_avatar']) && filesize($interlocutor['url_avatar']) > 0) {
                        echo '<img src="../../' . $interlocutor['url_avatar'] . '" width="100" height="100" alt="Фотография пользователя" />';
                    }
                    else {
                        echo '<img src="/template/img/defaultUserAvatar.png" width="100" height="100" alt="Отсутствует фотография пользователя" />';
                    }
                ?>
                <div class="conteiner_btn">
                    <a href="/user/writeMessageInDialog/<?php echo $interlocutor['id']; ?>">Написать письмо</a>
                    <a href="/registerUsers/showRegisterUser/<?php echo $interlocutor['id']; ?>">Просмотреть личные данные</a>
                </div>

                <div>
                    <p><?php echo $interlocutor['name'] . ' ' . $interlocutor['surname']; ?></p>
                    <p><?php echo $interlocutor['country']; ?></p>
                </div>

            </div>

            <div class="clear"></div>
        
        <?php endforeach; ?>
        
    </div>

<?php
    require_once(ROOT . '/views/layouts/footer.php');
?>