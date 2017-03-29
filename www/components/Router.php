<?php

class Router {
    private $routes;
    
    public function __construct() {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }
    

    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');    
        } 
    }

    
    public function run() {
        // Получить строку запроса
        $uri = $this->getURI();

        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {
        
            // Сравниваем $utiPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {
                
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                
                // Если есть совпадение, то определить какой контроллер и 
                // акшен обрабатывает запрос
                $segments = explode('/', $internalRoute);
                
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                
                $actionName = ucfirst(array_shift($segments));
                $actionName = 'action' .  $actionName;
                //echo $actionName . '<br />';
                
                $parameters = $segments;
                
                // Подключить файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                //echo $controllerFile. '<br />';

                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                }

                // Создать объект, вызвать метод (т.е. акшен)
                $controllerObject = new $controllerName;
                //$result = $controllerObject->$actionName($parameters);
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                
                if ($result != NULL) {
                    break;
                }               
            }          
        }    
    }
}
