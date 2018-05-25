<?php

namespace application\controllers;

use application\components\Controller;
use application\controllers\UserController;
use application\models\User;
use application\models\Picture;


use application\lib\Db;


class HomeController extends Controller
{
    public function indexAction()
    {
    	if (isset($_SESSION['isUser']))
        {
            $feed = new Picture();
            $arr = $feed->extractPics();
            $this->view->render('home/index', $arr);
        }
        else
        {
            $this->view->render('home/noAuthor');
        }
    }

}