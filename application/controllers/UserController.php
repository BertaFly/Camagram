<?php

namespace application\controllers;

use application\components\Controller;
use application\components\View;
use application\lib\Db;

class UserController extends Controller
{

    public function generateToken()
    {
        $token = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789!$/()*";
        $token = str_shuffle($token);
        $token = substr($token, 0, 20);
        return $token;
    }

    public function sendMail($mail_to, $mail_subject, $mail_message)
    {
        $res = false;
        if ($mail_to != null && $mail_subject != null && $mail_message != null)
        {
            $subject_preferences = array(
                "input-charset" => $encoding,
                "output-charset" => $encoding,
                "line-length" => 76,
                "line-break-chars" => "\r\n"
            );
            $encoding = "utf-8";
            $from_name = "Cramata";
            $from_mail = "cramata@lol.com";
            // Mail header
            $header = "Content-type: text/html; charset=".$encoding." \r\n";
            $header .= "From: ".$from_name." <".$from_mail."> \r\n";
            $header .= "MIME-Version: 1.0 \r\n";
            $header .= "Content-Transfer-Encoding: 8bit \r\n";
            $header .= "Date: ".date("r (T)")." \r\n";
            $header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
            //Send
            $res = mail($mail_to, $mail_subject, $mail_message, $header);
        }
        return $res;
    }

    public function loginAction()
    {
        if (isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['passwd']))
        {
            $msg = "";
            $login = $_POST['login'];
            $passwd = $_POST['passwd'];
            if ($login != "" && $passwd != "")
            {
                $res = $this->model->extractUsersByLogin($login);
                if ($res != null && password_verify($passwd, $res[0]['pass']) && $res[0]['isEmailConfirmed'] == 1)
                {
                    $this->model->authorize($login);
                }
                else
                {
                    $msg = "Wrong login or password. In addition, check if your verify your email.";
                }
            }
            else
            {
                $msg = "Please fill login or password field";
            }
            $arr['msg'] = $msg;
            $this->showMsg($arr);
            header('refresh:2; url=login');
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
        if (isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['cpasswd']) && isset($_POST['email']))
        {
            $login = $_POST['login'];
            $passwd = $_POST['passwd'];
            $cpasswd = $_POST['cpasswd'];
            $email = $_POST['email'];
            $wrongLogin = ($login == "" || strlen($login) < 5);
            $wrongPass = ($passwd == "" || $cpasswd != $passwd || strlen($passwd) < 7);
            $wrongEmail = ($email == "" || filter_var($email, FILTER_VALIDATE_EMAIL) == false);
            if ($wrongLogin || $wrongPass || $wrongEmail)
            {
                $msg = "Check your inputs";
            }
            else
            {
                $isLoginTaken = $this->model->extractUsersByLogin($login);
                $isEmailTaken = $this->model->extractUsersByEmail($email);
                if ($isLoginTaken != null || $isEmailTaken != null)
                {
                    $isLoginTaken != null ? $msg = 'This login has already taken' : $msg = 'This email has already registered';
                }
                else
                {
                    $token = $this->generateToken();
                    $hashPass = password_hash($passwd, PASSWORD_BCRYPT);
                    $sql = "INSERT INTO users (login,pass,email,isEmailConfirmed,token) VALUES ('$login', '$hashPass', '$email', '0', '$token')";
                    $this->model->insertNewUser($sql);
                    $base_url = 'http://localhost:8070/user/confirmEmail/';
                    $mail_to = $_POST["email"];
                    $mail_subject = 'Account varification';
                    $mail_message = '
                    <p>Hi '.$_POST["login"].',</p>
                    <p>Thanks for registration. In order to use your account at our site, please confirm your email by following this link: '.$base_url.'email_verification?login='.$_POST['login'].'&activation_code='.$token.'</p>
                    <p>Best Regards, Cramata</p>';
                    $res = $this->sendMail($mail_to, $mail_subject, $mail_message);
                    $res == true ? $msg = 'Success, check your email' : $msg = 'Something went wrong'; 
                }
            }       
            $arr['msg'] = $msg;
            $this->showMsg($arr);
            $msg == "Success, check your email" ? header('refresh:2; url=http://localhost:8070/home') : header('refresh:2; url=http://localhost:8070/user/signin');
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
        if ($tmp != null && isset($_GET['login']) && isset($_GET['activation_code']))
        {
            $msg = '';
            $login = $_GET['login'];
            $token = $_GET['activation_code'];
            if ($login != "" && $token != "")
            {
                $res = $this->model->extractUsersByLogin($login);
                if ($res != null && $res[0]['token'] == $token)
                {
                    $this->model->changeEmailStatus($login, 1);
                    //Insert in db new email if user wants to change it
                    if (isset($_SESSION['emailNew']))
                    {
                        $res = $this->model->changeEmail($login, $_SESSION['emailNew']);
                        if ($res == true)
                        {
                            unset($_SESSION['emailNew']);
                        }
                        else
                        {
                            $msg = 'Oups, something went wrong';
                        }
                    }
                    if ($msg != 'Oups, something went wrong')
                    {
                        $this->model->authorize($login);
                    }
                }
            }
            else
            {
                $msg = 'Oups, something went wrong';
            }
            $arr['msg'] = $msg;
            $this->showMsg($arr);
        }
        else
        {
            View::errorCode(404);
        }
    }

    public function resetPassAction()
    {
        if (isset($_POST['submit']) && isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) != false)
        {
            $user = $this->model->extractUsersByEmail($_POST['email']);
            if ($user != null)
            {
                //Mail
                $base_url = 'http://localhost:8070/user/resetPass';
                $mail_to = $_POST["email"];
                $mail_subject = 'Reset password';
                $mail_message = '
                <p>Hi '.$user[0]['login'].',</p>
                <p>In order to change your forgotten password, please, follow this link: '.$base_url.'/initial?email='.$_POST['email'].'&token='.$user[0]['token'].' . If you did not request it, just ignore this letter.</p>
                <p>Best Regards, Cramata</p>';
                $res = $this->sendMail($mail_to, $mail_subject, $mail_message);
                $res == true ? $msg = 'Check your email. We sent you a magic link.' : $msg = 'Something went wrong';
                $arr['msg'] = $msg;
                $this->showMsg($arr);
            }
        }
        else if (isset($_GET['token']) && isset($_GET['email']) && filter_var($_GET['email'], FILTER_VALIDATE_EMAIL) != false)
        {
            $user = $this->model->extractUsersByEmail($_GET['email']);
            if ($user != null && $user[0]['token'] == $_GET['token'])
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
        if (isset($_POST['submit']) && isset($_POST['passwd']) && isset($_SESSION['who_change_pass']))
        {
            $user = $_SESSION['who_change_pass'];
            $pass = $_POST['passwd'];
            $tmp = $this->model->extractUsersByLogin($user);
            if ($tmp != null && $pass === $_POST['cpasswd'] && $pass != "" && $_POST['cpasswd'] != "" && $user != "")
            {
                if (password_verify($pass, $tmp[0]['pass']))
                {
                    $msg = 'New password should differ from old one';
                    $arr['msg'] = $msg;
                    $this->showMsg($arr);
                }
                else
                {
                    $hashPass = password_hash($pass, PASSWORD_BCRYPT);
                    $token = $this->generateToken();
                    $res = $this->model->changePass($token, $user, $hashPass);
                    if ($res == true)
                    {
                        unset($_SESSION['who_change_pass']);
                        $mail_to = $tmp[0]['email'];
                        $mail_subject = 'Reset password';
                        $mail_message = '
                            <p>Hi '.$user.',</p>
                            <p>You successfully changed your password.</p>
                            <p>Best Regards, Cramata</p>';
                        $res = $this->sendMail($mail_to, $mail_subject, $mail_message);
                        $this->model->authorize($user);
                    }
                    else
                    {
                        $msg = 'Something went wrong';
                        $arr['msg'] = $msg;
                        $this->showMsg($arr);
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
        $this->view->redirect('http://localhost:8070/home');
        exit();
    }

    public function changeLoginAction()
    {
        if(isset($_POST['Submit']) && isset($_POST['loginOld']) && isset($_POST['loginNew']) && isset($_SESSION['authorizedUser']))
        {
            if($_SESSION['authorizedUser'] == $_POST['loginOld'])
            {
                if(strlen($_POST['loginNew']) >= 5)
                {
                    if($_POST['loginOld'] != $_POST['loginNew'])
                    {
                        if ($this->model->changeLogin($_POST['loginOld'], $_POST['loginNew']) == true)
                        {
                            $msg = 'Success';
                            $tmp = $this->model->extractUsersByLogin($_POST['loginNew']);
                            $mail_to = $tmp[0]['email'];
                            $mail_subject = 'Login change';
                            $mail_message = '
                            <p>Hi '.$_POST["loginOld"].',</p>
                            <p>You successfully change your login to '.$_POST['loginNew'].'.</p>
                            <p>Best Regards, Cramata</p>';
                            $res = $this->sendMail($mail_to, $mail_subject, $mail_message);
                            $_SESSION['authorizedUser'] = $_POST['loginNew'];
                        }
                        else
                        {
                            $msg = 'Oups, please try again later';

                        }
                    }
                    else
                    {
                        $msg = 'New login should differ from old one';
                    }
                }
                else
                {
                    $msg = 'New login should be longer then 4 chars';
                }
            }
            else
            {
                $msg = 'Nice try, but please, enter YOUR login';
            }
            $arr['msg'] = $msg;
            $this->showMsg($arr);
            header('refresh:1; url=http://localhost:8070/user/cabinet');
        }
    }

    public function changePassAction()
    {
        if(isset($_POST['Submit']))
        {
            $tmp = $this->model->extractUsersByLogin($_SESSION['authorizedUser']);
            if(password_verify($_POST['passwdOld'], $tmp[0]['pass']))
            {
                if(strlen($_POST['passwdNew']) >= 7)
                {
                    if($_POST['passwdOld'] != $_POST['passwdNew'])
                    {
                        $token = $this->generateToken();
                        if ($this->model->changePass($token, $_SESSION['authorizedUser'], $_POST['passwdNew']) == true)
                        {
                            $msg = 'Success';
                            $mail_to = $tmp[0]['email'];
                            $mail_subject = 'Password change';
                            $mail_message = '
                            <p>Hi '.$tmp[0]['login'].',</p>
                            <p>You successfully changed your password.</p>
                            <p>Best Regards, Cramata</p>';
                            $res = $this->sendMail($mail_to, $mail_subject, $mail_message);
                        }
                        else
                        {
                            $msg = 'Oups, please try again later';

                        }
                    }
                    else
                    {
                        $msg = 'New password should differ from old one';
                    }
                }
                else
                {
                    $msg = 'New password should be longer then 6 chars';
                }
            }
            else
            {
                $msg = 'You entered incorect previous password';
            }
            $arr['msg'] = $msg;
            $this->showMsg($arr);
            header('refresh:2; url=http://localhost:8070/user/cabinet');
        }
    }

    public function changeEmailAction()
    {
        if(isset($_POST['Submit']))
        {
            $tmp = $this->model->extractUsersByLogin($_SESSION['authorizedUser']);
            if($tmp[0]['email'] == $_POST['emailOld'])
            {
                $isEmailTaken = $this->model->extractUsersByEmail($_POST['emailNew']);
                if ($isEmailTaken == null)
                {
                    $this->model->changeEmailStatus($tmp[0]['login'], 0);
                    $token = $this->generateToken();
                    $this->model->changeToken($tmp[0]['login'], $token);
                    $base_url = 'http://localhost:8070/user/confirmEmail/';
                    $mail_to = $tmp[0]['email'].", ".$_POST['emailNew'];
                    $mail_subject = 'Email change';
                    $mail_message = '
                    <p>Hi '.$tmp[0]['login'].',</p>
                    <p>In order to finish email change, please follow this link: '.$base_url.'email_verification?login='.$tmp[0]['login'].'&activation_code='.$token.' .</p>
                    <p>Best Regards, Cramata</p>';
                    $res = $this->sendMail($mail_to, $mail_subject, $mail_message);
                    if ($res == true)
                    {
                        $_SESSION['emailNew'] = $_POST['emailNew'];
                        $msg = 'We sent you a magic link. Please follow it in order to complite changing your email';
                    }
                    else
                    {
                        $msg = 'Oups, please try again later';
                    }
                }
                else
                {
                    $msg = 'Your new email has already taken';
                } 
            }
            else
            {
                $msg = 'Nice try, but please, enter YOUR email';
            }
            $arr['msg'] = $msg;
            $this->showMsg($arr);
            header('refresh:2; url=http://localhost:8070/user/cabinet');
        }
    }

    public function showMsg($arr)
    {
       $this->view->render('user/showMsg', $arr);
    }

    public function cabinetAction()
    {
        $userPics = $this->model->extractUsersPics($_SESSION['authorizedUser']);
        $this->view->render('user/cabinet', $userPics);
    }

}