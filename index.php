<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

use Phlyty\App;
include 'vendor/autoload.php';

$app = new App();

$app->events()->attach('500', function ($e) {
    die(var_dump($e));
});

$app->get('/', function (App $app) {
    die(var_dump($app->render('templates/foo', array())));
    $app->render('templates/foo', array());
});

$app->get('/hello/:name', function (App $app) {
    echo "Hello, " . $app->params()->getParam('name');
});

$app->run();