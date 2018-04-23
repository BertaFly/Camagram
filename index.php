<?php
//FRONT CONTROLLER

//1. general settings
//PDO::ERRMODE_EXCEPTION;

//2. include file system
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');

//3. setup DB connection


//4. call Router
$router = new Router();
$router->run();
