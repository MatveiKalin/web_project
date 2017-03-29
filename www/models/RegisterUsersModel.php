<?php

require_once(ROOT . '/components/Db.php');

class RegisterUsersModel {
    
    // Получение списка зарегистрированных пользователей
    public static function getListRegisterUsers($id) {
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM user '
                . 'WHERE id <> :id AND id <> 1 ';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);       
        $result->execute();
        
        return $result->fetchAll();
    }

    
    // Получение данных об одном зарегистрированном пользователе
    public static function getRegisterUser($id) {
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM user WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_NAMED);
        
        return $result->fetch();
    }
    
    
    // Добавление пользователя в список собеседников
    public static function addInInterlocutors($id) {
        $db = Db::getConnection();
     
        $sql = 'SELECT * FROM interlocutor '
                . 'WHERE id_user = :id_user AND '
                . 'id_interlocutor = :id_interlocutor';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id_user', $_SESSION['user_id']);
        $result->bindParam(':id_interlocutor', $id);
        
        $result->execute();
        
        if (!$result->fetch()) {
            $query_add_interlocutor = 'INSERT INTO interlocutor (id_user, id_interlocutor) '
                . 'VALUES (:id_user, :id_interlocutor)';
        
            $result_add_interlocutor = $db->prepare($query_add_interlocutor);
            $result_add_interlocutor->bindParam(':id_user', $_SESSION['user_id']);
            $result_add_interlocutor->bindParam(':id_interlocutor', $id);

            return $result_add_interlocutor->execute();
        }
    }
    
}
