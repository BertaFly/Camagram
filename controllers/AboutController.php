<?php

class AboutController
{
    public function actionView()
    {
        require_once (ROOT.'/views/about.php');
        return true;
    }
}