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

	public function insertNewUser($str)
	{
		$res = $this->db->query($str);
	}

	public function changeEmailStatus($login, $status)
	{
		if($status == 1)
		{
			$this->db->query("UPDATE users SET isEmailConfirmed='1' WHERE login='$login'");
		}
		else if($status == 0)
		{
			$this->db->query("UPDATE users SET isEmailConfirmed='0' WHERE login='$login'");
		}
		return true;
	}

	public function changeToken($login, $token)
	{
		$this->db->query("UPDATE users SET token='$token' WHERE login='$login'");
		return true;
	}

	public function authorize($login)
	{
		$_SESSION['isUser'] = 1;
        $_SESSION['authorizedUser'] = $login;
  		$this->phpAlert('You are authorized');
        header('refresh:1; url=http://localhost:8070/home');
        exit();
	}

	public function changeLogin($old, $new)
	{
		$this->db->query("UPDATE users SET login='$new' WHERE login='$old'");
		return true;
	}

	public function changePass($token, $login, $pass)
	{
		$passHash = password_hash($pass, PASSWORD_BCRYPT);
		$this->db->query("UPDATE users SET pass='$passHash' WHERE login='$login'");
		$this->db->query("UPDATE users SET token='$token' WHERE login='$login'");
		return true;
	}

	public function changeEmail($login, $email)
	{
		$this->db->query("UPDATE users SET email='$email' WHERE login='$login'");
		return true;
	}

	public function extractUsersPics($login)
	{
		print_r($login."<br>");
		$tmp = $this->db->row("SELECT * FROM users WHERE login='$login'");
		var_dump($tmp);
		echo "<br>after select user by login<br>";
		$uI = $tmp[0]['id'];
		$res = $this->db->row("SELECT * FROM pics WHERE user_id='$uI'");
		var_dump($res);
		echo "<br>after select pictuser by user id<br>";
		return $res;
	}

	public function phpAlert($msg) {
    	echo '<script type="text/javascript">alert("'.$msg.'")</script>';
	}

}