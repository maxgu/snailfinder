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
$app->events()->attach('501', $errorHandler);

$app->setView(new Snailfinder\PhpView());

$app->get('/', function (App $app) {
    $app->render('index', array('na' => 'ddd'));
});

$app->run();