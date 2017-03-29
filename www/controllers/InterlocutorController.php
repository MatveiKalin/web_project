<?php

// Подключаем модель
require_once(ROOT . '/models/InterlocutorModel.php');
require_once(ROOT . '/components/SharedFunction.php');

class InterlocutorController {
   
    // Метод вызывается, когда пользователь просматривает список своих собеседников
    public function actionList($id) {    
        if ($_SESSION['user_id'] == $id) {

            // Обращаемся к модели
            $interlocutorMas = InterlocutorModel::getListInterlocutors($id); 
            
            // Вызываем вид
            require_once(ROOT . '/views/interlocutors/listInterlocutors.php');
        }
        else {
            // Переходим на форму входа/регистрации
            teleportation('');
        }
        
        return true;
    }
    
    
    // Метод вызывается, когда пользователь переходит на страницу с диалогом 
    // пользователя, идентификатор которого $id
    public function actionWriteMessage($id) {    
        
        // Вызываем вид
        require_once(ROOT . '/views/interlocutors/dialog.php');    
    }
}
