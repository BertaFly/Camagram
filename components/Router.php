<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Return request str
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        // Получить строку запроса
        $uri = $this->getURI();
//        echo $uri;
        // Проверить есть ли такой запрос в routes.php
        foreach ($this->routes as $uriPattern => $path)
        {
            // Если есть совпадение, определить какой контроллер и экшен обрабатывают запрос
            if (preg_match("~$uriPattern~", $uri))
            {
                $segments = explode('/', $path);
//                print_r($segments);
                $controllerName = array_shift($segments).'Controller';
//                print($controllerName."<br>");
                $controllerName = ucfirst($controllerName);
//                print($controllerName."<br>");
                $actionName = 'action'.ucfirst(array_shift($segments));
//                print($actionName."<br>");
            }
        }

//         Подключить файл класса-контроллера
        $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
        print($controllerFile."<br>");
        if (file_exists($controllerFile))
        {
            print("controller name " . $controllerName."<br>");
            print("action name " . $actionName."<br>");

            include_once($controllerFile);
        }

//         Создать объект, вызвать метод
        $controllerObj = new $controllerName;
        $res = $controllerObj->$actionName();

        print ($actionName);
        if ($res == true)
        {
            return ;
        }

    }
}