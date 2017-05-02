<?php

// Подключаем модель
require_once(ROOT . '/models/RegisterUsersModel.php');
require_once(ROOT . '/models/InterlocutorModel.php');
require_once(ROOT . '/components/SharedFunction.php');
require_once(ROOT . '/components/sanitize.php');

class RegisterUsersController {
   
    // Метод вызывается, когда пользователь просматривает список зарегистрированных пользователей
    public function actionList($id) {
        
        $id = sanitizeMySQL($id);
        
        if ($_SESSION['user_id'] == $id) {

            // Обращаемся к модели
            $registerUsersMas = RegisterUsersModel::getListRegisterUsers($id); 
            $idInterlocutorMasAssoc = InterlocutorModel::getIdInterlocutorInAssoc($id);
            
            // Вызываем вид
            require_once(ROOT . '/views/registerUsers/listRegisterUsers.php');
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('/');
        }
        
        return true;
    }

    
    // Метод вызывается, когда пользователь добавляет пользователя в собеседники
    public static function actionAddInterlocutorAjax($id) {
        if (isset($_SESSION['user_id'])) {
            $id = sanitizeMySQL($id);

            // Обращаемся к модели
            RegisterUsersModel::addInInterlocutors($id);
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('/');
        }
    }
    
    
    // Метод вызывается, когда пользователь просматривает страницу зарегистрированного пользователя
    public static function actionShowRegisterUser($id) {
        if (isset($_SESSION['user_id'])) {
            $id = sanitizeMySQL($id);

            // Обращаемся к модели
            $registerUserMas = RegisterUsersModel::getRegisterUser($id);

            // Вызываем вид
            require_once(ROOT . '/views/registerUsers/registerUser.php');
            exit();
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('/');
        }
    }
}
