<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

include 'vendor/autoload.php';

use Phlyty\App;
use Snailfinder\ErrorHandler;

$app = new App();

$errorHandler = new ErrorHandler();

$app->events()->attach('500', $errorHandler);

$app->get('/', function (App $app) {
    $app->render('templates/index', array());
});

$app->get('/hello/:name', function (App $app) {
    echo "Hello, " . $app->params()->getParam('name');
});

$app->run();