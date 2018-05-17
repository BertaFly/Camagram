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

	public function extractUsersByEmail($str)
	{
		$res = $this->db->row("SELECT * FROM users WHERE email='$str'");
		return $res;
	}

	public function authorize($login)
	{
		$_SESSION['isUser'] = 1;
        $_SESSION['authorizedUser'] = $login;
  		$this->phpAlert('You are authorized');
        header('refresh:1; url=http://localhost:8070/home');
        exit();
	}

	public function phpAlert($msg) {
    	echo '<script type="text/javascript">alert("'.$msg.'")</script>';
	}

}