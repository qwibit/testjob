<?php

//ini_set('display_errors', 1);
//error_reporting(-1);

require_once 'src/DI.php';
require_once 'src/Database.php';
require_once 'src/Init.php';

// Dependency injection
$di = new src\DI();

// Config
$config = require_once 'config.php';
$di->set('config', $config);

// Database
$db = new src\Database($di);
$di->set('db', $db);

// TODO: initialize
//$init = new src\Init($di);
//$init->get();