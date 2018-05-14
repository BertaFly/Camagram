<?php

namespace application\controllers;

use application\components\Controller;
use application\components\View;
use application\lib\Db;

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';

class UserController extends Controller{
	
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
        // var_dump($_POST);
        if ($_POST['submit'] == 'OK')
        {
            $login = $_POST['login'];
            $passwd = $_POST['passwd'];
            $cpasswd = $_POST['cpasswd'];
            $email = $_POST['email'];
            $wrongLogin = ($login == "" || strlen($login) < 5);
            $wrongPass = ($passwd == "" || $cpasswd != $passwd || strlen($passwd) < 7);
            if ($wrongLogin || $wrongPass || $email == "")
            {
                // $msg = "Please check your inputs";
                
                View::errorCode('input');
                header('location: signin');
            }
            else
            {
                $sql = "SELECT id FROM users WHERE login='$login'";
                $con = new Db;
                $res = $con->row($sql);
                if ($res != null)
                {
                    // View::errorCode('login');
                    var_dump($res);
                }
                else
                {
                    $token = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789!$/()*";
                    $token = str_shuffle($token);
                    $token = substr($token, 0, 10);
                    $hashPass = password_hash($passwd, PASSWORD_BCRYPT);
                    $con->query("INSERT INTO users (login,pass,email,isEmailConfirmed,token)
                        VALUES ('$login', '$hashPass', '$email', '0', '$token')
                        ");
                    echo 'success, check your email';

//                     $base_url = 'http://localhost/emailsent/';
//                     $mail_body = '
// <p>Hi '.$_POST["login"].',</p>
// <p>Thanks for registration. Your password is '.$_POST["passwd"].'. In order to use your account at our site, please confirm your email by following this link: '.$base_url.'email_verification.php?activation_code='.$token.'</p>
// <p>Best Regards, Cramata</p>';
// require 'class.phpmailer.php';
                    // $mail->setFrom('cramata@google.com');
                    // $mail->addAddress($email, $login);
                    // $mail->Subject = 'Account varification.';
                    // $mail->isHTML(true);
                    // $mail->Body = "
                    //     Please verify your email address by link below:<br><br>
                    //     <a href = 'http://localhost:8070/PHPEmailConfirmation/confirm.php?email=$email&token=$token'>Click here</a>
                    //     ";

                    // var_dump($mail);

                    // if ($mail->send())
                    // {
                    //     $msg = "You have been registered! Please verify your email.";
                    //     echo "<br>".$msg;
                    // }
                    // else
                    // {
                    //     $msg = "UUUUps Something went wrong.";
                    //     echo "<br>".$msg;

                    // }   
                }
            }
        }
    }
}