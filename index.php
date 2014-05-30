<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

include 'vendor/autoload.php';

use Phlyty\App;
use Snailfinder\ErrorHandler;
use Snailfinder\LogProcessor;
use Snailfinder\PhpView;

$app = new App();

$errorHandler = new ErrorHandler();

$app->events()->attach('500', $errorHandler);
$app->events()->attach('501', $errorHandler);

$app->setView(new PhpView());

$app->get('/', function(App $app){
    $app->render('index');
});

$app->get('/generate', function(App $app){
    
    $processor = new LogProcessor();
    
    $app->redirect('/');
});

$app->run();