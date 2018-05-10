<?php

namespace application\controllers;

use application\components\Controller;

class AboutController extends Controller
{
    public function viewAction()
    {
        // require_once (ROOT.'/views/about.php');
        $this->view->render('');
        return true;
    }
}