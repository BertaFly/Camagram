<?php

namespace application\components;

class View
{
	public $path;
	public $route;
	public $layout = 'default';

	
	public function __construct($route)
	{
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}
	
	public function render($title, $vars = [])
	{
		// echo "<br>before extract vars";
		extract($vars);
		// var_dump($vars);
		// print($this->path);
		if ($title == "")
		{
			$path = 'application/views/'.$this->path.'.php';
		}
		else
		{
			$path = 'application/views/'.$title.'.php';	
		}
		
		// print($path);
		if (file_exists($path))
		{
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'application/views/layouts/'.$this->layout.'.php';
		}
		else
		{
			echo "no such view: ".$this->path;
		}
		
	}

	public static function errorCode($code)
	{
		if (is_numeric($code))
		{
			http_response_code($code);
		}
		$path = 'application/views/errors/'.$code.'.php';
		if (file_exists($path));
		{
			require $path;
		}
		exit;
	}

	public function redirect($url)
	{
		header('location: '.$url);
		exit;
	}

}