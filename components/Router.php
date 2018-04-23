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
        echo $uri;

        // Проверить есть ли такой запрос в routes.php
        foreach ($this->routes as $uriPattern => $path)
        {
            // Если есть совпадение, определить какой контроллер и экшен обрабатывают запрос
            if (preg_match("~$uriPattern~", $uri))
            {
                $segments = explode('/', $path);
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_shift($segments));
            }
            echo "<br>$uriPattern->$path";
        }

        // Подключить файл класса-контроллера
        $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
        if (file_exists($controllerFile))
        {
            include_once($controllerFile);
        }

        // Создать объект, вызвать метод
        $controllerObj = new $controllerName;
        $res = $controllerObj->$actionName();
//        if ($res != null)
//        {
//            break ;
//        }

    }
}