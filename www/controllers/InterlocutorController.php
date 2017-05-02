<?php

// Подключаем модель
require_once(ROOT . '/models/InterlocutorModel.php');
require_once(ROOT . '/components/SharedFunction.php');
require_once(ROOT . '/components/sanitize.php');

class InterlocutorController {
   
    // Метод вызывается, когда пользователь просматривает список своих собеседников
    public function actionList($id) { 
        
        $id = sanitizeMySQL($id);
        
        if ($_SESSION['user_id'] == $id) {
            
            // Обращаемся к модели
            $interlocutorMas = InterlocutorModel::getListInterlocutors($id); 
            
            // Вызываем вид
            require_once(ROOT . '/views/interlocutors/listInterlocutors.php');
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('/');
        }
        
        return true;
    }

}
