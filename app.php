<?php

use Project\Classes\Request;
use Project\Classes\Session;

// paths & urls
define("PATH", __DIR__ . "/");
define("URL",  "http://localhost/grad_project/");

// db credentials
define("SERVER_NAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "autism");

// include classes
require_once(PATH . 'vendor/autoload.php');

//objects
$request = new Request;
$session = new Session;