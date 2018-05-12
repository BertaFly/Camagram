<?php

use application\lib\Db;
use application\components\PHPMailer\PHPMailer;

	$msg = "";
	var_dump($_POST);
	if ($_POST['submit'] == 'OK')
	{
		alert("privet");
		$con = new Db;
		$login = $_POST['login'];
		$passwd = $_POST['passwd'];
		$email = $_POST['email'];

		if ($login == "" || $passwd == "" || $email == "")
		{
			$msg = "Please check your inputs";
		}
		else
		{
			$sql = $con->query("SELECT id FROM users WHERE uname='$login'");
			if ($sql->num_rows > 0)
			{
				$msg = "This username has been already taken";
			}
			else
			{
				$token = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789!$/()*";
				$token = str_shuffle($token);
				$token = substr($token, 0, 10);

				$hashPass = password_hash($passwd, PASSWORD_BCRYPT);

				$con->query("INSERT INTO users (uname,pass,email,isEmailConfirmed,token)
					VALUES ('$login', '$hashPass', '$email', '0', '$token')
					");

				include_once "../../components/PHPMailer/PHPMailer.php";
				$mail = new PHPMailer();
				$mail->setFrom('cramata@google.com');
				$mail->addAddress($email, $login);
				$mail->Subject = 'Account varification.';
				$mail->isHTML(true);
				$mail->Body = "
					Please verify your email address by link below:<br><br>
					<a href = 'http://localhost:8070/PHPEmailConfirmation/confirm.php?email=$email&token=$token'>Click here</a>
					";

				if ($mail->send())
				{
					$msg = "You have been registered! Please verify your email.";
				}
				else
				{
					$msg = "UUUUps Something went wrong.";
				}	
			}
		}

	}
?>