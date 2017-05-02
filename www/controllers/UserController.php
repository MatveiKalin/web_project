<?php

// Подключаем модель
require_once(ROOT . '/models/UserModel.php');
require_once(ROOT . '/models/InterlocutorModel.php');
require_once(ROOT . '/components/SharedFunction.php');
require_once(ROOT . '/components/sanitize.php');

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
            $loginEmail = sanitizeMySQL($_POST['login_email_input']);
            $password = sanitizeMySQL($_POST['password_input']);
            
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
            $name = sanitizeMySQL($_POST['user_name_registration']);
            $secondName = sanitizeMySQL($_POST['second_name_registration']);
            $login = sanitizeMySQL($_POST['login_registration']);
            $password = sanitizeMySQL($_POST['password_registration']);
            $passwordRepeat = sanitizeMySQL($_POST['repeat_password_registration']);
            $email = sanitizeMySQL($_POST['e_mail']);
            
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
        if (isset($_SESSION['user_id'])) {

            $id = sanitizeMySQL($id);
            
            // Обращаемся к модели
            $userMas = UserModel::getUserById($id); 
            
            // Вызываем вид
            require_once(ROOT . '/views/user/mypage.php');
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('/');
        }
        
        return true;
    }
    
    
    // Метод вызывается, когда пользователь переходит 
    // на страницу изменения своих личных данных
    public function actionChangePersonalData($id) {    
        if (isset($_SESSION['user_id'])) {
            
            $id = sanitizeMySQL($id);
            define('GW_UPLOADPATH', 'template/img/users_avatar/');
  
            // Если была нажата кнопка "Изменить"
            if (isset($_POST['change_personal_data'])) {                
                $name = sanitizeMySQL($_POST['name']);
                $surname = sanitizeMySQL($_POST['surname']);
                $day_birthday = sanitizeMySQL($_POST['day_birthday']);
                $month_birthday = sanitizeMySQL($_POST['month_birthday']);
                $year_birthday = sanitizeMySQL($_POST['year_birthday']);
                $country = sanitizeMySQL($_POST['country']);
                $city = sanitizeMySQL($_POST['city']);
                $about_me = sanitizeMySQL($_POST['about_me']);
                $target = sanitizeMySQL(GW_UPLOADPATH . $_FILES['photo']['name']);              

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
            teleportation('/');
        }
        
        return true;
    }
    
    
    // Метод вызывается, когда пользователь переходит на страницу с диалогом 
    // собеседника, идентификатор которого $id
    public function actionWriteMessageInDialog($id_interlocutor) {   
        if (isset($_SESSION['user_id'])) {
            $id_interlocutor = sanitizeMySQL($id_interlocutor);
            $allMessageInDialogMas = InterlocutorModel::getAllMessageInDialog($id_interlocutor);

            if ( count($allMessageInDialogMas) != 0 ) {
                $infoOneInterlocutorMas = UserModel::getOneUser($id_interlocutor);
                $infoAboutMeMas = UserModel::getOneUser($_SESSION['user_id']);
            }

            // Вызываем вид
            require_once(ROOT . '/views/interlocutors/dialogPersonal.php');

            return true;
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('/');
        }
    }
    
    
    // Метод срабатывает, когда пользователь отправляет сообщение собеседнику
    public function actionSendMessageInDialog($id_interlocutor) {
        if ( isset($_SESSION['user_id']) && isset($_POST['submit_message']) ) {
            $id_interlocutor = sanitizeMySQL($id_interlocutor);
            //$text_message = sanitizeMySQL($_POST['text_message']);
            $text_message = stripslashes($_POST['text_message']);

            if (!empty($text_message)) {
                InterlocutorModel::sendMessageInDialog($id_interlocutor, $text_message);

                // Вызываем вид
                //require_once(ROOT . '/views/interlocutors/dialogPersonal.php');
            }

            teleportation('/user/writeMessageInDialog/' . $id_interlocutor);
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('/');
        }
    }
    
    
    // Метод срабатывает, когда пользователь переходит на страницу общего чата
    public function actionWriteCommonMessage($id) {
        if (isset($_SESSION['user_id'])) {
            $id = sanitizeMySQL($id);
            $allMessageCommon = InterlocutorModel::getAllMessageCommon($id);

            // Вызываем вид
            require_once(ROOT . '/views/interlocutors/messageCommon.php');

            return true;
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('/');
        }
    }
    
    
    // Метод срабатывает, когда пользователь отправляет сообщение в общий чат
    public function actionSendMessageCommon($id) {
        if ( isset($_SESSION['user_id']) && isset($_POST['submit_message']) ) {
            $id = sanitizeMySQL($id);
            //$text_message = sanitizeMySQL($_POST['text_message']);
            $text_message = stripslashes($_POST['text_message']);

            if (!empty($text_message)) {
                InterlocutorModel::sendMessageCommon($id, $text_message);

                // Вызываем вид
                //require_once(ROOT . '/views/interlocutors/messageCommon.php');
            }
            teleportation('/user/writeCommonMessage/' . $id);
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('/');
        }
    }
    
    
    // Метод срабатывает, когда пользователь переходит на на страницу, где можно отправить сообщение на электронную почту
    public function actionWriteMessageToMail($id) {
        if (isset($_SESSION['user_id'])) {
            $id = sanitizeMySQL($id);
            
            $infoAboutMeMas = UserModel::getOneUser($id);
            
            // Вызываем вид
            require_once(ROOT . '/views/interlocutors/formToMail.php');

            return true;
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('/');
        }
    }
    
    
    // Метод срабатывает, когда пользователь отправляет сообщение на электронную почту
    public function actionSendMessageToMail() {
        if ( isset($_SESSION['user_id']) && isset($_POST['submit_message']) ) {

            // Почтовый адрес получателя
            $email = $_POST['e_mail']; 
            
            // Имя отправителя 
            $sender_name = $_POST['sender_name']; 
            
            // Почтовый адрес отправителя 
            $sender_mail = $_POST['sender_mail']; 
            
            // Тема письма 
            $subject = $_POST['subject']; 
            
            // Само сообщение
            $text = $_POST['text_message']; 

            InterlocutorModel::sendMessageToMail($email, $sender_name, $sender_mail, $subject, $text);
            
            $infoAboutMeMas = UserModel::getOneUser($_SESSION['user_id']);
            
            // Вызываем вид
            require_once(ROOT . '/views/interlocutors/formToMail.php');

            return true;
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('/');
        }
    }
    
    
    // Метод вызывается, когда пользователь выходит из учетной записи
    public function actionLogout() {       
        UserModel::logout();
        
        // Переходим на форму входа/регистрации
        teleportation('/');
    }
}
