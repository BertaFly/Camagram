<?php

namespace application\models;

use application\components\Model;

class Home extends Model
{
	
	public function getPics()
	{
		$res = $this->db->row('SELECT id, pic FROM random_pic');
		return $res;
	}

	public function upload($user_id, $name, $likes, $comments)
	{
  		$res = $this->db->query('INSERT INTO pics(user_id,link,likes,comments) values("$user_id","'.$name.'", "$likes","$comments")');
	}

}