<?php

namespace application\controllers;

use application\components\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
    	$user = [
    		'user_name' => 'Ira',
    		'pictures' => [1, 2, 3],
    	];
        $this->view->render('', $user);
    }
}