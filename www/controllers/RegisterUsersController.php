<?php

// Подключаем модель
require_once(ROOT . '/models/RegisterUsersModel.php');
require_once(ROOT . '/models/InterlocutorModel.php');
require_once(ROOT . '/components/SharedFunction.php');

class RegisterUsersController {
   
    // Метод вызывается, когда пользователь просматривает список зарегистрированных пользователей
    public function actionList($id) {    
        if ($_SESSION['user_id'] == $id) {

            // Обращаемся к модели
            $registerUsersMas = RegisterUsersModel::getListRegisterUsers($id); 
            $idInterlocutorMasAssoc = InterlocutorModel::getIdInterlocutorInAssoc($id);
            
            // Вызываем вид
            require_once(ROOT . '/views/registerUsers/listRegisterUsers.php');
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('');
        }
        
        return true;
    }
    
    
//    // Метод вызывается, когда пользователь добавляет пользователя в собеседники
//    public static function actionAddInterlocutor($id) {
//        // Обращаемся к модели
//        RegisterUsersModel::addInInterlocutors($id);
//        
//        // Перемещаемся на страницу со списком зарегистрированных пользователей
//        teleportation('/registerUsers/' . $_SESSION['user_id']);
//    }
    
    
    // Метод вызывается, когда пользователь добавляет пользователя в собеседники
    public static function actionAddInterlocutorAjax($id) {
        // Обращаемся к модели
        RegisterUsersModel::addInInterlocutors($id); 
    }
    
    
    // Метод вызывается, когда пользователь просматривает страницу зарегистрированного пользователя
    public static function actionShowRegisterUser($id) {
        // Обращаемся к модели
        $registerUserMas = RegisterUsersModel::getRegisterUser($id);
        
        // Вызываем вид
        require_once(ROOT . '/views/registerUsers/registerUser.php');
        exit();
    }
}
