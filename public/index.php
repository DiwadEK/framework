<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use app\core\Application;
use app\controllers\SiteController;

require_once  __DIR__ . '/../vendor/autoload.php';

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->run();
