<?php

return array(

    // Пользователь заходит в свою учетную запись
    // Контроллер "UserController", метод "actionMypage"
    'user/([0-9]+)' => 'user/mypage/$1', 
        
    // Пользователь заходит на страницу изменения своих личных данных
    // Контроллер "UserController", метод "actionChangePersonalData"
    'user/changePersonalData' => 'user/changePersonalData', 
    
    // Пользователь выходит из учетной записи
    // Констроллер "UserController", метод "actionLogout"
    'user/logout' => 'user/logout', 
        
    
    
    // Пользователь просматривает список зарегистрированных пользователей
    // Контроллер "RegisterUsersController", метод "actionList"
    'registerUsers/([0-9]+)' => 'registerUsers/list/$1', 
    
    // Пользователь добавляет пользователя к себе в собеседники
    // Контроллер "RegisterUsersController", метод "actionAddInterlocutor"
    //'registerUsers/addInterlocutor/([0-9]+)' => 'registerUsers/addInterlocutor/$1', 
    
    // Пользователь добавляет пользователя к себе в собеседники
    // Контроллер "RegisterUsersController", метод "actionAddInterlocutorAjax"
    'registerUsers/addInterlocutorAjax/([0-9]+)' => 'registerUsers/addInterlocutorAjax/$1', 
    
    // Пользователь просматривает страницу зарегистрированного пользователя
    // Контроллер "RegisterUsersController", метод "actionShowRegisterUser"
    'registerUsers/showRegisterUser/([0-9]+)' => 'registerUsers/showRegisterUser/$1', 
    
    
    
    // Пользователь просматривает список своих собеседников
    // Контроллер "InterlocutorController", метод "actionList"
    'interlocutor/([0-9]+)' => 'interlocutor/list/$1', 
    
    // Пользователь переходит на страницу с диалогом
    // Контроллер "InterlocutorController", метод "actionWriteMessage"
    'interlocutor/writeMessage/([0-9]+)' => 'interlocutor/writeMessage/$1', 
    
    
    '' => 'user/main', 
);

