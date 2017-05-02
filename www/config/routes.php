<?php

return array(

    // Пользователь заходит в свою учетную запись
    // Контроллер "UserController", метод "actionMypage"
    'user/([0-9]+)' => 'user/mypage/$1', 
        
    // Пользователь заходит на страницу изменения своих личных данных
    // Контроллер "UserController", метод "actionChangePersonalData"
    'user/changePersonalData' => 'user/changePersonalData', 
    
    // Пользователь переходит на страницу с диалогом
    // Контроллер "UserController", метод "actionWriteMessageInDialog"
    'user/writeMessageInDialog/([0-9]+)' => 'user/writeMessageInDialog/$1',
    
    // Пользователь отправляет сообщение другому пользователю
    // Контроллер "UserController", метод "actionSendMessageInDialog"
    'user/sendMessageInDialog/([0-9]+)' => 'user/sendMessageInDialog/$1',
    
    // Пользователь переходит в общий чат
    // Контроллер "UserController", метод "actionWriteCommonMessage"
    'user/writeCommonMessage/([0-9]+)' => 'user/writeCommonMessage/$1',
    
    // Пользователь отправляет сообщение другому пользователю
    // Контроллер "UserController", метод "actionSendMessageCommon"
    'user/sendMessageCommon/([0-9]+)' => 'user/sendMessageCommon/$1',
    
    // Пользователь переходит на страницу, где можно отправить сообщение на электронную почту
    // Контроллер "UserController", метод "actionWriteMessageToMail"
    'user/writeMessageToMail/([0-9]+)' => 'user/writeMessageToMail/$1',
    
    // Пользователь отправляет сообщение другому пользователю
    // Контроллер "UserController", метод "actionSendMessageToMail"
    'user/sendMessageToMail' => 'user/sendMessageToMail',
    
    // Пользователь выходит из учетной записи
    // Констроллер "UserController", метод "actionLogout"
    'user/logout' => 'user/logout', 
        
    
    
    // Пользователь просматривает список зарегистрированных пользователей
    // Контроллер "RegisterUsersController", метод "actionList"
    'registerUsers/([0-9]+)' => 'registerUsers/list/$1', 
    
    // Пользователь добавляет пользователя к себе в собеседники
    // Контроллер "RegisterUsersController", метод "actionAddInterlocutorAjax"
    'registerUsers/addInterlocutorAjax/([0-9]+)' => 'registerUsers/addInterlocutorAjax/$1', 
    
    // Пользователь просматривает страницу зарегистрированного пользователя
    // Контроллер "RegisterUsersController", метод "actionShowRegisterUser"
    'registerUsers/showRegisterUser/([0-9]+)' => 'registerUsers/showRegisterUser/$1', 
    
    
    
    // Пользователь просматривает список своих собеседников
    // Контроллер "InterlocutorController", метод "actionList"
    'interlocutor/([0-9]+)' => 'interlocutor/list/$1', 

    
    
    '' => 'user/main', 
);

