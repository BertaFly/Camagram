<?php

namespace application\controllers;

use application\components\Controller;
use application\components\View;
use application\lib\Db;
$msg = '';


// use application\controllers\PHPMailer\src\PHPmailer;
// use application\controllers\PHPMailer\src\Exception;

// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';

class UserController extends Controller {
	
    public function loginAction()
    {
        $this->view->render('');
        return true;
    }

    public function signinAction()
    {
        $msg = "";
        // var_dump($_POST);
        if (isset($_POST['submit']))
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
                    View::errorCode('login');
                    // var_dump($res);
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

                    //Mail
                    $base_url = 'http://localhost:8070/user/create/';
                    $mail_to = $_POST["email"];
                    $mail_subject = 'Account varification';
                    $mail_message = '
                    <p>Hi '.$_POST["login"].',</p>
                    <p>Thanks for registration. In order to use your account at our site, please confirm your email by following this link: '.$base_url.'email_verification.php?login='.$_POST['login'].'&activation_code='.$token.'</p>
                    <p>Best Regards, Cramata</p>';

                    $encoding = "utf-8";
                    $from_name = "Cramata";
                    $from_mail = "cramata@lol.com";
                    // Mail header
                        $header = "Content-type: text/html; charset=".$encoding." \r\n";
                        $header .= "From: ".$from_name." <".$from_mail."> \r\n";
                        $header .= "MIME-Version: 1.0 \r\n";
                        $header .= "Content-Transfer-Encoding: 8bit \r\n";
                        $header .= "Date: ".date("r (T)")." \r\n";
                    // Send mail
                    $res = mail($mail_to, $mail_subject, $mail_message, $header);
                                        
                    if ($res == true)
                    {
                        $msg = 'success, check your email';
                    }
                    else
                    {
                        $msg = 'something went wrong';
                    }  
                }
            }
           
            $arr['msg'] = $msg;

            $this->view->render('', $arr);
        }
        else
        {
            $this->view->render('', $arr);
        }
        return true;
    }

    public function confirmAction() 
    {
       //
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
                    View::errorCode('login');
                    // var_dump($res);
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

                    //Mail
                    $base_url = 'http://localhost:8070/user/create/';
                    $mail_to = $_POST["email"];
                    $mail_subject = 'Account varification';
                    $mail_message = '
                    <p>Hi '.$_POST["login"].',</p>
                    <p>Thanks for registration. In order to use your account at our site, please confirm your email by following this link: '.$base_url.'email_verification.php?login='.$_POST['login'].'&activation_code='.$token.'</p>
                    <p>Best Regards, Cramata</p>';

                    $encoding = "utf-8";
                    $from_name = "Cramata";
                    $from_mail = "cramata@lol.com";
                    // Mail header
                        $header = "Content-type: text/html; charset=".$encoding." \r\n";
                        $header .= "From: ".$from_name." <".$from_mail."> \r\n";
                        $header .= "MIME-Version: 1.0 \r\n";
                        $header .= "Content-Transfer-Encoding: 8bit \r\n";
                        $header .= "Date: ".date("r (T)")." \r\n";
                    // Send mail
                    $res = mail($mail_to, $mail_subject, $mail_message, $header);
                                        
                    if ($res == true)
                    {
                        echo 'success, check your email';
                    }
                    else
                    {
                        echo 'something went wrong';
                    }  
                }
            }
        }
    }
}