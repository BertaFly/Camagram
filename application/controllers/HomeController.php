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

    	$params = [
    		'items' => $res,
    	];
        $this->view->render('', $params);
    }
}