<?php

namespace application\components;

use application\components\View;

class Router
{

	protected $routes = [];
	protected $rouparamstes = [];


	public function __construct()
	{
		$arr = require 'application/config/routes.php';
		foreach ($arr as $key => $value)
		{
			$this->add($key, $value);
		}
	}

	public function add($route, $params)
	{
		$route = '#^'.$route.'$#';
		$this->routes[$route] = $params;
	}

	public function match()
	{
			// echo "<p>In match func</p>";

		$url = trim($_SERVER['REQUEST_URI'], '/');

			// echo "<p>this is a url: ".$url."</p>";

		foreach ($this->routes as $route => $params)
		{
			// echo "<p>this is current route: ".$route."</p>";
			// echo "<p>this is match: ".$matches."</p>";
			// echo "<p>this is current params: ".$params."</p>";


			if (preg_match($route, $url, $matches))
			{
				$this->params = $params;
				return true;
			}
		}
		return false;

	}

	public function run(){
		if ($this->match())
		{
			// echo "<p>In run func</p>";
			$path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
			// echo "<p>this is a path: ".$path."</p>";

			if (class_exists($path))
			{
				// echo "<p>Class exist</p>";

				$action = $this->params['action'].'Action';

			// echo "<p>this is a action: ".$action."</p>";
			

				if (method_exists($path, $action))
				{
					$controller = new $path($this->params);
					$controller->$action();
				}
				else
				{
					// echo "<p>Im befor error</p>";
					View::errorCode(404);
				}
			}
			else
			{
				View::errorCode(404);
			}
		}
		else
		{
			View::errorCode(404);
		}
	}
}