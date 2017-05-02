<?php
    require_once(ROOT . '/views/layouts/header.php');
    require_once(ROOT . '/views/layouts/left_menu.php'); 
?>
    <div id="main">
        <h1>Общий чат</h1>
        
        <form action="/user/sendMessageCommon/<?php echo $_SESSION['user_id']; ?>" method="post">
            <textarea name="text_message" class="textarea_text"></textarea><br />
            <input type="hidden" name="id" value="<?php echo $_SESSION['user_id']; ?>" />
            <input type="submit" name="submit_message" value="Отправить сообщение" /><br /><br />
        </form>
        
        <?php  
            foreach ($allMessageCommon as $message) {

                $infoOneInterlocutorMas = UserModel::getOneUser($message['id_user_from']);

                if ($message['id_user_from'] == $_SESSION['user_id']) {
                    echo '<div class="my_message block_mesaage">';       
                }
                else {
                    echo '<div class="interlocutor_common_message block_mesaage">';
                }

                    echo '<div class="date_send">Дата отправления: ' . transformDataWithTime($message['date']) . '</div>';

                    if (is_file($infoOneInterlocutorMas['url_avatar']) && filesize($infoOneInterlocutorMas['url_avatar']) > 0) {
                        echo '<img src="../../' . $infoOneInterlocutorMas['url_avatar'] . '" width="70" height="70s" alt="Фотография пользователя" /><br />';
                    }
                    else {
                        echo '<img src="../../template/img/defaultUserAvatar.png" width="70" height="70" alt="Фотография по умолчанию" /><br />';
                    }

                    echo '<div class="name_user">' .  $infoOneInterlocutorMas['name'] . ' ' . $infoOneInterlocutorMas['surname'] . '</div>';

                    echo '<div class="clear"></div>';
                    echo '<hr />';
                    echo '<div class="body_message">' . $message['text_message'] . '</div>';
                echo '</div>';
            }
       ?>
    </div>

    <div class="clear"></div>
    <div class="space_bottom"></div>
    
    <script src="../../template/js/tinymce/tinymce.min.js"></script>
    <script>//tinymce.init({ selector:'textarea' });</script>
    
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 120,
            theme: 'modern',
            plugins: [
              'advlist autolink lists link image charmap print preview hr anchor pagebreak',
              'searchreplace wordcount visualblocks visualchars code fullscreen',
              'insertdatetime media nonbreaking save table contextmenu directionality',
              'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true,
            templates: [
              { title: 'Test template 1', content: 'Test 1' },
              { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>

<?php
    require_once(ROOT . '/views/layouts/footer.php');
?>