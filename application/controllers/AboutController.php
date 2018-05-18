<?php

namespace application\controllers;

use application\components\Controller;

class AboutController extends Controller
{
    public function viewAction()
    {
        $this->view->render('');
        return true;
    }
}