<?php

namespace application\controllers;

use application\components\Controller;

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
}