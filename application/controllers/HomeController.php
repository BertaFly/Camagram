<?php

namespace application\controllers;

use application\components\Controller;
use application\controllers\UserController;
use application\models\User;


use application\lib\Db;


class HomeController extends Controller
{
    public function indexAction()
    {
    	if (isset($_SESSION['isUser']))
        {
            $this->view->render('home/index');
        }
        else
        {
            $this->view->render('home/noAuthor');
        }
    }

}