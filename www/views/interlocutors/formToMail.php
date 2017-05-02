<?php
    require_once(ROOT . '/views/layouts/header.php');
    require_once(ROOT . '/views/layouts/left_menu.php'); 
    
//    echo '<pre>';
//    print_r($infoAboutMeMas);
//    echo '</pre>';
    
?>
    <div id="main">
        <h1>Отправить сообщение на электронную почту</h1>
        
        <form action="/user/sendMessageToMail" method="post">
            <label>Почтовый адрес отправителя:</label><br />
            <input type="text" name="sender_mail" value="<?php echo $infoAboutMeMas['e_mail']; ?>" /><br /><br />
            
            <label>Почтовый адрес получателя:</label><br />
            <input type="text" name="e_mail" value="" /><br /><br />
            
            <label>Заголовок письма:</label><br />
            <input type="text" name="subject" value="" /><br /><br />
            
            <textarea name="text_message" class="textarea_text"></textarea><br />
            
            <input type="hidden" name="id" value="<?php echo $_SESSION['user_id']; ?>" />
            <input type="hidden" name="sender_name" value="<?php echo $infoAboutMeMas['name'] . ' ' . $infoAboutMeMas['surname']; ?>" />
          
            <input type="submit" name="submit_message" value="Отправить сообщение" /><br /><br />
        </form>
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