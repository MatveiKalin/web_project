<?php

require_once(ROOT . '/components/Db.php');

class InterlocutorModel {
    
    // Получение списка собеседников у пользователя с идентификатором "$id"
    public static function getListInterlocutors($id) {
        $db = Db::getConnection();
        $listInterlocutorsMas = array();
        
        $sql = 'SELECT * FROM interlocutor '
                . 'WHERE id_user = :id_user';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id_user', $id);       
        $result->execute();

        while ($row = $result->fetch()) {
            $query_interlocutor = 'SELECT * FROM user WHERE id = ' . $row['id_interlocutor'];
            $result_interlocutor = $db->query($query_interlocutor); 
            $listInterlocutorsMas[count($listInterlocutorsMas)] = $result_interlocutor->fetch();
        }
        
        // Закрытие соединения с БД
        $db = null;
        
        return $listInterlocutorsMas;
    }
    
    
    // Получение списка собеседников в виде ассоциативного массива
    public static function getIdInterlocutorInAssoc($id) {
        $db = Db::getConnection();
        $idInterlocutorMasAssoc = array();
        
        $sql = 'SELECT * FROM interlocutor '
                . 'WHERE id_user = :id_user';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id_user', $id);       
        $result->execute();

        while ($row = $result->fetch()) {
            $query_interlocutor = 'SELECT * FROM user WHERE id = ' . $row['id_interlocutor'];
            $result_interlocutor = $db->query($query_interlocutor);  
            $idInterlocutorMasAssoc[strval($row['id_interlocutor'])] = $result_interlocutor->fetch();
        }
        
        // Закрытие соединения с БД
        $db = null;
        
        return $idInterlocutorMasAssoc; 
    }

    
    // Получить все сообщения в диалоге
    public static function getAllMessageInDialog($id_interlocutor) {
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM
                        (SELECT * FROM message WHERE id_user_from = ' . $_SESSION['user_id'] . ' AND id_user_to = ' . $id_interlocutor .'
                        UNION  
                        SELECT * FROM message WHERE id_user_from = ' . $id_interlocutor . ' AND id_user_to = ' . $_SESSION['user_id'] . ') as table1
                ORDER BY date DESC';
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_NAMED);
        
        // Закрытие соединения с БД
        $db = null;
        
        return $result->fetchAll();
    }
    
    
    // Получить все сообщения общего чата
    public static function getAllMessageCommon($id) {
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM message WHERE id_user_to = 1 ORDER BY date DESC';
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_NAMED);
        
        // Закрытие соединения с БД
        $db = null;
        
        return $result->fetchAll();
    }
    
    
    // Метод подсчитывает сколько сообщений в личном чате
    public static function countAllMessageInDialog($id_interlocutor) {
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM
                        (SELECT * FROM message WHERE id_user_from = ' . $_SESSION['user_id'] . ' AND id_user_to = ' . $id_interlocutor .'
                        UNION  
                        SELECT * FROM message WHERE id_user_from = ' . $id_interlocutor . ' AND id_user_to = ' . $_SESSION['user_id'] . ') as table1
                ORDER BY date DESC';
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_NAMED);
        
        // Закрытие соединения с БД
        $db = null;
        
        return count($result->fetch());
    }
    
    
    // Метод срабатывает, когда пользователь отправляет сообщение в личный чат
    public static function sendMessageInDialog($id_interlocutor, $text_message) {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO message (id_user_from, id_user_to, text_message, date)'
                   . ' VALUES (:user_id, :id_interlocutor, :text_message, NOW())';

        $result = $db->prepare($sql);
        $result->bindParam(':user_id',  $_SESSION['user_id']);    
        $result->bindParam(':id_interlocutor',  $id_interlocutor); 
        $result->bindParam(':text_message',  $text_message); 
        
        $result->execute();
        
        // Закрытие соединения с БД
        $db = null;
    }
    
    
    // Метод срабатывает, когда пользователь отправляет сообщение в общий чат
    public static function sendMessageCommon($id, $text_message) {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO message (id_user_from, id_user_to, text_message, date)'
                   . ' VALUES (:user_id, :id_interlocutor, :text_message, NOW())';

        $id_interlocutor = 1;
        
        $result = $db->prepare($sql);
        $result->bindParam(':user_id',  $id);    
        $result->bindParam(':id_interlocutor', $id_interlocutor); 
        $result->bindParam(':text_message',  $text_message); 
        
        $result->execute();
        
        // Закрытие соединения с БД
        $db = null;
    }
    
    
    // Метод срабатывает, когда пользователь отправляет сообщение на электронную почту
    public static function sendMessageToMail($email, $sender_name, $sender_mail, $subject, $text) {
        $db = Db::getConnection();
        
        // Сформируем текст для заголовка «от кого» 
        $from='=?UTF-8?B?'.base64_encode($sender_name).'?=<'.$sender_mail.'>';  
        
        // Создаем тему письма 
        $subject = '=?UTF-8?B?'.base64_encode($subject).'?=';
        
        // Заголовок, указывающий, что формат письма — HTML 
        $headers='Content-type: text/html; charset=utf-8 rn'; 
        
        // Заголовок, указывающий, от кого это письмо 
        $headers.='From: ' . $from . ' rn';
        
        // обернём текст HTML-тегами 
        $message='<html><body>' . $text . '</body></html>'; 
        
        // ОТПРАВКА СООБЩЕНИЯ
        mail($email, $subject, $message, $headers);
        
        // Закрытие соединения с БД
        $db = null;
    }
}
