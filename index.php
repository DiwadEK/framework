<?php

use app\core\Application;

require_once  __DIR__ . '/vendor/autoload.php';

$app = new Application();

$app->router->get('/', function() {
    return 'Hallo word';
});

$app->router->get('/contact', function() {
    echo 'Contact';
});

$app->run();
