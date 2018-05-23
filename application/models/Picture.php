<?php

namespace application\models;

use application\components\Model;

class Picture extends Model
{
	public function insertFile($str)
	{
		echo "<br>";
		var_dump($this->db->query("INSERT INTO pics (user_id,link,image,likes,comments) VALUES (1,'','$str',99,'')"));
	}
}