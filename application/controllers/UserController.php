<?php

namespace application\controllers;

use application\components\Controller;
use application\components\View;
use application\lib\Db;


// use application\controllers\PHPMailer\src\PHPmailer;
// use application\controllers\PHPMailer\src\Exception;

// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';

class UserController extends Controller {
	
    public function loginAction()
    {
        if (isset($_POST['submit']))
        {

            $login = $_POST['login'];
            $passwd = $_POST['passwd'];
            $res = $this->model->extractUsersByLogin($login);
            if ($res != null && password_verify($passwd, $res[0]['pass']) && $res[0]['isEmailConfirmed'] == 1)
            {
                $this->model->authorize($login);
            }
            else
            {
                // View::errorCode('input');
                $this->model->phpAlert("Wrong login or password. In addition, check if your verify your email.");
                header('refresh:1; url=login');
            }
        }
        else
        {
            $this->view->render('');
        }
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
                
                // View::errorCode('input');
                echo "Check input";
                header('refresh:2; url=http://localhost:8070/user/signin');
                exit();
            }
            else
            {
                $isLoginTaken = $this->model->extractUsersByLogin($login);
                $isEmailTaken = $this->model->extractUsersByEmail($email);
                if ($isLoginTaken != null || $isEmailTaken != null)
                {
                    $isLoginTaken != null ? $msg = 'This login has already taken' : $msg = 'This email has already registered';
                    $arr['msg'] = $msg;
                    $this->createAction($arr);
                    header('refresh:3; url=signin');
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
                    $base_url = 'http://localhost:8070/user/confirmEmail/';
                    $mail_to = $_POST["email"];
                    $mail_subject = 'Account varification';
                    $mail_message = '
                    <p>Hi '.$_POST["login"].',</p>
                    <p>Thanks for registration. In order to use your account at our site, please confirm your email by following this link: '.$base_url.'email_verification?login='.$_POST['login'].'&activation_code='.$token.'</p>
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
            $this->createAction($arr);
        }
        else
        {
            $this->view->render('');
        }
        return true;
    }

    public function confirmEmailAction() 
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $tmp = strstr($url, 'email_verification');
        if ($tmp != null)
        {
            $login = $_GET['login'];
            $token = $_GET['activation_code'];
            $con = new Db;
            $res = $con->row("SELECT * FROM users WHERE login='$login'");
            if ($res != null && $res[0]['token'] == $token)
            {
                $con->query("UPDATE users SET isEmailConfirmed='1' WHERE login='$login'");
                $this->model->authorize($login);
                header('Location: http://localhost:8070/home');
            }
        }
        else
        {
            View::errorCode(404);
        }
    }

    public function resetPassAction()
    {
        var_dump($_POST);
        if (isset($_POST['submit']))
        {
            $user = $this->model->extractUsersByEmail($_POST['email']);

            //Mail
            $base_url = 'http://localhost:8070/user/resetPass';
            $mail_to = $_POST["email"];
            $mail_subject = 'Reset password';
            $mail_message = '
            <p>Hi '.$user[0]['login'].',</p>
            <p>In order to change your forgotten password, please, follow this link: '.$base_url.'/initial?email='.$_POST['email'].'&token='.$user[0]['token'].' . If you did not request it, just ignore this letter.</p>
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
                $msg = 'Check your email. We sent you a magic link.';
            }
            else
            {
                $msg = 'Something went wrong';
            }         
            $arr['msg'] = $msg;
            $this->createAction($arr);
        }
        else if (isset($_GET['token']) && isset($_GET['email']))
        {
            var_dump($_GET);
            echo "<p>in session</p>";
            var_dump($_SESSION);

            $user = $this->model->extractUsersByEmail($_GET['email']);
            if ($user[0]['token'] == $_GET['token'])
            {
                $_SESSION['who_change_pass'] = $user[0]['login'];
                $this->view->render('user/resetPassAfter');
            }
        }
        else
        {
            $this->view->render('user/resetPass');
        }
    }

    public function resetPassAfterAction()
    {
        var_dump($_POST);
        echo "<p>in session</p>";
        var_dump($_SESSION);

        if (isset($_POST['submit']))
        {
            $user = $_SESSION['who_change_pass'];
            $pass = $_POST['passwd'];
            $tmp = $this->model->extractUsersByLogin($user);
            if ($pass === $_POST['cpasswd'] && $pass != "" && $_POST['cpasswd'] != "")
            {
                if (password_verify($pass, $tmp[0]['pass']))
                {
                    $msg = 'New password should differ from old one';
                    $arr['msg'] = $msg;
                    $this->createAction($arr);
                }
                else
                {
                    $con = new Db;
                    $hashPass = password_hash($pass, PASSWORD_BCRYPT);
                    $token = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789!$/()*";
                        $token = str_shuffle($token);
                        $token = substr($token, 0, 10);
                    $res = $con->query("UPDATE users SET pass='$hashPass' token='$token' WHERE login='$user'");
                    if ($res == true)
                    {
                        unset($_SESSION['who_change_pass']);
                        $this->model->authorize($user);
                    }
                    else
                    {
                        $msg = 'Something went wrong';
                        $arr['msg'] = $msg;
                        $this->createAction($arr);
                    }
                }
            }
        }
    }

    public function logoutAction()
    {
        unset($_SESSION['authorizedUser']);
        unset($_SESSION['isUser']);
        session_destroy();
        header('Location: home');
        exit();
    }

    public function createAction($arr)
    {
       $this->view->render('user/create', $arr);
    }
}