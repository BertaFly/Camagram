<?php

class HomeController
{
    public function actionView()
    {
        require_once (ROOT.'/views/home.php');
        return true;
    }
}