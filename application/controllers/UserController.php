<?php

namespace application\controllers;

use application\components\Controller;
use application\lib\Db;
use application\components\PHPMailer\PHPMailer;

class UserController extends Controller{
	
	// private function getURI()
 //    {
 //        if (!empty($_SERVER['REQUEST_URI']))
 //        {
 //            return trim($_SERVER['REQUEST_URI'], '/');
 //        }
 //    }

 //    public function actionSignin()
 //    {
 //        require_once (ROOT.'/views/signin.php');
 //        $uri = $this->getURI();
 //        $login = strstr($uri, '#');
 //        print("in user controller URI " . $uri);
 //        if ($login !== null && $login == '#login')
 //        {
 //        	print("<br> calling login ");

 //        	actionLogin();
 //        }
 //        return true;
 //    }

    public function loginAction()
    {
        $this->view->render('');
        return true;
    }

    public function signinAction()
    {
        $this->view->render('');
        return true;
    }

    public function createAction()
    {
        $msg = "";
        var_dump($_POST);
        if ($_POST['submit'] == 'OK')
        {
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
                echo "<br>";
                var_dump($sql);
                //if ($sql->num_rows > 0)
                if ($sql == "")
                {
                    $msg = "This username has been already taken";
                    echo $msg."<br>";
                }
                else
                {
                    $token = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789!$/()*";
                    $token = str_shuffle($token);
                    $token = substr($token, 0, 10);
echo $token."<br>";

                    $hashPass = password_hash($passwd, PASSWORD_BCRYPT);
echo $hashPass."<br>";


                    $con->query("INSERT INTO users (uname,pass,email,isEmailConfirmed,token)
                        VALUES ('$login', '$hashPass', '$email', '0', '$token')
                        ");

                    include_once "PHPMailer/PHPMailer.php";
                    $mail = new PHPMailer();
                    $mail->setFrom('cramata@google.com');
                    $mail->addAddress($email, $login);
                    $mail->Subject = 'Account varification.';
                    $mail->isHTML(true);
                    $mail->Body = "
                        Please verify your email address by link below:<br><br>
                        <a href = 'http://localhost:8070/PHPEmailConfirmation/confirm.php?email=$email&token=$token'>Click here</a>
                        ";

                    var_dump($mail);

                    if ($mail->send())
                    {
                        $msg = "You have been registered! Please verify your email.";
                        echo "<br>".$msg;
                    }
                    else
                    {
                        $msg = "UUUUps Something went wrong.";
                        echo "<br>".$msg;

                    }   
                }
            }
        }
    }
}