<?php

namespace application\components;

use application\components\View;

abstract class Controller
{
	public $route;
	public $view;

	public function __construct($route)
	{
		$this->route = $route;
		$this->view = new View($route);
	}
}
