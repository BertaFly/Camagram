<?php

namespace application\models;

use application\components\Model;

class User extends Model
{
	public function extractUserByLogin($str)
	{
		$res = $this->db->row("SELECT * FROM users WHERE login='$str'");
		return $res;
	}

	public function extractUserLoginById($user_id)
	{
		$res = $this->db->row("SELECT login FROM users WHERE id='$user_id'");
		return $res[0]['login'];
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

	public function insertUserSubscription($str)
	{
		$user = $this->extractUserByLogin($str);
		$user_id = $user[0]['id'];
		$this->db->query("INSERT INTO subscription (user_id) VALUES ('$user_id')");
	}

	public function getSubscriptionPreferences($user_id)
	{
		return ($this->db->row("SELECT * FROM subscription WHERE user_id='$user_id'"));
	}

	public function changeSubscriptionPreferences($arr, $user_sub)
	{
		if ($arr != null)
		{
			$user_id = $user_sub[0]['user_id'];
			if (isset($_GET["login"]))
	        {
	            if ($arr["login"] == "no" && $user_sub[0]['sub_login'] == 1)
	                $this->db->query("UPDATE subscription SET sub_login = 0 WHERE user_id='$user_id'");
	            elseif ($arr["login"] == "yes" && $user_sub[0]['sub_login'] === '0')
	                $this->db->query("UPDATE subscription SET sub_login = 1 WHERE user_id='$user_id'");
	        }
	        if (isset($arr["pass"]))
	        {
	            if ($arr["pass"] == "no" && $user_sub[0]['sub_pass'] == 1)
	                $this->db->query("UPDATE subscription SET sub_pass = 0 WHERE user_id='$user_id'");
	            elseif ($arr["pass"] == "yes" && $user_sub[0]['sub_pass'] === '0')
	                $this->db->query("UPDATE subscription SET sub_pass = 1 WHERE user_id='$user_id'");
	        }
	        if (isset($arr["comment"]))
	        {
	            if ($arr["comment"] == "no" && $user_sub[0]['sub_comment'] == 1)
	                $this->db->query("UPDATE subscription SET sub_comment = 0 WHERE user_id='$user_id'");
	            elseif ($arr["comment"] == "yes" && $user_sub[0]['sub_comment'] === '0')
	                $this->db->query("UPDATE subscription SET sub_comment = 1 WHERE user_id='$user_id'");
	        }
	    }
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
		// print_r($login."<br>");
		$tmp = $this->db->row("SELECT * FROM users WHERE login='$login'");
		// var_dump($tmp);
		// echo "<br>after select user by login<br>";
		$uI = $tmp[0]['id'];
		$res = $this->db->row("SELECT * FROM pics WHERE user_id='$uI' ORDER BY id_pic DESC");
		// var_dump($res);
		// echo "<br>after select pictuser by user id<br>";
		return $res;
	}

	public function phpAlert($msg) {
    	echo '<script type="text/javascript">alert("'.$msg.'")</script>';
	}

	public function extractLoginByPic($pic_id)
	{
		$tmp = $this->db->row("SELECT user_id FROM pics WHERE id_pic='$pic_id'");
		$who = $tmp[0]["user_id"];
		$res = $this->db->row("SELECT login FROM users WHERE id='$who'");
		return $res[0]['login'];
	}

	public function checkSubscription($param)
	{
		if (array_key_exists("login", $param) === true)
		{
			// echo "in checking<br>";
			$user = $this->extractUserByLogin($param['login']);
			$user_id = $user[0]['id'];
			// echo "user_id = ".$user_id."<br>";

			$subPreferences = $this->db->row("SELECT * FROM subscription WHERE user_id='$user_id'");
			// var_dump($subPreferences);

			if (array_key_exists("checkLogin", $param) === true) {
				// echo "HERE 1<br>";

				if ($subPreferences[0]['sub_login'] == 1)
					return true;
			}
			elseif (array_key_exists("checkPass", $param) === true) {
				// echo "HERE 2<br>";

				if ($subPreferences[0]['sub_pass'] == 1)
					return true;
			}
			elseif (array_key_exists("checkComment", $param) === true) {
				// echo "HERE 3<br>";

				if ($subPreferences[0]['sub_comment'] == 1)
					return true;
			}
		}
		return false;
	}

}