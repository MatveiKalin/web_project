<?php

// Подключаем модель
require_once(ROOT . '/models/UserModel.php');
require_once(ROOT . '/components/SharedFunction.php');

class UserController {
    
    // Метод вызывается, когда пользователь видит форму входа/регистрации
    public function actionMain() { 
        $result = false;    
        $loginEmail = '';      
        $name = '';
        $secondName = '';
        $login = '';
        $password = '';
        $passwordRepeat = '';
        $email = '';
        
        // Если была нажата кнопка "Вход"
        if (isset($_POST['input'])) {
            $loginEmail = $_POST['login_email_input'];
            $password = $_POST['password_input'];
            
            $errorsMas = false;
            
            $userId = UserModel::login($loginEmail, $password); 
            
            if ($userId) {
                UserModel::auth($userId);
            }
            else {
                $errorsMas[] = 'Введены неверные данные при входе';
            }
        }
        
        // Если была нажата кнопка "Регистрация"
        if (isset($_POST['registration'])) {
            $name = $_POST['user_name_registration'];
            $secondName = $_POST['second_name_registration'];
            $login = $_POST['login_registration'];
            $password = $_POST['password_registration'];
            $passwordRepeat = $_POST['repeat_password_registration'];
            $email = $_POST['e_mail'];
            
            $errorsMas = false;
            
            if (!UserModel::checkName($name)) {
                $errorsMas[] = 'Имя не должно быть короче 2 символов';
            }
            
            
            if (!UserModel::checkPassword($password)) {
                $errorsMas[] = 'Пароль не должен быть короче 6 символов';
            }
            
            if (!UserModel::comparePasswords($password, $passwordRepeat)) {
                $errorsMas[] = 'Пароль и подтверждающий пароль не совпадают';
            }
            
            
            if (!UserModel::checkEmail($email)) {
                $errorsMas[] = 'Неверная электронная почта';
            }
            
            
            if (UserModel::checkEmailExist($email)) {
                $errorsMas[] = 'Электронная почта существует в БД';
            }
            
            
            // Если ошибок не обнаружено, то зарегистрировать пользователя
            if (!$errorsMas) {       
                $userId = UserModel::register($name, $secondName, $login, $password, $email); 
                
                if ($userId) {
                    UserModel::auth($userId);
                }
            }
           
        }
        
        // Вызываем вид
        require_once(ROOT . '/views/authRegistration/mainView.php');   
        return true;   
    }
    
    
    // Метод вызывается, когда пользователь переходит на свою страницу
    public function actionMypage($id) {    
        if ($_SESSION['user_id'] == $id) {
            
            //define('GW_UPLOADPATH', 'template/img/users_avatar/');
            
            // Обращаемся к модели
            $userMas = UserModel::getUserById($id); 
            
            // Вызываем вид
            require_once(ROOT . '/views/user/mypage.php');
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('');
        }
        
        return true;
    }
    
    
    // Метод вызывается, когда пользователь переходит 
    // на страницу изменения своих личных данных
    public function actionChangePersonalData($id) {    
        if ($_SESSION['user_id'] == $id) {
            
            define('GW_UPLOADPATH', 'template/img/users_avatar/');
  
            // Если была нажата кнопка "Изменить"
            if (isset($_POST['change_personal_data'])) {                
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $day_birthday = $_POST['day_birthday'];
                $month_birthday = $_POST['month_birthday'];
                $year_birthday = $_POST['year_birthday'];
                $country = $_POST['country'];
                $city = $_POST['city'];
                $about_me = $_POST['about_me'];
                $target = GW_UPLOADPATH . $_FILES['photo']['name'];              

                $errorsMas = false;
// Не работает!!!!!!!!!!!!!
                if (!UserModel::checkName($name)) {
                    $errorsMas[] = 'Имя не должно быть короче 2 символов';
                }
                
                // Если ошибок не обнаружено, то изменить данные пользователя
                if (!$errorsMas) {      
                    $userId = UserModel::changePersonalData($name, $surname, $day_birthday, $month_birthday, $year_birthday, $country, $city, $about_me, $target);  
                }
            } 
           
            // Обращаемся к модели
            $userMas = UserModel::getUserById($id);
            
            // Вызываем вид
            require_once(ROOT . '/views/user/changePersonalData.php');
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('');
        }
        
        return true;
    }
    
    
    // Метод вызывается, когда пользователь выходит из учетной записи
    public function actionLogout() {       
        UserModel::logout();
    }
}
