<?php

namespace application\components;

use application\lib\Db;

abstract class Model
{
	public $db;

	public function __construct()
	{
		$this->db = new Db;
	}
}