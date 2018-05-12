<?php

namespace application\controllers;

use application\components\Controller;
use application\lib\Db;


class HomeController extends Controller
{
    public function indexAction()
    {
    	// $db = new Db;
    	// $form = '1111; DELET FROM user';
    	
    	// $data = $db->column('SELECT user_name FROM user WHERE id = :id', $params);
    	// debug($data);
    	$res = $this->model->getPics();
    	$params = [
    		'items' => $res,
    	];
        $this->view->render('', $params);
    }
}