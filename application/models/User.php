<?php

namespace application\models;

use application\components\Model;

class User extends Model
{
	public function extractUsersByLogin($str)
	{
		$res = $this->db->row("SELECT * FROM users WHERE login='$str'");
		return $res;
	}

	public function authorize($login)
	{
		$_SESSION['isUser'] = 1;
        $_SESSION['authorizedUser'] = $login;
        header('Location: http://localhost:8070/home');
        exit();
	}

}