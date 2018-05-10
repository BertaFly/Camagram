<?php

namespace application\components;

class Router
{
	// private $routes;

	protected $routes = [];
	protected $rouparamstes = [];


	public function __construct()
	{
		// $routesPath = ROOT.'/config/routes.php';
		// $this->routes = include($routesPath);
		$arr = require 'application/config/routes.php';
		foreach ($arr as $key => $value)
		{
			$this->add($key, $value);
		}
		// debug($arr);
	}

	public function add($route, $params)
	{
		$route = '#^'.$route.'$#';
		$this->routes[$route] = $params;
	}

	public function match()
	{
		$url = trim($_SERVER['REQUEST_URI'], '/');
		foreach ($this->routes as $route => $params)
		{
			if (preg_match($route, $url, $matches))
			{
				$this->params = $params;
				return true;
			}
		}
		return false;

	}

	public function run(){
		// echo 'start';
		if ($this->match())
		{
			$path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
			if (class_exists($path))
			{
				$action = $this->params['action'].'Action';
				if (method_exists($path, $action))
				{
					$controller = new $path($this->params);
					$controller->$action();
				}
				else
				{
					echo 'action not found';
				}

			}
			else
			{
				echo 'not found: '.$path;
			}
		}
		else
		{
			echo 'no such route';
		}
	}

	/**
	 * Return request str
	 */
	// private function getURI()
	// {
	// 	if (!empty($_SERVER['REQUEST_URI']))
	// 	{
	// 		return trim($_SERVER['REQUEST_URI'], '/');
	// 	}
	// }

	// public function run()
	// {
		// require_once(ROOT.'/views/' . 'header.php');
		// require_once(ROOT.'/views/' . 'footer.php');
		// Получить строку запроса
		// $uri = $this->getURI();
//        echo $uri;
		// Проверить есть ли такой запрос в routes.php
		// foreach ($this->routes as $uriPattern => $path)
		// {
			// Если есть совпадение, определить какой контроллер и экшен обрабатывают запрос
			// if (preg_match("~$uriPattern~", $uri))
			// {
				// $segments = explode('/', $path);
//                print_r($segments);
				// $controllerName = array_shift($segments).'Controller';
//                print($controllerName."<br>");
				// $controllerName = ucfirst($controllerName);
//                print($controllerName."<br>");
				// $actionName = 'action'.ucfirst(array_shift($segments));
//                print($actionName."<br>");
			// }
		

//         Подключить файл класса-контроллера
			// $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
			// print($controllerFile."<br>");
			// if (file_exists($controllerFile))
			// {
			// 	print("controller name " . $controllerName."<br>");
			// 	print("action name " . $actionName."<br>");

			// 	include_once($controllerFile);
			// }

//         Создать объект, вызвать метод
	// 		$controllerObj = new $controllerName;
	// 		$res = $controllerObj->$actionName();
	// 		print($res);
	// 	   if ($res != true)
	// 	   {
	// 		print("here");

	// 		   break;
	// 	   }
	// 	}

	// }
}