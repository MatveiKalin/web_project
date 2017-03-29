<?php

require_once(ROOT . '/components/Db.php');

class UserModel {
    
    public static function auth($id) {   
        $_SESSION['user_id'] = $id;
    }
 
    
    public static function login($loginEmail, $password) {          
        $db = Db::getConnection();
        
        // Если введен email
        $sql = 'SELECT id '
                . 'FROM user '
                . 'WHERE e_mail = :loginEmail AND '
                . 'password = SHA(:password)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':loginEmail', $loginEmail, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        $result->execute(); 
        $userMas = $result->fetch();
        
        
        
        // Если введен login
        $sql2 = 'SELECT id '
                . 'FROM user '
                . 'WHERE login = :loginEmail AND '
                . 'password = SHA(:password)';
       
        $result2 = $db->prepare($sql2);
        $result2->bindParam(':loginEmail', $loginEmail, PDO::PARAM_STR);
        $result2->bindParam(':password', $password, PDO::PARAM_STR);

        $result2->execute(); 
        $userMas2 = $result2->fetch();
        
        
        if ($userMas) {
            return $userMas['id'];
        }
        else 
        if ($userMas2) {
            return $userMas2['id'];
        }
        
        return false;
    }
    
    
    public static function logout() {          
        // Если пользователь вошел в приложение и нажал на ссылку
        // "Выйти из приложения", то ...
        if (isset($_SESSION['user_id'])) {
            
            // ... удаляем переменные сессии, присваивая суперглобальному массиву
            // пустой массив
            $_SESSION = array();

            // Удаление сессии
            session_destroy();

            // Переходим на форму входа/регистрации
            teleportation('');
        }
    }
    
    
    public static function register($name, $surname, $login, $password, $email) {      
        $db = Db::getConnection();

        $sql = 'INSERT INTO user(name, surname, login, password, e_mail) '
                . 'VALUES (:name, :surname, :login, SHA(:password), :email)';
       
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        
        // Если пользователь зарегистрирован успешно, то вернуть его идентификатор
        if ($result->execute()) { 
            return self::login($login, $password);
        }
    }
    
    
    // Получение записи пользователя по идентификатору
    public static function getUserById($id) {
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM user WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_NAMED);
        
        return $result->fetch();     
    }
    
    
    // Получение записи пользователя по идентификатору
    public static function changePersonalData($name, $surname, $day_birthday, $month_birthday, $year_birthday, $country, $city, $about_me, $target) {
        $db = Db::getConnection();
      
        // Если была выбрана фотография
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            $sql = 'UPDATE user SET '
                    . 'name = :name, '
                    . 'surname = :surname, '
                    . 'day_birthday = :day_birthday, '
                    . 'month_birthday = :month_birthday, '
                    . 'year_birthday = :year_birthday, '
                    . 'country = :country, '
                    . 'city = :city, '
                    . 'url_avatar = :target, '
                    . 'about_me= :about_me '
                    . 'WHERE id = ' . $_SESSION['user_id'];   
            
            $result = $db->prepare($sql);
            $result->bindParam(':target', $target);
        }
        else {
            $sql = 'UPDATE user SET '
                    . 'name = :name, '
                    . 'surname = :surname, '
                    . 'day_birthday = :day_birthday, '
                    . 'month_birthday = :month_birthday, '
                    . 'year_birthday = :year_birthday, '
                    . 'country = :country, '
                    . 'city = :city, '
                    . 'about_me= :about_me '
                    . 'WHERE id = ' . $_SESSION['user_id'];
            
            $result = $db->prepare($sql);
        }  
        
        
        $result->bindParam(':name', $name);
        $result->bindParam(':surname', $surname);
        $result->bindParam(':day_birthday', $day_birthday);
        $result->bindParam(':month_birthday', $month_birthday);
        $result->bindParam(':year_birthday', $year_birthday);
        $result->bindParam(':country', $country);
        $result->bindParam(':city', $city); 
        $result->bindParam(':about_me', $about_me);
        return $result->execute();  
    }
    
     
    // Получение массива с годами
    public static function getYearMas() {
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM year';
        return $db->query($sql);   
    }
    
    
    // Получение массива со странами
    public static function getCountryMas() {
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM country';
        return $db->query($sql); 
    }
    
    
    // Получение массива с городами
    public static function getCityMas() {
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM city';
        return $db->query($sql); 
    }
    
    
    public static function checkName($name) {   
        if (strlen($name) >= 2) {
            return true;
        }
        
        return false;
    }
    
    
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        
        return false;
    }
    
    
    public static function comparePasswords($password, $passwordRepeat) {       
        if ($password === $passwordRepeat) {
             return true;
        }
        
        return false;
    }
    
    
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        
        return false;
    }
    
    
    public static function checkEmailExist($email) {       
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE e_mail = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        
        // Если существует email в БД
        if ($result->fetchColumn()) {
            return true;
        }
         
        // Если НЕ существует email в БД
        return false;
    }
    
}
