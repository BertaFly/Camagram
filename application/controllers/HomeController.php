<?php

namespace application\controllers;

use application\components\Controller;
use application\lib\Db;


class HomeController extends Controller
{
    public function indexAction()
    {
    	$db = new Db;
    	$res = $db->column('SELECT login FROM users');
        if (array_key_exists('isUser', $_SESSION))
        {
            $params = [
                    'login' => $_SESSION['authorizedUser'],
                ];
        }
        else
        {
            $params = [
                    'login' => '',
                ];
        }
        $this->view->render('', $params);
    }
}