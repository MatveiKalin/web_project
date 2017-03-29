<?php
    require_once(ROOT . '/views/layouts/header.php');
    require_once(ROOT . '/views/layouts/left_menu.php'); 
?>

    <div id="main">
        <h1>Изменение личных данных</h1>
        
        <?php
            echo '<a href="' . $_SERVER['HTTP_REFERER'] . '" class="back"><< Назад</a><br /><br />';
        ?>
        
        <!--Показ ошибок-->
        <?php if (isset($errorsMas) && is_array($errorsMas)): ?>
            <ul>
            <?php foreach ($errorsMas as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </ul>
         <?php endif; ?> 
         <!--Конец показа ошибок-->
	
        <form enctype="multipart/form-data" method="post" action="#">
            
            <label class="bold">Мое имя: </label><br />
            <input type="text" name="name" value="<?php echo $userMas['name']; ?>" /><br /><br />

            <label class="bold">Моя фамилия: </label><br />
            <input type="text" name="surname" value="<?php echo $userMas['surname']; ?>" /><br /><br />

            <label class="bold">Фотография:</label><br />
        
        <?php
        
            // Фотография
            if (is_file($userMas['url_avatar']) && filesize($userMas['url_avatar']) > 0) {
                echo '<img src="../../' . $userMas['url_avatar'] . '" width="150" height="150" alt="Фотография пользователя" /><br /><br />';
            }
            else {
                echo '<img src="/template/img/defaultUserAvatar.png" width="150" height="150" alt="Фотография пользователя" /><br /><br />';
            }

            echo '<input type="file" id="photo" name="photo" /><br /><br />';  
            
            
            // День рождения
            echo '<label class="bold">День рождения: </label><br />';
            echo '<select name="day_birthday">';

                echo '<option value="0">День</option>'; 
            
                for ($i = 1; $i <= 31; $i++) {   
                    if ($userMas['day_birthday'] == $i) {
                        echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
                    }
                    else {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                }

            echo '</select><br /><br />';
            
            
            // Месяц рождения
            $month = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'); 
            echo '<label class="bold">Месяц рождения: </label><br />';
            echo '<select name="month_birthday">';

            echo '<option value="">Месяц</option>'; 
            
            foreach ($month as $key => $value) {

                if ($userMas['month_birthday'] == $value) {
                    echo '<option value="' . $value . '" selected="selected">' . $value . '</option>';
                }
                else {
                    echo '<option value="' . $value . '">' . $value . '</option>';
                }
            }

            echo '</select><br /><br />';
            
            
            // Год рождения         
            $result = UserModel::getYearMas();
            echo '<label class="bold">Год рождения: </label><br />';
            echo '<select name="year_birthday">';

            echo '<option value="0">Год</option>'; 
            
            while ($yearMas = $result->fetch()) {
                if ($yearMas['year'] == $userMas['year_birthday']) {
                    echo '<option value="' . $yearMas['year'] . '" selected="selected">' . $yearMas['year'] . '</option>';	
                }	
                else {
                    echo '<option value="' . $yearMas['year'] . '">' . $yearMas['year'] . '</option>';	
                }	
            }

            echo '</select><br /><br />';    
            
            
            // Страна проживания          
            $result = UserModel::getCountryMas();
            echo '<label class="bold">Страна проживания: </label><br />';
            echo '<select name="country">';

            echo '<option value="">Страна</option>';
            
            while ($countryMas = $result->fetch()) {
                if ($countryMas['Name'] == $userMas['country']) {
                    echo '<option value="' . $countryMas['Name'] . '" selected="selected">' . $countryMas['Name'] . '</option>';	
                }	
                else {
                    echo '<option value="' . $countryMas['Name'] . '">' . $countryMas['Name'] . '</option>';	
                }	
            }

            echo '</select><br /><br />';
            
            
            // Город проживания
            $result = UserModel::getCityMas();
            echo '<label class="bold">Город проживания: </label><br />';
            echo '<select name="city">';

            echo '<option value="">Город</option>';
            
            while ($cityMas = $result->fetch()) {
                if ($cityMas['Name'] == $userMas['city']) {
                    echo '<option value="' . $cityMas['Name'] . '" selected="selected">' . $cityMas['Name'] . '</option>';	
                }	
                else {
                    echo '<option value="' . $cityMas['Name'] . '">' . $cityMas['Name'] . '</option>';	
                }	
            }

            echo '</select><br /><br />';
            
            
            // О себе
            echo '<label class="bold">О себе: </label><br />';
            echo '<textarea class="textarea_text" name="about_me">' . $userMas['about_me'] . '</textarea><br />';
            
            echo '<input type="submit" name="change_personal_data" class="btn_change btn" value="Изменить" />';
        ?>
        
        </form>
            
    </div>
		
<?php
    require_once(ROOT . '/views/layouts/footer.php');
?>