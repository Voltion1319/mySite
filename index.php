<?php

// FRONT CONTROLLER

// General settings
ini_set('display_errors',1);
error_reporting(E_ALL);

// Include files
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');


// Call Router
$router = new Router();
$router->run();
