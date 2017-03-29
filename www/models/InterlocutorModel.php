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
        
        return $idInterlocutorMasAssoc; 
    }
}
