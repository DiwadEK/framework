<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use app\core\Application;

require_once  __DIR__ . '/../vendor/autoload.php';

$app = new Application();

$app->router->get('/', 'home');

$app->router->get('/contact', 'contact');

$app->run();
