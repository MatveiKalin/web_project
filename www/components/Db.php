<?php

class Db {

    public static function getConnection() {
        $paramsPath = ROOT . '/config/connectvars.php';
        $params = include($paramsPath);
        
        $dsn = "mysql:host={$params['host']}; dbname={$params['dbname']};";
        $db = new PDO($dsn, $params['user'], $params['password']);

        // Используем кодировку "utf8"
        $db->exec("set names utf8");
        
        return $db;
    }
    
}
