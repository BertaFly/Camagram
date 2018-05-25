<?php

namespace application\lib;

use PDO;

class Db
{

	protected $bd;

	public function __construct()
	{
		$config = require 'application/config/database.php';
		$this->db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	}

	public function query($sql, $params = [])
	{
		$stmt = $this->db->prepare($sql);
		if (!empty($params))
		{
			foreach ($params as $key => $val)
			{
				$stmt->bindValue(':'.$key, $val);
			}
		}
		$stmt->execute();
		return $stmt;
	}

	public function row($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);

	}

	public function column($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}
	
}

?>