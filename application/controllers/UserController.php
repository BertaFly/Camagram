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
        $encoding = "utf-8";
        $from_name = "Cramata";
        $from_mail = "cramata@lol.com";
        // Mail header
        $header = "Content-type: text/html; charset=".$encoding." \r\n";
        $header .= "From: ".$from_name." <".$from_mail."> \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-Transfer-Encoding: 8bit \r\n";
        $header .= "Date: ".date("r (T)")." \r\n";
        //Send
        $res = mail($mail_to, $mail_subject, $mail_message, $header);
        return $res;
    }

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
                    $this->showMsg($arr);
                    header('refresh:3; url=signin');
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
                    $res == true ? $msg = 'success, check your email' : $msg = 'something went wrong'; 
                }
            }       
            $arr['msg'] = $msg;
            $this->showMsg($arr);
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
            $res = $this->model->extractUsersByLogin($login);
            if ($res != null && $res[0]['token'] == $token)
            {
                $this->model->changeEmailStatus($login, 1);
                if (isset($_SESSION['emailNew']))
                {
                    $res = $this->model->changeEmail($login, $_SESSION['emailNew']);
                    $res == true ? $msg = 'You successfully changed your email' : $msg = 'Oups, something went wrong';
                }
                $this->model->authorize($login);
            }
        }
        else
        {
            View::errorCode(404);
        }
    }

    public function resetPassAction()
    {
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
            $res = $this->sendMail($mail_to, $mail_subject, $mail_message);
            $res == true ? $msg = 'Check your email. We sent you a magic link.' : $msg = 'Something went wrong';       
            $arr['msg'] = $msg;
            $this->showMsg($arr);
        }
        else if (isset($_GET['token']) && isset($_GET['email']))
        {
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
                            <p>You successfully change your password.</p>
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
        if(isset($_POST['Submit']))
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
            if($tmp[0]['pass'] == $_POST['passwdOld'])
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
                            <p>Hi '.$tmp[0]['user'].',</p>
                            <p>You successfully change your password.</p>
                            <p>Best Regards, Cramata</p>';
                            $res = $this->sendMail($mail_to, $mail_subject, $mail_message);
                            $this->showMsg($arr);
                            header('refresh:1; url=http://localhost:8070/user/cabinet');
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
                $this->model->changeEmailStatus($login, 0);
                $token = $this->generateToken();
                $this->model->changeToken($login, $token);

                            $base_url = 'http://localhost:8070/user/confirmEmail/';
                            $mail_to = $tmp[0]['email'];
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
                $msg = 'Nice try, but please, enter YOUR email';
            }
            $arr['msg'] = $msg;
            $this->showMsg($arr);
            header('refresh:1; url=http://localhost:8070/user/cabinet');
        }
    }

    public function showMsg($arr)
    {
       $this->view->render('user/showMsg', $arr);
    }

    public function cabinetAction()
    {
        $this->view->render('user/cabinet');
    }

}