<?php

namespace application\controllers;

use application\components\Controller;
use application\lib\Db;


class HomeController extends Controller
{
    public function indexAction()
    {
    	$db = new Db;
    	// $form = '1111; DELET FROM user';
    	
    	$res = $db->column('SELECT login FROM users');
    	// debug($data);
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