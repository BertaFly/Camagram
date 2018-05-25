<?php

namespace application\models;

use application\components\Model;

class Picture extends Model
{
	public function insertFile($str)
	{
		$this->db->query("INSERT INTO pics (user_id,link,likes,comments) VALUES (1,'','$str',99,'')");
	}

	public function insertLink($user_id, $link)
	{
		$this->db->query("INSERT INTO pics (user_id,link,likes) VALUES ($user_id,'$link', 0)");
	}

	public function extractPics()
	{
		return ($this->db->row("SELECT * FROM pics"));
	}
}