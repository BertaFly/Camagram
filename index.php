<?php
//FRONT CONTROLLER

//1. general settings
//PDO::ERRMODE_EXCEPTION;
ini_set('display_errors', 1);
error_reporting(E_ALL);

//2. include file system
define('ROOT', dirname(__FILE__));
//define('SERVER_ROOT', '/Users/inovykov/Camagru/htdocs');
//define('SITE_ROOT', '/Users/inovykov/Camagru/htdocs');
require_once(ROOT.'/components/' . 'Router.php');
require_once(ROOT.'/views/' . 'header.php');
//3. setup DB connection


//4. call Router
$router = new Router();
$router->run();
require_once(ROOT.'/views/' . 'footer.php');