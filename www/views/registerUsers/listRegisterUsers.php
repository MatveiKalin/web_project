<?php
    require_once(ROOT . '/views/layouts/header.php');
    require_once(ROOT . '/views/layouts/left_menu.php'); 
?>

    <div id="main">
        <h1>Зарегистрированные пользователи</h1>
        
        <?php foreach ($registerUsersMas as $registerUser): ?>
            
            <div class="conteiner_user">
                <?php
                    if (is_file($registerUser['url_avatar']) && filesize($registerUser['url_avatar']) > 0) {
                        echo '<img src="../../' . $registerUser['url_avatar'] . '" width="100" height="100" alt="Фотография пользователя" />';
                    }
                    else {
                        echo '<img src="/template/img/defaultUserAvatar.png" width="100" height="100" alt="Отсутствует фотография пользователя" />';
                    }
                ?>
                <div class="conteiner_btn">
                    
                    <?php if (array_key_exists(strval($registerUser['id']), $idInterlocutorMasAssoc)): ?>
                        <a href="<?php echo '/interlocutor/' . $_SESSION['user_id']; ?>" class="in_interlocutors">У Вас в собеседниках</a>
                    <?php else: ?>
                        <a class="add_interlocutor" id="<?php echo $registerUser['id']; ?>">Добавить в собеседники</a>    
                    <?php endif; ?>
                    
                    <a href="/registerUsers/showRegisterUser/<?php echo $registerUser['id']; ?>">Просмотреть личные данные</a>
                </div>

                <div>
                    <p><?php echo $registerUser['name'] . ' ' . $registerUser['surname']; ?></p>
                    <p><?php echo $registerUser['country']; ?></p>
                </div>

            </div>

            <div class="clear"></div>
        
        <?php endforeach; ?>
        
    </div>

    <script>
        $(document).ready(function() {
            
            // Добавление пользователя в собеседники средствами AJAX
            $('.add_interlocutor').click(function() {
                var $id = $(this).attr('id');
                $.post("/registerUsers/addInterlocutorAjax/" + $id, {}, function(data) { });
                $(this).addClass('in_interlocutors');
                $(this).text("У Вас в собеседниках");
            });
            
        });
    </script>

<?php
    require_once(ROOT . '/views/layouts/footer.php');
?>